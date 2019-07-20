<?php
namespace MathInterpreter;

/**
 * 非终止符节点
 *
 * @author az13js
 */
interface Nonterminal extends Node
{
    /**
     * 添加子节点
     *
     * @return float
     */
    public function add(Node $node): bool;
}
