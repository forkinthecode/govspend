<?php
require'header.php';
?>


        <div class="left">

 







 <form action="tax.php">
 
     <input type="text" id="ABN" name="ABN" placeholder="ABN without spaces" > <button type="submit" id='submit' value="Submit"> Find </button>
 </form>
     <form action="tax.php">
     <input type="text" id="Name" name="Name" placeholder="business name key word eg woolworths" > <button type="submit" id='submit' value="Submit"> Find </button>
 </form>




  <?php
  //if ( !isset($_GET['Name']) )
   {
  
	   $data = $_GET['Name']; 
	   $name=mysqli_real_escape_string ( $db , $data );
	   
  $query="SELECT * FROM `tax` order by Tax";
  
  $result = mysqli_query($db, $query );
    @$num_results = mysqli_num_rows($result);
 
  $num_results = mysqli_num_rows($result);
    if ($num_results <1)
    {
    echo"<h4>The ATO has not provided Tax Transparency data for the companies matching $name</h4>";
    }
  else
  { echo"<h3>All ATO 2014-15 Tax Transparency results by tax paid (least paid first)</h3><div class='source'>Source: From Tax Transparency data published at data.gov.au </div><div class='expand'>";
   while ($row = $result->fetch_assoc()) 
      {

  echo"
   
 <table class='wide' border='0'><tbody>
 <tr><td width='150px'>Name            </td><td><a href='tax.php?Name=".$row['Name']."'>".$row['Name']."</td></tr>
 <tr><td>ABN             </td><td><a href='tax.php?ABN=".$row['ABN']."'>".$row['ABN']."</td></tr>
 <tr><td>Total Income    </td><td>$".number_format($row['Total_Income'])."</td></tr>
 <tr><td>Taxable Income  </td><td>$".number_format($row['Taxable_Income'])."</td></tr>
 <tr><td>Tax             </td><td>$".number_format($row['Tax'])."</td></tr>
  </tbody></table><br> ";
     }echo"</div>Mouse/Scroll for more results";
   }
 }
 
 ?>
 
	   <h3>About the dataset</h3>
	   <div class='source'>Source: From Tax Transparency data published at <a href='http://data.gov.au/dataset/corporate-transparency'>data.gov.au</a> </div>
	 <p>  
These reports contain the name, ABN, total income, taxable income and tax payable for • Australian public and foreign-owned corporate tax entities with a total income of $100 million or more; and • Australian-owned resident private companies with a total income of $200 million or more.
</p><p>
They also contain the name, ABN and tax payable for any entity that has a minerals resource rent tax (MRRT) or petroleum resource rent tax (PRRT) payable amount.
</p>
  <p>More info about this dataset is available at the <a href='https://www.ato.gov.au/Business/Large-business/In-detail/Tax-transparency/Corporate-tax-transparency-report-for-the-2013-14-income-year/'>ATO</a>.</p>

    
 
 </div>
 <div class='right'>
	    <?php
	    if ( isset($_GET['Name']) )
	     {
  
	  	   $data = $_GET['Name']; 
	  	   $name=mysqli_real_escape_string ( $db , $data );
	   
	    $query="SELECT * FROM `tax` WHERE Name like'%$name%'";
  
	    $result = mysqli_query($db, $query );
	      @$num_results = mysqli_num_rows($result);
 
	    $num_results = mysqli_num_rows($result);
	      if ($num_results <1)
	      {
	      echo"<h4>The ATO has not provided Tax Transparency data for the companies matching $name</h4>";
	      }
	    else
	    { echo"<div class='source'>Source: From Tax Transparency 2014-15 data published at data.gov.au </div>";
	     while ($row = $result->fetch_assoc()) 
	        {

	    echo"
   
	   <table class='wide' border='0'><tbody>
	   <tr><td width='150px'>Name            </td><td><a href='tax.php?Name=".$row['Name']."'>".$row['Name']."</td></tr>
	   <tr><td>ABN             </td><td><a href='tax.php?ABN=".$row['ABN']."'>".$row['ABN']."</td></tr>
	   <tr><td>Total Income    </td><td>$".number_format($row['Total_Income'])."</td></tr>
	   <tr><td>Taxable Income  </td><td>$".number_format($row['Taxable_Income'])."</td></tr>
	   <tr><td>Tax             </td><td>$".number_format($row['Tax'])."</td></tr>
	    </tbody></table><br> ";
	       }echo"";
	     }
	   }
 
	   ?>
	    <?php
	    if ( isset($_GET['ABN']) && !isset($_GET['Name']) )
	     {
  
	  	   $data = $_GET['ABN']; 
	  	   $ABN=mysqli_real_escape_string ( $db , $data );
	   
	    $query="SELECT * FROM `tax` where ABN='$ABN'";
  
	    $result = mysqli_query($db, $query );
	      @$num_results = mysqli_num_rows($result);
 
	    $num_results = mysqli_num_rows($result);
	      if ($num_results <1)
	      {
	      echo"<h4>The ATO has not provided Tax Transparency data for the ABN $ABN</h4>";
	      }
	    else
	    { echo"<div class='source'>Source: From Tax Transparency 2014-15 data published at <a href='http://data.gov.au/dataset/corporate-transparency'>data.gov.au</a> </div>";
	     while ($row = $result->fetch_assoc()) 
	        {

	    echo"
   
	   <table class='wide' border='0'><tbody>
	   <tr><td width='150px'>Name            </td><td><a href='tax.php?Name=".$row['Name']."'>".$row['Name']."</td></tr>
	   <tr><td>ABN             </td><td><a href='tax.php?ABN=".$row['ABN']."'>".$row['ABN']."</td></tr>
	   <tr><td>Total Income    </td><td>$".number_format($row['Total_Income'])."</td></tr>
	   <tr><td>Taxable Income  </td><td>$".number_format($row['Taxable_Income'])."</td></tr>
	   <tr><td>Tax             </td><td>$".number_format($row['Tax'])."</td></tr>
	    </tbody></table><br> ";
	       }
	     }
	   }
 
	   ?>
       <a class="twitter-timeline"  href="https://twitter.com/search?q=tax%20australia" data-widget-id="816435976503296000">Tweets about tax australia</a>
       <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	   
	 
</div></div>
<div class='clear'></div>
 <?php 
    include('footer.php');?>

    </body>
</html>