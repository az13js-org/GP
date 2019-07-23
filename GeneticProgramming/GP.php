<?php
require_once 'autoload.php';

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

function _number_variation($node)
{
    global $number;
    $temp = $number;
    foreach ($temp as $k => $v) {
        if (abs($v - $node->getValue()) < 0.1) {
            unset($temp[$k]);
            break;
        }
    }
    $node->setValue($temp[array_rand($temp)]);
}

function switch_node($node)
{
    if (!($node instanceof MathInterpreter\Multiply || $node instanceof MathInterpreter\Add)) {
        throw new Exception('Error instanceof');
    }
    list($node1, $node2) = $node->getChildNodes();
    if (mt_rand() / mt_getrandmax() > 0.5) {
        if ($node1 instanceof MathInterpreter\Number) {
            _number_variation($node1);
        } elseif ($node1 instanceof MathInterpreter\Multiply) {
            $temp = new MathInterpreter\Add();
            foreach ($node1->getChildNodes() as $child) {
                $temp->add($child);
            }
            $node1 = $temp;
        } else {
            $temp = new MathInterpreter\Multiply();
            foreach ($node1->getChildNodes() as $child) {
                $temp->add($child);
            }
            $node1 = $temp;
        }
    } else {
        if ($node2 instanceof MathInterpreter\Number) {
            _number_variation($node2);
        } elseif ($node2 instanceof MathInterpreter\Multiply) {
            $temp = new MathInterpreter\Add();
            foreach ($node2->getChildNodes() as $child) {
                $temp->add($child);
            }
            $node2 = $temp;
        } else {
            $temp = new MathInterpreter\Multiply();
            foreach ($node2->getChildNodes() as $child) {
                $temp->add($child);
            }
            $node2 = $temp;
        }
    }
    return [$node1, $node2];
}

function variation($individual)
{
    global $variation, $number;
    foreach (array_merge([$individual], $individual->getAllChildNodes()) as $node) {
        if (mt_rand() / mt_getrandmax() <= $variation) {
            if ($node instanceof MathInterpreter\Number) {
                _number_variation($node);
            } else {
                list($node1, $node2) = switch_node($node);
                $node->removeChildNodes();
                $node->add($node1);
                $node->add($node2);
            }
        }
    }
    return $individual;
}

function fitness($individual)
{
    return 1 / (pow(100 - $individual->getValue(), 2) + 1);
}

function population()
{
    global $size;
    $population = [];
    for ($i = 0; $i < $size; $i++) {
        $population[] = individual();
    }
    return $population;
}

function select($population)
{
    $fitnesses = array_map('fitness', $population);
    $pointer = mt_rand() / mt_getrandmax() * array_sum($fitnesses);
    $left = 0;
    foreach ($fitnesses as $i => $fitness) {
        if ($pointer <= $left) {
            return $population[$i];
        }
        $left += $fitness;
    }
    return $population[$i];
}

function maxfitness($population)
{
    return max(array_map('fitness', $population));
}

function maxfitnessindividual($population)
{
    $fitnesses = array_map('fitness', $population);
    return $population[array_search(max($fitnesses), $fitnesses)];
}
