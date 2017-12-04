<?php
/**
 * Created by PhpStorm.
 * User: einandersson
 * Date: 2017-12-03
 * Time: 20:21
 */

include_once "Robot.php";
include_once "World.php";

$world = new World(100,100, true);
$robot = new Robot(0,0, Robot::SOUTH, $world);


$commands = [
    'f',
    'f',
    'l',
    'f',
    'f',
];

$robot->command($commands);

foreach ($robot->getPath() as $index => $pos) {
    echo '--------'. $index .'-------'. PHP_EOL;
    echo 'X: '. $pos['x'] . PHP_EOL;
    echo 'Y: '. $pos['y'] . PHP_EOL;
    echo 'D: '. $pos['direction'] . PHP_EOL;
}