<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../web-root/css/resetCSS.css"/>
    <link rel="stylesheet" href="../web-root/css/style.css"/>
    <title>Modificar Registro</title>
</head>
<body>
    <header>
        <img class="logo" src="../web-root/img/LogotipoDavidVicente.png"/>
        <h1>Modificar Registro</h1>
    </header>
    <main>
    
        <div class="content">
            <div class="title">
                <h1>DWES</h1>

                <form action="modificar.php" method="post">
                
                    <?php
                        require_once("../segura/conexionBD.php");
                        
                        if(isset($_REQUEST['id']))
                            $id=intval($_REQUEST['id']);

                        $conexion= new mysqli();
                        @$conexion->connect(IP, USER, PASS, BBDD);
                    
                        if($conexion->connect_errno!=0)
                        {
                            echo "Error". $conexion->connect_error;
                            exit;
                        }else
                        {
                            //inicializar el objeto stmt
                            $preparado=$conexion->stmt_init();
                            $sql="select * from DATOSCLUB where id = ?";
                            
                            $preparado->prepare($sql);
                            
                            $preparado->bind_param('i',$id);
                    
                            $preparado->execute();
                    
                            $preparado->bind_result($rid, $rpuntos, $rnombre, $rmedia, $rfecha);
                            //$row = $preparado->fetch_array(MYSQLI_NUM);    
                            while($preparado->fetch())
                            {
                                echo "<input type='hidden' name='prueba' value='".$rid."'>";
                                echo "<input type='number' id='puntos' name='puntos' value='".$rpuntos."'>";
                                echo "<input type='number' id='mediaGoles' name='mediaGoles' value='".$rmedia."' step='0.25'>";
                                echo "<input type='text' id='nombre' name='nombre' value='".$rnombre."'>";
                                echo "<input type='date' id='fecha' name='fecha' value='".$rfecha."'>";
                                
                            }
                    
                    
                            $preparado->free_result();
                            $conexion->close();
                        }
                    ?>

                    <section id="botones" style="margin-top:35px;">
                        <input type="submit" name="boton" value="Modificar">
                        
                    </section>
                </form>    


                <?php
                    if(sizeof($_REQUEST)>0 && isset($_REQUEST['boton']))
                    {
                        if($_REQUEST['boton']=='Modificar')
                        {
                            

                            $conexion = new mysqli();
                            @$conexion->connect(IP, USER, PASS, BBDD);
                        
                            if($conexion->connect_errno!=0)
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

                                if($conexion->connect_errno==1146)
                                {
                                    echo"Error. La tabla no existe";
                                }    
                                exit;
                            }else
                            {
                                   

                                $puntos=$_REQUEST['puntos'];
                                $nombre=$_REQUEST['nombre'];
                                $mediaGoles=$_REQUEST['mediaGoles'];
                                $fecha=$_REQUEST['fecha'];
                                $id=$_REQUEST['prueba'];

                                $conexion->autocommit(false);
                                $sql="update DATOSCLUB 
                                set PUNTOS = ?, 
                                NOMBRE = ?, 
                                MEDIA_GOLES = ?, 
                                FECHA = ? 
                                WHERE ID = ?";
                                
                                $stmt=$conexion->stmt_init();
                                
                                $stmt->prepare($sql);
                                $stmt->bind_param('isdsi',
                                $puntos,
                                $nombre,
                                $mediaGoles,
                                $fecha,
                                $id);

                                $stmt->execute();
                                $conexion->commit();
                                $stmt->free_result();
                                $conexion->close();

                                header('Location: ../lecturaTabla.php');
                            }
                        }
                    }    
                ?>   
        
                            








            
            </div>
        </div>  
        
    </main>

   
    <footer>
        <p>Footer de David</p>
        <a href="verCodigo.php?ficheroPHP=<?php
            $pagina=basename($_SERVER['SCRIPT_FILENAME']);
            echo $pagina;
        ?>"><img src="../web-root/img/gafas-de-sol.png" height="100px"></a>
        <a href="../lecturaTabla.php"><img src="../web-root/img/volver.png" height="20px"></a>
    </footer>
</body>
</html>