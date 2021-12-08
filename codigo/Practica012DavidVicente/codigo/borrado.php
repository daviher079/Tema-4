<?php
    require_once("../segura/conexionBD.php");

    
    $id=intval($_REQUEST['id']);
    
    borrarRegistro($id);
    header("location:../lecturaTabla.php");

    function borrarRegistro($id)
    {
        $conexion = new mysqli();
        @$conexion->connect(IP, USER, PASS, BBDD);
    
        if($conexion->connect_errno!=0)
        {
            echo "Error". $conexion->connect_error;
            exit;
        }else
        {
            //inicializar el objeto stmt
            $conexion->autocommit(false);
            $sql="delete from DATOSCLUB where id =?";
            
            $stmt=$conexion->stmt_init();
            
            $stmt->prepare($sql);
            $stmt->bind_param('i',$id);
            $stmt->execute();
            $conexion->commit();
            $stmt->free_result();
            $conexion->close();
        }
    
    }
?>