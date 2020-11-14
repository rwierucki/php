<?php
namespace Vehicles;

class Wheel
{
    /**
     * @var int
     */
    public $size;
    /**
     * @var int
     */
    public $height;
     /**
     * @var bool
     */
    public $burst = false;
    /**
     * @var Car
     */
    public $car;

    public function setCar(Car $car)
    {

        $this->car = $car;
    }
    public function isBurst():bool
    {
        return $this->burst;
    }
    public function setBurst()
    {
        if(is_null($this->car)) {
            throw new \InvalidArgumentException("Car not set!!!");
        }
        $this->burst = true;
        $this->car->setBroken();
    }
}
