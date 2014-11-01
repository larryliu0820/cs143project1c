<html>
<body>

(Ver 1.0 10/10/2014 by Larry Liu and Amber Yu)<br />
Type an SQL query in the following box:
<p>
    <form method="GET">
        <textarea name="relation" cols="60" rows="8"><?php echo $_GET['relation'];?></textarea>
        <input type="submit" value="Submit">
    </form>
</p>
<p>
<small>Note: tables and fields are case sensitive. Run "show tables" to see the list of available tables.</small>
</p>

<?php
function queryDB($query, $db_connection) {

    if(strlen($query) == 0)
        return;
    echo "<h3>Results from MySQL:</h3>"; 
    $rs = mysql_query($query, $db_connection);
    echo $rs;
    if($rs == FALSE) {
        die(mysql_error());
    }

    // obtain the number of columns in the results from MySQL and the names of those columns.
    $numcol = mysql_num_fields($rs);

    echo "<table border=\"1\" cellspacing=\"1\" cellpadding=\"2\">
            <tbody>
             <tr align = \"center\">";

    for($i=0; $i<$numcol; $i++){
        $colname[$i] = mysql_field_name($rs, $i);
        echo "<td>
                <b>".$colname[$i]."</b>
            </td>";
    }        

    while($row = mysql_fetch_row($rs)) {
        echo"<tr align=\"center\">";
        for($i=0;$i<$numcol;$i++){
            if($row[$i]=="")
                $row[$i] = "N/A";
            echo "<td>".$row[$i]."</td>";

        }       
    }
    echo "</tbody>
            </table>";
}

$db_connection = mysql_connect("localhost", "cs143", "");
mysql_select_db("TEST", $db_connection);
queryDB($_GET['relation'], $db_connection);

?>

</body>
</html>