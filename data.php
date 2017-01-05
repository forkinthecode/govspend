<?php
require'header.php';
?>



<div class='left'>



<h3>Open data sets used in GovSpend</h3>
Click on the dataset to see the fields it contains (as used in GovSpend)
<table class='basic'><tbody><tr><th>Dataset</th><th>Custodian</th><th>Published at</th></tr>

 <tr><td><a href='data.php?data=donations'>AEC political donations data</a></h4></td><td>Department of Finance</td><td>finance.gov.au</td></tr>
 <tr><td><a href='data.php?data=AGOR'>Australian Government Organisations Register</a></h4></td><td>Department of Finance</td><td>finance.gov.au</td></tr>
 <tr><td><a href='data.php?data=budget'>Federal Budget data 2015-16 FY</a></td><td>Department of Treasury</td><td>data.gov.au</td></tr>
<tr><td> <a href='data.php?data=acnc'>Australian Charities & Not for Profit Commission Charities Data</a></td><td>ACNC</td><td>data.gov.au</td></tr>
<tr><td> <a href='data.php?data=tax'>Tax Transparency Data</a></td><td>ATO</td><td>data.gov.au</td></tr>
<tr><td> <a href='data.php?data=tenders'>Commonwealth tenders</a></td><td>Finance</td><td>AusTenders, data.gov.au</td></tr>
<tr><td> <a href='data.php?data=grants'>Commonwealth agency grants</a></td><td>Individual agency sites, moving to grants.gov.au</td><td></td></tr>
<tr><td> <a href='data.php?data=welfare_by_electorate'>Welfare Recipients by Commonwealth Electoral Division</a></td><td>Department of Social Services</td><td>data.gov.au</td></tr>
<tr><td> <a href='data.php?data=lga_welfare'>Welfare Recipients by Local Government Area</a></td><td>Department of Social Services</td><td>data.gov.au</td></tr>
<tr><td> <a href='data.php?data=Indigenous_by_postcode'>Indigenous & Non-Indigenous population by Postcode</a> </td><td>ABS</td><td>ABS</td></tr>
<tr><td> <a href='data.php?data=seifa_by_electorate'>SEIFA by Commonwealth Electoral Division</a></td><td>ABS</td><td>ABS</td></tr>
<tr><td> <a href='data.php?data=seifa_lga'>SEIFA by Local Government Area</a></td><td>ABS</td><td>ABS</td></tr>
<tr><td> <a href='data.php?data=coordinates'>Postcode and coordinate information dataset</a></td><td>Datalicious</td><td>Datalicious</td></tr>

<tr><td> <a href='data.php?data=privacy'>Privacy alert agencies list</a></td><td>Attorney-General</td><td>Right to Know</td></tr></tbody>
</table>

 </div>
 <div class='right'>

<h3>Metadata Results of dataset</h3>

<?php
	
if (isset($_GET['data']))
{
	if ($_GET['data']=='donations')
	{
		$sql = "SHOW COLUMNS FROM donations";
		$result = mysqli_query($db,$sql);
		echo"
		<h3> Click <a href='download.php?donations' 
		download ='political_donations.csv'>here</a> to download CSV AEC political donations file</h3>";
		while($row = mysqli_fetch_array($result))
		{
		echo $row['Field']."<br>";
		}
	
	
	}mysqli_free_result($result);
	
////////////////////////////////////////////
		if ($_GET['data']=='budget')
		{
			$sql = "SHOW COLUMNS FROM budget_table15_16";
			$result = mysqli_query($db,$sql);
			echo"
			<h3> Click <a href='download.php?budget' 
			download ='budget15_16.csv'>here</a> to download CSV budget table 2015-16 file</h3>";
			while($row = mysqli_fetch_array($result))
			{
			echo $row['Field']."<br>";
			}
		
		
		}mysqli_free_result($result);
		
	
////////////////////////////////////////////	
	if ($_GET['data']=='acnc')
	{ 	$sql = "SHOW COLUMNS FROM charities";
			$result = mysqli_query($db,$sql);
			echo"
			<h3> Click <a href='charities.csv.zip'>here</a> to download CSV ACNC file</h3>";
			while($row = mysqli_fetch_array($result))
			{
			echo $row['Field']."<br>";
			}
			

     }mysqli_free_result($result);
////////////////////////////////////////////	 
 	if ($_GET['data']=='grants')
 	{ 	$sql = "SHOW COLUMNS FROM grants";
 			$result = mysqli_query($db,$sql);
			echo"
			<h3> Click <a href='download.php?grants' 
			download ='grants15_16.csv'>here</a> to download CSV Commonwealth Grants file</h3>";
 			while($row = mysqli_fetch_array($result))
 			{
 			echo $row['Field']."<br>";
 			}

      }mysqli_free_result($result);
////////////////////////////////////////////  	
	if ($_GET['data']=='tenders')
  	{ 	$sql = "SHOW COLUMNS FROM tenders";
  			$result = mysqli_query($db,$sql);
			echo"
			<h3> Click <a href='download.php?tenders' 
			download ='tenders15_16.csv'>here</a> to download CSV Commonwealth Tenders file</h3>";
  			while($row = mysqli_fetch_array($result))
  			{
  			echo $row['Field']."<br>";
  			}

       }mysqli_free_result($result);
	   
////////////////////////////////////////////   	
	if ($_GET['data']=='welfare_by_electorate')
   	{ 	$sql = "SHOW COLUMNS FROM welfare_by_electorate";
   			$result = mysqli_query($db,$sql);
			echo"
			<h3> Click <a href='download.php?welfare_by_electorate' 
			download ='welfare_by_electorate.csv'>here</a> to download CSV Welfare Recipients by Electorate file</h3>";
   			while($row = mysqli_fetch_array($result))
   			{
   			echo $row['Field']."<br>";
   			}

        }mysqli_free_result($result);
		
////////////////////////////////////////////	 
		if ($_GET['data']=='lga_welfare')
		{ 	$sql = "SHOW COLUMNS FROM lga_welfare";
				$result = mysqli_query($db,$sql);
				echo"
				<h3> Click <a href='download.php?lga_welfare' 
				download ='lga_welfare.csv'>here</a> to download CSV Welfare Recipients by LGA file</h3>";
				while($row = mysqli_fetch_array($result))
				{
				echo $row['Field']."<br>";
				}

	     }mysqli_free_result($result);
		 
////////////////////////////////////////////	 	
		if ($_GET['data']=='Indigenous_by_postcode')
	 	{ 	$sql = "SHOW COLUMNS FROM suburb_by_Indigenous";
	 			$result = mysqli_query($db,$sql);
				echo"
				<h3> Click <a href='download.php?Indigenous' 
				download ='Indigenous_by_postcode.csv'>here</a> to download CSV Indigenous by Postcode file</h3>";
	 			while($row = mysqli_fetch_array($result))
	 			{
	 			echo $row['Field']."<br>";
	 			}

	      }mysqli_free_result($result);
		  
////////////////////////////////////////////  	 	
		if ($_GET['data']=='coordinates')
  	 	{ 	$sql = "SHOW COLUMNS FROM coordinates";
			echo"
			<h3> Click <a href='download.php?coordinates' 
			download ='coordinates.csv'>here</a> to download CSV coordinates by Postcode file</h3>";
  	 			$result = mysqli_query($db,$sql);
  	 			while($row = mysqli_fetch_array($result))
  	 			{
  	 			echo $row['Field']."<br>";
  	 			}

  	      }mysqli_free_result($result);
    	 	
////////////////////////////////////////////
		if ($_GET['data']=='tax')
    	 	{ 	$sql = "SHOW COLUMNS FROM tax";
    	 			$result = mysqli_query($db,$sql);
					echo"
					<h3> Click <a href='download.php?tax' 
					download ='tax_transparency.csv'>here</a> to download CSV ATO tax transparency file</h3>";
    	 			while($row = mysqli_fetch_array($result))
    	 			{
    	 			echo $row['Field']."<br>";
    	 			}

    	      }mysqli_free_result($result);
			  
////////////////////////////////////////////
		if ($_GET['data']=='AGOR')
	    	 	{ 	$sql = "SHOW COLUMNS FROM AGOR";
	    	 			$result = mysqli_query($db,$sql);
						echo"
						<h3> Click <a href='Register_of_Agencies.csv.zip'>here</a> to download CSV Register of Agencies file</h3>";
	    	 			while($row = mysqli_fetch_array($result))
	    	 			{
	    	 			echo $row['Field']."<br>";
	    	 			}

	    	      }mysqli_free_result($result);
				  
////////////////////////////////////////////
		if ($_GET['data']=='seifa_lga')
  	    	 	{ 	$sql = "SHOW COLUMNS FROM SEIFA_LGA";
  	    	 			$result = mysqli_query($db,$sql);
						echo"
						<h3> Click <a href='download.php?seifa_lga' 
						download ='SEIFA_by_LGA.csv'>here</a> to download CSV SEIFA by LGA file</h3>";
  	    	 			while($row = mysqli_fetch_array($result))
  	    	 			{
  	    	 			echo $row['Field']."<br>";
  	    	 			}

  	    	      }mysqli_free_result($result);
				  
////////////////////////////////////////////				  
    	 if ($_GET['data']=='seifa_by_electorate')
					{
			  			$sql = "SHOW COLUMNS FROM seifa_by_postcode";
			  			$result = mysqli_query($db,$sql);
						echo "The ABS does not calculate SEIFA by electorate. I have calculated scores by averaging the scores for each postcode in each electorate using
							SEIFA by postcode<br>";
   						echo"
   						<h3> Click <a href='download.php?seifa_by_electorate' 
   						download ='seifa_by_postcode.csv'>here</a> to download CSV SEIFA by Postcode file</h3>";
   			  			while($row = mysqli_fetch_array($result))
   			  			{
   			  			echo $row['Field']."<br>";
   			  			}

   			       }mysqli_free_result($result);
		
		
////////////////////////////////////////////
					
		  		if ($_GET['data']=='privacy')
				{
		  			$sql = "SHOW COLUMNS FROM agencies";
		  			$result = mysqli_query($db,$sql);
					echo"
					<h3> Click <a href='download.php?privacy' 
					download ='privacy.csv'>here</a> to download CSV Privacy Alert file</h3>";
		  			while($row = mysqli_fetch_array($result))
		  			{
		  			echo $row['Field']."<br>";
		  			}
		
		
		  		}mysqli_free_result($result);
///////////////////////////////////////////////				
			

				   
			   
}
	
	
?>
<p>Click on the name of the dataset to see fields in GovSpend version or to get download link.</p>
  

 
         
        

  
   

</div></div>
<div class='clear'></div>
 <?php 
    include('footer.php');?>

    </body>
</html>