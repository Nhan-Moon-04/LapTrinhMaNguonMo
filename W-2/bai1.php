<?php
class Car
{
    public $Brand;
    public $Color;
    public function showInfo()
    {
        echo "Brand: " . $this->Brand . "<br>";
        echo "Color: " . $this->Color . "<br>";
    }
}



$Car1 = new Car();
$Car1->Brand = "Audi A8";
$Car1->Color = "Black";
$Car1->showInfo();


echo "<br>";
$Car2 = new Car();
$Car2->Brand = "BMW X7";
$Car2->Color = "White";
$Car2->showInfo();


