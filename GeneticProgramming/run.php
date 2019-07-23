<?php
require_once 'GP.php';
require_once 'Show.php';

$a = individual();
$b = individual();
Show($a);
Show($b);
$c = crossover($a, $b);
Show($a);
Show($b);
Show($c);
variation($c);
Show($c);
