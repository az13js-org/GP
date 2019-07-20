<?php
require_once 'autoload.php';

$number = [1,2,3];

/**
 * 随机初始化一个节点
 */
function _random()
{
	global $number;
	$p = mt_rand() / mt_getrandmax();
	if ($p < 0.5) {
		return new MathInterpreter\Number($number[mt_rand(0, count($number) - 1)]);
	} elseif ($p < 0.75) {
		return new MathInterpreter\Add();
	} else {
		return new MathInterpreter\Multiply();
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
	$root = _random();
	_tree($root);
	return $root;
}

var_dump(individual());