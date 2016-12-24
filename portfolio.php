<?php
require'header.php';
?>


        <div class="left">

    
   <?php
    if ( isset($_GET['Portfolio'])  )
    {
  
                      
$portfolio=$_GET['Portfolio'];
    
   $agor = "SELECT DISTINCT Agency FROM `budget_table15_16`
    WHERE Portfolio ='".$_GET['Portfolio']."' ";
   $result = mysqli_query($db, $agor );
   @$num_results = mysqli_num_rows($result);

          if ($num_results >0)
          {
            
        
   echo"<h4>Agencies administered by the $portfolio Portfolio</h2><div class='source'>Source: Line item CSV 
Portfolio Budget Statements published at <a href='http://data.gov.au/dataset/budget-2015-16-tables-and-data'>data.gov.au</a></div>
 <div class='clear'></div> 
 
 <tbody><table class='wide'><tbody>";
    while ($row = $result->fetch_assoc()) 
       {
		   echo"<tr><td><a href='agency.php?Agency=".$row['Agency']."'>".$row['Agency']."</a></td></tr>";
	   }
	   echo"</tbody></table>";
         }elseif ($num_results<1)
          {
			  echo"No results for $portfolio";
		  }
   }
   
   ?>



 

    
<?php
 if ( isset($_GET['Portfolio'])  )
 {
  
$portfolio=$_GET['Portfolio'];
 echo"<h4>Programs administered by the $portfolio Portfolio</h2>";
$agor = "SELECT sum(current),Portfolio,Program FROM `budget_table15_16`
 WHERE Portfolio LIKE'%$portfolio%' GROUP BY Program ORDER BY Agency,Program";
$result = mysqli_query($db, $agor );
echo"<div class='source'>Source: Calculated using line item CSV 
Portfolio Budget Statements published at <a href='http://data.gov.au/dataset/budget-2015-16-tables-and-data'>data.gov.au</a></div>
<div class='clear'></div><table class='wide'><tbody>";
 while ($row = $result->fetch_assoc()) 
    {
      
   
echo"
 
  <tr><td><a href='portfolio.php?Portfolio=".$row['Portfolio']."&Program=".$row['Program']."'>".$row['Program']."</a></td>
  <td>$".number_format($row['sum(current)']).",000</td></tr>

  ";
}
echo"
 </tbody></table><br> <h4>Notes</h4>
    <p>The term Component and Sub-Program are used interchangeably by the government to refer to the smallest financial grain in the federal budget papers.</p>
<p>Sometimes the Program and Component/Sub-Program name are identical in the budget documents or left blank in the open dataset. Where it is left blank it is assumed to be identical to Program name.</p>
<p>Some grants cover more than one location and/or cross political boundaries. Some grants apply state-wide or nationally. Where funding can not be attributed to a single location or electorate, these fields are left blank.</p>
<p>Where funding is attributable to a single location (postcode) or political area (LGA or Federal Electorate) you can click on these fields to get results using that critera.</p> ";



    
}mysqli_free_result($result);

        ?>
  
     


  <?php
      
  if (  isset($_GET['Program']) && !isset($_GET['Postcode'])  )
  {
 //include'map.php';
  }

  ?>

 

 </div>
 <div class='right'>
	 
<?php
 if ( isset($_GET['Portfolio']) )
 {
  
$portfolio = $_GET['Portfolio']; 
echo"<h4>Commonwealth Grant totals for Programs in the $portfolio Portfolio</h4>";

$grants = "SELECT grants.Program,sum(Funding) FROM `grants` join budget_table15_16 on 
budget_table15_16.program=grants.program where budget_table15_16.portfolio='$portfolio' && 
grants.Year='2015-16' group by grants.Program";
$result = mysqli_query($db, $grants);
 @$num_results = mysqli_num_rows($result);


        if ($num_results >0)
        {
           echo"<div class='source'>Source: Grants data published at agency websites</div><table class='basic' ><tbody>";
 while ($row = $result->fetch_assoc()) 
    {
      echo"<tr>
      <td><a href='portfolio.php?Portfolio=$portfolio&Program=".$row['Program']."'>".$row['Program']."</a></td>
	  <td>$".number_format($row['sum(Funding)'])."</td></tr>";


    }
    echo" </tbody></table><br><hr class='short'><br> ";
        }
                 else 
				 {/*
     echo"<p>There are no grants provided by the Commonwealth directly under the Programs administered by/the open data provided by
               the $portfolio Portfolio the 2015-16 FY</p>";*/
 }

}mysqli_free_result($result);
                 ?>

 <?php
 if ( isset($_GET['Program']) )
 {
  
  $program = $_GET['Program']; 

                   
                 //  $portfolio=mysqli_real_escape_string($portfolio);

$grants = "SELECT *, DATE_FORMAT( Approved,  '%D %b %Y' ) AS Approved,
         DATE_FORMAT(End,  '%D %b %Y' ) AS End,
         DATEDIFF(END,APPROVED)/30 AS Term FROM grants 
 WHERE Program LIKE'%$program%' && year='2015-16'  ORDER BY Postcode ";
$result = mysqli_query($db, $grants );
 @$num_results = mysqli_num_rows($result);

        if ($num_results >0)
        {
          echo"
  <h4>There are $num_results grants administered under the $program Program in the 14-15 FY:</h4><br>
		 <div class='source'>Source: Grants data published at agency websites</div> <div class='expand'>";
 while ($row = $result->fetch_assoc()) 
    {
      
include'grants_table.php';

    }echo"</div><p>Mouse over/scroll for more results</p>";
       }
       if ($num_results <1)
       {/*
echo"<p>There are no grants provided by the Commonwealth directly under the Programs administered by/the open data provided by
          the $portfolio the 2015-16 FY</p>";*/
       }
}mysqli_free_result($result);

        ?>
 
 <?php
 if ( isset($_GET['Program']) || isset($_GET['Component']))
 {
  
                   $program = $_GET['Program']; 
                   
                 //  $portfolio=mysqli_real_escape_string($portfolio);

 echo"<h4>Details for Commonwealth budget Program: $program </h2>";
$agor = "SELECT * FROM `budget_table15_16`
 WHERE Program='$program' group by Program";
$result = mysqli_query($db, $agor );
echo"  <div class='source'>Source: Line item CSV 
Portfolio Budget Statements published at <a href='http://data.gov.au/dataset/budget-2015-16-tables-and-data'>data.gov.au</a></div>
<table class='basic'><tbody>";
 while ($row = $result->fetch_assoc()) 
    {
       echo" 
  
  <tr><td>Portfolio</td><td><a href='portfolio.php?Portfolio=".$row['Portfolio']."' target='_blank'>".$row['Portfolio']."</a></td></tr>
  <tr><td>Agency</td><td><a href='agency.php?Agency=".$row['Agency']."' target='_blank'>".$row['Agency']."</a></td></tr>
  <tr><td>Program</td><td><a href='portfolio.php?Portfolio=".$row['Portfolio']."&Program=".$row['Program']."'>".$row['Program']."</a></td></tr>
  <tr><td>Outcome</td><td>".$row['Outcome']."</td></tr>";

}echo"</tbody><table>";



$component = "SELECT Component,Outcome,Portfolio FROM `budget_table15_16`
 WHERE Program='$program' ";
$result = mysqli_query($db, $component );

 @$num_results = mysqli_num_rows($result);

        if ($num_results >0)
        {
          echo"<h4>($num_results) Components:</h4>
			  <div class='source'>Source: Line item CSV 
			  Portfolio Budget Statements published at <a href='http://data.gov.au/dataset/budget-2015-16-tables-and-data'>data.gov.au</a></div>
			
          <table class='component'><tbody>";
 while ($row = $result->fetch_assoc()) 
    {
echo"<tr><td><img style='height:15px; opacity:0.4' src='images/chevron.png'></img></td>
<td><a href='portfolio.php?Portfolio=$portfolio&Program=$program&Component=".$row['Component']."'>".$row['Component']."</a></td>
</tr>
 
";
    }echo"</tbody></table><br>";
   
   
}else "No results for $program";

    
}mysqli_free_result($result);

        ?>
      

<?php
 if ( isset($_GET['Component']) )
 {
 $component= $_GET['Component'];
      $sub_program = "SELECT * FROM `budget_table15_16`
 WHERE Component LIKE'%$component%' ";
$result = mysqli_query($db, $sub_program);
echo"<h4>Component Details</h4><div class='source'>Source: Line item CSV 
Portfolio Budget Statements published at <a href='http://data.gov.au/dataset/budget-2015-16-tables-and-data'>data.gov.au</a></div>

	<table class='basic'><tbody>";
while ($row = $result->fetch_assoc()) 
{
echo"
 
  <tr><td>Component</td><td>".$row['Component']."</td></tr>
  <tr><td>Appropriation Type</td><td> ".$row['Appropriation_Type']."</td></tr>
  <tr><td>Cost</td><td><span style='float:right'>$".number_format($row['current']).",000</span></td></tr>
  <tr><td>".$row['Source_Table']."</td><td> ".$row['Source']."</td></tr>
  

  ";

}echo"</tbody></table><br><br>";
}mysqli_free_result($result);

?>
 





</div></div>
<div class='clear'></div>
<?php 
    include('footer.php');?>

    </body>
</html>