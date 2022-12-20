<?php
$data = [
    "content" => $_POST['content'],
    "title" => $_POST['title']
];

$connection = new PDO('mysql:host=localhost;dbname=tmmun','root','');
$sql = 'INSERT INTO chat (content,title) VALUES (:content,:title)';
$statement = $connection->prepare($sql);
$result = $statement->execute($data);
var_dump($result);
