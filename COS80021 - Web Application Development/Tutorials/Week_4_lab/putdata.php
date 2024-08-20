<html>

<body>
    <form action = "putdata.php" method ="post">

<label>Enter the make</label><input type="text" name="make" ><br><br>
<label>Enter the model</label><input type="text" name="model"><br><br>
<label>Enter the price</label><input type="text" name="price" ><br><br>
<label>Enter the quantity</label><input type="text" name="quantity" ><br><br>

       
    <br>
        <input type = "submit" value ="submit">
    </form>

<?php

    if(isset($_POST["make"]) && isset($_POST["model"]) && isset($_POST["price"]) && isset($_POST["quantity"])){

        $make = $_POST["make"];
        $model = $_POST["model"];
        $price = $_POST["price"];
        $quantity = $_POST["quantity"];
       
        $table_name = 'inventory';
        
            $query = "INSERT INTO $table_name(make,model,price,quantity) values ('$make','$model','$price','$quantity'); ";

        $host = "feenix-mariadb.swin.edu.au";
        $user = "s104837257";
        $pwd = "220899";
        $sql_db = "s104837257_db";

        $connect_db = mysqli_connect($host,$user,$pwd,$sql_db)

        Or die ("<p>Unable to connect to the database server.</p>". "<p>Error code ".mysqli_connect_errno ().": ". mysqli_connect_error ()). "</p>";

        $query_result = mysqli_query($connect_db,$query);

        if($query_result)
            echo "record written to database successfully";
        

        $query = "SELECT * FROM $table_name;";

            echo "<table border ='1'>"
                ."<tr><th>item_number</th><th>make</th><th>model</th>"
                ."<th>price</th><th>quantity</th></tr>";

            $query_result = mysqli_query($connect_db,$query)
            
            Or die ("<p>Unable to query the table.</p>". "<p>Error code ".mysqli_connect_errno ($connect_db).": ". mysqli_connect_error ($connect_db)). "</p>";
            
            $row = mysqli_fetch_row($query_result);

            while($row){

                echo "<tr><td>$row[0]</td><td>$row[1]</td>"
                    ."<td>$row[2]</td><td>$row[3]</td><td>$row[4]</td></tr>";

                $row = mysqli_fetch_row($query_result);
            }

        }

        

?>
</html>


<!--select first_name,last_name,language,years,city 
from Employees EM 
join Experience EX on EM.employee_id=EX.employee_id 
join Languages L on EX.language_id=L.language_id 
where language='PHP' and city='Melbourne' and years>=5; 