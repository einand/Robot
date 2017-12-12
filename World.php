<?php
/**
 * Created by PhpStorm.
 * User: einandersson
 * Date: 2017-12-03
 * Time: 22:29
 */

class World
{
    private $obstacle = array();


    private $borders = array();
    private $flat = false;

    function __construct($_height, $_width, $_flat = true) {
        $this->setBorders(0,0,$_height, $_width);
        $this->flat = $_flat;
    }

    private function setBorders($_x1, $_y1, $_x2, $_y2) {
        $this->borders['x1'] = $_x1;
        $this->borders['y1'] = $_y1;
        $this->borders['x2'] = $_x2;
        $this->borders['y2'] = $_y2;
    }

    public function getBorder() {
        return $this->borders;
    }

    public function isFlat() {
        return $this->flat;
    }


    function generateObstacles() {
        $this->addObstacle('STONE', 48, 50);
    }

    function addObstacle($_kind, $_posX, $_posY)  {
        $this->obstacle[$_posX][$_posY] = $_kind;
    }

    function getObstacle($_posX, $_posY)  {
        if (isset($this->obstacle[$_posX][$_posY])) {
            return $this->obstacle[$_posX][$_posY];
        } else {
            return false;
        }
    }

    public function hasObstacle($_posX, $_posY) {

        if ($this->getObstacle($_posX, $_posY)) {
            return true;

        }

        return false;

    }

}