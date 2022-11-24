<?php
    $db= mysqli_connect("localhost","root","","xlstodb");
	if(isset($_POST['Export'])){
    $query = "SELECT * from emp_data ORDER BY id ASC"; 
      $result = mysqli_query($db, $query);  
      if($result->num_rows>0){
            $delimiter = ","; 
            $filename = "employe_data_" . date('Y-m-d') . ".csv"; 
             // Create a file pointer 
            $f = fopen('php://memory', 'w');  
            // Set column headers 
            $fields=array('id', 'First_Name', 'Country');  
            fputcsv($f,$fields,$delimiter);

            // echo $filename;
      }
      while($row = mysqli_fetch_assoc($result))  
      {  
        // print hello place of barry french city
        if($row['Country']=='Barry French'){
        	$country= "hello";
        }
        else{
        	$country=$row['Country'];
        }

        $lineData = array($row['id'], $row['First_Name'], $country);
        fputcsv($f,$lineData,$delimiter);
      }
         // Move back to beginning of file 
        fseek($f, 0); 
        // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
    //output all remaining data on a file pointer 
    fpassthru($f); 
 }  

?>
