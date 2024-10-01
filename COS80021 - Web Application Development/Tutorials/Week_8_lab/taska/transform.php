<?php 

$xmlDoc = new DOMDocument();
$xmlDoc->load("books.xml");

$xslDoc = new DOMDocument();
$xslDoc->load("books3.xsl");

$xslProcesser = new XSLTProcessor;
$xslProcesser->importStylesheet($xslDoc);

echo $xslProcesser->transformToXml($xmlDoc);
?>