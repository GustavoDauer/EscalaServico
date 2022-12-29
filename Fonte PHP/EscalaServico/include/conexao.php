<?php

function connect() {
    $dbConfig = parse_ini_file('/var/www/escalaservico.ini');
    $servername = $dbConfig['servername'];
    $username = $dbConfig['username'];
    $password = $dbConfig['password'];
    $database = $dbConfig['dbname'];

    return new mysqli($servername, $username, $password, $database);
}

?>