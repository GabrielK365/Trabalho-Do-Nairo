<?php
class Router {
    private array $routes;

    public function __construct() {
        $this->routes = [
            'GET' => [
                '/cliente' => [
                    'controller' => 'clienteController',
                    'function' => 'getclientes'
                ],
                '/status' => [
                    'controller' => 'statusController',
                    'function' => 'getStatus'
                ],
                '/produtos' => [
                    'controller' => 'produtoController',
                    'function' => 'getProdutos'
                ],
                '/pedidos' => [
                    'controller' => 'pedidoController',
                    'function' => 'getPedidos'
                ]
            ],
            'POST' => [
                '/buscarcliente' => [
                    'controller' => 'clienteController',
                    'function' => 'buscarcliente'
                ],
                '/cadastrar-cliente' => [
                    'controller' => 'clienteController',
                    'function' => 'createcliente'
                ],
                '/status' => [
                    'controller' => 'statusController',
                    'function' => 'createStatus'
                ],
                '/produto' => [
                    'controller' => 'produtoController',
                    'function' => 'buscarProdutoById'
                ],
                '/cadastrar-produto' => [
                    'controller' => 'produtoController',
                    'function' => 'createProduto'
                ],
                '/itens-Pedido' => [
                    'controller' => 'itemController',
                    'function' => 'buscarItemPedido'
                ],
                '/cadastrar-item-pedido' => [
                    'controller' => 'itemController',
                    'function' => 'createItemPedido'
                ],
                '/pedido' => [
                    'controller' => 'pedidoController',
                    'function' => 'buscarPedidoPorId'
                ],
                '/pedidos-pessoa' => [
                    'controller' => 'pedidoController',
                    'function' => 'buscarPedidoPessoa'
                ],
                '/cadastrarPedido' => [
                    'controller' => 'pedidoController',
                    'function' => 'cadastrarPedido'
                ],
                '/valor-total-pedido' => [
                    'controller' => 'pedidoController',
                    'function' => 'buscarTotalPedido'
                ]
            ],
            'PUT' => [
                '/editar-cliente' => [
                    'controller' => 'clienteController',
                    'function' => 'updatecliente'
                ],
                '/editar-Produto' => [
                    'controller' => 'produtoController',
                    'function' => 'updateProduto'
                ],
                '/editar-item-pedido' => [
                    'controller' => 'itemController',
                    'function' => 'updateItemPedido'
                ],
                '/editar-pedido' => [
                    'controller' => 'pedidoController',
                    'function' => 'updatePedido'
                ],
                '/editar-status-pedido' => [
                    'controller' => 'pedidoController',
                    'function' => 'updateStatusPedido'
                ]
            ],
            'DELETE' => [
                '/excluir-cliente' => [
                    'controller' => 'clienteController',
                    'function' => 'deletecliente'
                ],
                '/excluir-Produto' => [
                    'controller' => 'produtoController',
                    'function' => 'deleteProduto'
                ],
                '/excluir-item-pedido' => [
                    'controller' => 'itemController',
                    'function' => 'deleteItemPedido'
                ],
                '/excluir-pedido' => [
                    'controller' => 'pedidoController',
                    'function' => 'deletePedido'
                ]
            ]
        ];
    }

    public function handleRequest(string $method, string $route): string {
        $routeExists = !empty($this->routes[$method][$route]);

        if (!$routeExists) {
            return json_encode([
                'error' => 'Essa rota não existe!',
                'result' => null
            ]);
        }

        $routeInfo = $this->routes[$method][$route];

        $controller = $routeInfo['controller'];
        $function = $routeInfo['function'];

        require_once __DIR__ . '/../controllers/' . $controller . '.php';

        return (new $controller)->$function();
    }
}
?>
