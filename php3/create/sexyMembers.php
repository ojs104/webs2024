<?php
    include "../connect/connect.php";

    $sql = "create table sexyMembers(";
    $sql .= "memberId int(10) unsigned auto_increment,";
    $sql .= "youId varchar(40) NOT NULL,";
    $sql .= "youName varchar(40) NOT NULL,";
    $sql .= "youEmail varchar(40) NOT NULL,";
    $sql .= "youPass varchar(40) NOT NULL,";
    $sql .= "youRegTime int(40) NOT NULL,";
    $sql .= "youAddress varchar(255) DEFAULT NULL,";
    $sql .= "youImgSrc varchar(40) DEFAULT NULL,";
    $sql .= "youImgSize varchar(40) DEFAULT NULL,";
    $sql .= "youDelete int(10) DEFAULT 1,";
    $sql .= "youModTime int(40) DEFAULT NULL,";
    $sql .= "PRIMARY KEY(memberId)";
    $sql .= ") charset=utf8;";

    $connect -> query($sql);
?>