<?
require_once("./segura/datosBD.php");
    $dsn="mysql:host=".IP.";dbname=".BBDD;

    try
    {
        $con=new PDO($dsn, USER, PASS);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Todo okey Jose Luis";

        //$sql="insert into alumno values(350,'Federico',65);";
        /*$sql="select * from alumno";
        $resultado=$con->query($sql);

        while($row=$resultado->fetch(PDO::FETCH_ASSOC))
        {
            print_r($row);
            echo"<br>";
        }*/


        //PREPARED STATEMENT

        //FORMA 1

        /*$preparada=$con->prepare("insert into alumno values (?,?,?)");
        //crer el array antes o crearlo en el execute
        $arrayParametros=array(123, 'Santiago', 35);
        $preparada->execute($arrayParametros);*/

        //FORMA 2

        /*$preparada=$con->prepare("insert into alumno values (?,?,?)");
        
        $a=124;
        $b='Pedro';
        $c=45;
        $preparada->bindParam(1, $a);
        $preparada->bindParam(2, $b);
        $preparada->bindParam(3, $c);
        $preparada->execute();*/

        //FORMA3 Con nombres en la consulta

        /*$preparada=$con->prepare("select * from alumno where nombre like :nombre");

        $nombrelike="%ia%";

        $preparada->bindParam(":nombre", $nombrelike);

        $preparada->execute();

        $preparada->bindColumn(1,$id);
        $preparada->bindColumn(2,$nombre);
        $preparada->bindColumn(3,$edad);
        echo $preparada->rowCount();

        while($preparada->fetch())
        {
            echo "<br>".$id.":".$nombre.":".$edad;
        }*/



        //TRANSACCIONES

        $preparada=$con->prepare("insert into alumno values (?,?,?)");
        //crer el array antes o crearlo en el execute

        $con->beginTransaction();

        $arrayParametros=array(
            array(120, 'Manuel', 15),
            array(121, 'Miguel', 40),
            array(122, 'Jose', 12),
            array(123, 'Pepe', 22)
        );

        foreach ($arrayParametros as $value) {
            
            $preparada->execute($value);
        }

        $con->commit();


        
    }catch(PDOException $ex)
    {
        //getMessage

        $con->rollBack();
        echo "error ".$ex->getMessage();
        echo "Nº ".$ex->getCode();
    }
    finally
    {
        // Cierro la conexion
        unset($conexion);
    }
?>