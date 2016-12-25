  <?php
  echo"

  <table class='wide' ><tbody>
  <tr><td width='150px'>Agency</td><td><a href='agency.php?Agency=".$row['Agency']."'>".$row['Agency']."</a></td></tr>
  <tr><td>Supplier</td>                <td>".$row['Name']."</td></tr>
   <tr><td>ABN</td>                <td><a href='recipient.php?ABN=".$row['ABN']."'>".$row['ABN']."</a></td></tr>
  <tr><td>Description</td>         <td>".$row['Description']."</td></tr>
  <tr><td>Dates</td>               <td>".$row['Start']."-".$row['End']."</td></tr>
  <tr><td>Value</td>              <td><span style='float:right'>$".number_format($row['Value'])."</span></td></tr>
   </tbody></table><br>
  ";

  ?>