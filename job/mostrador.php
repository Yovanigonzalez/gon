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

      <div>
        <br><br>
      </div>
                  <!-- Deuda Anterior y Total -->
                  <!-- Deuda Anterior y Total -->
                  <div class="row">
      <div class="col-md-6">
          <div class="form-group row">
              <label class="col-md-3 col-form-label">Pago:</label>
              <div class="col-md-6">
                  <input type="text" class="form-control" id="metodo_pago_seleccionado" readonly>
              </div>
          </div>

          <div class="form-group row">
              <label for="subtotal_venta" class="col-md-3 col-form-label">Subtotal:</label>
              <div class="col-md-6">
                  <input type="text" class="form-control" id="subtotal_venta" readonly>
              </div>
          </div>

          <div class="form-group row">
              <label for="deuda_anterior" class="col-md-3 col-form-label">Deuda Anterior:</label>
              <div class="col-md-6">
                  <input type="text" class="form-control" id="deuda_anterior" readonly>
              </div>
          </div>

          <div class="form-group row">
              <label for="total" class="col-md-3 col-form-label">Total:</label>
              <div class="col-md-6">
                  <input type="text" class="form-control" id="total" readonly>
              </div>
          </div>
      </div>

      <div class="col-md-6">
          <div class="form-group row">
              <label for="deuda_caja" class="col-md-3 col-form-label">Pendiente Caja:</label>
              <div class="col-md-6">
                  <input type="text" class="form-control" id="deuda_caja" readonly>
              </div>
          </div>

          <div class="form-group row">
              <label for="deuda_tapa" class="col-md-3 col-form-label">Pendiente Tapa:</label>
              <div class="col-md-6">
                  <input type="text" class="form-control" id="deuda_tapa" readonly>
              </div>
          </div>

          <script>
            // Manejar el clic en un resultado de búsqueda
  $('#resultados').on('click', 'li', function() {
    var idCliente = $(this).data('id'); // Obtener el ID del cliente seleccionado
    var direccionCliente = $(this).text().split(' - ')[1].trim(); // Obtener la dirección del cliente seleccionado

    // Realizar una nueva solicitud AJAX para obtener la deuda de cajas y tapas del cliente
    $.ajax({
      url: 'obtener_deuda_cajas_tapas.php', // Ruta al script PHP para obtener la deuda de cajas y tapas
      type: 'GET',
      data: { idCliente: idCliente, direccionCliente: direccionCliente }, // Enviar el ID del cliente y la dirección como parámetros
      dataType: 'json',
      success: function(response) {
        // Establecer la cantidad de deuda de cajas y tapas en los campos correspondientes
        $('#deuda_caja').val(response.cantidad_cajas);
        $('#deuda_tapa').val(response.cantidad_tapas);
      }
    });
  });

          </script>

          <div class="form-group row">
              <label for="caja_enviada" class="col-md-3 col-form-label">Caja Enviada:</label>
              <div class="col-md-6">
                  <input type="text" class="form-control" id="caja_enviada" readonly>
              </div>
          </div>

          <div class="form-group row">
              <label for="tapa_enviada" class="col-md-3 col-form-label">Tapa Enviada:</label>
              <div class="col-md-6">
                  <input type="text" class="form-control" id="tapa_enviada" readonly>
              </div>
          </div>


          <div class="form-group row">
              <label for="nueva_deuda_caja" class="col-md-3 col-form-label">Deuda de Caja:</label>
              <div class="col-md-6">
                  <input type="text" class="form-control" id="nueva_deuda_caja" readonly>
              </div>
          </div>

          <div class="form-group row">
              <label for="nueva_deuda_tapa" class="col-md-3 col-form-label">Deuda de Tapa:</label>
              <div class="col-md-6">
                  <input type="text" class="form-control" id="nueva_deuda_tapa" readonly>
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
      // Función de búsqueda de productos
      $('#productoInput').on('input', function() {
        var searchTerm = $(this).val();

        if (searchTerm.trim() === '') {
          $('#resultados_producto').empty();
          return;
        }

        $.ajax({
          url: 'busqueda_productos.php',
          type: 'GET',
          data: { term: searchTerm },
          dataType: 'json',
          success: function(response) {
            $('#resultados_producto').empty();
            $.each(response, function(index, producto) {
              $('#resultados_producto').append('<li class="list-group-item" data-id="' + producto.id + '">' + producto.nombre + '</li>');
            });
          }
        });
      });

      $('#resultados_producto').on('click', 'li', function() {
        var nombre = $(this).text();
        $('#productoInput').val(nombre);
        $('#resultados_producto').empty();
      });

      // Función de búsqueda de clientes
      $('#cliente').on('input', function() {
        var searchTerm = $(this).val();

        if (searchTerm.trim() === '') {
          $('#resultados').empty();
          return;
        }

        $.ajax({
          url: 'busqueda_clientes.php',
          type: 'GET',
          data: { term: searchTerm },
          dataType: 'json',
          success: function(response) {
            $('#resultados').empty();
            $.each(response, function(index, cliente) {
              $('#resultados').append('<li class="list-group-item" data-id="' + cliente.id + '">' + cliente.nombre + ' - ' + cliente.direccion + '</li>');
            });
          }
        });
      });

      $('#resultados').on('click', 'li', function() {
        var nombreDireccion = $(this).text().split(' - ');
        var nombre = nombreDireccion[0];
        var direccion = nombreDireccion[1];
        var idCliente = $(this).data('id');

        $('#cliente').val(nombre);
        $('#direccion').text(direccion);

        $.ajax({
          url: 'obtener_deuda.php',
          type: 'GET',
          data: { idCliente: idCliente },
          dataType: 'json',
          success: function(response) {
            $('#deuda').val(response.cantidad_deuda);
            $('#deuda_anterior').val(response.cantidad_deuda);
          }
        });

        $('#resultados').empty();
      });

      // Funciones para cálculos en tiempo real
      function calcularDeudaCaja() {
        var pendienteCaja = parseInt($('#deuda_caja').val()) || 0;
        var cajaEnviada = parseInt($('#caja_enviada').val()) || 0;
        var nuevaDeudaCaja = pendienteCaja + cajaEnviada;
        $('#nueva_deuda_caja').val(nuevaDeudaCaja);
      }

      function calcularDeudaTapa() {
      var pendiente_tapa = parseInt($('#deuda_tapa').val()) || 0;
      var tapa_enviada = parseInt($('#tapa_enviada').val()) || 0;
      var nueva_deuda_tapa = pendiente_tapa + tapa_enviada;
      $('#nueva_deuda_tapa').val(nueva_deuda_tapa);
    }

    // Asignar la función de cálculo a los eventos 'input' de los campos correspondientes
    $('#deuda_tapa, #tapa_enviada').on('input', calcularDeudaTapa);
    

      function calcularSumaTapas() {
        var sumaTapas = 0;
        $('#tabla tr').each(function() {
          var tapas = parseInt($(this).find('td').eq(8).text());
          if (!isNaN(tapas)) {
            sumaTapas += tapas;
          }
        });
        $('#tapa_enviada').val(sumaTapas);
      }

      function calcularSumaCajas() {
        var sumaCajas = 0;
        $('#tabla tr').each(function() {
          var cajas = parseInt($(this).find('td').eq(7).text());
          if (!isNaN(cajas)) {
            sumaCajas += cajas;
          }
        });
        $('#caja_enviada').val(sumaCajas);
      }

      function calcularSubtotalVenta() {
        var subtotalVenta = 0;
        $('.subtotal').each(function() {
          subtotalVenta += parseFloat($(this).text());
        });
        $('#subtotal_venta').val(subtotalVenta.toLocaleString());

        var deudaAnterior = parseFloat($('#deuda_anterior').val()) || 0;
        var total = subtotalVenta + deudaAnterior;
        $('#total').val(total.toLocaleString());
      }

      // Eventos para actualización en tiempo real
      $('#deuda_caja, #caja_enviada').on('input', calcularDeudaCaja);
      $('#pendiente_tapa, #tapa_enviada').on('input', calcularDeudaTapa);
      $('#tabla').on('input', '.cajas, .tapas', function() {
        calcularSumaTapas();
        calcularSumaCajas();
        calcularDeudaCaja();
        calcularDeudaTapa();
      });

      // Función para agregar una nueva fila a la tabla
      window.agregar = function() {
        var cliente = $('#cliente').val();
        var direccion = $('#direccion').text();
        var kilos = parseFloat($('#kilos').val()) || 0;
        var piezas = parseFloat($('#piezas').val()) || 0;
        var producto = $('#productoInput').val();
        var precio = parseFloat($('#precio').val()) || 0;
        var cajas = parseInt($('#cajas').val()) || 0;
        var tapas = parseInt($('#tapas').val()) || 0;
        var metodoPagoSeleccionado = $('#metodo_pago').val();

        $('#metodo_pago_seleccionado_hidden').val(metodoPagoSeleccionado);
        $('#metodo_pago_seleccionado').val(metodoPagoSeleccionado);

        var table = $('#tabla')[0];
        var existeProducto = false;
        var subtotalAnterior = 0;

        for (var i = 1; i < table.rows.length; i++) {
          var row = table.rows[i];
          var nombreProducto = row.cells[4].innerHTML;

          if (nombreProducto === producto) {
            row.cells[2].innerHTML = (parseFloat(row.cells[2].innerHTML) + kilos).toFixed(2);
            row.cells[3].innerHTML = (parseFloat(row.cells[3].innerHTML) + piezas).toFixed(2);
            row.cells[7].innerHTML = (parseInt(row.cells[7].innerHTML) + cajas).toString();
            row.cells[8].innerHTML = (parseInt(row.cells[8].innerHTML) + tapas).toString();
            subtotalAnterior = parseFloat(row.cells[6].innerHTML);
            var subtotal = (kilos * precio).toFixed(2);
            row.cells[6].innerHTML = (subtotalAnterior + parseFloat(subtotal)).toFixed(2);
            existeProducto = true;
            break;
          }
        }

        if (!existeProducto) {
          var subtotal = (kilos * precio).toFixed(2);

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
          cells[6].innerHTML = subtotal;
          cells[6].className = 'subtotal';
          cells[7].innerHTML = cajas.toString();
          cells[8].innerHTML = tapas.toString();

          var cancelarButton = document.createElement("button");
          cancelarButton.className = "btn btn-danger";
          cancelarButton.innerHTML = "Cancelar";
          cancelarButton.onclick = function() {
            eliminar(this);
          };

          cells[9].appendChild(cancelarButton);
        }

        $('#kilos').val('');
        $('#piezas').val('');
        $('#productoInput').val('');
        $('#precio').val('');
        $('#cajas').val('');
        $('#tapas').val('');
        $('#resultados_producto').empty();

        calcularSubtotalVenta();
        calcularSumaTapas();
        calcularSumaCajas();
        calcularDeudaCaja();
        calcularDeudaTapa();
      }

      // Función para eliminar una fila de la tabla
      window.eliminar = function(row) {
        if (confirm("¿Estás seguro de que deseas cancelar este producto?")) {
          var rowIndex = row.parentNode.parentNode.rowIndex;
          document.getElementById('tabla').deleteRow(rowIndex);
          calcularSubtotalVenta();
          calcularSumaTapas();
          calcularSumaCajas();
          calcularDeudaCaja();
          calcularDeudaTapa();
        }
      }
    });
  </script>



  </body>
  </html>
