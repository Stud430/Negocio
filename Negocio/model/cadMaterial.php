


<?php

include '../banco/conexao.php';

$conectar = getConnection();

function data($data){
    return date("d/m/Y",strtotime($data));
    // Y = Ano inteiro (ex: 2020)
    // y = Ano pelo metade (ex: 20) 
}

function resultado($x,$y)
    {
        $a = (float) $x;
        $b = (int) $y;    
        $r = $a * $b;

        return $r;
    }
//number_format($calculo, 2, ",", ".")

//$sql = 'INSERT INTO produto (descricao,qtd,valor) VALUES (:desc,:qtd,:valor)';
$sql = 'INSERT INTO material (material,estabelecimento,preco,quantidade, total, data_compra, registro) 
            VALUES (:material,:estabelecimento,:preco,:quantidade, :total, :data_compra, :registro)';


date_default_timezone_set('America/Sao_Paulo');
    setlocale(LC_TIME, "pt_BR");
            
    $agora = getdate();
    $a = $agora["year"];
    //$m = utf8_encode(strftime("%B")); // Mês por extenso
    $mes =  $agora["mon"]; // Mês com 2 dígitos
    $d = $agora["mday"];

$material = $_POST["material"];
$estabelecimento = $_POST["estabelecimento"];
$valor = $_POST["preco"];
$preco = (float) $valor;
$quantidade = $_POST["quantidade"];
//$total = resultado($preco,$quantidade);//$preco*$quantidade;// imc($altura,$peso);
$total = (float) ($preco * $quantidade);
$data_compra = data($_POST["data_compra"]);
$registro = $a ."-" . $mes . "-" . $d; // Data ATUAL no formato AMERICANO

$stmt = $conectar->prepare($sql);
$stmt->bindParam(':material', $material);
$stmt->bindParam(':estabelecimento', $estabelecimento);
$stmt->bindParam(':preco', $preco);
$stmt->bindParam(':quantidade', $quantidade);
$stmt->bindParam(':total', $total);
$stmt->bindParam(':data_compra', $data_compra);
$stmt->bindParam(':registro', $registro);

if($stmt->execute()){
    echo 'Salvo com sucesso!';
    header("location: ../view/materiais.php");
}else{
    echo ' Erro ao salvar!';
}

?>