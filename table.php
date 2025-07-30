<?php
$sql = "SELECT * FROM cars";
    $run = mysqli_query($conn,$sql);
    if($run){
        echo "<table border='1px' cellspacing='0px' cellpadding='20px' align='center'>";
        echo "<caption><h1>Car</h1></caption>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>company_id</th>";
        echo "<th>color_id</th>";
        echo "<th>registration_date</th>";
        echo "</tr>";
        while($row = mysqli_fetch_assoc($run)){
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['company_id']."</td>";
            echo "<td>".$row['color_id']."</td>";
            echo "<td>".$row['registration_date']."</td>";
            echo "</tr>";

        }
        echo "</table>";


    }else{
        echo "Query is not executed properly.";
    }


?>