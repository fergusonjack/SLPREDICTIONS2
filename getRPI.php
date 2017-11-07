<?php

$html = file_get_contents('https://www.ons.gov.uk/economy/inflationandpriceindices'); //get the html returned from the following url
libxml_use_internal_errors(TRUE); //disable libxml errors

$dom = new DomDocument();
$dom->loadHTML($html);
libxml_clear_errors(); //remove errors for yucky html
$xpath = new DOMXPath($dom);

$classname="stand-out";
$nodes = $xpath->query("//*[contains(@class, '$classname')]");

global $RPI;
$temp = substr($nodes[0]->nodeValue , 0 , 4);
$RPI = floatval($temp);
?>
