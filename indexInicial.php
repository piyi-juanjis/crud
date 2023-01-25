<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>CRUD</title>
<link rel="stylesheet" type="text/css" href="hoja.css">


</head>

<body>

<?php

  include("conexion.php");
  /*$conexion=$base->query("SELECT * FROM crud");

  $registros=$conexion->fetchALL (PDO::FETCH_OBJ);*/

  $registros=$base->query("SELECT * FROM crud")->fetchALL(PDO::FETCH_OBJ);

  if(isset($_POST["cr"])){
    
    $nombre=$_POST["Nom"];

    $apellido=$_POST["Ape"];

    $direccion=$_POST["Dir"];

    $sql="INSERT INTO crud (NOMBRE, APELLIDO, DIRECCION) VALUES(:nom, :ape, :dir)";

    $resultado=$base->prepare($sql);

    $resultado->execute(array(":nom"=>$nombre, ":ape"=>$apellido, ":dir"=>$direccion));

    header("Location:indexInicial.php");

  }


?>

<h1>CRUD<span class="subtitulo">Create Read Update Delete</span></h1>
<form action="<?php echo $_SERVER ['PHP_SELF'];?>"method="post">

  <table width="50%" border="0" align="center">
    <tr >
      <td class="primera_fila">Id</td>
      <td class="primera_fila">Nombre</td>
      <td class="primera_fila">Apellido</td>
      <td class="primera_fila">Dirección</td>
      <td class="sin">&nbsp;</td>
      <td class="sin">&nbsp;</td>
      <td class="sin">&nbsp;</td>
    </tr> 
   
		<?php
    
    foreach($registros as $personas):?>

    <tr>
      <td><?php echo $personas->Id?> </td>
      <td><?php echo $personas->Nombre?> </td>
      <td><?php echo $personas->Apellido?> </td>
      <td><?php echo $personas->Direccion?> </td>
 
      <td class="bot"><a href="borrar.php?Id=<?php echo $personas->Id?>"><input type='button' name='del' id='del' value='Borrar'></a></td>
      <td class='bot'>
        <a href="editarInicial.php?Id=<?php echo $personas->Id?> 
        &                          nom=<?php echo $personas->Nombre?>
        &                           ape=<?php echo $personas->Apellido?>
        &                             dir=<?php echo $personas->Direccion?>">                       
        <input type='button' name='up' id='up' value='Actualizar'></a></td>
    </tr> 
    
    <?php
    endforeach;
    ?>


    
    <tr>
    <td></td>
        <td><input type='text' name='Nom' size='10' class='centrado'></td>
        <td><input type='text' name='Ape' size='10' class='centrado'></td>
        <td><input type='text' name=' Dir' size='10' class='centrado'></td>
        <td class='bot'><input type='submit' name='cr' id='cr' value='Insertar'></td></tr>    
    </table>
  </form>
<p>&nbsp;</p>
</body>
</html>