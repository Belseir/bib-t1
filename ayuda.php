<?php
include("menu_bs.php");

include_once("libreria/carteles.php");

echo '
<div class="container-fluid" >

<div class="row">
 
  <div class="col-sm-4">
  <div id="capa_d">
	</div>
    </div>
	<div class="col-sm-8">
	  <div id="capa_C">	
	  
	  </div>
	</div>	
	  
	  </div>
	 
 </div>
 <script>
    cargar("#capa_C","mostrar_cartelera.php?b=Ayuda")
 </script>
';
?>

