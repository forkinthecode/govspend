       <?php     echo"
          <table class='basic'><tbody>
               
        <tr><td width='200px'>ABN </td><td><a href='recipient.php?ABN=".$row['ABN']."'>".$row['ABN']."</a></td></tr>       
         <tr>
        <td>Legal Name</td>     
        <td> ".$row['Legal_Name']."</td>
        </tr>
        <tr>
        <td>Other Names</td>     
        <td> <a href='recipient.php?Recipient=".$row['Other_Names']."'>".$row['Other_Names']."</a></td>
        </tr>
        <tr>
        <td>Address</td>     
        <td><a href='https://www.google.com.au/maps/search/".$row['Address1']."
         ".$row['Address2']." ".$row['Address3']."
          ".$row['Locality']." 
        ".$row['state']." ".$row['postcode']." Australia' 
        title='Locate in Google maps' target='_blank'><img src='map_icon.png'></img>
        ".$row['Address1']." ".$row['Address2']." ".$row['Address3']." 
        ".$row['Locality'].", ".$row['State']." ".$row['Postcode']."</a></td>
        </tr>
        <tr>
        <td>Size</td>    
        <td> ".$row['Size']."</td>
        </tr>
        <tr>
        <td>Operating Countries</td>     
        <td> ".$row['Countries']."</td>
        </tr>
        <tr>
        <td>Operating States</td>    
        <td> ".$row['NSW']." ".$row['QLD']." ".$row['VIC']." ".$row['SA']." ".$row['ACT']." ".$row['TAS']." 
        ".$row['NT']." ".$row['WA']."</td>
        </tr>
        <tr>
        <td>Issues</td>       <td>
       <div class='issues'>".$row['animals']."</div>
<div class='issues'>".$row['Culture']."</div>
<div class='issues'>".$row['Education']."</div>
<div class='issues'>".$row['Health']."</div>
<div class='issues'>".$row['Policy']."</div> 
<div class='issues'>".$row['Environment']."</div>
<div class='issues'>".$row['Rights']."</div> 
<div class='issues'>".$row['Misc']."</div> 
<div class='issues'>".$row['Reconciliation']."</div> 
<div class='issues'>".$row['Religion']."</div>
<div class='issues'>".$row['Social']."</div> 
<div class='issues'>".$row['Security']."</div>
<div class='issues'>".$row['General_Public']."</div> 
<div class='issues'>".$row['General']."</div> 
<div class='issues'>".$row['Other']."</div> 
<div class='issues'>".$row['Indigenous']."</div> 
<div class='issues'>".$row['Aged']."</div>
<div class='issues'>".$row['Children']."</div> 
<div class='issues'>".$row['Overseas']."</div>
<div class='issues'>".$row['Ethnicity']."</div>
<div class='issues'>".$row['LGBT']."</div> 
<div class='issues'>".$row['Public']."</div> 
<div class='issues'>".$row['Men']."</div> 
<div class='issues'>".$row['Migrants']."</div> 
<div class='issues'>".$row['Offenders']."</div>
<div class='issues'>".$row['Illness']."</div> 
<div class='issues'>".$row['Disabilities']."</div> 
<div class='issues'>".$row['Homelessness']."</div>
<div class='issues'>".$row['Unemployed']."</div> 
<div class='issues'>".$row['Veterans']."</div> 
<div class='issues'>".$row['Crime']."</div> 
<div class='issues'>".$row['Disasters']."</div> 
<div class='issues'>".$row['Women']."</div>
<div class='issues'>".$row['Youth']."</div> </td>
        </tr>
        </tbody>
        </table>";
        
		
		?>