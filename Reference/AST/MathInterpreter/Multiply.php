<?php
namespace MathInterpreter;

/**
 * 代表乘法操作的节点
 *
 * @author az13js
 */
class Multiply implements Nonterminal
{
    /** @var Node[] */
    private $childNodes = [];

    /**
     * 返回该节点的值
     *
     * 等于子节点的值的乘积。
     *
     * @return float
     */
    public function getValue(): float
    {
        if (0 == count($this->childNodes, COUNT_NORMAL)) {
            throw new \Exception('No number!');
        }
        $sum = 1;
        foreach ($this->childNodes as $node) {
            $sum *= $node->getValue();
        }
        return $sum;
    }

    /**
     * 往当前节点添加子节点
     *
     * 子节点需要实现getValue()方法。
     *
     * @param Node $node
     * @return bool
     */
    public function add(Node $node): bool
    {
        $this->childNodes[] = $node;
        return true;
    }
}
