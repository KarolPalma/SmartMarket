<?php 
    $id = $_GET['idEmpleado']; //Recupera el ID del empleado por metodo GET

    $correo = ''; //Inicializacion de variables
    $iterador = 1;

    $sql = "SELECT Correo FROM Correos_Empleados WHERE Id_Empleado = '" . $id . "';"; //Consulta de todos los correos registrados bajo la identidad de ese empleado
    $result = mysqli_query($conexion, $sql); //Ejecuta la consulta
    $registros = mysqli_num_rows($result); //Toma cuantos registros fueron traidos mediante la consulta
    if($registros == 0){ //Si no hay correos registrados para ese empleado imprime solo el primer campo de correos txtEmail1 vacio (como estaria por defecto)
        echo 
        "<div class='col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4'>
            <div class='form-group mt-2 mb-2'>
                <label for='txtEmail1' class='form-label'>Correo Electrónico</label>
                <input style='float: left;' type='email' class='form-control' name='txtEmail1' id='txtEmail1' maxlength='45' placeholder='Ingrese el correo electrónico del empleado' value=''>
                <button type='button' name='add' id='btn_anadirCorreo' class='btn btn-primary mx-3 mb-1' style='background-color: #6AB759; border-color: #6AB759;'>+</button>
            </div>
        </div>";
    }
    //Pero si hay registros pasa directamente a recorerlos uno por uno desde esta linea
    while ($row = mysqli_fetch_assoc($result)) {
        $correo = $row["Correo"]; //Se asigna a la variable correo el valor en la columna Correo de los registros traidos
        if($iterador == 1){ //Si es el primer registro crea el primer txtEmail1 por defecto pero llenado con el correo recuperado
            echo 
            "<div class='col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4'>
            <div class='form-group mt-2 mb-2'>
                <label for='txtEmail1' class='form-label'>Correo Electrónico</label>
                <input style='float: left;' type='email' class='form-control' name='txtEmail1' id='txtEmail1' maxlength='45' placeholder='Ingrese el correo electrónico del empleado' value='".$correo."'>
                <button type='button' name='add' id='btn_anadirCorreo' class='btn btn-primary mx-3 mb-1' style='background-color: #6AB759; border-color: #6AB759;'>+</button>
            </div>
        </div>";
            $iterador++;
        }else{ //Si no es el primer registro crea el div y el campo sumandole a su id 10 (ejemplo txtEmail12 cuando iterador es 2)
            echo
            "<div class='col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4' id='divCorreo1".$iterador."'>
                <div class='form-group mt-2 mb-2'>
                    <label for='txtEmail' class='form-label'>Correo Electrónico</label>
                    <input type='email' style='float: left;' class='form-control' name='txtEmail1".$iterador."' id='txtEmail1".$iterador."' maxlength='45' placeholder='Ingrese el nuevo correo' value='".$correo."'>
                    <button type='button' name='remove' id='1".$iterador."' class='btn btn-danger btn_removeCorreo mx-3 mb-1'>-</button>
                </div>
            </div>";
            $iterador++;
            //Esto se hace para evitar conflictos de nombres de div y campos cuando se desee agregar mas correos (esperando que sea imposible que un empleado tenga mas de 10 telefonos a su nombre)
        }
    }
?>