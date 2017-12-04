<?php
/**
 * Created by PhpStorm.
 * User: einandersson
 * Date: 2017-12-03
 * Time: 20:12
 */

class Robot
{

    public const NORTH = 0;
    public const EAST = 1;
    public const SOUTH = 2;
    public const WEST = 3;

    public const TURNLEFT = -1;
    public const TURNRIGHT = 1;

    public const FORWARD = 1;
    public const BACKWARD = -1;

    private $pos = array();
    private $path = array();

    private $msg = "";

    private $world;

    function __construct($_posX, $_posY, $_direction, $_world)
    {
        $this->setPos($_posX, $_posY, $_direction);
        $this->world = $_world;
    }

    function command($_commands)
    {
        $success = false;
        foreach ($_commands as $command) {
            switch ($command) {
                case 'f':
                    $success = $this->step(Robot::FORWARD);
                    break;

                case 'b':
                    $success = $this->step(Robot::BACKWARD);
                    break;

                case 'l':
                    $success = $this->turn(Robot::TURNLEFT);
                    break;
                case 'r':
                    $success = $this->turn(Robot::TURNRIGHT);
                    break;
                default:
                    $success = false;
            }

            if ($success == false) {
                return $success;
            }

        }
        return $success;

    }

    private function setPos($_posX, $_posY, $_direction)
    {
        $this->pos['x'] = $_posX;
        $this->pos['y'] = $_posY;
        $this->pos['direction'] = $_direction;
        $this->pos['msg'] = $this->getMsg();
    }

    function getPos()
    {
        return $this->pos;
    }

    function getPath()
    {
        return $this->path;
    }

    private function step($_direction)
    {
        $currPos = $this->pos;
        $x = $currPos['x'];
        $y = $currPos['y'];

        switch ($this->pos['direction']) {
            case Robot::NORTH:
                return $this->move($x, $y - (1 * $_direction));
                break;
            case Robot::SOUTH:
                return $this->move($x, $y + (1 * $_direction));
                break;
            case Robot::EAST:
                return $this->move($x + (1 * $_direction), $y);
                break;
            case Robot::WEST:
                return $this->move($x - (1 * $_direction), $y);
                break;
            default:
                return false;
        }
    }

    private function move($_posX, $_posY)
    {
        $border = $this->world->getBorder();

        if (!$this->world->isFlat()) {
            if ($_posX < $border['x1']) {
                $_posX = $border['x2'];
            }

            if ($_posX > $border['x2']) {
                $_posX = $border['x1'];
            }

            if ($_posY < $border['y1']) {
                $_posY = $border['y2'];
            }

            if ($_posY > $border['y2']) {
                $_posY = $border['y1'];
            }

        }

        if ($this->canIMove($_posX, $_posY)) {
            $this->setPos($_posX, $_posY, $this->pos['direction']);
            $this->path[] = $this->getPos();
            return true;
        } else {
            return false;
        }
    }

    private function canIMove($_posX, $_posY)
    {
        $border = $this->world->getBorder();

        if ($this->world->isFlat() && ($_posX < $border['x1'] || $_posX > $border['x2'] || $_posY < $border['y1'] || $_posY > $border['y2'])) {
            $this->setMsg('Hitting border');
            return false;
        }

        if($this->world->hasObstacle($_posX, $_posY)) {
            /* kan implementera "typ" av hinder, för att tex om det är en sten, och man har en hacka kan man ta sig igenom ändå */
            $this->setMsg('Hitting Obstacle');
            return false;
        }


        return true;
    }

    public function turn($_turningDirection)
    {

        $newDirection = ($this->pos['direction'] + $_turningDirection) % 4;

        if ($newDirection < 0) {
            $newDirection = $_turningDirection + 4;
        }

        $this->pos['direction'] = $newDirection;
        $this->path[] = $this->getPos();

        return true;
    }

    function setMsg($_msg) {
         $this->msg = $_msg;
    }
    function getMsg() {
        return $this->msg;
    }
}