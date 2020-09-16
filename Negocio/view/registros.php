<?php
  include '../banco/conexao.php';
  $conectar = getConnection();
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

</head>






<body>

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