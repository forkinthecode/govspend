<?php
require'header.php';
?>


        <div class="left">
			<?php
		    if ( isset($_GET['Topic']) && !isset($_GET['Recipient']))
		    {
				$topic=$_GET['Topic'];
				$query="SELECT *,sum(current), count(current) as count, AVG(current) FROM budget_table15_16 
					WHERE Program || Component like'%$topic%' GROUP BY '$topic'";
				$result = mysqli_query($db, $query );
				 @$num_results = mysqli_num_rows($result);

				        if ($num_results >0)
				        {
				          echo"<h3>Budget totals for Programs & Components matching $topic</h3>
        <hr>
				          <table class='stats'><tbody><tr>
	  <th>Total value</th><th>Number</th><th>Average</th></tr>";
				 while ($row = $result->fetch_assoc()) 
				    {
						echo"
				        <tr><th>$".number_format($row['sum(current)'])."</th><th>".number_format($row['count'])."</th>  
				           <th>$".number_format($row['AVG(current)'])."</th></tr>";
 
				
				    }echo"</tbody></table><hr><br>";
   
   
				           }else "No results for $topic";

    
				}mysqli_free_result($result);

				        ?>
			<?php
		    if ( isset($_GET['Topic']) && !isset($_GET['Recipient']))
		    {
				$topic=$_GET['Topic'];
				$query="SELECT * FROM budget_table15_16 WHERE Program || Component like'%$topic%'";
				$result = mysqli_query($db, $query );
				 @$num_results = mysqli_num_rows($result);

				        if ($num_results >0)
				        {
				          echo"Click on the Component name (below) to show details<h4>
							  ($num_results) Components:</h4>
        
				          <table class='component'><tbody>";
				 while ($row = $result->fetch_assoc()) 
				    {
				echo"<tr><td><img style='height:15px; opacity:0.4' src='images/chevron.png'></img></td>
				<td><a href='portfolio.php?Portfolio=".$row['Portfolio']."&Agency=".$row['Agency']."Program=".$row['Program']."&Component=".$row['Component']."'>".$row['Component']."</a></td>
				</tr>
 
				";
				    }echo"</tbody></table><br>";
   
   
				           }else "No results for $topic";

    
				}mysqli_free_result($result);

				        ?>
				
							
				
		
		

 <?php
  if ( isset($_GET['Topic']) && !isset($_GET['Recipient']))
  {

	$topic=$_GET['Topic'];
	 
 $charities="SELECT count(Legal_Name) as count,State FROM charities WHERE 
	  Unemployment LIKE'%$topic%' or
	  Animals LIKE'%$topic%' or 
	  Culture LIKE'%$topic%' or 
	  Education LIKE'%$topic%' or
	  Health LIKE'%$topic%' or
	  Policy LIKE'%$topic%' or
	  Environment LIKE'%$topic%' or
	  Rights LIKE'%$topic%' or
      Other  LIKE'%$topic%' or
	  Reconciliation LIKE'%$topic%' or
	  Religion LIKE'%$topic%' or
	  Social LIKE'%$topic%' or
	  Security LIKE'%$topic%' or
	  Indigenous LIKE'%$topic%' or
	  Aged LIKE'%$topic%' or
	  Children LIKE'%$topic%' or
	  Overseas LIKE'%$topic%' or
	  Ethnic_Groups LIKE'%$topic%' or
	  LGBT LIKE'%$topic%' or
	  MEN LIKE'%$topic%' or
	  Migrants LIKE'%$topic%' or
	  Offenders LIKE'%$topic%' or
	  Disabilities LIKE'%$topic%' or
	  Homelessness LIKE'%$topic%' or
	  Veterans LIKE'%$topic%' or
	  Crime LIKE'%$topic%' or
	  Disasters LIKE'%$topic%' or
	  Women LIKE'%$topic%' or
	  Youth LIKE'%$topic%' 
	 
	 
	 GROUP BY State";
$result = mysqli_query($db, $charities );
  @$num_results = mysqli_num_rows($result);
  if ($num_results>0)
  {
 echo"<h3>Breakdown by state of registered charities that have $topic as an issue </h3><table class='basic'>";
 while ($row = $result->fetch_assoc()) 
    {
	 echo"<tr><td>".$row['State']."</td><td> ".number_format($row['count'])."</td></tr>";
	}echo"</table>";
}
}
?>

<?php
 if ( !isset($_GET['Topic']) && !isset($_GET['ABN']))
 { 
echo"<h4>Total Commonwealth Grants by Purpose</h4>";
$total = "SELECT *,sum(Funding),count(Funding) as counts FROM `grants` WHERE 
  Year='2015-16' GROUP BY Purpose ORDER BY sum(Funding) DESC ";
 echo"<div class='expand'>
";
$result = mysqli_query($db, $total );
 while ($row = $result->fetch_assoc()) 
    {

echo" <table class='wide'>
 <tbody>
 <tr><td><a href='topic.php?Topic=".$row['Purpose']."'>".$row['Purpose']."</a></td></tr>
 <tr><td>(".number_format($row['counts']).")    $".number_format($row['sum(Funding)'])." </td></tr>
</tbody></table>
 ";
    }echo" <br></div>Mouse/Scroll for more results";
}
?>

 
<?php
if ( isset($_GET['Topic']) )
 {
$data = $_GET['Topic']; 
$topic=mysqli_real_escape_string ( $db , $data );

	

$grants = "SELECT sum(Funding),count(Funding) 
as count_ ,(sum(Funding)/count(Funding)) as Ave FROM grants WHERE Purpose LIKE'%$topic%'
 && Year='2015-16'  ";
$result = mysqli_query($db, $grants );
  @$num_results = mysqli_num_rows($result);
  if ($row['count_']!=0 )
  {
 
  echo"<h4>Statistics for Commonwealth Grants received by $topic</h4><hr><table class='stats'><tbody><tr>
	  <th>Total value</th><th>Number</th><th>Average</th></tr>";
 while ($row = $result->fetch_assoc()) 
     {

     echo"<tr><th>$".number_format($row['sum(Funding)'])."</th><th>".$row['count_']."</th><th>".number_format($row['Ave'])."</th></tr>";
     }echo"  </tbody></table><hr><p>*With approval dates during the 2014-15 FY</p><br> ";
    }
}

?>
<?php
if ( isset($_GET['Topic']) )
 {
$data = $_GET['Topic']; 
$topic=mysqli_real_escape_string ( $db , $data );
$query="SELECT * FROM grants WHERE Purpose LIKE'%$topic%' GROUP BY Recipient where Electorate!=''";

$result = mysqli_query($db, $query );
@$num_results = mysqli_num_rows($result);
  if ($num_results >0)
  {
 
  echo"<H4>Commonwealth Grants data information for $topic</h4><table class='stats'><tbody>";
 while ($row = $result->fetch_assoc()) 
     {
echo"


  <tr><td>Recipient:</td><td><a href='recipient.php?Topic=$topic&Recipient=".$row['Recipient']."'>".trim($row['Recipient'])."</a></td></tr>
  <tr><td>Address:</td><td>".$row['Locality']." <a href='locality.php?Postcode=".$row['Postcode']."'>".$row['Postcode']."</a></td></tr>
  <tr><td>Electorate:</td><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td></tr>
  <tr><td>Council:</td><td> <a href='council.php?Council=".$row['Council']."'>".$row['Council']."</a></td></tr>";

     }echo"</tbody></table>";
   }

}
?>


<?php
if ( isset($_GET['Topic']) )
 {
$data = $_GET['Topic']; 
$topic=mysqli_real_escape_string ( $db , $data );
$test="SELECT id FROM grants WHERE Purpose LIKE'%$topic%' && Year='2015-16' ";
$result = mysqli_query($db, $test );
  @$num_results = mysqli_num_rows($result);
  if ($num_results >0)
  {
	 
$grants = "SELECT *,sum(Funding) FROM grants WHERE Purpose  LIKE'%$topic%' && Year='2015-16' GROUP BY Program ";
$result = mysqli_query($db, $grants );

echo"<h4>Commonwealth Grants received for this purpose</h4>
<p>(With approval dates within the 2015-16 financial year)</p><div class='source'>Source: Grants published at agency websites</div>";
 while ($row = $result->fetch_assoc()) 
     {

echo"
<table class='wide' ><tbody>
<tr><td>Program</td>            <td><a href='portfolio.php?Portfolio=".$row['Portfolio']."&Program=".$row['Program']."'>".$row['Program']."</a></td></tr>
<tr><td>Portfolio:</td>         <td>".$row['Portfolio']."</td></tr>
<tr><td>Agency:</td>            <td>".$row['Agency']."</td></tr>
<tr><td>Total Value:</td>       <td><span style='float:right'>$".number_format($row['sum(Funding)'])."</span></td></tr>
 </tbody></table><br>
";
     }echo" <p>Click on the Program name to display details of grants to this topic </p> ";
   }

}

?>
 
       <?php
       if ( isset($_GET['Topic']) )
        {
 
         $data = $_GET['Topic']; 
         $name=mysqli_real_escape_string ( $db , $data );
 
     	$test="SELECT id FROM tenders WHERE MATCH(Description) AGAINST('$topic')";
         $result = mysqli_query($db, $test );
           @$num_results = mysqli_num_rows($result);
           if ($num_results >0)
           {
	
 
      $tenders = "SELECT *,sum(Value),count(Value) as count,AVG(Value)  FROM tenders WHERE MATCH(Description) AGAINST('$topic') GROUP BY '$topic' ";
      $result = mysqli_query($db, $tenders );
  

	 
     	 echo"<h3>Commonwealth Tenders received with tenders matching $topic</h3>
      <p>(With approval dates within the 2015-16 financial year)</p>
      <div class='source'>Source: Calculated using Historical Tenders data published at data.gov.au </div>
     <hr><table class='stats' ><tbody><tr><th>Number</th><th>Ave Value</th><th>Total Value</th></tr>";
       while ($row = $result->fetch_assoc()) 
          {

      echo"
 
     <tr><th>".number_format($row['count'])."</th><th>".number_format($row['AVG(Value)'])."</th>  
        <th>$".number_format($row['sum(Value)'])."</th></tr>";
          }echo" </tbody></table><hr><br>";
        }
      }

      ?>
      <?php
      if ( isset($_GET['Topic']) )
       {

        $data = $_GET['Topic']; 
        $name=mysqli_real_escape_string ( $db , $data );

    	$test="SELECT id FROM grants WHERE MATCH(Purpose) AGAINST('$topic')";
        $result = mysqli_query($db, $test );
          @$num_results = mysqli_num_rows($result);
          if ($num_results >0)
          {


     $tenders = "SELECT *,sum(Funding),count(Funding) as count,AVG(Funding)  FROM grants WHERE MATCH(Purpose) AGAINST('$topic') GROUP BY '$topic' ";
     $result = mysqli_query($db, $tenders );
 

 
    	 echo"<h3>Commonwealth Grants received with purpose matching $topic</h3>
     <p>(With approval dates within the 2015-16 financial year)</p>
     <div class='source'>Source: Calculated using grants data from agency websites</div>
    <hr><table class='stats' ><tbody><tr><th>Number</th><th>Ave Value</th><th>Total Value</th></tr>";
      while ($row = $result->fetch_assoc()) 
         {

     echo"

    <tr><th>".number_format($row['count'])."</th><th>".number_format($row['AVG(Funding)'])."</th>  
       <th>$".number_format($row['sum(Funding)'])."</th></tr>";
         }echo" </tbody></table><hr><br>";
       }
     }

     ?>
   
 
 

 </div>
 <div class='right'>
      
	 <?php
	 if ( isset($_GET['Topic']) )
	  {

	   $data = $_GET['Topic']; 
	   $topic=mysqli_real_escape_string ( $db , $data );
	   $query="SELECT  Name,count(Name) as count,sum(Value) FROM tenders 
		    WHERE MATCH(Description) AGAINST('$topic') GROUP BY Name ORDER BY sum(Value) DESC";
	   $result = mysqli_query($db, $query );
	     @$num_results = mysqli_num_rows($result);
	     if ($num_results <1)
	     {
	     echo"<h4>There are no Commonwealth Tender received by organisations with tenders matching this topic</h4>";
	     }
	     elseif ($num_results<16)
		 {
	  
	  		   echo"<h3>$num_results business names with tenders matching this topic in Commonwealth Tenders data</h3>
	  			   <p>Name (No. Tenders using that name)</p>
	  			<table class='grants'>"; 
	  		    while ($row = $result->fetch_assoc())
	  	      {
	    	 echo"<tr><td><a href='topic.php?Topic=$topic&Recipient=".$row['Name']."'>".$row['Name']."</a></td>
				 <td> (".$row['count'].")</td><td>$".number_format($row['sum(Value)'])."</td> </tr>";
           
 
	  	       }echo"</table>";
	  	   }
	   elseif ($num_results>16)
	   {
	  
			   echo"<h3>$num_results business names with tenders matching this topic in Commonwealth Tenders data</h3>
				   <p>Name (No. Tenders using that name)</p>
				   <div class='expand'><table class='grants'>"; 
			    while ($row = $result->fetch_assoc())
		      {
	  	 echo"<tr><td><a href='topic.php?Topic=$topic&Recipient=".$row['Name']."'>".$row['Name']."</a></td><td> (".$row['count'].")</td><td>$".number_format($row['sum(Value)'])."</td> </tr>";
           
 
		       }echo"</table></div>Mouse/Scroll for more results";
		   }
	   
	 }
	   ?>
	 
      <?php
      if ( isset($_GET['Topic']) && isset($_GET['Recipient']) )
       {
           $data1 = $_GET['Recipient']; 
           $name=mysqli_real_escape_string ( $db , $data1 );
        $data = $_GET['Topic']; 
        $topic=mysqli_real_escape_string ( $db , $data );
    	

     echo"<h4>Commonwealth Tenders received by $name for $topic</h4>
     <p>(With approval dates within the 2015-16 financial year)</p>
     <div class='source'>Source: Historical Tenders data published at data.gov.au </div><div class='expand'>";
  	$tenders="SELECT * FROM tenders  WHERE MATCH(Description) AGAINST('$topic') && Name='$name'";
      $result = mysqli_query($db, $tenders );
    
   
   

      while ($row = $result->fetch_assoc()) 
             {
   		  include'tenders_table.php';
  
              }echo"</div>Mouse over/Scroll for more results <p>Click on the Agency name to display details of all Tenders for that Agency</p> ";
          
     }

     ?>
  
       
     <?php
   if ( isset($_GET['Topic'])  && !isset($_GET['Recipient']) )
   {
  
     $topic = $_GET['Topic']; 
  
    echo"<h4>Commonwealth grants for this topic</h4>";
  $total = "SELECT *,DATE_FORMAT( Approved,  '%D %b %Y' ) AS Approved,
           DATE_FORMAT(End,  '%D %b %Y' ) AS End,
           DATEDIFF(END,APPROVED)/30 AS Term  FROM `grants` 
           WHERE Purpose like'%$topic%' && Year='2015-16' 
              ";
  $result = mysqli_query($db, $total );
   @$num_results = mysqli_num_rows($result);
  echo"
  <p>There are $num_results grants for this topic in the 15-16 FY </p>";
  
  if ($num_results>0){
	  echo"<div class='expand'>";
   while ($row = $result->fetch_assoc()) 
      {

  include'grants_table.php';
      }echo"</div>Mouse/Scroll for more results";
	  }
  }
  ?>
 
 
  



   <?php
 if ( isset($_GET['Topic']) && isset($_GET['Recipient'])  )
 {
  
   $topic = $_GET['Topic']; 
   $name = $_GET['Recipient']; 
  echo"<h4>Commonwealth grants for this topic</h4>";
$total = "SELECT *,DATE_FORMAT( Approved,  '%D %b %Y' ) AS Approved,
         DATE_FORMAT(End,  '%D %b %Y' ) AS End,
         DATEDIFF(END,APPROVED)/30 AS Term  FROM `grants` 
         WHERE Purpose like'%$topic%' && Year='2015-16' && Recipient ='$recipient'
            ";
$result = mysqli_query($db, $total );
 @$num_results = mysqli_num_rows($result);
echo"
<p>There are $num_results grants for this topic received by organisations matching $name</p>";
 while ($row = $result->fetch_assoc()) 
    {

include'grants_table.php';
    }
}
?>


		 <?php
		  if ( !isset($_GET['Topic']) && !isset($_GET['ABN']))
		  { 
		 echo"<h4>Total Commonwealth Tenders by Description</h4>";
		 $total = "SELECT *,sum(Value),count(Value) as counts FROM `tenders` 
		 GROUP BY Description ORDER BY sum(Value) DESC ";
		  echo"<div class='expand'>
		 ";
		 $result = mysqli_query($db, $total );
		  while ($row = $result->fetch_assoc()) 
		     {

		 echo" <table class='wide'>
		  <tbody>
		  <tr><td><a href='topic.php?Topic=".$row['Description']."'>".$row['Description']."</a></td></tr>
		  <tr><td>(".number_format($row['counts']).")    $".number_format($row['sum(Value)'])." </td></tr>
		 </tbody></table>
		  ";
		     }echo" <br></div>Mouse/Scroll for more results";
		 }
		 ?>
        


</div></div>
<div class='clear'></div>
 <?php 
    include('footer.php');?>

    </body>
</html>