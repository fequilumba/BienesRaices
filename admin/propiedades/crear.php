<<?php
    // BASE DE DATOS
    require '../../includes/config/database.php';
    $db = conectarDB();

    // Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysql_query ($db, $consulta);

    // arreglo con mensajes de errores
    $errores = [];

    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $vendedorId = '';

    //Ejecutar el código después que el usuario envía el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //echo "<pre>";
        //var_dump($_POST);
        //echo "</pre>";

        $titulo = $_POST['titulo'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $habitaciones = $_POST['habitaciones'];
        $wc = $_POST['wc'];
        $estacionamiento = $_POST['estacionamiento'];
        $vendedorId = $_POST['vendedor'];

        if(!$titulo){
            $errores[] = "Debes añadir un título";
        }

        if(!$precio){
            $errores[] = "El precio es obligatorio";
        }

        if(strlen($descripcion) < 50){
            $errores[] = "La descripcion es obligatorio y debe tener al menos 50 caracteres";
        }

        if(!$habitaciones){
            $errores[] = "El numero de habitaciones es obligatorio";
        }

        if(!$wc){
            $errores[] = "El número de baños es obligatorio";
        }

        if(!$estacionamiento){
            $errores[] = "El número de estacionamientos es obligatorio";
        }

        if(!$vendedorId){
            $errores[] = "Elije un vendedor";
        }

        //echo "<pre>";
        //var_dump($errores);
        //echo "</pre>";
     
        // Revisar que el arreglo de errores este vacio
        if(empty($errores)){
            // INSERTAR EN LA BASE DE DATOS
            $query = "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento,vendedorId)
            VALUES ('$titulo', '$precio','$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$vendedorId')";

           // echo $query;

            $resultado = mysqli_query($db, $query);
            if($resultado){
                echo "Insertado Correctamente";
            }
        }
        
    }

    
    

    require '../../includes/funciones.php';   /** PARA CODIGO MAS COMPLEJO E INFORMACION IMPORTANTE DE LA APLICACION**/
    incluirTemplate('header', $inicio = true)
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        
        <?php endforeach; ?>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Título Propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png">

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" ><?php echo $descripcion; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Información Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento; ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor" id="#">
                    <option value="">-- Seleciones el vendedor --</option>
                    <?php while($vendedor = mysqli_fetch_assoc($resultado)) : ?>
                        <option value="<?php echo $vendedor['id']; ?>"> <?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?></option>
                    <?php endwhile; ?>
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton Boton-verde">
        </form>
    </main>


<?php
    incluirTemplate('footer')
?>