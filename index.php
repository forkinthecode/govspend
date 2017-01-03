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

<p>GovSpend is a prototype only. Federal electorate details may be out of date.
  Grants data is taken from multiple Commonwealth agency sites and there is no guarantee that 
  it is correct in the database. The prototype is to give an idea of what can be done with open financial data.</p>
<p>Structure of the Commonwealth budget: Portfolio->Agencies->Programs->Component/Sub-Program->Grants & Tenders</p>
    <p>The term Component and Sub-Program are used interchangeably by the government to refer to the smallest financial grain in the federal budget papers.</p>
<p>Sometimes the Program and Component/Sub-Program name are identical in the budget documents or left blank in the open dataset. Where it is left blank it is assumed to be identical to Program name.</p>
<p>Some grants cover more than one location and/or cross political boundaries. Some grants apply state-wide or nationally. Where funding can not be attributed to a single location or electorate, these fields are left blank.</p>
<p>Where funding is attributable to a single location (postcode) or political area (LGA or Federal Electorate) you can click on these fields to get results using that criteria.</p>



 

 

 </div>
 <div class='right'>

	   
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
<h4>2015-16 FY Portfolio totals for Commonwealth Grants Funding </h4>
<?php
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

	 
	 
	 ?>
       
        

  
   

</div></div>
<div class='clear'></div>
 <?php 
    include('footer.php');?>

    </body>
</html>