<?php
require_once 'Conexao.php';

class clienteDAO {
    public function getclientes() {
        $conexao = (new Conexao())->getConexao();

        $sql = "SELECT * FROM cliente;";

        $stmt = $conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createcliente(clienteModel $cliente) {
        $conexao = (new Conexao())->getConexao();

        $sql = "INSERT INTO cliente (nome, sobrenome, email, telefone, endereco, cidade, estado, cep, data_cadastro) VALUES (:nome, :sobrenome, :email, :telefone, :endereco, :cidade, :estado, :cep, :data_cadastro);";

        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nome', $cliente->nome);
        $stmt->bindValue(':sobrenome', $cliente->sobrenome);
        $stmt->bindValue(':email', $cliente->email);
        $stmt->bindValue(':telefone', $cliente->telefone);
        $stmt->bindValue(':endereco', $cliente->endereco);
        $stmt->bindValue(':cidade', $cliente->cidade);
        $stmt->bindValue(':estado', $cliente->estado);
        $stmt->bindValue(':cep', $cliente->cep);
        $stmt->bindValue(':data_cadastro', $cliente->data_cadastro);

        return $stmt->execute();
    }

    public function updatecliente(clienteModel $cliente) {
        $conexao = (new Conexao())->getConexao();

        $sql = "UPDATE cliente SET nome = :nome, sobrenome = sobrenome, email = email, telefone = telefone, endereco = endereco, cidade = cidade, estado = estado, cep = cep, data_cadastro = data_cadsatro WHERE id = :id;";

        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nome', $cliente->nome);
        $stmt->bindValue(':sobrenome', $cliente->sobrenome);
        $stmt->bindValue(':email', $cliente->email);
        $stmt->bindValue(':telefone', $cliente->telefone);
        $stmt->bindValue(':endereco', $cliente->endereco);
        $stmt->bindValue(':cidade', $cliente->cidade);
        $stmt->bindValue(':estado', $cliente->estado);
        $stmt->bindValue(':cep', $cliente->cep);
        $stmt->bindValue(':data_cadastro', $cliente->data_cadastro);

        return $stmt->execute();
    }

    public function deletecliente(clienteModel $cliente) {
        $conexao = (new Conexao())->getConexao();

        $sql = "DELETE FROM cliente WHERE id = :id;";

        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $cliente->id);

        return $stmt->execute();
    }

    public function getcliente($id) {
        $conexao = (new Conexao())->getConexao();

        $sql = "SELECT * FROM cliente WHERE id = :id;";

        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
