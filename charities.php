<?php
require'header.php';
?>


        <div class="left">
     <form action="charities.php">
     <input type="text" id="ABN" name="ABN" placeholder="ABN without spaces" > <button type="submit" id='submit' value="Submit"> Find </button>
 </form>
     <form action="charities.php">
     <input type="text" id="Name" name="Name" placeholder="organisation key word eg catholic" > <button type="submit" id='submit' value="Submit"> Find </button>
 </form>


<?php
if ( isset($_GET['Name'])  ||  isset($_GET['Legal_Name']) &&   !isset($_GET['ABN']))
 {
$data = $_GET['Name']; 
$recipient=mysqli_real_escape_string ( $db , $data );

$charities = "SELECT * FROM charities where Legal_Name LIKE'%$recipient%'  ";
$result = mysqli_query($db, $charities );
  @$num_results = mysqli_num_rows($result);
  if ($num_results <17)
  {
	  echo"<h3>Results from the ACNC database for $recipient</h3>
		    <h4>".number_format($num_results)." Results for $recipient</h4>
		  <table class='grants'><tr><th>Legal Name</th><th>ABN/ACN</th></tr>";
     while ($row = $result->fetch_assoc())
           {
			   echo"<tr><td><a href='charities.php?Name=$recipient&Legal_Name=".$row['Legal_Name']."'>".$row['Legal_Name']."</a></td><td><a href='charities.php?Name=$recipient&Legal_Name=".$row['Legal_Name']."&ABN=".$row['ABN']."'>".$row['ABN']."</a><td></tr>";

          }echo"</table>Click on the name or ABN for details";
   }
  elseif ($num_results >16)
  {
	  echo"<h3>Results from the ACNC database for $recipient</h3>
		  <h4>".number_format($num_results)." Results for $recipient</h4>
		  <div class='expand'><table class='grants'>";
     while ($row = $result->fetch_assoc())
           {
			   echo"<tr><td><a href='charities.php?Name=$recipient&Legal_Name=".$row['Legal_Name']."'>".$row['Legal_Name']."</a></td><td><a href='charities.php?Name=$recipient&Legal_Name=".$row['Legal_Name']."&ABN=".$row['ABN']."'>".$row['ABN']."</a><td></tr>";

            }echo"</table></div>Mouse/Scroll for more results. Click on name or ABN for details";
     }
    
}

?>


<h3>About ACNC charities data</h3>

<p>There are over 50,000 registered charities in Australia. The dataset used in the GovSpend prototype is not the latest data </p
	<p>For up to the week 
	information on whether a particular organisation is still a registered charity please search the <a href='http:acnc.gov.au'>Australian Charities and Not for Profit Commission</a> site.</p>
	
 

  
 </div>
 <div class='right'>
	  <?php
	  if ( isset($_GET['ABN']) )
	   {
	  $data = $_GET['ABN']; 
	  $ABN=mysqli_real_escape_string ( $db , $data );

	  $charities = "SELECT * FROM charities where ABN LIKE'%$ABN%'  ";
	  $result = mysqli_query($db, $charities );
	    @$num_results = mysqli_num_rows($result);
	    if ($num_results <1)
	    {
	      echo"<h4>There are no exact matches in ACNC charities data for $ABN</h4>";
	    }
	    elseif ($num_results >0)
	    {echo"<div class='expand'>";
	       while ($row = $result->fetch_assoc())
	             {
	           	include'charities_table.php';

	            }
	  }echo"</div>";
	  }

	  ?>
	  
  <?php
  if ( isset($_GET['Legal_Name']) && !isset($_GET['ABN']))
   {
  $data = $_GET['Legal_Name']; 
  $recipient=mysqli_real_escape_string ( $db , $data );

  $charities = "SELECT * FROM charities where Legal_Name LIKE'%$recipient%'  ";
  $result = mysqli_query($db, $charities );
    @$num_results = mysqli_num_rows($result);
    if ($num_results <1)
    {
      echo"<h4>There are no exact matches in ACNC charities data for $recipient</h4>";
    }
    elseif ($num_results >0)
    {echo"<div class='expand'>";
       while ($row = $result->fetch_assoc())
             {
           	include'charities_table.php';

            }
  }echo"</div>";
  }

  ?>
  <?php
  if ( !isset($_GET['Legal_Name']) && !isset($_GET['ABN']))
   {
	   echo"
<a class='twitter-timeline' data-height='600' href='https://twitter.com/@acnc_gov_au'>Tweets by ACNC</a> <script async src='//platform.twitter.com/widgets.js' charset='utf-8'></script>
";

}

?>
</div></div>
<div class='clear'></div>
 <?php 
    include('footer.php');?>

    </body>
</html>