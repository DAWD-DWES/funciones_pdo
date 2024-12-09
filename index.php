<?php
$host = "localhost";
$db = "proyecto";
$user = "gestor";
$pass = "secreto";
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
try {
    $bd = new PDO($dsn, $user, $pass);
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    error_log("Error de conexión: " . $ex->getMessage()); // Registrar el error
    echo "No se pudo establecer la conexión a la base de datos. Inténtelo más tarde."; // Mensaje genérico
    exit;
}
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
                <td><?php
                    $sql = "insert into familias (cod, nombre) values ('PERI', 'Periféricos');";
                    try {
                        $resultado = $bd->exec($sql);
                        var_dump($resultado);
                    } catch (PDOException $ex) {
                        echo $ex->getMessage();
                    }
                    ?>
                </td>
            </tr>
            <tr><td colspan="2"><p>Cambia el precio del producto con id igual a 6 a 387 euros</p></td></tr>
            <tr>
                <td>$sql = "update productos set pvp = 456 where id = 6;"</td>
                <td><?php
                    $sql = "update productos set pvp = 456 where id = 6;";
                    try {
                        $resultado = $bd->exec($sql);
                        var_dump($resultado);
                    } catch (PDOException $ex) {
                        echo $ex->getMessage();
                    }
                    ?>
                </td>
            </tr>
            <tr><td colspan="2"><p>Borra los productos de la tabla productos que tengan un precio menor de 100 euros</p></td></tr>
            <tr>
                <td>$sql = "delete from productos where pvp < 150;"</td>
                <td><?php
                    $sql = "delete from productos where pvp < 150;";
                    try {
                        $resultado = $bd->exec($sql);
                        var_dump($resultado);
                    } catch (PDOException $ex) {
                        echo $ex->getMessage();
                    }
                    ?>
                </td>
            </tr>
            <tr><td colspan = "2"><p>Muestra el número de tiendas almacenadas en la tabla tiendas </p></td></tr>
            <tr>
                <td>$sql = "select count(*) from tiendas;";
                </td>
                <td><?php
                    $sql = "select count(*) from tiendas;";
                    try {
                        $stmt = $bd->query($sql);
                        $numTiendas = $stmt->fetchColumn();
                        var_dump($numTiendas);
                    } catch (PDOException $ex) {
                        echo $ex->getMessage();
                    }
                    ?></td>
            </tr>
            <tr><td colspan = "2"><p>Inserta una tienda en la tabla de tiendas con una sentencia preparada. Víncula los datos con bind_param</p></td></tr>
            <tr>
                <td>$sql = "insert into tiendas (nombre, tlf) values (:nombre, :tlf);"
                </td>
                <td><?php
                    $sql = "insert into tiendas (nombre, tlf) values (:nombre, :tlf);";
                    try {
                        $stmt = $bd->prepare($sql);
                        $nombre = "SUCURSAL13";
                        $tlf = '613767676';
                        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                        $stmt->bindParam(':tlf', $tlf, PDO::PARAM_STR);
                        $resultado = $stmt->execute();
                        var_dump($resultado);
                        $nombre = "SUCURSAL14";
                        $tlf = '614565656';
                        $resultado = $stmt->execute();
                        var_dump($resultado);
                    } catch (PDOException $ex) {
                        echo $ex->getMessage();
                    }
                    ?>
                </td>
            </tr>
            <tr><td colspan = "2"><p>Inserta una tienda en la tabla de tiendas con una sentencia preparada. Víncula los datos con bind_value</p></td></tr>
            <tr>
                <td>$sql = "insert into tiendas (nombre, tlf) values (:nombre, :tlf);"
                </td>
                <td><?php
                    $sql = "insert into tiendas (nombre, tlf) values (:nombre, :tlf);";
                    try {
                        $stmt = $bd->prepare($sql);
                        $nombre = "SUCURSAL23";
                        $tlf = '623161616';
                        $stmt->bindValue(':nombre', $nombre, PDO::PARAM_STR);
                        $stmt->bindValue(':tlf', $tlf, PDO::PARAM_STR);
                        $resultado = $stmt->execute();
                        var_dump($resultado);
                        $nombre = "SUCURSAL24";
                        $tlf = '624929292';
                        $resultado = $stmt->execute();
                        var_dump($resultado);
                    } catch (PDOException $ex) {
                        echo $ex->getMessage();
                    } finally {
                        $stmt = null;
                    }
                    ?>
                </td>
            </tr>
            <tr><td colspan = "2"><p>Inserta una tienda en la tabla de tiendas con una sentencia preparada. Vincula los datos en el método execute.
                        Muestra el id de la última tienda insertada</p></td></tr>
            <tr>
                <td>$sql1 = "insert into tiendas (nombre, tlf) values (:nombre, :tlf);"
                    $sql2 = "insert into tiendas (nombre, tlf) values (?, ?);"
                </td>
                <td><?php
                    $sql1 = "insert into tiendas (nombre, tlf) values (:nombre, :tlf);";
                    try {
                        $stmt1 = $bd->prepare($sql);
                        $resultado1 = $stmt1->execute([':nombre' => "SUCURSAL3", ':tlf' => '600232323']);
                        var_dump($resultado1);
                        var_dump($bd->lastInsertId());
                        $resultado2 = $stmt1->execute([':nombre' => "SUCURSAL4", ':tlf' => '607878787']);
                        var_dump($resultado2);
                        var_dump($bd->lastInsertId());
                    } catch (PDOException $ex) {
                        echo $ex->getMessage();
                    } finally {
                        $stmt1 = null;
                    }
                    $sql2 = "insert into tiendas (nombre, tlf) values (?, ?);";
                    try {
                        $stmt2 = $bd->prepare($sql);
                        $resultado3 = $stmt2->execute(["SUCURSAL5", '605676767']);
                        var_dump($resultado3);
                        var_dump($bd->lastInsertId());
                        $resultado4 = $stmt2->execute(["SUCURSAL6", '606616161']);
                        var_dump($resultado4);
                        var_dump($bd->lastInsertId());
                    } catch (PDOException $ex) {
                        echo $ex->getMessage();
                    } finally {
                        $stmt2 = null;
                    }
                    ?>
                </td>
            </tr>
            <tr><td colspan = "2"><p>Muestra los datos de los productos de la tabla de productos que correspondan a una familia dada. 
                        Utiliza el método fetch para acceder a cada uno de los productos. 
                        Prueba a ejecutar los fetch con los flags: PDO::FETCH_NUM, PDO::FETCH_ASSOC y PDO::FETCH_OBJ. 
                        Por último utiliza un iterador para recorrer el conjunto de resultados.</p></td></tr>
            <tr>
                <td>$sql = select id, nombre, nombre_corto, pvp, familia from productos where familia = :familia;</td>
                <td><?php
                    $sql = "select id, nombre, nombre_corto, pvp, familia from productos where familia = :familia;";
                    try {
                        $stmt = $bd->prepare($sql);
                        $stmt->execute([':familia' => 'TV']);
                        echo 'Valor PDO::FETCH_BOTH (Defecto)';
                        while ($producto = $stmt->fetch()) {
                            echo '<pre>';
                            print_r($producto);
                            echo '</pre>';
                        }
                        $stmt->execute([':familia' => 'CONSOL']);
                        echo 'Valor PDO::FETCH_ASSOC';
                        while ($producto = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<pre>';
                            print_r($producto);
                            echo '</pre>';
                        }
                        $stmt->execute([':familia' => 'VIDEOC']);
                        echo 'Valor PDO::FETCH_NUM';
                        while ($producto = $stmt->fetch(PDO::FETCH_NUM)) {
                            echo '<pre>';
                            print_r($producto);
                            echo '</pre>';
                        }
                        echo 'Valor PDO::FETCH_OBJ';
                        $stmt->execute([':familia' => 'MP3']);
                        while ($producto = $stmt->fetch(PDO::FETCH_OBJ)) {
                            echo '<pre>';
                            print_r($producto);
                            echo '</pre>';
                        }
                        echo 'Uso de un iterador';
                        $stmt->execute([':familia' => 'PORTAT']);
                        $iterator = $stmt->getIterator();
                        foreach ($iterator as $producto) {
                            echo '<pre>';
                            print_r($producto);
                            echo '</pre>';
                        }
                    } catch (PDOException $ex) {
                        echo $ex->getMessage();
                    } finally {
                        $stmt = null;
                    }
                    ?></td>
            </tr>
            <tr><td colspan = "2"><p>Muestra los datos de los productos de la tabla de productos que cuesten más de 300 euros. 
                        Utiliza el método fetchAll para obtener todos los productos a la vez.
                        Muestra el número de productos que cumplen el criterio de búsqueda</p></td></tr>
            <tr>
                <td>$sql = select id, nombre, nombre_corto, pvp, familia from productos where pvp > :pvp;
                </td>
                <td><?php
                    $sql = "select id, nombre, nombre_corto, pvp, familia from productos where pvp > :pvp;";
                    try {
                        $stmt = $bd->prepare($sql);
                        $stmt->execute(['pvp' => 300]);
                        $productos = $stmt->fetchAll();
                        echo '<pre>';
                        print_r($productos);
                        echo '</pre>';
                        var_dump($stmt->rowCount());
                    } catch (PDOException $ex) {
                        echo $ex->getMessage();
                    } finally {
                        $stmt = null;
                    }
                    ?>
                </td>
            </tr>
        </table>
    </body>
</html>
<?php
$bd = null;
?>
