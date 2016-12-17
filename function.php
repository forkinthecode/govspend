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
<div class="row-fluid marketing">


        <div class="span6">

<h2><a href='index.php'>Home</a><span style='float:right'>Budget FY2015-16</span></h2>
        
 






 

 <?php
 //if ( isset($_GET['GFS_Function'] ) )
 {
  $GFS_Function=$_GET['GFS_Function'];

 echo"
<h4>Total of General Financial Statistics Function $GFS_Function</h2>";
$agor = "SELECT sum(Total_Appropriations),sum(Total_Departmental_Expenses),
sum(Total_Appropriations-Total_Departmental_Expenses) as difference FROM `AGOR`
 where GFS_Function='$GFS_Function'";
$result = mysqli_query($db, $agor );
 while ($row = $result->fetch_assoc()) 
    {
      
   
echo"<table class='basic' border='0'><tbody>
 
  <tr><td>GFS Function</td><td><a href='function.php?function=".$row['GFS_Function']."' target='_blank'>".$row['GFS_Function']."</a></td></tr>
    <tr><td>Appropriations</td><td><span style='float:right'>$".number_format($row['Total_Appropriations'])."m</td></span></tr>
  <tr><td>Expenses</td><td><span style='float:right'>$".number_format($row['Total_Departmental_Expenses'])."m</span></td></tr>
    <tr><td>Difference</td><td><span style='float:right'>$".number_format($row['difference'])."m</td></span></tr>

 </tbody></table><br><hr class='short'><br> ";
mysqli_free_result($result);
}

    
}

        ?>



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

            <input type='text'  id='agency' name='agency' value='health' />
              

        <input type='hidden'  id='table' name='table' value='FY2016-17' />
        
             <input type='submit' name='submit' value='Agency Results' id='submit' />
 
  
   
          </form>
          Find program by key word:
             <form action='' target='_blank' method='GET'>

            <input type='text'  id='program' name='program' value='health' />
              

        <input type='hidden'  id='table' name='table' value='FY2016-17' />
        
             <input type='submit' name='submit' value='Program Results' id='submit' />
 
  
   
          </form>";
     }

      ?>

  
           

      

 

 

 </div>
 <div class='span6'>
  



  

 
         
        

  
   

</div></div>


    <?php //include('../scripts/footer.php');?>

    </body>
</html>