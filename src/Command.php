<?php
namespace CjsConsole;

class Command{

    protected $name;
    private $definition;
    private $processTitle;
    private $aliases = array();
    private $help;
    private $description;
    private $ignoreValidationErrors = false;
    private $applicationDefinitionMerged = false;
    private $applicationDefinitionMergedWithArgs = false;
    private $code;
    private $synopsis;
    private $helperSet;

    protected $app;

    protected $input;
    protected $output;


    public function __construct($name = null)
    {
        if (null !== $name) {
            $this->setName($name);
        }

        if (!$this->name) {
            throw new \LogicException(sprintf('The command defined in "%s" cannot have an empty name.', get_class($this)));
        }

    }

    public function run($input, $output)
    {
        $this->input = $input;
        $this->output = $output;

    }

    public function ignoreValidationErrors()
    {
        $this->ignoreValidationErrors = true;
    }


    public function comment($string){

        $this->output->writeln("<comment>$string</comment>");
    }


    public function info($string)
    {
        $this->output->writeln("<info>$string</info>");
    }


    public function line($string)
    {
        $this->output->writeln($string);
    }


    public function question($string)
    {
        $this->output->writeln("<question>$string</question>");
    }
    public function error($string)
    {
        $this->output->writeln("<error>$string</error>");
    }

    protected function getArguments()
    {
        return array();
    }

    protected function getOptions()
    {
        return array();
    }

    public function getOutput()
    {
        return $this->output;
    }

    public function setApplication($application = null)
    {
        $this->app = $application;
        if ($application) {
            //$this->setHelperSet($application->getHelperSet());
        } else {
            $this->helperSet = null;
        }
    }

    public function getApplication()
    {
        return $this->app;
    }

    public function setHelperSet($helperSet)
    {
        $this->helperSet = $helperSet;
    }

    public function getHelperSet()
    {
        return $this->helperSet;
    }

    public function setCode($code)
    {
        if (!is_callable($code)) {
            throw new \InvalidArgumentException('Invalid callable provided to Command::setCode.');
        }
        $this->code = $code;
        return $this;
    }

    public function setProcessTitle($title)
    {
        $this->processTitle = $title;
        return $this;
    }

    public function setName($name)
    {
        $this->validateName($name);
        $this->name = $name;
        return $this;
    }

    protected function validateName($name)
    {
        if (!preg_match('/^[^\:]++(\:[^\:]++)*$/', $name)) {
            throw new \InvalidArgumentException(sprintf('Command name "%s" is invalid.', $name));
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setHelp($help)
    {
        $this->help = $help;
        return $this;
    }

    public function getHelp()
    {
        return $this->help;
    }


    public function getAliases()
    {
        return $this->aliases;
    }

    public function getDefinition()
    {
        return $this->definition;
    }

}