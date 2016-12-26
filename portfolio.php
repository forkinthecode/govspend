<?php
require'header.php';
?>


        <div class="left">

    
   <?php
    if ( isset($_GET['Portfolio']) && !isset($_GET['Component'] ))
    {
  
                      
$portfolio=$_GET['Portfolio'];
    
   $agor = "SELECT DISTINCT Agency FROM `budget_table15_16`
    WHERE Portfolio ='$portfolio' ";
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
 if ( isset($_GET['Portfolio']) )
 {
  
$portfolio=$_GET['Portfolio'];
 echo"<h4>Programs administered by the $portfolio Portfolio</h2>";
$agor = "SELECT sum(current),Portfolio,Program FROM `budget_table15_16`
 WHERE Portfolio LIKE'%$portfolio%' GROUP BY Program ORDER BY sum(current) DESC ";
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
<p>Structure of the Commonwealth budget: Portfolio->Agencies->Programs->Component/Sub-Program->Grants & Tenders</p>
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


 <?php
  if ( isset($_GET['Component'])  && isset($_GET['Program']) && isset($_GET['Agency']))
  {
  $component= mysqli_escape_string(trim($_GET['Component']));
       $sub_program = "SELECT * FROM `budget_table15_16`
  WHERE Program LIKE'%$program%' && Agency LIKE'%$agency%' && Component LIKE'%$component%' ";
 $result = mysqli_query($db, $sub_program);
 echo"<h4>$component details:</h4><div class='source'>Source: Line item CSV 
 Portfolio Budget Statements published at <a href='http://data.gov.au/dataset/budget-2015-16-tables-and-data'>data.gov.au</a></div>
<div class='expand'>
 	<table class='basic'><tbody>";
 while ($row = $result->fetch_assoc()) 
 {
 echo"
 
   <tr><td>Component</td><td>".$row['Component']."</td></tr>
    <tr><td>Expense Type</td><td> ".$row['Expense_Type']."</td></tr>
   <tr><td>Appropriation Type</td><td> ".$row['Appropriation_Type']."</td></tr>
   <tr><td>Cost</td><td>$".number_format($row['current']).",000</td></tr>
   <tr><td>".$row['Source_Table']."</td><td> ".$row['Source']."</td></tr>
  

   ";

 }echo"</tbody></table><br></div><br>";
 }mysqli_free_result($result);

 ?>
 
 

	   <?php/*
	   if ( isset($_GET['Program']) || isset($_GET['Component']))
	   {
  
                  
                   
	$program=mysqli_real_escape_string(trim($_GET['Program']));

	  echo"<h4>Details for Commonwealth budget Program: $program </h2>";
	  $agor = "SELECT * FROM `budget_table15_16` WHERE Program LIKE'%$program%' GROUP BY Program";
	  $result = mysqli_query($db, $agor );
	  echo"  <div class='source'>Source: Line item CSV 
	  Portfolio Budget Statements published at <a href='http://data.gov.au/dataset/budget-2015-16-tables-and-data'>data.gov.au</a></div>"
	 ;
	   while ($row = $result->fetch_assoc()) 
	      {
	         echo" 
	    <table class='basic'><tbody>
	    <tr><td>Portfolio</td><td><a href='portfolio.php?Portfolio=".$row['Portfolio']."' target='_blank'>".$row['Portfolio']."</a></td></tr>
	    <tr><td>Agency</td><td><a href='agency.php?Agency=".$row['Agency']."' target='_blank'>".$row['Agency']."</a></td></tr>
	    <tr><td>Program</td><td><a href='portfolio.php?Portfolio=".$row['Portfolio']."&Program=".$row['Program']."'>".$row['Program']."</a></td></tr>
	    <tr><td>Outcome</td><td>".$row['Outcome']."</td></tr></tbody><table><br>";

	  }


	  $component = "SELECT * FROM `budget_table15_16`
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
	  <td><a href='portfolio.php?Agency=".$row['Agency']."&Program=".$row['Program']."&Component=".$row['Component']."'>".$row['Component']."</a></td>
	  </tr>
 
	  ";
	      }echo"</tbody></table><br>";
   
   
	  }else "No results for $program";

    
	  }mysqli_free_result($result);
*/
	          ?>
	 
 </div>
 <div class='right'>
 
	 

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



$component = "SELECT * FROM `budget_table15_16`
 WHERE Program='$program' ";
$result = mysqli_query($db, $component );

 @$num_results = mysqli_num_rows($result);

        if ($num_results >0)
        {
          echo"Click on the Component name to show distribution of recpients by Federal electorate (income support payments only)<h4>($num_results) Components:</h4>
        
          <table class='component'><tbody>";
 while ($row = $result->fetch_assoc()) 
    {
echo"<tr><td><img style='height:15px; opacity:0.4' src='images/chevron.png'></img></td>
<td><a href='portfolio.php?Portfolio=".$row['Portfolio']."&Program=$program&Component=".$row['Component']."'>".$row['Component']."</a></td>
</tr>
 
";
    }echo"</tbody></table><br>";
   
   
}else "No results for $program";

    
}mysqli_free_result($result);

        ?>
	 <?php
	  if ( isset($_GET['Component']) && isset($_GET['Portfolio']))
	  {
$portfolio=$_GET['Portfolio'];
$component=$_GET['Component'];
	       $sub_program = "SELECT * FROM `budget_table15_16`
	  WHERE Portfolio='$portfolio' && Component ='$component' ";
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
 if ( isset($_GET['Portfolio']) && !isset($_GET['Program']))
 {
  
$portfolio = $_GET['Portfolio']; 
echo"<hr><h4>Commonwealth Grant totals for Programs in the $portfolio Portfolio</h4>";

$total="SELECT Portfolio,sum(Funding),AVG(Funding) as AVE, count(Funding) as count FROM grants where Portfolio='$portfolio'
	 && Year='2015-16' GROUP BY Portfolio";
$result = mysqli_query($db, $total);
echo"<table class='stats'><tbody><th>Number</td><th>Average Value</th><th>Total</td></tr>";
while ($row = $result->fetch_assoc()) 
   {echo"<tr><th>".number_format($row['count'])."</th><th>$".number_format($row['AVE'])."</th><th>$".number_format($row['sum(Funding)'])."</th></tr>";
	   
   }
   echo"<tbody></table><hr><br>";
   


$grants="SELECT *,sum(Funding) FROM grants where Portfolio='$portfolio' && Year='2015-16' GROUP BY Program";
$result = mysqli_query($db, $grants);
 @$num_results = mysqli_num_rows($result);


        if ($num_results >0)
        {
           echo"<div class='source'>Source: Grants data published at agency websites</div><table class='basic' ><tbody>";
 while ($row = $result->fetch_assoc()) 
    {
      echo"<tr>
      <td><a href='portfolio.php?Portfolio=".$row['Portfolio']."&Program=".$row['Program']."'>".$row['Program']."</a></td>
	  <td>$".number_format($row['sum(Funding)'])."</td></tr>";


    }
    echo" </tbody></table><br>";
        }
                 else 
				 {
 }

}mysqli_free_result($result);
                 ?>




<?php/* implement once portfolio is added to tenders
////////////////////////////////////////////////////////////
 if ( isset($_GET['Portfolio']) && !isset($_GET['Component']))
 {
	 
$portfolio = $_GET['Portfolio']; 
echo"<h4>Commonwealth Tender totals for Programs in the $portfolio Portfolio</h4><p>Totals by ABN</p>";

$grants="SELECT *,sum(Value),count(Value) as count FROM tenders where Portfolio='$portfolio' GROUP BY ABN ORDER BY sum(Value) DESC";
$result = mysqli_query($db, $grants);
 @$num_results = mysqli_num_rows($result);


        if ($num_results >0)
        {
           echo"<div class='source'>Source: Historical Tenders data published at data.gov.au</div><div class='expand'>";
 while ($row = $result->fetch_assoc()) 
    {
      echo"<table class='basic' ><tbody>
   <tr>  <td>Name</td> <td>".$row['Name']."</td></tr>
   <tr> <td>ABN</td><td><a href='recipient.php?ABN=".$row['ABN']."'>".$row['ABN']."</a></td></tr>
   <tr>	 <td>Value</td> <td>(".number_format($row['count']).")<span class='right'>$".number_format($row['sum(Value)'])."</a></td></tr></tbody></table><br>";


    }
    echo" </div>Mouse/Scroll for more results. ";
        }
                 else 
				 {
                 }

}mysqli_free_result($result);*/
                 ?>



 
  <?php
  if ( isset($_GET['Program']) )
  {


               
  $program=$_GET['Program'];

 $grants = "SELECT *, DATE_FORMAT( Approved,  '%D %b %Y' ) AS Approved,
          DATE_FORMAT(End,  '%D %b %Y' ) AS End,
          DATEDIFF(END,APPROVED)/30 AS Term FROM grants 
  WHERE Program ='$program' && Year='2015-16'  ORDER BY Postcode ";
 $result = mysqli_query($db, $grants );
  @$num_results = mysqli_num_rows($result);

         if ($num_results >0)
         {
           echo"
   <h4>There are $num_results grants administered under the $program Program in the 15-16 FY:</h4><br>
 		 <div class='source'>Source: Grants data published at agency websites</div> <div class='expand'>";
  while ($row = $result->fetch_assoc()) 
     {
  
 include'grants_table.php';

     }echo"</div><p>Mouse over/scroll for more results</p>";
        }
        if ($num_results <1)
        {echo"<h4>There are no grants matching $program</h4>";
        }
 }mysqli_free_result($result);

         ?>

 <?php
  $component=$_GET['Component'];
 if (  $component =='Age Pension')
 {
	 $query="SELECT Electorate,Age_Pension FROM welfare_by_electorate ORDER BY Age_Pension DESC";
	  $result = mysqli_query($db, $query );
	  echo"
		  
		  <H3>$program recipients by Federal Electorate</h3>
	  <div class='source'>Source: Department of Human Services published at data.gov.au</div>
	  
	  <div class='expand'><table class='wide'><tbody><tr><td>Federal Electorate</td><td>Number</td></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {
	  
	 echo"<tr><td>".$row['Electorate']."</td>
		      <td>".number_format($row['Age_Pension'])."</td>";
 }echo"</tbody></table></div>";
 }
 
 ?>
 <?php
  $component=$_GET['Component'];
 if (  $component =='Family Tax Benefit Part A')
 {
	 $query="SELECT Electorate,FTB_A FROM welfare_by_electorate ORDER BY FTB_A  DESC";
	  $result = mysqli_query($db, $query );
	  echo"<H3>FTB A recipients by Federal Electorate</h3>
		  
		  <div class='source'>Source: Department of Human Services published at data.gov.au</div>
		  <div class='expand'><table class='wide'><tbody><tr><td>Federal Electorate</td><td>Number</td></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {
	  
	 echo"<tr><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td>
		      <td>".number_format($row['FTB_A'])."</td>";
 }echo"</tbody></table></div>Mouse/Scroll for more results<br>";
 }
 
 ?>
 <?php
  $component=$_GET['Component'];
 if (  $component =='Family Tax Benefit Part B')
 {
	 $query="SELECT Electorate,FTB_B FROM welfare_by_electorate ORDER BY FTB_B  DESC";
	  $result = mysqli_query($db, $query );
	  echo"<H3>FTB B recipients by Federal Electorate</h3>
		  <div class='source'>Source: Department of Human Services published at data.gov.au</div>
		  <div class='expand'><table class='wide'><tbody><tr><td>Federal Electorate</td><td>Number</td></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {
	  
	 echo"<tr><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td>
		      <td>".number_format($row['FTB_B'])."</td>";
 }echo"</tbody></table></div>Mouse/Scroll for more results";
 }
 
 ?>
 <?php
 $component=$_GET['Component'];
 if (  $component =='Newstart Allowance')
 {
	 $query="SELECT Electorate,Newstart FROM welfare_by_electorate ORDER BY Newstart  DESC";
	  $result = mysqli_query($db, $query );
	  echo"
		  <H3>NewStart recipients by Federal Electorate</h3><div class='source'>Source: Department of Human Services published at data.gov.au</div>
	  <div class='expand'>
	  <table class='wide'><tbody><tr><td>Federal Electorate</td><td>Number</td></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {
	  
	 echo"<tr><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td>
		      <td>".number_format($row['Newstart'])."</td>";
 }echo"</tbody></table></div>Mouse/Scroll for more results<br>";
 }
 
 ?>
 <?php
 $component=$_GET['Component'];
 if (  $component =='Widow B Pension')
 {
	 $query="SELECT Electorate,WidowB_Pension FROM welfare_by_electorate ORDER BY WidowB_Pension  DESC";
	  $result = mysqli_query($db, $query );
	  echo"<H3>NewStart recipients by Federal Electorate</h3><div class='source'>Source: Department of Human Services published at data.gov.au</div>
		  
	  
	  <div class='expand'><table class='wide'><tbody><tr><td>Federal Electorate</td><td>Number</td></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {
	  
	 echo"<tr><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td>
		      <td>".number_format($row['WidowB_Pension'])."</td>";
 }echo"</tbody></table></div>Mouse/Scroll for more results<br>";
 }
 
 ?>

</div></div>
<div class='clear'></div>
<?php 
    include('footer.php');?>

    </body>
</html>