

<?php
    $html =ob_get_clean();
    require "config.php";
    require "phpqrcode/qrlib.php"; 
    require __DIR__."/vendor/autoload.php";
    
    use Dompdf\Dompdf;
    use Dompdf\Options;

if ($_POST) {
    
    $txtnombre = (isset($_POST['txtnombre'])) ? $_POST['txtnombre'] : "";
    $txtcarrera = (isset($_POST['txtcarrera'])) ? $_POST['txtcarrera'] : "";

    $sql= "INSERT INTO t_estudiantes (Nombre,Carrera) VALUES  ('$txtnombre','$txtcarrera')";
    
    $con= new Conexion();
    $con->ejecutar($sql);
    $con = null;

     //genera qr
     $dir='temp/';

     if (!file_exists($dir)) 
         mkdir(($dir));
     
     $filename = $dir.'test.png';

     $tamanio=7;
     $level='M';
     $fromsize=3;
     $contenido= 'Aceptado Gracias por Venir:|'.$txtnombre.'|'.$txtcarrera;

     QRcode::png($contenido,$filename,$level,$tamanio);
      
     
     //guarda en la base de datos
        

         //Mostramos la imagen generada

        $html .= '<img src="'.$dir.basename($filename).'"/>'; 

        
        $opcion= new Options();
        $opcion->setChroot(__DIR__);
    
        $dompdf = new Dompdf($opcion); 

        $dompdf -> loadHtml($html);   //carga las cosas al la hoja de html

        $dompdf->setPaper("A4");

        $dompdf -> render();                //crea el lienso para pegar el textos del html
        
        $dompdf->addInfo("Title","An Example PDF");

        $nombre="$txtnombre.pdf";
                                                    
        $dompdf -> stream($nombre, ["Attachment"=> 0]);

ob_start();
}
    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    
    <h1>formulario alverga</h1>

    <form action="" method="post">

        <label for="">Nombre</label>
        <input type="text" name="txtnombre" id="" required>
        <label for="">carrera</label>
        <input type="text" name="txtcarrera" id="" required>
        <button>registrar</button>
    </form>


</body>
</html>