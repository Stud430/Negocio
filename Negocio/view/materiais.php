<?php
  include '../banco/conexao.php';
  $conectar = getConnection();
?>

<?php
  //cria consulta SQL
  //$listagem = "SELECT * FROM relatorio order by created";

// Consulta ao banco de dados
  $listagem = "SELECT * ";
  $listagem .= "FROM material ORDER BY data_compra";
  //$listagem .= "WHERE titulo LIKE '%{$procurar}%' ";

  $consulta = $conectar->prepare ($listagem);
  $consulta->execute();

  if (!$consulta) {
    die("Erro no Banco");
  }

?>

<?php
  $contagem = $conectar->prepare("SELECT * FROM totalcompra");
  $contagem->execute();

  $valortotal = $contagem->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Vendas</title>

	<?php header("Content-type: text/html; charset=utf-8"); ?>

	 <!-- Link Bootstrap -->
 	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> 

  <nav class="navbar navbar-expand-lg navbar-light bg-light">    
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="navbar-brand">
        <img src="../img/pedir-comida.png" width="40" height="40" alt="">
        </a>

        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="investimentos.php" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Investimentos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="materiais.php">Materiais</a>
          <a class="dropdown-item" href="listadecompras.php">Lista de Compras</a>
        </div>
      </li>

        <a class="nav-item nav-link active" href="Vendas.php">
          Vendas 
          <span class="sr-only">(current)</span>
        </a>

        <a class="nav-item nav-link active" href="encomendas.php">
          Encomendas 
          <span class="sr-only">(current)</span>
        </a>

        <a class="nav-item nav-link active" href="registros.php">
          Registros
          <span class="sr-only">(current)</span>
        </a>

      </div>
    </div>
  </nav>


<style>
  
  #material,#estabelecimento{
    width: 400px;

  }

  #preco, #quantidade{
    width: 150px;

  }

  #data{
    width: 180px;
    padding-left: 15px;
  }

  #lblMaterial, #lblPreco{
    padding-left: 30px;
  }

  h3,h5{
    padding-left: 20px;
  }

  #lblLocal, #lblQuant, #lblData{
    padding-left: 10px;
  }

  #inputpreco{
    padding-left: 33px;
  }
  #inputlbl{
    padding-left: 15px;
  }

  #btnCompra{
    padding-left: 15px;
  }

</style>

</head>



<body>

<p>
  <h3> Cadastro de Materiais Investidos </h3> 
</p>

<form action="../model/cadMaterial.php" method="POST">
      
  <div class="form-row">
      <label id="lblMaterial"> Material: </label>
    <div id="inputlbl">  <input type="text" name="material" id="material" class="form-control"> </div>
      <label id="lblLocal"> Estabelecimento: </label>
    <div id="inputlbl">  <input type="text" name="estabelecimento" id="estabelecimento" class="form-control"> </div>     
  </div>    
  <p></p>
  <div class="form-row">
      <label id="lblPreco"> Preço: </label>
    <div id="inputpreco">  
      <input type="text" name="preco" id="preco" class="form-control" placeholder="Ex.: 1.00"> 
    </div> <!-- campo tipo float -->
      <label id="lblQuant"> Quantidade: </label>
    <div id="inputlbl">  <input type="number" name="quantidade" id="quantidade" min="1" class="form-control"> </div>
      <label id="lblData"> Data: </label>
    <div id="inputlbl">  <input type="date" name="data_compra" id="data" class="form-control"> </div>
      
    <div id="btnCompra">
      <button type="submit" class="btn btn-success"> Registrar Compra </button>
    </div>  
  </div>    
</form>
  
</body>

<p> <hr> </p>

<body>
  <br>
  <h5> Listagem de Investimentos </h5>
  <label id="TotalInvestido"><center> <?php echo "Total Investido: " . $valortotal["Total_Investido"]; ?> </center></label>


<?php
  echo"<table class='table table-sm table-striped'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th><center>Material</center></th>";
    echo "<th><center>Estabelecimento</center></th>";
    echo "<th><center>Preço</center></th>";
    echo "<th><center>Quantidade</center></th>";
    echo "<th><center>Total</center></th>";
    echo "<th><center>Data da Compra</center></th>";
    echo "<th><center>Açöes</center></th>";
    echo "</tr>";
    echo "</thead>";

    echo "<tbody>";

    while ( $linha = $consulta->fetch(PDO::FETCH_ASSOC) ) {   
?> 
    <tr>
    <td align="center"> <?php echo $linha["material"] ?> </td>
    <td align="center"> <?php echo $linha["estabelecimento"] ?> </td>
    <td align="center"> <?php echo $linha["preco"] ?> </td>
    <td align="center"> <?php echo $linha["quantidade"] ?> </td>
    <td align="center"> <?php echo $linha["total"] ?> </td>
    <td align="center"> <?php echo $linha["data_compra"] ?> </td>
    <td align="center">
      
      <a href="#edit<?php echo $linha['id'];?>" data-toggle="modal">
      <button type='button' class="btn btn-warning btn-sm">
          Editar       
      </button>
    </a>


    <!--Edit Item Modal -->
                    <div id="edit<?php echo $linha['id']; ?>" class="modal fade" role="dialog">
                        <form method="post" class="form-horizontal" action="../model/editarEmandamento.php">
                            <div class="modal-dialog modal-lg">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3>Editar Item</h3>
                                        <button class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                                    
                                    <div class="modal-body">
                                        <input type="hidden" name="edit_item_id" value="<?php echo $linha['id']; ?>">
                                        <div class="form-row">
                                          <label class="control-label col-sm-2" for="item_code">Início:</label>
                                            <input type="date" class="form-control" id="lbldata_termino" name="data_inicio" placeholder="Category" required> 
                                        </div>  
                                    </div>

                                    <div id='botao'>
                                    <button type="submit" class="btn btn-success" name="update_item"> 
                                            Cadastrar
                                    </button>

                                  </div>
                                  <br>
                                </div>
                                </div>
                        </form>
                    </div>


<a class="btn btn-danger btn-sm" href="../model/excluir.php?id=<?php echo $linha['id']?>">
  Excluir
</a>

    </td>
    </tr>

<?php
  }
  echo "</tbody>";
  echo "</table>";

?>


  <label id="TotalInvestido"><center> <?php echo "Total Investido: " . $valortotal["Total_Investido"]; ?> </center></label>

</body>





    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="js/bootnavbar.js" ></script>
    <script>
        $(function () {
            $('#main_navbar').bootnavbar();
        })
    </script>


</html>