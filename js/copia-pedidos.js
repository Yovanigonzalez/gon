function buscarClientes() {
    var input = document.getElementById('cliente');
    var filter = input.value;
    if (filter.length >= 1) { //La longitud de las palabras
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


//Funcion para buscar el producto

$('#producto').on('keyup', function() {
    var searchTerm = $(this).val();
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
                $('#lista-productos').html(listaProductos);
            }
        });
    } else {
        // Si el campo de búsqueda está vacío, vaciar la lista de productos sugeridos
        $('#lista-productos').empty();
    }
});

$(document).on('click', '.producto-sugerido', function() {
    var productoSeleccionado = $(this).text();
    $('#producto').val(productoSeleccionado);
    $('#lista-productos').empty();
});