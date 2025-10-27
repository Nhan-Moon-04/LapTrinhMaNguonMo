<?php
if (isset($_GET['r']) && is_numeric($_GET['r'])) {
    $r = (float) $_GET['r'];
    $chuvi = 2 * pi() * $r;
    $dientich = pi() * $r * $r;

    echo "Chu vi:" . round($chuvi, 2) . "<br>";
}
?>