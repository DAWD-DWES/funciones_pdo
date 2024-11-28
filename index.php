<?php
$host = "localhost";
$db = "proyecto";
$user = "gestor";
$pass = "secreto";
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
try {
    $bd = new PDO($dsn, $user, $pass);
} catch (PDOException $ex) {
    echo $ex->getMessage();
}
$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Programación con librería PDO</title>
        <meta name="viewport" content="width=device-width">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="stylesheet.css">
    </head>
    <body>
        <h2>Programación con librería PDO</h2>
        <table>
            <tr><td colspan="2"><p>Inserta una nueva familia en la tabla familias</p></td></tr>
            <tr>
                <td>$sql = "insert into familias (cod, nombre) values ('PERI', 'Periféricos');"</td>
                <td><!-- Escribe tu código aquí --></td>
            </tr>
            <tr><td colspan="2"><p>Cambia el precio del producto con id igual a 6 a 387 euros</p></td></tr>
            <tr>
                <td>$sql = "update productos set pvp = 387 where id = 6;"</td>
                <td><!-- Escribe tu código aquí --></td>
            </tr>
            <tr><td colspan="2"><p>Borra los productos de la tabla productos que tengan un precio menor de 100 euros</p></td></tr>
            <tr>
                <td>$sql = "delete from productos where pvp < 100;"</td>
                <td><!-- Escribe tu código aquí --></td>
            </tr>
            <tr><td colspan = "2"><p>Muestra el número de tiendas almacenadas en la tabla tiendas </p></td></tr>
            <tr>
                <td>$sql = "select count(*) from tiendas;";
                </td>
                <td><!-- Escribe tu código aquí --></td>
            </tr>
            <tr><td colspan = "2"><p>Inserta una tienda en la tabla de tiendas con una sentencia preparada. Vincula los datos en el método execute.
                        Muestra el id de la última tienda insertada</p></td></tr>
            <tr>
                <td>$sql = "insert into tiendas (nombre, tlf) values (:nombre, :tlf);"
                </td>
                <td><!-- Escribe tu código aquí --></td>
            </tr>
            <tr><td colspan = "2"><p>Inserta una tienda en la tabla de tiendas con una sentencia preparada. Víncula los datos con bind_param</p></td></tr>
            <tr>
                <td>$sql = "insert into tiendas (nombre, tlf) values (:nombre, :tlf);"
                </td>
                <td><!-- Escribe tu código aquí --></td>
            </tr>
            <tr><td colspan = "2"><p>Inserta una tienda en la tabla de tiendas con una sentencia preparada. Víncula los datos con bind_value</p></td></tr>
            <tr>
                <td>$sql = "insert into tiendas (nombre, tlf) values (:nombre, :tlf);"
                </td>
                <td><!-- Escribe tu código aquí --></td>
            </tr>
            <tr><td colspan = "2"><p>Muestra los datos de los productos de la tabla de productos que correspondan a una familia dada. 
                        Utiliza el método fetch para acceder a cada uno de los productos. 
                        Prueba a ejecutar los fetch con los flags: PDO::FETCH_NUM, PDO::FETCH_ASSOC y PDO::FETCH_OBJ. 
                        Por último utiliza un iterador para recorrer el conjunto de resultados.</p></td></tr>
            <tr>
                <td>$sql = select id, nombre, nombre_corto, pvp, familia from productos where familia = :familia;</td>
                <td><!-- Escribe tu código aquí --></td>
            </tr>
            <tr><td colspan = "2"><p>Muestra los datos de los productos de la tabla de productos que cuesten más de un precio dado. 
                        Utiliza el método fetchAll para obtener todos los productos a la vez.
                        Muestra el número de productos que cumplen el criterio de búsqueda</p></td></tr>
            <tr>
                <td>$sql = select id, nombre, nombre_corto, pvp, familia from productos where pvp > :pvp;
                </td>
                <td><!-- Escribe tu código aquí --></td>
            </tr>
        </table>
    </body>
</html>
