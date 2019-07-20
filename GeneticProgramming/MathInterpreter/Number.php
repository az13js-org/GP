<?php
namespace MathInterpreter;

/**
 * 代表实数
 *
 * @author az13js
 */
class Number implements Terminal
{
    /** @var float 值 */
    private $value;

    /**
     * 构造函数
     *
     * @param float $number
     */
    public function __construct(float $number) {
        $this->value = $number;
    }

    /**
     * 返回该节点的值
     *
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @return object 返回当前Node包含的子Node
     */
    public function getChildNodes()
    {
        return [];
    }

    /**
     * @return object 返回当前Node包含的所有子Node
     */
    public function getAllChildNodes()
    {
        return [];
    }
}
