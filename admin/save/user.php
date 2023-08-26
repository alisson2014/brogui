<?php
$id = trim($_POST["id"] ?? NULL);
$nome = trim($_POST["nome"] ?? NULL);
$email = trim($_POST["email"] ?? NULL);
$login = trim($_POST["login"] ?? NULL);
$senha = trim($_POST["senha"] ?? NULL);
$senha2 = trim($_POST["senha2"] ?? NULL);

if (empty($nome)) {
  mensagem("Preencha o nome");
} else if (empty($login)) {
  mensagem("Preencha o login");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  mensagem("Preencha um email valido");
} else if ($senha != $senha2) {
  mensagem("A senha digitada não é igual a senha redigitada");
}

$sql = "UPDATE usuario 
        SET nome = :nome, login = :login, email = :email, senha = :senha 
        WHERE id = :id";

if (empty($id)) {
  if (empty($senha)) mensagem("Digite uma senha");

  $sql = "INSERT INTO usuario VALUES (:id, :nome, :email, :login, :senha)";
} else if (empty($senha)) {
  $sql = "UPDATE usuario SET nome = :nome, login = :login, email = :email WHERE id = :id";
}

if (isset($senha)) $senha = password_hash($senha, PASSWORD_DEFAULT);

$conn->beginTransaction();
$stmt = $conn->prepare($sql);
$stmt->bindValue(":nome", $nome);
$stmt->bindValue(":email", $email);
$stmt->bindValue(":login", $login);
$stmt->bindValue(":id", $id ?? null);
$stmt->bindValue(":senha", $senha ?? null);

$result = 0;

try {
  $stmt->execute();

  $result = $stmt->rowCount();
  $conn->commit();
} catch (PDOException $e) {
  $error = $e->getMessage();
  $conn->rollBack();
}

if ($result > 0) {
  mensagem("O registro foi salvo com sucesso!");
} else {
  mensagem("Erro ao salvar o registro.\n Erro: {$error}");
}
