<!DOCTYPE html>
<html lang="en">
<head>
<title>Welcome to names details</title>
<link href="css/bootstrap.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
</head>

<body style="background-color:gray;">
 <?php 
include("top1a.php");
include("top2.php");
 ?>
<div class="container">
<div style="margin:10%;">
<form action="analyse.php" method="post">




<label><big>Enter the name you want to analyse</big> </label> 
<br>
<input type="text" name="nm" required>
<br><br>
<label><big>Enter the year from where you want to do analyses</big> </label> 
<br>
<input type="number" name="year" required>

<br><br>
Select gender : 
<br>
<div class="btn-group" data-toggle="buttons">
    <label class="btn btn-primary">
    <input type="radio" name="gender" value="male" > Male
  </label>
  &nbsp;&nbsp;&nbsp;
  <label class="btn btn-primary">
   <input type="radio" name="gender" value="female" > Female
  </label>
</div>


<br><br>

<input type="submit" name="submit" value="search now">
</form>
</div>
<?php 

if(isset($_REQUEST["submit"]))
{
  $flag=0;
  $name= trim($_REQUEST["nm"]);
  $year= $_REQUEST["year"];

  mysql_connect("localhost","root","");

  mysql_select_db("geu");


if(isset($_REQUEST["gender"]))
{
$gender= $_REQUEST["gender"];
}
else
{
  echo die("<h3>Please select gender</h3>");
}



  for($i=$year; $i<=2013;$i++)
  {

  if(empty($gender))
  {
    
    $a= "male_".$i;

  }
  else
  {
  $a= $gender."_".$i;
  }

  $query = mysql_query("select * from $a where `Given Name`='$name'")or die("Error in iteration $i ".mysql_error());

  $count= mysql_num_rows($query);
  
  $flag= $flag+$count;

  }
 
 
  if($flag>0)
  {
  ?>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
         Bar graph for 

         <?php 
          $name= strtolower($name);
          echo "(Name: $name , Gender: $gender, From: $year)";
         ?>

        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
       <div id="bargraph" style="height: 250px;"></div> 
       
        </div>
    </div>
  </div>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
         Line graph for  <?php 
          $name= strtolower($name);
          echo "(Name: $name , Gender: $gender, From: $year)";
         ?>
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
      <div id="linegraph" style="height: 250px;"></div> 
       
        </div>
    </div>
  </div>
  

  <?php
  }
  else
  { 
    echo "<h1>Sorry! No records found</h1>";
   
  }
}
?>

  
</div>

<?php 

?>
<?php 

if(isset($_REQUEST["submit"]))
{
$name= trim($_REQUEST["nm"]);
$year= $_REQUEST["year"];
$gender= $_REQUEST["gender"];



mysql_connect("localhost","root","");

mysql_select_db("geu");



?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>


		<script>

new Morris.Bar({
  // ID of the element in which to draw the chart.
  element: 'bargraph',
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
  labels: ['Popularity']
});


</script>

  <script>

new Morris.Line({
  // ID of the element in which to draw the chart.
  element: 'linegraph',
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
  labels: ['Popularity']
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
