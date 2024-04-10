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
    <title>Editar Categoria</title>
    <link rel="shortcut icon" href="logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
  <?php
        include "MenuLateralOficialDono.php";
        if(isset($_REQUEST['id'])){
          $categoriaEspecifica = $estacionamento->CategoriaEspecifica($_REQUEST['id']);
          $editar = $estacionamento ->EditarCategoria($_REQUEST['id']);
          }
    ?>
    <main
      class="d-flex justify-content-center align-items-center py-4 bg-body-tertiary centro"
    >
      <div class="w-100 n-auto form-container text-center">
        <form action="" method="post">
        <h1 class="h3 mb-3 fw-normal text-secondary">Editar Categoria</h1>
          <div class="input-group mb-3">
            <input
              name="Nome"
              value="<?=$categoriaEspecifica['nome']?>"
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
            value="<?=$categoriaEspecifica['QuantidadeVeiculo']?>"
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
              value="<?=$categoriaEspecifica['taxa']?>"
              class="form-control"
              placeholder="Taxa"
              aria-label="Taxa"
              required
              step="0.01"
              min="0"
              aria-describedby="basic-addon1"
            />
          </div>
          <button name="EditarCategoria"  class="btn btn-primary w-100 py-2 my-3">
            Editar Categoria
          </button>
        </form>
      </div>
    </main>
  </body>
</html>
