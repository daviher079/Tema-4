<?
require_once("./segura/datosBD.php");
    $dsn="mysql:host=".IP.";dbname=".BBDD;

    try
    {
        $con=new PDO($dsn, USER, PASS);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Todo okey Jose Luis";

        //$sql="insert into alumno values(350,'Federico',65);";
        $sql="select * from alumno";
        $resultado=$con->query($sql);

        while($row=$resultado->fetch())
        {
            print_r($row);
        }




        
    }catch(PDOException $ex)
    {
        //getMessage
        echo "error ".$ex->getMessage();
    }
    finally
    {
        // Cierro la conexion
        unset($conexion);
    }
?>