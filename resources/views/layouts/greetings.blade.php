<?php
date_default_timezone_set('Asia/Manila'); // Set the timezone to Philippines

$hour = date('H');
$greeting = 'Good Morning';
if ($hour >= 12 && $hour < 18) {
    $greeting = 'Good Afternoon';
} elseif ($hour >= 18) {
    $greeting = 'Good Evening';
}

$day = date('l');
$date = date('F d, Y');

?>
<div class="greetings">{{ $greeting }}, <b>{{ Auth::user()->name }}</b></div>
<!--<div class="date-today">It's {{ $day }}, {{ $date }}</div>-->
