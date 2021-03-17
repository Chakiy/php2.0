<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

//vendor services
require 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler('log/app.log', Logger::INFO));

// add records to the log
$log->info('Dit is een veel interessanter bericht');

use Carbon\Carbon;

printf("Right now is %s", Carbon::now()->toDateTimeString());
print "<br>";
echo Carbon::now()->subMinutes(2)->diffForHumans(); // '2 minutes ago'
print "<br>";


$yesterday = Carbon::parse('2021-03-15');
echo $yesterday->diffForHumans();
print "<br>";



print "Hello!!<br>";

