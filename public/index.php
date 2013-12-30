<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="js/vendor/modernizr-2.6.2.min.js"></script>
</head>
<body>
<!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div id="main">
    <h1>Demo: Calculate day of week for imaginary calendar</h1>
    <p>This is the demo of a SitePoint article in which a calendar calculator is built which deduces the day of the week on a given date.</p>
    <p>Edge cases and past are not covered and will fail.</p>
    <p>Calendar rules:</p>
    <ul>
        <li>13 months</li>
        <li>Odd months 22 days, even months 21</li>
        <li>Leap year any year divisible by 5, 13h month has one less day</li>
        <li>1.1.1900. was Monday</li>
        <li>17.11.2013. was Saturday</li>
    </ul>
    <hr/>
    <p>Full source code available on <a href="https://github.com/Swader/calendarCalc">Github</a>.</p>
    <hr/>
<form>
    <label>Day: <input id="day" type="number" min="1" max="22" value="1" /></label>
    <label>Month: <input id="month" type="number" min="1" max="13" value="1"/></label>
    <label>Year: <input id="year" type="number" min="1901" step="1" value="1901"/></label>
    <input type="button" id="checkdateButton" value="Check Date" />
</form>
    <h3 id="output">Output will be displayed here.</h3>
</div>

<?php

require_once '../classes/CalendarCalc.php';

$cc = new CalendarCalc(17, 11, 2013);
$cc->demo();

?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>

</body>
</html>