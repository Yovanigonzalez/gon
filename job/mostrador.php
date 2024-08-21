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
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="../css/mostrador.css">
  <style>
    .table-custom {
      background-color: #f0f8ff;
      border: 1px solid #d1e0e0;
      border-radius: 4px;
      overflow: hidden;
    }
    .table-custom thead th {
      background-color: #007bff;
      color: white;
      text-align: center;
    }
    .table-custom tbody tr:nth-child(even) {
      background-color: #e7f0ff;
    }
    .table-custom tbody td, .table-custom thead th {
      text-align: center;
    }
    .table-custom tfoot tr {
      font-weight: bold;
    }
    .table-custom tfoot td {
      background-color: #e7f0ff;
    }
    .btn-icon {
      display: flex;
      align-items: center;
    }
    .btn-icon i {
      margin-right: 5px;
    }
    .text-center {
      text-align: center;
    }
    .btn-container {
      display: flex;
      justify-content: center;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Contenido Principal -->
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
                <!-- Campos en una misma fila -->
                <div class="form-row mb-3">
                  <div class="form-group col-md-4">
                    <label for="cliente">Cliente</label>
                    <input type="text" id="cliente" class="form-control" placeholder="Escriba el nombre del cliente">
                    <div id="autocomplete-list" class="autocomplete-items"></div>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="direccion">Dirección</label>
                    <input type="text" id="direccion" class="form-control" readonly>
                  </div>
                  <div class="form-group col-md-4 d-flex align-items-end">
                    <button id="agregar-cliente" class="btn btn-primary">Agregar Cliente Envío</button>
                  </div>
                </div>

                <hr>

                <!-- Campos para agregar productos en una misma fila -->
                <div class="form-row mb-3">
                  <div class="form-group col-md-4">
                    <label for="producto">Producto</label>
                    <select id="producto" class="form-control">
                      <option value="">Seleccione un producto</option>
                    </select>
                  </div>

                  <div class="form-group col-md-1">
                    <label for="piezas">Piezas</label>
                    <input type="number" id="piezas" class="form-control">
                  </div>
                  <div class="form-group col-md-1">
                    <label for="kilos">Kilos</label>
                    <input type="number" id="kilos" class="form-control">
                  </div>
                  <div class="form-group col-md-1">
                    <label for="precio">Precio</label>
                    <input type="number" id="precio" class="form-control">
                  </div>
                  <div class="form-group col-md-3 d-flex align-items-end">
                    <button id="agregar-venta" class="btn btn-success">Agregar a Venta</button>
                  </div>
                </div>

                <hr>

                <!-- Información del cliente y tabla -->
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label>Cliente: <span id="info-cliente"></span></label> <br>
                    <label>Dirección: <span id="info-direccion"></span></label>
                    <div class="table-responsive">
                      <table class="table table-custom">
                        <thead>
                          <tr>
                            <th>Producto</th>
                            <th>Piezas</th>
                            <th>Kilos</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                          </tr>
                        </thead>
                        <tbody id="tabla-productos">
                          <!-- Filas de productos serán añadidas aquí -->
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="4">Subtotal vendido</td>
                            <td id="subtotal-vendido">0.00</td>
                            <td></td>
                          </tr>
                          <tr>
                            <td colspan="4">Deuda Pendiente</td>
                            <td id="deuda-pendiente">0.00</td>
                            <td></td>
                          </tr>
                          <tr>
                            <td colspan="4">Total</td>
                            <td id="total">0.00</td>
                            <td></td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>

                <!-- Campos adicionales en una misma fila -->
                <div class="form-row mb-4">
                  <div class="form-group col-md-2">
                    <label for="caja-deudora">Caja Deudora</label>
                    <input type="text" id="caja-deudora" class="form-control" readonly>
                  </div>
                  <div class="form-group col-md-2">
                    <label for="tapa-deudora">Tapa Deudora</label>
                    <input type="text" id="tapa-deudora" class="form-control" readonly>
                  </div>
                  <div class="form-group col-md-2">
                    <label for="caja-enviada">Caja Enviada</label>
                    <input type="number" id="caja-enviada" class="form-control">
                  </div>
                  <div class="form-group col-md-2">
                    <label for="tapa-enviada">Tapa Enviada</label>
                    <input type="number" id="tapa-enviada" class="form-control">
                  </div>
                  <div class="form-group col-md-2">
                    <label for="caja-pendiente">Caja Pendiente</label>
                    <input type="text" id="caja-pendiente" class="form-control" readonly>
                  </div>
                  <div class="form-group col-md-2">
                    <label for="tapa-pendiente">Tapa Pendiente</label>
                    <input type="text" id="tapa-pendiente" class="form-control" readonly>
                  </div>
                </div>

                <!-- Botón Generar Nota centrado -->
                <div class="form-row mb-4">
                  <div class="form-group col-md-12 btn-container">
                    <button id="generar-nota" class="btn btn-primary btn-icon">
                      <i class="fas fa-file-alt"></i> Generar Nota
                    </button>
                  </div>
                </div>

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
  <script src="../js/mostrador.js"></script>
</div>
</body>
</html>






