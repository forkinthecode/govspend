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