<?php
    require_once 'DAL/clienteDAO.php';

    class clienteModel {
        public ?int $id;
        public ?int $nome;
        public ?int $sobrenome;
        public ?int $email;
        public ?int $telefone;
        public ?int $endereco;
        public ?int $cidade;
        public ?int $estado;
        public ?int $cep;
        public ?int $data_cadastro;



        public function __construct(
            ?int $id = null,
            ?string $nome = null,
            ?string $sobrenome = null,
            ?string $email = null,
            ?string $telefone = null,
            ?string $endereco = null,
            ?string $cidade = null,
            ?string $estado = null,
            ?string $cep = null,
            ?int $data_cadastro = null,
        ) {
            $this->id = $id;
            $this->nome = $nome;
            $this->sobrenome = $sobrenome;
            $this->email = $email;
            $this->telefone = $telefone;
            $this->endereco = $endereco;
            $this->cidade = $cidade;
            $this->estado = $estado;
            $this->cep = $cep;
            $this->data_cadastro = $data_cadastro;
        }

        public function getclientes() {
            $clienteDAO = new clienteDAO();

            $clientes = $clienteDAO->getclientes();

            foreach ($clientes as &$cliente) {
                $cliente = new clienteModel(
                    $cliente['id'],
                    $cliente['nome'],
                    $cliente['cpf'],
                    $cliente['senha']
                );
            }

            return $clientes;
        }

        public function create() {
            $clienteDAO = new clienteDAO();

            return $clienteDAO->createcliente($this);
        }

        public function update() {
            $clienteDAO = new clienteDAO();

            return $clienteDAO->updatecliente($this);
        }

        public function delete() {
            $clienteDAO = new clienteDAO();

            return $clienteDAO->deletecliente($this);
        }

        public function getcliente($id) {
            $clienteDAO = new clienteDAO;

            $cliente = $clienteDAO->getcliente($id);

            $cliente = new clienteModel(
                $cliente['id'],
                $cliente['nome'],
                $cliente['cpf'],
                $cliente['senha']
            );

            return $cliente;
        }
    }
?>