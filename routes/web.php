<?php

/** @var \Laravel\Lumen\Routing\Router $router */

// Rotas
$router->group(['prefix' => '/api'], function() use ($router) {
    $router->get("/produtos", "ApiController@buscaProdutos");
    $router->get("/categorias", "ApiController@buscaCategorias");
    $router->post("/insereCategoria", "ApiController@insereCategoria");
    $router->post("/atualizaCategoria", "ApiController@atualizaCategoria");
    $router->post("/novoProduto", "ApiController@novoProduto");
    $router->post("/atualizaProduto", "ApiController@atualizaProduto");
    $router->post("/procuraProduto", "ApiController@procuraProduto");
    $router->post("/procuraCategoria", "ApiController@procuraCategoria");
    $router->post("/excluiProduto", "ApiController@excluiProduto");
});

$router->get('/', function () use ($router) {
    return $router->app->version();
});
