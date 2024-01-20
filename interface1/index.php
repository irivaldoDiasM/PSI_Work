<?php

include('index.html');


$db = pg_connect("host=db dbname=ss-db-a1 user=ss-db-a1 password=ss-db-a1");

echo "<br/> (Agora a mexer no PHP mesmo a serioas ashdhashdsahashdadshh ) <br/>";
$users 		= pg_query($db, 'SELECT * FROM users'); 
// printTable($users);
$arr = pg_fetch_all($users);
print_r($arr);

echo "<br/><br/>messages <br/>";

$messages 	= pg_query($db, 'SELECT * FROM messages'); 
//printTable($messages);
$arr = pg_fetch_all($messages);
print_r($arr);

echo "<br/><br/>books <br/>";
$books 		= pg_query($db, 'SELECT * FROM books'); 
//printTable($books);
$arr = pg_fetch_all($books);
print_r($arr);

?>