<?php

require_once "database.php";
$db = get_db();

$id = $_GET['id'];

$book_stmt = $db->prepare('DELETE book WHERE id = ?');
$book_stmt->execute($id);