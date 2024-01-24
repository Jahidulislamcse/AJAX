<?php

$id = $_POST["id"];
$name = $_POST["name"];
$studentclass = $_POST["studentclass"];

$conn = mysqli_connect("localhost", "root", "", "ajax_exercise") or die("Couldn't connect");

$sql = "INSERT INTO student(id,name,class) VALUES('{$id}', '{$name}', '{$studentclass}')";

    if(mysqli_query($conn, $sql)){
        echo 1;
    } else {
        echo 0;
    }


?>