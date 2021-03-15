<?php
//fetch.php
//$con = pg_connect("host=172.16.0.192 port=5432 dbname=cpahdb user=iptscanview password=iptscanview");
// $connect = mysqli_connect("172.16.0.251", "report", "report", "cpareportdb");
// $query = "  SELECT count(*) as total FROM patient ";
// $result = mysqli_query($connect, $query);
// if(mysqli_num_rows($result) > 0)
// {
//  while($row = mysqli_fetch_array($result))
//  {
//   echo '<p>'.$row["total"].'</p>';
//  }
// }




fetch.php
$connect = pg_connect("172.16.0.192", "iptscanview", "iptscanview", "cpahdb");
$query = "  SELECT  vn,hn,vstdate,ROUND(bps,0)as bps,ROUND(bpd,0)as bpd 
            FROM opdscreen 
            WHERE bps >'150' 
            AND cc IS NULL
            AND vstdate = CURRENT_DATE ";
$result = pg_query($connect, $query);
if(pg_num_rows($result) > 0)
{
 while($row = pg_fetch_array($result))
 {
  echo '<p>'.$row["total"].'</p>';
 }
}









?>