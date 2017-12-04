<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
include_once '../Robot.php';
include_once '../World.php';

/**
 * @covers Robot
 */
final class RobotTest extends TestCase
{

    /* - The robot is on a 100×100 grid at location (0, 0) and facing SOUTH. The robot is given the commands “fflff” and should end up at (2, 2) */
    public function testFirst(): void
    {
        $world = new World(100,100, true);
        $robot = new Robot(0,0, Robot::SOUTH, $world);

        $robot->command(['f','f','l','f','f']);
        $pos = $robot->getPos();

        $this->assertEquals('2', $pos['x'] );
        $this->assertEquals('2', $pos['y'] );
    }

    /* - The robot is on a 50×50 grid at location (1, 1) and facing NORTH. The robot is given the commands “fflff” and should end up at (1, 0) */
    public function testSecond(): void
    {
        $world = new World(50,50, true);
        $robot = new Robot(1,1, Robot::NORTH, $world);

        $robot->command(['f','f','l','f','f']);
        $pos = $robot->getPos();

        $this->assertEquals('1', $pos['x'] );
        $this->assertEquals('0', $pos['y'] );
    }


    /* - The robot is on a 100×100 grid at location (50, 50) and facing NORTH. The robot is given the commands “fflffrbb” but there is an obstacle at (48, 50) and should end up at (48, 49)
 */
    public function testObstacle(): void
    {
        $world = new World(100,100, true);
        $robot = new Robot(50,50, Robot::NORTH, $world);

        $robot->command(['f','f','l','f','f','r','b','b']);
        $pos = $robot->getPos();

        $this->assertEquals('48', $pos['x'] );
        $this->assertEquals('49', $pos['y'] );
    }

}

