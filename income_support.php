 <?php
 $component=$_GET['Component'];
 if (  $component =='Carer Allowance (Adult)' || $component =='Child Disability Assistance Payment)' || $component =='Carer Supplement' || $component =='Ex-Gratia Payments to Unsuccessful Applicants of Carer Payment (Child)' || 
	$component =='Mobility Allowance' )
 {
	 echo"<p>There is no electorate breakdown for this payment.</p>";
 }
 
 ?>
 <?php
  $component=$_GET['Component'];
 if (  $component =='Youth Allowance (student)')
 {
	 echo"<p>Youth Allowance (student) is a means‐tested payment for full‐time students. 
		 Data includes recipients who are determined to be current (i.e. entitled to be paid) on the Centrelink payment system.</p>";
	 $query="SELECT Electorate,YA_SA FROM welfare_by_electorate ORDER BY YA_SA DESC";
	  $result = mysqli_query($db, $query );
	  echo"
		  
		  <H3>$program recipients by Federal Electorate</h3>
	  <div class='source'>Source: Department of Human Services published at data.gov.au</div>
	  
	  <div class='expand'><table class='wide'><tbody><tr><td>Federal Electorate</td><td>Number</td></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {
	  
	  
			 echo"<tr><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td>
		      <td>".number_format($row['YA_SA'])."</td>";
 }echo"</tbody></table></div>";
 }
 
 ?>
 <?php
  $component=$_GET['Component'];
 if (  $component =='Austudy')
 {
	 echo"<p>Austudy is a means-tested payment made to full-time students and Australian apprentices who are aged 25 years and older. 
		 Data includes recipients who are determined to be current (i.e. entitled to be paid) on the Centrelink payment system.</p>";
	 $query="SELECT Electorate,Austudy FROM welfare_by_electorate ORDER BY Austudy DESC";
	  $result = mysqli_query($db, $query );
	  echo"
		  
		  <H3>$program recipients by Federal Electorate</h3>
	  <div class='source'>Source: Department of Human Services published at data.gov.au</div>
	  
	  <div class='expand'><table class='wide'><tbody><tr><td>Federal Electorate</td><td>Number</td></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {
	  
	  
			 echo"<tr><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td>
		      <td>".number_format($row['Austudy'])."</td>";
 }echo"</tbody></table></div>";
 }
 
 ?>
 <?php
  $component=$_GET['Component'];
 if (  $component =='Disability Support Pension')
 {
	 $query="SELECT Electorate,DSP FROM welfare_by_electorate ORDER BY DSP DESC";
	  $result = mysqli_query($db, $query );
	  echo"
		  
		  <H3>$program recipients by Federal Electorate</h3>
	  <div class='source'>Source: Department of Human Services published at data.gov.au</div>
	  
	  <div class='expand'><table class='wide'><tbody><tr><td>Federal Electorate</td><td>Number</td></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {
	  
	  
			 echo"<tr><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td>
		      <td>".number_format($row['DSP'])."</td>";
 }echo"</tbody></table></div>";
 }
 
 ?>
 <?php
  $component=$_GET['Component'];
 if (  $component =='Age Pension')
 {
	 echo"<p>Age Pension is a support payment for people who have reached the qualifying age. From 1 July 2013, the qualifying age for both men and women is 65 years. From 1 July 2017 the Age Pension qualifying age will progressively increase from 65 years to 67 years, reaching 67 years in 2023. This affects both men and women born on or after 1 July 1952.  Age Pension recipients have the choice of having their Age Pension paid by either the Department of Human Services (DHS) or the Department of Veterans' Affairs (DVA), 
	 DHS pays the vast majority of Age Pensions. Data.gov.au only includes data for the DHS customers.</p>";
	 $query="SELECT Electorate,Age_Pension FROM welfare_by_electorate ORDER BY Age_Pension DESC";
	  $result = mysqli_query($db, $query );
	  echo"
		  
		  <H3>$program recipients by Federal Electorate</h3>
	  <div class='source'>Source: Department of Human Services published at data.gov.au</div>
	  
	  <div class='expand'><table class='wide'><tbody><tr><td>Federal Electorate</td><td>Number</td></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {
	  
			 echo"<tr><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td>
		      <td>".number_format($row['Age_Pension'])."</td>";
 }echo"</tbody></table></div>";
 }
 
 ?>
 <?php
  $component=$_GET['Component'];
 if (  $component =='Family Tax Benefit Part A')
 {
	 $query="SELECT Electorate,FTB_A FROM welfare_by_electorate ORDER BY FTB_A  DESC";
	  $result = mysqli_query($db, $query );
	  echo"<H3>FTB A recipients by Federal Electorate</h3>
		  
		  <div class='source'>Source: Department of Human Services published at data.gov.au</div>
		  <div class='expand'><table class='wide'><tbody><tr><td>Federal Electorate</td><td>Number</td></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {
	  
	 echo"<tr><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td>
		      <td>".number_format($row['FTB_A'])."</td>";
 }echo"</tbody></table></div>Mouse/Scroll for more results<br>";
 }
 
 ?>
 <?php
  $component=$_GET['Component'];
 if (  $component =='Family Tax Benefit Part B')
 {
	 $query="SELECT Electorate,FTB_B FROM welfare_by_electorate ORDER BY FTB_B  DESC";
	  $result = mysqli_query($db, $query );
	  echo"<H3>FTB B recipients by Federal Electorate</h3>
		  <div class='source'>Source: Department of Human Services published at data.gov.au</div>
		  <div class='expand'><table class='wide'><tbody><tr><td>Federal Electorate</td><td>Number</td></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {
	  
	 echo"<tr><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td>
		      <td>".number_format($row['FTB_B'])."</td>";
 }echo"</tbody></table></div>Mouse/Scroll for more results";
 }
 
 ?>
 <?php
 $component=$_GET['Component'];
 if (  $component =='Newstart Allowance')
 {
	 $query="SELECT Electorate,Newstart FROM welfare_by_electorate ORDER BY Newstart  DESC";
	  $result = mysqli_query($db, $query );
	  echo"
		  <H3>NewStart recipients by Federal Electorate</h3><div class='source'>Source: Department of Human Services published at data.gov.au</div>
	  <div class='expand'>
	  <table class='wide'><tbody><tr><td>Federal Electorate</td><td>Number</td></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {
	  
	 echo"<tr><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td>
		      <td>".number_format($row['Newstart'])."</td>";
 }echo"</tbody></table></div>Mouse/Scroll for more results<br>";
 }
 
 ?>
 <?php
 $component=$_GET['Component'];
 if (  $component =='Widow B Pension')
 {
	 $query="SELECT Electorate,WidowB_Pension FROM welfare_by_electorate ORDER BY WidowB_Pension  DESC";
	  $result = mysqli_query($db, $query );
	  echo"<H3>NewStart recipients by Federal Electorate</h3><div class='source'>Source: Department of Human Services published at data.gov.au</div>
		  
	  
	  <div class='expand'><table class='wide'><tbody><tr><td>Federal Electorate</td><td>Number</td></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {
	  
	 echo"<tr><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td>
		      <td>".number_format($row['WidowB_Pension'])."</td>";
 }echo"</tbody></table></div>Mouse/Scroll for more results<br>";
 }
 
 ?>
 <?php
 $component=$_GET['Component'];
 if (  $component =='Carer Allowance (Child)')
 {
	 echo"<p>A supplementary payment for carers who provide daily care and attention at home 
		 for a person with a disability, severe medical condition or who is frail and aged. 
	 Carer Allowance (CA) may be paid in addition to income support payments.  
	 If a customer does not qualify for Carer Allowance (Child) based on the level of care required, 
	 the child they are caring for may still qualify for a Health Care Card (HCC) if at least 14 hours
	  a week of additional care and attention is provided. </p>

Notes:
- Unless otherwise specified CA excludes HCC Only recipients and/or child care receivers.<br>
- Due to changes in data source a break-in-series exists for Carer Allowance data from 1 July 2013 
and again from 1 October 2013.  Care should be taken when comparing time series data.<br>
- Carer Allowance data utilises a customers’ home address as their primary address type to determine 
locational boundaries (e.g. State, SA, LGA, etc.), this may differ from other reported payments.";
	 $query="SELECT Electorate,Carer_Allowance FROM welfare_by_electorate ORDER BY Carer_Allowance  DESC";
	  $result = mysqli_query($db, $query );
	  echo"<H3>Carer Allowance (Adult) recipients by Federal Electorate</h3><div class='source'>Source: Department of Human Services published at data.gov.au</div>
		  
	  
	  <div class='expand'><table class='wide'><tbody><tr><td>Federal Electorate</td><td>Number</td></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {
	  
	 echo"<tr><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td>
		      <td>".number_format($row['Carer_Allowance'])."</td>";
 }echo"</tbody></table></div>Mouse/Scroll for more results<br>";
 }
 
 ?>
 <?php
 $component=$_GET['Component'];
 if (  $component =='Carer Payment')
	 
 {
	 echo"<p>Carer Payment provides income support for carers who, because of the demands 
		 of their caring role, are unable to support themselves through substantial paid employment.  <p>

Notes:
- Carer Payment totals include overseas customers.<br>
- Due to changes in data source a break-in-series exists for Carer Payment data from 1 July 2013 and again from 1 October 2013.  Care should be taken when comparing time series data.<br>
- Carer Payment data utilises a customers’ home address as their primary address type to determine locational boundaries
 (e.g. State, SA, LGA, etc.), this may differ from other reported payments.";
	 $query="SELECT Electorate,Carer_Payment FROM welfare_by_electorate ORDER BY Carer_Payment  DESC";
	  $result = mysqli_query($db, $query );
	  echo"<H3>Carer Payment recipients by Federal Electorate</h3><div class='source'>Source: Department of Human Services published at data.gov.au</div>
		  
	  
	  <div class='expand'><table class='wide'><tbody><tr><td>Federal Electorate</td><td>Number</td></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {
	  
	 echo"<tr><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td>
		      <td>".number_format($row['Carer_Payment'])."</td>";
 }echo"</tbody></table></div>Mouse/Scroll for more results<br>";
 }
 
 ?>
 <?php
 $component=$_GET['Component'];
 if (  $component =='Wife Pension (DSP)')
 {
	 echo"<p>Wife Pensions are income support payments for the female partner of an Age or Disability Support Pensioner respectively. There have been no new grants of Wife Pension since 1 July 1995. Current recipients remain eligible to 
		 receive this payment until otherwise disqualified from receiving it, or until they reach the qualifying age for the Age Pension.</p> ";
	 $query="SELECT Electorate,WP_DSP FROM welfare_by_electorate ORDER BY WP_DSP  DESC";
	  $result = mysqli_query($db, $query );
	  echo"<H3>Wife Pension (DSP) recipients by Federal Electorate</h3><div class='source'>Source: Department of Human Services published at data.gov.au</div>
		  
	  
	  <div class='expand'><table class='wide'><tbody><tr><td>Federal Electorate</td><td>Number</td></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {
	  
	 echo"<tr><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td>
		      <td>".number_format($row['WP_DSP'])."</td>";
 }echo"</tbody></table></div>Mouse/Scroll for more results<br>";
 }
 
 ?>