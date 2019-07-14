<?php
namespace MathInterpreter;

/**
 * 代表减法操作的节点
 *
 * @author az13js
 */
class Sub implements Nonterminal
{
    /** @var Node[] 只能有两个子节点存在 */
    private $childNodes = [];

    /**
     * 返回该节点的值
     *
     * @return float
     */
    public function getValue(): float
    {
        if (count($this->childNodes, COUNT_NORMAL) != 2) {
            throw new \Exception('Error, Sub operation need two number.');
        }
        return $this->childNodes[0]->getValue() - $this->childNodes[1]->getValue();
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
        if (count($this->childNodes, COUNT_NORMAL) >= 2) {
            throw new \Exception('Error, Sub operation only need two number.');
        }
        $this->childNodes[] = $node;
        return true;
    }
}
