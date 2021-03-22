<?php

function conectarDB(){
    $db = mysqli_connect('localhost', 'root', '', 'bienesraices');

    if($db){
        echo "Se conecto";
    }else{
        echo "No se conectó";
    }
}