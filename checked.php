<?php 
//for selected data download in csv file
include('db.php');
if(isset($_POST['checkbox_data'])){
	$ids=$_POST['checkbox'];           #get id from index file which data checked
    $selected_id=implode(",",$ids);    #multiple id change array to string
	$query = "SELECT * from emp_data where id in ($selected_id)"; #select data for selected ids
    $result = mysqli_query($db, $query);  
    if($result->num_rows>0){
            $filename = "employe_data_" . date('Y-m-d') . ".csv"; 
            $f = fopen('php://memory', 'w');  
            #Set column headers 
            $fields=array('id', 'First_Name', 'Country','status'); 
             fputcsv($f,$fields,);
    }
    #start loop download data in csv
    while($row = mysqli_fetch_assoc($result))  
    {  
        $lineData = array($row['id'], $row['First_Name'], $row['Country'],$row['status']);
        fputcsv($f,$lineData);
    }
    #Move back to beginning of file 
    fseek($f, 0);
     
    #Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    #output all remaining data on a file pointer 
    fpassthru($f); 
}

?>