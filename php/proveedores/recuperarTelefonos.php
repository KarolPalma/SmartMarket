<?php //El funcionamiento es el mismo que lo explicado en recuperarCorreos.php pero esta vez usando telefonos y haciendo la consulta a la tabla de telefonos
    $id = $_GET['idProveedor'];

    $telefono = '';
    $iterador = 1;

    $sql = "SELECT Telefono FROM Telefonos_Proveedores WHERE Id_Proveedor = '" . $id . "';";
    $result = mysqli_query($conexion, $sql);
    $registros = mysqli_num_rows($result);
    if($registros == 0){
        echo 
        "<div class='col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4'>
            <div class='form-group mt-2 mb-2'>        
                <label for='txtTelefono1' class='form-label'>Número Teléfonico</label>
                <input style='float: left;' type='text' class='form-control' name='txtTelefono1' id='txtTelefono1' maxlength='10' placeholder='Ingrese el teléfono del proveedor' value=''>
                <button type='button' name='add' id='btn_anadirTelefono' class='btn btn-primary mx-3 mb-1' style='background-color: #6AB759; border-color: #6AB759;'>+</button>
            </div>
        </div>";
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $telefono = $row["Telefono"];
        if($iterador == 1){
            echo 
            "<div class='col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4'>
                <div class='form-group mt-2 mb-2'>        
                    <label for='txtTelefono1' class='form-label'>Número Teléfonico</label>
                    <input style='float: left;' type='text' class='form-control' name='txtTelefono1' id='txtTelefono1' maxlength='10' placeholder='Ingrese el teléfono del proveedor' value='".$telefono."'>
                    <button type='button' name='add' id='btn_anadirTelefono' class='btn btn-primary mx-3 mb-1' style='background-color: #6AB759; border-color: #6AB759;'>+</button>
                </div>
            </div>";
            $iterador++;
        }else{
            echo
            "<div class='col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4' id='divTelefono1".$iterador."'>
                <div class='form-group mt-2 mb-2'>
                    <label for='txtTelefono' class='form-label'>Número Teléfonico</label>
                    <input type='text' style='float: left;' class='form-control' name='txtTelefono1".$iterador."' id='txtTelefono1".$iterador."' maxlength='10' placeholder='Ingrese el nuevo teléfono' value='".$telefono."'>
                    <button type='button' name='remove' id='1".$iterador."' class='btn btn-danger btn_removeTelefono mx-3 mb-1'>-</button>
                </div>
            </div>";
            $iterador++;
        }
    }
?>