<?php 
    include("../conexion.php"); //Llama a la conexion a la BD
    $depto = $_REQUEST['depto']; //Recibe el id del departamento seleccionado para rellenar el combobox de ciudades mediante un registro JSON
	$idCiudad = $_REQUEST['ciudad']; //Recibe el id de la ciudad (en caso de ser una actualizacion) para marcar esa ciudad como seleccionada
    
	$sql = "SELECT Id_Ciudad, Nombre_Ciudad FROM Ciudades WHERE Id_Departamento = '$depto'"; //Consulta a la BD

	$result = mysqli_query($conexion,$sql); //Realizacion de la consulta

	$cadena = "<option value=''>-- Seleccione una Ciudad --</option>"; //Imprimir el valor por defecto

	while ($res = mysqli_fetch_row($result)) { //Recorrer los registros
		if($res[0] == $idCiudad){ //Si el id pasado como JSON desde el Ajax es igual al id en el registro actual, marca como seleccionado este option
			$cadena = $cadena."<option selected value = '".$res[0]."'>".$res[1]."</option>";
		} else { //Si no lo imprime como un option normal
			$cadena = $cadena."<option value = '".$res[0]."'>".$res[1]."</option>";
		}
	}
	echo  $cadena;
	//Devuelve la cadena de HTML al AJAX que la incorporara en el combobox o select especificado en la funcion
?>