  <?php
echo"
<table class='basic' ><tbody>
  <tr><td>Program Name:</td><td>".trim($row['Program'])."</td></tr>
  <tr><td>Component Name:</td><td>".trim($row['Component'])."</td></tr>
  <tr><td>Purpose:</td><td>".$row['Purpose']."</td></tr>

  <tr><td>Recipient:</td><td><a href='recipient.php?Recipient=".$row['Recipient']."'>".trim($row['Recipient'])."</a></td></tr>
  <tr><td>Address/Coverage:</td><td>".$row['Locality']." <a href='locality.php?Postcode=".$row['Postcode']."'>".$row['Postcode']."</a></td></tr>
  <tr><td>Electorate</td><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td></tr>
  <tr><td>Council Area:</td><td> <a href='council.php?Council=".$row['Council']."'>".$row['Council']."</a></td></tr>
  
  <tr><td>Dates:</td><td>".$row['Approved']."-".$row['End']." <span style='float:right'>(".number_format($row['Term'])."months)</span></td></tr>
  <tr><td></td><td>Month:$".number_format($row['Funding']/$row['Term'])."<span style='float:right'>Total: $".number_format($row['Funding'])."</span></td></tr>
 </tbody></table><br><hr><br> ";

 ?>