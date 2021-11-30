<?php
    //para conectarse
    //host, usuario, pass, bd*

    require_once("../segura/datosBD.php");

    //Delante de la funcion con una @ no muestra el error, solo lo oculta

    /*
    *TODO ESTO CON FUNCIONES MYSQLI
    *
    */

   /* if(!$conexion=@mysqli_connect(IP, USER, PASS, BBDD))
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

 /*       $sql="select * from alumno";

        //STORE COGE TODOS LOS DATOS DE LA BASE DE DATOS Y USE ACCEDE A LOS DATOS CUANDO HACE EL FETCH PERO ACCEDE SOLO A UN DATO
        $resultado = mysqli_query($conexion, $sql, MYSQLI_STORE_RESULT);
        

        while($fila=mysqli_fetch_field($resultado))
        {
            echo"<pre>";
                print_r($fila);
            echo"</pre>";
        }
        

        mysqli_free_result($resultado);

        mysqli_close($conexion);


    }


     /*
    *TODO ESTO CON OBJETOS MYSQLI
    *
    */
    /*
    echo "<br>";

    //Para que no salte el error en el navegador
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
*/

    //Sentencias Preparadas sin resultados


    /*if(!$conexion=@mysqli_connect(IP, USER, PASS, BBDD))
    {
        echo "Error ";
        echo "Numero:". mysqli_connect_errno();
        echo " Error:". mysqli_connect_error();
        exit;
    }else
    {
        //insert values
        $sql="insert into alumno values(?,?,?)";
        $id=99;
        $nombre= "Santiago";
        $edad=50;

        $consulta=mysqli_prepare($conexion, $sql);

        mysqli_stmt_bind_param($consulta,'isi',$id,$nombre,$edad);
        mysqli_stmt_execute($consulta);

        mysqli_close($conexion);

    }*/


    //sentencias preparadas con resultados

   /* $miConexion= new mysqli();
    @$miConexion->connect(IP, USER, PASS, BBDD);

    if($miConexion->connect_errno!=0)
    {
        echo "Error". $miConexion->connect_error;
        exit;
    }else
    {
        //inicializar el objeto stmt
        $preparado=$miConexion->stmt_init();
        $sql="select * from alumno where id > ?";
        
        $preparado->prepare($sql);
        $id=3;
        $preparado->bind_param('i',$id);

        $preparado->execute();

        $preparado->bind_result($rid, $rnombre, $redad);

        while($preparado->fetch())
        {
            echo $rid.", ".$rnombre.", ".$redad;
            echo"<br>";
        }


        $preparado->free_result();
        $miConexion->close();
    }*/


    //VOY A BORRAR UNA FILA Y LUEGO NO GUARDAR LOS CAMBIOS
    /*$miConexion= new mysqli();
    @$miConexion->connect(IP, USER, PASS, BBDD);

    if($miConexion->connect_errno!=0)
    {
        echo "Error". $miConexion->connect_error;
        exit;
    }else
    {
        //inicializar el objeto stmt
        $miConexion->autocommit(false);
        $sql="delete from alumno where id =?";
        $id=99;
        
        $stmt=$miConexion->stmt_init();
        
        $stmt->prepare($sql);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        //$miConexion->rollback();
        $miConexion->commit();
        echo "Todo ha ido bien";
        $stmt->free_result();
        $miConexion->close();
    }*/



    $miConexion= new mysqli();
    @$miConexion->connect(IP, USER, PASS);

    if($miConexion->connect_errno!=0)
    {
        echo "Error". $miConexion->connect_error;
        exit;
    }else
    {
        $comandosSQL = file_get_contents("../segura/Script.sql");

        $miConexion->multi_query($comandosSQL);
        if($miConexion->errno!=0)
        {
            echo $miConexion->error;
        }else
        {
            echo"Todo ha ido bien";

        }

        $miConexion->close();
    }



?>