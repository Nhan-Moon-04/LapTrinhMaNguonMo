<?php
function isPrime($num)
{
    if ($num <= 1)
        return false;
    if ($num == 2)
        return true;
    for ($i = 3; $i <= sqrt($num); $i += 2) {
        if ($num % $i == 0)
            return false;
    }
    return true;


}

for ($i = 1; $i <= 100; $i++) {
    if (isPrime($i)) {
        echo $i . " ";
    }
}
for ($i = 1; $i < 10; $i++) {
    for ($j = 1; $j < 10; $j++) {
        echo $i . "*" . $j . "=" . $i * $j . "<br>";
    }
}
?>