<?php
require_once './models/clienteModel.php';

class clienteController {
    public function getclientes() {
        $clienteModel = new clienteModel();
        $clientes = $clienteModel->getclientes();

        return json_encode([
            'error' => null,
            'result' => $clientes
        ]);
    }

    public function buscarcliente() {
        $dados = json_decode(file_get_contents('php://input'), true);

        if (empty($dados['id']))
            return $this->mostrarErro('Você deve informar o ID do usuário!');

        $clienteModel = new clienteModel();
        $cliente = $clienteModel->getcliente($dados['id']);

        if (!$cliente)
            return $this->mostrarErro('Usuário não encontrado!');

        return json_encode([
            'error' => null,
            'result' => $cliente
        ]);
    }

    public function createcliente() {
        try {
            $dados = json_decode(file_get_contents('php://input'), true);

            $clienteModel = new clienteModel(
                null,
                $dados['nome'],
                $dados['cpf'],
                $dados['senha'],
                telefone: $dados['telefone'],
                endereco: $dados['enderedo'],
                cidade: $dados['cidade'],
                estado: $dados['estado'],
                cep: $dados['cep'],
                data_cadastro: $dados['data_cadastro'],

            );

            $conexao = (new Conexao())->getConexao();
        
            $clienteModel->create();

            return json_encode([
                'error' => null,
                'result' => 'Usuário cadastrado com sucesso!'
            ]);
        } catch (Exception $e) {
            return $this->mostrarErro($e->getMessage());
        }
    }

    public function updatecliente() {
        try {
            $dados = json_decode(file_get_contents('php://input'), true);

            $clienteModel = new clienteModel(
                id: null,
                nome: $dados['nome'],
                sobrenome: $dados['cpf'],
                email: $dados['senha'],
                telefone: $dados['telefone'],
                endereco: $dados['enderedo'],
                cidade: $dados['cidade'],
                estado: $dados['estado'],
                cep: $dados['cep'],
                data_cadastro: $dados['data_cadastro'],
            );

            $conexao = (new Conexao())->getConexao();
        
            $sql = "SELECT COUNT(*) FROM cliente WHERE cpf = :cpf AND id != :id;";
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $clienteModel->id);
            $stmt->execute();
        
            if ($stmt->fetchColumn() > 0) {
                throw new Exception("CPF já cadastrado por outro usuário!");
            }
        
            $clienteModel->update();

            return json_encode([
                'error' => null,
                'result' => 'Usuário atualizado com sucesso!'
            ]);
        } catch (Exception $e) {
            return $this->mostrarErro($e->getMessage());
        }
    }

    public function deletecliente() {
        $dados = json_decode(file_get_contents('php://input'), true);

        if (empty($dados['id']))
            return $this->mostrarErro('Você deve informar o ID do usuário!');

        $cliente = (new clienteModel())->getcliente($dados['id']);

        if (!$cliente)
            return $this->mostrarErro('Usuário não encontrado!');

        $cliente->delete();

        return json_encode([
            'error' => null,
            'result' => true
        ]);
    }

    private function mostrarErro(string $mensagem) {
        return json_encode([
            'error' => $mensagem,
            'result' => null
        ]);
    }
}
?>
