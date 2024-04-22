<?php
include 'menu.php'; // Incluir el menú
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Distribuidora González | Mostrador</title>
  <!-- Bootstrap 4 CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Contenido Principal. Contiene el contenido de la página -->
  <div class="content-wrapper">
    <!-- Contenido Principal -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- Contenedor Blanco -->
            <br>
            <div class="card card-white">
              <div class="card-header">
                <h3 class="card-title" id="title">Mostrador</h3>
              </div>
              <div class="card-body">
                <!-- Formulario para agregar clientes -->
                <form id="formulario">
                    <div class="form-row">

                    <div class="form-group col-md-2">
                          <label for="cliente">Cliente:</label>
                          <input type="text" class="form-control" id="cliente" name="cliente">

                          <!-- Aquí se mostrarán los resultados de la búsqueda -->
                          <ul id="resultados" class="list-group"></ul>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="direccion">Dirección:</label>
                            <div id="direccion" class="form-control" style="background-color: #f2f2f2;"></div>
                        </div>


                        <div class="form-group col-md-2">
                        <label for="deuda">Deuda Cliente:</label>
                        <input type="text" class="form-control" id="deuda" name="deuda">
                        </div>


                        <div class="form-group col-md-2">
                        <label for="kilos">Kilos:</label>
                        <input type="text" class="form-control" id="kilos" name="kilos">
                        </div>
                        <div class="form-group col-md-2">
                        <label for="piezas">Piezas:</label>
                        <input type="text" class="form-control" id="piezas" name="piezas">
                        </div>

                        <div class="form-group col-md-2">
                            <label for="producto">Producto:</label>
                            <input type="text" class="form-control" id="productoInput" name="productoInput">
                            <!-- Contenedor para mostrar los resultados de la búsqueda de productos -->
                            <ul id="resultados_producto" class="list-group"></ul>
                        </div>


                        <div class="form-group col-md-2">
                        <label for="precio">Precio:</label>
                        <input type="text" class="form-control" id="precio" name="precio">
                        </div>
                        <div class="form-group col-md-2">
                        <label for="cajas">Cajas:</label>
                        <input type="text" class="form-control" id="cajas" name="cajas">
                        </div>
                        <div class="form-group col-md-2">
                        <label for="tapas">Tapas:</label>
                        <input type="text" class="form-control" id="tapas" name="tapas">
                        </div>
                        <div class="form-group col-md-3">
                        <label for="metodo_pago">Método de Pago:</label>
                        <select class="form-control" id="metodo_pago" name="metodo_pago">
                            <option>Selecciona el metodo de pago</option>
                            <option value="decontado">Decontado</option>
                            <option value="a credito">A credito</option>
                            <option value="transferencia">Transferencia</option>
                        </select>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="agregar()">Agregar</button>
                    </form>

                <!-- Tabla para mostrar los datos ingresados -->
                <table class="table mt-4" id="tabla">
                  <thead>
                    <tr>
                      <th>Cliente</th>
                      <th>Deuda Cliente</th>
                      <th>Kilos</th>
                      <th>Piezas</th>
                      <th>Producto</th>
                      <th>Precio</th>
                      <th>Cajas</th>
                      <th>Tapas</th>
                      <th>Método de Pago</th>
                      <th>Acción</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Aquí se agregarán las filas dinámicamente -->
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Bootstrap 4 JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <script src="../js/mostrador.js"></script>

  <!-- JavaScript para manejar la adición de datos a la tabla -->

  <script>
    $(document).ready(function() {
        $('#productoInput').on('input', function() {
            var searchTerm = $(this).val();

            // Verificar si el campo de producto está vacío
            if (searchTerm.trim() === '') {
                // Limpiar la lista de resultados si el campo está vacío
                $('#resultados_producto').empty();
                return;
            }

            // Realizar la solicitud AJAX
            $.ajax({
                url: 'busqueda_productos.php', // Ruta al script PHP
                type: 'GET',
                data: { term: searchTerm },
                dataType: 'json',
                success: function(response) {
                    // Limpiar la lista de resultados
                    $('#resultados_producto').empty();

                    // Iterar sobre los resultados y añadirlos a la lista
                    $.each(response, function(index, producto) {
                        $('#resultados_producto').append('<li class="list-group-item" data-id="' + producto.id + '">' + producto.nombre + '</li>');
                    });
                }
            });
        });

        // Manejar el clic en un resultado de búsqueda de producto
        $('#resultados_producto').on('click', 'li', function() {
            // Obtener el nombre del producto seleccionado
            var nombre = $(this).text();

            // Establecer el nombre del producto en el campo correspondiente
            $('#productoInput').val(nombre);

            // Limpiar los resultados de la búsqueda de productos
            $('#resultados_producto').empty();
        });
    });
</script>



  <script>
    $(document).ready(function() {
        $('#cliente').on('input', function() {
            var searchTerm = $(this).val();

            // Verificar si el campo de cliente está vacío
            if (searchTerm.trim() === '') {
                // Limpiar la lista de resultados si el campo está vacío
                $('#resultados').empty();
                return;
            }

            // Realizar la solicitud AJAX
            $.ajax({
                url: 'busqueda_clientes.php', // Ruta al script PHP
                type: 'GET',
                data: { term: searchTerm },
                dataType: 'json',
                success: function(response) {
                    // Limpiar la lista de resultados
                    $('#resultados').empty();

                    // Iterar sobre los resultados y añadirlos a la lista
                    $.each(response, function(index, cliente) {
                        $('#resultados').append('<li class="list-group-item" data-id="' + cliente.id + '">' + cliente.nombre + ' - ' + cliente.direccion + '</li>');
                    });
                }
            });
        });

        // Manejar el clic en un resultado de búsqueda
        // Manejar el clic en un resultado de búsqueda
        $('#resultados').on('click', 'li', function() {
            // Obtener el nombre y la dirección del cliente seleccionado
            var nombreDireccion = $(this).text().split(' - ');
            var nombre = nombreDireccion[0];
            var direccion = nombreDireccion[1];

            // Establecer el nombre y la dirección en los campos correspondientes
            $('#cliente').val(nombre);
            $('#direccion').text(direccion); // Establecer la dirección en el div

            // Limpiar los resultados de la búsqueda
            $('#resultados').empty();
        });


            });
  </script>


  
  <script>

// Función para agregar una nueva fila a la tabla
function agregar() {
    // Obtener los valores del formulario
    var cliente = document.getElementById('cliente').value;
    var deuda = document.getElementById('deuda').value;
    var kilos = document.getElementById('kilos').value;
    var piezas = document.getElementById('piezas').value;
    var producto = document.getElementById('productoInput').value;
    var precio = document.getElementById('precio').value;
    var cajas = document.getElementById('cajas').value;
    var tapas = document.getElementById('tapas').value;
    var metodo_pago = document.getElementById('metodo_pago').value;

    // Crear una nueva fila en la tabla con los datos del formulario
    var table = document.getElementById('tabla');
    var newRow = table.insertRow(table.rows.length);
    var cells = [
        newRow.insertCell(0),
        newRow.insertCell(1),
        newRow.insertCell(2),
        newRow.insertCell(3),
        newRow.insertCell(4),
        newRow.insertCell(5),
        newRow.insertCell(6),
        newRow.insertCell(7),
        newRow.insertCell(8),
        newRow.insertCell(9)
    ];

    cells[0].innerHTML = cliente;
    cells[1].innerHTML = deuda;
    cells[2].innerHTML = kilos;
    cells[3].innerHTML = piezas;
    cells[4].innerHTML = producto;
    cells[5].innerHTML = precio;
    cells[6].innerHTML = cajas;
    cells[7].innerHTML = tapas;
    cells[8].innerHTML = metodo_pago;
    
    // Crear el botón de cancelar
    var cancelarButton = document.createElement("button");
    cancelarButton.className = "btn btn-danger";
    cancelarButton.innerHTML = "Cancelar";
    cancelarButton.onclick = function() {
        eliminar(this);
    };

    // Agregar el botón de cancelar a la última celda de la fila
    cells[9].appendChild(cancelarButton);
}

// Función para eliminar una fila de la tabla
function eliminar(row) {
    var confirmacion = confirm("¿Estás seguro de que deseas cancelar este producto?");
    if (confirmacion) {
        var rowIndex = row.parentNode.parentNode.rowIndex;
        document.getElementById('tabla').deleteRow(rowIndex);
    }
}

  </script>
</body>
</html>
