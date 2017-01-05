<?php
if (isset($_GET['acnc'])  )
 {
	 include'login.php';

// output headers so that the file is downloaded rather than displayed

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header('Content-Description: File Transfer');
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename={$fileName}");
header("Expires: 0");
header("Pragma: public");

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array(
	'ABN',
	'Legal_Name',
	'Other_Names',
	'Countries',
	'Address Type',
	'Address1',
	'Address2',
	'Address3',
	'Locality',
	'State',
	'Postcode',
	'Country',
	'Charity Website',
	'Registration_Date',
	'establishment_date',
	'Size',
	'Responsible_Persons',
	'FYE',
	'ACT',
	'NSW',
	'NT',
	'QLD',
	'SA',
	'TAS',
	'VIC',
	'WA',
	'PBI',
	'HPC',
	'Animals',
	'Culture',
	'Education',
	'Health',
	'Policy',
	'Environment',
	'Rights',
	'General_Public',
	'Reconciliation',
	'Religion',
	'Social',
	'Security',
	'Other',
	'Indigenous',
	'Aged',
	'Children',
	'Overseas',
	'Ethnic_Groups',
	'LGBT',
	'General',
	'Men',
	'Migrants',
	'Offenders',
	'Illness',
	'Disabilities',
	'Homelessness',
	'Unemployment',
	'Veterans',
	'Crime',
	'Disasters',
	'Women',
	'Youth'));


$query = "SELECT * FROM charities  ";
$result = mysqli_query($db, $query);
while ($row = $result->fetch_assoc())
{

fputcsv($output, array(
	$row['id'],
	$row['ABN'],
	$row['Legal_Name'],
	$row['Other_Names'],
	$row['Countries'],
	$row['Address Type'],
	$row['Address1'],
	$row['Address2'],
	$row['Address3'],
	$row['Locality'],
	$row['State'],
	$row['Postcode'],
	$row['Country'],
	$row['Charity Website'],
	$row['Registration_Date'],
	$row['establishment_date'],
	$row['Size'],
	$row['Responsible_Persons'],
	$row['FYE'],
	$row['ACT'],
	$row['NSW'],
	$row['NT'],
	$row['QLD'],
	$row['SA'],
	$row['TAS'],
	$row['VIC'],
	$row['WA'],
	$row['PBI'],
	$row['HPC'],
	$row['Animals'],
	$row['Culture'],
	$row['Education'],
	$row['Health'],
	$row['Policy'],
	$row['Environment'],
	$row['Rights'],
	$row['General_Public'],
	$row['Reconciliation'],
	$row['Religion'],
	$row['Social'],
	$row['Security'],
	$row['Other'],
	$row['Indigenous'],
	$row['Aged'],
	$row['Children'],
	$row['Overseas'],
	$row['Ethnic_Groups'],
	$row['LGBT'],
	$row['General'],
	$row['Men'],
	$row['Migrants'],
	$row['Offenders'],
	$row['Illness'],
	$row['Disabilities'],
	$row['Homelessness'],
	$row['Unemployment'],
	$row['Veterans'],
	$row['Crime'],
	$row['Disasters'],
	$row['Women'],
	$row['Youth']));
}    
 }


?>
<?php
if (isset($_GET['donations'])  )
 {
	 include'login.php';

// output headers so that the file is downloaded rather than displayed

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header('Content-Description: File Transfer');
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename={$fileName}");
header("Expires: 0");
header("Pragma: public");

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array(
	  'id',
    'Name',
   'Party',
  'Value'));
$query = "SELECT * FROM donations  ";
$result = mysqli_query($db, $query);
while ($row = $result->fetch_assoc())
{

fputcsv($output, array(
	$row['id'],
	$row['Name'],
	$row['Party'],
	$row['Value']));
}    
 }


?>
<?php
if (isset($_GET['budget'])  )
 {
	 include'login.php';

// output headers so that the file is downloaded rather than displayed

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header('Content-Description: File Transfer');
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename={$fileName}");
header("Expires: 0");
header("Pragma: public");

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array(
	'id',
	'Portfolio',
	'Agency',
	'Outcome',
	'Program',
	'Expense_Type',
	'Appropriation_Type',
	'Component',
	'last',
	'current',
	'plus1',
	'plus2',
	'plus3',
	'Source',
	'Source_table',
	'URL'));
$query = "SELECT * FROM budget_table15_16  ";
$result = mysqli_query($db, $query);
while ($row = $result->fetch_assoc())
{

fputcsv($output, array(
	$row['id'],
	$row['Portfolio'],
	$row['Agency'],
	$row['Outcome'],
	$row['Program'],
	$row['Expense_Type'],
	$row['Appropriation_Type'],
	$row['Component'],
	$row['last'],
	$row['current'],
	$row['plus1'],
	$row['plus2'],
	$row['plus3'],
	$row['Source'],
	$row['Source_table'],
	$row['URL']));
}    
 }


?>
<?php
if (isset($_GET['tax'])  )
 {
	 include'login.php';

// output headers so that the file is downloaded rather than displayed

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header('Content-Description: File Transfer');
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename={$fileName}");
header("Expires: 0");
header("Pragma: public");

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array(
	'id',
	'Name',
	'ABN',
	'Total_Income',
	'Taxable_Income',
	'Tax'));
$query = "SELECT * FROM tax  ";
$result = mysqli_query($db, $query);
while ($row = $result->fetch_assoc())
{

fputcsv($output, array(
	$row['id'],
	$row['Name'],
	$row['ABN'],
	$row['Total_Income'],
	$row['Taxable_Income'],
	$row['Tax']));
}    
 }


?>
<?php
if (isset($_GET['tenders'])  )
 {
	 include'login.php';

// output headers so that the file is downloaded rather than displayed

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header('Content-Description: File Transfer');
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename={$fileName}");
header("Expires: 0");
header("Pragma: public");

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array(
	'id',
'Portfolio',
'Agency',
'Parent_Contract_ID',
'Contract_ID',
'Publish Date',
'Amend_Date',
'Start',
'End',
'Value',
'Description',
'Procurement_Method',
'Panel',
'Name',
'Address',
'Locality',
'Postcode',
'ABN'));
$query = "SELECT * FROM tenders  ";
$result = mysqli_query($db, $query);
while ($row = $result->fetch_assoc())
{

fputcsv($output, array(
	$row['id'],
	$row['Portfolio'],
	$row['Agency'],
	$row['Parent_Contract_ID'],
	$row['Contract_ID'],
	$row['Publish Date'],
	$row['Amend_Date'],
	$row['Start'],
	$row['End'],
	$row['Value'],
	$row['Description'],
	$row['Procurement_Method'],
	$row['Panel'],
	$row['Name'],
	$row['Address'],
	$row['Locality'],
	$row['Postcode'],
	$row['ABN']));
}    
 }


?>
<?php
if (isset($_GET['grants'])  )
 {
	 include'login.php';

// output headers so that the file is downloaded rather than displayed

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header('Content-Description: File Transfer');
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename={$fileName}");
header("Expires: 0");
header("Pragma: public");

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array(
	'id',
	'grant_id',
	'Portfolio',
	'Agency',
	'Program',
	'Component',
	'Recipient',
	'Purpose',
	'Approved',
	'End',
	'Locality',
	'State',
	'Postcode',
	'Electorate',
	'Marginality',
	'Party',
	'Representative',
	'Council',
	'Funding',
	'Year'));
$query = "SELECT * FROM grants  ";
$result = mysqli_query($db, $query);
while ($row = $result->fetch_assoc())
{

fputcsv($output, array(
	$row['id'],
	$row['grant_id'],
	$row['Portfolio'],
	$row['Agency'],
	$row['Program'],
	$row['Component'],
	$row['Recipient'],
	$row['Purpose'],
	$row['Approved'],
	$row['End'],
	$row['Locality'],
	$row['State'],
	$row['Postcode'],
	$row['Electorate'],
	$row['Marginality'],
	$row['Party'],
	$row['Representative'],
	$row['Council'],
	$row['Funding'],
	$row['Year']));
}    
 }


?>
<?php
if (isset($_GET['welfare_by_electorate'])  )
 {
	 include'login.php';

// output headers so that the file is downloaded rather than displayed

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header('Content-Description: File Transfer');
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename={$fileName}");
header("Expires: 0");
header("Pragma: public");

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array(
	'id',
	'electorate',
	'state',
	'Abstudy_LA',
	'Abstudy_NL',
	'Age_Pension',
	'Austudy',
	'Carer_Allowance',
	'Carer_Allowance_HCC',
	'Carer_Payment',
	'Seniors_HC',
	'DSP',
	'Double_Orphan_Pension',
	'FTB_A',
	'FTB_B',
	'Health_Care_Card',
	'Low_Income_Card',
	'Newstart',
	'PPP',
	'PPS',
	'Partner_Allowance',
	'Pensioner_Concession_Card',
	'Sickness_Allowance',
	'Special_Benefit',
	'Widow_Allowance',
	'WidowB_Pension',
	'WP_AGE',
	'WP_DSP',
	'YAO',
	'YA_SA'));
$query = "SELECT * FROM welfare_by_electorate  ";
$result = mysqli_query($db, $query);
while ($row = $result->fetch_assoc())
{

fputcsv($output, array(
	$row['id'],
	$row['electorate'],
	$row['state'],
	$row['Abstudy_LA'],
	$row['Abstudy_NL'],
	$row['Age_Pension'],
	$row['Austudy'],
	$row['Carer_Allowance'],
	$row['Carer_Allowance_HCC'],
	$row['Carer_Payment'],
	$row['Seniors_HC'],
	$row['DSP'],
	$row['Double_Orphan_Pension'],
	$row['FTB_A'],
	$row['FTB_B'],
	$row['Health_Care_Card'],
	$row['Low_Income_Card'],
	$row['Newstart'],
	$row['PPP'],
	$row['PPS'],
	$row['Partner_Allowance'],
	$row['Pensioner_Concession_Card'],
	$row['Sickness_Allowance'],
	$row['Special_Benefit'],
	$row['Widow_Allowance'],
	$row['WidowB_Pension'],
	$row['WP_AGE'],
	$row['WP_DSP'],
	$row['YAO'],
	$row['YA_SA']));
}    
 }


?>
<?php
if (isset($_GET['welfare_by_electorate'])  )
 {
	 include'login.php';

// output headers so that the file is downloaded rather than displayed

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header('Content-Description: File Transfer');
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename={$fileName}");
header("Expires: 0");
header("Pragma: public");

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array(
	'id',
	'council',
	'ABSTUDY_LA',
	'ABSTUDY_NLA',
	'Age_Pension',
	'Austudy',
	'Carer_Allowance',
	'Carer_Card',
	'Carer_Payment',
	'SHC',
	'DSP',
	'FTB_A',
	'FTB_B',
	'HCC',
	'LIC',
	'Newstart',
	'PPP',
	'PPS',
	'Partner_Allowance',
	'Pensioner_Concession_Card',
	'Sickness_Allowance',
	'Special_Benefit',
	'Widow_Allowance',
	'Widow_B_Pension',
	'Wife_Pension_A',
	'Wife_Pension_DSP',
	'YAO',
	'YA_SA'));
$query = "SELECT * FROM lga_welfare  ";
$result = mysqli_query($db, $query);
while ($row = $result->fetch_assoc())
{

fputcsv($output, array(
	$row['id'],
	$row['council'],
	$row['ABSTUDY_LA'],
	$row['ABSTUDY_NLA'],
	$row['Age_Pension'],
	$row['Austudy'],
	$row['Carer_Allowance'],
	$row['Carer_Card'],
	$row['Carer_Payment'],
	$row['SHC'],
	$row['DSP'],
	$row['FTB_A'],
	$row['FTB_B'],
	$row['HCC'],
	$row['LIC'],
	$row['Newstart'],
	$row['PPP'],
	$row['PPS'],
	$row['Partner_Allowance'],
	$row['Pensioner_Concession_Card'],
	$row['Sickness_Allowance'],
	$row['Special_Benefit'],
	$row['Widow_Allowance'],
	$row['Widow_B_Pension'],
	$row['Wife_Pension_A'],
	$row['Wife_Pension_DSP'],
	$row['YAO'],
	$row['YA_SA']));
}    
 }


?>
<?php
if (isset($_GET['Indigenous'])  )
 {
	 include'login.php';

// output headers so that the file is downloaded rather than displayed

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header('Content-Description: File Transfer');
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename={$fileName}");
header("Expires: 0");
header("Pragma: public");

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array(
	'id',
	'suburb',
	'postcode',
	'non_Indigenous',
	'Aboriginal',
	'TSI',
	'TSI_IND',
	'not_stated',
	'total'));
$query = "SELECT * FROM indigenous_by_postcode ";
$result = mysqli_query($db, $query);
while ($row = $result->fetch_assoc())
{

fputcsv($output, array(
	$row['id'],
	$row['suburb'],
	$row['postcode'],
	$row['non_Indigenous'],
	$row['Aboriginal'],
	$row['TSI'],
	$row['TSI_IND'],
	$row['not_stated'],
	$row['total']));
}    
 }


?>
<?php
if (isset($_GET['seifa_by_electorate'])  )
 {
	 include'login.php';

// output headers so that the file is downloaded rather than displayed

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header('Content-Description: File Transfer');
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename={$fileName}");
header("Expires: 0");
header("Pragma: public");

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array(
	'id',
	'postcode',
	'URP',
	'score',
	'rank',
	'decile',
	'percentile',
	'state',
	'state_rank',
	'state_decile',
	'state_percentile',
	'Minimum score for SA1s in area',
	'Maximum score for SA1s in area',
	'% Usual Resident Population without a SA1 level score'));
$query = "SELECT * FROM seifa_by_postcode ";
$result = mysqli_query($db, $query);
while ($row = $result->fetch_assoc())
{

fputcsv($output, array(
	$row['id'],
	$row['postcode'],
	$row['URP'],
	$row['score'],
	$row['rank'],
	$row['decile'],
	$row['percentile'],
	$row['state'],
	$row['state_rank'],
	$row['state_decile'],
	$row['state_percentile'],
	$row['Minimum score for SA1s in area'],
	$row['Maximum score for SA1s in area'],
	$row['% Usual Resident Population without a SA1 level score']));
}    
 }


?>
<?php
if (isset($_GET['coordinates'])  )
 {
	 include'login.php';

// output headers so that the file is downloaded rather than displayed

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header('Content-Description: File Transfer');
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename={$fileName}");
header("Expires: 0");
header("Pragma: public");

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array(
	'id',
	'pcode',
	'locality',
	'state',
	'service_type',
	'delivery_centre',
	'area',
	'delivery',
	'lat',
	'lon',
	'coordinates'));
$query = "SELECT * FROM coordinates ";
$result = mysqli_query($db, $query);
while ($row = $result->fetch_assoc())
{

fputcsv($output, array(
	$row['id'],
	$row['pcode'],
	$row['locality'],
	$row['state'],
	$row['service_type'],
	$row['delivery_centre'],
	$row['area'],
	$row['delivery'],
	$row['lat'],
	$row['lon'],
	$row['coordinates']));
}    
 }


?>
<?php
if (isset($_GET['agor'])  )
 {
	 include'login.php';

// output headers so that the file is downloaded rather than displayed

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header('Content-Description: File Transfer');
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename={$fileName}");
header("Expires: 0");
header("Pragma: public");

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array(
	'id',
	'Portfolio1',
	'Agency',
	'Portfolio',
	'Classification',
	'Type',
	'GFS_Classification',
	'Materiality',
	'Description',
	'Established',
	'Created',
	'GFS_Function',
	'PS_Act_Body',
	'ASL',
	'Max No. of Board / Committee Members',
	'Paid Members?',
	'Board / Committee Appointed By',
	'Annual Report Prepared and Tabled?',
	'Auditor',
	'ABN',
	'Parent Body',
	'Total_Appropriations',
    'Total_Departmental_Expenses',
	'Head Office Address',
	'URL',
	'Strategic_Plan',
	'Annual_Reports',
	'Budget_Documentation'));
$query = "SELECT * FROM AGOR ";
$result = mysqli_query($db, $query);
while ($row = $result->fetch_assoc())
{

fputcsv($output, array(
	$row['id'],
	$row['Portfolio1'],
	$row['Agency'],
	$row['Portfolio'],
	$row['Classification'],
	$row['Type'],
	$row['GFS_Classification'],
	$row['Materiality'],
	$row['Description'],
	$row['Established'],
	$row['Created'],
	$row['GFS_Function'],
	$row['PS_Act_Body'],
	$row['ASL'],
	$row['Max No. of Board / Committee Members'],
	$row['Paid Members?'],
	$row['Board / Committee Appointed By'],
	$row['Annual Report Prepared and Tabled?'],
	$row['Auditor'],
	$row['ABN'],
	$row['Parent Body'],
	$row['Total_Appropriations'],
	$row['Total_Departmental_Expenses'],
	$row['Head Office Address'],
	$row['URL'],
	$row['Strategic_Plan'],
	$row['Annual_Reports'],
	$row['Budget_Documentation']));
}    
 }


?>
<?php
if (isset($_GET['privacy'])  )
 {
	 include'login.php';

// output headers so that the file is downloaded rather than displayed

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header('Content-Description: File Transfer');
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename={$fileName}");
header("Expires: 0");
header("Pragma: public");

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array(
	'id',
	'Agency'));
$query = "SELECT * FROM agencies ";
$result = mysqli_query($db, $query);
while ($row = $result->fetch_assoc())
{

fputcsv($output, array(
	$row['id'],
	$row['agency']));
}    
 }


?>