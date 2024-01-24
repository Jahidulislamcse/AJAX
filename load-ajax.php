<?php
    $conn = mysqli_connect("localhost", "root", "", "ajax_exercise") or die("Couldn't connect");

    $sql = "SELECT*FROM student";
    $result = mysqli_query($conn, $sql) or die("Couldn't execute");
    $output = "";

    if(mysqli_num_rows($result) > 0 ){
        $output =  '<table border="1" width="100%" cellspacing="0" cellpadding="10px">
        <tr>
            <th>ID</th>
            <th>name</th>
            <th>class</th>
        </tr>';

        while ($row = mysqli_fetch_assoc($result)){
            $output.= "<tr> <td>{$row["id"]}</td> <td>{$row["name"]}</td> <td>{$row["class"]}</td> </tr>";
        }
        $output.= "</table>";

        mysqli_close($conn);

        echo $output;
        
    } else {
        echo "<h2>No data found</h2>";
    }
?>