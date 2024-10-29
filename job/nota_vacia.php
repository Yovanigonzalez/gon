<?php include 'menu.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Distribuidora González | Descargar nota vacía</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .note-card {
      border: 1px solid #ddd;
      padding: 15px;
      margin: 10px;
      border-radius: 5px;
      background-color: #f9f9f9;
      width: 200px;
      text-align: center;
    }
    .note-card h4 {
      font-size: 16px;
      margin-bottom: 10px;
    }
    .note-card p {
      font-size: 14px;
      margin-bottom: 15px;
    }
    .note-card button {
      margin: 5px;
      font-size: 14px;
      padding: 5px 10px;
    }
    .notes-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: flex-start;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <br>
            <div class="card card-white">
              <div class="card-header">
                <h3 class="card-title" id="title">Descargar nota vacía</h3>
              </div>
              <div class="card-body">
                <a href="descargar_nota_vacia" class="btn btn-primary">Descargar nota vacía</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

    <!-- Bootstrap 4 JS -->
    <!-- Bootstrap 4 JS en caso de fallar la recuperacion solo sera cambiar las llaves ya que el codigi estara en 'exception_job' -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <script src="../job_js/a.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->
    <script src="../job_js/a2.js"></script>

</body>
</html>

