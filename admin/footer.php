<footer class="main-footer">
  <!-- A la derecha -->
  <div class="float-right d-none d-sm-inline" id="year">
    <!-- El año se actualizará aquí -->
  </div>
  <!-- Por defecto, a la izquierda -->
  <strong>Punto de venta 'Distribuidora Gonzalez'</strong>
</footer>

<!-- Script para actualizar el año -->
<script>
  // Función para obtener el año actual
  function getYear() {
    return new Date().getFullYear();
  }

  // Función para actualizar el año en la página
  function updateYear() {
    var yearElement = document.getElementById('year');
    if (yearElement) {
      yearElement.textContent = getYear();
    }
  }

  // Actualizar el año al cargar la página
  updateYear();

  // Actualizar el año cada segundo
  setInterval(updateYear, 1000);
</script>
