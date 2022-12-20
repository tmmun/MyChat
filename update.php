<?php

$data = [
    "title" => $_POST['title'],
    "content" => $_POST['content']
];

$connection = new PDO('mysql:host=localhost;dbname=tmmun','root','');

$sql = "UPDATE `chat` SET `content` = :content, `sendmes` = 'on' WHERE `chat`.`title` = :title";
$statement = $connection->prepare($sql);
$result = $statement->execute($data);
var_dump($result);
?>