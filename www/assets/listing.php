<?php
$toggle = strip_tags($_POST['toggle']);
$htaccessFile = '../.htaccess';
$marker = '# Auto-added by docker-lamp';
$directive = 'Options +Indexes';

// Ensure the .htaccess file exists
if (!file_exists($htaccessFile)) {
    if (!file_put_contents($htaccessFile, '')) {
        die('Error: Unable to create .htaccess file.');
    }
}

// Read the .htaccess file content
$htaccess = file_get_contents($htaccessFile);
if ($htaccess === false) {
    die('Error: Unable to read .htaccess file.');
}

// Handle the toggle action
if ($toggle === 'on') {
    // Add the directive only if it's not already present
    if (strpos($htaccess, $directive) === false) {
        $newContent = $htaccess . PHP_EOL . $marker . PHP_EOL . $directive . PHP_EOL;
        if (!file_put_contents($htaccessFile, $newContent)) {
            die('Error: Unable to update .htaccess file.');
        }
    }
} else {
    // Remove the directive and the marker if they exist
    $htaccess = str_replace([$marker, $directive], '', $htaccess);
    $htaccess = trim($htaccess);

    if (!file_put_contents($htaccessFile, $htaccess)) {
        die('Error: Unable to update .htaccess file.');
    }
}

// Redirect back to the index page
header('Location: ../index.php');
exit;
