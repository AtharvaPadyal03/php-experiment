
<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass ="";
$dbname = "mwaproject";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    die("failed to connect !");
}


// mysql_close($con)
?>