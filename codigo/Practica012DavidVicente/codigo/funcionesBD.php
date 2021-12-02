<?php

require_once("./segura/conexionBD.php");

function crearBD()
{
    $miConexion = new mysqli();
    $miConexion->connect(IP, USER, PASS);

    if ($miConexion->connect_errno != 0) {
        echo "Error" . $miConexion->connect_error;

        exit;
    } else {
        $crearBD = file_get_contents("./segura/script.sql");

        $miConexion->multi_query($crearBD);

        if ($miConexion->errno != 0)
            echo $miConexion->error;
        else
            echo "Todo ha ido bien";

        $miConexion->close();
    }
}


function compruebaErrores()
{
    $conexion = new mysqli();
    @$conexion->connect(IP, USER, PASS, BBDD);

    //no existe la base de datos, no tienes conexion con el servidor, autenticacion usuario y contraseña, ip incorrecta
    //echo mysqli_connect_errno();

    if ($conexion->connect_errno != 0) {
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
            echo "<input type='submit' value='CrearBD' name='crear'>";
            $conexion->close();
        }
    }
}
