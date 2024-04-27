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


                        <div class="form-group col-md-1">
                            <label for="deuda">Deuda:</label>
                            <input type="text" class="form-control" id="deuda" name="deuda" readonly style="background-color: #f2f2f2;">
                        </div>



                        <div class="form-group col-md-1">
                        <label for="kilos">Kilos:</label>
                        <input type="text" class="form-control" id="kilos" name="kilos">
                        </div>
                        <div class="form-group col-md-1">
                        <label for="piezas">Piezas:</label>
                        <input type="text" class="form-control" id="piezas" name="piezas">
                        </div>

                        <div class="form-group col-md-2">
                            <label for="producto">Producto:</label>
                            <input type="text" class="form-control" id="productoInput" name="productoInput">
                            <!-- Contenedor para mostrar los resultados de la búsqueda de productos -->
                            <ul id="resultados_producto" class="list-group"></ul>
                        </div>


                        <div class="form-group col-md-1">
                        <label for="precio">Precio:</label>
                        <input type="text" class="form-control" id="precio" name="precio">
                        </div>
                        <div class="form-group col-md-1">
                        <label for="cajas">Cajas:</label>
                        <input type="text" class="form-control" id="cajas" name="cajas">
                        </div>
                        
                        <div class="form-group col-md-1">
                        <label for="tapas">Tapas:</label>
                        <input type="text" class="form-control" id="tapas" name="tapas">
                        </div>

                        <div class="form-group col-md-2">
                          <label for="metodo_pago">Método de Pago:</label>
                              <select class="form-control" id="metodo_pago">
                                  <option value="Efectivo">Efectivo</option>
                                  <option value="Credito">Crédito</option>
                                  <option value="Transferencia">Transferencia</option>
                              </select>
                      </div>

                      <!-- Campo oculto para almacenar el método de pago seleccionado -->
                      <input type="hidden" id="metodo_pago_seleccionado_hidden" name="metodo_pago_seleccionado_hidden">

                    </div>
                    <button type="button" class="btn btn-primary" onclick="agregar()">Agregar</button>
                    </form>

                <!-- Tabla para mostrar los datos ingresados -->
                <!-- Tabla para mostrar los datos ingresados -->
                <table class="table mt-4" id="tabla">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Dirección</th>
                            <th>Kilos</th>
                            <th>Piezas</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Subtotal</th> <!-- Nueva columna para el subtotal -->
                            <th>Cajas</th>
                            <th>Tapas</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aquí se agregarán las filas dinámicamente -->
                    </tbody>
                </table>

                <!-- Deuda Anterior y Total -->
                <!-- Deuda Anterior y Total -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-white">
                            <div class="card-body">

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Método de pago seleccionado:</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="metodo_pago_seleccionado" readonly>
                                </div>
                            </div>

                                <div class="form-group row">
                                    <label for="subtotal_venta" class="col-md-2 col-form-label">Subtotal de Venta:</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" id="subtotal_venta" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="deuda_anterior" class="col-md-2 col-form-label">Deuda Anterior:</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" id="deuda_anterior" readonly>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="total" class="col-md-2 col-form-label">Total:</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" id="total" readonly>
                                    </div>
                                </div>

                                <!-- Botón de Cobrar -->
                                  <div class="form-group row">
                                      <div class="col-md-6 offset-md-2">
                                          <button type="button" class="btn btn-primary" onclick="cobrar()">Cobrar</button>
                                      </div>
                                  </div>


                              </div>
                        </div>
                    </div>
                </div>



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
    $('#resultados').on('click', 'li', function() {
      // Obtener el nombre y la dirección del cliente seleccionado
      var nombreDireccion = $(this).text().split(' - ');
      var nombre = nombreDireccion[0];
      var direccion = nombreDireccion[1];
      var idCliente = $(this).data('id'); // Obtener el ID del cliente

      // Establecer el nombre y la dirección en los campos correspondientes
      $('#cliente').val(nombre);
      $('#direccion').text(direccion); // Establecer la dirección en el div

      // Realizar una nueva solicitud AJAX para obtener la cantidad de deuda del cliente
      $.ajax({
        url: 'obtener_deuda.php', // Ruta al script PHP para obtener la deuda
        type: 'GET',
        data: { idCliente: idCliente }, // Enviar el ID del cliente como parámetro
        dataType: 'json',
        success: function(response) {
          // Establecer la cantidad de deuda en el campo correspondiente
          $('#deuda').val(response.cantidad_deuda);

          // Establecer la deuda anterior en el campo correspondiente
          $('#deuda_anterior').val(response.cantidad_deuda);
        }
      });

      // Limpiar los resultados de la búsqueda
      $('#resultados').empty();
    });
  });

  // Función para agregar una nueva fila a la tabla
  function agregar() {
    // Obtener los valores del formulario
    var cliente = document.getElementById('cliente').value;
    var direccion = document.getElementById('direccion').textContent;
    var kilos = parseFloat(document.getElementById('kilos').value);
    var piezas = parseFloat(document.getElementById('piezas').value);
    var producto = document.getElementById('productoInput').value;
    var precio = parseFloat(document.getElementById('precio').value);
    var cajas = parseFloat(document.getElementById('cajas').value);
    var tapas = parseFloat(document.getElementById('tapas').value);

    // Obtener el método de pago seleccionado
    var metodoPagoSeleccionado = document.getElementById('metodo_pago').value;

    // Establecer el método de pago seleccionado en el campo oculto
    document.getElementById('metodo_pago_seleccionado_hidden').value = metodoPagoSeleccionado;

    // Actualizar el campo de texto para mostrar el método de pago seleccionado
    document.getElementById('metodo_pago_seleccionado').value = metodoPagoSeleccionado;

    // Buscar si ya existe una fila con el mismo producto
    var table = document.getElementById('tabla');
    var existeProducto = false;
    var subtotalAnterior = 0;

    for (var i = 1; i < table.rows.length; i++) {
        var row = table.rows[i];
        var nombreProducto = row.cells[4].innerHTML;

        if (nombreProducto === producto) {
            // Sumar los valores relevantes a la fila existente
            row.cells[2].innerHTML = (parseFloat(row.cells[2].innerHTML) + kilos).toFixed(2); // Sumar kilos
            row.cells[3].innerHTML = (parseFloat(row.cells[3].innerHTML) + piezas).toFixed(2); // Sumar piezas
            row.cells[7].innerHTML = (parseFloat(row.cells[7].innerHTML) + cajas).toFixed(2); // Sumar cajas
            row.cells[8].innerHTML = (parseFloat(row.cells[8].innerHTML) + tapas).toFixed(2); // Sumar tapas
            subtotalAnterior = parseFloat(row.cells[6].innerHTML); // Obtener subtotal anterior
            var subtotal = (kilos * precio).toFixed(2); // Calcular subtotal
            row.cells[6].innerHTML = (subtotalAnterior + parseFloat(subtotal)).toFixed(2); // Actualizar subtotal
            existeProducto = true;
            break;
        }
    }

    // Si el producto no existe en la tabla, agregar una nueva fila
    if (!existeProducto) {
        // Calcular subtotal
        var subtotal = (kilos * precio).toFixed(2);

        // Crear una nueva fila en la tabla con los datos del formulario
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
        cells[1].innerHTML = direccion;
        cells[2].innerHTML = kilos.toFixed(2);
        cells[3].innerHTML = piezas.toFixed(2);
        cells[4].innerHTML = producto;
        cells[5].innerHTML = precio.toFixed(2);
        cells[6].innerHTML = subtotal; // Mostramos el subtotal en la tabla
        cells[6].className = 'subtotal'; // Agregar la clase 'subtotal' a la celda del subtotal
        cells[7].innerHTML = cajas.toFixed(2);
        cells[8].innerHTML = tapas.toFixed(2);

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

    // Limpiar campos de búsqueda y de entrada del formulario de producto
    document.getElementById('kilos').value = '';
    document.getElementById('piezas').value = '';
    document.getElementById('productoInput').value = '';
    document.getElementById('precio').value = '';
    document.getElementById('cajas').value = '';
    document.getElementById('tapas').value = '';
    $('#resultados_producto').empty();

    // Calcular y actualizar el subtotal de venta
    calcularSubtotalVenta();
  }

  // Función para eliminar una fila de la tabla
  function eliminar(row) {
    var confirmacion = confirm("¿Estás seguro de que deseas cancelar este producto?");
    if (confirmacion) {
      var rowIndex = row.parentNode.parentNode.rowIndex;
      document.getElementById('tabla').deleteRow(rowIndex);
      // Calcular y actualizar el subtotal de venta después de eliminar una fila
      calcularSubtotalVenta();
    }
  }

  // Función para calcular y mostrar la suma en tiempo real del subtotal de venta
  function calcularSubtotalVenta() {
    var subtotalVenta = 0;
    $('.subtotal').each(function() {
      subtotalVenta += parseFloat($(this).text());
    });
    $('#subtotal_venta').val(subtotalVenta.toFixed(2));
    
    // Obtener el valor de la deuda anterior
    var deudaAnterior = parseFloat($('#deuda_anterior').val());

    // Calcular el total sumando el subtotal de venta y la deuda anterior
    var total = subtotalVenta + deudaAnterior;

    // Actualizar el campo de Total con el nuevo valor
    $('#total').val(total.toFixed(2));
  }
</script>

</body>
</html>
