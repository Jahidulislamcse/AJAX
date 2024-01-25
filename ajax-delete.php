<?php

$student_id = $_POST["id"];
$conn = mysqli_connect("localhost", "root", "", "ajax_exercise") or die("Couldn't connect");

    $sql = "DELETE FROM student WHERE id = {$student_id}";

    if(mysqli_query($conn, $sql)){
        echo 1;
    } else {
        echo 0;
    }


?>