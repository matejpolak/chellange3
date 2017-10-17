<?php
require 'db.php';


$query = 'SELECT * FROM watches';

$stmt = db::query($query);

var_dump($stmt);

$data = $stmt->fetchAll();

var_dump($data);