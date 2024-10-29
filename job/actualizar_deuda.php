<?php include 'menu.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distribuidora González | Actualización deudores</title>
    <link rel="stylesheet" href="styles.css">
    
    <style>
    .alert-success {
        border-radius: 50px;
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
        padding: 10px;
        margin-bottom: 15px;
    }

    .alert-danger {
        border-radius: 50px;
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
        padding: 10px;
        margin-bottom: 15px;
    }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <br>
                            <div class="card card-white">
                                <div class="card-header">
                                    <h3 class="card-title" id="title">Actualizar Deuda (Dinero)</h3>
                                </div>
                                <form class="card-body" method="post">
                                    <?php
                                      if (isset($_GET['mensaje_exito'])) {
                                          $mensaje_exito = $_GET['mensaje_exito'];
                                          echo '<div class="alert alert-success">' . $mensaje_exito . '</div>';
                                      } elseif (isset($_GET['mensaje_error'])) {
                                          $mensaje_error = $_GET['mensaje_error'];
                                          echo '<div class="alert alert-danger">' . $mensaje_error . '</div>';
                                      }
                                      ?>
                                    <div class="form-group">
                                        <label for="nombreCliente">Nombre del cliente:</label>
                                        <input type="text" class="form-control" id="nombreCliente" name="nombreCliente"
                                            placeholder="Ingrese el nombre del cliente"
                                            oninput="buscarCliente(this.value)" required>
                                        <div id="resultadoBusqueda"></div>
                                        <input type="hidden" id="idCliente" name="idCliente">
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion">Dirección:</label>
                                        <input type="text" class="form-control" id="direccion" name="direccion"
                                            placeholder="Dirección del cliente" readonly
                                            style="background-color: #f2f2f2;">
                                    </div>
                                    <div class="form-group">
                                        <label for="cantidadDeuda">Deuda del cliente:</label>
                                        <input type="text" class="form-control" id="cantidadDeuda" name="cantidadDeuda"
                                            placeholder="Deuda del cliente" readonly style="background-color: #f2f2f2;">
                                    </div>

                                    <div class="form-group">
                                        <label for="dineroRecibido">Dinero recibido:</label>
                                        <input type="text" class="form-control" id="dineroRecibido"
                                            name="dineroRecibido" placeholder="Ingrese la cantidad de dinero recibido"
                                            required>
                                    </div>
                                    <button type="submit" class="btn btn-primary" id="submitButton">Agregar
                                        Cliente</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    <!-- Bootstrap 4 JS -->
    <!-- Bootstrap 4 JS en caso de fallar la recuperacion solo sera cambiar las llaves ya que el codigi estara en 'exception_job' -->
    
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <script src="../job_js/a.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->
    <script src="../job_js/a2.js"></script>


        <script>
        // Formatea el número con el símbolo de pesos (MXN) para "Deuda del cliente"
        function formatearMonedaMXN(numero) {
            return new Intl.NumberFormat('es-MX', {
                style: 'currency',
                currency: 'MXN'
            }).format(numero);
        }

        // Formatea solo con comas, sin el símbolo de moneda, para "Dinero recibido"
        function formatearNumero(numero) {
            const partes = numero.toString().split(".");
            partes[0] = new Intl.NumberFormat('es-MX').format(partes[0]);
            return partes.join(".");
        }

        function buscarCliente(valor) {
            if (valor.length === 0) {
                $('#resultadoBusqueda').empty();
                return;
            }

            $.ajax({
                url: 'buscar_cliente4.php',
                method: 'GET',
                data: {
                    nombreCliente: valor
                },
                success: function(data) {
                    $('#resultadoBusqueda').html(data);
                }
            });
        }

        function seleccionarCliente(id, nombre, direccion, cantidadDeuda) {
            $('#idCliente').val(id);
            $('#nombreCliente').val(nombre);
            $('#direccion').val(direccion);
            $('#cantidadDeuda').val(formatearMonedaMXN(cantidadDeuda)); // Formato con símbolo de pesos para Deuda
            $('#resultadoBusqueda').empty();

            $('#submitButton').on('click', function(e) {
                e.preventDefault();

                const dineroRecibido = parseFloat($('#dineroRecibido').val().replace(/,/g, '')) || 0;

                $.ajax({
                    url: 'guardar_deuda_actualizada.php',
                    method: 'POST',
                    data: {
                        idCliente: id,
                        dineroRecibido: dineroRecibido,
                        fecha: new Date().toISOString().slice(0, 19).replace('T', ' ')
                    },
                    success: function(response) {
                        window.location.href = '?mensaje_exito=Deuda actualizada exitosamente';
                    },
                    error: function() {
                        window.location.href = '?mensaje_error=Error al actualizar la deuda';
                    }
                });
            });
        }

        // Formatear el campo de dinero recibido mientras el usuario escribe
        $('#dineroRecibido').on('input', function() {
            let valor = $(this).val().replace(/,/g, ''); // Eliminar comas previas
            if (!isNaN(valor) && valor !== '') {
                $(this).val(formatearNumero(valor)); // Formatea solo con comas, conservando el decimal
            }
        });
        </script>

</body>

</html>
