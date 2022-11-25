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
    //insert csv file data in database
    include('db.php');
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

    ?>
<!-- upload csv file and insert form -->
<div id="wrapper">
    <form method="post" action="" enctype="multipart/form-data">
        <input type="file" name="file"/>
        <input type="submit" name="submit_file" value="Submit"/>
    </form>
</div>
<!-- end insert csv file data in database -->

<!-- download csv file through button  -->
<div id="wrapper">
    <form class="form-horizontal" action="downloadcsv.php" method="post" name="upload_excel"   
    enctype="multipart/form-data">
        <input type="submit" name="Export" class="btn btn-success" value="Download CSV File From DataBase"/>
    </form>  
</div> 
<!-- end download csv file through button  -->

<!-- show all inserted data in tabluer form -->
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
        echo '<form method="post" action="checked.php">';
            // print_r($data);
            if($data->num_rows >0){
                foreach ($data as $row) { 
                    echo '<tr><td>'.$i.'</td>
                        <td>'.$row['First_Name'].'</td>
                        <td>'.$row['Country'].'</td>
                        <td><input type="checkbox" class="check" name="checkbox[]" value='.$row['id'].' ></td>
                        </tr>'; 
                    $i++;  
                }
            } 
            //button for download selected data 
             echo '<button type="submit" name="checkbox_data" >Save Checked and Download csv</button>';
        echo'</form>';
    ?>
</table>
</body>
</html>