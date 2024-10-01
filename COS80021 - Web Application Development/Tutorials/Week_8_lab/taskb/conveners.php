<?php 

$xmlDoc = new DOMDocument();
$xmlDoc->load("conveners.xml");

$xslDoc = new DOMDocument();
$xslDoc->load("conveners.xsl");

$xslProcesser = new XSLTProcessor;
$xslProcesser->importStylesheet(stylesheet: $xslDoc);

echo $xslProcesser->transformToXml($xmlDoc);
?>