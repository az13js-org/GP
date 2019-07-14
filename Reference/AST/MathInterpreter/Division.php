<?php
namespace MathInterpreter;

/**
 * 代表除法操作的节点
 *
 * @author az13js
 */
class Division implements Nonterminal
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
            throw new \Exception('Error, Division operation need two number.');
        }
        $denominator = $this->childNodes[1]->getValue();
        if (0 == $denominator) {
            throw new \Exception('Error, $denominator == 0!');
        }
        return $this->childNodes[0]->getValue() / $denominator;
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
            throw new \Exception('Error, Division operation only need two number.');
        }
        $this->childNodes[] = $node;
        return true;
    }
}
