<?php
/**
 * -- reguły opp --
 * abstrakcja
 * enkapsulacja / hermetyzacja - ukrywanie widoczności metod i klas
 * dziedziczenie
 * polimorfizm --
 */




class Shape
{
    private $name;
    // protected $name;
    public abstract function getArea();

    public function setName($name = 'Example name!')
    {
        $this->name = $name;
    }
    public function __toString()
    {
        try {

            $this->setName();
            return $this->name;
        } catch (Exception $e) {
            return 'Error name';
        }
    }
}

class Rectangle extends Shape
{

    private $a;
    private $b;

    public function __construct($a, $b)
    {
        $this->a = $a;
        $this->b = $b;
    }
    public function getArea()
    {
        return $this->a * $this->b.' END'.$this->name .' << ' ;
    }
}
class Circle extends Shape
{
    private $radius;

    public function __construct($radius)
    {
        $this->radius = $radius;
    }
    public function getArea()
    {
        return 3.14 * pow($this->radius, 2);
    }
}

$rectangle1 = new Rectangle(10, 20);

$rectangle2 = new Rectangle(20, 30);
$circle1 = new Circle(10);

var_dump($rectangle1);
var_dump($rectangle2);
var_dump($circle1);
echo $rectangle1->getArea() . "<br>";
echo $rectangle2->getArea() . "<br>";
echo $circle1->getArea() . "<br>";


abstract class Pojazd
{
    private $wlasciciel;

    public function setWlasciciel($wlasciciel)
    {
        $this->wlasciciel = $wlasciciel;
    }

    public function getWlasciciel()
    {
        return $this->wlasciciel;
    }

    abstract public function jedz();
}

class Samochod extends Pojazd
{
    public function __construct($wlasciciel)
    {
        $this->setWlasciciel($wlasciciel);
    }

    public function jedz()
    {
        echo "Jedzie samochod<br>";
    }
}

class Rower extends Pojazd
{
    public function jedz()
    {
        echo "Jedzie rower<br>";
    }
}

$samochod = new Samochod("Marcin");
$rower = new Rower();
$samochod->jedz(); // wyświetli Jedzie samochod
$rower->jedz(); // wyświetli Jedzie rower
echo $samochod->getWlasciciel();

/**
 * roznicza miedzy klasa abstracyjna a interfejsem
 * Najważniejszą jest: klasa może dziedziczyć tylko po jednej klasie abstrakcyjnej,
 *  podczas gdy może implementować wiele interfejsów. I jeszcze: klasa abstrakcyjna
 *  może definiować ciało metody i wartości domyślne dla pól, a interfejs jedynie
 *  deklaruje pola i metody (podajesz tylko nazwy metod i pól oraz listę parametrów).
 */


///
// Metody statyczne
///
class Samochod2 {
    public static function czyJestNowy($rocznik) {
      return $rocznik == date('Y') ? true : false;
    }
  }

  echo Samochod2::czyJestNowy(2020) ? "Nowy samochód" : "Stary samochód";

