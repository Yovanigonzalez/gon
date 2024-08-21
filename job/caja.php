<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Distribuidora González | Mostrador</title>
  <!-- Bootstrap 4 CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="../css/mostrador.css">

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
                  <div class="form-row mb-3">
                    <!-- Campos de Cliente y Dirección -->
                    <div class="form-group col-md-4">
                      <label for="cliente">Cliente</label>
                      <input type="text" class="form-control" id="cliente" placeholder="Ingrese el nombre del cliente">
                      <div id="autocomplete-results" class="autocomplete-results"></div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="direccion">Dirección</label>
                      <input type="text" class="form-control" id="direccion" placeholder="Ingrese la dirección" readonly>
                    </div>
                  </div>
                  
                  <!-- Separador -->
                  <hr>

                  <!-- Sección de Producto, Piezas, Kilos, Precio, Cajas y Tapas -->
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label for="producto">Producto</label>
                      <select class="form-control" id="producto">
                        <option value="" disabled selected>Selecciona un producto</option>
                        <!-- Opciones serán cargadas aquí por JavaScript -->
                      </select>
                    </div>
                    <div class="form-group col-md-1">
                      <label for="piezas">Piezas</label>
                      <input type="number" class="form-control" id="piezas" placeholder="Piezas">
                    </div>
                    <div class="form-group col-md-1">
                      <label for="kilos">Kilos</label>
                      <input type="number" class="form-control" id="kilos" placeholder="Kilos">
                    </div>
                    <div class="form-group col-md-1">
                      <label for="precio">Precio</label>
                      <input type="number" class="form-control" id="precio" placeholder="Precio">
                    </div>
                    <div class="form-group col-md-1">
                      <label for="cajas">Cajas</label>
                      <input type="number" class="form-control" id="cajas" placeholder="Cajas">
                    </div>
                    <div class="form-group col-md-1">
                      <label for="tapas">Tapas</label>
                      <input type="number" class="form-control" id="tapas" placeholder="Tapas">
                    </div>
                    <div class="form-group col-md-3 d-flex align-items-end">
                      <!-- Botón Agregar para Producto, Piezas, Kilos, Precio, Cajas y Tapas -->
                      <button type="submit" class="btn btn-primary w-100">Agregar Producto</button>
                    </div>
                  </div>

                  <!-- Separador -->
                  <hr>

                  <!-- Información del Cliente y Dirección (única fila) -->
                  <div class="mb-3">
                    <label>CLIENTE: <span id="cliente-info"></span></label>
                    <br>
                    <label>DIRECCIÓN: <span id="direccion-info"></span></label>
                  </div>

                  <!-- Tabla para mostrar datos ingresados -->
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Producto</th>
                        <th>Piezas</th>
                        <th>Kilos</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                        <th>Acciones</th> <!-- Columna para acciones -->
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Aquí se agregarán las filas de datos -->
                      <!-- Ejemplo de fila -->
                      <tr>
                        <td>Pollo</td>
                        <td>10</td>
                        <td>5</td>
                        <td>20</td>
                        <td>100</td>
                        <td class="text-center">
                          <!-- Botón de eliminar con icono de basura -->
                          <button type="button" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                          </button>
                        </td>
                      </tr>
                      <!-- Agregar más filas aquí -->
                      <!-- Fila de Totales -->
                      <tr class="total-row">
                        <td colspan="4" class="text-right">Subtotal vendida:</td>
                        <td>100</td>
                        <td></td> <!-- Espacio para la columna de acciones en la fila de subtotal -->
                      </tr>
                      <tr class="total-row">
                          <td colspan="4" class="text-right">Deuda Anterior:</td>
                          <td id="deuda-anterior">0.00</td>
                          <td></td> <!-- Espacio para la columna de acciones en la fila de total -->
                      </tr>

                      <tr class="total-row">
                        <td colspan="4" class="text-right">Nuevo Total:</td>
                        <td>140</td>
                        <td></td> <!-- Espacio para la columna de acciones en la fila de nuevo total -->
                      </tr>
                    </tbody>
                  </table>

                  <!-- Formulario para los campos debajo de la tabla -->
                  <!-- Formulario para los campos debajo de la tabla -->
                  <div class="form-row">
                    <div class="form-group col-md-2">
                      <label for="caja-anterior">Caja Anterior</label>
                      <input type="number" class="form-control" id="caja-anterior" placeholder="Caja Anterior" readonly>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="tapa-anterior">Tapa Anterior</label>
                      <input type="number" class="form-control" id="tapa-anterior" placeholder="Tapa Anterior" readonly>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="caja-enviada">Caja Enviada</label>
                      <input type="number" class="form-control" id="caja-enviada" placeholder="Caja Enviada" readonly>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="tapa-enviada">Tapa Enviada</label>
                      <input type="number" class="form-control" id="tapa-enviada" placeholder="Tapa Enviada" readonly>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="nuevo-total-caja">Nuevo Total Caja</label>
                      <input type="number" class="form-control" id="nuevo-total-caja" placeholder="Nuevo Total Caja" readonly>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="nuevo-total-tapa">Nuevo Total Tapa</label>
                      <input type="number" class="form-control" id="nuevo-total-tapa" placeholder="Nuevo Total Tapa" readonly>
                    </div>
                  </div>


                  <!-- Botón Generar Nota centrado -->
                  <div class="btn-container">
                    <button type="button" class="btn btn-success">Generar Nota</button>
                  </div>

                </form>
              </div>
              <!-- /.card-body -->
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
  <script>
    $(document).ready(function() {
  $.ajax({
    url: 'obtener_productos.php',
    method: 'GET',
    dataType: 'json',
    success: function(data) {
      var select = $('#producto');
      select.empty(); // Limpia el contenido actual
      select.append('<option value="" disabled selected>Selecciona un producto</option>'); // Añadir la opción de marcador de posición
      $.each(data, function(index, item) {
        select.append($('<option></option>').val(item.id).text(item.nombre));
      });
    },
    error: function() {
      alert('Error al cargar los productos');
    }
  });
});

// mostrador.js

$(document).ready(function() {
  // Manejar la búsqueda de clientes
  $('#cliente').on('input', function() {
    var query = $(this).val();
    if (query.length > 2) {
      $.ajax({
        url: 'buscar_clientes.php',
        method: 'GET',
        data: { query: query },
        success: function(data) {
          var results = JSON.parse(data);
          var resultsHtml = '';
          results.forEach(function(cliente) {
            resultsHtml += '<div class="autocomplete-result" data-id="' + cliente.id + '" data-nombre="' + cliente.nombre + '" data-direccion="' + cliente.direccion + '">' + cliente.nombre + '</div>';
          });
          $('#autocomplete-results').html(resultsHtml).show();
        }
      });
    } else {
      $('#autocomplete-results').empty().hide();
    }
  });

  // Manejar la selección de un cliente
  $(document).on('click', '.autocomplete-result', function() {
    var id = $(this).data('id');
    var nombre = $(this).data('nombre');
    var direccion = $(this).data('direccion');
    
    // Actualizar los campos de cliente y dirección
    $('#cliente-info').text(nombre);
    $('#direccion-info').text(direccion);
    $('#direccion').val(direccion);
    $('#cliente').val(nombre);

    // Obtener datos de deuda del cliente
    $.ajax({
      url: 'consultar_deuda.php',
      method: 'GET',
      data: { id_cliente: id },
      success: function(data) {
        var deuda = JSON.parse(data);
        $('#caja-anterior').val(deuda.cantidad_cajas || 0);
        $('#tapa-anterior').val(deuda.cantidad_tapas || 0);
      }
    });

    $('#autocomplete-results').empty().hide();
  });
});

  </script>
</div>
</body>
</html>
