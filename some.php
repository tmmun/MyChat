<?php
$data = [
    "log" => $_POST['log'],
    "pas" => $_POST['pas'],
    "profimg" => $_POST['profimg']
];

$connection = new PDO('mysql:host=localhost;dbname=tmmun','root','');
$sql = 'INSERT INTO chatacc (log, pas, profimg) VALUES (:log, :pas, :profimg)';
$statement = $connection->prepare($sql);
$result = $statement->execute($data);
var_dump($result);
