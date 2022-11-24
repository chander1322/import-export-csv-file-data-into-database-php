<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <style type="text/css">
        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <?php
    $db= mysqli_connect("localhost","root","","xlstodb");
      if(isset($_POST['submit_file'])){
            $currentDirectory = getcwd(); //get current working directory
            $uploadDirectory = "/uploads/";
            $fileName = $_FILES['file']['name']; #uploded filename
            $fileTmpName  = $_FILES['file']['tmp_name'];  #temprary name
            $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
            if ($didUpload) {
              echo "The file " . basename($fileName) . " has been uploaded in folder<br>";
            }
            if($_FILES['file']['name'])
            {
                $filename = explode(".", $_FILES['file']['name']); #explode file name
                // print_r($filename);
                    if($filename[1] == 'csv')
                        {
                                $filename=$_FILES['file']['name'];
                                $handle = fopen($filename, "r");
                                while($data = fgetcsv($handle))//handling csv file 
                                        {
                                            $item1 = mysqli_real_escape_string($db, $data[0]);  
                                            $item2 = mysqli_real_escape_string($db, $data[1]);
                                            $query = "INSERT into emp_data(First_Name, Country) values('$item1','$item2')";
                                            mysqli_query($db, $query);
                                        }
                                fclose($handle);
                                echo "File sucessfully imported";
                                header("location:index.php");
                        }
            
            }
       
    }
// if(isset($_POST['Export'])){
//     // echo "hello";
//      // header("Content-Type: txt/csv; charset= utf=8");
//      // header("Content-Disposition: attachment; filename=data.csv");
//      //  $output = fopen("php://output", "w"); 
         
//       $query = "SELECT * from emp_data ORDER BY id ASC"; 

//       $result = mysqli_query($db, $query);  
//       if($result->num_rows>0){
//             $delimiter = ","; 
//             $filename = "employe_data_" . date('Y-m-d') . ".csv"; 
//              // Create a file pointer 
//             $f = fopen('php://memory', 'w');  
//             // Set column headers 
//             $fields=array('id', 'First_Name', 'Country');  
//             fputcsv($f,$fields,$delimiter);

//             // echo $filename;
//       }
//       while($row = mysqli_fetch_assoc($result))  
//       {  
//         $lineData = array($row['id'], $row['First_Name'], $row['Country']);
//         fputcsv($f,$lineData,$delimiter);
//       }
//          // Move back to beginning of file 
//         fseek($f, 0); 
//         // Set headers to download file rather than displayed 
//     header('Content-Type: text/csv'); 
//     header('Content-Disposition: attachment; filename="' . $filename . '";'); 
//     //output all remaining data on a file pointer 
//     fpassthru($f); 
//  }  



    ?>
<div id="wrapper">
 <form method="post" action="" enctype="multipart/form-data">
  <input type="file" name="file"/>
  <input type="submit" name="submit_file" value="Submit"/>
 </form>
</div>
<div id="wrapper">
     <form class="form-horizontal" action="downloadcsv.php" method="post" name="upload_excel"   
                          enctype="multipart/form-data">
            <input type="submit" name="Export" class="btn btn-success" value="export to csv"/>
     </form>  
 </div> 

<table>
    <thead>
        <tr style="font-size: 18px; font-weight: 600;">
            <td>Sr No.</td>
            <td>Name</td>
            <td>Country</td>
            <td>checkbox</td>

        </tr>
    </thead>
    
        <?php
            $Squery="select * from emp_data";

            $data= mysqli_query($db,$Squery);
            $i=1;
            $html='';
            // print_r($data);
            if($data->num_rows >0){
                foreach ($data as $row) { 

                   echo    '<tr><td>'.$i.'</td>
                            <td>'.$row['First_Name'].'</td>
                            <td>'.$row['Country'].'</td>
                            <td><form method="post" action=""><input type="checkbox" class="check" name="checkbox" id='.$row['id'].' ></td>
                            <p id="text" style="display:none" >Checkbox is CHECKED!</p>
                            </form>
                            </tr>'; 

                        $i++;  
                    } 
            } 
        ?>
        

    
</table>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery(".check").click(function (){
            jQuery( this ).attr( 'checked', true )
            // if(jQuery$('input[type="checkbox"]').attr( 'checked', true )){
            //     jQuery( this ).attr( 'checked', false )
            // }
        });

    });
</script>
</body>
</html>