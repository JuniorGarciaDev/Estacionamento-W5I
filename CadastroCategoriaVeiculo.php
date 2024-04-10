<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Cadastro Categoria</title>
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
  <?php
        include "MenuLateralOficialDono.php";
        $CadastrarCategoria = $estacionamento->CadastrarCategoria($_SESSION['ID_Estacionamento']);
    ?>
    <main
      class="d-flex justify-content-center align-items-center py-4 bg-body-tertiary centro"
    >
      <div class="w-100 n-auto form-container text-center">
        <form action="" method="post">
          <h1 class="h3 mb-3 fw-normal text-secondary">Cadastrar Categoria</h1>
          <div class="input-group mb-3">
            <input
              name="Nome"
              type="text"
              class="form-control"
              placeholder="Nome"
              aria-label="Nome"
              required
              aria-describedby="basic-addon1"
            />
          </div>
          <div class="input-group mb-3">
            <input
              name="Vagas" 
              type="Number"
              class="form-control"
              placeholder="Vaga"
              aria-label="Vaga"
              required
              min="1"
              aria-describedby="basic-addon1"
            />
          </div>
          <div class="input-group mb-3">
            <input
              name="Taxa"
              type="Number"
              class="form-control"
              placeholder="Taxa"
              aria-label="Taxa"
              required
              step="0.01"
              min="0"
              aria-describedby="basic-addon1"
            />
          </div>
          <button name="Inserir"  class="btn btn-primary w-100 py-2 my-3">
            Inserir Categoria
          </button>
        </form>
      </div>
    </main>
  </body>
</html>
