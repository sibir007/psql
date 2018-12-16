<?php

namespace App;
print_r(\PDO::getAvailableDrivers());
$opt = [
		\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
		//\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
];
$host = '127.0.0.1';
$db = 'test1';
$user = 'postgres';
$pass = '12345678';
$charset = 'UTF8';
$dsn = "pgsql:host=$host;dbname=$db";
$pdo = new \PDO($dsn, $user, $pass, $opt);
$pdo->exec("drop table users");
$pdo->exec("create table users (id integer, name text)");

$pdo->exec("insert into users values (1, 'john')");
$pdo->exec("insert into users values (3, 'adel')");
$pdo->exec("insert into users values (33333, 'dkj45adel')");
$value = [3, 'm\'ark --'];
$data = implode(', ', array_map(function ($item) use ($pdo) {
	return $pdo->quote($item);
}, $value));
$sql = "insert into users values ($data)";
echo "<br>";
print_r($sql);
$pdo->exec($sql);

$stmt = $pdo->query("select * from users");
echo "<pre>";
print_r($stmt->fetchAll());
echo "<pre>";
