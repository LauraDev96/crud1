<?php
    include "conexion.php";
?>

<?php
include "header.php";
?>

<div class="container my-5">
    <div class="row">
        <div class="col text-center">
            <div class="card">
                <div class="card-header display-6">
                    Listado de productos
                </div>
                <div class="row m-5 justify-content-md-center">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                Productos: 

                            </div>
                            
                            <?php
                                mysqli_select_db($conexion,"productosbd");
                                $consultar = "SELECT * FROM productos";

                                $registros = mysqli_query($conexion,$consultar);
                            ?>

                            <div
                                class="table-responsive"
                            >
                                <table
                                    class="table table-hover"
                                >
                                    <thead>
                                        <tr>
                                            <th scope="col">Identificador</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Descripción</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Imagen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while($registro = mysqli_fetch_row($registros)) {
                                        ?>
                                        <tr class="align-middle">
                                            <td scope="row"><?php echo $registro[0];?></td>
                                            <td><?php echo $registro[1];?></td>
                                            <td><?php echo $registro[2];?></td>
                                            <td><?php echo $registro[3];?></td>
                                            <td><?php echo '<img width="100px" height="80px" src="imagenes/' . $registro[4] . '">'; ?></td>
                                        </tr>
                                        <?php 
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <a href="index.php"><i class="bi-arrow-return-left px-3" style="font-size: 4rem; color: black;"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>