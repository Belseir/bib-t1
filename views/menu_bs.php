<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <title>BASES PWD</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js" integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="../public/js/funciones_gral.js"></script>
  <link rel="stylesheet" href="../public/css/style_chat.css" media="all" />
  <link rel="stylesheet" href="../public/css/cust.css">


  <script>
    function cargar(div, desde) {
      $(div).load(desde);
    }
  </script>
  <script>
    function poner_nombre(div, nombre) {
      $(div).text(nombre);
    }
  </script>
  <style>
    pre {
      display: block;
      font-family: arial;
      white-space: pre;
      margin: 2em 0;
    }

    #background {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url('../public/images/b_bkg_3.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: 100%;
      opacity: 0.6;
      filter: alpha(opacity=80);
    }

    .navbar-nav {
      text-align: center;
    }

    .navbar-nav>li {
      float: none;
      display: inline-block;
    }

    .navbar-right>li {
      text-align: center;
      float: none !important;
      display: inline-block;
    }
  </style>
</head>

<body style="padding: 0px 0px 0px 0px;">
  <div id="background"></div>
  <div class="container-fluid">

    <nav class="navbar navbar-inverse navbar-static-top navbar2" role="navigation">

      <ul class="nav navbar-nav">
        <li><a href="index.php"><span><img class="navbar-logo" src="../public/images/logo.png" height=50></span></a></li>
        <li><a href="cartelera.php">Cartelera</a></li>
        <li><a href="abm_ld.php">Libros</a></li>
        <li><a href="ayuda.php">Ayuda</a></li>

        <?php
        if (isset($_SESSION['username']) && $_SESSION['rol'] == 'administrador') {
          echo '<li><a href="abm_p.php">Usuarios</a></li>';
          echo '<li><a href="abm_c.php">Carteles</a></li>';
          echo '<li><a href="loans.php">Prestamos</a></li>';
        }
        ?>


      </ul>
      <ul class="nav navbar-nav navbar-right" style="padding-right: 10px;">

        <?php
        if (isset($_SESSION['username'])) {
          echo ' <li class="navbar-brand">' . $_SESSION['rol'] . ' : ' . $_SESSION['username'] . '</li>';
        }
        ?>


        <?php
        if (!isset($_SESSION['username'])) {
          echo '	  
	        <li><a href="registro.php"  data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-user"></span> Registro</a></li>
             ';
          echo '	  
	        <li><a href="login.php" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
             ';
        } else {
          echo '	  
		    <li><a href="i_chat.php">Chat</a></li>
	        <li><a href="../authentication/logout.php" ><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
             ';
        }
        ?>
      </ul>




    </nav>






    <!-- Modal -->

    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
          </div>
          <div class="modal-body">
            <p></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>



  </div>

</body>