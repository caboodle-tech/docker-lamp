<title>WebP Extenstion Check</title>
<?php
if ( extension_loaded('gd') && function_exists('gd_info') ) {
    $info = gd_info();
    if ( $info['WebP Support'] == true ){
        echo "PHP WebP support is enabled on your web server.";
    } else {
        echo "PHP WebP support is NOT enabled on your web server.";
    }
} else {
    echo "PHP GD library is NOT installed on your web server. WebP is handled by the GD library.";
}
