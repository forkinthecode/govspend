<?php
require'header.php';
?>

<div id='chart'></div>

<div class='left'>
  	 <?php/*
  	  if( !isset($_GET['Portfolio']) && !isset($_GET['Program']) && !isset($_GET['Component']) )
  	  {
  	 $portfolio=$_GET['Portfolio'];
  	                             $total_current = "SELECT current,sum(current) FROM `budget_table15_16` ";
  	                                $result = mysqli_query($db, $total_current );
                                                   
  	                             while ($row = $result->fetch_assoc()) 
  	                             $total_current = $row['sum(current)'];//assigns this value to a variable.
  	                             ///////////////////////////////////////////
  	                             $query_total_last = "SELECT last,sum(last) FROM `budget_table15_16` 
  	                             ";//calculates total fundingfor the prior budget year for agencies where search term forms part of their name
  	                             $result = mysqli_query($db, $query_total_last);
                                                    
  	                             while ($row = $result->fetch_assoc()) 
  	                             $query_total_last_year = $row['sum(last)'];//assigns this value to a variable.
  	                             ////////////////////////////////////////////////////////////////////
  	                             $query_total_current = "SELECT current,sum(current) FROM  `budget_table15_16`
  	                              ";//calculates total fundingfor current year for agencies with search term in name
  	                             $result = mysqli_query($db, $query_total_current );
                                                    
  	                             while ($row = $result->fetch_assoc()) 
  	                             $query_total_current_year = $row['sum(current)'];//assign this value to a variable

  	                             //////////////////////////////////////////////////////////////////////////////////////////
  	                             $percent = (($query_total_current_year/$total_current)*100);//$percent variable is used in scripts/tax_totals.php and the Flot pie graph
  	                             //////////////////////////////////////////////////////////////////////////////////////////

  	                             $billion_ = "SELECT current,sum(current) FROM `budget_table15_16`
  	                            ";
  	                             $result = mysqli_query($db, $billion_ );
  	                                                          @$num_results = mysqli_num_rows($result);
  	                             while ($row = $result->fetch_assoc()) 
  	                              $value = $row['sum(current)'];
  	                              $billion = ($value/1000000); //divides this year's value by 1 m
  	                             ///////////////////////////////////////////////////////////////////////


  	                             $actual_PIT = $query_total_current_year * 0.00000048;           //divides current year's value into proportion that comes FROM personal income tax
  	                             $PIT = ($actual_PIT/$total_current)*100/1;         //finds percentage actual_PIT is of the whole 
  	                             $actual_TOS = $query_total_current_year * 0.00000052;           //divides current year value into proportion that comes FROM company tax etc
  	                             $TOS = ($actual_TOS/$total_current)*100/1;
  	                             ///////////////////////////////////////////////////////////////////
  	                             {
                       

  	 						   	 echo"<h3>Total GSF Program Costs</h3><hr><table class='stats'>
  	 						   	 <tr><th>Total</th><th>Corporate Taxes</th><th>Personal Taxes</th></tr>
  	 						   	 <tr><th><h3>$".number_format($billion, 3)." B</h3></th>
  	 						   	 <th><h3>$".number_format($actual_TOS,3)." B</h3></th>
  	 						   	 <th><h3>$".number_format($actual_PIT, 3)." B</h3></th>

  	 						   	</tr></table><hr><div class='source'>Source: Calculated based on figures in budget documents</div>";
  	                                }
  	 }*/
  	                             ?>

  <?php/*
  $query="SELECT sum(Total_Income),sum(Taxable_Income),sum(Tax) FROM tax ";
  $result = mysqli_query($db, $query );
  echo"<br><br>
 	 <table class='stats' ><tbody><tr><th>Total Income</th><th>Taxable Income</th><th>Tax</th></tr>";
   while ($row = $result->fetch_assoc()) 
      {

  echo"
   

 <tr><td>$".number_format($row['sum(Total_Income)'])."</td>
 <td>$".number_format($row['sum(Taxable_Income)'])."</td>
<td>$".number_format($row['sum(Tax)'])."</td></tr>

   ";
  }echo"</tbody></table><div class='source'>Source: Calculated from ATO tax transparency dataset </div><br>";
 
 */
  ?>
<h3>2015-16 FY Portfolio totals for General Government Spending </h3>
<?php
$total = "SELECT *,sum(current) FROM `budget_table15_16` group by Portfolio ORDER BY sum(current) DESC ";
$result = mysqli_query($db, $total );
echo"<div class='source'>Source: Calculated from Line item CSV 
Portfolio Budget Statements published at <a href='http://data.gov.au/dataset/budget-2015-16-tables-and-data'>data.gov.au</a></div><table class='wide' border='0'><tbody>";
 while ($row = $result->fetch_assoc()) 
    {

echo"
  <tr>


 <td><a href='portfolio.php?Portfolio=".$row['Portfolio']."'>".$row['Portfolio']."</td><td> $".number_format($row['sum(current)']).",000</td> 
</tr>
 ";
}echo"</tbody></table><br> ";

?>

       <h4>Notes</h4>

<p>GovSpend is a prototype only, built to bring together existing data and knowledge of budget transparency in Australia to
	inform further planning on this topic.</p>
	<h4>About Budget Data</h4>
<p>Government announces the budget in Portfolio Budget Statements and exports this to a line item CSV each May after the appropriation bills have passed the Senate. 
		Policy changes with budget implications made after this initial
		publication are reported at Agency websites in Portfolio Additional Estimate Statements (PAES) and 
		 announced at the Mid Year Economic & Fiscal Outlook (MYEFO) 
		every December.</p>
<p> The Final Budget Outcome (FBO) for the prior financial year is reported with MYEFO in December.
		Neither PAES, MYEFO or FBO are available in machine readable open data excepting PAES for the 2014-15 FY.</p>
<p>The totals for spending reported in May budgets are known as '<i>Estimated Actuals</i>' because they are published in budget papers a few weeks 
			before the end of the financial year and so are <i>estimates</i>. The only place '<i>Actual Actuals</i>' are reported at line item level are in Agency annual reports and the 
			data from these is not open or machine readable.</p>
<p>Final Budget Outcome contains only aggregated Actual Actuals.</p>
<p>The standard for reporting government spending for international comparison is called General Financial Statistics. The International Monetary Fund provides a <a href='https://www.imf.org/external/pubs/ft/gfs/manual/'>manual</a> for application of GFS.
The breakdown of the budget by GFS is carried out by the <a href='http://www.abs.gov.au/ausstats%5Cabs@.nsf/0/1DBBBC285631C890CA2570B400176149'>ABS</a>.</p>
<p>While The Australian Government Organstions Register contains GFS Sub-Function Classification, this is only provided at Agency level so there is 
				no way to know which Programs are totaled in budget documents to form the aggregate totals by GFS Function in Budget Paper 1.</p>
<p>This means that budget transparency projects can not provide drill down by GFS Sub-Function as each Agency will usually deliver outcomes across
					more than one Sub-Function.</p>
 
	<h4>Commonwealth Grants</h4>
	<p>    Grants data is taken from multiple Commonwealth agency sites and there is no guarantee that 
	    it is correct in the database. The prototype is to give an idea of what can be done with open financial data.</p>
	 <p>Some grants cover more than one location and/or cross political boundaries. Some grants apply state-wide or nationally. Where funding can not be attributed to a single location or electorate, these fields are left blank.</p>
	 <p>Where funding is attributable to a single location (postcode) or political area (LGA or Federal Electorate) you can click on these fields to get results using that criteria. Commonwealth grants data does not contain ABN so can not be matched or searched on this identifying information</p>

<h4>Commonwealth Tenders</h4>

  <p>Commonwealth tenders data does not contain the program name under which the tender has been made. 
	  This means that users can drill down and search grants data by Portfolio, Agency, Program & Component but with tenders data the breakdown is only
	  available by Portfolio & Agency.</p>
	  <p>Commonwealth tenders data does not currently contain LGA or electorate information for where the money will be spent. I can insert into this information
		  into this dataset but it is worth noting this is based on the address of the tender recipient rather than the address where the money will be spent or the service will be applied by the supplier.</p>

 
           

     
 </div>
 <div class='right'>
	<br>
   	<?php
     //if ( isset($_GET['Cuts'])   )
     {
   	  $query="SELECT sum(last),sum(current) FROM budget_table15_16 ";
   	  $result = mysqli_query($db, $query );
	  echo"Click on increases or cuts to display individual components<table class='basic'>";
   	   while ($row = $result->fetch_assoc()) 
   	      {
			  
   			  echo"<tr><th>2014-15 Total</th><th>$".number_format($row['sum(last)']).",000</th></tr>";
			  echo"<tr><th>2015-16 Total</th><th>$".number_format($row['sum(current)']).",000</th></tr>";
			  echo"<tr><th>Difference</th><th>$".number_format($row['sum(current)']-$row['sum(last)']).",000</th></tr>";
   		  }
		
	  
	  
	   	  $query="SELECT sum(current-last) as increases FROM budget_table15_16 where current>last";
	   	  $result = mysqli_query($db, $query );

	   	   while ($row = $result->fetch_assoc()) 
	   	      {
			  
	   			  echo"<tr><th><a href='index.php?Increases=Increases'>Total Increases</a></th><th>$".number_format($row['increases']).",000</th></tr>";
				 
	   		  }
			
			  $query="SELECT sum(last-current) as cuts FROM budget_table15_16 where last>current";
			  $result = mysqli_query($db, $query );

			   while ($row = $result->fetch_assoc()) 
			      {
			  
					  echo"<tr><th><a href='index.php?Cuts=Cuts'>Total Cuts</a></th><th>$".number_format($row['cuts']).",000</tr>";
				  }
				  echo"</table>";
			
	  }
	  
	  ?>
	  
 	<?php
   if ( isset($_GET['Increases'])   )
   {/*
 	  $query="SELECT sum(current-last) as increases FROM budget_table15_16 where current>last";
 	  $result = mysqli_query($db, $query );

 	   while ($row = $result->fetch_assoc()) 
 	      {
			  
 			  echo"<h1>Total of increases: $".number_format($row['increases']).",000</h1>";
 		  }*/
	   
 	  $query="SELECT * FROM budget_table15_16 where current >last ORDER BY current-last DESC ";
 	  $result = mysqli_query($db, $query );
	   @$num_results = mysqli_num_rows($result);
 	echo"<h4>$num_results Components have been increased in funding</h4><div class='expand'>";
 	   while ($row = $result->fetch_assoc()) 
 	      {

 			  echo"<table class='basic'><tbody>
 
 			    <tr><td width='150px'>Component</td><td>".$row['Component']."</td></tr>
 
 			    <tr><td>Appropriation Type</td><td> ".$row['Appropriation_Type']."</td></tr>
			   <tr><td>2014-15</td><td><span class='right'>$".number_format($row['last']).",000</span></td></tr>
		    <tr><td>2015-16</td><td><span class='right'>$".number_format($row['current']).",000</span></td></tr>
		      <tr><td>Difference</td><td><span class='right'>$".number_format($row['current']-$row['last']).",000</span></td></tr>
  

 			   </tbody></table><br><br> ";
	
		  
 		  }echo"</div>Mouse/Scroll for more<br>";
	  
   }
  
   ?>
	<?php
 if ( isset($_GET['Cuts'])   )
  {/*
	  $query="SELECT sum(last-current) as cuts FROM budget_table15_16 where last>current";
	  $result = mysqli_query($db, $query );

	   while ($row = $result->fetch_assoc()) 
	      {
			  
			  echo"<h1>Total of cuts: $".number_format($row['cuts']).",000</h1>";
		  }*/
	
	  $query="SELECT * FROM budget_table15_16 where last >current ORDER BY last-current DESC ";
	  $result = mysqli_query($db, $query );
   @$num_results = mysqli_num_rows($result);
	echo"<h4>$num_results Components have been cuts in funding</h4><div class='expand'>";
	   while ($row = $result->fetch_assoc()) 
	      {

			  echo"<table class='basic'><tbody>
 
			    <tr><td width='150px'>Component</td><td>".$row['Component']."</td></tr>
 
			    <tr><td>Appropriation Type</td><td> ".$row['Appropriation_Type']."</td></tr>
				   <tr><td>2014-15</td><td><span class='right'>$".number_format($row['last']).",000</span></td></tr>
			    <tr><td>2015-16</td><td><span class='right'>$".number_format($row['current']).",000</span></td></tr>
			      <tr><td>Difference</td><td><span class='right'>$".number_format($row['current']-$row['last']).",000</span></td></tr>
  

			   </tbody></table><br><br> ";
	
		  
		  }echo"</div>Mouse/Scroll for more<br>";
	  
  }
  
  ?>
	   
  <?php/*
  $query="SELECT * FROM revenue where id='24' ";
  $result = mysqli_query($db, $query );
  echo"<br><br>
 	 <table class='stats' ><tbody><tr><th>Taxation Revenue</th></tr>";
   while ($row = $result->fetch_assoc()) 
      {

  echo"
   

 <tr>
 <td>$".number_format($row['2015_16']).",000</td>
</tr>

   ";
  }echo"</tbody></table><div class='source'>Source: Budget Paper 1: 
  Statement 4-Supplementary Budget Tables 2015-16 on data.gov.au</div><br>";
 
 
  ?>
    <?php
    $query="SELECT * FROM revenue where id='24' ";
    $result = mysqli_query($db, $query );
    echo"<br><br>
   	 <table class='stats' ><tbody><tr><th>Taxation Revenue</th></tr>";
     while ($row = $result->fetch_assoc()) 
        {

    echo"
   

   <tr>
   <td>$".number_format($row['2015_16']).",000</td>
  </tr>

     ";
    }echo"</tbody></table><div class='source'>Source: Budget Paper 1: 
    Statement 4-Supplementary Budget Tables 2015-16 on data.gov.au</div><br>";
 
 */
    ?>
	
	<?php
  if ( !isset($_GET['Cuts']) && !isset($_GET['Cuts'])  )
  {
	  echo"
	<h4>Structure of Government and Data</h4>
	<p>Structure of the Commonwealth budget: <a href='portfolio.php'>Portfolio</a>-><a href='agency.php'>Agencies</a>-><a href='programs.php'>Programs</a>->Component/Sub-Program-><a href='grants.php'>Grants</a> & <a href='tenders.php'>Tenders</a></p>
	    <p>The term Component and Sub-Program are used interchangeably by the government to refer to the smallest financial grain in the federal budget papers.</p>
	<p>Sometimes the Program and Component/Sub-Program name are identical in the budget documents or left blank in the open dataset. Where it is left blank it is assumed to be identical to Program name.</p>
	 
	 <h4>Federal State Relations</h4>
	<p>It is worth noting that states receive the majority of their funding from the Commonwealth via programs administered by
		 Treasury and are responsible for the majority of social services such as education, policing, health and housing. This situation is called vertical inequality. </p>
	<p>Differences between state and territory ability to raise revenue are known as horizontal inequality.</p>
	<p>During WW2 the Commonwealth government took away from the states their right to raise their own revenue, effectively making them dependent 
			 on the Commonwealth for funding.<p>
	<p>It is the job of the Commowealth to manage both vertical and horizontal inequalities through its grants to the states.</p>
	<p>The Commonwealth also has responsibility for income support programs which account for approximately half of all Commonwealth
		  government spending.</p>
	<p>This amount can be further divided between Aged Pension, the current total for which approximates the spend on all other <a href='program.php'>income support programs</a> combined.</p>
    <p>It was in pursuit of such basic facts about government spending that I originally embarked on open data financial transparency projects.</p>
		
		<h4>Commonwealth Organisations</h4>
		 <p>Commonwealth budget papers and data derived from them contains funding information for for government 
			 organisations with the General Financial Statistical classification of General Government Spending (GGS).</p>
		<p>This means there are more government organisations in the Australian Government Registor of Organisations (AGOR) than there are agencies 
				 in the Portfolio Budget Statements & related data.</p>
		<p>Where there is no budget data for an organisation it is because it is not a GGS organisation and not included in budget documents.</p>
	
	
	
<p>Further reading on Commonwealth budget information is at:</p>
<ul>
	<li><a href='https://www.deepdyve.com/lp/wiley/history-of-federal-state-fiscal-relations-in-australia-a-review-of-the-OgnB09BHUy'>History of Federal State Fiscal Relations</a></li>
	<li><a href='http://www.aph.gov.au/About_Parliament/Parliamentary_Departments/Parliamentary_Library/Publications_Archive/archive/BudgetGuide#Where%20to%20Start'>APH Budget Guide</a></li>

 </ul>";
 
}

?>
	<!--
<h4>2015-16 FY Portfolio totals for Commonwealth Grants Funding </h4>
<?php/*
$total = "SELECT Portfolio,sum(Funding) FROM `grants` WHERE Year='2015-16' && Portfolio !='' 
group by Portfolio ORDER BY sum(Funding) DESC ";
$result = mysqli_query($db, $total );
echo"
 <table class='grants' border='0'><tbody>";
 while ($row = $result->fetch_assoc()) 
    {

echo"
 
  <tr><td><a href='portfolio.php?Portfolio=".$row['Portfolio']."'>".$row['Portfolio']."</td><td>$".number_format($row['sum(Funding)'])."</td></tr>
";
}echo" </tbody></table><br><div class='source'>Source: Grants data published at agency websites</div><hr class='short'><br> ";

?>

<?php

$qery=" SELECT Portfolio,sum(Value) FROM tenders WHERE Portfolio!='' group by Portfolio order by sum(Value) DESC";
$result = mysqli_query($db, $qery );
echo"<h4>2015-16 FY Portfolio totals for Commonwealth Tenders Funding </h4> <table class='grants' ><tbody><tr><th>Portfolio</th><th>Value</th></tr>";
 while ($row = $result->fetch_assoc()) 
    {



   echo"

   <tr> <td><a href='portfolio.php?Portfolio=".$row['Portfolio']."'>".$row['Portfolio']."</a></td>
   <td width='150px'><span style='float:right'>$".number_format($row['sum(Value)'])."</span></td>
  </tr>
   
   ";


      }echo" </tbody></table><br>";
*/
	 
	 
	 ?>-->
       
        

 <form action="search.php">

     <input type="text" id="ABN" name="ABN" placeholder="ABN" > <button type="submit" id='submit' value="Submit"> Find </button>
 </form>

     <form action="search.php">
     <input type="text" id="Name" name="Name" placeholder="organisation key word eg woolworths" > <button type="submit" id='submit' value="Submit"> Find </button>
 </form>

      <form action="search.php">
	  <input type="text" id="Program" name="Program" placeholder="program key word eg health" > <button type="submit" id='submit' value="Submit"> Find </button>
  </form>

      <form action="search.php">
	  <input type="text" id="Electorate" name="Electorate" placeholder="Federal Electorate" > <button type="submit" id='submit' value="Submit"> Find </button>
  </form>

      <form action="search.php">
	  <input type="text" id="Council" name="Council" placeholder="Council" > <button type="submit" id='submit' value="Submit"> Find </button>
   </form>
      <form action="search.php">
	  <input type="text" id="Postcode" name="Postcode" placeholder="Postcode" > <button type="submit" id='submit' value="Submit"> Find </button>
   </form>
   

</div></div>
<div class='clear'></div>
 <?php 
    include('footer.php');?>

    </body>
</html>