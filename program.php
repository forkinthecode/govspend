<?php
require'header.php';
?>


        <div class="left">

   
<?php
 //if ( !isset($_GET['Program'])  )
 {

$budget = "SELECT Portfolio,Program,sum(current) FROM `budget_table15_16` GROUP BY Program order by sum(current) DESC";
$result = mysqli_query($db, $budget );
@$num_results = mysqli_num_rows($result);
 echo"<h3>Budget totals for all Agencies</h3><div class='expand'>
		<div class='source'>Source: Calculated using line item CSV 
	Portfolio Budget Statements published at <a href='http://data.gov.au/dataset/budget-2015-16-tables-and-data'>data.gov.au</a></div>
	 <table class='basic' ><tbody> <tr><th>Program</th><th>Total Cost</th></tr>";
 while ($row = $result->fetch_assoc()) 
    {
      
   
echo"
 
<tr><td><a href='portfolio.php?Portfolio=".$row['Portfolio']."'>".$row['Portfolio']."</a></td><td><a href='program.php?Program=".$row['Program']."'>".$row['Program']."</a></td><td>$".number_format($row['sum(current)']).",000</td></tr>
  ";
    }echo"</tbody></table></div><div class='clear'></div>
		<div class='scroller'>
				<p>Mouse over/scroll for more results</p></div><br>";
       
}
	?>
  




	
<?php/*
 if ( isset($_GET['Program'])  )
 {
  
$program=$_GET['Program'];
$agor = "SELECT * 
FROM  `AGOR` 
WHERE Program =  '$program'";
$result = mysqli_query($db, $agor );
echo"<div class='source'>Source: <a href='http://www.finance.gov.au/resource-management/governance/agor/'>Australian Government Organisations Register</a></div>
	<table class='basic'><tbody>";
 while ($row = $result->fetch_assoc()) 
    {
		echo"
  <tr><td>Description</td>         <td><div class='description'>".$row['Description']."</div></td></tr>
  <tr><td>GFS Sub-Functions</td>   <td>".$row['GFS_Function']."</td></tr>
  <tr><td>Strategic Plan</td>      <td><a href='".$row['Strategic_Plan']."' target='_blank'>".$row['Strategic_Plan']."</a></td></tr>
  <tr><td>Annual Report</td>       <td><a href='".$row['Annual_Reports']."' target='_blank'>".$row['Annual_Reports']."</a></td></tr>
  <tr><td>Auditor</td>       <td>".$row['Auditor']."</td></tr>
		  ";
	 }echo"</tbody></table>";
}mysqli_free_result($result);*/
?>
 

    
<?php/*
 if ( isset($_GET['Program'])  )
 {
  
                  

$program=$_GET['Program'];
$agor = "SELECT *,sum(current) FROM `budget_table15_16`
 WHERE Program LIKE'%$program%' GROUP BY Program ORDER BY Program,Program";
$result = mysqli_query($db, $agor );
@$num_results = mysqli_num_rows($result);


        if ($num_results <4 and $num_results>0)
{
echo"<h4>Programs administered by the $program Program</h2><div class='source'>Source: Calculated from Line item CSV 
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
<p>Commonwealth tenders data includes Program name but not the Program under which each Program is seeking tenders.</p><br>
<!--<h4>Notes</h4><p>The term Component and Sub-Program are used interchangeably by the government to refer to the smallest financial grain in the federal budget papers.</p>
<p>Sometimes the Program and Component/Sub-Program name are identical in the budget documents or left blank in the open dataset. Where it is left blank it is assumed to be identical to Program name.</p>
<p>Some grants cover more than one location and/or cross political boundaries. Some grants apply state-wide or nationally. Where funding can not be attributed to a single location or electorate, these fields are left blank.</p>
<p>Where funding is attributable to a single location (postcode) or political area (LGA or Federal Electorate) you can click on these fields to get results using that criteria.</p>-->   ";

}



        if ($num_results >3)
{
echo"<h4>Programs administered by the $program</h2><div class='source'>Source: Calculated from Line item CSV 
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
<p>Commonwealth tenders data includes Program name but not the Program under which each Program is seeking tenders.</p><br>
<!--<h4>Notes</h4><p>The term Component and Sub-Program are used interchangeably by the government to refer to the smallest financial grain in the federal budget papers.</p>
<p>Sometimes the Program and Component/Sub-Program name are identical in the budget documents or left blank in the open dataset. Where it is left blank it is assumed to be identical to Program name.</p>
<p>Some grants cover more than one location and/or cross political boundaries. Some grants apply state-wide or nationally. Where funding can not be attributed to a single location or electorate, these fields are left blank.</p>
<p>Where funding is attributable to a single location (postcode) or political area (LGA or Federal Electorate) you can click on these fields to get results using that criteria.</p>-->   ";



}

    
}mysqli_free_result($result);*/

        ?>
  
    

 

    <?php/*
    if ( isset($_GET['Program']) && !isset($_GET['Program']))
    {
  
   $program = $_GET['Program']; 


   $grants = "SELECT grants.Program,sum(Funding) FROM `grants` join budget_table15_16 on 
   budget_table15_16.program=grants.program where budget_table15_16.agency='$program' && 
   grants.Year='2015-16' group by grants.Program";
   $result = mysqli_query($db, $grants);
    @$num_results = mysqli_num_rows($result);


           if ($num_results >0)
           {
              echo"<h4>Commonwealth Grant totals for Programs administered by $program </h4><div class='source'>Source: Grants data published at $program website</div>
   			   <table class='grants' ><tbody>";
    while ($row = $result->fetch_assoc()) 
       {
         echo"<tr>
         <td><a href='program.php?Program=$program&Program=".$row['Program']."'>".$row['Program']."</a></td>
   	  <td>$".number_format($row['sum(Funding)'])."</td></tr>";


       }
       echo" </tbody></table><br><hr class='short'><br><p>Click on the Program name for details</p> ";
           }
                

   }mysqli_free_result($result);*/
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
   

 </div>
 <div class='right'>
	 <?php
	  if ( isset($_GET['Program'])  )
	  {
	 $program=$_GET['Program'];
	
	 $budget_test = "SELECT Program FROM `budget_table15_16`
	  WHERE Program ='$program'";
	 $result = mysqli_query($db, $budget_test );
	 @$num_results = mysqli_num_rows($result);

	         if ($num_results>0) 
	         {

	 $budget = "SELECT sum(last),sum(current),sum(plus1) FROM `budget_table15_16`
	  WHERE Program ='$program' ";
	 $result = mysqli_query($db, $budget );
	 @$num_results = mysqli_num_rows($result);
	  echo"<h3>Budget totals for $program</h3>
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
 if ( isset($_GET['Program']) || isset($_GET['Component']))
 {
  
                   $program = $_GET['Program']; 
                   
                 //  $program=mysqli_real_escape_string($program);

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
  <tr><td>Program</td><td><a href='portfolio.php?Program=".$row['Program']."' target='_blank'>".$row['Program']."</a></td></tr>
  <tr><td>Program</td><td><a href='portfolio.php?Portfolio=".$row['Portfolio']."&Program=".$row['Program']."'>".$row['Program']."</a></td></tr>
  <tr><td>Outcome</td><td>".$row['Outcome']."</td></tr>";

}echo"</tbody><table>";



$component = "SELECT Component,Outcome,Program FROM `budget_table15_16`
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
<td><a href='program.php?Program=".$row['Program']."&Program=$program&Component=".$row['Component']."'>".$row['Component']."</a></td>
</tr>
 
";
    }echo"</tbody></table><br>";
   
   
}else "No results for $program";

    
}mysqli_free_result($result);

        ?>
      

<?php
 if ( isset($_GET['Component']) && isset($_GET['Program']))
 {

      $sub_program = "SELECT * FROM `budget_table15_16`
 WHERE Program='".$_GET['Program']."' && Component ='".$_GET['Component']."' ";
$result = mysqli_query($db, $sub_program);
while ($row = $result->fetch_assoc()) 
{
echo"<h4>Component Details</h4><table class='basic'><tbody>
 
  <tr><td>Component</td><td>".$row['Component']."</td></tr>
 
  <tr><td>Appropriation Type</td><td> ".$row['Appropriation_Type']."</td></tr>
  <tr><td>Cost</td><td>$".number_format($row['current']).",000</td></tr>
  <tr><td>".$row['Source_Table']."</td><td> ".$row['Source']."</td></tr>
  

 </tbody></table><br><br> ";

}
}mysqli_free_result($result);

?>

  <?php
      
  if (  isset($_GET['Program']) && !isset($_GET['Postcode'])  )
  {
 //include'map.php';
  }

  ?>
  <?php
  if ( isset($_GET['Program']) )
  {


               
  $program=$_GET['Program'];

 $grants = "SELECT *,sum(Funding) FROM grants 
  WHERE Program ='$program' && Year='2015-16' GROUP BY Electorate  ORDER BY sum(Funding) DESC ";
 $result = mysqli_query($db, $grants );
  @$num_results = mysqli_num_rows($result);

         if ($num_results >0)
         {
           echo"
   <h4>There are ".number_format($num_results)." grants administered under the $program Program in the 15-16 FY:</h4><br>
 		 <div class='source'>Source: Grants data published at agency websites</div> <div class='expand'><table class='basic'><tbody>";
  while ($row = $result->fetch_assoc()) 
     {
		
     echo"<tr>
     <td><a href='electorate.php?Electorate=".$row['Electorate']."&Program=".$row['Program']."'>".$row['Electorate']."</a></td>
  <td>$".number_format($row['sum(Funding)'])."</td></tr>";


 

     }echo"</tbody></table></div><p>Mouse over/scroll for more results</p>";
        }
        if ($num_results <1)
        {echo"<h4>There are no grants matching $program</h4>";
        }
 }mysqli_free_result($result);

         ?>
 <?php
 include'income_support.php';
 ?>





</div></div>
<div class='clear'></div>
<?php 
    include('footer.php');?>

    </body>
</html>