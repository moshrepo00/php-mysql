<?php


require "config.php";


try {
    $connection = new PDO("mysql:host=$host", $username, $password, $options);

    $sql = file_get_contents("data/init.sql");
    $connection->exec($sql);
    print 'Database created';
}

catch(PDOException $error) {
    print $sql . "<br>" . $error->getMessage();
}

