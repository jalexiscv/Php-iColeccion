<?php

function r() {
    $v1 = array();
    $v2 = array();
    $v3 = array();
    $v4 = array();
    $v5 = array();

    for ($i = 1; $i <= 15; $i++) {array_push($v1, $i);}
    for ($i = 16; $i <= 30; $i++) {array_push($v2, $i);}
    for ($i = 31; $i <= 45; $i++) {array_push($v3, $i);}
    for ($i = 46; $i <= 60; $i++) {array_push($v4, $i);}
    for ($i = 61; $i <= 75; $i++) {array_push($v5, $i);}

    $fila = array();

    $vector = $v1;
    for ($i = 1; $i <= 5; $i++) {
        $posicion = mt_rand(1, count($vector) - 1);
        if (isset($vector[$posicion])) {
            $numero = $vector[$posicion];
            array_push($fila, $numero);
            unset($vector[$posicion]);
        } else {
            $i--;
        }
    }

    $vector = $v2;
    for ($i = 1; $i <= 5; $i++) {
        $posicion = mt_rand(1, count($vector) - 1);
        if (isset($vector[$posicion])) {
            $numero = $vector[$posicion];
            array_push($fila, $numero);
            unset($vector[$posicion]);
        } else {
            $i--;
        }
    }

    $vector = $v3;
    for ($i = 1; $i <= 5; $i++) {
        $posicion = mt_rand(1, count($vector) - 1);
        if (isset($vector[$posicion])) {
            $numero = $vector[$posicion];
            array_push($fila, $numero);
            unset($vector[$posicion]);
        } else {
            $i--;
        }
    }

    $vector = $v4;
    for ($i = 1; $i <= 5; $i++) {
        $posicion = mt_rand(1, count($vector) - 1);
        if (isset($vector[$posicion])) {
            $numero = $vector[$posicion];
            array_push($fila, $numero);
            unset($vector[$posicion]);
        } else {
            $i--;
        }
    }

    $vector = $v5;
    for ($i = 1; $i <= 5; $i++) {
        $posicion = mt_rand(1, count($vector) - 1);
        if (isset($vector[$posicion])) {
            $numero = $vector[$posicion];
            array_push($fila, $numero);
            unset($vector[$posicion]);
        } else {
            $i--;
        }
    }
    return(implode(",", $fila));
}

for($i=1;$i<=800;$i++){
    echo(r()."<br>");
}
?>
