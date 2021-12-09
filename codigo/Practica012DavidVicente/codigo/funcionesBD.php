<?php


require_once("./segura/conexionBD.php");
function crearBD()
{
    $conexion = new mysqli();
    $conexion->connect(IP, USER, PASS);

    if ($conexion->connect_errno != 0) 
    {
        if ($conexion->connect_errno == 2002) 
        {
            echo "Error. IP incorrecta. No tienes conexión con el servidor";
        }
        if ($conexion->connect_errno == 1045) 
        {
            echo "Error de autenticación. Usuario o contraseña";
        }
        if ($conexion->connect_errno == 1049) 
        {
            echo "No existe la base de datos. Debe crear la Base de Datos ";
            
        }
        exit;
    } 
    else 
    {
        $crearBD = file_get_contents("./segura/script.sql");
        $conexion->multi_query($crearBD);

        if ($conexion->errno != 0)
            if ($conexion->connect_errno == 2002) 
            {
                echo "Error. IP incorrecta. No tienes conexión con el servidor";
            }
            if ($conexion->connect_errno == 1045) 
            {
                echo "Error de autenticación. Usuario o contraseña";
            }
            if ($conexion->connect_errno == 1049) 
            {
                echo "No existe la base de datos. Debe crear la Base de Datos ";
                
            }
        else
        {
            echo "<p>Todo ha ido bien</p>";
        }


        $conexion->close();
    }
}


function compruebaErrores()
{
    $conexion = new mysqli();
    @$conexion->connect(IP, USER, PASS, BBDD);

    if ($conexion->connect_errno != 0) 
    {
        if ($conexion->connect_errno == 2002) 
        {
            echo "Error. IP incorrecta. No tienes conexión con el servidor";
        }
        if ($conexion->connect_errno == 1045) 
        {
            echo "Error de autenticación. Usuario o contraseña";
        }
        if ($conexion->connect_errno == 1049) 
        {
            echo "<p>No existe la base de datos. Debe crear la Base de Datos</p>";
            echo "<input type='submit' value='CrearBD' name='crear'>";
        }
    }
}


function lectura()
{
    $conexion = new mysqli();
    $conexion->connect(IP, USER, PASS, BBDD);

    if ($conexion->connect_errno != 0) 
    {
        if ($conexion->connect_errno == 1049) 
        {
            echo "No existe la base de datos. Debe crear la Base de Datos ";
        }

        if($conexion->connect_errno==1146)
        {
            echo"Error. La tabla no existe";
        }
        
        exit;
    }
    else
    {
        $sql="select * from DATOSCLUB;";
        $resultado = $conexion->query($sql);
        echo "<table>";
        echo"<thead>";
        echo"<tr>";
        echo"<th COLSPAN=6>Datos Equipos</th>";
        echo"</tr>";
        echo "<tr >";
        echo "<th style='text-align: center;'>Puntos</th>";
        echo "<th style='text-align: center;'>Equipo</th>";
        echo "<th style='text-align: center;'>Media Goles</th>";
        echo "<th style='text-align: center;'>Año de creación</th>";
        echo"<th style='text-align: center;' COLSPAN=2>Editar</th>";
        echo"</tr>";
        echo"</thead>";
        echo"<tbody >";
            while($row = $resultado->fetch_array())
            {
                echo "<tr >";
                echo"<td>".$row['PUNTOS']."</td>";
                echo"<td>".$row['NOMBRE']."</td>";
                echo"<td>".$row['MEDIA_GOLES']."</td>";
                echo"<td>".$row['FECHA']."</td>";
                echo"<td><a href='./codigo/borrado.php?id=".$row['ID']."'><img src='./web-root/img/papelera-de-reciclaje.png' height='20px'/></a></td>";
                echo"<td><a href='./codigo/modificar.php?id=".$row['ID']."'><img src='./web-root/img/editar-texto.png' height='20px'/></a></td>";
                echo "</tr>";
            }
        echo"</tbody>";
        echo"</table>";
        
        mysqli_free_result($resultado);
        mysqli_close($conexion);
    }    
}





function filtrado($cadena)
{
    $conexion = new mysqli();
    $conexion->connect(IP, USER, PASS, BBDD);

    if ($conexion->connect_errno != 0) 
    {
        if ($conexion->connect_errno == 1049) 
        {
            echo "No existe la base de datos. Debe crear la Base de Datos ";
        }

        if($conexion->connect_errno==1146)
        {
            echo"Error. La tabla no existe";
        }
        
        exit;
    }
    else
    {

        $preparado=$conexion->stmt_init();
        //$​sql​ = ​"select * from PRODUCTOS where NOMBRE LIKE '"​. ​$​nombreBuscar​ . ​"%';"​ ; 
        $sql="select * from DATOSCLUB where NOMBRE LIKE ?";

        $cadena = "%".$cadena."%";
        //BUSCADOR // select * from clientes where nombre like '%me%';
        // "You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '?'%'' at line 1"
        $preparado->prepare($sql);
        $preparado->bind_param('s',$cadena);

        $preparado->execute();

        $prueba = $preparado->bind_result($rid, $rpuntos, $rnombre, $mediaGoles, $fecha);
        
        echo "<table>";
        echo"<thead>";
        echo"<tr>";
        echo"<th COLSPAN=6>Datos Equipos</th>";
        echo"</tr>";
        echo "<tr>";
        echo "<th>Puntos</th>";
        echo "<th>Equipo</th>";
        echo"<th>Media Goles</th>";
        echo "<th>Año de creación</th>";
        echo"<th COLSPAN=2>Editar</th>";
        echo"</tr>";
        echo"</thead>";
        echo"<tbody>";
        while($preparado->fetch())
            {
                echo "<tr>";
                
                echo"<td>".$rpuntos."</td>";
                echo"<td>".$rnombre."</td>";
                echo"<td>".$mediaGoles."</td>";
                echo"<td>".$fecha."</td>";
                echo"<td><a href='./codigo/borrado.php?id=".$rid."'><img src='./web-root/img/papelera-de-reciclaje.png' height='20px'/></a></td>";
                echo"<td><a href='./codigo/modificar.php?id=".$rid."'><img src='./web-root/img/editar-texto.png' height='20px'/></a></td>";
                echo "</tr>";
            }
        echo"</tbody>";
        echo"</table>";
        
        $preparado->free_result();

        mysqli_close($conexion);
    }    
}

?>