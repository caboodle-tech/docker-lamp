<?php
// Don't print errors, we account for them on this page already
error_reporting( 0 );
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>LAMP STACK</title>
        <link rel="stylesheet" href="/assets/css/bulma.min.css">
        <link rel="stylesheet" href="/assets/css/bulma-switch.min.css">
        <script type="text/javascript" src="assets/js/listing.js"></script>
    </head>
    <body>
        <section class="hero is-medium is-info is-bold">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <h1 class="title">
                        LAMP STACK
                    </h1>
                    <h2 class="subtitle">
                        Your local development environment.
                    </h2>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <div class="columns">
                    <div class="column">
                        <h3 class="title is-3 has-text-centered">Environment</h3>
                        <hr>
                        <div class="content">
                            <ul>
                                <li><?php echo apache_get_version(); ?></li>
                                <li>PHP <?php echo phpversion(); ?></li>
                                <li>
                                    <?php
                                    // Check database connection
                                    $link = mysqli_connect( "mysql", "root", "lamp", null );
                                    if ( mysqli_connect_errno() ){
                                        echo '<span style="color:red;">Could not connect to the database with the root user. There may be a problem with MySQL. If this is your first time running this image go to <a href="http://localhost:8080" target="_blank">phpMyAdmin</a> and login as root manually.</span>';
                                    } else {
                                        // Print MySQL server version
                                        printf( "MySQL Server %s", mysqli_get_server_info( $link ) );
                                    }
                                    // Close database connection
                                    mysqli_close($link);
                                    ?>
                                </li>
                            </ul>
                            <?php
                                $remakeHtaccess = true;
                                $allowListing = true;
                                if( file_exists('.htaccess') ){
                                    $remakeHtaccess = false;
                                    $htaccess = file_get_contents('.htaccess');
                                    if( strpos( $htaccess, 'Options +Indexes' ) === false ){
                                        $allowListing = false;
                                    }
                                }

                                if( $remakeHtaccess ){
                                    file_put_contents( '.htaccess', '# Auto-added by docker-lamp' . PHP_EOL . 'Options +Indexes' );
                                }

                                if( $allowListing ){
                            ?>
                            <div class="field" onclick="Listing.toggle('off');">
                                <input id="dirListing" type="checkbox" name="dirListing" class="switch is-info" checked="checked">
                                <label for="dirListing" style="position:relative;display:block;"> <span style="position:absolute;margin-top:-3px;">Allow Directory Listing</span></label>
                            </div>
                            <?php
                                } else {
                            ?>
                            <div class="field" onclick="Listing.toggle('on');">
                                <input id="dirListing" type="checkbox" name="dirListing" class="switch is-info">
                                <label for="dirListing" style="position:relative;display:block;"> <span style="position:absolute;margin-top:-3px;">Allow Directory Listing</span></label>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                    <div class="column">
                        <h3 class="title is-3 has-text-centered">Quick Links</h3>
                        <hr>
                        <div class="content">
                            <ul>
                                <li>
                                    <a href="http://localhost:8080" target="_blank">phpMyAdmin</a>
                                    <br>
                                    Root user = root / lamp
                                    <br>
                                    Docker user = docker / docker
                                </li>
                                <li><a href="http://localhost/assets/phpinfo.php" target="_blank">phpinfo()</a></li>
                                <li><a href="http://localhost/assets/gd-test.php" target="_blank">gd extension &check;</a></li>
                                <li><a href="http://localhost/assets/webp-test.php" target="_blank">webp support &check;</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="column">
                        <h3 class="title is-3 has-text-centered">Directories</h3>
                        <hr>
                        <div class="content">
                            <ul>
                            <?php
                                $ignore = [ '.', '..', 'assets', 'index.php' ];
                                $files = [];
                                $dirs = scandir('.');
                                foreach( $dirs as $dir ){
                                    if( !in_array( $dir, $ignore ) ){
                                        if( is_dir( $dir ) ){
                                            echo "<li><a href=\"$dir\">$dir</a></i>";
                                        } else {
                                            array_push( $files, "<a href=\"$dir\">$dir</a>" );
                                        }
                                    }
                                }
                            ?>
                            </ul>
                        </div>
                    </div>
                    <div class="column">
                        <h3 class="title is-3 has-text-centered">Files</h3>
                        <hr>
                        <div class="content">
                            <ul>
                            <?php
                                foreach( $files as $file ){
                                    echo "<li>$file</i>";
                                }
                            ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
