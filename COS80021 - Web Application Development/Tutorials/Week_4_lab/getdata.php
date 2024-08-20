<html>

<body>
    <form action = "getdata.php" method ="get">

<label>Please select a make </label>        
        <select name="selectbox">
        <option value="all">all</option>
        <option value="DELL">DELL</option>
        <option value="APPLE">APPLE</option>
        <option value="ACER">ACER</option>
        <option value="LENOVO">LENOVO</option>
        <option value="HP">HP</option>
        <option value="XIAOMI">XIAOMI</option>
        </select>
    <br>
        <input type = "submit" value ="fetch">
    </form>

<?php

    if(isset($_GET["selectbox"])){

        $user_option = $_GET["selectbox"];
       

        $table_name = 'inventory';
        if($user_option=="all")
            $query = "SELECT * from $table_name;";

        else
            $query = "SELECT * from $table_name where make ='$user_option';";


        $host = "feenix-mariadb.swin.edu.au";
        $user = "s104837257";
        $pwd = "220899";
        $sql_db = "s104837257_db";

        $connect_db = mysqli_connect($host,$user,$pwd,$sql_db)

        Or die ("<p>Unable to connect to the database server.</p>". "<p>Error code ".mysqli_connect_errno ().": ". mysqli_connect_error ()). "</p>";

        if($connect_db){

            echo "<p>database connection successful</p>";

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

    }

?>
</html>