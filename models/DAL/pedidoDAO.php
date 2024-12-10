<?php
require_once 'Conexao.php';

class pedidoDAO {
    public function getPedidos() {
        $conexao = (new Conexao())->getConexao();

        $sql = "SELECT * FROM pedido;";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPedido($id) {
        $conexao = (new Conexao())->getConexao();

        $sql = "SELECT * FROM pedido WHERE id = :id;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getPedidosPorcliente($clienteId) {
        $conexao = (new Conexao())->getConexao();

        $sql = "SELECT * FROM pedido WHERE cliente_id = :cliente_id;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':cliente_id', $clienteId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createPedido($clienteId, $statusId) {
        $conexao = (new Conexao())->getConexao();

        $sql = "INSERT INTO pedido (cliente_id, status_id) VALUES (:cliente_id, :status_id);";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':cliente_id', $clienteId);
        $stmt->bindValue(':status_id', $statusId);

        return $stmt->execute();
    }

    public function updatePedido($id, $clienteId, $statusId) {
        $conexao = (new Conexao())->getConexao();

        $sql = "UPDATE pedido SET cliente_id = :cliente_id, status_id = :status_id WHERE id = :id;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':cliente_id', $clienteId);
        $stmt->bindValue(':status_id', $statusId);

        return $stmt->execute();
    }

    public function updateStatusPedido($id, $statusId) {
        $conexao = (new Conexao())->getConexao();

        $sql = "UPDATE pedido SET status_id = :status_id WHERE id = :id;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':status_id', $statusId);

        return $stmt->execute();
    }

    public function deletePedido($id) {
        $conexao = (new Conexao())->getConexao();

        $sql = "DELETE FROM pedido WHERE id = :id;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }

    public function calcularValorTotal($pedidoId) {
        $conexao = (new Conexao())->getConexao();

        $sql = "SELECT SUM(p.preco * ip.quantidade) AS valor_total
                FROM item_pedido ip
                JOIN produto p ON ip.produto_id = p.id
                WHERE ip.pedido_id = :pedido_id;";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':pedido_id', $pedidoId);
        $stmt->execute();

        return $stmt->fetchColumn();
    }
}
?>
