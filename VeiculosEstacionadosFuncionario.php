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
    <title>Veiculo Estacionado</title>
    <link rel="shortcut icon" href="logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="style.css" />
    
  </head>
<body>
<?php
      include "MenuLateralOficialFuncionario.php";
    $veiculosEstacionados = $estacionamento -> VeiculosEstacionados($_SESSION['ID_Estacionamento']);
    if(isset($_REQUEST['Saida'])){
    $confirmarSaida = $estacionamento -> ConfirmarSaida($_REQUEST['Saida']);
        if($confirmarSaida == true){
            echo "<script>alert('Saida Confirmada com sucesso');window.location.href='MostrarVeiculosFuncionario.php';</script>";
        }
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
            <th scope="col">Tempo de Permanencia</th>
            <th scope="col">Confirmar Saida</th>
        </tr>
        </thead>
        <tbody>
        <?php
                    foreach ($veiculosEstacionados  as $veiculo):
                ?>
                    <tr>
                        <td><?=$veiculo['placa']?></td>
                        <td><?=$veiculo['CategoriaNome']?></td>
                        <td><?=$veiculo['entrada']?></td>
                        <td><?=$veiculo['taxa']?></td>
                        <?php
                        $entrada = new DateTime($veiculo['entrada']);
                        $HorarioZonaBA = new DateTimeZone('America/Bahia');
                        $horaAtual = new DateTime('now', $HorarioZonaBA );
                        $horaAtual->modify('-4 hours');
                        $diferenca = $entrada->diff($horaAtual);
                        $horas = $diferenca->h; 
                        $minutos = $diferenca->i; 
                        $dias = $diferenca->days;
                        $diferencaFormatada = " $dias dias, $horas hora e $minutos minutos";

                        $taxaTotal = $estacionamento ->CalcularTaxa($dias,$horas,$veiculo['taxa']);
                        ?>
                        <td><?=$taxaTotal?> R$</td>  
                        <td><?=$veiculo['id_Funcionario']!=null?$estacionamento->FuncionarioNome($veiculo['id_Funcionario']):"Dono"?></td>
                        <td><?=$diferencaFormatada?></td>
                        <td class="acoes">
                        <a href="?Saida=<?=$veiculo['id_Veiculo']?>"  class="btn btn-info">Confirmar Saida</a>
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