<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" href="../../web-root/css/resetCSS.css"/>
    <link rel="stylesheet" href="../../web-root/css/style.css"/>
    <link rel="stylesheet" href="../../web-root/css/styleTarea8.css"/>-->
    <title>CRUD</title>
</head>
<body>
    <header>
        <!--<img class="logo" src="../../../web-rootIndexPrincipal/img/LogotipoDavidVicente.png"/>-->
        <h1>CRUD</h1>
    </header>
    <main>
        
        <div class="content">
            <div class="title">
                <h1>DWES</h1>
                <form action="index.php" method="post" name="formulario" enctype="multipart/form-data">
                    <?php
                        require_once("./segura/conexionBD.php");

                        if(!$conexion=@mysqli_connect(IP, USER, PASS, BBDD))
                        {
                            echo"<input type='submit' value='CrearBaseDeDatos' name='crear'>";
                        }
                    ?>    
                    
                    <input type="button" value="LeerTabla" name="lectura">
                    <input type="button" value="InsertarRegistro" name="insertar">
                </form>

                <?php
                //sizeof es igual que la funcion count
                    if(sizeof($_REQUEST)>0)
                    {
                        if($_REQUEST['CrearBaseDeDatos']=='crear')

                            header('Location: EditaFichero.php?fi='.$_REQUEST['nombreFichero']);

                        if($_REQUEST['LeerTabla']=='lectura')
                            header('Location: LeeFichero.php?fi='.$_REQUEST['nombreFichero']);    

                        if($_REQUEST['LeerTabla']=='lectura')
                            header('Location: LeeFichero.php?fi='.$_REQUEST['nombreFichero']);    
    
                    }
                ?>
            </div>
        </div>  
        
        
<!--PATRON SINGELTON-->
        
           
        

    </main>
    <!--<footer>
        <p>Footer de David</p>
        <a href="codigoTarea011.php?ficheroPHP=<?php
            $pagina=basename($_SERVER['SCRIPT_FILENAME']);
            echo $pagina;
        ?>"><img src="../../../web-rootIndexPrincipal/img/gafas-de-sol.png" height="100px"></a>
    </footer>-->
</body>
</html>