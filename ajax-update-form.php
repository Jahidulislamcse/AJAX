<?php


$student_id = $_POST["id"];
$student_name = $_POST["name"];
$student_class = $_POST["class"];

$conn = mysqli_connect("localhost", "root", "", "ajax_exercise") or die("Couldn't connect");

    $sql = "UPDATE student SET name = '{$student_name}',class = '{$student_class}' WHERE id = {$student_id}";

    if(mysqli_query($conn, $sql)){
        echo 1;
    } else {
        echo 0;
    }

?>