<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Personajes de Marvel</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Personajes de Marvel</h1>

    <h2>Personajes</h2>
    <table>
        <tr>
        <th>Id</th>
            <th>Nombre</th>
            <th>Alias</th>
            <th>Fecha de Creación</th>
            <th>Descripción</th>
            <th>Comics</th>
            <th>Superpoderes</th>
        </tr>

        <?php
        // Realizar la conexión a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "marvel1";
    
        $conn = new mysqli($servername, $username, $password, $dbname);
    //verifica coneccion
    if($conn-> connect_error){
        die("La conexion a la base de datos fallo: " .$conn->connect_error);
        }

        // Consulta SQL para recuperar datos y relaciones
        $sql = "SELECT
                    p.PersonajeID AS PersonajeID,
                    p.Nombre AS NombreDelSuperheroe,
                    p.Alias AS AliasDelSuperheroe,
                    p.FechaDeCreacion AS FechaDeCreacionDelSuperheroe,
                    p.Descripcion AS DescripcionDelSuperheroe,
                    GROUP_CONCAT(c.Titulo) AS Comics,
                    GROUP_CONCAT(s.Nombre) AS Superpoderes
                FROM Personajes p
                LEFT JOIN PersonajeComic pc ON p.PersonajeID = pc.PersonajeID
                LEFT JOIN Comics c ON pc.ComicID = c.ComicID
                LEFT JOIN PersonajeSuperpoder ps ON p.PersonajeID = ps.PersonajeID
                LEFT JOIN Superpoderes s ON ps.SuperpoderID = s.SuperpoderID
                GROUP BY p.PersonajeID";

        // Realizar la consulta
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['PersonajeID'] . "</td>";
                echo "<td>" . $row['NombreDelSuperheroe'] . "</td>";
                echo "<td>" . $row['AliasDelSuperheroe'] . "</td>";
                echo "<td>" . $row['FechaDeCreacionDelSuperheroe'] . "</td>";
                echo "<td>" . $row['DescripcionDelSuperheroe'] . "</td>";
                echo "<td>" . $row['Comics'] . "</td>";
                echo "<td>" . $row['Superpoderes'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No se encontraron personajes.</td></tr>";
        }
        // Cerrar la conexión a la base de datos
        $conn->close();
        ?>
    </table>
</body>
</html>
