<?php
    
    //Definicion de las constantes que contienen los patrones que comprueban si la cadena es correcta
    
    define("PATRONNOMBRE", '/^[A-Z]{1}[a-z]{2}/');
    define("PATRONFECHA", '/[0-9]{2}(-|\/)[0-9]{2}(-|\/)[0-9]{4}/');

    function validarFormulario(){
        $bandera=true;
        if(isset($_REQUEST['enviado']))
        {
            
            if(validarPuntos()==true && validarNombre()==true && validarMedia()==true&& validarFecha()==true)
            {
                require_once("segura/conexionBD.php");
                $puntos = intval($_REQUEST['puntos']);
                $nombre = strtoupper($_REQUEST['nombre']);
                $mediaGoles = floatval($_REQUEST['mediaGoles']);
                $fecha = "";

                if($_REQUEST['fecha'][2]=='/')
                {
                    $fecha = str_replace("/", "-", $_REQUEST['fecha']);
                }else
                {
                    $fecha=$_REQUEST['fecha'];        
                }
                
                $dat = date('Y-m-d', strtotime($fecha));

                $conexion= new mysqli();
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
                    
                    $conexion->autocommit(false);
                    
                    $sql="insert into DATOSCLUB values(ID,?,?,?,?)";
                    
                    $stmt=$conexion->stmt_init();
                    
                    $stmt->prepare($sql);
                    $stmt->bind_param('isds', $puntos, $nombre, $mediaGoles, $dat);

                    $stmt->execute();
                    $conexion->commit();
                    $stmt->free_result();
                    $conexion->close();

                }
            }   
            else{
                
                $bandera = false;
            }     
        } else
        {
            $bandera= false;
        }
        
        return $bandera;
    }

    /*
        Comprueba que el campo no este vacio y se haya enviado algo en el formulario
        Se añade la funcion dentro del campo value en el apartado de html
    */

    function recordarGenerico($var){
        if(!empty($_REQUEST[$var])&& isset($_REQUEST['enviado']))
        {
            echo $_REQUEST[$var];        
        }
    }

    /*
        Se ejecuta cuando el input esta vacio para avisar al usuario que ese campo debe rellenarlo 
    */
    
    function comprobarGenerico($var){
        if(empty($_REQUEST[$var]) && isset($_REQUEST['enviado'])){
            
            echo "<label>Debe haber un campo ".$var."</label>";
        }           
    }

    /*
        A esta funcion se le pasa un patrón y la cadena que tiene que validar se ejecuta dos veces
        en el codigo una cada vez que se valida un campo y otra en cada input para informar al usuario 
        de las caracteristicas que debe cumplir ese campo 
    */

    function expresionGenerico($patron, $var){
        
        $bandera=true;

        if(!empty($var) && isset($_REQUEST['enviado']) && preg_match($patron, $var)==false)
        {
            $bandera=false;
        }

        return $bandera;
    }

    /*
        Comprueba si el formulario ha sido enviado, si el input nombre ha sido envidado y si cumple 
        las caracteristicas de la expresion regular 
    */

    function validarPuntos()
    {
        $bandera=true;
        if(!empty($_REQUEST['puntos']) && isset($_REQUEST['enviado']))
        {
            $bandera=true;    
        }
        else
        {
            $bandera=false;
        }
        return $bandera;
    }
    
    function validarNombre()
    {
        
        $bandera=true;
        if(!empty($_REQUEST['nombre']) && isset($_REQUEST['enviado']) && expresionGenerico(PATRONNOMBRE, $_REQUEST['nombre'])==true)
        {
            $bandera=true;    
        }
        else
        {
            $bandera=false;
        }
        return $bandera;
    }

    function validarMedia()
    {
        $bandera=true;
        if(!empty($_REQUEST['mediaGoles']) && isset($_REQUEST['enviado']))
        {
            $bandera=true;    
        }
        else
        {
            $bandera=false;
        }
        return $bandera;
    }

    /*
        Comprueba si el formulario ha sido enviado, si el input fecha ha sido envidado y si cumple 
        las caracteristicas de la expresion regular 
    */

    function validarFecha()
    {
        $bandera=true;
        
        if(!empty($_REQUEST['fecha']) && isset($_REQUEST['enviado']) && expresionGenerico(PATRONFECHA, $_REQUEST['fecha'])==true)
        {
            $bandera=true;    
        }
        else
        {
            $bandera=false;
        }
        return $bandera;
    }

?>
