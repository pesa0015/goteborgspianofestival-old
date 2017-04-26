<?php

/* Template Name: pdf */

$pdf = get_field('pdf', 347);

header('Content-type:application/pdf');
header('Content-Disposition:inline;filename=festivalprogram.pdf');
readfile($pdf);

?>