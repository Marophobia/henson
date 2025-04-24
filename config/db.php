<?php

require 'rb.php';

// Set up the database connection
R::setup('mysql:host=localhost;dbname=adesotu', 'root', '');

// Check connection
if (!R::testConnection()) {
    // echo "Could not connect to the database";
    die('Could not connect to the database');
}

?>