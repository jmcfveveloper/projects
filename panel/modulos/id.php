<?php

include('global/conexion.php');
?>
<?php
//include('global/conexion.php');

session_start();


if(!isset($_SESSION['rol'])){
    header('location:../');
}else{
    if($_SESSION['rol'] != 1){  
        header('location: ../login.php');
    }
}

//$a=$_SESSION['nombre'];
$id=$_SESSION['id'];
$arrayInfo=$_SESSION['usuario'];

?>

<?php


$conexion = new PDO('mysql:host=localhost;dbname='.BDATOS, 'root', PASSWORD_REGISTRO); 
$conexion->exec("SET CHARACTER SET utf8");

header('Content-Type: text/html; charset=utf8');

$sentenciaIdentificaciones=$pdo->prepare("SELECT * FROM `identificacion` WHERE 1 ");
$sentenciaIdentificaciones->execute();
$registroIdentificion=$sentenciaIdentificaciones->fetchAll(PDO::FETCH_ASSOC);


//========================codigo controlador de la vista de identificaciones ==============================

$errores="";


$conexion = new PDO('mysql:host=localhost;dbname=' . BDATOS, 'root', PASSWORD_REGISTRO);

$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtTipo = (isset($_POST['txtTipo'])) ? $_POST['txtTipo'] : "";
$txtCodigo = (isset($_POST['txtCodigo'])) ? $_POST['txtCodigo'] : "";


/* 
variables para los botenes */

$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";
$modal = (isset($_POST['modal'])) ? $_POST['modal'] : "";



$accionAgregar = "";
$accionModificar = $accionCancelar= $accionEliminar = "disabled";
$mostrarModal = false;



switch ($accion) {

  case "btnAgregar":


    if (empty($txtTipo) or empty($txtCodigo)) {
      $errores .= '<hr class="solid"><li><span class="badge badge-warning">Por favor rellena todos los datos</span></li> <hr class="solid">';
    } else {
      
    //	echo " variables=> ".$nombre."-".$apellido."-".$correo;
    
    
      $statement = $conexion->prepare('SELECT * FROM identificacion WHERE codigo = :codigo LIMIT 1');
      $statement->execute(array(':codigo' => $txtCodigo));
      $resultado = $statement->fetch();
  
  
      if ($resultado != false) {
        $errores .= '<h2><li><span class="badge badge-danger">Este codigo ya esta siendo utilizado</span></li></h2>';
      }
     
    }
    if($errores  == ''){

      
    $statement = $conexion->prepare('INSERT INTO identificacion (id,tipo,codigo) VALUES (null, :tipo, :codigo)');
    $statement->execute(array(
      ':tipo' => $txtTipo,
      ':codigo' => $txtCodigo
    ));


    $url = 'Vistaid.php';
    echo '<meta http-equiv=refresh content="1; ' . $url . '">';



    }




    break;

  case "btnEditar":

    $statementEditar = $conexion->prepare('UPDATE identificacion SET 
      tipo=:Tipo, 
      codigo=:Codigo 
      WHERE
      id=:Id');

    $statementEditar->execute(array(
      ':Tipo' => $txtTipo,
      ':Codigo' => $txtCodigo, 
      ':Id' => $txtID
    ));
    $url = 'Vistaid.php';
    echo '<meta http-equiv=refresh content="1; ' . $url . '">'; 

    break;


    case "btnEliminar":

      $statement = $conexion->prepare('DELETE FROM identificacion WHERE id =:ID');
      $statement->execute(array(
        ':ID' => $txtID
      ));
  
  
    
     $url = 'Vistaid.php';
      echo '<meta http-equiv=refresh content="1; ' . $url . '">'; 
  
  
      break;


  case "btnCancelar":
    $url = 'VIstaid.php';
    echo '<meta http-equiv=refresh content="1; ' . $url . '">';


    break;


  case "Seleccionar":
    $accionAgregar="disabled";
    $accionModificar=$accionCancelar=$accionEliminar="";
    //$mostrarModal=true;
  
  
    $statement =$conexion->prepare("SELECT * FROM identificacion WHERE id=:id");
    $statement->execute(array(':id'=>$txtID));
    $Identificacion=$statement->fetch(PDO::FETCH_LAZY);
  
    $txtTipo=$Identificacion['tipo'];
    $txtCodigo=$Identificacion['codigo'];
    break;
}


//=======================  ===================================================

?>

   

  
  

