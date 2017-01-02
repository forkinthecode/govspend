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
	 <table class='grants' ><tbody> <tr><th>Program</th><th>Total Cost</th></tr>";
 while ($row = $result->fetch_assoc()) 
    {
      
   
echo"
 
<tr><!--<td><a href='portfolio.php?Portfolio=".$row['Portfolio']."'>".$row['Portfolio']."</a></td>-->
<td><a href='program.php?Program=".$row['Program']."'>".$row['Program']."</a></td><td>$".number_format($row['sum(current)']).",000</td></tr>
  ";
    }echo"</tbody></table></div><div class='clear'></div>
		<div class='scroller'>
				<p>Mouse over/scroll for more results</p></div><br>";
       
}
	?>
  



<?php 
////////////////////////////////////////////////////////////

 if ( isset($_GET['Portfolio']) && !isset($_GET['Program']) && !isset($_GET['Component']))
 {
	 
$portfolio = $_GET['Portfolio']; 
echo"<h4>Commonwealth Tender totals by ABN for Programs in the $portfolio Portfolio</h4>";

$grants="SELECT Name,ABN,sum(Value),count(Value) as count FROM tenders where Portfolio='$portfolio' 
	GROUP BY ABN ORDER BY sum(Value) DESC";
$result = mysqli_query($db, $grants);
 @$num_results = mysqli_num_rows($result);


        if ($num_results >0)
        {
           echo"<div class='source'>Source: Historical Tenders data published at data.gov.au</div>
			   <div class='expand'><table class='basic'><tbody><tr><th>Recipient</th><th>ABN</th><th>Number</th><th>Total Value</th></tr>";
 while ($row = $result->fetch_assoc()) 
    {
      echo"
   <tr>    <td>".$row['Name']."</td> 
  <td><a href='recipient.php?ABN=".$row['ABN']."'>".$row['ABN']."</a></td>
  <td>(".number_format($row['count']).")</td>
  <td>$".number_format($row['sum(Value)'])."</td>
  </tr>";


    }
    echo" </tbody></table><br></div>Mouse/Scroll for more results. ";
        }
                 else 
				 {
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
$component=$_GET['Component'];
$program=$_GET['Program'];
      $sub_program = "SELECT * FROM `budget_table15_16`
 WHERE Program='$program' && Component ='$component' ";
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