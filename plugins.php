<?php
require 'simple_html_dom.php'; // Include the Simple HTML DOM Parser library

$url = 'http://example.com'; // Replace with the actual website URL

// Fetch the HTML content of the website
$html = file_get_html($url);

// Array to store the plugin names
$plugins = array();


// Find the plugin information in the HTML content
foreach ($html->find('link[rel="stylesheet"], script[src]') as $element) {
    // Check if the element contains a plugin file path
    if (preg_match('/\/wp-content\/plugins\/([^\/]+)\//', $element->getAttribute('href') ?? $element->getAttribute('src'), $matches)) {
        $pluginName = $matches[1];
        // Add the plugin name to the array
        $plugins[] = $pluginName;
    }
}

// Display the installed plugins
echo 'Installed Plugins: <br>';
foreach ($plugins as $plugin) {
    echo $plugin . '<br>';
}

// Clean up resources
$html->clear();



function getWordPressVersion($url) {
    // Construct the URL for the readme.html file
    $readmeUrl = rtrim($url, '/') . '/readme.html';

    // Make an HTTP request to the readme.html file
    $response = file_get_contents($readmeUrl);

    // Extract the WordPress version from the response
    if (preg_match('/Version (\d+(\.\d+)+)/', $response, $matches)) {
        return $matches[1];
    }

    return 'Unable to determine the WordPress version.';
}

// Example usage
$url = 'http://example.com'; // Replace with the actual website URL

$version = getWordPressVersion($url);
echo 'WordPress version: ' . $version;
?>
