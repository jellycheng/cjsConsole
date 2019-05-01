<?php
namespace CjsConsole\Input;

//单个参数对象
class InputArgument
{
    const REQUIRED = 1; //必须
    const OPTIONAL = 2; //可选
    const IS_ARRAY = 4; //值为数组

    private $name;
    private $mode; //值只能是1,2,4
    private $default;
    private $description;

    /**
     *
     * @param $name 参数名
     * @param null $mode  参数模式
     * @param string $description 参数描述
     * @param null $default 参数默认值
     */
    public function __construct($name, $mode = null, $description = '', $default = null)
    {
        if (null === $mode) {
            $mode = self::OPTIONAL;
        } elseif (!is_int($mode) || $mode > 7 || $mode < 1) {
            throw new \InvalidArgumentException(sprintf('Argument mode "%s" is not valid.', $mode));
        }

        $this->name = $name;
        $this->mode = $mode;
        $this->description = $description;
        $this->setDefault($default);
    }

    public function getName()
    {
        return $this->name;
    }


    public function isRequired()
    {
        return self::REQUIRED === (self::REQUIRED & $this->mode);
    }


    public function isArray()
    {
        return self::IS_ARRAY === (self::IS_ARRAY & $this->mode);
    }

    //设置参数默认值
    public function setDefault($default = null)
    {
        if ($this->isRequired() && null !== $default) {//参数值必须则一定要设置值
            throw new \LogicException('Cannot set a default value except for InputArgument::OPTIONAL mode.');
        }

        if ($this->isArray()) {
            if (null === $default) {
                $default = array();
            } elseif (!is_array($default)) {
                throw new \LogicException('A default value for an array argument must be an array.');
            }
        }

        $this->default = $default;
    }


    public function getDefault()
    {
        return $this->default;
    }

    public function getDescription()
    {
        return $this->description;
    }
}
