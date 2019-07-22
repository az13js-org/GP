<?php
require_once 'autoload.php';

$number = [1,2,3];

/**
 * 随机初始化一个节点
 */
function _random($with_number = true)
{
    global $number;
    $p = mt_rand() / mt_getrandmax();
    if ($with_number) {
        if ($p < 0.6) {
            return new MathInterpreter\Number($number[mt_rand(0, count($number) - 1)]);
        } elseif ($p < 0.8) {
            return new MathInterpreter\Add();
        } else {
            return new MathInterpreter\Multiply();
        }
    } else {
        if ($p < 0.5) {
            return new MathInterpreter\Add();
        } else {
            return new MathInterpreter\Multiply();
        }
    }
}

/**
 * 随机返回node下的子节点
 */
function _tree($node)
{
    static $count = 0;
    $count++;
    if ($count > 10000) {
        echo 'max' . PHP_EOL;
        die();
    }
    if ($node instanceof MathInterpreter\Add) {
        $childerns = [_random(), _random()];
        foreach ($childerns as $childern) {
            $node->add($childern);
        }
    }
    if ($node instanceof MathInterpreter\Multiply) {
        $childerns = [_random(), _random()];
        foreach ($childerns as $childern) {
            $node->add($childern);
        }
    }
    if ($node instanceof MathInterpreter\Number) {
        $childerns = [];
    }
    foreach ($childerns as $childern) {
        _tree($childern);
    }
}

/**
 * 随机初始化一个语法树
 */
function individual()
{
    $root = _random(false);
    _tree($root);
    return $root;
}

//$tree = individual();
//var_dump($tree);
//var_dump($tree->getValue());
//var_dump($tree->getAllChildNodes());

/**
 * 获取部分节点交叉生成新树
 *
 * @param object $individuala
 * @param object $individualb
 * @return object
 */
function crossover($individuala, $individualb)
{
    $individuala_clone = clone $individuala;
    $individualb_clone = clone $individualb;
    $a_nodes = [$individuala_clone];
    foreach ($individuala_clone->getAllChildNodes() as $node) {
        if (!($node instanceof MathInterpreter\Number)) {
            $a_nodes[] = $node;
        }
    }
    $b_nodes = [$individualb_clone];
    foreach ($individualb_clone->getAllChildNodes() as $node) {
        if (!($node instanceof MathInterpreter\Number)) {
            $b_nodes[] = $node;
        }
    }
    $select_a = $a_nodes[mt_rand(0, count($a_nodes, COUNT_NORMAL) - 1)];
    $select_b = $b_nodes[mt_rand(0, count($b_nodes, COUNT_NORMAL) - 1)];
    $nodes = $select_a->getChildNodes();
    $select_a->removeChildNodes();
    $select_a->add($nodes[0]);
    $select_a->add($select_b);
    return $individuala_clone;
}

//var_dump(crossover(individual(), individual()));