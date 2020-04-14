<?php
$date = '2010-12-31T12:14:00+01:00';
$format = 'Y-m-d\TH:i:sP';
$d = \DateTime::createFromFormat($format, $date);

echo $d->format('Y');
