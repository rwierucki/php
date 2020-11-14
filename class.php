<?php
echo '<pre>';
// include_once './Car.php';
// include_once './Wheel.php';
// require_once './Car.php';
// require_once './Wheel.php';

function autoload(string $name) {
    $name = __DIR__.'/'.str_replace('\\','/',$name).'.php';
    require_once $name;
}
spl_autoload_register('autoload');


use \Vehicles\Wheel;

try{
    $car1 = new \Vehicles\Car();
    $car1->setColor('red');
    $car1->doors = 5;

    $wheel1 = new Wheel();
    $wheel1->size = 17;
    $wheel1->height = 70;
    $wheel1->setBurst();
    $car1->addWheel($wheel1);

    $wheel2 = new Wheel();
    $wheel2->size = 16;
    $wheel2->height = 55;
    $car1->addWheel($wheel2);

    // $wheel2 = clone($wheel1);
    // $car1->addWheel($wheel2);
    $car1->addWheel(clone($wheel1));
    $car1->addWheel(clone($wheel1));

    // $wheel2->setBurst();

    // var_dump($car1);
    var_dump($car1->getBurstWheels());

} catch(InvalidArgumentException $e) {
    var_dump($e);
} catch (Exception $e) {
    // ogolny blad
}


