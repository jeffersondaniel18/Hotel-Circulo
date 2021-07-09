<?php 

session_start();
 
  if (!$_GET) {
  header('location:cusu.php?pagina=1');
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Usuarios</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-grid.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-reboot.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-utilities.css">
	<link rel="stylesheet" type="text/css" href="../css/estilocartas.css">
	<link rel="stylesheet" type="text/css" href="../css/do.css">
	<link rel="stylesheet" type="text/css" href="../css/all.css">
</head>
<body>
	<?php include 'navb.php';
  include 'menudesplegable.php'; ?>

  <table class="table table-bordered table-striped table-active"  style="margin-top: 70px;">
  	<tr><!--la del titulo-->
        <td colspan="12" align="center" class="table-borderless bg-dark "><h4><b class="text-white">Consulta de usuarios</b></h4></td>
      </tr>

      <tr id="elnegronolada" class="bg-light col-12">
        <td align="center" class="text-dark text-wrap  text-center"><b>Cedula</b></td>
        <td align="center" class="text-dark text-wrap  text-center"><b>Nombre</b></td>
        <td align="center" class="text-dark text-wrap  text-center"><b>Nombre</b></td>
        <td align="center" class="text-dark text-wrap  text-center"><b>Apellido</b></td>
        
        <td align="center" class="text-dark text-wrap  text-center"><b>Apellido</b></td>
         <td align="center" class="text-dark text-wrap  text-center"><b>movil</b></td>
        <td align="center" class="text-dark text-wrap  text-center"><b>fijo</b></td>
         <td align="center" class="text-dark text-wrap  text-center"><b>Correo</b></td>
        <td align="center" class="text-dark text-wrap  text-center"><b>Tipo de usuario</b></td>
        <td align="center" class="text-dark text-wrap  text-center"><b>nombre de usuario</b></td>
        <td align="center" class="text-dark text-wrap  text-center"><b>Editar</b></td>
        <td align="center" class="text-dark text-wrap  text-center"><b>Eliminar</b></td>

        </tr>


        <?php 
                include '../../backend/verusuarios.php';
                include '../../backend/conexion.php';
           $sql="SELECT * FROM `usuario` WHERE usuario.fky_tiu !='u01' AND usuario.sta_usu !='E'";
          $tus=mysqli_query($cone,$sql);
          $bxpagi=5;
          $cfi=mysqli_num_rows($tus);
          $paginas=$cfi/$bxpagi;
          $paginas=ceil($paginas);
          if ($_GET['pagina']>$paginas || $_GET['pagina']<=0 ) {
             header('location:cusu.php?pagina=1');
          }
           $ini=($_GET['pagina']-1)*$bxpagi;
           $usu="SELECT personas.ced_per,personas.nom1_per,personas.nom2_per,personas.ape1_per,personas.ape2_per,personas.tel1_per,personas.tel2_per,personas.cor_per,personas.sta_per,usuario.nom_usu,usuario.fky_per,usuario.fky_tiu,usuario.sta_usu,tipo_usuario.cod_tiu,tipo_usuario.nom_tiu FROM personas,usuario,tipo_usuario WHERE personas.ced_per=usuario.fky_per AND tipo_usuario.cod_tiu=usuario.fky_tiu LIMIT $ini,5";
            $cbli=mysqli_query($cone,$usu);

           while ($rusu=mysqli_fetch_array($cusu)) {
              if ($rusu['fky_tiu']=="u01"or $rusu['sta_usu']=="E")
              {

              }
              else
              {

           echo "

      <tr>
        <tr id='elnegronolada' class='bg-faded col-12'>
          <td align='center' class='text-dark'><b>$rusu[ced_per]</b></td>
          <td align='center' class='text-dark'><b>$rusu[nom1_per]</b></td>
          <td align='center' class='text-dark'><b>$rusu[nom2_per]</b></td>
          <td align='center' class='text-dark'><b>$rusu[ape1_per]</b></td>
          
          <td align='center' class='text-dark'><b>$rusu[ape2_per]</b></td>
          <td align='center' class='text-dark'><b>$rusu[tel1_per]</b></td>
          <td align='center' class='text-dark'><b>$rusu[tel2_per]</b></td>
          <td align='center' class='text-dark'><b>$rusu[cor_per]</b></td>
          
            <td align='center' class='text-dark'><b>$rusu[nom_tiu]</b></td>
             <td align='center' class='text-dark'><b>$rusu[nom_usu]</b></td>
          <td align='center'><a href='editarusu.php?ced=".$rusu['ced_per']."'><i class='fas fa-edit text-success'></a></i></td>
          <td align='center'><a href='../../backend/eliminarusu.php?ced=".$rusu['ced_per']."'><i  class='fas fa-trash text-danger'></i></a></td>
           

         
        
       ";
      

  
  }//end else
} //end while
         ?>
  </table>
   <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
              <li class="page-item <?php echo $_GET['pagina']<=1? 'disabled' : ''  ?>">
              <a class="page-link" href="verusuarios.php?pagina=<?php echo $_GET['pagina']-1 ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <?php 
            for ($i=0; $i <$paginas ; $i++): 
            ?>
            <li class="page-item <?php echo $_GET['pagina']==$i+1? 'active' : ''  ?>"><a class="page-link" href="verusuarios.php?pagina=<?php echo $i+1;  ?>"><?php echo $i+1;  ?></a></li>
            <?php endfor; ?>
            <li class="page-item <?php echo $_GET['pagina']>=$paginas? 'disabled' : ''  ?>">
      <a class="page-link" href="verusuarios.php?pagina=<?php echo $_GET['pagina']+1 ?>"  aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
          </ul>
          </nav>
	
<script src="../js/bootstrap.js" type="text/javascript" charset="utf-8" async defer></script>
<script src="../js/eje.js" type="module"></script>
<script type="text/javascript" src="../js/all.js"></script>
</body>
</html>