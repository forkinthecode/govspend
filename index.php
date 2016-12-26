<?php
require'header.php';
?>



<div class='left'>
<h4>2015-16 FY Portfolio totals for General Government Spending </h4>
<!--<div class='box'>
<p>Click on <a class='button' href='#popup_search'>Quick Search</a> or click <img src='outcome_search_large.png' height='40px'></img> icons to drill down.</p> 
</div>
   <div id='popup_search'  class='overlay'>
            <div class='popup_search'>
                <div class='content' >
              <h2>Welcome to Australia's budget transparency project</h2>
              <p>Whack a postcode into the search box to find grants and tenders for that location or click<a class='close' href='#'>close</a></span>to display all budget data</p>
              <form class='overlaid' action='locality.php' target='_blank' method='GET'>
                                              <input type="text" name='Postcode' id='Postcode' placeholder="Search..." required>
                                              <button type="submit" id='submit' value="Submit">Go</button>

              </form>
                </div>
            </div>
    </div>-->

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

 
 

  <?php/*
  $query="SELECT * FROM tax_transparency GROUP BY ABN";
  $result = mysqli_query($db, $query );
  echo"<div class='source'>Source: Calculated from Historical Tenders data and Tax Transparency data published at data.gov.au </div>
 	 <div class='expand'>";
   while ($row = $result->fetch_assoc()) 
      {

  echo"
   
 <table class='wide' border='0'><tbody>
 <tr><td>Name            </td><td><a href='recipient.php?Recipient=".$row['Name']."' target='_blank'>".$row['Name']."</a></td></tr>
 <tr><td>ABN             </td><td><a href='recipient.php?ABN=".$row['ABN']."' target='_blank'>".$row['ABN']."</td></tr>
 <tr><td>Total Income    </td><td>$".number_format($row['Total_Income'])."</td></tr>
 <tr><td>Taxable Income  </td><td>$".number_format($row['Taxable_Income'])."</td></tr>
 <tr><td>Tax             </td><td>$".number_format($row['Tax'])."</td></tr>
 <tr><td>Value of Tenders</td><td>$".number_format($row['Value'])."</td> </tr>
  </tbody></table><br> ";
  }echo"< </div>";
 
 */
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
/*
$qery=" SELECT * FROM tenders_by_portfolio";
$result = mysqli_query($db, $qery );
echo"<h4>2015-16 FY Portfolio totals for Commonwealth Tenders Funding </h4> <table class='grants' ><tbody><tr><th>Portfolio</th><th>Value</th></tr>";
 while ($row = $result->fetch_assoc()) 
    {



   echo"

   <tr> <td><a href='portfolio.php?Portfolio=".$row['Portfolio']."'>".$row['Portfolio']."</a></td><td width='150px'><span style='float:right'>$".number_format($row['Funding'])."</span></td>
  </tr>
   
   ";


      }echo" </tbody></table><br>";

	 
	 */
	 ?>
   <?php
   //if ( isset($_GET['Agency']) )
    {

		/*

  echo"<h4>Commonwealth Tenders Totalled by Agency</h4>
  <p>(With approval dates within the 2015-16 financial year)</p>
  <div class='source'>Source: Historical Tenders data published at data.gov.au </div>";
  $agency_results = "SELECT Agency,sum(Value)  FROM tenders GROUP BY Agency ORDER BY sum(Value) DESC ";
  $result = mysqli_query($db, $agency_results );
  echo" <table class='wide' ><tbody><tr><th>Agency</th><th>Value</th></tr>";
   while ($row = $result->fetch_assoc()) 
      {



	   echo"

	   <tr><td width='150px'><span style='float:right'>$".number_format($row['sum(Value)'])."</span></td>
	   <td><a href='agency.php?Agency=".$row['Agency']."'>".$row['Agency']."</a></td></tr>
	   
	   ";

  
        }echo" </tbody></table><br>";*/
  }

  ?>

 
         
        

  
   

</div></div>
<div class='clear'></div>
 <?php 
    include('footer.php');?>

    </body>
</html>