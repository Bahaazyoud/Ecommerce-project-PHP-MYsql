<?php

$connection = new PDO('mysql:host=localhost;dbname=library','root','');
$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);