<?php
/**
 * Created by PhpStorm.
 * User: einandersson
 * Date: 2017-12-03
 * Time: 22:29
 */

class World
{

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

    public function hasObstacle($_posX, $_posY) {

        /* Kan byggas om att läsa in hinder dynamiskt */

        if ($_posX == 48 && $_posY == 50) {
            return true;
        }

        return false;
    }

}