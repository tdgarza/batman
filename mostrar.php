<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>DATOS DE LA TABLA</h1>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lunes";

    $conn = new mysqli($servername, $username, $password, $dbname);
    //verifica coneccion
    if($conn-> connect_error){
        die("La conexion a la base de datos fallo: " .$conn->connect_error);
    }
    $sql = "SELECT * FROM martes";
    $result = $conn->query($sql);
    if($result->num_rows >0){
        echo "<table>";
        echo "<tr><th>id</th><th>nombre</th><th>apellido</th><th>nacimiento</th></tr>";
        while($row = $result->fetch_assoc()){
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["nombre"] . "</td><td>" . $row["apellido"] . "</td><td>" . $row["nacimiento"] . "</td><td>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron registros en la agenda";
    }
    ?>
</body>
</html>