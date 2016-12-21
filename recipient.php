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

include('nav.php');
 
    

?>

  
        
                     
 
  <div class="jumbotron"> 
     

  
        </div>
          
       

          <div class='clear'></div>
<div class="page_width">


        <div class="left">

 





<?php
 if ( !isset($_GET['Recipient']) )
 { 
echo"<h4>Total Commonwealth Grants by Recipient</h4>";
$total = "SELECT Recipient,sum(Funding) FROM `grants` WHERE  Year='2014-15' && Recipient!=''
 GROUP BY Recipient ORDER BY sum(Funding) DESC ";
 echo"<table width='95%'><tbody><tr><td>Total Value</td><td>Recipient</td></tr></tbody></table>";
$result = mysqli_query($db, $total );
 while ($row = $result->fetch_assoc()) 
    {

echo"

<table class='basic' ><tbody>
 
  <tr> <td><span style='float:right'>$".number_format($row['sum(Funding)'])."</span></td>
  <td><a href='recipient.php?Recipient=".$row['Recipient']."'>".$row['Recipient']."</a></td>
    </tr>
 </tbody></table><br><hr class='short'><br> ";
    }
}
?>
 
<?php
if ( isset($_GET['Recipient']) )
 {
$data = $_GET['Recipient']; 
$recipient=mysqli_real_escape_string ( $db , $data );
echo"<h4>Commonwealth Grants received by $recipient</h4><p>(With approval dates within the 2014-15 financial year)</p>";
$seifa = "SELECT *,sum(Funding) FROM grants WHERE Recipient ='$recipient' && Year='2014-15' GROUP BY Program ";
$result = mysqli_query($db, $seifa );
  @$num_results = mysqli_num_rows($result);
  if ($num_results <1)
  {
  echo"<h4>There are no Commonwealth grant recipients named $recipient</h4>";
}
else{
 while ($row = $result->fetch_assoc()) 
    {

echo"

<table class='wide' ><tbody>
 <tr><td>Program</td>         <td><a href='recipient.php?Recipient=".$row['Recipient']."&Program=".$row['Program']."'>".$row['Program']."</a></td></tr>
 
  <tr><td>Portfolio:</td>         <td>".$row['Portfolio']."</td></tr>
  <tr><td>Agency:</td>            <td>".$row['Agency']."</td></tr>
 
  <tr><td>Total Value:</td>   <td><span style='float:right'>$".number_format($row['sum(Funding)'])."</span></td></tr>
 </tbody></table><br><hr class='short'><br>
";
}echo" <p>Click on the Program name to display details of grants to $recipient for that program</p> ";
}
}

?>

  
           

 
 

 

 </div>
 <div class='right'>
  

  



   <?php
 if ( isset($_GET['Recipient']) && isset($_GET['Program'])  )
 {
  
   $recipient = $_GET['Recipient']; 
   $program = $_GET['Program']; 
  echo"<h4>$program grants for $recipient</h4>";
$total = "SELECT *,DATE_FORMAT( Approved,  '%D %b %Y' ) AS Approved,
         DATE_FORMAT(End,  '%D %b %Y' ) AS End,
         DATEDIFF(END,APPROVED)/30 AS Term  FROM `grants` 
         WHERE Program like'%$program%' && Year='2014-15' && Recipient ='$recipient'
            ";
$result = mysqli_query($db, $total );
 @$num_results = mysqli_num_rows($result);
echo"
<p>There are $num_results grants received by $recipient</p>";
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