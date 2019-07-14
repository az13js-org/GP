<?php
namespace MathInterpreter;

/**
 * 代表加法操作的节点
 *
 * @author az13js
 */
class Add implements Nonterminal
{
    /** @var MathInterpreter\Node[] 子节点也是节点 */
    private $childNodes = [];

    /**
     * 返回该节点的值
     *
     * 节点的值是一个实数，等于此节点下的所有子节点的值的和。
     *
     * @return float
     */
    public function getValue(): float
    {
        $sum = 0;
        foreach ($this->childNodes as $node) {
            $sum += $node->getValue();
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
