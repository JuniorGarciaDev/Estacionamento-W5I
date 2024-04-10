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
    <title>Cadastro Funcionario</title>
    <link rel="shortcut icon" href="logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
  <?php
        include "MenuLateralOficialDono.php";
        $CadastrarFuncionario = $estacionamento->CadastrarFuncionario($_SESSION['ID_Estacionamento']);
    ?>
    <main
      class="d-flex justify-content-center align-items-center py-4 bg-body-tertiary centro"
    >
      <div class="w-100 n-auto form-container text-center">
        <form action="" method="post">
          <h1 class="h3 mb-3 fw-normal text-secondary">Cadastrar Funcionario</h1>
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
              name="Email" 
              type="email"
              class="form-control"
              placeholder="Email"
              aria-label="Email"
              required
              aria-describedby="basic-addon1"
            />
          </div>
          <div class="input-group mb-3">
            <input
              name="Senha"
              type="password"
              class="form-control"
              placeholder="Senha"
              aria-label="Senha"
              required
              aria-describedby="basic-addon1"
            />
          </div>
          <button name="CadastrarFuncionario"  class="btn btn-primary w-100 py-2 my-3">
            Cadastrar Funcionario
          </button>
        </form>
      </div>
    </main>
  </body>
</html>
