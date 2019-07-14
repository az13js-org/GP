<?php

require 'autoload.php';

use MathInterpreter\Add;
use MathInterpreter\Number;

$A = new Add();
$B = new Number(3);
$C = new Add();
$D = new Number(1);
$E = new Number(2);
$C->add($D);
$C->add($E);
$A->add($B);
$A->add($C);

echo $A->getValue();