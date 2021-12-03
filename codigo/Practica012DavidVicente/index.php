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
                <?php
                    require_once("./codigo/funcionesBD.php");
                    
                    if(sizeof($_REQUEST)>0)
                    {
                        if($_REQUEST['crear']=='CrearBD')
                        {
                            crearBD();
                        }

                        if($_REQUEST['lectura']=='LeerTabla')
                        {
                            header('Location: ./lecturaTabla.php');
                        }
                        
                    }
                ?>
                <form action="./index.php" method="post" name="formulario">
                    
                    <?php
                       compruebaErrores();  
                    ?>    
                    
                    <input type="submit" value="LeerTabla" name="lectura">
                    <input type="submit" value="InsertarRegistro" name="insertar">
                </form>

            </div>
        </div>  
        
        

        
           
        

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