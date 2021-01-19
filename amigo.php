<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Count on Me</title>

    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/norm.css">
</head>
<body>
<?php
        if(isset($_GET['id'])){
            require ("config.php");
            $solicitar = $connect->query("SELECT  * FROM usuarios WHERE id = '".$_GET['id']."'");
            $row = $solicitar->fetch_assoc();
            $seguido = $connect->query("SELECT  * FROM amistades WHERE solicitante = '".$_SESSION['id']."' AND solicitado = '".$_GET['id']."'");
            $cuantos = $seguido->num_rows;
            $apuntados = $connect->query("SELECT  * FROM asistencia WHERE usuario = '".$_SESSION['id']."'");
            $cuantosapuntados = $apuntados->num_rows;
            
    ?>
    <?php
        if(isset($_GET['seguir'])){
          require ("config.php");
            $seguir = $connect->query("INSERT INTO amistades (solicitante, solicitado, aceptado) 
            VALUES ('".$_SESSION['id']."','".$_GET['id']."', '1')");
            if($cuantos >0){
            header("Refresh: 0.1; url = amigo.php?id=".$_GET['id']);
            }
        }
    ?>

    <?php
        if(isset($_GET['dejarseguir'])){
          require ("config.php");
            $insertar = $connect->query("UPDATE amistades SET aceptado = 0 WHERE solicitante = '".$_SESSION['id']."' AND solicitado = '".$_GET['id']."'");
            if($cuantos >0){
            header("Refresh: 0.1; url = amigo.php?id=".$_GET['id']);
            }
        }
    ?>

    <?php
        if(isset($_GET['seguirnuevamente'])){
          require ("config.php");
            $insertar = $connect->query("UPDATE amistades SET aceptado = 1 WHERE solicitante = '".$_SESSION['id']."' AND solicitado = '".$_GET['id']."'");
            if($cuantos >0){
            header("Refresh: 0.1; url = amigo.php?id=".$_GET['id']);
            }
        }
    ?>

<?php
        if(isset($_GET['apuntarse'])){
          require ("config.php");

          if($_GET['aforo']-1 >= 0){
            $apuntado = $connect->query("INSERT INTO asistencia (usuario, evento, estado) 
            VALUES ('".$_SESSION['id']."','".$_GET['id']."', '1')");
            if($cuantosapuntados >0){
              header("Refresh: 0.1; url = amigo.php?id=".$_GET['id']);
            }
          }
          
        }
    ?>

    <?php
        if(isset($_GET['reapuntarse'])){
          require ("config.php");

          if($_GET['aforo']-1 >= 0){
            $apuntado = $connect->query("UPDATE asistencia SET estado = 1 WHERE usuario = '".$_SESSION['id']."' AND evento = '".$_GET['id']."'");
            if($cuantosapuntados >0){
              header("Refresh: 0.1; url = amigo.php?id=".$_GET['id']);
            }
          }
          
        }
    ?>

<?php
        if(isset($_GET['desapuntarse'])){
          require ("config.php");

          if($_GET['aforo']-1 >= 0){
            $apuntado = $connect->query("UPDATE asistencia SET estado = 0 WHERE usuario = '".$_SESSION['id']."' AND evento = '".$_GET['id']."'");
            if($cuantosapuntados >0){
              header("Refresh: 0.1; url = amigo.php?id=".$_GET['id']);
            }
          }
          
        }
    ?>
    
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<!-- HEADER-->
  <div id ="flipkart-navbar">
    <div class="container">
        <div class="row row1">
        <ul class= "largenav pull-right">
            <li class="upper-links"><a class="links" href="misAmigos.php">AMIGOS</a></li>
            <li class="upper-links"><a class="links" href="misEventos.php">MIS EVENTOS</a></li>
            <li class="upper-links"><a class="links" href="crearEvento.php">CREAR EVENTO</a></li>
            <li class="upper-links"><a class="links" href="editarPerfil.php"><?php echo strtoupper($row['nombre']) ?></a></li>
            <li class="upper-links"><a class="links" href="logout.php">SALIR</a></li>

        </ul>
        <div class="row row2">
            <div class="col-sm-2">
              <h1 style="margin:0px;"><span class="largenav"><a style="color:#FFFFFF; text-decoration: none;" href = "index.php">Count on Me</a></span></h1>
            </div>
        </div>
        </div>
    </div>
    </div>

    <br>
    <div class="container bootstrap snippet">
      <div class="row">
        <div class="col-sm-3"><!--left col-->
          <div class="text-center">
            <img src = "<?php echo $row['avatar']; ?>" class="avatar img-circle img-thumbnail" alt="avatar">
          </div>
        </div><!--/col-3-->
        	<div class="col-sm-9">
              <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <hr>
                          <div class="form-group">
                              <div class="col-xs-6">
                                  <label for="nombre"><h4>Nombre: </h4></label>
                                  <label for="nombre"><h4><?php echo $row['nombre'];?></h4></label>
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-xs-6">
                                <label for="username"><h4>Usuario: </h4></label>
                                <label for="nombre"><h4><?php echo $row['usuario'];?></h4></label>
                              </div>
                          </div>


                          <div class="form-group">
                              <div class="col-xs-6">
                                  <label for="email"><h4>Email: </h4></label>
                                  <label for="nombre"><h4><?php echo $row['email'];?></h4></label>
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-xs-6">
                                  <label for="fechanacimiento"><h4>Fecha de Nacimiento: </h4></label>
                                  <label for="nombre"><h4><?php echo $row['nacimiento'];?></h4></label>
                              </div>
                          </div>

                          <div class="form-group">
                            <div class="col-xs-6">
                                <label for="text"><h4>Sexo: </h4></label>
                                <label for="nombre"><h4><?php echo $row['sexo'];?></h4></label>
                            </div>
                        </div>

                          <div class="form-group">

                              <div class="col-xs-6">
                                  <label for="descripcion"><h4>Descripcion: </h4></label>
                                  <label for="nombre"><h4><?php echo $row['descripcion'];?></h4></label>

                          </div>
                          <div class="form-group">
                               <div class="col-xs-12">
                                    <br>
                                    <?php
                                        $amistad = $seguido->fetch_assoc();
                                        if($cuantos > 0){
                                          if($amistad['aceptado'] == 1){
                                    ?>
                                    <a href="?dejarseguir=dejarseguir&id=<?php echo $_GET['id'];?>"><button class="btn btn-lg btn-success" type="submit">Dejar de Seguir</button></a>
                                    <?php
                                        }else{
                                    ?>
                                    <a href="?seguirnuevamente=seguirnuevamente&id=<?php echo $_GET['id'];?>"><button class="btn btn-lg btn-success" type="submit">Seguir</button></a>
                                    <?php
                                        }
                                      }else{
                                    ?>
                                    <a href="?seguir=seguir&id=<?php echo $_GET['id'];?>"><button class="btn btn-lg btn-success" type="submit">Seguir</button></a>
                                    <?php
                                    }
                                    ?>
                                   	<button class="btn btn-lg" type="reset"><a href='index.php'> Regresar </a></button>
                                </div>
                          </div>

                  <hr>

                 </div><!--/tab-pane-->
                 <!--/tab-pane-->


                  </div><!--/tab-pane-->
              </div><!--/tab-content-->

            </div><!--/col-9-->
      </div><!--/row-->
  <section class="sections random-product ">
      <div class="container-fluid">
        <div class="container">
          <div class="row" id = "resultado">
            <?php
              $eventos = $connect->query("SELECT * FROM eventos WHERE usuario_org = '".$_GET['id']."'");
              while($row1 = $eventos->fetch_assoc()){
                $asistencia = $apuntados->fetch_assoc();
                if($cuantos > 0){
                  if($asistencia['estado'] == 1){
                    echo "
                <div class=\"col-md-4 evs \">
                  <div class=\"card bordeado\">
                      <div class=\"card-body\">
                        <h3 class=\"card-title\">
                          <p class=\"text-dark\">".$row1['nombre']."</p>
                        </h3>
                        <p class=\"text-dark\">".$row1['descripcion']." </p>
                      </div>
                      <div class=\"card-footer\">
                        <div class=\"badge badge-danger float-right\">Aforo: ".$row1['aforo']."</div>
                          <div class=\"float-left\">
                            <p class=\"text-danger\">".$row1['categoria']."</p>
                            <p class=\"text-danger\"> En ".$row1['ubicacion']." el ".$row1['fecha']."</p>
                            <a href='?desapuntarse=desapuntarse&id=".$row1['id']."&aforo=".$row1['aforo']."'> Desapuntarse </a>
                          </div>
                        </div>
                  </div>
                </div>
                ";
                  }else{
                    echo "
                <div class=\"col-md-4 evs \">
                  <div class=\"card bordeado\">
                      <div class=\"card-body\">
                        <h3 class=\"card-title\">
                          <p class=\"text-dark\">".$row1['nombre']."</p>
                        </h3>
                        <p class=\"text-dark\">".$row1['descripcion']." </p>
                      </div>
                      <div class=\"card-footer\">
                        <div class=\"badge badge-danger float-right\">Aforo: ".$row1['aforo']."</div>
                          <div class=\"float-left\">
                            <p class=\"text-danger\">".$row1['categoria']."</p>
                            <p class=\"text-danger\"> En ".$row1['ubicacion']." el ".$row1['fecha']."</p>
                            <a href='?reapuntarse=reapuntarse&id=".$row1['id']."&aforo=".$row1['aforo']."'> Apuntarse </a>
                          </div>
                        </div>
                  </div>
                </div>
                ";
                  }
                }else{
                  echo "
                <div class=\"col-md-4 evs \">
                  <div class=\"card bordeado\">
                      <div class=\"card-body\">
                        <h3 class=\"card-title\">
                          <p class=\"text-dark\">".$row1['nombre']."</p>
                        </h3>
                        <p class=\"text-dark\">".$row1['descripcion']." </p>
                      </div>
                      <div class=\"card-footer\">
                        <div class=\"badge badge-danger float-right\">Aforo: ".$row1['aforo']."</div>
                          <div class=\"float-left\">
                            <p class=\"text-danger\">".$row1['categoria']."</p>
                            <p class=\"text-danger\"> En ".$row1['ubicacion']." el ".$row1['fecha']."</p>
                            <a href='?apuntarse=apuntarse&id=".$row1['id']."&aforo=".$row1['aforo']."'> Apuntarse </a>
                          </div>
                        </div>
                  </div>
                </div>
                ";
                }
                
              }
          
            ?>
          </div>
        </div>
      </div>
    </section>

<br>
<br>
<br>
    <!--FOOTER-->
      <section id = "footer">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center">
              <p><i>Count on Me</i> es un proyecto desarrollado por Sofía Martínez Parada y Claudia Jazmín Soria Saavedra para la asignatura de Desarrollo Web y de Apps</p>
              <p class="h6">© All rights reserved.</p>
            </div>
            <hr>
          </div>
        </div>
      </section>
       
     <?php }else{
    header("Location: login.php");
    exit;
  }
  ?>

</body>
</html>