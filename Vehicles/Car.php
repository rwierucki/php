<?php
namespace Vehicles;
class Car
{
    public $color;
    public $doors;
    /**
     * @var Wheel[]
     */
    public $wheels = [];
    public $running = false;
    public $broken = false;

    public function addWheel(Wheel $wheel)
    {
        $wheel->setCar($this);
        $this->wheels[] = $wheel;
    }
    public function getBurstWheels():array
    {
        $burstWheels = [];
        foreach($this->wheels as $wheel){
            if($wheel->isBurst()){
                $burstWheels[] = $wheel;
            }
        }
        return $burstWheels;
    }
    public function turnOn()
    {
        $this->running = true;
    }
    public function turnOff()
    {
        $this->runing = false;
    }
    public function setColor($color = 'white')
    {
        $this->color = $color;
    }
    public function setBroken()
    {
        $this->broken = true;
    }
}