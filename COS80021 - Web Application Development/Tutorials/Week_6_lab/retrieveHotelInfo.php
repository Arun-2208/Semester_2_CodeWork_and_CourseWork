<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set the content type to XML
header("Content-Type: text/xml; charset=utf-8");

// Output XML declaration
echo "<?xml version='1.0' encoding='UTF-8'?>";
echo "<hotels>";

// Retrieve parameters from the GET request
$city = isset($_GET['city']) ? $_GET['city'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';

// Load the XML file
$xml = simplexml_load_file('hotel.xml');

if ($xml === false) {
    echo "<error>Failed to load XML file.</error>";
} else {
    foreach ($xml->hotel as $hotel) {
        // Match the structure of the original XML
        if ((string)$hotel->City === $city && (string)$hotel->Type === $type) {
            echo "<hotel>";
            echo "<City>" . htmlspecialchars($hotel->City, ENT_XML1, 'UTF-8') . "</City>";
            echo "<Name>" . htmlspecialchars($hotel->Name, ENT_XML1, 'UTF-8') . "</Name>";
            echo "<Type>" . htmlspecialchars($hotel->Type, ENT_XML1, 'UTF-8') . "</Type>";
            echo "<Price>" . htmlspecialchars($hotel->Price, ENT_XML1, 'UTF-8') . "</Price>";
            echo "</hotel>";
        }
    }
}

// End the hotels element
echo "</hotels>";
?>
