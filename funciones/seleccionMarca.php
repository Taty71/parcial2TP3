<?php
function Listar_Marcas($vConexion) {

    $ListadoM=array();

    //1) genero la consulta que deseo
    $SQL = "SELECT * FROM marcas ORDER BY Marcas";

    //2) a la conexion actual le brindo mi consulta, y el resultado lo entrego a variable $rs
     $rs = mysqli_query($vConexion, $SQL);
        
     //3) el resultado deberá organizarse en una matriz, entonces lo recorro
     $i=0;
    while ($data = mysqli_fetch_array($rs)) {
            $ListadoM[$i]['IdMarcas'] = $data['IdMarcas'];
            $ListadoM[$i]['Marcas'] = $data['Marcas'];
            $i++;
    }


    //devuelvo el listado generado en el array $Listado. (Podra salir vacio o con datos)..
    return $ListadoM;

}
?>