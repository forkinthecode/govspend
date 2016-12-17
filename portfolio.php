<!--Budget Home-->
 <!DOCTYPE HTML>
<html lang="en">
  <head>
<meta charset="UTF-8">
    <title>Little Bird</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Rosie Williams">
    </head>
    <body>
<?php


include('login.php');
//include('../inclusions.php');

include('styles.php');


 
    

?>

  
        
                     
 
  <div class="jumbotron"> 
     
<h2><a href='index.php'>Home</a><span style='float:right'>Budget FY2014-15</span></h2>
  <hr>
        </div>
          
       

          <div class='clear'></div>
<div class="page_width">


        <div class="left">

   

  




 

    
<?php
 if ( isset($_GET['Portfolio']) )
 {
  
                   $portfolio = $_GET['Portfolio']; 
                   
                 //  $portfolio=mysqli_real_escape_string($portfolio);

 echo"<h4>Programs administered by the $portfolio Portfolio</h2>";
$agor = "SELECT sum(2014_15),Program FROM `fed_budget`
 WHERE Portfolio LIKE'%$portfolio%' GROUP BY Program ORDER BY Agency,Program";
$result = mysqli_query($db, $agor );
 while ($row = $result->fetch_assoc()) 
    {
      
   
echo"<table class='wide'><tbody>
 
  <tr><td><a href='portfolio.php?Program=".$row['Program']."'>".$row['Program']."</a></td><td>$".number_format($row['sum(2014_15)']).",000</td></tr>

  

 </tbody></table><hr><br><br> ";

}

    
}mysqli_free_result($result);

        ?>
  
           
 <?php
 if ( isset($_GET['Program']) || isset($_GET['Component']))
 {
  
                   $program = $_GET['Program']; 
                   
                 //  $portfolio=mysqli_real_escape_string($portfolio);

 echo"<h4>Details for Commonwealth budget Program: $program </h2>";
$agor = "SELECT * FROM `fed_budget`
 WHERE Program='$program' group by Program";
$result = mysqli_query($db, $agor );

 while ($row = $result->fetch_assoc()) 
    {
       echo" <table class='basic'>
              <tr><td>Portfolio</td><td><a href='portfolio.php?Portfolio=".$row['Portfolio']."' target='_blank'>".$row['Portfolio']."</a></td></tr>
       <tr><td>Agency</td><td><a href='portfolio.php?fAgency=".$row['Agency']."' target='_blank'>".$row['Agency']."</a></td></tr>
  <tr><td>Program</td><td><a href='portfolio.php?Program=".$row['Program']."'>".$row['Program']."</a></td></tr>
   <tr><td>Outcome</td><td>".$row['Outcome']."</td></tr></tbody><table>";

}



$component = "SELECT Component,Outcome FROM `fed_budget`
 WHERE Program='$program' ";
$result = mysqli_query($db, $component );

 @$num_results = mysqli_num_rows($result);

        if ($num_results >0)
        {
          echo"<h4>($num_results) Components:</h4>";
 while ($row = $result->fetch_assoc()) 
    {
echo"<table class='basic'><tr><td><a href='portfolio.php?Program=$program&Component=".$row['Component']."'><img src='outcome_search_large.png' height='40px'></img></a></td><td><a href='portfolio.php?Program=$program&Component=".$row['Component']."'>".$row['Component']."</a></td><tr></tbody></table><br>
 
";
    }
    echo"<h4>Notes</h4>
    <p>The term Component and Sub-Program are used interchangeably by the government to refer to the smallest financial grain in the federal budget papers.</p>
<p>Sometimes the Program and Component/Sub-Program name are identical in the budget documents or left blank. Where it is left blank it is assumed to be identifical to Program name.</p>
<p>Some grants cover more than one location and/or cross political boundaries. Some grants apply state-wide or nationally. Where funding can not be attributed to a single location or electorate, these fields are left blank.</p>
<p>Where funding is attributable to a single location (postcode) or political area (LGA or Federal Electorate) you can click on these fields to get results using that critera.</p>";
   
}else "No results for $program";

    
}mysqli_free_result($result);

        ?>
      
 <?php
 if ( isset($_GET['Portfolio']) )
 {
  
                   $portfolio = $_GET['Portfolio']; 
                   
                 //  $portfolio=mysqli_real_escape_string($portfolio);

 echo"<h4>Programs administered by the $portfolio Portfolio</h2>";
$agor = "SELECT *,sum(2014_15) FROM `fed_budget`
 WHERE Portfolio LIKE'%$portfolio%' GROUP BY Program ORDER BY Agency,Program";
$result = mysqli_query($db, $agor );
 while ($row = $result->fetch_assoc()) 
    {
      
   
echo"<table class='basic'><tbody>
 
  <tr><td>Agency</td><td><a href='function.php?function=".$row['Agency']."' target='_blank'>".$row['Agency']."</a></td></tr>
  <tr><td>Program</td><td><a href='portfolio.php?Program=".$row['Program']."'>".$row['Program']."</a></td></tr>
   <tr><td>Goals</td><td>".$row['Outcome']."</td></tr>
<tr><td>Appropriation Type</td><td> ".$row['Appropriation_Type']."</td></tr>
  <tr><td></td><td><span style='float:right'>$".number_format($row['sum(2014_15)']).",000</span></td></tr>
  <tr><td>".$row['source_table']."</td><td> ".$row['source']."</td></tr>
  

 </tbody></table><hr><br><br> ";

}

    
}mysqli_free_result($result);

        ?>



 

 

 </div>
 <div class='right'>




<?php
 if ( isset($_GET['Component']) )
 {
 $component= $_GET['Component'];
      $sub_program = "SELECT * FROM `fed_budget`
 WHERE Component LIKE'%$component%' ";
$result = mysqli_query($db, $sub_program);
while ($row = $result->fetch_assoc()) 
{
echo"<h4>Component Details</h4><table class='basic'><tbody>
 
  <tr><td>Component</td><td>".$row['Component']."</td></tr>
 
  <tr><td>Appropriation Type</td><td> ".$row['Appropriation_Type']."</td></tr>
  <tr><td>Cost</td><td><span style='float:right'>$".number_format($row['2014_15']).",000</span></td></tr>
  <tr><td>".$row['source_table']."</td><td> ".$row['source']."</td></tr>
  

 </tbody></table><hr><br><br> ";

}
}mysqli_free_result($result);

?>
 <?php
 if ( isset($_GET['Portfolio']) )
 {
  
$portfolio = $_GET['Portfolio']; 
echo"<h4>Commonwealth Grant totals for Programs in the $portfolio Portfolio</h4>";

$grants = "SELECT grants.Program,sum(Funding) FROM `grants` join fed_budget on 
fed_budget.program=grants.program where fed_budget.portfolio='$portfolio' && 
grants.Year='2014-15' group by grants.Program";
$result = mysqli_query($db, $grants);
 @$num_results = mysqli_num_rows($result);


        if ($num_results >0)
        {
           echo"<table class='basic' ><tbody>";
 while ($row = $result->fetch_assoc()) 
    {
      echo"<tr><td>$".number_format($row['sum(Funding)'])."</td><td><a href='portfolio.php?Program=".$row['Program']."'>".$row['Program']."</a></td></tr>";


    }
    echo" </tbody></table><br><hr class='short'><br> ";
        }
                 else 
     echo"<p>There are no grants provided by the Commonwealth directly under the Programs administered by
               the $portfolio Portfolio</p>";

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
 WHERE Program LIKE'%$program%' && year='2014-15'  ORDER BY Postcode ";
$result = mysqli_query($db, $grants );
 @$num_results = mysqli_num_rows($result);

        if ($num_results >0)
        {
          echo"
  <h4>There are $num_results grants administered under the $program Program in the 14-15 FY:</h4><br><h4>Component Details</h4><div class='expand'>";
 while ($row = $result->fetch_assoc()) 
    {
      
include'grants_table.php';

}echo"</div>";
}
else echo"<p>There are no grants provided by the Commonwealth directly under the program $program.";

    
}mysqli_free_result($result);

        ?>
 <?php
      
 if (  isset($_GET['Program']) && !isset($_GET['Postcode'])  )
 {
include'map.php';
 }

 ?>


</div></div>
<div class='clear'></div>
<?php 
    include('footer.php');?>

    </body>
</html>