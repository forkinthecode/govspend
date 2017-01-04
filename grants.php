<?php
require'header.php';
?>


        <div class="left">
 <form action="grants.php">
 
     <input type="text" id="Program" name="Program" placeholder="Program key word eg Indigenous" > <button type="submit" id='submit' value="Submit"> Find </button>
 </form>
     <form action="grants.php">
     <input type="text" id="Recipient" name="Recipient" placeholder="name" > <button type="submit" id='submit' value="Submit"> Find </button>
 </form>

 <?php
 if ( isset($_GET['Program']) )
  {
 $data = $_GET['Program']; 
 $program=mysqli_real_escape_string ( $db , $data );

 $test="SELECT id from grants WHERE Program  LIKE'%$program%' 
	 || Component LIKE'%$component%' && Year='2015-16' && Program !=''";
 $result = mysqli_query($db, $test );
   @$num_results = mysqli_num_rows($result);
   if ($num_results >0)
   {
	 
 $grants = "SELECT *,count(Funding) as count FROM grants WHERE Program LIKE'%$program%' 
	 || Component LIKE'%$component%' && Year='2015-16' GROUP BY Component ORDER BY count(Funding) DESC ";
 $result = mysqli_query($db, $grants );

 echo"<h4>Commonwealth Grants with Program and/or Component name matching: $program</h4>
 <p>(With approval dates within the 2015-16 financial year)</p><div class='source'>Source: Grants published at agency websites</div><div class='expand'> <table class='wide' ><tbody>
 <tr><th>Program</th><th>Component</th><th>Number</th></tr>";
  while ($row = $result->fetch_assoc()) 
      {

 echo"

 <tr><td><a href='grants.php?Program=$program&Program_Name=".$row['Program']."&Component=".$row['Component']."'>".$row['Program']."</a></td>       
  <td>".$row['Component']."</td>

<td><span style='float:right'>".number_format($row['count'])."</span></td></tr>

 ";
      }echo"</tbody></table><br></div>Mouse/Scroll for more results or Click on the Program name to display details of grants to $recipient for that program ";
    }

 }

 ?>
 


 <?php
 if ( isset($_GET['Recipient']) && !isset($_GET['Program_Name'])  )
  {
	
   $data = $_GET['Recipient']; 
   $recipient=mysqli_real_escape_string ( $db , $data );
   $query="SELECT  Recipient,count(Recipient) as count,sum(Funding) FROM grants 
	    WHERE Recipient LIKE '%$recipient%' && Year='2015-16' GROUP BY Recipient ORDER BY count(Recipient) DESC";
   $result = mysqli_query($db, $query );
     @$num_results = mysqli_num_rows($result);
     if ($num_results <1)
     {
     echo"<h4>There are no Commonwealth Grants received by organisations matching $recipient</h4>";
     }
     elseif ($num_results<16)
	 {
	  
  		   echo"<h3>$num_results Names matching $name in Commonwealth Grants</h3>
  			   <p>Name (No. Grants using that name)</p>
  			<table class='grants'>"; 
  		    while ($row = $result->fetch_assoc())
  	      {
    	 echo"<tr><td><a href='grants.php?Name=".$row['Recipient']."'>".$row['Recipient']."</a></td><td> (".$row['count'].")</td><td>$".number_format($row['sum(Funding)'])."</td> </tr>";
           
 
  	       }echo"</table>";
  	   }
   elseif ($num_results>16)
   {
	  
		   echo"<h3>".number_format($num_results)." Names matching $recipient in Commonwealth Grants</h3>
			   <p>Name (No. Grants using that name)</p>
			   <div class='expand'><table class='grants'>"; 
		    while ($row = $result->fetch_assoc())
	      {
  	 echo"<tr><td><a href='grants.php?Name=".$row['Recipient']."'>".$row['Recipient']."</a></td><td> (".$row['count'].")</td><td>$".number_format($row['sum(Funding)'])."</td> </tr>";
           
 
	       }echo"</table></div>Mouse/Scroll for more results";
	   }
	   
 }
   ?>
  



 
<?php
if ( isset($_GET['Name']) )
 {
$data = $_GET['Name']; 
$name=mysqli_real_escape_string ( $db , $data );
$query="SELECT * FROM grants WHERE Recipient='$name' && Year='2015-16' GROUP BY Recipient where Electorate!=''";

$result = mysqli_query($db, $query );
@$num_results = mysqli_num_rows($result);
  if ($num_results >0)
  {
 
  echo"<H4>Commonwealth Grants data information for $name</h4><table class='stats'><tbody>";
 while ($row = $result->fetch_assoc()) 
     {
echo"


  <tr><td>Recipient:</td><td><a href='grants.php?Recipient=".$row['Recipient']."'>".trim($row['Recipient'])."</a></td></tr>
  <tr><td>Address:</td><td>".$row['Locality']." <a href='locality.php?Postcode=".$row['Postcode']."'>".$row['Postcode']."</a></td></tr>
  <tr><td>Electorate:</td><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td></tr>
  <tr><td>Council:</td><td> <a href='council.php?Council=".$row['Council']."'>".$row['Council']."</a></td></tr>";

     }echo"</tbody></table>";
   }

}
?>


      <?php
      if ( isset($_GET['Recipient']) )
       {
      $data = $_GET['Recipient']; 
      $recipient=mysqli_real_escape_string ( $db , $data );
      $grants = "SELECT sum(Funding),count(Funding) 
     as count_ ,(sum(Funding)/count(Funding)) as Ave FROM grants WHERE Recipient LIKE'%$recipient%'
       && Year='2015-16'  ";
      $result = mysqli_query($db, $grants );
        @$num_results = mysqli_num_rows($result);
        if ($num_results>0)
        {
 
        echo"<h4>Statistics for Commonwealth Grants received by $recipient</h4><hr><table class='stats'><tbody><tr>
      	  <th>Total value</th><th>Number</th><th>Average</th></tr>";
       while ($row = $result->fetch_assoc()) 
           {

           echo"<tr><th>$".number_format($row['sum(Funding)'])."</th><th>".$row['count_']."</th><th>".number_format($row['Ave'])."</th></tr>";
           }echo"  </tbody></table><hr><p>*With approval dates during the 2015-16 FY</p><br> ";
          }
      }

      ?>
	  <?php
	   if ( !isset($_GET['Recipient']) && !isset($_GET['Name']) && !isset($_GET['Program_Name'])  )
	   { 
	  echo"<h4>Total Commonwealth Grants by Recipient</h4>";
	  $total = "SELECT Recipient,sum(Funding),count(Funding) as counts FROM `grants` WHERE 
	    Year='2015-16' && Recipient!='' GROUP BY Recipient ORDER BY sum(Funding) DESC ";
	   echo"<div class='expand'>
	   <table class='wide'>
	   <tbody>
	   <tr>
	   <th>Total Value</th>
	   <th>Number</th>
	   <th>Recipient</th>
	   </tr>";
	  $result = mysqli_query($db, $total );
	   while ($row = $result->fetch_assoc()) 
	      {

	  echo"
	  <tr> 
	    <td>$".number_format($row['sum(Funding)'])."</td>
	    <td>".number_format($row['counts'])."</td>
	    <td><a href='grants.php?Name=".$row['Recipient']."'>".$row['Recipient']."</a></td>
	  </tr>
	   ";
	      }echo" </tbody></table><br></div>";
	  }
	  ?>


 <br><br> 
   <?php
 if ( isset($_GET['Program']) || isset($_GET['Program_Name']) ||  isset($_GET['Recipient']) ||  isset($_GET['Name']))
 {
 
	 echo"
          <h3>About Commonwealth Grants data</h3>
    <p>Commonwealth grants data has been collected from multiple agency sites for inclusion in the GovSpend prototype. There is no guarantee this data is correct and is only included
 	when the grant report in question was published in a manner able to be transformed into usable data.</p> <p>Some grants will be missing from some agencies in GovSpend even if they are
 	on the agency website.</p>
 	<p>There is a specification for the information that should be collected from Commonwealth grant applicants for inclusion in grant reports. This specification is 
 	<a href='http://www.finance.gov.au/sites/default/files/resource-management-guide-no-412.pdf'>Resource Management Guide 412</a> (See the summary on page 16). Some agencies follow this
 	specification well, others do not. This specification requires a postcode be specified for where the grant money in question will be spent by each grant recipient (as opposed to where the grant recipient's headquarters are).
 				</p>
   <p>Some grants will be applied to a specific postcode, others will cover a larger area. Some grants are state-wide or national. Where this occurs it is difficult
 	to provide breakdown for how much of each of these grants applies to a single postcode. I have avoided including these amounts in totals by postcode.</p>
 	<p>For some time the government has been working on a new grants portal to provide whole of government grant reporting in a similar fashion to AusTenders
 	providing whole of government Commonwealth tender reporting. This new grants portal should have come online at grants.gov.au in December 2016.</p>
 
   <p>Please note that despite inclusion in Resource Management Guide 412, Commonwealth grants data (pre grants.gov.au) 
	does not include ABN which means that recipients of Commonwealth grants can not be easily matched with
	Commonwealth tender recipients or other datasets which contain this unique identifyer, nor can grant recipients be searched by ABN.</p>";
	
}
?>
 </div>
 <div class='right'>
	 <br><br>
	    <?php
	  if ( !isset($_GET['Program']) && !isset($_GET['Program_Name']) && !isset($_GET['Recipient']) && !isset($_GET['Name']))
	  {
 
	 	 echo"
	           <h3>About Commonwealth Grants data</h3>
	     <p>Commonwealth grants data has been collected from multiple agency sites for inclusion in the GovSpend prototype. There is no guarantee this data is correct and is only included
	  	when the grant report in question was published in a manner able to be transformed into usable data.</p> <p>Some grants will be missing from some agencies in GovSpend even if they are
	  	on the agency website.</p>
	  	<p>There is a specification for the information that should be collected from Commonwealth grant applicants for inclusion in grant reports. This specification is 
	  	<a href='http://www.finance.gov.au/sites/default/files/resource-management-guide-no-412.pdf'>Resource Management Guide 412</a> (See the summary on page 16). Some agencies follow this
	  	specification well, others do not. This specification requires a postcode be specified for where the grant money in question will be spent by each grant recipient (as opposed to where the grant recipient's headquarters are).
	  				</p>
	    <p>Some grants will be applied to a specific postcode, others will cover a larger area. Some grants are state-wide or national. Where this occurs it is difficult
	  	to provide breakdown for how much of each of these grants applies to a single postcode. I have avoided including these amounts in totals by postcode.</p>
	  	<p>For some time the government has been working on a new grants portal to provide whole of government grant reporting in a similar fashion to AusTenders
	  	providing whole of government Commonwealth tender reporting. This new grants portal should have come online at grants.gov.au in December 2016.</p>
 
	    <p>Please note that despite inclusion in Resource Management Guide 412, Commonwealth grants data (pre grants.gov.au) 
	 	does not include ABN which means that recipients of Commonwealth grants can not be easily matched with
	 	Commonwealth tender recipients or other datasets which contain this unique identifyer.</p>";
	
	 }
	 ?>
	    <?php
	  if ( isset($_GET['Recipient']) && isset($_GET['Program_Name'])  )
	  {
  
	    $recipient = $_GET['Recipient']; 
	    $program = $_GET['Program']; 
	   echo"<h4>$program grants for $recipient</h4>";
	 $total = "SELECT *,DATE_FORMAT( Approved,  '%D %b %Y' ) AS Approved,
	          DATE_FORMAT(End,  '%D %b %Y' ) AS End,
	          DATEDIFF(END,APPROVED)/30 AS Term  FROM `grants` 
	          WHERE Program like'%$program%' && Year='2015-16' && Recipient ='$recipient'
	             ";
	 $result = mysqli_query($db, $total );
	  @$num_results = mysqli_num_rows($result);
	 echo"<h3>Results for $recipient</h3>
	 <p>There are ".number_format($num_results)." grants received by organisations matching $name</p><div class='expand'>";
	  while ($row = $result->fetch_assoc()) 
	     {

	 include'grants_table.php';
	     }echo"</div>";
	 }
	 ?>
 
	   <?php
	 if ( !isset($_GET['Recipient']) && isset($_GET['Program_Name'])  && isset($_GET['Component'])  )
	 {
  
   
	   $program = $_GET['Program_Name']; 
       $component = $_GET['Component']; 
	  
	$total = "SELECT *,DATE_FORMAT( Approved,  '%D %b %Y' ) AS Approved,
	         DATE_FORMAT(End,  '%D %b %Y' ) AS End,
	         DATEDIFF(END,APPROVED)/30 AS Term  FROM `grants` 
	         WHERE Program ='$program' && Component='$component' && Year='2015-16' 
	            ";
	$result = mysqli_query($db, $total );
	 @$num_results = mysqli_num_rows($result);
	echo"
	<h3>There are $num_results grants for Program: $program with Component: $component </h3><div class='expand'>";
	 while ($row = $result->fetch_assoc()) 
	    {

	include'grants_table.php';
	    }echo"</div>";
	}
	?>
<?php
if ( isset($_GET['Name']) )
 {
$data = $_GET['Name']; 
$name=mysqli_real_escape_string ( $db , $data );

	

$grants = "SELECT sum(Funding),count(Funding) 
as count_ ,(sum(Funding)/count(Funding)) as Ave FROM grants WHERE Recipient ='$name'
 && Year='2015-16'  ";
$result = mysqli_query($db, $grants );
  @$num_results = mysqli_num_rows($result);
  if ($num_results>0)
  {
 
  echo"<h4>Statistics for Commonwealth Grants received by $name</h4><hr><table class='stats'><tbody><tr>
	  <th>Total value</th><th>Number</th><th>Average</th></tr>";
 while ($row = $result->fetch_assoc()) 
     {

     echo"<tr><th>$".number_format($row['sum(Funding)'])."</th><th>".$row['count_']."</th><th>".number_format($row['Ave'])."</th></tr>";
     }echo"  </tbody></table><hr><p>*With approval dates during the 2015-16 FY</p><br> ";
    }
}

?>
  
     <?php
     if ( isset($_GET['Name']) )
      {
     $data = $_GET['Name']; 
     $name=mysqli_real_escape_string ( $db , $data );
     $query="SELECT * FROM grants WHERE Recipient LIKE'%$name%' && Year='2015-16' ";

     $result = mysqli_query($db, $query );
     @$num_results = mysqli_num_rows($result);
       if ($num_results >0)
       {
 
       echo"<h3>Commonwealth Grants for $name</h3>
  		 <div class='expand'><table class='grants'><tbody>";
      while ($row = $result->fetch_assoc()) 
          {
 

  include'grants_table.php';

          }echo"</tbody></table></div>Mouse/Scroll for more results";
        }

     }
     ?>
   <?php
   if ( isset($_GET['Recipient']) )
    {
   $data = $_GET['Recipient']; 
   $recipient=mysqli_real_escape_string ( $db , $data );
   $query="SELECT * FROM grants WHERE Recipient LIKE'%$recipient%' && Year='2015-16' ";

   $result = mysqli_query($db, $query );
   @$num_results = mysqli_num_rows($result);
     if ($num_results >0)
     {
 
     echo"<h3>Commonwealth Grants for $recipient</h3>
		 <div class='expand'><table class='grants'><tbody>";
    while ($row = $result->fetch_assoc()) 
        {
 

include'grants_table.php';

        }echo"</tbody></table></div>Mouse/Scroll for more results";
      }

   }
   ?>


   <?php
 if ( isset($_GET['Name']) && isset($_GET['Program'])  )
 {
  
   $recipient = $_GET['Name']; 
   $program = $_GET['Program']; 
  echo"<h4>$program grants for $recipient</h4>";
$total = "SELECT *,DATE_FORMAT( Approved,  '%D %b %Y' ) AS Approved,
         DATE_FORMAT(End,  '%D %b %Y' ) AS End,
         DATEDIFF(END,APPROVED)/30 AS Term  FROM `grants` 
         WHERE Program like'%$program%' && Year='2015-16' && Recipient ='$name'
            ";
$result = mysqli_query($db, $total );
 @$num_results = mysqli_num_rows($result);
echo"
<p>There are $num_results grants received by organisations matching $name</p>";
 while ($row = $result->fetch_assoc()) 
    {

include'grants_table.php';
    }
}
?>

  
      
</div></div>
<div class='clear'></div>
 <?php 
    include('footer.php');?>

    </body>
</html>