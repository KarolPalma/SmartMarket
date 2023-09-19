<?php 
    //Recibe el id del pais seleccionado para rellenar el combobox de departamentos y cumple la misma funcion que consultaCiudad.php
	//Solo que usando pais y departamentos
    include("../conexion.php");
    $pais = $_REQUEST['pais'];
	$idDepto = $_REQUEST['departamento'];
    
	$sql = "SELECT Id_Departamento, Nombre_Departamento FROM Departamentos WHERE Id_Pais = '$pais'";

	$result = mysqli_query($conexion,$sql);

	$cadena = "<option value=''>-- Seleccione un Departamento --</option>'";

	while ($res = mysqli_fetch_row($result)) {
		if($res[0] == $idDepto){
			$cadena = $cadena."<option selected value = '".$res[0]."'>".$res[1]."</option>";
		} else {
			$cadena = $cadena."<option value = '".$res[0]."'>".$res[1]."</option>";
		}
	}
	echo  $cadena;
?>