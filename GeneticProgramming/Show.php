<?php
require_once 'GP.php';

function Show($node)
{
    echo $node->getParseString() . PHP_EOL;
}

Show(individual());
