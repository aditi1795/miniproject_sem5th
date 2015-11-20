<?php 

include("top1.php");
include("top1a.php");
include("top2.php");
include("mid1.php");
?>
<form action="mainprocess.php" method="get">

Search by year :

<select name="yr" class="form-control">
<?php 
for($year=1944; $year<=2013; $year++)
{

  echo "<option>$year</option>";
}

?>
</select>
<br>
select the gender: 

  <input type="radio" name="gender" value="male">Male

  <input type="radio" name="gender"  value="female"> Female

  <input type="radio" name="gender" value="both"> Both

<br>
<br>
Search filters : <br>
  <input type="checkbox" name="filters"  value="10"> Top10 names

  <input type="checkbox" name="filters"  value="20"> Top20 names

  <input type="checkbox" name="filters"  value="50"> Top50 names

  <input type="checkbox" name="filters"  value="100"> Top100 names

<br><br>
<input type="submit" name="bt" value="Search" >
</form>

<?php 




if(isset($_REQUEST["bt"]))
{
$yr= $_GET["yr"];
include("connect.php");
if(isset($_GET["gender"]))
{
	
	$gen=$_GET["gender"] ;


		
		if($gen!="both")
	{
		if(!isset($_GET["filters"]))
			{
				$query="select * from $gen"."_".$yr;
			}
			else
			{
				
				$query="select * from $gen"."_".$yr." LIMIT $_GET[filters]";
			}

		$qry= mysqli_query($con,$query)or die("error".mysqli_error());

		$count=1;
		echo "<br><Br>";
		echo "<div class='row'>";
		echo "<div class='col-md-6'>";
		echo '<table>';
		echo "<tr><th>Ranking </th> <th>Name </th><th> No. of births</th> </tr>";
		while($row= mysqli_fetch_array($qry))
		{
			echo "<tr><td>$count </td><td>$row[0] </td><td>$row[1] </td></tr>";
			$count++;
			
		}
		echo "</div> </div>";

	}
	else
	{

		$genders= array("male","female");

		foreach($genders as $gender)
		{
			if(!isset($_GET["filters"]))
			{
				$query="select * from $gender"."_".$year;
			}
			else
			{
				
				$query="select * from $gender"."_".$year." LIMIT $_GET[filters]";
			}
			$qry= mysqli_query($query)or die(mysqli_error());

			$count=1;
			echo "<div class='row'>";
			echo "<div class='col-md-6'>";
			echo "<h1>$gender</h1>";
			echo '<table class="table table-hover">';
			echo "<tr><th>Ranking </th> <th>Name </th><th> No. of births</th> </tr>";
				
			while($row= mysqli_fetch_array($qry))
			{
				echo "<tr><td> $count</td><td>$row[0]</td><td>$row[1] </td></tr>" ;
				$count++;
				
			}
			echo '</table>';

			echo "</div>";

		echo "</div>";
		}

}





}

}



?>
 



