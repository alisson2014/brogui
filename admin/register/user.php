<h1 style="text-align: center;">Cadastro de Usuários</h1>
<p style="text-align: center;">
  <a href="index.php?acao=register&tabela=user" class="btn">
    Novo cadastro
  </a>
  <a href="index.php?acao=list&tabela=user" class="btn">
    Listar cadastros
  </a>
</p>
<hr>
<?php

if (isset($_GET["id"])) {
  $id = (int)$_GET["id"];
  $sqlUser = "SELECT * FROM usuario WHERE id = ?";
  $dados = $conn->query($sql)->fetch();
}

$id = $dados["id"] ?? NULL;
$nome  = $dados["nome"] ?? NULL;
$login = $dados["login"] ?? NULL;
$email = $dados["email"] ?? NULL;

?>
<form name="formCadastro" method="post" action="index.php?acao=save&tabela=user">
  <label for="id">ID:</label>
  <input type="text" name="id" id="id" class="campo" value="<?= $id ?>" readonly>
  <label for="nome">Nome:</label>
  <input type="text" name="nome" id="nome" class="campo" value="<?= $nome ?>">
  <label for="email">Email</label>
  <input type="email" name="email" id="email" class="campo" value="<?= $email ?>" required>
  <label for="login">Login</label>
  <input type="text" name="login" id="login" class="campo" value="<?= $login ?>" required>

  <label for="senha">Digite sua senha: </label>
  <input type="password" name="senha" id="senha" class="campo">

  <label for="senha2">Redigite a senha:</label>
  <input type="password" name="senha2" id="senha2" class="campo">

  <br>
  <button type="submit">Gravar dados: </button>
</form>