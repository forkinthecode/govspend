<?php
require'header.php';
?>



<div class='left'>



<h3>Open data sets used in GovSpend</h3>
<table class='wide'><tbody><tr><th>Dataset</th><th>Custodian</th><th>Published at</th></tr>

 <tr><td><a href='about.php?data=AGOR'>Australian Government Organisations Register</a></h4></td><td>Department of Finance</td><td>finance.gov.au</td></tr>
 <tr><td><a href='about.php?data=budget'>Federal Budget data 2015-16 FY</a></td><td>Department of Treasury</td><td>data.gov.au</td></tr>
<tr><td> <a href='about.php?data=acnc'>Australian Charities & Not for Profit Commission Charities Data</a></td><td>ACNC</td><td>data.gov.au</td></tr>
<tr><td> <a href='about.php?data=tax'>Tax Transparency Data</a></td><td>ATO</td><td>data.gov.au</td></tr>
<tr><td> <a href='about.php?data=tenders'>Commonwealth tenders</a></td><td>Finance</td><td>AusTenders, data.gov.au</td></tr>
<tr><td> <a href='about.php?data=grants'>Commonwealth agency grants</a></td><td>Individual agency sites, moving to grants.gov.au</td><td></td></tr>
<tr><td> <a href='about.php?data=welfare_by_electorate'>Welfare Recipients by Commonwealth Electoral Division</a></td><td>Department of Social Services</td><td>data.gov.au</td></tr>
<tr><td> <a href='about.php?data=lga_welfare'>Welfare Recipients by Local Government Area</a></td><td>Department of Social Services</td><td>data.gov.au</td></tr>
<tr><td> <a href='about.php?data=indigenous_by_postcode'>Indigenous & Non-Indigenous population by Postcode</a> </td><td>ABS</td><td>ABS</td></tr>
<tr><td> <a href='about.php?data=seifa_by_electorate'>SEIFA by Commonwealth Electoral Division</a></td><td>ABS</td><td>ABS</td></tr>
<tr><td> <a href='about.php?data=seifa_lga'>SEIFA by Local Government Area</a></td><td>ABS</td><td>ABS</td></tr>
<tr><td> <a href='about.php?data=coordinates'>Postcode and coordinate information dataset</a></td><td>Datalicious</td><td>Datalicious</td></tr>

<tr><td> <a href='about.php?data=privacy'>Privacy alert agencies list</a></td><td>Attorney-General</td><td>Right to Know</td></tr></tbody>
</table>

 </div>
 <div class='right'>

<h3>Metadata Results of dataset</h3>

<?php
	
if (isset($_GET['data']))
{
	
	
		if ($_GET['data']=='budget')
		{
			$sql = "SHOW COLUMNS FROM budget_table15_16";
			$result = mysqli_query($db,$sql);
			while($row = mysqli_fetch_array($result))
			{
			echo $row['Field']."<br>";
			}
		
		
		}mysqli_free_result($result);
		
	
	
	if ($_GET['data']=='acnc')
	{ 	$sql = "SHOW COLUMNS FROM charities";
			$result = mysqli_query($db,$sql);
			while($row = mysqli_fetch_array($result))
			{
			echo $row['Field']."<br>";
			}

     }mysqli_free_result($result);
	 
 	if ($_GET['data']=='grants')
 	{ 	$sql = "SHOW COLUMNS FROM grants";
 			$result = mysqli_query($db,$sql);
 			while($row = mysqli_fetch_array($result))
 			{
 			echo $row['Field']."<br>";
 			}

      }mysqli_free_result($result);
  	
	if ($_GET['data']=='tenders')
  	{ 	$sql = "SHOW COLUMNS FROM tenders";
  			$result = mysqli_query($db,$sql);
  			while($row = mysqli_fetch_array($result))
  			{
  			echo $row['Field']."<br>";
  			}

       }mysqli_free_result($result);
   	
	if ($_GET['data']=='welfare_by_electorate')
   	{ 	$sql = "SHOW COLUMNS FROM welfare_by_electorate";
   			$result = mysqli_query($db,$sql);
   			while($row = mysqli_fetch_array($result))
   			{
   			echo $row['Field']."<br>";
   			}

        }mysqli_free_result($result);
	 
		if ($_GET['data']=='lga_welfare')
		{ 	$sql = "SHOW COLUMNS FROM lga_welfare";
				$result = mysqli_query($db,$sql);
				while($row = mysqli_fetch_array($result))
				{
				echo $row['Field']."<br>";
				}

	     }mysqli_free_result($result);
	 	
		if ($_GET['data']=='Indigenous_by_postcode')
	 	{ 	$sql = "SHOW COLUMNS FROM suburb_by_Indigenous";
	 			$result = mysqli_query($db,$sql);
	 			while($row = mysqli_fetch_array($result))
	 			{
	 			echo $row['Field']."<br>";
	 			}

	      }mysqli_free_result($result);
  	 	
		if ($_GET['data']=='coordinates')
  	 	{ 	$sql = "SHOW COLUMNS FROM coordinates";
  	 			$result = mysqli_query($db,$sql);
  	 			while($row = mysqli_fetch_array($result))
  	 			{
  	 			echo $row['Field']."<br>";
  	 			}

  	      }mysqli_free_result($result);
    	 	
		if ($_GET['data']=='tax')
    	 	{ 	$sql = "SHOW COLUMNS FROM tax";
    	 			$result = mysqli_query($db,$sql);
    	 			while($row = mysqli_fetch_array($result))
    	 			{
    	 			echo $row['Field']."<br>";
    	 			}

    	      }mysqli_free_result($result);
	    
		if ($_GET['data']=='AGOR')
	    	 	{ 	$sql = "SHOW COLUMNS FROM AGOR";
	    	 			$result = mysqli_query($db,$sql);
	    	 			while($row = mysqli_fetch_array($result))
	    	 			{
	    	 			echo $row['Field']."<br>";
	    	 			}

	    	      }mysqli_free_result($result);
  	    
		if ($_GET['data']=='seifa_lga')
  	    	 	{ 	$sql = "SHOW COLUMNS FROM SEIFA_LGA";
  	    	 			$result = mysqli_query($db,$sql);
  	    	 			while($row = mysqli_fetch_array($result))
  	    	 			{
  	    	 			echo $row['Field']."<br>";
  	    	 			}

  	    	      }mysqli_free_result($result);
				  
    	 if ($_GET['data']=='seifa_by_electorate')
					{
						echo "The ABS does not calculate SEIFA by electorate. I have calculated scores by averaging the scores for each postcode in each electorate using
							SEIFA by postcode<br>";
    	    	 		
						
				  		
				  			$sql = "SHOW COLUMNS FROM seifa_by_postcode";
				  			$result = mysqli_query($db,$sql);
				  			while($row = mysqli_fetch_array($result))
				  			{
				  			echo $row['Field']."<br>";
				  			}
		
		
				  		
					}mysqli_free_result($result);
					
		  		if ($_GET['data']=='privacy')
				{
		  			$sql = "SHOW COLUMNS FROM agencies";
		  			$result = mysqli_query($db,$sql);
		  			while($row = mysqli_fetch_array($result))
		  			{
		  			echo $row['Field']."<br>";
		  			}
		
		
		  		}mysqli_free_result($result);
		
}
	
	
?>

  

 
         
        

  
   

</div></div>
<div class='clear'></div>
 <?php 
    include('footer.php');?>

    </body>
</html>