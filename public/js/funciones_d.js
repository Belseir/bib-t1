$(document).ready(function () {
  var consulta;
  //hacemos focus al campo de búsqueda
  $("#txt_b_d").focus();

  $("#btn_b_d").click(function (e) {
    //obtenemos el texto introducido en el campo de búsqueda
    consulta = $("#txt_b_d").val();
    //alert (consulta);
    //hace la búsqueda
    $.ajax({
      type: "POST",
      url: "../models/Libro/busqueda_d.php",
      data: "b=" + consulta,
      dataType: "html",
      beforeSend: function () {
        //imagen de carga
        $("#capa_L").html(
          "<p align='center'><img src='images/ajax-loader.gif' /></p>"
        );
      },
      error: function () {
        alert("error petición ajax");
      },
      success: function (data) {
        $("#capa_L").empty();
        $("#capa_L").append(data);
      },
    });
  });

  //comprobamos si se pulsa una tecla
  $("#txt_b_d").keyup(function (e) {
    if (e.which != 13) return;
    //obtenemos el texto introducido en el campo de búsqueda
    consulta = $("#txt_b_d").val();
    //hace la búsqueda
    $.ajax({
      type: "POST",
      url: "../models/Libro/busqueda_d.php",
      data: "b=" + consulta,
      dataType: "html",
      beforeSend: function () {
        //imagen de carga
        $("#capa_L").html(
          "<p align='center'><img src='images/ajax-loader.gif' /></p>"
        );
      },
      error: function () {
        alert("error petición ajax");
      },
      success: function (data) {
        $("#capa_L").empty();
        $("#capa_L").append(data);
      },
    });
  });
});

function cargar(div, desde) {
  $(div).load(desde);
}

function cargar_pdf(div, desde) {
  var ruta = "../public/libros_d/" + desde;
  $.ajax({
    type: "POST",
    url: "../ver_pdf.php",
    data: { archivo: ruta },
  }).done(function (html) {
    $(div).html(html);
  });
}

function editar(id) {
  $.ajax({
    type: "POST",
    url: "../models/Libro/edit_d.php",
    data: { operacion: "edicion", id_lib: id },
  }).done(function (html) {
    $("#capa_d").html(html);
  });
}

function ver_info(id) {
  $.ajax({
    type: "POST",
    url: "../models/Libro/edit_d.php",
    data: { operacion: "ver", id_lib: id },
  }).done(function (html) {
    $("#capa_d").html(html);
  });
}

function borrar(id) {
  $.ajax({
    type: "POST",
    url: "../models/Libro/edit_d.php",
    data: { operacion: "baja", id_lib: id },
  }).done(function (html) {
    $("#capa_d").html(html);
  });
}

function ver(id) {
  $.ajax({
    type: "POST",
    url: "../models/Libro/edit_d.php",
    data: { operacion: "edicion", id_lib: id },
  }).done(function (html) {
    $("#capa_d").html(html);
  });
}

function upload_pdf() {
  //Funcion encargada de enviar el archivo via AJAX
  $(".upload-msg").text("Cargando...");
  var inputFileImage = document.getElementById("fileToUpload");
  var file = inputFileImage.files[0];
  var data = new FormData();
  data.append("fileToUpload", file);

  $.ajax({
    url: "../subir_pdf_d.php", // Url to which the request is send
    type: "POST", // Type of request to be send, called as method
    data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
    contentType: false, // The content type used when sending data to the server.
    cache: false, // To unable request pages to be cached
    processData: false, // To send DOMDocument or non processed data file it is set to false
    success: function (
      data // A function to be called if request succeeds
    ) {
      $(".upload-msg").html(data);
      window.setTimeout(function () {
        $(".alert-dismissible")
          .fadeTo(500, 0)
          .slideUp(500, function () {
            $(this).remove();
          });
      }, 5000);
    },
  });
}
