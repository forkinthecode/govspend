 <?php
 $component=$_GET['Component'];
 if (  $component =='Carer Allowance (Adult)' 
	 || $component =='Compensation and debt relief' 
	 || $component =='Child Disability Assistance Payment)' 
	 || $component =='Carer Supplement' 
	 || $component =='Ex-Gratia Payments to Unsuccessful Applicants of Carer Payment (Child)'
	 || $component =='Mobility Allowance' 
	 || $component =='Pensioner Education Supplement' 
	 || $component =='Utilities Allowance (Working Age Payments)'
	 || $component =='Investment Approaches to Welfare - Evaluation'
	 || $component== 'Age Pension and Pensioner Concessions Information'
	 || $component== 'Extend deeming provisions to account-based income streams _ awareness strategy')
 {
	 echo"<p>There is no electorate breakdown for this payment.</p>";
 }
 
 ?>
 <?php
  $component=$_GET['Component'];
 if (  $component =='Widow Allowance')
 {
	 echo"<p>Widow Allowance provides income support for older working age women who lose the support of a partner and face 
		 barriers to finding employment because of limited participation. Access to Widow Allowance is restricted with new 
	 grants only being made available to women who were born on or before 1 July 1955. Data includes recipients who are 
	 determined to be current (i.e. entitled to be paid) on the Centrelink payment
		  system and are not in receipt of CDEP Participation Supplement or a zero rate of payment. </p>
	";
	 $query="SELECT Electorate,Widow_Allowance FROM welfare_by_electorate ORDER BY Widow_Allowance   DESC";
	  $result = mysqli_query($db, $query );
	  echo"
		  
		  <H3>$component recipients by Federal Electorate</h3>
	  <div class='source'>Source: Department of Human Services published at data.gov.au</div>
	  
	  <div class='expand'><table class='wide'><tbody><tr><td>Federal Electorate</td><td>Number</td></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {
	  
	  
			 echo"<tr><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td>
		      <td>".number_format($row['Widow_Allowance'])."</td>";
 }echo"</tbody></table></div>";
 }
 
 ?>
 <?php
  $component=$_GET['Component'];
 if (  $component =='Wife Pension (Age)')
 {
	 echo"<p>Wife Pensions are income support payments for the female partner of an Age or Disability Support Pensioner respectively. There have been no new grants of Wife Pension since 1 July 1995. Current recipients remain eligible to receive this payment until otherwise disqualified from receiving it, or until they reach the qualifying age for the Age Pension.  
		 Data includes recipients who are determined to be current (i.e. entitled to be paid) or suspended on the Centrelink payment system.</p>
	";
	 $query="SELECT Electorate,WP_Age FROM welfare_by_electorate ORDER BY WP_Age   DESC";
	  $result = mysqli_query($db, $query );
	  echo"
		  
		  <H3>$component recipients by Federal Electorate</h3>
	  <div class='source'>Source: Department of Human Services published at data.gov.au</div>
	  
	  <div class='expand'><table class='wide'><tbody><tr><td>Federal Electorate</td><td>Number</td></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {
	  
	  
			 echo"<tr><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td>
		      <td>".number_format($row['WP_Age'])."</td>";
 }echo"</tbody></table></div>";
 }
 
 ?>
 <?php
  $component=$_GET['Component'];
 if (  $component =='Special Benefit')
 {
	 echo"<p>Special Benefit is an income support payment for people who are in severe financial hardship due to circumstances beyond their control and who are ineligible for any other income support payment. Data includes recipients who are determined to be current (i.e. entitled to be paid)
		  on the Centrelink payment system and not in receipt of a zero rate of payment.</p>
	";
	 $query="SELECT Electorate,Special_Benefit FROM welfare_by_electorate ORDER BY Special_Benefit   DESC";
	  $result = mysqli_query($db, $query );
	  echo"
		  
		  <H3>$component recipients by Federal Electorate</h3>
	  <div class='source'>Source: Department of Human Services published at data.gov.au</div>
	  
	  <div class='expand'><table class='wide'><tbody><tr><td>Federal Electorate</td><td>Number</td></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {
	  
	  
			 echo"<tr><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td>
		      <td>".number_format($row['Special_Benefit'])."</td>";
 }echo"</tbody></table></div>";
 }
 
 ?>
 
 <?php
  $component=$_GET['Component'];
 if (  $component =='Sickness Allowance')
 {
	 echo"<p>Sickness Allowance is a payment made to people who are temporarily unfit, due to illness or injury,
	  to perform their usual work or study, and have a job to return to or intend to resume studying when fit to do so. 
	  Data includes recipients who are determined to be current (i.e. entitled to be paid) on the Centrelink payment system and not in receipt of a zero rate of payment.</p>
	";
	 $query="SELECT Electorate,Sickness_Allowance FROM welfare_by_electorate ORDER BY Sickness_Allowance   DESC";
	  $result = mysqli_query($db, $query );
	  echo"
		  
		  <H3>$component recipients by Federal Electorate</h3>
	  <div class='source'>Source: Department of Human Services published at data.gov.au</div>
	  
	  <div class='expand'><table class='wide'><tbody><tr><td>Federal Electorate</td><td>Number</td></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {
	  
	  
			 echo"<tr><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td>
		      <td>".number_format($row['Sickness_Allowance'])."</td>";
 }echo"</tbody></table></div>";
 }
 
 ?>
 
 <?php
  $component=$_GET['Component'];
 if (  $component =='Student Assistance Act 1973 - ABSTUDY - Secondary' ||
	 $component =='Student Assistance Act 1973 - ABSTUDY - Tertiary')
 {
	 echo"<p>ABSTUDY (Living Allowance) provides a living allowance and a range of supplementary benefits for Aboriginal and Torres Strait Islander students and apprentices.
		  Data includes recipients who are determined to be current (i.e. entitled to be paid) on the Centrelink payment system.</p>
	";
	 $query="SELECT Electorate,Abstudy_LA FROM welfare_by_electorate ORDER BY Abstudy_LA   DESC";
	  $result = mysqli_query($db, $query );
	  echo"
		  
		  <H3>$component recipients by Federal Electorate</h3>
	  <div class='source'>Source: Department of Human Services published at data.gov.au</div>
	  
	  <div class='expand'><table class='wide'><tbody><tr><td>Federal Electorate</td><td>Number</td></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {
	  
	  
			 echo"<tr><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td>
		      <td>".number_format($row['Abstudy_LA'])."</td>";
 }echo"</tbody></table></div>";
 }
 
 ?>
 <?php
  $component=$_GET['Component'];
 if (  $component =='Partner Allowance Pension')
 {
	 echo"<p>Partner Allowance provides income support for older partners of income support recipients who face barriers to finding employment because of their previous limited participation in the workforce. Partner Allowance has been closed to new entrants since 20 September 2003. Data includes recipients who are determined to be current (i.e. entitled to be paid)
		  on the Centrelink payment system and are not in receipt of CDEP Participation Supplement or a zero rate of payment. 
	 
	 </p>";
	 $query="SELECT Electorate,Partner_Allowance FROM welfare_by_electorate ORDER BY Partner_Allowance DESC";
	  $result = mysqli_query($db, $query );
	  echo"
		  
		  <H3>$component recipients by Federal Electorate</h3>
	  <div class='source'>Source: Department of Human Services published at data.gov.au</div>
	  
	  <div class='expand'><table class='wide'><tbody><tr><td>Federal Electorate</td><td>Number</td></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {
	  
	  
			 echo"<tr><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td>
		      <td>".number_format($row['Partner_Allowance'])."</td>";
 }echo"</tbody></table></div>";
 }
 
 ?>
 <?php
  $component=$_GET['Component'];
 if (  $component =='Youth Allowance (Other)')
 {
	 echo"<p>Youth Allowance (other) is the primary income support payment for young people aged 16‒21 years who are seeking or preparing for paid employment. Some 15 year olds may also receive assistance. To qualify for Youth Allowance (other) a person must be unemployed, aged under 22, looking for work or combining part‐time study with job search, or undertaking any other approved activity, or temporarily incapacitated for work or study. 
		 Data includes recipients who are determined to be current (i.e. entitled to be paid) on the Centrelink payment system.
	 
	 </p>";
	 $query="SELECT Electorate,YAO FROM welfare_by_electorate ORDER BY YAO DESC";
	  $result = mysqli_query($db, $query );
	  echo"
		  
		  <H3>$component recipients by Federal Electorate</h3>
	  <div class='source'>Source: Department of Human Services published at data.gov.au</div>
	  
	  <div class='expand'><table class='wide'><tbody><tr><td>Federal Electorate</td><td>Number</td></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {
	  
	  
			 echo"<tr><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td>
		      <td>".number_format($row['YAO'])."</td>";
 }echo"</tbody></table></div>";
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
		  
		  <H3>$component recipients by Federal Electorate</h3>
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
		  
		  <H3>$component recipients by Federal Electorate</h3>
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
	 echo"<p>DSP is an income support payment for people who are unable to work for 15 hours or more per week at or above the relevant minimum wage, independent of a Program of Support due to permanent physical, intellectual or psychiatric impairment. A DSP claimant must be aged 16 years or over and under
		  Age Pension age at date of claim, however once in receipt of DSP, a person can continue to receive DSP beyond Age Pension age.</p> ";
	 $query="SELECT Electorate,DSP FROM welfare_by_electorate ORDER BY DSP DESC";
	  $result = mysqli_query($db, $query );
	  echo"
		  
		  <H3>$component recipients by Federal Electorate</h3>
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
	 echo"<p>Age Pension is a support payment for people who have reached the qualifying age. From 1 July 2013, the qualifying age for both men and women is 65 years. From 1 July 2017 the Age Pension qualifying age will progressively increase from 65 years to 67 years, reaching 67 years in 2023. This affects both men and women born on or after 1 July 1952.  Age Pension recipients have the choice of having their Age Pension paid by either the Department of Human Services (DHS) or the Department of Veterans' Affairs (DVA), DHS pays the vast majority of Age Pensions. Data.gov.au only includes data for the DHS customers.  
		 Data includes recipients who are determined to be current (i.e. entitled to be paid) or suspended on the Centrelink payment system.</p>";
	 $query="SELECT Electorate,Age_Pension FROM welfare_by_electorate ORDER BY Age_Pension DESC";
	  $result = mysqli_query($db, $query );
	  echo"
		  
		  <H3>$component recipients by Federal Electorate</h3>
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
	 echo"<p>Family Tax Benefit (FTB) was introduced to help with the cost of raising children. 
		 FTB Part A is the most common payment to help with the cost of raising children and is paid per child. 
	 It includes a supplement per child that becomes payable after the end of the financial year. 
	 FTB Part A is income tested on family income. </p>
	 <p>Most families with at least one dependent child aged 15 and under are eligible to receive FTB. Receipt of FTB should be viewed differently to receipt of income support payments. FTB is paid to one parent in respect of a child. 
	 FTB data should not be analysed by the gender of the payment recipient as payment is made to the family and not to the individual person.</p>
	 <p>Information shown here in regard to FTB only includes customers who elect to receive their FTB entitlement on a fortnightly basis. These are counted in a population referred to as an FTB instalment population. FTB instalment populations exclude people who are paid through a lump sum which is claimable at the end of a financial year</p>";
	 
	 $query="SELECT Electorate,FTB_A FROM welfare_by_electorate ORDER BY FTB_A  DESC";
	  $result = mysqli_query($db, $query );
	   echo"<H3>$component recipients by Federal Electorate</h3>
		  
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
	 echo"<p>FTB Part B gives extra assistance to single-parent families 
	 and to couple families where one income is low. It is paid on a per family basis and includes a supplement that 
	 becomes payable after the end of the financial year. FTB Part B is income tested for single parents, 
	 and is income tested on both the lower income earner and the main income earner for two-parent families.</p>
	 <p>Most families with at least one dependent child aged 15 and under are eligible to receive FTB. Receipt of FTB should be viewed differently to receipt of income support payments. FTB is paid to one parent in respect of a child. 
	 FTB data should not be analysed by the gender of the payment recipient as payment is made to the family and not to the individual person.</p>
	 <p>Information shown here in regard to FTB only includes customers who elect to receive their FTB entitlement on a fortnightly basis. These are counted in a population referred to as an FTB instalment population. 
	 FTB instalment populations exclude people who are paid through a lump sum which is claimable at the end of a financial year</p>";
	 $query="SELECT Electorate,FTB_B FROM welfare_by_electorate ORDER BY FTB_B  DESC";
	  $result = mysqli_query($db, $query );
	 echo"<H3>$component recipients by Federal Electorate</h3>
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
	
		  echo"<H3>$component recipients by Federal Electorate</h3>
	  <div class='source'>Source: Department of Human Services published at data.gov.au</div>
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
	  echo"<H3>$component recipients by Federal Electorate</h3>
		  <div class='source'>Source: Department of Human Services published at data.gov.au</div>
		  
	  
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
 if (  $component =='Newstart')
 {
	 echo"Newstart Allowance is the major payment for unemployed people who are 22 and over, but under the qualifying age for the Age Pension. Recipients must satisfy the activity test by seeking work or participating in an activity designed to improve their employment prospects. Data includes recipients who are determined to be current (i.e. 
		 entitled to be paid) on the Centrelink payment system and are not in receipt of CDEP Participation Supplement or a zero rate of payment.</p> ";
	 $query="SELECT Electorate,WidowB_Pension FROM welfare_by_electorate ORDER BY WidowB_Pension  DESC";
	  $result = mysqli_query($db, $query );
	  echo"<H3>$component recipients by Federal Electorate</h3>
		  <div class='source'>Source: Department of Human Services published at data.gov.au</div>
		  
	  
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
 if (  $component =='Parenting Payment Single')
 {
	 echo"<p>Parenting Payment provides income support for parents or guardians to help with the cost of raising children. Parenting Payment Single is an income support payment for single parents with a child under eight years of age. 
		 Data includes recipients who are determined to be current (i.e. entitled to be paid) on the Centrelink payment system.";
	 $query="SELECT Electorate,PPS FROM welfare_by_electorate ORDER BY PPS  DESC";
	  $result = mysqli_query($db, $query );
	   echo"<H3>$component recipients by Federal Electorate</h3>
		  <div class='source'>Source: Department of Human Services published at data.gov.au</div>
		  
	  
	  <div class='expand'><table class='wide'><tbody><tr><td>Federal Electorate</td><td>Number</td></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {
	  
	 echo"<tr><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td>
		      <td>".number_format($row['PPS'])."</td>";
 }echo"</tbody></table></div>Mouse/Scroll for more results<br>";
 }
 
 ?>
 <?php
 $component=$_GET['Component'];
 if (  $component =='Parenting Payment Partnered')
 {
	 echo"<p>Parenting Payment provides income support for parents or guardians to help with the cost of raising children. 
		 Parenting Payment Partnered is an income support payment for partnered parents with a youngest child under six years of age. 
	 
		 Data includes recipients who are determined to be current (i.e. entitled to be paid) on the Centrelink payment system.";
	 $query="SELECT Electorate,PPP FROM welfare_by_electorate ORDER BY PPP  DESC";
	  $result = mysqli_query($db, $query );
	   echo"<H3>$component recipients by Federal Electorate</h3>
		  <div class='source'>Source: Department of Human Services published at data.gov.au</div>
		  
	  
	  <div class='expand'><table class='wide'><tbody><tr><td>Federal Electorate</td><td>Number</td></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {
	  
	 echo"<tr><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td>
		      <td>".number_format($row['PPP'])."</td>";
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
	  echo"<H3>$component recipients by Federal Electorate</h3>
		  <div class='source'>Source: Department of Human Services published at data.gov.au</div>
		  
	  
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
	   echo"<H3>$component recipients by Federal Electorate</h3>
		  <div class='source'>Source: Department of Human Services published at data.gov.au</div>
		  
	  
	  <div class='expand'><table class='wide'><tbody><tr><td>Federal Electorate</td><td>Number</td></tr>";
	  while ($row = $result->fetch_assoc()) 
	     {
	  
	 echo"<tr><td><a href='electorate.php?Electorate=".$row['Electorate']."'>".$row['Electorate']."</a></td>
		      <td>".number_format($row['WP_DSP'])."</td>";
 }echo"</tbody></table></div>Mouse/Scroll for more results<br>";
 }
 
 ?>