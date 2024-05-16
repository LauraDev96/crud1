<?php
    include "conexion.php";
?>

<?php
    $idm = $_GET["idmodifica"];
    $nombrantiguo = $_GET["nombreimagen"];
    mysqli_select_db($conexion,"productosbd");

    $identificador = $_POST["identificador"];
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];

    //var_dump($_FILES["imagen"]);

    $directorioSubida = "imagenes/";
    $max_file_size = "5120000";
    $extensionesValidas = array("jpg","jpeg","png","gif");

    if($_FILES["imagen"]['name'] != "") {
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

    if($_FILES["imagen"]['name'] != "") {
        $insertar = "UPDATE productos SET id_producto = $identificador, nombre = '$nombre', descripcion = '$descripcion', precio = $precio, fotografia = '$nombreArchivo' WHERE id_producto = $idm";
    } else {
        $insertar = "UPDATE productos SET id_producto = $identificador, nombre = '$nombre', descripcion = '$descripcion', precio = $precio, fotografia = '$nombreAntiguo' WHERE id_producto = $idm";
    }

    mysqli_query($conexion,$insertar);
    //La siguiente instrucción nos permite reedirigir.
    header("Location: actualiza_ok.php");
?>