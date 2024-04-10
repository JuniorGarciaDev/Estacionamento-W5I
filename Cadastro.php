<?php
    require_once('Estacionamento.php');
    $estacionamento = new Estacionamento();
    $cadastro = $estacionamento -> Cadastrar();
    $session = $estacionamento -> inicioSession();
    if($session == true){
        echo "<script>window.location.href='CadastroCategoriaVeiculo.php';</script>";
    }
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="" class="h-100">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
 
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <title>Cadastro</title>
    <link rel="shortcut icon" href="logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body
    class="d-flex justify-content-center align-items-center py-4 bg-body-tertiary h-100 inicio"
  >
    <main class="w-100 n-auto form-container text-center">
      <form action="" method="post">
        <h1 class="h3 mb-3 fw-normal text-light">Cadastro</h1>
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
          namespace
            name="Email"
            type="email"
            class="form-control"
            placeholder="Login"
            aria-label="Login"
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
        <button name="Cadastrar"  class="btn btn-primary w-100 py-2 my-3">Cadastrar</button>
        <p class="d-inline text-white">Não tem conta?</p>
        <a href="login.php" class="link">Logar</a>
      </form>
    </main>
  </body>
</html>
