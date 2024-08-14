<?php
include 'menu.php'; // Incluir el menú

// Obtener la fecha actual en GMT-6
date_default_timezone_set('America/Mexico_City'); // Ajusta la zona horaria según GMT-6
$fecha_actual = date('Y-m-d'); // Fecha actual en formato YYYY-MM-DD
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Distribuidora González | Agregar Pedidos</title>
  <style>
    .alert-success {
      border-radius: 50px;
      color: #155724;
      background-color: #d4edda;
      border-color: #c3e6cb;
    }

    .alert-danger {
      border-radius: 50px;
      color: #721c24;
      background-color: #f8d7da;
      border-color: #f5c6cb;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Contenido Principal. Contiene el contenido de la página -->
  <div class="content-wrapper">
    <!-- Contenido Principal -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <!-- Contenedor Blanco -->
            <br>
            <div class="card card-white">
              <div class="card-header">
                <h3 class="card-title" id="title">Agregar Pedidos</h3>
              </div>
              <!-- Formulario para agregar pedidos -->
              <form class="card-body" action="procesar_pedido.php" method="post">

              <?php
                // Verificar si se ha pasado un mensaje de éxito o un error a través de la URL
                if (isset($_GET['mensaje'])) {
                    $mensaje = $_GET['mensaje'];
                    echo "<div class='alert alert-success'>$mensaje</div>";
                } elseif (isset($_GET['error'])) {
                    $error = $_GET['error'];
                    echo "<div class='alert alert-danger'>$error</div>";
                }
                ?>

                <div class="form-group">
                  <label for="cliente">Cliente:</label>
                  <input type="text" id="cliente" name="cliente" class="form-control" oninput="buscarClientes()">
                  <div id="lista-clientes"></div>
                </div>
                <div class="form-group">
                  <label for="direccion">Dirección:</label>
                  <input type="text" id="direccion" name="direccion" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label for="fecha">Fecha:</label>
                  <input type="date" id="fecha" name="fecha" class="form-control" required min="<?php echo $fecha_actual; ?>">
                </div>
                <div id="productos">
                  <!-- Aquí se agregarán dinámicamente los campos de productos -->
                </div>
                <button type="button" class="btn btn-primary" onclick="agregarProducto()">Agregar Producto</button>
                <button type="submit" class="btn btn-primary">Agregar Pedido</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Bootstrap 4 JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <script src="../js/pedidos.js"></script>

  <script>
    function buscarClientes() {
  var input = document.getElementById('cliente');
  var filter = input.value;
  if (filter.length >= 1) { // La longitud de las palabras
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              document.getElementById("lista-clientes").innerHTML = this.responseText;
          }
      };
      xmlhttp.open("GET", "buscar_clientes.php?q=" + filter, true);
      xmlhttp.send();
  } else {
      document.getElementById("lista-clientes").innerHTML = "";
  }
}

// Función para seleccionar un cliente de la lista y copiar su nombre y dirección
function seleccionarCliente(id, nombre, direccion) {
  document.getElementById('cliente').value = nombre;
  document.getElementById('direccion').value = direccion;
  document.getElementById('lista-clientes').innerHTML = ""; // Limpiar la lista de resultados
}

// Función para agregar eventos de clic a los elementos de la lista de productos sugeridos
function agregarEventoSeleccionProductos(productoInput) {
  $('.producto-sugerido').click(function() {
    // Obtener el nombre del producto seleccionado
    var productoSeleccionado = $(this).text();
    // Actualizar el valor del campo de producto con el producto seleccionado
    $(productoInput).val(productoSeleccionado);
    // Limpiar la lista de productos sugeridos
    $(this).closest('.form-group').find('.lista-productos').empty();
  });
}

// Función para agregar productos
function agregarProducto() {
  var productosDiv = document.getElementById('productos');
  var nuevoProducto = document.createElement('div');
  nuevoProducto.innerHTML = `
    <div class="form-group">
      <label for="producto">Producto:</label>
      <input type="text" id="producto" name="productos[]" class="form-control producto" required>
      <!-- Lista de productos sugeridos -->
      <div class="lista-productos"></div>
    </div>
<div class="form-group">
  <label for="cantidad">Cantidad:</label>
  <input type="text" name="cantidades[]" class="form-control" required title="Ingrese texto alfanumérico">
</div>
  `;
  productosDiv.appendChild(nuevoProducto);

  // Agregar función de búsqueda de productos al campo de producto recién creado
  var productoInput = nuevoProducto.querySelector('.producto');
  productoInput.addEventListener('keyup', function() {
    var searchTerm = this.value;
    // Verificar si el campo de búsqueda no está vacío antes de realizar la solicitud AJAX
    if (searchTerm.trim() !== '') {
      $.ajax({
        url: 'buscar_productos.php',
        method: 'POST',
        data: { searchTerm: searchTerm },
        success: function(response) {
          var productos = JSON.parse(response);
          var listaProductos = '';
          productos.forEach(function(producto) {
            listaProductos += '<div class="producto-sugerido">' + producto.nombre + '</div>';
          });
          $(productoInput).closest('.form-group').find('.lista-productos').html(listaProductos);
          // Agregar eventos de clic a los nuevos elementos de la lista de productos sugeridos
          agregarEventoSeleccionProductos(productoInput);
        }
      });
    } else {
      // Si el campo de búsqueda está vacío, vaciar la lista de productos sugeridos
      $(productoInput).closest('.form-group').find('.lista-productos').empty();
    }
  });

  // Agregar eventos de clic a los elementos de la lista de productos sugeridos
  agregarEventoSeleccionProductos(productoInput);
}

  </script>
  
  <!-- Script para la búsqueda en tiempo real de productos -->
</body>
</html>
