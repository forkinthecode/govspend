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
     
<?php
     include('nav.php');

     ?>
  
        </div>
          
       

          <div class='clear'></div>
<div class="page_width">


<div class="left">
<h4>2014-15 FY Portfolio totals for General Government Spending </h4>
<div class='box'>
<p>Click on <a class='button' href='#popup_search'>Quick Search</a> or click <img src='outcome_search_large.png' height='40px'></img> icons to drill down.</p> 
</div>
<div id='popup_search'  class='overlay'>
<div class='popup_search'>
<div class='content' >
<h2>Welcome to Australia's budget transparency project</h2>
<p>Whack a postcode into the search box to find grants and tenders for that location or click<a class='close' href='#'>close</a></span>to display all budget data</p>
<form class='overlaid' action='locality.php' target='_blank' method='GET'>
                                <input type="text" name='Postcode' id='Postcode' placeholder="Search..." required>
                                <button type="submit" value="Submit">Go</button>

</form>
</div>
</div>
</div>
<?php
$total = "SELECT *,sum(2014_15) FROM `fed_budget` group by Portfolio ORDER BY sum(2014_15) DESC ";
$result = mysqli_query($db, $total );
 while ($row = $result->fetch_assoc()) 
    {

echo"<table class='basic' border='0'><tbody>
  <tr><td><a href='portfolio.php?Portfolio=".$row['Portfolio']."'><img src='outcome_search_large.png' height='40px'></img></a></td><td><a href='portfolio.php?Portfolio=".$row['Portfolio']."'>".$row['Portfolio']." <span style='float:right'>$".number_format($row['sum(2014_15)']).",000</span></td></tr>

 </tbody></table><br> ";
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
 <div class='right'>
  
<br><br><br>

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

 <?php 
    include('footer.php');?>

    </body>
</html>