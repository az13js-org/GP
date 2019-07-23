<?php
require_once 'GP.php';

function Show($node)
{
    echo $node->getParseString();
    echo '=' . $node->getValue() . PHP_EOL;
}

//Show(individual());
