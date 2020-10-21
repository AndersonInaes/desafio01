<?php
require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "../../Controller/PeopleController.php";

use App\Entity\People;
use App\Conrtoller\PeopleController;

$result = "";

$pessoa = new People(
    null,
    filter_input(INPUT_POST, "txtName", FILTER_SANITIZE_STRING),
    filter_input(INPUT_POST, "txtEmail", FILTER_SANITIZE_EMAIL),
    filter_input(INPUT_POST, "age", FILTER_SANITIZE_STRING),
    filter_input(INPUT_POST, "salary", FILTER_SANITIZE_STRING),
    filter_input(INPUT_POST, "convenio", FILTER_SANITIZE_STRING),
    filter_input(INPUT_POST, "loan", FILTER_SANITIZE_STRING)
  );

if(isset($_POST['submit'])){
   if((new PeopleController())->create($pessoa))
    $result = '<div class="alert alert-dismissible alert-success">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Pesquisa Realizada. Obrigado!</strong>
    </div>';
}

?>

<body>
    
<link rel="stylesheet" href="public/bootstrap.min.css">
<center>A Bem Promotora é uma empresa com diversos produtos, tendo seu principal foco no Crédito Consignado, sendo de aposentados e pensionistas do INSS e funcionários públicos Federais. 
Assim ela gostaria de realizar uma pesquisa com seus clientes. Conforme abaixo:
</center>
<form method="post">
  <fieldset>
    <div class="form-group">
      <label for="exampleInputEmail1">Email </label>
      <input type="email" class="form-control" id="txtEmail" name="txtEmail" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="name">Nome</label>
      <input type="text" class="form-control" id="txtName" name="txtName" placeholder="Your Name">
    </div>
    <div class="form-group">
      <label for="age">Qual sua faixa de Idade</label>
      <select class="form-control" id="age" name="age">
        <option value="">...</option>
        <option value="Ate 30 anos">Ate 30 anos</option>
        <option value="De 30 a 50 anos">de 30 a 50 anos</option>
        <option value="De 50 a 65 anos">de 50 a 65 anos</option>
        <option value="Acima 65 anos">de 50 a 65 anos</option>
      </select>
    </div>
    <div class="form-group">
      <label for="state">Qual seu convênio</label>
      <select class="form-control" id="convenio" name="convenio">
        <option value="">...</option>
        <option value="INSS">INSS</option>
        <option value="SIAPE">SIAPE</option>
        <option value="Forças Armadas">Forças Armadas</option>
        <option value="Outros">Outros</option>
      </select>
    </div>
    <div class="form-group">
      <label for="state">Qual sua faixa salarial</label>
      <select class="form-control" id="salary" name="salary">
        <option value="">...</option>
        <option value="Ate 2 SM">Até 2 SM</option>
        <option value="De 2 a 4 SM">De 2 a 4 SM</option>
        <option value="De 4 a 6 SM">De 4 a 6 SM</option>
        <option value="Acima de 6 SM">Acima de 6 SM</option>
      </select>
    </div>
    <div class="form-group">
      <label for="state">Por que você realizou o empréstimo</label>
      <select class="form-control" id="loan" name="loan">
        <option value="">...</option>
        <option value="Pagar Contas">Pagar Contas</option>
        <option value="Reformar Casa">Reformar Casa</option>
        <option value="Comprar Carro">Comprar Carro</option>
        <option value="Outros">Outros</option>
      </select>
    </div>
    <div class="btn-group-vertical">
      <button name="submit" type="submit" class="btn btn-primary">Create People</button>
    </div>
    </form>
    <div>
      <?= $result; ?>
    </div>
</body>