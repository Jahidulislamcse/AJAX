<?php

$student_id = $_POST["id"];
$conn = mysqli_connect("localhost", "root", "", "ajax_exercise") or die("Couldn't connect");

$sql = "SELECT * FROM student WHERE id = {$student_id}";
$result = mysqli_query($conn, $sql) or die("Couldn't execute");
$output = "";

if(mysqli_num_rows($result) > 0 ){

    while ($row = mysqli_fetch_assoc($result)){
        $output.= "
                <tr>
                    <td><input type='hidden' id='studentId' value='{$row["id"]}'></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><input type='text' id='edit-name' value='{$row["name"]}'></td>
                </tr>
                <tr>
                    <td>Class</td>
                    <td><input type='text' id='edit-class' value='{$row["class"]}'></td>
                </tr>
                <tr>
                    <td><input type='submit' id='edit-submit' value='Save'></td>
                </tr>";
    }

    mysqli_close($conn);

    echo $output;
    
} else { 
    echo "<h2>No data found</h2>";
}

?>