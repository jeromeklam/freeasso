<?php


$data = '13,50';
echo preg_replace("/[^0-9.]/", "", str_replace(',', '.', $data));