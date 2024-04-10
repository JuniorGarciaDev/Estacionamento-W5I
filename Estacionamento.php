<?php 

Class Estacionamento {
    private $servidor = "localhost";
    private $usuario = "root";
    private $senha;
    private $banco_de_dados = "estacionamento";
    private $conexao;

    public function __construct(){
        try{
        $this->conexao = new PDO("mysql:host=$this->servidor;dbname=$this->banco_de_dados", $this->usuario, $this->senha);
        $this->conexao -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "A conexão falhou!" . $e->getMessage();
        }
    }

    public function Cadastrar(){
        try{
                if(isset($_POST['Cadastrar'])){
                    if(isset($_POST['Nome']) && isset($_POST['Email']) && isset($_POST['Senha'])){
                        if(!empty($_POST['Nome']) && !empty($_POST['Email']) && !empty($_POST['Senha'])){
                        $nome = filter_input(INPUT_POST,"Nome");
                        $email = filter_input(INPUT_POST,"Email");
                        $senha = filter_input(INPUT_POST,"Senha");
                        $VerificaçãoDeEmailEstacionamento = $this->conexao->prepare("SELECT * FROM estacionamento WHERE email = :email");
                        $VerificaçãoDeEmailEstacionamento->bindParam(':email', $email);
                        $VerificaçãoDeEmailEstacionamento->execute();
                        $VerificaçãoDeEmailFuncionario = $this->conexao->prepare("SELECT * FROM funcionario WHERE email = :email");
                        $VerificaçãoDeEmailFuncionario->bindParam(':email', $email);
                        $VerificaçãoDeEmailFuncionario->execute();
        
                        if ($VerificaçãoDeEmailEstacionamento->rowCount() != 0 || $VerificaçãoDeEmailFuncionario->rowCount() != 0) {
                                echo "<script>alert('Email já cadastrado');</script>";
                        }else{
                            $query = "INSERT INTO estacionamento (nome,email,senha) VALUES(:nome,:email,:senha)";
                            $stmt = $this->conexao->prepare($query);
                            $stmt -> bindParam(':nome',$nome);
                            $stmt -> bindParam(':email',$email);
                            $stmt ->bindParam(':senha',$senha);
                            if($stmt->execute()){
                                $this ->CategoriaContaNova($email);
                            echo "<script>alert('Dados Inseridos Com sucesso');window.location.href='login.php';</script>";
                            }else{
                                echo "<script>alert('Error');</script>";
                            }
                        }
                    }
                }
            }
        }catch(PDOException $e){
            echo "Erro na consulta" . $e->getMessage();
			return null;
        }
    }

    public function CadastrarFuncionario($id_estacionamento){
        try{
        if(isset($_POST['CadastrarFuncionario'])){
            if(!empty($_POST['Nome'] && !empty($_POST['Email']) && !empty($_POST['Senha']))){
                $nome = filter_input(INPUT_POST,"Nome");
                $email = filter_input(INPUT_POST,"Email");
                $senha = filter_input(INPUT_POST,"Senha");
                $VerificaçãoDeEmailEstacionamento = $this->conexao->prepare("SELECT * FROM estacionamento WHERE email = :email");
                $VerificaçãoDeEmailEstacionamento->bindParam(':email', $email);
                $VerificaçãoDeEmailEstacionamento->execute();
                $VerificaçãoDeEmailFuncionario = $this->conexao->prepare("SELECT * FROM funcionario WHERE email = :email");
                $VerificaçãoDeEmailFuncionario->bindParam(':email', $email);
                $VerificaçãoDeEmailFuncionario->execute();

                if ($VerificaçãoDeEmailEstacionamento->rowCount() != 0 || $VerificaçãoDeEmailFuncionario->rowCount() != 0) {
                        echo "<script>alert('Email já cadastrado');</script>";
                }else{
                    $query = "INSERT INTO funcionario (nome,email,senha,id_Estacionamento) VALUES (:nome,:email,:senha,:id_estacionamento)";
                    $stmt = $this->conexao->prepare($query);
                    $stmt -> bindParam(":nome",$nome);
                    $stmt -> bindParam(":email",$email);
                    $stmt -> bindParam(":senha",$senha);
                    $stmt -> bindParam(":id_estacionamento",$id_estacionamento);
                    if($stmt->execute()){
                        echo "<script>alert('Funcionario cadastrado com sucesso');</script>";
                    }else{
                        echo "<script>alert('erro');</script>";
                    }
                    
                }
                

            }
        }
        }catch(PDOException $e){
            echo "Erro na consulta" . $e->getMessage();
			return null;
        }
    }

    public function Login(){
        try{
        if(isset($_POST['Logar'])){
            if(isset($_POST['Email']) && isset($_POST['Senha'])){
                if(!empty($_POST['Email']) && !empty($_POST['Senha'])){
                    $email = filter_input(INPUT_POST,"Email");
                    $senha = filter_input(INPUT_POST,"Senha");
                    $VerificaçãoDeEmailEstacionamento = $this->conexao->prepare("SELECT * FROM estacionamento WHERE email = :email");
                    $VerificaçãoDeEmailEstacionamento->bindParam(':email', $email);
                    $VerificaçãoDeEmailEstacionamento->execute();
                    $VerificaçãoDeEmailFuncionario = $this->conexao->prepare("SELECT * FROM funcionario WHERE email = :email");
                    $VerificaçãoDeEmailFuncionario->bindParam(':email', $email);
                    $VerificaçãoDeEmailFuncionario->execute();
    
                    if ($VerificaçãoDeEmailEstacionamento->rowCount() != 0) {

                        $query = "SELECT * FROM estacionamento WHERE email = :email AND senha = :senha";
                        $stmt = $this->conexao->prepare($query);
                        $stmt -> bindParam(":email",$email);
                        $stmt -> bindParam(":senha",$senha);
                        $stmt->execute();
                        $conta = $stmt->fetch(PDO::FETCH_ASSOC);
                        if($conta){
                            if($conta['senha']  == $_POST['Senha']){
                                if(!isset($_SESSION)){
                                    session_start();
                                }

                                $_SESSION['ID_Estacionamento'] = $conta['id_Estacionamento'];
                                $_SESSION['nome'] = $conta['nome'];
                                $_SESSION['dono'] = true;
                                echo "<script>window.location.href='CadastroCategoriaVeiculo.php';</script>";
                            }else{
                                echo "<script>alert('Login ou Senha Incorreta');</script>";
                            }
                        }

                    }else if($VerificaçãoDeEmailFuncionario->rowCount() != 0){

                        $query = "SELECT * FROM funcionario WHERE email = :email AND senha = :senha";
                        $stmt = $this->conexao->prepare($query);
                        $stmt -> bindParam(":email",$email);
                        $stmt -> bindParam(":senha",$senha);
                        $stmt->execute();
                        $conta = $stmt->fetch(PDO::FETCH_ASSOC);
                            if($conta['senha']  == $_POST['Senha']){
                                if(!isset($_SESSION)){
                                    session_start();
                                }
    
                                $_SESSION['ID_Estacionamento'] = $conta['id_Estacionamento'];
                                $_SESSION['ID_Funcionario'] = $conta['id_Funcionario'];
                                $_SESSION['nome'] = $conta['nome'];
                                $_SESSION['dono'] = false;
                                echo "<script>window.location.href='CadastroVeiculoFuncionario.php';</script>";
                            }else{
                                echo "<script>alert('Login ou Senha Incorreta');</script>";
                            }
                        
                    }else{
                        echo "<script>alert('Login ou Senha Incorreta');</script>";
                    }
                 
                }
            }
        }
        }catch(PDOException $e){
            echo "Erro na consulta" . $e->getMessage();
			return null;
        }
    }

    public function CategoriaContaNova($email){
        try{
        $query = "SELECT id_Estacionamento FROM estacionamento WHERE email = :email";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $id = $stmt->fetch(PDO::FETCH_ASSOC);

        $query1Categoria = "INSERT INTO categoria (nome,taxa,id_Estacionamento,QuantidadeVeiculo) VALUES (:nome, :taxa, :id, :quantidade)";
        $stmt = $this->conexao->prepare($query1Categoria);
        $stmt->bindValue(':nome', 'carro');
        $stmt->bindValue(':taxa', '4');
        $stmt->bindValue(':id', $id['id_Estacionamento']);
        $stmt->bindValue(':quantidade', '50');
        $stmt->execute();

        $query2Categoria = "INSERT INTO categoria (nome,taxa,id_Estacionamento,QuantidadeVeiculo) VALUES (:nome, :taxa, :id, :quantidade)";
        $stmt = $this->conexao->prepare($query2Categoria);
        $stmt->bindValue(':nome', 'moto');
        $stmt->bindValue(':taxa', '4');
        $stmt->bindValue(':id', $id['id_Estacionamento']);
        $stmt->bindValue(':quantidade', '50');
        $stmt->execute();

        $query3Categoria = "INSERT INTO categoria (nome,taxa,id_Estacionamento,QuantidadeVeiculo) VALUES (:nome, :taxa, :id, :quantidade)";
        $stmt = $this->conexao->prepare($query3Categoria);
        $stmt->bindValue(':nome', 'caminhão');
        $stmt->bindValue(':taxa', '4');
        $stmt->bindValue(':id', $id['id_Estacionamento']);
        $stmt->bindValue(':quantidade', '50');
        $stmt->execute();
        }catch(PDOException $e){
            echo "Erro na consulta" . $e->getMessage();
			return null;
        }
            
        
    }
    

    public function CadastrarCategoria($id_estacionamento){
        try{
        if(isset($_POST['Inserir'])){
            if(isset($_POST['Taxa']) && isset($_POST['Nome']) && isset($_POST['Vagas'])){
                if(!empty($_POST['Taxa']) && !empty($_POST['Nome'])  && !empty($_POST['Vagas'])){
                    $taxa = filter_input(INPUT_POST,"Taxa");
                    $nome = filter_input(INPUT_POST,"Nome");
                    $vagas = filter_input(INPUT_POST,"Vagas");
                    $queryCategoria = "SELECT * FROM categoria WHERE nome = :nome";
                    $stmt = $this->conexao->prepare($queryCategoria);
                    $stmt -> bindParam(":nome",$nome);
                    $stmt ->execute();
                    if($stmt->rowCount() != 0 ){
                        echo "<script>alert('Ja existe uma categoria com essse nome');</script>";
                    }else{
                    
                    $query = "INSERT INTO categoria (taxa,nome,QuantidadeVeiculo,id_Estacionamento) VALUES (:taxa,:nome,:vagas,:id)";
                    $stmt = $this->conexao->prepare($query);
                    $stmt -> bindParam(":taxa",$taxa);
                    $stmt -> bindParam(":nome",$nome);
                    $stmt -> bindParam(":vagas",$vagas);
                    $stmt -> bindParam(":id",$id_estacionamento);
                    if($stmt->execute()){
                        echo "<script>alert('Categoria Inserida Com sucesso');window.location.href='CadastroCategoriaVeiculo.php';</script>";
                    }else{
                        echo "<script>alert('Error');</script>";
                    }
                }
                }
            }
        }
        }catch(PDOException $e){
            echo "Erro na consulta" . $e->getMessage();
			return null;
        }
        
    }
    public function VerificarPlaca($placa){
        $id_estacionamento = $_SESSION['ID_Estacionamento'];
        $queryPlaca = "SELECT veiculo.placa FROM estacionamento JOIN categoria ON estacionamento.id_Estacionamento = categoria.id_Estacionamento JOIN veiculo ON veiculo.id_Categoria = categoria.id_Categoria WHERE estacionamento.id_Estacionamento = :id_estacionamento AND veiculo.placa = :placa AND veiculo.saida IS NULL"; 
        $stmt = $this->conexao->prepare($queryPlaca);
        $stmt->bindParam(":id_estacionamento",$id_estacionamento);
        $stmt ->bindParam(":placa",$placa);
        $stmt->execute();

        if($stmt->rowCount() != 0 ){
            return false;
        }else{
            return true;
        }
    }


    public function CadastrarVeiculo(){
        try{
        if(isset($_POST['Veiculo'])){
            if(isset($_POST['Placa']) && isset($_POST['Categoria'])){
                if(!empty($_POST['Placa']) && !empty($_POST['Categoria'])){
                    $entrada = $this->HorarioSalvadorBahia();
                    $placa = filter_input(INPUT_POST,"Placa");
                    $categoria = filter_input(INPUT_POST,"Categoria");

                    $placaVerificada = $this -> VerificarPlaca($placa);
                    $categoriaVerificar = $this->CategoriaEspecifica($categoria);
                    $cont = $this->CountCategoria($categoria);
                    if($cont < $categoriaVerificar['QuantidadeVeiculo']){
                    if($placaVerificada == true){
                    $query = "INSERT INTO veiculo (placa,id_Categoria,entrada,id_Funcionario) VALUES (:placa,:id_Categoria,:entrada,:id_Funcionario )";
                        $stmt = $this->conexao->prepare($query);
                        $stmt ->bindParam(":placa",$placa);
                        $stmt -> bindParam(":id_Categoria",$categoria);
                        $stmt -> bindParam(":entrada",$entrada);
                        if($_SESSION['dono'] == false){
                            $stmt -> bindParam(":id_Funcionario",$_SESSION['ID_Funcionario']);
                        }else{
                            $var = null;
                            $stmt -> bindParam(":id_Funcionario",$var);
                        }

                        if($stmt->execute()){
                                return true;
                        }else{
                            echo "<script>alert('Error');</script>";
                        }
                    }else{
                        echo "<script>alert('Carro no estacionamento');</script>";
                    }
                

                    
                }else{
                    echo "<script>alert('Todas as vagas estão ocupadas');</script>";
                }
                }
            }
        }
        }catch(PDOException $e){
            echo "Erro na consulta" . $e->getMessage();
			return null;
        }
    }
    public function MostrarVeiculos($id_estacionamento){
        $stmt = $this->conexao->query("SELECT veiculo.id_Veiculo,veiculo.id_Funcionario, veiculo.placa, veiculo.entrada, veiculo.saida, categoria.nome AS 'CategoriaNome', categoria.taxa 
        FROM estacionamento 
        JOIN categoria ON categoria.id_Estacionamento = estacionamento.id_Estacionamento 
        JOIN veiculo ON veiculo.id_Categoria = categoria.id_Categoria
        WHERE estacionamento.id_Estacionamento = $id_estacionamento");

        $veiculos = $stmt ->fetchAll(PDO::FETCH_ASSOC);
        return $veiculos;

    }

    public function VeiculosEstacionados($id_estacionamento){
        $query = "SELECT veiculo.id_Veiculo,veiculo.id_Funcionario,veiculo.placa, veiculo.entrada, veiculo.saida, categoria.nome AS 'CategoriaNome', categoria.taxa 
        FROM estacionamento 
        JOIN categoria ON categoria.id_Estacionamento = estacionamento.id_Estacionamento 
        JOIN veiculo ON veiculo.id_Categoria = categoria.id_Categoria
        WHERE estacionamento.id_Estacionamento = $id_estacionamento AND veiculo.saida IS NULL";
        $stmt = $this->conexao->query($query);
        $veiculos = $stmt ->fetchAll(PDO::FETCH_ASSOC);
        return $veiculos;
    }

    public function ListaFuncionarios($id_estacionamento){
        $query = "SELECT * FROM funcionario WHERE id_Estacionamento = $id_estacionamento ";
        $stmt = $this->conexao->query($query);
        $funcionarios = $stmt ->fetchAll(PDO::FETCH_ASSOC);
        return $funcionarios;
    }

    public function FuncionarioNome($id){
        $query = "SELECT * FROM funcionario WHERE id_Funcionario = $id ";
        $stmt = $this->conexao->query($query);
        $funcionario = $stmt ->fetch(PDO::FETCH_ASSOC);
        return $funcionario['nome'];
    }
    public function HorarioSalvadorBahia(){
        $horario = new DateTime();
        $horario->modify('-4 hours');
        $horarioFormatado = $horario->format('Y-m-d H:i');
        return $horarioFormatado;
    }
    public function ConfirmarSaida($id){
        $saida = new DateTime();
        $saida->modify('-4 hours');
        $saidaFormatada = $saida->format('Y-m-d H:i');
       $query = "UPDATE veiculo SET saida = :saida WHERE id_Veiculo = :id";
       $stmt = $this->conexao->prepare($query);
       $stmt -> bindParam(":saida",$saidaFormatada);
       $stmt -> bindParam(":id",$id);
       if($stmt -> execute()){
        return true;
       }else{
        echo "<script>alert('Error');</script>";
       }
       
       
    }

    public function CalcularTaxa($dia,$hora,$taxa){

        $horasdia = $dia * 24;
        $horatotal = $horasdia + $hora;
        $taxaTotal = $taxa * $horatotal + $taxa;
        return $taxaTotal;
    }


    public function Categorias($id_estacionamento){
        $stmt= $this->conexao->query("SELECT * FROM Categoria WHERE id_Estacionamento = $id_estacionamento");
        $categoria = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $categoria;
    }

    public function CountCategoria($categoria){
        $stmt= $this->conexao->query("SELECT COUNT(*) FROM veiculo WHERE id_Categoria = $categoria AND saida IS NULL");
        $categoria = $stmt->fetch(PDO::FETCH_ASSOC);
        return $categoria['COUNT(*)'];
    }

    public function CategoriaEspecifica($id){
        $stmt= $this->conexao->query("SELECT * FROM Categoria WHERE id_Categoria = $id");
        $categoriaEspecifica = $stmt->fetch(PDO::FETCH_ASSOC);
        return $categoriaEspecifica;
    }

    public function Deletar($id_veiculo){
        $query = "DELETE FROM veiculo WHERE id_Veiculo = :id_veiculo";
        $stmt = $this->conexao->prepare($query);
        $stmt -> bindParam(":id_veiculo",$id_veiculo);
        if($stmt -> execute()){
            echo "<script>alert('Dados Deletado Com sucesso');window.location.href='MostrarVeiculos.php';</script>";
        }else{
            echo "<script>alert('Error');</script>";
        }
        
        
        
    }

    public function DeletarCategoria($id_Categoria){
        $query = "DELETE FROM veiculo WHERE id_Categoria = :id_Categoria";
        $stmt = $this->conexao->prepare($query);
        $stmt -> bindParam(":id_Categoria",$id_Categoria);
        $stmt -> execute();
        $query = "DELETE FROM categoria WHERE id_Categoria = :id_Categoria";
        $stmt = $this->conexao->prepare($query);
        $stmt -> bindParam(":id_Categoria",$id_Categoria);
        if($stmt -> execute()){
            echo "<script>alert('Dados Deletado Com sucesso');window.location.href='CategoriaLista.php';</script>";
        }else{
            echo "<script>alert('Error');</script>";
        }
        
        
        
    }


    public function Editar($id){
        try{
        if(isset($_POST['EditarVeiculo'])){
            if(isset($_POST['Placa']) && isset($_POST['Categoria']) && isset($_POST['Entrada']) && isset($_POST['Saida'])){
                if(!empty($_POST['Placa']) && !empty($_POST['Categoria']) && !empty($_POST['Entrada']) && !empty($_POST['Saida'])){
                    $placa = filter_input(INPUT_POST,"Placa");
                    $categoria = filter_input(INPUT_POST,"Categoria");
                    $entrada = filter_input(INPUT_POST,"Entrada");
                    $saida = filter_input(INPUT_POST,"Saida");

                        $query = "UPDATE veiculo SET placa=:placa ,id_Categoria=:id_Categoria,entrada =:entrada,saida=:saida WHERE id_veiculo =:id";
                    
                    if($entrada < $saida || $saida == null){
                        $stmt = $this->conexao->prepare($query);
                        $stmt ->bindParam(":placa",$placa);
                        $stmt -> bindParam(":id_Categoria",$categoria);
                        $stmt -> bindParam(":entrada",$entrada);
                        $stmt -> bindParam(":id",$id);

                        $stmt -> bindParam(":saida",$saida);
                        
                        if($stmt->execute()){
                            echo "<script>alert('Dados Editados Com sucesso');window.location.href='MostrarVeiculos.php';</script>";
                        }else{
                            echo "<script>alert('Error');</script>";
                        }
                }else{
                    echo "<script>alert('O horario de entrada não pode maior que o horario de saida');</script>";
                }
                }
            }
        }
        }catch(PDOException $e){
            echo "Erro na consulta" . $e->getMessage();
			return null;
        }
    }

    public function EditarCategoria($id){
        try{
        if(isset($_POST['EditarCategoria'])){
            if(isset($_POST['Taxa']) && isset($_POST['Nome']) && isset($_POST['Vagas'])){
                if(!empty($_POST['Taxa']) && !empty($_POST['Nome'])  && !empty($_POST['Vagas'])){
                    $taxa = filter_input(INPUT_POST,"Taxa");
                    $nome = filter_input(INPUT_POST,"Nome");
                    $vagas = filter_input(INPUT_POST,"Vagas");

                    $query = "UPDATE categoria SET taxa=:taxa,nome=:nome,QuantidadeVeiculo=:vagas WHERE id_Categoria = :id";
                    $stmt = $this->conexao->prepare($query);
                    $stmt -> bindParam(":taxa",$taxa);
                    $stmt -> bindParam(":nome",$nome);
                    $stmt -> bindParam(":vagas",$vagas);
                    $stmt -> bindParam(":id",$id);
                    if($stmt->execute()){
                        echo "<script>alert('Categoria Editada Com sucesso');window.location.href='CadastroCategoriaVeiculo.php';</script>";
                    }else{
                        echo "<script>alert('Error');</script>";
                    }
                }
            }
        }
        }catch(PDOException $e){
            echo "Erro na consulta" . $e->getMessage();
			return null;
        }
    }

    public function VeiculoEspecifico($id){
        $query=("SELECT * FROM veiculo WHERE id_Veiculo = :id");
        $stmt = $this->conexao->prepare($query);
        $stmt -> bindParam(":id",$id);
        $stmt -> execute();
        $veiculo = $stmt->fetch(PDO::FETCH_ASSOC);
        return $veiculo;
    }

    public function inicioSession(){
		if(!isset($_SESSION)){
			session_start();
		}

		if(!isset($_SESSION['ID_Estacionamento'])){
			return false;
		}
		return true;
	}

	public function sair(){
		if(isset($_POST['sair'])){
			if(!isset($_SESSION)){
				session_start();
			}

			session_destroy();

			echo "<script>window.location.href='login.php';</script>";
		}
	}

    
    
}

?>