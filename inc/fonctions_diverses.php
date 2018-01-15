<?php

// valide le format d'une date
function validateDate($date, $format = 'd/m/Y H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}