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
    <title>Lista Funcionario</title>
    <link rel="shortcut icon" href="logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="style.css" />
    
  </head>
<body>
<?php
    include "MenuLateralOficialDono.php";
    $Funcionarios = $estacionamento ->ListaFuncionarios($_SESSION['ID_Estacionamento']);
?>
 
      <div id="tabela">
<table class="table table-hover">
        <thead>
          <tr>
          <th scope="col">Nome</th>
          <th scope="col">Email</th>
          <th scope="col">Senha</th>
          </tr>
        </thead>
        <tbody>
        <?php
                    foreach ($Funcionarios  as $Funcionario):
                ?>
                    <tr>
                        <td><?=$Funcionario['nome']?></td>
                        <td><?=$Funcionario['email']?></td>
                        <td><?=$Funcionario['senha']?></td>
                    </tr>
                <?php endforeach  ?>
        </tbody>
      </table>
                    </div>
                    </main>
</body>
</html>