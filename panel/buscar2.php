<?php
	$servername = "localhost";
    $username = "root";
  	$password = "Acdc1004966557";
  	$dbname = "registro";

	$columna='<a href="files.php?id=10" target="_blank">
	<button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal">
                            <i class="nav-icon fas fa-file"></i>
                          </button>
	</a>';


	$link1='<a href="files.php?id=';

	$link2='" target="_blank">
	<button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal">
	<i ><img src="../imagenes/icon/pdf2.svg" width="20px" heigth="20px"></img></i>
                          </button>
	</a>';
	

	$conn = new mysqli($servername, $username, $password, $dbname);
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }

    $salida = "";

    $query = "SELECT * FROM trabajadores WHERE Identificacion NOT LIKE '' ORDER By Identificacion LIMIT 25";

    if (isset($_POST['consulta'])) {
    	$q = $conn->real_escape_string($_POST['consulta']);
    	$query = "SELECT * FROM trabajadores WHERE Identificacion LIKE '%$q%' OR tipo_id LIKE '%$q%' OR digito_v LIKE '%$q%' OR primer_apellido LIKE '%$q%' OR segundo_apellido LIKE '%$q%' OR primer_nombre LIKE '%$q%' OR segundo_nombre LIKE '%$q%' OR forma_pago LIKE '%$q%' OR banco LIKE '%$q%' OR tipo_cuenta LIKE '%$q%' OR no_cuenta LIKE '%$q%' OR correo LIKE '%$q%'";
    }

    $resultado = $conn->query($query);

    if ($resultado->num_rows>0) {
    	$salida.= "<div class='table-responsive-sm'><table border=1 class='table table-sm'>
    			<thead>
    				<tr id='titulo' class='bg-primary'>
    					
						<th>Identificación</th>
                        <th>TipoID</th>
						<th>Digito v</th>
                        <th>Apellidos y Nombres</th>
						<th>Forma pago</th>
                        <th>Banco</th>
						<th>Cuenta</th>
                        <th>No.Cuenta</th>
						<th>Correo</th>
						<th>PDF</th>

    				</tr>

    			</thead>
    			

    	<tbody>";

    	while ($fila = $resultado->fetch_assoc()) {
    		$salida.="<tr>
    					<td>".$fila['Identificacion']."</td>
    					<td>".$fila['tipo_id']."</td>
    					<td>".$fila['digito_v']."</td>
    					<td>".$fila['primer_apellido'].' '.$fila['segundo_apellido'].' '.$fila['primer_nombre'].' '.$fila['segundo_nombre']."</td>
    					<td>".$fila['forma_pago']."</td>
						<td>".$fila['banco']."</td>
						<td>".$fila['tipo_cuenta']."</td>
						<td>".$fila['no_cuenta']."</td>
						<td>".$fila['correo']."</td>
						<td>".$link1.$fila['id'].$link2."</td>
    				</tr>";

    	}
    	$salida.="</tbody></table></div>";
    }else{
    	$salida.="<div class='container'>
		<div class='row'>
			<div class='col align-self-start'>
			
			</div>
			<div class='col align-self-center'>
			<img src='../imagenes/icon/person_error.svg' alt='imagen de pdf' width='250px' height='300px'>
			 <p style='color:#F91839';><strong>El trabajador no tiene comprobante</strong></p>
			
			</div>
			<div class='col align-self-end'>
		   
			</div>
		</div>
		</div>";
    }


    echo $salida;

    $conn->close();



?>