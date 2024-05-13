<?php
    include "conexion.php";
?>

<?php
    mysqli_select_db($conexion,"productosbd");

    $identificador = $_POST["identificador"];
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];

    //var_dump($_FILES["imagen"]);

    $directorioSubida = "imagenes/";
    $max_file_size = "5120000";
    $extensionesValidas = array("jpg","jpeg","png","gif");

    if(isset($_FILES["imagen"])) {
        echo "dentro";
        $errores = 0;
        $nombreArchivo = $_FILES["imagen"]["name"];
        $filesize = $_FILES["imagen"]["size"];
        $directorioTemporal = $_FILES["imagen"]["tmp_name"];
        $tipoArchivo = $_FILES["imagen"]["type"];
        $arrayArchivo = pathinfo($nombreArchivo);
        $extension = $arrayArchivo["extension"];

        if(!in_array($extension,$extensionesValidas)) {
            echo "La extensión no es válida";
            $errores = 1;
        }

        if($filesize > $max_file_size) {
            echo "La imagen debe de tener un tamaño inferior";
            $errores = 1;
        }

        if($errores == 0) {
            echo $nombreArchivo;
            $nombreCompleto = $directorioSubida . $nombreArchivo;
            move_uploaded_file($directorioTemporal, $nombreCompleto);
        }
    }

    $insertar = "INSERT productos (id_producto, nombre, descripcion, precio, fotografia) VALUES ($identificador,'$nombre','$descripcion','$precio','$nombreArchivo')";

    mysqli_query($conexion,$insertar);
    //La siguiente instrucción nos permite reedirigir.
    header("Location: alta_ok.php");
?>