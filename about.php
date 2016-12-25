<?php
require'header.php';
?>



<div class='left'>



   <h3>Government spending open data</h3> 
   <table>      
  <tr><th>Budgets</th><th> <a href='about.php?data=commonwealth_budget'>Commonwealth</a></th><th>State</th><th>Local</th></tr>
  <tr><td></td><td>data.gov.au</td><td></td><td></td></tr>
</table>
   <hr>
  

	     <table>      
	    <tr><th>Grants</th><th> Commonwealth</th><th>State</th><th>Local</th></tr>
	    <tr><td></td><td>Currently at agency sites but moving to grants.gov.au</td><td></td><td></td></tr>
	  </table>
  <hr>
    <table>      <tr><th>Tenders</th><th> Commonwealth</th><th>State</th><th>Local</th></tr>
   <tr><td></td><td>AusTenders</td><td></td><td></td></tr>
 </table>

 

 </div>
 <div class='right'>

<h3>Metadata Results of dataset</h3>

<?php
	
if (isset($_GET['data']))
{
	echo"
     <p>Portfolio, Agency, Program, Component, Outcome, Last Year $, Current Year $, Forward Year1 $, Forward Year2 $, Forward Year2 $, Source Table, Source</p>
		";
}
	
	
?>

  

 
         
        

  
   

</div></div>
<div class='clear'></div>
 <?php 
    include('footer.php');?>

    </body>
</html>