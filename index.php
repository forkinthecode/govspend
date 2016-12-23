<?php
require'header.php';
?>



<div class='left'>
<h4>2015-16 FY Portfolio totals for General Government Spending </h4>
<!--<div class='box'>
<p>Click on <a class='button' href='#popup_search'>Quick Search</a> or click <img src='outcome_search_large.png' height='40px'></img> icons to drill down.</p> 
</div>
   <div id='popup_search'  class='overlay'>
            <div class='popup_search'>
                <div class='content' >
              <h2>Welcome to Australia's budget transparency project</h2>
              <p>Whack a postcode into the search box to find grants and tenders for that location or click<a class='close' href='#'>close</a></span>to display all budget data</p>
              <form class='overlaid' action='locality.php' target='_blank' method='GET'>
                                              <input type="text" name='Postcode' id='Postcode' placeholder="Search..." required>
                                              <button type="submit" id='submit' value="Submit">Go</button>

              </form>
                </div>
            </div>
    </div>-->

<?php
$total = "SELECT *,sum(current) FROM `budget_table15_16` group by Portfolio ORDER BY sum(current) DESC ";
$result = mysqli_query($db, $total );
echo"<div class='expand'><table class='wide' border='0'><tbody>";
 while ($row = $result->fetch_assoc()) 
    {

echo"
  <tr>


 <td><a href='portfolio.php?Portfolio=".$row['Portfolio']."'>".$row['Portfolio']."</td><td> $".number_format($row['sum(current)']).",000</td> 
</tr>
 ";
}echo"</tbody></table><br> </div>";

?>

 
 

 

<p>Govspend is a prototype only. Federal electorate details may be out of date.
  Grants data is taken from multiple Commonwealth agency sites and there is no guarantee that 
  it is correct in the database. The prototype is to give an idea of what can be done with open financial data.</p>
  <p>Commonwealth tenders data will soon be added. This type of data providing this kind of drill down does not exist anywhere else and is the result of several 
    years of full time labour and expertise working with financial open data.</p>

  
           

      

 

 

 </div>
 <div class='right'>


<h4>2015-16 FY Portfolio totals for Commonwealth Grants Funding </h4>
<?php
$total = "SELECT Portfolio,sum(Funding) FROM `grants` WHERE Year='2015-16' && Portfolio !='' 
group by Portfolio ORDER BY sum(Funding) DESC ";
$result = mysqli_query($db, $total );
echo"
 <table class='grants' border='0'><tbody>";
 while ($row = $result->fetch_assoc()) 
    {

echo"
 
  <tr><td><a href='portfolio.php?Portfolio=".$row['Portfolio']."'>".$row['Portfolio']."</td><td>$".number_format($row['sum(Funding)'])."</td></tr>
";
}echo" </tbody></table><br><hr class='short'><br> ";

?>



  

 
         
        

  
   

</div></div>
<div class='clear'></div>
 <?php 
    include('footer.php');?>

    </body>
</html>