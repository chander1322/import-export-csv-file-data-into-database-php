<?php
//download all data in csv file
    include('db.php');
	if(isset($_POST['Export'])){
        $query = "SELECT * from emp_data ORDER BY id ASC"; 
        $result = mysqli_query($db, $query);

        #start if for header of csv file 
        if($result->num_rows>0){
            $delimiter = ","; 
            $filename = "employe_data_" . date('Y-m-d') . ".csv"; 
             // Create a file pointer 
            $f = fopen('php://memory', 'w');  
            // Set column headers 
            $fields=array('id', 'First_Name', 'Country','status');  
            fputcsv($f,$fields,$delimiter);
        } #endif

        #start loop download data in csv
        while($row = mysqli_fetch_assoc($result))  
        {  
            // print hello place of barry french city
            if($row['Country']=='Barry French'){
                $country= "hello";
            }
            else{
                $country=$row['Country'];
            }
            //download those data which have status is 1
            if($row['status']==1){
                $lineData = array($row['id'], $row['First_Name'], $country,$row['status']);
                fputcsv($f,$lineData,$delimiter);
            }
        } #endloop

        #Move back to beginning of file 
        fseek($f, 0);

        #Set headers to download file rather than displayed 
        header('Content-Type: text/csv'); 
        header('Content-Disposition: attachment; filename="' . $filename . '";');
         
        #output all remaining data on a file pointer 
        fpassthru($f); 
    }  
?>
