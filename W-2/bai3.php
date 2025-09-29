<?php

class MathHelper
{
    public static function add($a, $b)
    {
        return $a + $b;
    }
}

class AdvancedMath extends MathHelper
{
    public static function multiply($a, $b)
    {
        return $a ** $b;
    }
}

echo "5 + 10 = " . MathHelper::add(5, 10) . "<br>";
echo "2 + 3 = " . AdvancedMath::multiply(2, 3);
?>