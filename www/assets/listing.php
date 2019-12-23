<?php
$toggle = strip_tags( $_POST['toggle'] );

if( !file_exists( '../.htaccess' ) ){
    file_put_contents( '../.htaccess', '' );
}

$htaccess = file_get_contents( '../.htaccess' );

if ( $htaccess == false ) {
    $htaccess = '';
}

if ( $toggle == 'on' ) {
    if( strpos( $htaccess, 'Options +Indexes' ) === false ){
        file_put_contents( '../.htaccess', $htaccess . PHP_EOL . '# Auto-added by docker-lamp' .PHP_EOL . 'Options +Indexes' );
    }
} else {
    $htaccess = str_replace( '# Auto-added by docker-lamp', '', $htaccess );
    $htaccess = str_replace( 'Options +Indexes', '', $htaccess );
    $htaccess = trim( $htaccess );
    file_put_contents( '../.htaccess', $htaccess );
}

header( 'Location: ../index.php' );
?>
