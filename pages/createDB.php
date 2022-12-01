<?php
include_once('pages/classes.php');
$pdo=Tools::connect();

$news='create table news (
    id int not null auto_increment primary key,	
	idate int not null default(0),
	title varchar(250) not null,
	annonce text,
	content text) default charset="utf8"';

$pdo->exec($news);