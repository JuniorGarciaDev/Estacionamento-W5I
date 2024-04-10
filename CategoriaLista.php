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
    <title>Categoria Lista</title>
    <link rel="shortcut icon" href="logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="style.css" />
    
  </head>
<body>
<?php
    include "MenuLateralOficialDono.php";
    $categorias = $estacionamento -> categorias($_SESSION['ID_Estacionamento']);
    if(isset($_REQUEST['Excluir'])){
        $excluir = $estacionamento -> DeletarCategoria($_REQUEST['Excluir']);
    }
?>
 
      <div id="tabela">
<table class="table table-hover">
        <thead>
          <tr>
          <th scope="col">Nome</th>
          <th scope="col">Taxa</th>
          <th scope="col">Vagas</th>
          <th scope="col">Vagas Ocupadas</th>
          <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
        <?php
                    foreach ($categorias  as $categoria):
                ?>
                    <tr>
                        <td><?=$categoria['nome']?></td>
                        <td><?=$categoria['taxa']?></td>
                        <td><?=$categoria['QuantidadeVeiculo']?></td>
                        <?php $vagasOcupadas = $estacionamento->CountCategoria($categoria['id_Categoria']);?>
                        <td><?=$vagasOcupadas?></td>
                        <td class="acoes">
                            <a href="?Excluir=<?=$categoria['id_Categoria'];?>" class="btn btn-danger">
                            Excluir
                            </a>
                            <a href="EditarCategoria.php?id=<?=$categoria['id_Categoria'];?>" class="btn btn-success" >
                            Editar
                        </a>
                        </td>
                    </tr>
                    <?php endforeach  ?>
        </tbody>
      </table>
                    </div>
                    </main>
</body>
</html>