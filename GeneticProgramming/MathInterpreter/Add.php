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

    /**
     * @return object 返回当前Node包含的子Node
     */
    public function getChildNodes()
    {
        return $this->childNodes;
    }

    /**
     * @return object 返回当前Node包含的所有子Node
     */
    public function getAllChildNodes()
    {
        return $this->loopChildNodes($this->childNodes);
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
        return $this->childNodes[0]->getParseString() . '+' . $this->childNodes[1]->getParseString();
    }

    public function __clone()
    {
        foreach ($this->childNodes as $k => $v) {
            $this->childNodes[$k] = clone $this->childNodes[$k];
        }
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
