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

    /**
     * @return object 返回当前Node包含的子Node
     */
    public function getChildNodes()
    {
        return $this->childNodes;
    }

    /**
     * 移除此node下的所有节点
     */
    public function removeChildNodes()
    {
        $this->childNodes = [];
    }

    /**
     * 返回字符串解析式
     *
     * @return string
     */
    public function getParseString()
    {
        if ($this->childNodes[0] instanceof Add) {
            $left = '(' . $this->childNodes[0]->getParseString() . ')';
        } else {
            $left = $this->childNodes[0]->getParseString();
        }
        if ($this->childNodes[1] instanceof Add) {
            $right = '(' . $this->childNodes[1]->getParseString() . ')';
        } else {
            $right = $this->childNodes[1]->getParseString();
        }
        return $left . '*' . $right;
    }

    public function __clone()
    {
        foreach ($this->childNodes as $k => $v) {
            $this->childNodes[$k] = clone $this->childNodes[$k];
        }
    }

    /**
     * @return object 返回当前Node包含的所有子Node
     */
    public function getAllChildNodes()
    {
        return $this->loopChildNodes($this->childNodes);
    }

    private function loopChildNodes($nodes)
    {
        $nodesList = $nodes;
        foreach ($nodes as $node) {
            $nodesList = array_merge($nodesList, $this->loopChildNodes($node->getChildNodes()));
        }
        return $nodesList;
    }
}
