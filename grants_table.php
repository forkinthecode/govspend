  <?php
echo"
<table class='basic' ><tbody>
  <tr><td>Program:</td><td>".trim($row['Program'])."</td></tr>
  <tr><td>Component:</td><td>".trim($row['Component'])."</td></tr>
  <tr><td>Purpose:</td><td>".$row['Purpose']."</td></tr>

  <tr><td>Dates:</td><td>".$row['Approved']."-".$row['End']." <span style='float:right'>(".number_format($row['Term'])."months)</span></td></tr>
  <tr><td></td><td>Month:$".number_format($row['Funding']/$row['Term'])."<span style='float:right'>Total: $".number_format($row['Funding'])."</span></td></tr>
 </tbody></table><br> ";

 ?>