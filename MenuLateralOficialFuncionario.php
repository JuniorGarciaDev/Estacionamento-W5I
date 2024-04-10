<?php   require_once('Estacionamento.php');
    $estacionamento = new Estacionamento();
    $session = $estacionamento -> inicioSession();
    if($session == false){
        echo "<script>alert('Você precisa logar');window.location.href='login.php';</script>";
    }
    if($_SESSION['dono'] == true){
        echo "<script>alert('Logue na conta do Funcionario');window.location.href='CadastroVeiculoFuncionario.php';</script>";
    }
    $sair = $estacionamento ->sair();

?>
<header>
      <nav class="navbar navbar-light bg-light shadow">
        <div class="container-fluid">
          <span class="navbar-brand mb-0 h1">W5I Estacionamento</span>

          <button
            class="navbar-toggler border-0"
            type="button"
            data-bs-toggle="modal"
            data-bs-target="#exampleModal"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </nav>

      <div
        class="modal true"
        id="exampleModal"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-fullscreen">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">MENU</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <a href="CadastroVeiculoFuncionario.php" class="text-decoration-none text-secondary"
                    >Cadastrar Veiculo</a
                  >
                </li>
                <li class="list-group-item">
                  <a href="VeiculosEstacionadosFuncionario.php" class="text-decoration-none text-secondary"
                    >Veiculos no Estacionamento</a
                  >
                </li>
                <li class="list-group-item">
                  <a href="MostrarVeiculosFuncionario.php" class="text-decoration-none text-secondary"
                    >Lista de Veiculos</a
                  >
                </li>
                <li class="list-group-item">
                  <a href="CategoriaListaFuncionario.php" class="text-decoration-none text-secondary"
                    >Categoria Lista</a
                  >
                </li>
              </ul>
            </div>
            <div class="modal-footer">
            <form action="" method="post">
              <button
                name="sair"
                type="submit"
                class="btn btn-info"
              >
                Sair
              </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </header>