  <?php
echo"
<table class='basic' ><tbody>
  <tr><td>Program:</td><td><a href='locality.php?Program=".trim($row['Program'])."'>".trim($row['Program'])."</a></td></tr>
  <tr><td>Component:</td><td>".trim($row['Component'])."</td></tr>
  <tr><td>Purpose:</td><td>".$row['Purpose']."</td></tr>
  <tr><td>Recipient:</td><td><a href='recipient.php?Recipient=".$row['Recipient']."'>".$row['Recipient']."</a></td></tr>

<tr><td>Address</td><td><a title ='Open in Google Maps' href='https://www.google.com.au/maps/search/".$row['Locality']." Australia' 
        title='Locate in Google maps' target='_blank'><img src='map_icon.png'></img> ".$row['Locality']."</a> | <a title = 'Results for ".$row['Postcode']."' href='locality.php?Postcode=".$row['Postcode']."'>".$row['Postcode']."</a> ".$row['State']." </td></tr>
  <tr><td>Dates:</td><td>".$row['Approved']."-".$row['End']." <span style='float:right'>(".number_format($row['Term'])."months)</span></td></tr>
  <tr><td></td><td>Month:$".number_format($row['Funding']/$row['Term'])."<span style='float:right'>Total: $".number_format($row['Funding'])."</span></td></tr>
 </tbody></table><br> ";

 ?>