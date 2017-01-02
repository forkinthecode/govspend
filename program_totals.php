

<?php
 if( isset($_GET['Component'])  )
 {
$component=$_GET['Component'];
echo"test1";
                            $total_current = "SELECT current,sum(current) FROM `budget_table15_16` ";
                               $result = mysqli_query($db, $total_current );
                                                        
                            while ($row = $result->fetch_assoc()) 
                            $total_current = $row['sum(current)'];//assigns this value to a variable.
                            ///////////////////////////////////////////
                            $query_total_last = "SELECT last,sum(last) FROM `budget_table15_16` 
                            WHERE component ='$component' GROUP BY component ";//calculates total fundingfor the prior budget year for agencies where search term forms part of their name
                            $result = mysqli_query($db, $query_total_last);
                                                         
                            while ($row = $result->fetch_assoc()) 
                            $query_total_last_year = $row['sum(last)'];//assigns this value to a variable.
                            ////////////////////////////////////////////////////////////////////
                            $query_total_current = "SELECT current,sum(current) FROM  `budget_table15_16`
                           WHERE component LIKE'%$component% GROUP BY component ";//calculates total fundingfor current year for agencies with search term in name
                            $result = mysqli_query($db, $query_total_current );
                                                         
                            while ($row = $result->fetch_assoc()) 
                            $query_total_current_year = $row['sum(current)'];//assign this value to a variable

                            //////////////////////////////////////////////////////////////////////////////////////////
                            $percent = (($query_total_current_year/$total_current)*100);//$percent variable is used in scripts/tax_totals.php and the Flot pie graph
                            //////////////////////////////////////////////////////////////////////////////////////////

                            $billion_ = "SELECT current,sum(current) FROM `budget_table15_16`
                               WHERE component ='$component' GROUP BY component ";
                            $result = mysqli_query($db, $billion_ );
                                                         @$num_results = mysqli_num_rows($result);
                            while ($row = $result->fetch_assoc()) 
                             $value = $row['sum(current)'];
                             $billion = ($value/1000000); //divides this year's value by 1 m
                            ///////////////////////////////////////////////////////////////////////


                            $actual_PIT = $query_total_current_year * 0.00000048;           //divides current year's value into proportion that comes FROM personal income tax
                            $PIT = ($actual_PIT/$total_current)*100/1;         //finds percentage actual_PIT is of the whole 
                            $actual_TOS = $query_total_current_year * 0.00000052;           //divides current year value into proportion that comes FROM company tax etc
                            $TOS = ($actual_TOS/$total_current)*100/1;
                            ///////////////////////////////////////////////////////////////////
                            {
                            

						   	 echo"<hr><table class='stats'>
						   	 <tr><th>Total</th><th>Corporate Taxes</th><th>Personal Taxes</th></tr>
						   	 <tr><th><h3>$".number_format($billion, 3)." B</h3></th>
						   	 <th><h3>$".number_format($actual_TOS,3)." B</h3></th>
						   	 <th><h3>$".number_format($actual_PIT, 3)." B</h3></th>

						   	</tr></table><hr><div class='source'>Source: Calculated based on figures in budget documents</div>";
                               }
}
                            ?>


<?php
 if( isset($_GET['Program']) &&  !isset($_GET['Component']) )
 {
$program=$_GET['Program'];
echo"test2";
                            $total_current = "SELECT current,sum(current) FROM `budget_table15_16` ";
                               $result = mysqli_query($db, $total_current );
                                                        
                            while ($row = $result->fetch_assoc()) 
                            $total_current = $row['sum(current)'];//assigns this value to a variable.
                            ///////////////////////////////////////////
                            $query_total_last = "SELECT last,sum(last) FROM `budget_table15_16` 
                            WHERE program='$program' GROUP BY program ";//calculates total fundingfor the prior budget year for agencies where search term forms part of their name
                            $result = mysqli_query($db, $query_total_last);
                                                         
                            while ($row = $result->fetch_assoc()) 
                            $query_total_last_year = $row['sum(last)'];//assigns this value to a variable.
                            ////////////////////////////////////////////////////////////////////
                            $query_total_current = "SELECT current,sum(current) FROM  `budget_table15_16`
                               WHERE program='$program' GROUP BY program ";//calculates total fundingfor current year for agencies with search term in name
                            $result = mysqli_query($db, $query_total_current );
                                                         
                            while ($row = $result->fetch_assoc()) 
                            $query_total_current_year = $row['sum(current)'];//assign this value to a variable

                            //////////////////////////////////////////////////////////////////////////////////////////
                            $percent = (($query_total_current_year/$total_current)*100);//$percent variable is used in scripts/tax_totals.php and the Flot pie graph
                            //////////////////////////////////////////////////////////////////////////////////////////

                            $billion_ = "SELECT current,sum(current) FROM `budget_table15_16`
                               WHERE program ='$program' GROUP BY program ";
                            $result = mysqli_query($db, $billion_ );
                                                         @$num_results = mysqli_num_rows($result);
                            while ($row = $result->fetch_assoc()) 
                             $value = $row['sum(current)'];
                             $billion = ($value/1000000); //divides this year's value by 1 m
                            ///////////////////////////////////////////////////////////////////////


                            $actual_PIT = $query_total_current_year * 0.00000048;           //divides current year's value into proportion that comes FROM personal income tax
                            $PIT = ($actual_PIT/$total_current)*100/1;         //finds percentage actual_PIT is of the whole 
                            $actual_TOS = $query_total_current_year * 0.00000052;           //divides current year value into proportion that comes FROM company tax etc
                            $TOS = ($actual_TOS/$total_current)*100/1;
                            ///////////////////////////////////////////////////////////////////
                            {
                            

						   	 echo"<hr><table class='stats'>
						   	 <tr><th>Total</th><th>Corporate Taxes</th><th>Personal Taxes</th></tr>
						   	 <tr><th><h3>$".number_format($billion, 3)." B</h3></th>
						   	 <th><h3>$".number_format($actual_TOS,3)." B</h3></th>
						   	 <th><h3>$".number_format($actual_PIT, 3)." B</h3></th>

						   	</tr></table><hr><div class='source'>Source: Calculated based on figures in budget documents</div>";
                  }
}
                            ?>