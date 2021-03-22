<<?php

    require '../includes/funciones.php';   /** PARA CODIGO MAS COMPLEJO E INFORMACION IMPORTANTE DE LA APLICACION**/
    incluirTemplate('header', $inicio = true)
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    </main>


<?php
    incluirTemplate('footer')
?>