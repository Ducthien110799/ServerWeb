 <?php 

 require 'server/dbconfig.php';

$sql_qry="SELECT SUM(giasp) AS count FROM sanpham ";

$duration = $connection->query($sql_qry);
while($record = $duration->fetch_array()){
    $total = $record['count'];
}

echo $total

?>