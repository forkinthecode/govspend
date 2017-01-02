<?php
require'header.php';
?>



<div class='left'>

<h3>Open data and financial transparency</h3>
<p>Financial information can be broken into two broad groups: top down data and bottom up data.</p>
<p>Top down data are federal, state or local budgets. This information does not tell who ends up with the money. Top down data tells us which agencies are responsible for which programs and their total costs. 
	
</p>

<?php
 

$budget = "SELECT sum(last),sum(current),sum(plus1) FROM `budget_table15_16`
 WHERE Agency LIKE'%prime%' ";
$result = mysqli_query($db, $budget );
@$num_results = mysqli_num_rows($result);
 echo"<h3>Budget totals for the Department of Prime Minister and Cabinet</h3>
	<div class='source'>Source: Calculated using line item CSV 
Portfolio Budget Statements published at <a href='http://data.gov.au/dataset/budget-2015-16-tables-and-data'>data.gov.au</a></div>
	 <table class='wide'><tbody>";
 while ($row = $result->fetch_assoc()) 
    {
      
   
echo"
  <tr><td>2014-15 Total</td><td>$".number_format($row['sum(last)']).",000</td></tr>
  <tr><td>2015-16 Total</td><td>$".number_format($row['sum(current)']).",000</td></tr>
  <tr><td>2016-17 Total</td><td>$".number_format($row['sum(plus1)']).",000</td></tr>
 
  ";
    }echo"</tbody></table><br>";
       

	?>
	<p>	Top down data tells us whether the cost is an administrative departmental expense or whether it is an annual appropriation Act for transfer payments (welfare payments).</p>
	<p>Top down data can be broken into support for administration spending and grants and tenders.</p>
	<?php
	$agor = "SELECT *,sum(current) FROM `budget_table15_16`
	 WHERE Agency LIKE'%Prime Minister and Cabinet%' GROUP BY Program ORDER by sum(current) DESC LIMIT 1";
	$result = mysqli_query($db, $agor );
	@$num_results = mysqli_num_rows($result);


	  
	echo"<h4>Programs administered by the Prime Minister and Cabinet</h2><div class='source'>Source: Calculated from Line item CSV 
	Portfolio Budget Statements published at <a href='http://data.gov.au/dataset/budget-2015-16-tables-and-data'>data.gov.au</a></div>
		";
	 while ($row = $result->fetch_assoc()) 
	    {
      
   
	echo"<table class='wide'><tbody>
 
	  <tr><td>".$row['Program']."</td>
	  <td width='150px'>$".number_format($row['sum(current)']).",000</td></tr> </tbody></table>

	  ";
  }
	
	?>
<p>Bottom up data tells us who actually receieved the grant for program y, administered by agency z.</p>
	   <?php
	 
	    {

	  echo"
	  <div class='source'>Source: Historical Tenders data published at data.gov.au </div>";
	  $seifa = "SELECT *  FROM grants WHERE Program like'%Jobs, Land and Economy%' 
		  LIMIT 1 ";
	  $result = mysqli_query($db, $seifa );
	    @$num_results = mysqli_num_rows($result);
	  
	 	
	   while ($row = $result->fetch_assoc()) 
	      {

	  echo"
	 	 <table class='basic' ><tbody>
	    <tr><td width='150px'>Agency</td><td>".$row['Agency']."</td></tr>
	    <tr><td width='150px'>Name</td><td>".$row['Recipient']."</td></tr>
		  <tr><td width='150px'>Address</td><td>".$row['Locality'].", ".$row['State']."</td></tr>
	    <tr><td width='150px'>Purpose</td><td>".$row['Purpose']."</td></tr>
	 <tr><td>Value</td><td> <span class='right'>$".number_format($row['Funding'])."</span></td>    </tr>

	 </tbody></table>
	  ";
	  
	  }
	  }

	  ?>
<p>When I built my first budget transparency project, there was next to no open financial information. I had to copy-paste over 2,500 lines to create the first
	line-item break down of federal budget spending. My schema was utilised by the Department of Finance when the Commonwealth budget was released as open data for the first time in 2014. 
	Without this input the line item CSV would not exist and there would only be the 140+ excel files (one for each agency) without the breakdown to the finest grain in the buget.</p>
	<p>Prior to this first release of the federal budget in 2014, the federal budget had only been made available in 20 PDF's or Word Docs (1 for each portfolio).</p>
	<p>Bottom up data has been available for longer at a federal level with Commonwealth tenders being available online for many years. </p>
	<p>The opening of Commonwealth grants has had a long and winding road with the government only now implementing a system to publish all Commonwealth grants
		from one site in a similar fashion to Austenders.</p>
	<p>In the lead up to the launch of grants.gov.au the government sought to have all federal agencies who administer grants publish them online at each
		agency website. This was only occuring in the past year or so. Open grants data across all federal agencies is a new step for the government.</p>
		<p>The grants data I use in GovSpend was collected by me from multiple agency websites and compiled into one file.</p>
 </div>
 <div class='right'>


<p>Creating a database to allow people to drill down through the portfolios, agencies, programs and components to see where money ends up relies on
	the data being open and having similar fields and granularity.</p>
<p>Commonwealth Tenders data has ABN & agency information but no program information. So we can know which agency created a tender but we can not know which program in the budget
	that tender applies to.</p>
<p>Commonwealth grants data has agency and program information but 
	no ABN. We can know which agency and program administers each grant but not the ABN for the grant recipient, only a name.</p>
<p>	Both grants and tenders use free text input fields for tender/grant applicant which means that over a period of time the same applicant will spell their
	organisation name in any number of different ways. </p>
	
	<p>We have seen recently with the Centrelink debt data matching issues the difficulties that poor data quality creates when integrating data.</p>
	<p>This means that we can put in an ABN and find all the tenders to that ABN but not the grants. Or we can put in a name and may not get all the 
		
		grants and tenders for that business name because it has been spelled several different ways throughout the data.</p>
		<p>Unlike the government however, if I created a matching process that claimed that different spellings were actually different businesses, I would be 
			held accountable for this, it would be seen as a fault in my design. I can not make the kinds of mistakes that the government is making with impunity.</p>
	<p>Financial transparency projects are basically data integration projects and have to be designed to deal with data quality issues and in doing so can also demonstrate
		the need for more and better financial data to be opened for these projects.</p>
	
   <p> My submissions to the Open Government Partnership National Action Plan and the Productivity Commission's Data Inquiry seek
	   the government's support in filling in some of the blanks. These submissions also ask the government to provide data for the purposes of transparency in government spending to organisations
	   as opposed to focusing on data integration projects to focus on impoverished and vulnerable people.</p>

</div></div>
<div class='clear'></div>
 <?php 
    include('footer.php');?>

    </body>
</html>