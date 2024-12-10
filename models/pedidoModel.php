<?php
require_once 'DAL/pedidoDAO.php';

class pedidoModel {
    public ?int $id;
    public ?int $clienteId;
    public ?int $statusId;

    public function __construct(
        ?int $id = null,
        ?int $clienteId = null,
        ?int $statusId = null
    ) {
        $this->id = $id;
        $this->clienteId = $clienteId;
        $this->statusId = $statusId;
    }

    public function getPedidos() {
        $pedidoDAO = new pedidoDAO();
        return $pedidoDAO->getPedidos();
    }

    public function getPedido($id) {
        $pedidoDAO = new pedidoDAO();
        return $pedidoDAO->getPedido($id);
    }

    public function getPedidosPorcliente($clienteId) {
        $pedidoDAO = new pedidoDAO();
        return $pedidoDAO->getPedidosPorcliente($clienteId);
    }

    public function create($clienteId, $statusId) {
        $pedidoDAO = new pedidoDAO();
        return $pedidoDAO->createPedido($clienteId, $statusId);
    }

    public function update($id, $clienteId, $statusId) {
        $pedidoDAO = new pedidoDAO();
        return $pedidoDAO->updatePedido($id, $clienteId, $statusId);
    }

    public function updateStatus($id, $statusId) {
        $pedidoDAO = new pedidoDAO();
        return $pedidoDAO->updateStatusPedido($id, $statusId);
    }

    public function delete($id) {
        $pedidoDAO = new pedidoDAO();
        return $pedidoDAO->deletePedido($id);
    }

    public function calcularValorTotal($pedidoId) {
        $pedidoDAO = new pedidoDAO();
        return $pedidoDAO->calcularValorTotal($pedidoId);
    }
}
?>
