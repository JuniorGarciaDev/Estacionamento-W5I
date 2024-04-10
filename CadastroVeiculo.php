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
    <title>Cadastro Veiculo</title>
    <link rel="shortcut icon" href="logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
  <?php
        include "MenuLateralOficialDono.php";
        $categorias = $estacionamento -> categorias($_SESSION['ID_Estacionamento']);
        $veiculo = $estacionamento -> CadastrarVeiculo();
        if($veiculo == true){
                echo "<script>alert('Veiculo Inserido com sucesso');window.location.href='VeiculosEstacionados.php';</script>";         
        }
        $horarioAtual = $estacionamento->HorarioSalvadorBahia();
    ?>
    <main
      class="d-flex justify-content-center align-items-center py-4 bg-body-tertiary centro"
    >
      <div class="w-100 n-auto form-container text-center">
        <form action="" method="post">
        <h1 class="h3 mb-3 fw-normal text-secondary">Cadastrar Veiculo</h1>
          <div class="input-group mb-3">
            <input
              name="Placa" 
              type="text"
              class="form-control"
              placeholder="Placa"
              aria-label="Placa"
              required
              aria-describedby="basic-addon1"
            />
          </div>
          <div class="input-group mb-3">
            <input
               name="Entrada"
              value="<?=$horarioAtual?>"
              type="datetime-local"
              class="form-control"
              required
              disabled
              aria-describedby="basic-addon1"
            />
          </div>
          <select
            class="form-select form-select-lg mb-3"
            aria-label="Large select example"
            name="Categoria"
          >
          <option selected required disabled>Selecionar Categoria</option>
            <?php
                foreach ($categorias as $categoria):
            ?>
              <option value="<?=$categoria['id_Categoria']?>"><?=$categoria['nome']?></option>                          
            <?php endforeach  ?>
          </select>
          <button name="Veiculo" class="btn btn-primary w-100 py-2 my-3">
            Inserir Veiculo
          </button>
        </form>
      </div>
    </main>
  </body>
</html>
