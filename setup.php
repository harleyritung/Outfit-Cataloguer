<?php

// Register the autoloader
spl_autoload_register(function($classname) {
    include "classes/$classname.php";
});

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$db = new mysqli(Config::$db["host"], Config::$db["user"], Config::$db["pass"], Config::$db["database"]);

$db->query("drop table if exists project_article;");
$db->query("drop table if exists project_outfit;");
$db->query("drop table if exists project_user;");

$db->query( "create table project_user (
    uid int not null auto_increment,
    email text not null,
    name text not null,
    password text not null,
    primary key(uid)
    );"
);

$db->query( "create table project_article (
    item_id int not null auto_increment,
    uid int not null,
    primary key(item_id),
    foreign key(uid) references project_user(uid)
    );"
);

// need to add foreign keys for item ids
$db->query( "create table project_outfit (
    outfit_id int not null auto_increment,
    uid int not null,
    primary key(outfit_id),
    foreign key(uid) references project_user(uid)
    );"
);
