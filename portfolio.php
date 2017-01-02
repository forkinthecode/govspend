<?php
require'header.php';
?>


        <div class="left">
	 <?php
	  if( isset($_GET['Portfolio']) && !isset($_GET['Program']) && !isset($_GET['Component'])  )
	  {
	 $portfolio=$_GET['Portfolio'];
	                             $total_current = "SELECT current,sum(current) FROM `budget_table15_16` ";
	                                $result = mysqli_query($db, $total_current );
                                                        
	                             while ($row = $result->fetch_assoc()) 
	                             $total_current = $row['sum(current)'];//assigns this value to a variable.
	                             ///////////////////////////////////////////
	                             $query_total_last = "SELECT last,sum(last) FROM `budget_table15_16` 
	                             WHERE Portfolio='$portfolio' GROUP BY Portfolio ";//calculates total fundingfor the prior budget year for agencies where search term forms part of their name
	                             $result = mysqli_query($db, $query_total_last);
                                                         
	                             while ($row = $result->fetch_assoc()) 
	                             $query_total_last_year = $row['sum(last)'];//assigns this value to a variable.
	                             ////////////////////////////////////////////////////////////////////
	                             $query_total_current = "SELECT current,sum(current) FROM  `budget_table15_16`
	                               WHERE Portfolio='$portfolio' GROUP BY Portfolio ";//calculates total fundingfor current year for agencies with search term in name
	                             $result = mysqli_query($db, $query_total_current );
                                                         
	                             while ($row = $result->fetch_assoc()) 
	                             $query_total_current_year = $row['sum(current)'];//assign this value to a variable

	                             //////////////////////////////////////////////////////////////////////////////////////////
	                             $percent = (($query_total_current_year/$total_current)*100);//$percent variable is used in scripts/tax_totals.php and the Flot pie graph
	                             //////////////////////////////////////////////////////////////////////////////////////////

	                             $billion_ = "SELECT current,sum(current) FROM `budget_table15_16`
	                             WHERE Portfolio='$portfolio' GROUP BY Portfolio ";
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
                            

	 						   	 echo"<hr><table class='stats'>
	 						   	 <tr><th>Total</th><th>Corporate Taxes</th><th>Personal Taxes</th></tr>
	 						   	 <tr><th><h3>$".number_format($billion, 3)." B</h3></th>
	 						   	 <th><h3>$".number_format($actual_TOS,3)." B</h3></th>
	 						   	 <th><h3>$".number_format($actual_PIT, 3)." B</h3></th>

	 						   	</tr></table><hr><div class='source'>Source: Calculated based on figures in budget documents</div>
							";
	                                }
	 }
	                             ?>
    <?php
     if ( !isset($_GET['Portfolio']) )
     {
	$total = "SELECT *,sum(current) FROM `budget_table15_16` group by Portfolio ORDER BY sum(current) DESC ";
	$result = mysqli_query($db, $total );
	echo"<p>Click on the Portfolio name to get breakdown of spending by that Portfolio</p> <div class='source'>Source: Calculated from Line item CSV 
	Portfolio Budget Statements published at <a href='http://data.gov.au/dataset/budget-2015-16-tables-and-data'>data.gov.au</a></div><table class='wide' border='0'><tbody>";
	 while ($row = $result->fetch_assoc()) 
	    {

	echo"
	  <tr>
 <td><a href='portfolio.php?Portfolio=".$row['Portfolio']."'>".$row['Portfolio']."</td><td> $".number_format($row['sum(current)']).",000</td> 
	</tr>
	 ";
	}echo"</tbody></table><br>";
}
	?>
	
   <?php
    if ( isset($_GET['Portfolio']) )
    {
  
                      
$portfolio=$_GET['Portfolio'];
    
   $agor = "SELECT Agency,sum(current) FROM `budget_table15_16`
    WHERE Portfolio ='$portfolio' GROUP BY Agency ORDER BY sum(current) DESC ";
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
		   echo"<tr><td><a href='agency.php?Agency=".$row['Agency']."'>".$row['Agency']."</a></td><td>$".number_format($row['sum(current)']).",000</td></tr>";
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
                            

	 						   	 echo"<hr><table class='stats'>
	 						   	 <tr><th>Total</th><th>Corporate Taxes</th><th>Personal Taxes</th></tr>
	 						   	 <tr><th><h3>$".number_format($billion, 3)." B</h3></th>
	 						   	 <th><h3>$".number_format($actual_TOS,3)." B</h3></th>
	 						   	 <th><h3>$".number_format($actual_PIT, 3)." B</h3></th>

	 						   	</tr></table><hr><div class='source'>Source: Calculated based on figures in budget documents</div>";
	                                }
	 }
	                             ?>
								 <?php
								  if ( isset($_GET['Portfolio']) && !isset($_GET['Program']) && !isset($_GET['Component']))
								  {
  
								 $portfolio = $_GET['Portfolio']; 


								 $total="SELECT Portfolio,sum(Value),AVG(Value) as AVE, count(Value) as count FROM tenders where Portfolio='$portfolio'
								 	  GROUP BY Portfolio";
								 $result = mysqli_query($db, $total);
								 @$num_results = mysqli_num_rows($result);


	     
								 echo"<hr><h4>Commonwealth Tender totals for Programs in the $portfolio Portfolio</h4>
								 ";
								 echo"<table class='stats'><tbody><th>Number</td><th>Average Value</th><th>Total</td></tr>";
								 while ($row = $result->fetch_assoc()) 
								    {
										echo"<tr><th>".number_format($row['count'])."</th><th>$".number_format($row['AVE'])."</th>
											<th>$".number_format($row['sum(Value)'])."</th></tr>";
	   
								    }
								    echo"<tbody></table><hr>	<br>";
	
   
								 }
	 
								 ?>

	 
 <?php
	  if( isset($_GET['Component']) ||  isset($_GET['Program']) &&  isset($_GET['Portfolio']) )
	 
	  {
		//include'program_totals.php';
	  }
	                             ?>
								 	 
	 

 <?php
 if ( isset($_GET['Program']) && !isset($_GET['Component']))
 {
	 
                   $program = $_GET['Program']; 
                   
                 //  $agency=mysqli_real_escape_string($agency);

 echo"<h4>Details for Commonwealth budget Program: $program </h2>";
$agor = "SELECT * FROM `budget_table15_16`
 WHERE Program ='$program' group by Program";
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
}

?>
<?php

	  if ( isset($_GET['Component']) && isset($_GET['Portfolio']))
	  {
$portfolio=$_GET['Portfolio'];
$program=$_GET['Program'];
$component=$_GET['Component'];/*
 echo"<h4>Details for Commonwealth budget Program: $program </h2>";
$agor = "SELECT * FROM `budget_table15_16`
 WHERE Portfolio ='$portfolio' && Program ='$program' group by Program";
$result = mysqli_query($db, $agor );
echo"  <div class='source'>Source: Line item CSV 
Portfolio Budget Statements published at 
<a href='http://data.gov.au/dataset/budget-2015-16-tables-and-data'>data.gov.au</a></div><table class='basic'><tbody>";
 while ($row = $result->fetch_assoc()) 
    {
       echo" 
  
  <tr><td>Portfolio</td><td><a href='portfolio.php?Portfolio=".$row['Portfolio']."' target='_blank'>".$row['Portfolio']."</a></td></tr>
  <tr><td>Agency</td><td><a href='portfolio.php?Agency=".$row['Agency']."' target='_blank'>".$row['Agency']."</a></td></tr>
  <tr><td>Program</td><td><a href='portfolio.php?Portfolio=".$row['Portfolio']."&Program=".$row['Program']."'>".$row['Program']."</a></td></tr>
  <tr><td>Outcome</td><td>".$row['Outcome']."</td></tr>";

}echo"</tbody><table>";*/
	       $sub_program = "SELECT * FROM `budget_table15_16`
	  WHERE Portfolio='$portfolio' && Component ='$component' ";
	 $result = mysqli_query($db, $sub_program);
	 while ($row = $result->fetch_assoc()) 
	 {
         echo" 
			 <div class='source'>Source: Line item CSV 
			 Portfolio Budget Statements published at 
			 <a href='http://data.gov.au/dataset/budget-2015-16-tables-and-data'>data.gov.au</a></div><table class='basic'><tbody>
    <tr><td>Portfolio</td><td><a href='portfolio.php?Portfolio=".$row['Portfolio']."' target='_blank'>".$row['Portfolio']."</a></td></tr>
    <tr><td>Agency</td><td><a href='portfolio.php?Agency=".$row['Agency']."' target='_blank'>".$row['Agency']."</a></td></tr>
    <tr><td>Program</td><td><a href='portfolio.php?Portfolio=".$row['Portfolio']."&Program=".$row['Program']."'>".$row['Program']."</a></td></tr>
    <tr><td>Outcome</td><td>".$row['Outcome']."</td></tr>";
	echo"</tbody><table>";
	
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
 if ( isset($_GET['Program']) )
 {
	 
                   $program = $_GET['Program']; 

$component = "SELECT * FROM `budget_table15_16` WHERE Program LIKE'%$program%' ";
$result = mysqli_query($db, $component );
 @$num_results = mysqli_num_rows($result);

        if ($num_results >0)
        {
          echo"Click on the Component name (below) to show distribution of recpients by Federal electorate (income support payments only)<h4>
			  ($num_results) Components:</h4>
        
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
 if ( isset($_GET['Portfolio']) && !isset($_GET['Program']) && !isset($_GET['Component']) )
 {
  
$portfolio = $_GET['Portfolio']; 

$test="SELECT id from grants where Portfolio='$portfolio'";
$result = mysqli_query($db, $test);
@$num_results = mysqli_num_rows($result);


       if ($num_results >0)
       {
$total="SELECT sum(Funding),AVG(Funding) as AVE, count(Funding) as count FROM grants where Portfolio='$portfolio' 
	&& Year='2015-16'";
$result = mysqli_query($db, $total);
@$num_results = mysqli_num_rows($result);


       
echo"<h4>Commonwealth Grant totals for Programs in the $portfolio Portfolio</h4>
";
echo"<table class='stats'><tbody><th>Number</td><th>Average Value</th><th>Total</td></tr>";
while ($row = $result->fetch_assoc()) 
   {echo"<tr><th>".number_format($row['count'])."</th><th>$".number_format($row['AVE'])."</th><th>$".number_format($row['sum(Funding)'])."</th></tr>";
	   
   }
   echo"<tbody></table><hr>	<br>";
      }
   
}

?>
<?php
 if ( isset($_GET['Portfolio']) && !isset($_GET['Program']) && !isset($_GET['Component']))
 {
  
$portfolio = $_GET['Portfolio']; 


$grants="SELECT Electorate,sum(Funding) FROM grants where Year='2015-16' && Portfolio ='$portfolio'
&& Electorate !='None' GROUP BY Electorate ORDER BY sum(Funding) DESC ";
$result = mysqli_query($db, $grants);
 @$num_results = mysqli_num_rows($result);


        if ($num_results >0)
        {
           echo"<div class='expand'><div class='source'>Source: Grants data published at agency websites</div><table class='basic' ><tbody>";
 while ($row = $result->fetch_assoc()) 
    {
      echo"<tr>
      <td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td>
	  <td>$".number_format($row['sum(Funding)'])."</td></tr>";


    }
    echo" </tbody></table></div><br>";
        }
                

}mysqli_free_result($result);
                 ?>


<?php 
////////////////////////////////////////////////////////////

 if ( isset($_GET['Portfolio']) && !isset($_GET['Program']) && !isset($_GET['Component']))
 {
	 
$portfolio = $_GET['Portfolio']; 


$grants="SELECT *,sum(Funding),count(Funding) as count FROM grants where Portfolio='$portfolio' && Year='2015-16'
	GROUP BY Recipient ORDER BY sum(Funding) DESC";
$result = mysqli_query($db, $grants);
 @$num_results = mysqli_num_rows($result);
       if ($num_results <4 && $num_results>0)
       {
          echo"<h4>Commonwealth Grant totals by Recipient for Programs in the $portfolio Portfolio</h4><div class='source'>Source: Historical Tenders data published at data.gov.au</div>
		 <table class='basic'><tbody><tr><th>Recipient</th><th>Number</th><th>Total Value</th></tr>";
while ($row = $result->fetch_assoc()) 
   {
     echo"
  <tr>    <td><a href='recipient.php?Recipient=".$row['Recipient']."'>".$row['Recipient']."</a></td> 
 <td>(".number_format($row['count']).")</td>
 <td>$".number_format($row['sum(Funding)'])."</td>
 </tr>";


   }
   echo" </tbody></table><br> ";
       }

        if ($num_results >4)
        {
           echo"<h4>Commonwealth Grant totals by Recipient for Programs in the $portfolio Portfolio</h4><div class='source'>Source: Historical Tenders data published at data.gov.au</div>
			   <div class='expand'><table class='basic'><tbody><tr><th>Recipient</th><th>Number</th><th>Total Value</th></tr>";
 while ($row = $result->fetch_assoc()) 
    {
      echo"
   <tr>    <td><a href='recipient.php?Recipient=".$row['Recipient']."'>".$row['Recipient']."</a></td> 
  <td>(".number_format($row['count']).")</td>
  <td>$".number_format($row['sum(Funding)'])."</td>
  </tr>";


    }
    echo" </tbody></table><br></div>Mouse/Scroll for more results. ";
        }
                 else 
				 {
                 }

}mysqli_free_result($result);
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



 
  <?php
  if ( isset($_GET['Program']) )
  {


               
  $program=$_GET['Program'];

 $grants = "SELECT *,sum(Funding),count(Funding) FROM grants 
  WHERE Program ='$program' && Year='2015-16' GROUP BY Electorate  ORDER BY sum(Funding) DESC ";
 $result = mysqli_query($db, $grants );
  @$num_results = mysqli_num_rows($result);

         if ($num_results >0)
         {
           echo"
   <h4>There are ".number_format($num_results)." grants administered under the $program Program in the 15-16 FY:</h4><br>
 		 <div class='source'>Source: Grants data published at agency websites</div> <table class='basic'><tbody>";
  while ($row = $result->fetch_assoc()) 
     {
		
     echo"<tr>
     <td><a href='electorate.php?Electorate=".$row['Electorate']."&Program=".$row['Program']."'>".$row['Electorate']."</a></td>
	 <td>".$row['count(Funding)']."</td>
  <td>$".number_format($row['sum(Funding)'])."</td></tr>";


 

     }echo"</tbody></table><p>Mouse over/scroll for more results</p>";
        }
        if ($num_results <1)
        {echo"<h4>There are no grants matching $program</h4>";
        }
 }mysqli_free_result($result);

         ?>
		 
		 
 <?php
 include'income_support.php';
 ?>
	  <?php/*
	  $portfolio=$_GET['Portfolio'];
	  
	  if ( $portfolio ='Social Services%' )
	  {
		 
	  $component=$_GET['Component'];
	  if (  $portfolio =='Social Services' && $component !='Carer Allowance (Adult)' 
	 	 || $component !='Compensation and debt relief' 
	 	 || $component !='Child Disability Assistance Payment)' 
	 	 || $component !='Carer Supplement' 
	 	 || $component !='Ex-Gratia Payments to Unsuccessful Applicants of Carer Payment (Child)'
	 	 || $component !='Mobility Allowance' 
	 	 || $component !='Pensioner Education Supplement' 
	 	 || $component !='Utilities Allowance (Working Age Payments)'
	 	 || $component !='Investment Approaches to Welfare - Evaluation'
	  	 || $component != 'Age Pension and Pensioner Concessions Information'
	  	 || $component != 'Extend deeming provisions to account-based income streams _ awareness strategy')
		
	       {
	 	 echo"<h4>Caveats</h4>
	 		 <div class='source'>Source: Department of Social Services published at <a href='http://data.gov.au/dataset/dss-payment-demographic-data'>data.gov.au</a></div>
	 <p>
	    In order to protect individuals' privacy, identified populations between 1 and 19 have been suppressed and replaced with ‘20’ for confidentiality purposes. Additional data may be suppressed and replaced with ‘n.p.’ (not published) to prevent the derivation of identified populations that have values of less than 20. This prevents information from being broken down or manipulated to the degree that individuals may be identified. In some cases populations with invalid, missing, unknown or 'other' values (where 'other' includes unknown values) are not suppressed as this information cannot be used to identify individuals. n/a (not applicable/not available) is used where the data is either unavailable or the
	   data is not reported as it is part of the eligibility criteria for the payment (i.e. Widow Allowance by Gender). </p>";
  
	       }
	   }

	 */
 
	 ?>

</div></div>
<div class='clear'></div>
<?php 
    include('footer.php');?>

    </body>
</html>