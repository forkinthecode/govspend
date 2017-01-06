<?php
require'header.php';
?>



        <div class="left">

     <form action="electorate.php">
  <input type="text" id="Electorate" name="Electorate" placeholder="Federal Electorate" > <button type="submit" id='submit' value="Submit"> Find </button>
 </form>

<?php/*
 if ( isset($_GET['Electorate']) )
 {
	 
$data = $_GET['Electorate']; 
$electorate=mysqli_real_escape_string ( $db , $data );
$total = "SELECT * FROM `lga_pcode_electorate`  where Electorate ='$electorate' GROUP BY Electorate ";
$result = mysqli_query($db, $total );

include'electorate_details.php';
}*/
?>
<div class='clear'></div>

<?php
 if ( isset($_GET['Electorate']) )
 {
	 
$data = $_GET['Electorate']; 
$electorate=mysqli_real_escape_string ( $db , $data );

echo"<h3>SEIFA scores for $electorate</h3><br><hr><table class='stats'>
<tbody>
<tr>
<th>National Rank</th>
<th>National Decile</th>
<th></th>
</tr>";
$seifa = "SELECT AVG(rank) AS rank,AVG(decile) AS decile FROM `lga_pcode_electorate` 
join seifa_by_postcode on lga_pcode_electorate.postcode=seifa_by_postcode.postcode where Electorate='$electorate'";
$result = mysqli_query($db, $seifa );

  @$num_results = mysqli_num_rows($result);
  while ($row = $result->fetch_assoc()) 
    {
      echo"<tr><th>".number_format($row['rank'])."</th><th>".number_format($row['decile'])."/10 </th>";
    }
}
?>
  
  <?php
  if ( isset($_GET['Electorate']) )
  {
	$data = $_GET['Electorate']; 
	$electorate=mysqli_real_escape_string ( $db , $data );

$seifa = "SELECT AVG(decile) as decile FROM seifa_by_postcode JOIN lga_pcode_electorate on 
	seifa_by_postcode.postcode=lga_pcode_electorate.postcode WHERE Electorate ='$electorate' ";
$result = mysqli_query($db, $seifa );
echo"<th>";
 while ($row = $result->fetch_assoc()) 
    {
      $iterations=$row['decile'];
    }
 $i=0;
while ($i <= $iterations)
    {
 echo "<img height='15px' src='icon.png'></img>";
   $i++;
    }
  echo"</th></tr></tbody></table><div class='source'><a href=http://www.abs.gov.au/AUSSTATS/abs@.nsf/DetailsPage/2033.0.55.0012011?OpenDocument'>SEIFA data</a> 
  calculated based on the ABS from 2011 Census data</div>";
}
?>



<?php
 if ( isset($_GET['Electorate']) )
 {
  
$electorate = $_GET['Electorate']; 
echo"<div class='clear'></div><hr>
<h4>Local Government Areas included in $electorate </h4>";
$total = "SELECT Distinct council FROM `lga_pcode_electorate`  where Electorate='$electorate' ";
$result = mysqli_query($db, $total );
echo"<p>";
 while ($row = $result->fetch_assoc()) 
    {

echo"<a href='council.php?Council=".$row['council']."'>".$row['council']."</a> | ";
}echo"</p><hr><br>";
}
?>

<?php
 if ( !isset($_GET['Electorate']) )
 {
  

echo"<h4>Total Commonwealth Grants by Electorate</h4> <div class='source'>Source: DSS Payment by Demographic published at 
	<a href='http://data.gov.au/dataset/dss-payment-demographic-data'>data.gov.au</a></div> ";
$total = "SELECT Electorate,sum(Funding) FROM `grants` WHERE electorate !='' && Year='2015-16' GROUP BY electorate ";
$result = mysqli_query($db, $total );
echo"<div class='expand'><table class='wide' ><tbody>";
 while ($row = $result->fetch_assoc()) 
    {

echo"<tr><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td><td><span style='float:right'>$".number_format($row['sum(Funding)'])."</span></td></tr>";
}echo"</tbody></table><br></div>Mouse over/scroll for more results<div class='clear'></div> ";
}
?>

<?php
if ( isset($_GET['Electorate']) &&  !isset($_GET['Program']) )
 {
$data = $_GET['Electorate']; 
$electorate=mysqli_real_escape_string ( $db , $data );
$query="SELECT sum(Age_pension+PPP+PPS+Newstart+DSP+Austudy+Carer_Payment+YA_SA+YAO) as total
 FROM welfare_by_electorate where electorate='$electorate'";
$result = mysqli_query($db, $query);
echo"<div class='source'>Source: DSS Payment by Demographic published at 
	<a href='http://data.gov.au/dataset/dss-payment-demographic-data'>data.gov.au</a></div> ";
 while ($row = $result->fetch_assoc())
 {
$total_on_welfare=$row['total'];
//echo"$total_on_welfare<br>";
  }

  echo"<br><table class='council'><tbody><tr><td><span class='tiny'>Population</span></td><td><span class='tiny'>Welfare Recipients</span></td><td><span class='tiny'>Perecentage</span></td></tr>";
  
  echo"<tr><td>150,000</td><td>".number_format($total_on_welfare)."</td><td>".number_format(($total_on_welfare/150000)*100/1)."%</td></tr>";

}
echo"</tbody></table><br>";

?>
  <?php
  if ( isset($_GET['Electorate']) )
   {
  $data = $_GET['Electorate']; 
  $electorate=mysqli_real_escape_string ( $db , $data );
  echo"<h3>Breakdown by Payment Type</h3> <div class='source'>Source: DSS Payment by Demographic published at 
  	<a href='http://data.gov.au/dataset/dss-payment-demographic-data'>data.gov.au</a></div> 
  <table class='council'><tbody><tr><td>Payment Name</td><td>Number in Receipt</td></tr>";
  $seifa = "SELECT * FROM welfare_by_electorate WHERE Electorate ='$electorate' ";
  $result = mysqli_query($db, $seifa );
    @$num_results = mysqli_num_rows($result);
    if ($num_results >0)
   // echo"<tr><td>No SEIFA results</td><td>for $council</td><td></td></tr>";
   while ($row = $result->fetch_assoc()) 
      {
         echo"
        <tr><td>Age Pension</td><td>".number_format($row['Age_Pension'])." </td></tr>
        <tr><td>FTB A</td><td>".number_format($row['FTB_A'])." </td></tr>
        <tr><td>FTB B</td><td>".number_format($row['FTB_B'])." </td></tr>
        <tr><td>Parent Payment Partnered</td><td>".number_format($row['PPP'])." </td></tr>
        <tr><td>Parent Payment Single</td><td>".number_format($row['PPS'])." </td></tr>
        <tr><td>NewStart</td><td>".number_format($row['Newstart'])." </td></tr>
        <tr><td>Disability Pension</td><td>".number_format($row['DSP'])." </td></tr>
        <tr><td>Austudy</td><td>".number_format($row['Austudy'])." </td></tr>
        <tr><td>Carers Payment</td><td>".number_format($row['Carer_Payment'])." </td></tr>
        <tr><td>Youth Allowance</td><td>".number_format(($row['YA_SA']+$row['YAO']))." </td>
		  <tr><td>Special Benefit</td><td>".number_format($row['Special_Benefit'])." </td>
		</tr>


        ";

      }
      echo"</tbody></table>";
    }

  ?>
 

  
           

      

 

 

 </div>
 <div class='right'>
  


  
    <div class=''>
     <form action='electorate.php' class='search' method='GET'>
		   <lable for='submit'><button type="submit" id='submit' value="Submit">Find</button></lable>
    <lable for='electorate'>
      <select name='Electorate' >
    
      <option>  Adelaide  </option>
      <option>  Aston </option>
      <option>  Ballarat  </option>
      <option>  Banks </option>
      <option>  Barker  </option>
      <option>  Barton  </option>
      <option>  Bass  </option>
      <option>  Batman  </option>
      <option>  Bendigo </option>
      <option>  Bennelong </option>
      <option>  Berowra </option>
      <option>  Blair </option>
      <option>  Blaxland  </option>
      <option>  Bonner  </option>
      <option>  Boothby </option>
      <option>  Bowman  </option>
      <option>  Braddon </option>
      <option>  Bradfield </option>
      <option>  Brand </option>
      <option>  Brisbane  </option>
      <option>  Bruce </option>
      <option>  Calare  </option>
      <option>  Calwell </option>
      <option>  Canberra  </option>
      <option>  Canning </option>
      <option>  Capricornia </option>
      <option>  Casey </option>
      <option>  Charlton  </option>
      <option>  Chifley </option>
      <option>  Chisholm  </option>
      <option>  Cook  </option>
      <option>  Corangamite </option>
      <option>  Corio </option>
      <option>  Cowan </option>
      <option>  Cowper  </option>
      <option>  Cunningham  </option>
      <option>  Curtin  </option>
      <option>  Dawson  </option>
      <option>  Deakin  </option>
      <option>  Denison </option>
      <option>  Dickson </option>
      <option>  Dobell  </option>
      <option>  Dunkley </option>
      <option>  Durack  </option>
      <option>  Eden-Monaro </option>
      <option>  Fadden  </option>
      <option>  Fairfax </option>
      <option>  Farrer  </option>
      <option>  Fisher  </option>
      <option>  Flinders  </option>
      <option>  Flynn </option>
      <option>  Forde </option>
      <option>  Forrest </option>
      <option>  Fowler  </option>
      <option>  Franklin  </option>
      <option>  Fraser  </option>
      <option>  Fremantle </option>
      <option>  Gellibrand  </option>
      <option>  Gilmore </option>
      <option>  Gippsland </option>
      <option>  Goldstein </option>
      <option>  Gorton  </option>
      <option>  Grayndler </option>
      <option>  Greenway  </option>
      <option>  Grey  </option>
      <option>  Griffith  </option>
      <option>  Groom </option>
      <option>  Hasluck </option>
      <option>  Herbert </option>
      <option>  Higgins </option>
      <option>  Hindmarsh </option>
      <option>  Hinkler </option>
      <option>  Holt  </option>
      <option>  Hotham  </option>
      <option>  Hughes  </option>
      <option>  Hume  </option>
      <option>  Hunter  </option>
      <option>  Indi  </option>
      <option>  Isaacs  </option>
      <option>  Jagajaga  </option>
      <option>  Kennedy </option>
      <option>  Kingsford Smith </option>
      <option>  Kingston  </option>
      <option>  Kooyong </option>
      <option>  La Trobe  </option>
      <option>  Lalor </option>
      <option>  Leichhardt  </option>
      <option>  Lilley  </option>
      <option>  Lindsay </option>
      <option>  Lingiari  </option>
      <option>  Longman </option>
      <option>  Lyne  </option>
      <option>  Lyons </option>
      <option>  Macarthur </option>
      <option>  Mackellar </option>
      <option>  Macquarie </option>
      <option>  Makin </option>
      <option>  Mallee  </option>
      <option>  Maranoa </option>
      <option>  Maribyrnong </option>
      <option>  Mayo  </option>
      <option>  McEwen  </option>
      <option>  McMahon </option>
      <option>  McMillan  </option>
      <option>  McPherson </option>
      <option>  Melbourne </option>
      <option>  Melbourne Ports </option>
      <option>  Menzies </option>
      <option>  Mitchell  </option>
      <option>  Moncrieff </option>
      <option>  Moore </option>
      <option>  Moreton </option>
      <option>  Murray  </option>
      <option>  New England </option>
      <option>  Newcastle </option>
      <option>  North Sydney  </option>
      <option>  OConnor </option>
      <option>  Oxley </option>
      <option>  Page  </option>
      <option>  Parkes  </option>
      <option>  Parramatta  </option>
      <option>  Paterson  </option>
      <option>  Pearce  </option>
      <option>  Perth </option>
      <option>  Petrie  </option>
      <option>  Port Adelaide </option>
      <option>  Rankin  </option>
      <option>  Reid  </option>
      <option>  Richmond  </option>
      <option>  Riverina  </option>
      <option>  Robertson </option>
      <option>  Ryan  </option>
      <option>  Scullin </option>
      <option>  Shortland </option>
      <option>  Solomon </option>
      <option>  Stirling  </option>
      <option>  Sturt </option>
      <option>  Swan  </option>
      <option>  Sydney  </option>
      <option>  Tangney </option>
      <option>  Throsby </option>
      <option>  Wakefield </option>
      <option>  Wannon  </option>
      <option>  Warringah </option>
      <option>  Watson  </option>
      <option>  Wentworth </option>
      <option>  Werriwa </option>
      <option>  Wide Bay  </option>
      <option>  Wills </option>
      <option>  Wright  </option>
        </select></lable> 
       
 
      </form>
  
    </div>
 

 <?php/*
 if ( isset($_GET['Electorate']) )
 {
  
  $electorate = $_GET['Electorate']; 
  echo"<h4>All Commonweatlh Grants for recpients in the Federal Electorate of $electorate</h4>";
$total = "SELECT *, DATE_FORMAT( Approved,  '%D %b %Y' ) AS Approved,
         DATE_FORMAT(End,  '%D %b %Y' ) AS End,
         DATEDIFF(END,APPROVED)/30 AS Term  FROM `grants` where  Year='2015-16' && Electorate ='$electorate'  ";
$result = mysqli_query($db, $total );
//echo"<table class='basic' ><tbody>";
 while ($row = $result->fetch_assoc()) 
    {

echo"<table class='basic'><tbody>
  <tr><td>Portfolio:</td>       <td>".$row['Portfolio']."</td></tr>
  <tr><td>Agency:</td>          <td>".$row['Agency']."</td></tr>
  <tr><td>Program:</td>         <td><a href='electorate.php?Program=".$row['Program']."&electorate=$electorate'>".$row['Program']."</a></td></tr>
  <tr><td>Component:</td>       <td>".$row['Component']."</td></tr>
  <tr><td>Purpose:</td>         <td>".$row['Purpose']."</td></tr>
  <tr><td>Recipient:</td>       <td><a href='search.php?Name=".$row['Recipient']."'>".$row['Recipient']."</a></td></tr>
  <tr><td>Address:</td>         <td>".$row['Locality'].", <a href='locality.php?Postcode=".$row['Postcode']."'>".$row['Postcode']."</a></td></tr>
  <tr><td>Dates:</td>           <td>".$row['Approved']."-".$row['End']." (".number_format($row['Term'])."months) <span style='float:right'>Month:$".number_format($row['Funding']/$row['Term'])."</span></td></tr>
  <tr><td></td>                 <td><span style='float:right'>Total: $".number_format($row['Funding'])."</span></td></tr>
  </tbody></table><br>
 ";
} //echo"</tbody></table><br><hr class='short'><br>";
}*/
?>


  

   <?php
 if ( isset($_GET['Electorate']) && isset($_GET['Program'])  )
 {
  
   $electorate = $_GET['Electorate']; 
   $program = $_GET['Program']; 
   $details = "SELECT Portfolio,Agency,Program  FROM `grants` where 
             Year='2015-16' && Electorate ='$electorate' && Program like'%$program%' GROUP BY Program ";
   
   $result = mysqli_query($db, $details );
   while ($row = $result->fetch_assoc()) 
      {
   echo"<h4>Program details</h4><table class='stats'><tbody>
   <tr><td>Portfolio:</td>    <td><a href='portfolio.php?Portfolio=".$row['Portfolio']."'>".$row['Portfolio']."</a></td></tr>
   <tr><td>Agency:</td>       <td><a href='agency.php?Agency=".$row['Agency']."'>".$row['Agency']."</a></td></tr>
    <tr><td>Program:</td>     <td><a href='electorate.php?Program=".$row['Program']."'>".$row['Program']."</a></td></tr></tbody></table>";
 }

$total = "SELECT *, DATE_FORMAT( Approved,  '%D %b %Y' ) AS Approved,
         DATE_FORMAT(End,  '%D %b %Y' ) AS End,
         DATEDIFF(END,APPROVED)/30 AS Term  FROM `grants` where 
          Year='2015-16' && Electorate ='$electorate'&& Program like'%$program%'  ";
$result = mysqli_query($db, $total );
 @$num_results = mysqli_num_rows($result);
 echo"<br><h3>There are ".number_format($num_results)." grants for $program in the Electorate of $electorate</h3>";
 while ($row = $result->fetch_assoc()) 
    {
echo"<table class='basic'><tbody>";
echo"
  <tr><td>Component:</td>   <td>".$row['Component']."</td></tr>
  <tr><td>Purpose:</td>     <td>".$row['Purpose']."</td></tr>
  <tr><td>Recipient:</td>   <td><a href='search.php?Name=".$row['Recipient']."'>".$row['Recipient']."</a></td></tr>
  <tr><td>Address:</td>     <td>".$row['Locality'].", <a href='locality.php?Postcode=".$row['Postcode']."'>".$row['Postcode']."</a></td></tr>
  <tr><td>Dates:</td>       <td>".$row['Approved']."-".$row['End']." (".number_format($row['Term'])."months) <span style='float:right'>Month:$".number_format($row['Funding']/$row['Term'])."</span></td></tr>
  <tr><td></td>             <td><span style='float:right'>Total: $".number_format($row['Funding'])."</span></td></tr>
  ";
  echo" </tbody></table><br>";
}
}
?>

     <?php
  /*    
  if (  !isset($_GET['Electorate']) && !isset($_GET['Program'])  && !isset($_GET['Postcode']))
  {
 echo"<h3>Commonwealth grant locations in the federal electorate of Adelaide</h3>";	 
 include'no_electorate_map.php';
  }
 */
  ?>
  


 
 <?php
if  ( isset($_GET['Electorate']) &&  !isset($_GET['Program']))

{
	$query="SELECT * FROM `tenders` WHERE Postcode IN (SELECT postcode from locality_CED where electorate='$electorate' )";
    $result = mysqli_query($db, $query );
	echo"<h3>Commonwealth tenders for the 15-16 FY for the electorate of $electorate</h3>";
	    @$num_results = mysqli_num_rows($result);
	    echo"<h4>There are ".number_format($num_results)." tenders</h4>
		<div class='expand'>";
    while ($row = $result->fetch_assoc()) 
       {
		   include'tenders_table.php';
	   }
	
echo"</div>Mouse over/scroll for more results<div class='clear'></div>";
}
?>

  <?php
   if (isset($_GET['Electorate']) && !isset($_GET['Program']) )
   {
  



  $total="SELECT sum(Funding),AVG(Funding) as AVE, count(Funding) as count FROM grants where Electorate='$electorate'
  	 && Year='2015-16' ";
  $result = mysqli_query($db, $total);
  @$num_results = mysqli_num_rows($result);



        
  echo"<br><h3>Commonwealth Grant totals for the Electorate of $electorate</h3><hr><table class='stats'><tbody><th>Number</td><th>Average Value</th><th>Total</td></tr>";
  while ($row = $result->fetch_assoc()) 
     {echo"<tr><th>".number_format($row['count'])."</th>
		 <th>$".number_format($row['AVE'])."</th>
		 <th>$".number_format($row['sum(Funding)'])."</th></tr>";
	   
     }
     echo"<tbody></table><hr>	";
   
  }
  
  ?>
 <?php
 if ( isset($_GET['Electorate']) && !isset($_GET['Program']) )
 {
  
 $data = $_GET['Electorate']; 
$electorate=mysqli_real_escape_string ( $db , $data );
  echo"<h4>All Commonweatlh Grants for recpients in the Federal Electorate of $electorate</h4>";
$total = "SELECT Program,sum(Funding) FROM `grants` WHERE  Year='2015-16' && Electorate ='$electorate'  Group by Program  ";
$result = mysqli_query($db, $total );
echo"<div class='source'>Source: Grants data published at agency websites</div> <table class='wide' ><tbody>";
 while ($row = $result->fetch_assoc()) 
    {

echo"<tr>
	<td><a href='electorate.php?Electorate=$electorate&Program=".$row['Program']."'>".$row['Program']."</a></td><td><span style='float:right'>$".number_format($row['sum(Funding)'])."</span></td>
  </tr>";
}echo" </tbody></table><br><p>Click on the Program name to see details of grants in $electorate for that Program</p>
	<hr class='short'><br> ";
}
?>


</div></div>
<div class='clear'></div>
<?php 
    include('footer.php');?>

    </body>
</html>