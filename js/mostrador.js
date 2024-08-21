$(document).ready(function() {
  let idClienteSeleccionado = null;
  let totalCajas = 0;
  let totalTapas = 0;

  // Autocompletar cliente
  $('#cliente').on('input', function() {
    const query = $(this).val();
    if (query.length > 2) {
      $.ajax({
        url: 'buscar_clientes.php',
        type: 'GET',
        data: { query: query },
        success: function(data) {
          let items = JSON.parse(data);
          let autocompleteList = $('#autocomplete-list');
          autocompleteList.empty();
          items.forEach(item => {
            autocompleteList.append(`<div class="autocomplete-item" data-id="${item.id}" data-nombre="${item.nombre}" data-direccion="${item.direccion}">${item.nombre} - ${item.direccion}</div>`);
          });
          $('.autocomplete-item').on('click', function() {
            $('#cliente').val($(this).data('nombre'));
            $('#direccion').val($(this).data('direccion'));
            idClienteSeleccionado = $(this).data('id');
            $('#autocomplete-list').empty();
          });
        }
      });
    } else {
      $('#autocomplete-list').empty();
    }
  });

  // Cerrar autocompletar si se hace clic fuera del campo
  $(document).click(function(e) {
    if (!$(e.target).closest('#cliente').length) {
      $('#autocomplete-list').empty();
    }
  });

  // Agregar cliente y obtener datos de deuda, cajas, y tapas
  $('#agregar-cliente').on('click', function() {
    const cliente = $('#cliente').val();
    const direccion = $('#direccion').val();
    if (cliente && direccion && idClienteSeleccionado) {
      $.ajax({
        url: 'obtener_deuda.php',
        type: 'GET',
        data: { id_cliente: idClienteSeleccionado },
        success: function(data) {
          let resultado = JSON.parse(data);
          $('#info-cliente').text(cliente);
          $('#info-direccion').text(direccion);
          $('#deuda-pendiente').text(resultado.cantidad_deuda);

          // Obtener valores de caja y tapa deudora
          $.ajax({
            url: 'obtener_cajas_tapas.php',
            type: 'GET',
            data: { id_cliente: idClienteSeleccionado },
            success: function(data) {
              let datosCajasTapas = JSON.parse(data);
              $('#caja-deudora').val(datosCajasTapas.cantidad_cajas || '0');
              $('#tapa-deudora').val(datosCajasTapas.cantidad_tapas || '0');
              $('#caja-enviada').val(totalCajas);
              $('#tapa-enviada').val(totalTapas);
              actualizarPendientes();
            }
          });

          $('#subtotal-vendido').text('0'); // Actualiza con el subtotal vendido real
          $('#total').text('0'); // Actualiza con el total real
        }
      });
    } else {
      alert('Por favor, complete los campos de Cliente y Dirección.');
    }
  });

  // Cargar productos en el select
  $.ajax({
    url: 'obtener_productos.php',
    type: 'GET',
    success: function(data) {
      let productos = JSON.parse(data);
      let productoSelect = $('#producto');

      productos.forEach(producto => {
        productoSelect.append(new Option(producto.nombre, producto.id));
      });
    }
  });

  // Agregar producto a la venta
  $('#agregar-venta').click(function() {
    const productoId = $('#producto').val();
    const productoNombre = $('#producto option:selected').text();
    const piezas = parseFloat($('#piezas').val()) || 0;
    const kilos = parseFloat($('#kilos').val()) || 0;
    const precio = parseFloat($('#precio').val()) || 0;
    const cajas = parseFloat($('#cajas').val()) || 0;
    const tapas = parseFloat($('#tapas').val()) || 0;

    const subtotal = (kilos * precio).toFixed(2);

    let filaExistente = $(`#tabla-productos tr[data-id="${productoId}"]`);

    if (filaExistente.length) {
      // Si el producto ya existe, actualizar las piezas y kilos
      let piezasExistentes = parseFloat(filaExistente.find('td:eq(1)').text()) || 0;
      let kilosExistentes = parseFloat(filaExistente.find('td:eq(2)').text()) || 0;
      filaExistente.find('td:eq(1)').text(piezasExistentes + piezas);
      filaExistente.find('td:eq(2)').text(kilosExistentes + kilos);
      filaExistente.find('td:eq(4)').text((parseFloat(filaExistente.find('td:eq(2)').text()) * precio).toFixed(2));
    } else {
      // Agregar nueva fila a la tabla
      const nuevaFila = `
        <tr data-id="${productoId}">
          <td>${productoNombre}</td>
          <td>${piezas}</td>
          <td>${kilos}</td>
          <td>${precio.toFixed(2)}</td>
          <td>${subtotal}</td>
          <td><button class="btn btn-danger btn-sm eliminar-producto"><i class="fas fa-trash-alt"></i></button></td>
        </tr>
      `;
      $('#tabla-productos').append(nuevaFila);
    }

    // Actualizar totales de cajas y tapas
    totalCajas += cajas;
    totalTapas += tapas;
    $('#caja-enviada').val(totalCajas.toFixed(0));
    $('#tapa-enviada').val(totalTapas.toFixed(0));

    // Actualizar campos de Caja Pendiente y Tapa Pendiente
    actualizarPendientes();

    // Actualizar subtotal vendido y total
    actualizarTotales();

    // Limpiar campos
    $('#piezas').val('');
    $('#kilos').val('');
    $('#precio').val('');
    $('#cajas').val('');
    $('#tapas').val('');
  });

  // Función para actualizar el subtotal vendido y el total
  function actualizarTotales() {
    let subtotalVendido = 0;
    $('#tabla-productos tr').each(function() {
      const subtotal = parseFloat($(this).find('td:eq(4)').text());
      subtotalVendido += subtotal;
    });

    $('#subtotal-vendido').text(subtotalVendido.toFixed(2));
    const deudaPendiente = parseFloat($('#deuda-pendiente').text()) || 0;
    const total = subtotalVendido + deudaPendiente;
    $('#total').text(total.toFixed(2));
  }

  // Función para actualizar Caja Pendiente y Tapa Pendiente
  function actualizarPendientes() {
    const cajaDeudora = parseInt($('#caja-deudora').val()) || 0;
    const tapaDeudora = parseInt($('#tapa-deudora').val()) || 0;
    const cajaEnviada = parseInt($('#caja-enviada').val()) || 0;
    const tapaEnviada = parseInt($('#tapa-enviada').val()) || 0;

    $('#caja-pendiente').val((cajaDeudora + cajaEnviada).toFixed(0));
    $('#tapa-pendiente').val((tapaDeudora + tapaEnviada).toFixed(0));
  }

  // Actualizar pendientes al cambiar los campos de Caja Enviada y Tapa Enviada
  $('#caja-enviada, #tapa-enviada').on('input', function() {
    actualizarPendientes();
  });

  // Eliminar producto de la tabla
  $('#tabla-productos').on('click', '.eliminar-producto', function() {
    const fila = $(this).closest('tr');
    const cajasEliminadas = parseFloat(fila.find('td:eq(1)').text()) || 0;
    const tapasEliminadas = parseFloat(fila.find('td:eq(2)').text()) || 0;

    totalCajas -= cajasEliminadas;
    totalTapas -= tapasEliminadas;

    $('#caja-enviada').val(totalCajas.toFixed(0));
    $('#tapa-enviada').val(totalTapas.toFixed(0));

    // Actualizar campos de Caja Pendiente y Tapa Pendiente
    actualizarPendientes();

    fila.remove();
    actualizarTotales();
  });
});

