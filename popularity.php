<!DOCTYPE html>
<html lang="en">
<head>
<title> working with bootstrap </title>
<link href="css/bootstrap.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
</head>

<body>
 <?php 
include("navigation.php");

 ?>
<div class="container">
<form action="popularity.php" method="post"> 
<input type="text" name="nm" placeholder="enter the name">
<input type="text" name="year" placeholder="enter the year">

<br><br>
Select gender : 
<br>
<input type="radio" name="gender" value="male">Male
<input type="radio" name="gender" value="female">Female
<br><br>
<input type="submit" name="bt" value="search">
</form>

<?php 

if(isset($_REQUEST["bt"]))
{
?>
<h1>Bar graph</h1>
<div id="chart1" style="height: 250px;"></div>


<h1>Line graph </h1>
<div id="chart2" style="height: 250px;"></div>
<?php 
}
?>
<?php 

if(isset($_REQUEST["bt"]))
{
$name= trim($_REQUEST["nm"]);
$year= $_REQUEST["year"];
$gender= $_REQUEST["gender"];


include("connect.php");



?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>


		<script>

new Morris.Bar({
  // ID of the element in which to draw the chart.
  element: 'chart1',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [

  <?php 

$flag=0;

for($i=$year; $i<=2013;$i++)
  {
  $a= $gender."_".$i;

  $query = mysql_query("select * from $a where `Given Name`='$name'")or die("Error in iteration $i ".mysql_error());
  
  $row= mysql_fetch_array($query);
  
  $count= mysql_num_rows($query);
   
 
  if($row[2]==null)
  {
    $row[2]=0;
  }
  
    
    $newrow=str_replace("=","",$row[2]);
     
    echo "{ year: '$i' , value: $newrow },";
     
  
  
  }
	
  ?>
   
  ],
  // The name of the data record attribute that contains x-values.
  xkey: 'year',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['value'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Value']
});


</script>

  <script>

new Morris.Line({
  // ID of the element in which to draw the chart.
  element: 'chart2',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [

  <?php 

$flag=0;

for($i=$year; $i<=2013;$i++)
  {
  $a= $gender."_".$i;

  $query = mysql_query("select * from $a where `Given Name`='$name'")or die("Error in iteration $i ".mysql_error());
  
  $row= mysql_fetch_array($query);
  
  $count= mysql_num_rows($query);
   
 
  if($row[2]==null)
  {
    $row[2]=0;
  }
  
    
    $newrow=str_replace("=","",$row[2]);
     
    echo "{ year: '$i' , value: $newrow },";
     
  
  
  }
  
  ?>
   
  ],
  // The name of the data record attribute that contains x-values.
  xkey: 'year',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['value'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Value']
});


</script>


<?php 




}
?>

</div>
<script src="js/bootstrap.js">  </script>
<script src="js/jquery-1.11.3.min.js">  </script>


</div>

</body>
</html>
