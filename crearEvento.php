<?php
    session_start();
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Evento</title>

    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/norm.css">
</head>
<body>
    <?php
        if(isset($_SESSION['usuario'])){
            require ("config.php");
            $solicitar = $connect->query("SELECT  * FROM usuarios WHERE id = '".$_SESSION['id']."'");
            $row = $solicitar->fetch_assoc();
        }
    ?>
    <!-- HEADER-->
    <div id ="flipkart-navbar">
      <div class="container">
        <div class="row row1">
          <ul class= "largenav pull-right">
            <li class="upper-links"><a class="links" href="misAmigos.php">AMIGOS</a></li>
            <li class="upper-links"><a class="links" href="misEventos.php">MIS EVENTOS</a></li>
            <li class="upper-links"><a class="links" href="crearEvento.php">CREAR EVENTO</a></li>
            <li class="upper-links"><a class="links" href="editarPerfil.php"><?php echo strtoupper($row['nombre']);?></a></li>
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

    <!--CUERPO-->
    <div class="container bootstrap snippet">
          <div class="col-sm-13">
                      <form class="form" action="##" method="post" id="registrationForm">
                          <div class="form-group">

                              <div class="col-xs-6">
                                  <label for="name"><h4>Nombre</h4></label>
                                  
                                  <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" title="Introduce el nombre del evento.">
                              </div>
                          </div>
                          <div class="form-group">

                              <div class="col-xs-6">
                                <label for="username"><h4>Descripción</h4></label>
                                  <input type="textarea" class="form-control" name="descripcion" id="descripcion" placeholder="Descripción" title="Introuduce la descripción del evento.">
                              </div>
                          </div>

                          <div class="form-group">

                              <div class="col-xs-6">
                                  <label for="email"><h4>Fecha</h4></label>
                                  <input type="date" class="form-control" name="fecha" id="fecha" placeholder="dd/mm/aa" title="Introduce la fecha del evento.">
                              </div>
                          </div>

                          <div class="form-group">

                              <div class="col-xs-6">
                                <label for="text"><h4>Categoría</h4></label>

                                <select class="form-control" name = "categoria">

                                  <option value="Teatro">Teatro</option>
                                  <option value="Musica">Música</option>
                                  <option value="Deportes">Deportes</option>
                                  <option value="Gastronomia">Gastronomía</option>

                                </select>
                              </div>
                          </div>

                          <div class="form-group">

                              <div class="col-xs-6">
                                  <label for="text"><h4>Aforo</h4></label>
                                  <input type="text" class="form-control" name="aforo" id="aforo" placeholder="Aforo" title="Introduce el aforo del evento.">
                              </div>
                          </div>
                          <div class="form-group">

                              <div class="col-xs-6">
                                <label for="ubicacion"><h4>Ubicación</h4></label>
                                  <input type="text" class="form-control" name="ubicacion" id="ubicacion" placeholder="Ubicación" title="Introduce la ubicación del evento.">
                              </div>
                          </div>
                          <center>
                          <div class="form-group">
                               <div class="col-xs-12">
                                    <br>
                                    <button class="btn btn-lg btn-success" type="submit" name = "event"> Crear</button>
                                    <button class="btn btn-lg" type="reset"><a href='index.php'> Regresar </a></button>
                                </div>
                          </div>
                          </center>
                    </form>

                  <hr>

                 </div><!--/tab-pane-->
                 <!--/tab-pane-->

            </div><!--/col-9-->

    <!--FOOTER-->
      <section id = "footer" class="absolute">
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


    <?php
        if(isset($_POST['event'])){
            require("config.php");

            $nombre = $_POST['nombre'];
            $fecha = $_POST['fecha'];
            $aforo = $_POST['aforo'];
            $descripcion = $_POST['descripcion'];
            $categoria = $_POST['categoria'];
            $ubicacion = $_POST['ubicacion'];
            

            $insertar = $connect->query("INSERT INTO eventos (nombre, fecha, usuario_org, aforo, descripcion, categoria, ubicacion) 
                                        VALUES ('$nombre','$fecha','".$_SESSION['id']."', '$aforo', '$descripcion', '$categoria', '$ubicacion')");
            if ($insertar) {
                echo "Evento creado correctamente.";
                header("Refresh: 2; url = index.php");
            }
        } 
    ?>
</body>
</html>