<?php

$number = [1,2,3];
$size = 50;
$generation = 500;
$variation = 0.1;
$kill = 0.5;
$stop = 0.8;

require_once 'GP.php';
require_once 'Show.php';

$population = population();
for ($i = 0; $i < $generation; $i++) {
    usort($population, function($individuala, $individualb) {
        return fitness($individuala) - fitness($individualb) > 0 ? 1 : -1;
    });
    $new = [];
    for ($j = 0; $j < $size * $kill; $j++) {
        $new[] = variation(crossover(select($population), select($population)));
    }
    $population = $new + $population;
    $maxfitness = maxfitness($population);
    echo $i . ' ' . sprintf('%.10f', $maxfitness) . PHP_EOL;
    echo "\t";
    Show(maxfitnessindividual($population));
    if ($maxfitness >= $stop) {
        echo 'Finish.' . PHP_EOL;
        return 0;
    }
}