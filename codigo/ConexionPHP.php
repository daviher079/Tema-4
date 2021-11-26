<?php
    //para conectarse
    //host, usuario, pass, bd*

    require_once("../segura/datosBD.php");

    //Delante de la funcion con una @ no muestra el error, solo lo oculta

    /*
    *TODO ESTO CON FUNCIONES MYSQLI
    *
    */

    if(!$conexion=@mysqli_connect(IP, USER, PASS, BBDD))
    {
        echo "Error ";
        echo "Numero:". mysqli_connect_errno();
        echo " Error:". mysqli_connect_error();
        exit;
    }else
    {

        echo "Todo ha ido bien";
        //ejecutar consultas
       /* $sql="insert into alumno values(5, 'Juan Luis Guerra', 90),(6, 'Miguel', 90)";

        $resultado=mysqli_query($conexion, $sql);

        if($resultado)
        {
            echo "<br>Num:".mysqli_affected_rows($conexion);
        }else
        {
            echo"<br>No se ha insertado nada";
        }*/

        //Ejecutar un select

        $sql="select * from alumno";

        $resultado = mysqli_query($conexion, $sql, MYSQLI_USE_RESULT);
        

        



        mysqli_close($conexion);


    }


     /*
    *TODO ESTO CON OBJETOS MYSQLI
    *
    */
    echo "<br>";

    $miConexion= new mysqli();
    @$miConexion->connect(IP, USER, PASS, BBDD);

    if($miConexion->connect_errno!=0)
    {
        echo "Error". $miConexion->connect_error;
        exit;
    }else
    {
        echo"Todo ha ido bien";




        $miConexion->close();
    }





?>