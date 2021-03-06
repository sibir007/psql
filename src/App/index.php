<?php

namespace App;
print_r(\PDO::getAvailableDrivers());
$opt = [
		\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
		\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
];
$host = '127.0.0.1';
$db = 'test1';
$user = 'postgres';
$pass = '12345678';
$charset = 'UTF8';
$dsn = "pgsql:host=$host;dbname=$db";
$pdo = new \PDO($dsn, $user, $pass, $opt);
$pdo->exec("drop table users");
$pdo->exec("create table users (id integer, name text, role text)");
$data = [
	[1, 'john', 'member'],
	[9, 'mike', 'admin'],
	[3, 'adel', 'member']
];
$stmt = $pdo->prepare("insert into users values (?, ?, ?)");
foreach ($data as $value) {
	$stmt->execute($value);
}

$idx = [1, 2, 3];
$in = implode(', ', array_fill(0, sizeof($idx), '?'));
$stmt = $pdo->prepare("select * from users where id in ($in)");
$stmt->execute($idx);

echo '<pre>';
print_r($stmt->fetchAll());
echo '<pre>';
