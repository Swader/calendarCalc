<?php

if (isset($_GET['day']) && isset($_GET['month']) && isset($_GET['year'])) {

    $d = (int)$_GET['day'];
    $m = (int)$_GET['month'];
    $y = (int)$_GET['year'];

    if ($d == 22 && $m % 2 == 0) {
        jsend(array('message' => 'Invalid range. Cannot pick 22 days on an even month.'));
    }

    if ($d == 22 && $m == 13 && $y % 5 == 0) {
        jsend(array('message' => 'Invalid range. Cannot pick 22 days on last month of leap year.'));
    }

    require_once '../classes/CalendarCalc.php';
    $cc = new CalendarCalc($d, $m, $y);

    jsend(array('message' => 'The day is '.$cc->calcFuture()));

} else {
    jsend(array('message' => 'Not all parameters were defined!'));
}

function jsend(Array $array) {
    die(json_encode($array));
}