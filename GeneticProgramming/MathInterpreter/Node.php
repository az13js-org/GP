<?php
namespace MathInterpreter;

/**
 * 语法树的节点接口类
 *
 * @author az13js
 */
interface Node
{
    /**
     * 返回节点的值
     *
     * 节点的值是一个实数。
     *
     * @return float
     */
    public function getValue(): float;
}
