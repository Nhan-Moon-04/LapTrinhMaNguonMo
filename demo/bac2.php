<?php
if (
    isset($_GET['a'], $_GET['b'], $_GET['c']) &&
    is_numeric($_GET['a']) &&
    is_numeric($_GET['b']) &&
    is_numeric($_GET['c'])
) {
    $a = (float) $_GET['a'];
    $b = (float) $_GET['b'];
    $c = (float) $_GET['c'];

    if ($a == 0) {
        if ($b == 0) {
            if ($c == 0) {
                echo "Phương trình vô số nghiệm";
            } else {
                echo "Phương trình vô nghiệm";
            }
        } else {
            $x = -$c / $b;
            echo "Phương trình có một nghiệm x=" . $x;
        }
        exit;
    }

    (float) $delta = $b * $b - 4 * $a * $c;
    if ($delta < 0) {
        echo "Phương trình vô nghiệm";
    } elseif ($delta == 0) {
        $x = -$b / (2 * $a);
        echo "Phương trình có nghiệm kép x1=x2=" . $x;
    } else {
        $x1 = (-$b + sqrt($delta)) / (2 * $a);
        $x2 = (-$b - sqrt($delta)) / (2 * $a);
        echo "Phương trình có 2 nghiệm phân biệt x1=" . $x1 . ", x2=" . $x2;
    }
} {

}