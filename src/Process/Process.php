<?php
namespace CjsConsole\Process;

use RuntimeException;
use InvalidArgumentException;
class Process{

    private static $sigchild;

    public function __construct($commandline, $cwd = null, array $env = null, $input = null, $timeout = 60, array $options = array())
    {
        if (!function_exists('proc_open')) {
            throw new RuntimeException('The Process class relies on proc_open, which is not available on your PHP installation.');
        }

        $this->commandline = $commandline;
        $this->cwd = $cwd;

        if (null === $this->cwd && (defined('ZEND_THREAD_SAFE') || '\\' === DIRECTORY_SEPARATOR)) {
            $this->cwd = getcwd();
        }
        if (null !== $env) {
            $this->setEnv($env);
        }

        $this->input = $input;
        $this->setTimeout($timeout);
        $this->useFileHandles = '\\' === DIRECTORY_SEPARATOR;
        $this->pty = false;
        $this->enhanceWindowsCompatibility = true;
        $this->enhanceSigchildCompatibility = '\\' !== DIRECTORY_SEPARATOR && $this->isSigchildEnabled();
        $this->options = array_replace(array('suppress_errors' => true, 'binary_pipes' => true), $options);
    }

    public function __destruct()
    {
        $this->stop();
    }

    public function run($callback = null)
    {
        $this->start($callback);

        return $this->wait();
    }

    protected function isSigchildEnabled()
    {
        if (null !== self::$sigchild) {
            return self::$sigchild;
        }
        if (!function_exists('phpinfo')) {
            return self::$sigchild = false;
        }
        ob_start();
        phpinfo(INFO_GENERAL);
        return self::$sigchild = false !== strpos(ob_get_clean(), '--enable-sigchild');
    }

    public function setEnv(array $env)
    {
        $env = array_filter($env, function ($value) {
            return !is_array($value);
        });

        $this->env = array();
        foreach ($env as $key => $value) {
            $this->env[(binary) $key] = (binary) $value;
        }
        return $this;
    }

    public function setTimeout($timeout)
    {
        $this->timeout = $this->validateTimeout($timeout);
        return $this;
    }

    private function validateTimeout($timeout)
    {
        $timeout = (float) $timeout;
        if (0.0 === $timeout) {
            $timeout = null;
        } elseif ($timeout < 0) {
            throw new InvalidArgumentException('The timeout value must be a valid positive integer or float number.');
        }
        return $timeout;
    }


    public function stop($timeout = 10, $signal = null)
    {
        $timeoutMicro = microtime(true) + $timeout;
        if ($this->isRunning()) {
            if ('\\' === DIRECTORY_SEPARATOR && !$this->isSigchildEnabled()) {
                exec(sprintf("taskkill /F /T /PID %d 2>&1", $this->getPid()), $output, $exitCode);
                if ($exitCode > 0) {
                    throw new RuntimeException('Unable to kill the process');
                }
            }
            // given `SIGTERM` may not be defined and that `proc_terminate` uses the constant value and not the constant itself, we use the same here
            $this->doSignal(15, false);
            do {
                usleep(1000);
            } while ($this->isRunning() && microtime(true) < $timeoutMicro);

            if ($this->isRunning() && !$this->isSigchildEnabled()) {
                if (null !== $signal || defined('SIGKILL')) {
                    $this->doSignal($signal ?: SIGKILL, false);
                }
            }
        }

        $this->updateStatus(false);
        if ($this->processInformation['running']) {
            $this->close();
        }

        return $this->exitcode;
    }


    private function close()
    {
        $this->processPipes->close();
        if (is_resource($this->process)) {
            $exitcode = proc_close($this->process);
        } else {
            $exitcode = -1;
        }

        $this->exitcode = -1 !== $exitcode ? $exitcode : (null !== $this->exitcode ? $this->exitcode : -1);
        $this->status = self::STATUS_TERMINATED;

        if (-1 === $this->exitcode && null !== $this->fallbackExitcode) {
            $this->exitcode = $this->fallbackExitcode;
        } elseif (-1 === $this->exitcode && $this->processInformation['signaled'] && 0 < $this->processInformation['termsig']) {
            // if process has been signaled, no exitcode but a valid termsig, apply Unix convention
            $this->exitcode = 128 + $this->processInformation['termsig'];
        }

        return $this->exitcode;
    }


}