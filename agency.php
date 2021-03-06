<?php
require'header.php';
?>


        <div class="left">

   
<?php
 if ( !isset($_GET['Agency'])  )
 {

$budget = "SELECT Portfolio,Agency,sum(current) FROM `budget_table15_16` GROUP BY Agency order by sum(current) DESC";
$result = mysqli_query($db, $budget );
@$num_results = mysqli_num_rows($result);
 echo"<h3>Budget totals for all Agencies</h3><div class='expand'>
		<div class='source'>Source: Calculated using line item CSV 
	Portfolio Budget Statements published at <a href='http://data.gov.au/dataset/budget-2015-16-tables-and-data'>data.gov.au</a></div>
	 <table class='basic' ><tbody> <tr><th>Agency</th><th>Total Cost</th></tr>";
 while ($row = $result->fetch_assoc()) 
    {
      
   
echo"
 
<tr><td><a href='portfolio.php?Portfolio=".$row['Portfolio']."'>".$row['Portfolio']."</a></td><td><a href='agency.php?Agency=".$row['Agency']."'>".$row['Agency']."</a></td><td>$".number_format($row['sum(current)']).",000</td></tr>
  ";
    }echo"</tbody></table></div><div class='clear'></div>
		<div class='scroller'>
				<p>Mouse over/scroll for more results</p></div><br>";
       
}
	?>
  



<?php
 if ( isset($_GET['Agency'])  )
 {
$agency=$_GET['Agency'];
	
$budget_test = "SELECT Agency FROM `budget_table15_16`
 WHERE Agency LIKE'%$agency%'";
$result = mysqli_query($db, $budget_test );
@$num_results = mysqli_num_rows($result);

        if ($num_results>0) 
        {

$budget = "SELECT sum(last),sum(current),sum(plus1) FROM `budget_table15_16`
 WHERE Agency LIKE'%$agency%' ";
$result = mysqli_query($db, $budget );
@$num_results = mysqli_num_rows($result);
 echo"<h3>Budget totals for $agency</h3>
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
       }
}
	?>
	<?php
	 if ( isset($_GET['Agency'])  )
	 {
 $agency= $_GET['Agency'];
	$agor = "SELECT Agency FROM `agencies` WHERE agency LIKE'%$agency%' group by Agency";
	$result = mysqli_query($db, $agor );
	 @$num_results = mysqli_num_rows($result);
    if ($num_results >0)
    {
	 while ($row = $result->fetch_assoc()) 
	    {
			echo"<div class='privacy' style='background:#eee;padding:10px'>Privacy Alert:<a href='../snitch/datasets.php' target='_blank'> ".$row['Agency']." has applied for warrentless access to telecommunications metadata</a></div>
	
			  ";
		 }
	}	 
	}mysqli_free_result($result);
	?>
<?php
 if ( isset($_GET['Agency'])  )
 {
  
$agency=$_GET['Agency'];
$agor = "SELECT * 
FROM  `AGOR` 
WHERE Agency LIKE '%$agency%'";
$result = mysqli_query($db, $agor );
 @$num_results = mysqli_num_rows($result);
echo"<h3>Government Register of Organisations Results</h3>
	<h4>$num_results organisations matching $agency</h4>
<div class='source'>Source: <a href='http://www.finance.gov.au/resource-management/governance/agor/'>Australian Government
 Organisations Register</a></div>
	<div class='expand'>";
 while ($row = $result->fetch_assoc()) 
    {
		echo"<table class='wide' ><tbody>
			 <tr><th>Organisation</th>  </tr><tr>       <td><a href='agency.php?Agency=".$row['Agency']."'>".$row['Agency']."</a></td></tr>
		 <tr><th>Portfolio</th>  </tr><tr>       <td><a href='portfolio.php?Portfolio=".$row['Portfolio']."'>".$row['Portfolio']."</a></td></tr>
  <tr><th>Description</th>  </tr><tr>       <td><div class='description'>".$row['Description']."</div></td></tr>
  <tr><th>GFS Sub-Functions</th> </tr><tr>     <td>".$row['GFS_Function']."</td></tr>
  <tr><th>Strategic Plan</th>   </tr><tr>      <td><div class='source'><a href='".$row['Strategic_Plan']."' target='_blank'>".$row['Strategic_Plan']."</a></div></td></tr>
  <tr><th>Annual Report</th>    </tr><tr>      <td><div class='source'><a href='".$row['Annual_Reports']."' target='_blank'>".$row['Annual_Reports']."</a></div></td></tr>
  <tr><th>Auditor</th>    </tr><tr>      <td>".$row['Auditor']."</td></tr>
		</tbody></table><br>  ";
		  echo"";
	 }echo"</div>Mouse/Scroll for more results<br><hr><br>";
}mysqli_free_result($result);
?>
 

    
<?php
 if ( isset($_GET['Agency'])  )
 {
  
                  

$agency=$_GET['Agency'];
$agor = "SELECT *,sum(current) FROM `budget_table15_16`
 WHERE Agency LIKE'%$agency%' GROUP BY Program ORDER BY Agency,Program";
$result = mysqli_query($db, $agor );
@$num_results = mysqli_num_rows($result);


        if ($num_results <4 and $num_results>0)
{
echo"<h3>Commonwealth Budget 2015-16 Results</h3>
	<h4>Programs administered by the $agency Agency</h2><div class='source'>Source: Calculated from Line item CSV 
Portfolio Budget Statements published at <a href='http://data.gov.au/dataset/budget-2015-16-tables-and-data'>data.gov.au</a></div>
	";
 while ($row = $result->fetch_assoc()) 
    {
      
   
echo"<table class='wide'><tbody>
 
  <tr><td>".$row['Program']."</td>
  <td>$".number_format($row['sum(current)']).",000</td></tr> </tbody></table>

  ";
}
echo"
<p>Commonwealth tenders data includes Agency name but not the Program under which each Agency is seeking tenders.</p><br>
<!--<h4>Notes</h4><p>The term Component and Sub-Program are used interchangeably by the government to refer to the smallest financial grain in the federal budget papers.</p>
<p>Sometimes the Program and Component/Sub-Program name are identical in the budget documents or left blank in the open dataset. Where it is left blank it is assumed to be identical to Program name.</p>
<p>Some grants cover more than one location and/or cross political boundaries. Some grants apply state-wide or nationally. Where funding can not be attributed to a single location or electorate, these fields are left blank.</p>
<p>Where funding is attributable to a single location (postcode) or political area (LGA or Federal Electorate) you can click on these fields to get results using that criteria.</p>-->   ";

}



        if ($num_results >3)
{
echo"<br><h3>Commonwealth Budget 2015-16 Results</h3><h4>Programs administered by the $agency</h2><div class='source'>Source: Calculated from Line item CSV 
Portfolio Budget Statements published at <a href='http://data.gov.au/dataset/budget-2015-16-tables-and-data'>data.gov.au</a></div>
	<div class='expand'>";
 while ($row = $result->fetch_assoc()) 
    {
      
   
echo"<table class='wide'><tbody>
 
  <tr><td><a href='portfolio.php?Program=".$row['Program']."'>".$row['Program']."</a></td>
  <td>$".number_format($row['sum(current)']).",000</td></tr> </tbody></table>

  ";
}
echo"</div>Mouse/Scroll over for more results.
<p>Commonwealth tenders data includes Agency name but not the Program under which each Agency is seeking tenders.</p><br>
<!--<h4>Notes</h4><p>The term Component and Sub-Program are used interchangeably by the government to refer to the smallest financial grain in the federal budget papers.</p>
<p>Sometimes the Program and Component/Sub-Program name are identical in the budget documents or left blank in the open dataset. Where it is left blank it is assumed to be identical to Program name.</p>
<p>Some grants cover more than one location and/or cross political boundaries. Some grants apply state-wide or nationally. Where funding can not be attributed to a single location or electorate, these fields are left blank.</p>
<p>Where funding is attributable to a single location (postcode) or political area (LGA or Federal Electorate) you can click on these fields to get results using that criteria.</p>-->   ";



}

    
}mysqli_free_result($result);

        ?>
  
    

  <?php
      
  if (  isset($_GET['Program']) && !isset($_GET['Postcode'])  )
  {
 include'map.php';
  }

  ?>

    <?php
    if ( isset($_GET['Agency']) && !isset($_GET['Program']))
    {
  
   $agency = $_GET['Agency']; 


   $grants = "SELECT grants.Program,sum(Funding) FROM `grants` join budget_table15_16 on 
   budget_table15_16.program=grants.program where budget_table15_16.agency='$agency' && 
   grants.Year='2015-16' group by grants.Program";
   $result = mysqli_query($db, $grants);
    @$num_results = mysqli_num_rows($result);


           if ($num_results >0)
           {
              echo"<h4>Commonwealth Grant totals for Programs administered by $agency </h4><div class='source'>Source: Grants data published at $agency website</div>
   			   <table class='grants' ><tbody>";
    while ($row = $result->fetch_assoc()) 
       {
         echo"<tr>
         <td><a href='agency.php?Agency=$agency&Program=".$row['Program']."'>".$row['Program']."</a></td>
   	  <td>$".number_format($row['sum(Funding)'])."</td></tr>";


       }
       echo" </tbody></table><br><hr class='short'><br><p>Click on the Program name for details</p> ";
           }
                  /*  else 
        echo"<p>There are no grants provided by the Commonwealth directly under the Programs administered by/the open data provided by
                  the $agency in the 2015-16 FY</p>";*/

   }mysqli_free_result($result);
                    ?>
   

 </div>
 <div class='right'>
	   <?php
	   if ( isset($_GET['Agency']) )
	    {

	     $data = $_GET['Agency']; 
	     $agency=mysqli_real_escape_string ( $db , $data );
	     $tenders = "SELECT id FROM grants WHERE Agency LIKE'%$agency%'   ";
	     $result = mysqli_query($db, $tenders );
      

	  @$num_results = mysqli_num_rows($result);
	    if ($num_results >0)
	    {
	  echo"<h3>Commonwealth Grants awarded by $agency</h3>
	  <p>(With approval dates within the 2015-16 financial year)</p>
	  <div class='source'>Source: published at agency websites </div>";
	  $seifa = "SELECT *,sum(Funding),count(Funding) as count,AVG(Funding)   FROM grants WHERE Agency LIKE'%$agency%' && Year='2015-16'  ";
	  $result = mysqli_query($db, $seifa );
	    @$num_results = mysqli_num_rows($result);
	    if ($num_results <1)
	    {
	    echo"<h4>There are no Commonwealth Grants made by $agency</h4>";
	    }
	  else{
	 	 echo"<hr>

	 	 <table class='stats' ><tbody><tr><th>Number</th><th>Ave Value</th><th>Total Value</th></tr>";
	   while ($row = $result->fetch_assoc()) 
	      {

	  echo"

	    <tr><th>".number_format($row['count'])."</th><th>".number_format($row['AVG(Funding)'])."</th>    <th>$".number_format($row['sum(Funding)'])."</th></tr>

	  ";
	  }echo" </tbody></table><hr><br>";
	 }
	  }
	  }

	  ?>
 	   <?php
 	   if ( isset($_GET['Agency']) )
 	    {

 	     $data = $_GET['Agency']; 
 	     $agency=mysqli_real_escape_string ( $db , $data );


 	
 	  $seifa = "SELECT Recipient,sum(Funding),count(Funding) as count  FROM grants 
		  WHERE Agency LIKE'%$agency%' && Year='2015-16' GROUP BY Recipient ORDER BY sum(Funding) DESC ";
 	  $result = mysqli_query($db, $seifa );
 	    @$num_results = mysqli_num_rows($result);
 	    if ($num_results <1)
 	    {
 	    echo"<h4>There are no Commonwealth Grants made by $agency</h4>";
 	  }
 	  else{
 	 	 echo"
 	 <div class='expand'>
 	 ";
 	   while ($row = $result->fetch_assoc()) 
 	      {

 	  echo"
 	 	 <table class='basic' ><tbody>
 	    <tr><td width='150px'>Name</td><td><a href='search.php?Name=".$row['Recipient']."'>".$row['Recipient']."</a></td></tr>
 	 <tr><td>Number</td><td>(".number_format($row['count']).") <span class='right'>$".number_format($row['sum(Funding)'])."</span></td>    </tr>

 	 </tbody></table>
 	  ";
 	  }echo" <hr><br></div>Mouse/Scroll over for more results. <p>Click on the Name to display details (below)</p><hr><br>";
 	  }
 	  }

 	  ?>
  <?php
  if ( isset($_GET['Agency']) )
   {

    $data = $_GET['Agency']; 
    $agency=mysqli_real_escape_string ( $db , $data );
    $tenders = "SELECT id FROM tenders WHERE Agency LIKE'%$agency%'   ";
    $result = mysqli_query($db, $tenders );
      

 @$num_results = mysqli_num_rows($result);
   if ($num_results >0)
   {
 echo"<h3>Commonwealth Tenders awarded by $agency</h3>
 <p>(With approval dates within the 2015-16 financial year)</p>
 <div class='source'>Source: Historical Tenders data published at data.gov.au </div>";
 $seifa = "SELECT *,sum(Value),count(Value) as count,AVG(Value)  FROM tenders WHERE Agency LIKE'%$agency%'   ";
 $result = mysqli_query($db, $seifa );
   @$num_results = mysqli_num_rows($result);
   if ($num_results <1)
   {
   echo"<h4>There are no Commonwealth Tenders made by $agency</h4>";
   }
 else{
	 echo"<hr>

	 <table class='stats' ><tbody><tr><th>Number</th><th>Ave Value</th><th>Total Value</th></tr>";
  while ($row = $result->fetch_assoc()) 
     {

 echo"

   <tr><th>".number_format($row['count'])."</th><th>".number_format($row['AVG(Value)'])."</th>    <th>$".number_format($row['sum(Value)'])."</th></tr>

 ";
 }echo" </tbody></table><hr><br>";
}
 }
 }

 ?>
	   <?php
	   if ( isset($_GET['Agency']) )
	    {

	     $data = $_GET['Agency']; 
	     $agency=mysqli_real_escape_string ( $db , $data );


	 
	  $seifa = "SELECT Name,ABN,sum(Value),count(Value) as count  FROM tenders WHERE Agency LIKE'%$agency%' GROUP BY ABN ORDER BY sum(Value) DESC ";
	  $result = mysqli_query($db, $seifa );
	    @$num_results = mysqli_num_rows($result);
	    if ($num_results <1)
	    {
	    echo"<h4>There are no Commonwealth Tenders made by $agency</h4>";
	  }
	  else{
	 	 echo"
	 <div class='expand'>
	 ";
	   while ($row = $result->fetch_assoc()) 
	      {

	  echo"
	 	 <table class='basic' ><tbody>
	    <tr><td width='150px'>Name</td><td>".$row['Name']."</td></tr>
	  <tr><td>ABN</td><td><a href='agency.php?Agency=$agency&ABN=".$row['ABN']."'>".$row['ABN']."</a></td></tr>
	 <tr><td>Number</td><td>(".number_format($row['count']).") <span class='right'>$".number_format($row['sum(Value)'])."</span></td>    </tr>

	 </tbody></table>
	  ";
	  }echo" <hr><br></div>Mouse/Scroll over for more results. <p>Click on the ABN to display details (below)</p><hr><br>";
	  }
	  }

	  ?>
	 
      <?php
      if ( isset($_GET['Agency']) && isset($_GET['ABN']) )
       {

        $data = $_GET['Agency']; 
        $agency=mysqli_real_escape_string ( $db , $data );
        $data = $_GET['ABN']; 
        $ABN=mysqli_real_escape_string ( $db , $data );

 	   $query = "SELECT *  FROM tenders WHERE Agency LIKE'%$agency%'  && ABN='$ABN' ";
 	   $result = mysqli_query($db, $query);
	    @$num_results = mysqli_num_rows($result);
	
	   echo"<h3>$agency awarded $num_results tenders to $ABN in the 2015-16 FY </h3> <div class='expand'>";
 	   while ($row = $result->fetch_assoc()) 
 	      {
 			  include'tenders_table.php';
 		  }
		  echo"</div>Mouse/Scroll over for more results.";
 	  }
 	   ?>

	  <h3>About Agency Data</h3>
	  <div class='source'> Source <a href='http://www.finance.gov.au/sites/default/files/guide-to-register-fields.pdf'>Guide to Fields</a> (Department of Finance)</div>
	  <p>Portfolio Budget Statements (and the open data derived from them) only contain spending 
		  information for organisations with the General Financial Statistics classification General Government Services. </p>
		  <p>Organisations that are not General Government Serivces do not derive their funding through the appropriation bills that authorise 
			  budget spending through the parliamentary process.</p>
			  <p>An organisation can be General Government Service (GGS), a Public Non-Financial Corporation (PNFC),a Public Financial Corporation (PFC), 
				  or unclassifed.</p>
	 
	    <?php/*
	    if ( isset($_GET['Agency']) )
	     {
 
	      $data = $_GET['Agency']; 
	      $agency=mysqli_real_escape_string ( $db , $data );
 

	   echo"<h4>Commonwealth Tenders administered by $agency</h4>
	   <p>(With approval dates within the 2015-16 financial year)</p>
	   <div class='source'>Source: Historical Tenders data published at data.gov.au </div>";
	   $agency_results = "SELECT *  FROM tenders WHERE Agency LIKE'%$agency%'   ";
	   $result = mysqli_query($db, $agency_results );
	     @$num_results = mysqli_num_rows($result);
	     if ($num_results <1)
	     {
	     echo"<h4>There are no Commonwealth Tenders administered by $agency</h4>";
	     }
	   else{
	    while ($row = $result->fetch_assoc()) 
	       {



	 include'tenders_table.php';
  
	   }echo" <p></p>";
	   }
	   }

	   ?>

 <?php
 if ( isset($_GET['Program']) || isset($_GET['Component']))
 {
  
                   $program = $_GET['Program']; 
                   
                 //  $agency=mysqli_real_escape_string($agency);

 echo"<h4>Details for Commonwealth budget Program: $program </h2>";
$agor = "SELECT * FROM `budget_table15_16`
 WHERE Program='$program' group by Program";
$result = mysqli_query($db, $agor );
echo"  <div class='source'>Source: Line item CSV 
Portfolio Budget Statements published at <a href='http://data.gov.au/dataset/budget-2015-16-tables-and-data'>data.gov.au</a></div><table class='basic'><tbody>";
 while ($row = $result->fetch_assoc()) 
    {
       echo" 
  
  <tr><td>Portfolio</td><td><a href='portfolio.php?Portfolio=".$row['Portfolio']."' target='_blank'>".$row['Portfolio']."</a></td></tr>
  <tr><td>Agency</td><td><a href='portfolio.php?Agency=".$row['Agency']."' target='_blank'>".$row['Agency']."</a></td></tr>
  <tr><td>Program</td><td><a href='portfolio.php?Portfolio=".$row['Portfolio']."&Program=".$row['Program']."'>".$row['Program']."</a></td></tr>
  <tr><td>Outcome</td><td>".$row['Outcome']."</td></tr>";

}echo"</tbody><table>";



$component = "SELECT Component,Outcome,Agency FROM `budget_table15_16`
 WHERE Program='$program' ";
$result = mysqli_query($db, $component );

 @$num_results = mysqli_num_rows($result);

        if ($num_results >0)
        {
          echo"<h4>($num_results) Components:</h4>
        
          <table class='component'><tbody>";
 while ($row = $result->fetch_assoc()) 
    {
echo"<tr><td><img style='height:15px; opacity:0.4' src='images/chevron.png'></img></td>
<td><a href='agency.php?Agency=".$row['Agency']."&Program=$program&Component=".$row['Component']."'>".$row['Component']."</a></td>
</tr>
 
";
    }echo"</tbody></table><br>";
   
   
}else "No results for $program";

    
}mysqli_free_result($result);

      */  ?>
      

<?php
 if ( isset($_GET['Component']) && isset($_GET['Agency']))
 {

      $sub_program = "SELECT * FROM `budget_table15_16`
 WHERE Agency='".$_GET['Agency']."' && Component ='".$_GET['Component']."' ";
$result = mysqli_query($db, $sub_program);
while ($row = $result->fetch_assoc()) 
{
echo"<h4>Component Details</h4><table class='basic'><tbody>
 
  <tr><td>Component</td><td>".$row['Component']."</td></tr>
 
  <tr><td>Appropriation Type</td><td> ".$row['Appropriation_Type']."</td></tr>
  <tr><td>Cost</td><td><span style='float:right'>$".number_format($row['current']).",000</span></td></tr>
  <tr><td>".$row['Source_Table']."</td><td> ".$row['Source']."</td></tr>
  

 </tbody></table><br><br> ";

}
}mysqli_free_result($result);

?>
   <?php
   /*if ( isset($_GET['Agency']) )
    {

		

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

  
        }echo" </tbody></table><br>";
  }*/

  ?>

 
     
 <?php
 if ( isset($_GET['Program']) )
 {
  
  $program = $_GET['Program']; 

                   
            

$grants = "SELECT *, DATE_FORMAT( Approved,  '%D %b %Y' ) AS Approved,
         DATE_FORMAT(End,  '%D %b %Y' ) AS End,
         DATEDIFF(END,APPROVED)/30 AS Term FROM grants 
 WHERE Program LIKE'%$program%' && year='2015-16'  ORDER BY Postcode ";
$result = mysqli_query($db, $grants );
 @$num_results = mysqli_num_rows($result);
 if ($num_results <4)
 {
   echo"<h4>There are $num_results grants administered under the $program Program in the 15-16 FY:</h4><br>
 		  ";
 
  while ($row = $result->fetch_assoc()) 
     {

 include'grants_table.php';

     }
 }
 elseif ($num_results >3)
 {

	 echo"
  <h4>There are $num_results grants administered under the $program Program in the 15-16 FY:</h4><br>
		<div class='expand'>";
		 
 while ($row = $result->fetch_assoc()) 
    {
      
include'grants_table.php';

    }echo"</div><div class='scroller'><p>Mouse over/scroll for more results</p></div>";
	
 }
      
		 
}mysqli_free_result($result);

        ?>
 




</div></div>
<div class='clear'></div>
<?php 
    include('footer.php');?>

    </body>
</html>