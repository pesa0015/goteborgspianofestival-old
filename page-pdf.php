<?php

/* Template Name: pdf */

$pdf = get_field('pdf', PAGE_PDF);

header('Content-type:application/pdf');
header('Content-Disposition:inline;filename=festivalprogram-' . year() . '.pdf');
readfile($pdf);

?>