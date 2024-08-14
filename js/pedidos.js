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
      <input type="text" name="cantidades[]" class="form-control" pattern="[0-9a-zA-Z]*" title="Ingrese una combinación de números y letras">
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
