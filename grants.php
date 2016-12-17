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
     

  
        </div>
          
       

          <div class='clear'></div>
<div class="page_width">


        <div class="left">

<h2><a href='index.php'>Home</a><span style='float:right'>Budget FY2014-15</span></h2>
        
<?php
 //if ( isset($_GET['Portfolio']) )
 {
  
                   $portfolio = $_GET['Portfolio']; 
                   
                 //  $portfolio=mysqli_real_escape_string($portfolio);

 echo"<h4>Commonwealth Programs administering grants directly to recipients</h2>";
$agor = "SELECT grants.Portfolio,grants.Program,sum(Funding) FROM `grants` join fed_budget on fed_budget.program=grants.program
 where grants.Year='2014-15' group by grants.Program order by grants.Portfolio";
$result = mysqli_query($db, $agor );
 while ($row = $result->fetch_assoc()) 
    {
      
   
echo"<table class='wide'><tbody>
 
  <tr><td><a href='portfolio.php?Program=".$row['Program']."'><img src='outcome_search_large.png' height='40px'></img></a></td><td><a href='portfolio.php?Portfolio=".$row['Portfolio']."'>".$row['Portfolio']."</a></td><td><a href='portfolio.php?Program=".$row['Program']."'>".$row['Program']."</a></td><td><span style='float:right'>$".number_format($row['sum(Funding)'])."</span></td></tr>

  

 </tbody></table><hr><br><br> ";

}

    
}mysqli_free_result($result);

        ?>
 

 



   

  
           

      

 

 

 </div>
 <div class='right'>
 <?php
       // if(isset($_GET['table']) && !isset($_GET['portfolio']) && !isset($_GET['agency']) && !isset($_GET['program']) && !isset($_GET['outcome'])  && !isset($_GET['search_term']))
        
        {
echo"<br>Total spending across portfolios, agencies, outcomes, programs & components based on search term:
          <form action='' target='_blank' method='GET'>

            <input type='text'  id='search_term' name='search_term' value='health' />
              

        <input type='hidden'  id='table' name='table' value='FY2016-17' />
        
             <input type='submit' name='submit' value='All Results' id='submit' />
 
  
   
          </form>Find agency by key word:
          <form action='' target='_blank' method='GET'>

            <input type='text'  id='agency' name='agency' value='housing' />
              

        <input type='hidden'  id='table' name='table' value='FY2016-17' />
        
             <input type='submit' name='submit' value='Agency Results' id='submit' />
 
  
   
          </form>
          Find program by key word:
             <form action='' target='_blank' method='GET'>

            <input type='text'  id='program' name='program' value='Indigenous' />
              

        <input type='hidden'  id='table' name='table' value='FY2016-17' />
        
             <input type='submit' name='submit' value='Program Results' id='submit' />
 
  
   
          </form>";
     }

      ?>

<h4>2014-15 FY Portfolio totals for Commonwealth Grants Funding </h4>
<?php
$total = "SELECT Portfolio,sum(Funding) FROM `grants` WHERE Year='2014-15' && Portfolio !='' group by Portfolio ORDER BY sum(Funding) DESC ";
$result = mysqli_query($db, $total );
 while ($row = $result->fetch_assoc()) 
    {

echo"<table class='basic' border='0'><tbody>
  <tr><td><a href='portfolio.php?Portfolio=".$row['Portfolio']."'>".$row['Portfolio']."</td></tr>

</td></tr>
    <tr><td><span style='float:right'>$".number_format($row['sum(Funding)'])."</td></span></tr>

 </tbody></table><br><hr class='short'><br> ";
}

?>



  

 
         
        

  
   

</div></div>


    <?php //include('../scripts/footer.php');?>

    </body>
</html>