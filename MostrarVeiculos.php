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
    <title>Lista Veiculo</title>
    <link rel="shortcut icon" href="logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="style.css" />
    
  </head>
<body>
<?php
    include "MenuLateralOficialDono.php";
    $veiculos = $estacionamento -> MostrarVeiculos($_SESSION['ID_Estacionamento']);
    if(isset($_REQUEST['Excluir'])){
        $deletar =$estacionamento->Deletar($_REQUEST['Excluir']);
    }
?>
 
      <div id="tabela">
<table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Placa</th>
            <th scope="col">Categoria</th>
            <th scope="col">Entrada</th>
            <th scope="col">Saida</th>
            <th scope="col">Taxa Paga</th>
            <th scope="col">Funcionario</th>
            <th scope="col">Diferença</th>
            <th scope="col">Açoes</th>
        </tr>
        </thead>
        <tbody>
        <?php
                    foreach ($veiculos as $veiculo):
                        if($veiculo['saida'] != null){
                ?>
                    <tr>
                        <td><?=$veiculo['placa']?></td>
                        <td><?=$veiculo['CategoriaNome']?></td>
                        <td><?=$veiculo['entrada']?></td>
                        <td><?=$veiculo['saida']?></td>
                        
                        <?php if($veiculo['saida'] != null){
                        $entrada = new DateTime($veiculo['entrada']);
                        $saida = new DateTime($veiculo['saida']);
                        $diferenca = $entrada->diff($saida);
                        $horas = $diferenca->h; 
                        $minutos = $diferenca->i; 
                        $dias = $diferenca->days;
                        $taxaPaga = $estacionamento ->CalcularTaxa($dias,$horas,$veiculo['taxa']);
                        $diferencaFormatada = " $dias dias, $horas hora e $minutos minutos";
                        }else{
                            $diferencaFormatada = "Saida não informada";
                        }?>
                        <td><?=$taxaPaga?>R$</td>
                        <td><?=$veiculo['id_Funcionario']!=null?$estacionamento->FuncionarioNome($veiculo['id_Funcionario']):"Dono"?></td>
                        <td><?=$diferencaFormatada?></td>
                        <td class="acoes">
                            <a href="?Excluir=<?=$veiculo['id_Veiculo'];?>" class="btn btn-danger">
                            Excluir
                            </a>
                            <a href="EditarVeiculo.php?id=<?=$veiculo['id_Veiculo'];?>" class="btn btn-success" >
                            Editar
                        </a>
                        </td>
                    </tr>
                <?php }endforeach  ?>
        </tbody>
      </table>
                    </div>
                    </main>
</body>
</html>