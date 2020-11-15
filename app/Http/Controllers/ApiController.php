<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiModel;
use PhpParser\Node\Stmt\Foreach_;

class ApiController extends Controller
{
    private $model;

    public function __construct(ApiModel $AppModel)
    {
        $this->model = $AppModel;
    }

    /**
     * Função responsável pela Busca todos os Produtos
     */
    public function buscaProdutos()
    {
        // Busca todos os produtos
        $produtos = $this->model->qyrGetAllProdutos();
        
        // Retorna os dados
        return response()->json($produtos);
    }

    /**
     * Função responsável pela Busca todas as Categorias
     */
    public function buscaCategorias()
    {
        $categoria = $this->model->qryGetAllCategorias();
        return response()->json($categoria);
    }

    /**
     * Função responsável pela Inclusão de uma Nova Categoria
     */
    public function insereCategoria(Request $request)
    {
        // Recupera os Dados
        $nome      = $request->input('nome');
        $descricao = $request->input('descricao');

        $result = $this->model->qryNovaCategoria(
            $nome,
            $descricao
        );

        // Verifica o retorno
        if ($result == 'SUCESSO') {
            $result = [
                'tipo' => 'ok'
            ];
        } else {
            $result = [
                'tipo' => 'notOk'
            ];
        }
        
        return response()->json($result);
    }

    /**
     * Função responsável por atualizar os Dados da Categoria
     */
    public function atualizaCategoria(Request $request)
    {
        // Recupera os Dados
        $id        = $request->input('id');
        $nome      = $request->input('nome');
        $descricao = $request->input('descricao');

        $result = $this->model->qryAtualizaCategoria(
            $id,
            $nome,
            $descricao
        );

        // Verifica o retorno
        if ($result == 'SUCESSO') {
            $result = [
                'tipo' => 'ok'
            ];
        } else {
            $result = [
                'tipo' => 'notOk'
            ];
        }
        
        return response()->json($result);
    }

    /**
     * Função responsável pela Inclusão de um Novo Produto
     */
    public function novoProduto(Request $request)
    {
        // Recupera os Dados
        $idCategoria = $request->input('idCategoria');
        $nome        = $request->input('nome');
        $descricao   = $request->input('descricao');
        $valor       = $request->input('valor');
        $estoque     = $request->input('estoque');

        $result = $this->model->qryNovoProduto(
            $idCategoria,
            $nome,
            $descricao,
            $valor,
            $estoque
        );

        // Verifica o retorno
        if ($result == 'SUCESSO') {
            $result = [
                'tipo' => 'ok'
            ];
        } else {
            $result = [
                'tipo' => 'notOk'
            ];
        }
        
        return response()->json($result);
    }

    /**
     * Função responsável pela Atualização do Produto
     */
    public function atualizaProduto(Request $request)
    {
        // Recupera os Dados
        $id          = $request->input('id');
        $nome        = $request->input('nome');
        $descricao   = $request->input('descricao');
        $valor       = $request->input('valor');
        $estoque     = $request->input('estoque');
        $idCategoria = $request->input('idCategoria');

        $result = $this->model->qryAtualizaProduto(
            $id,
            $nome,
            $descricao,
            $valor,
            $estoque,
            $idCategoria
        );

        // Verifica o retorno
        if ($result == 'SUCESSO') {
            $result = [
                'tipo' => 'ok'
            ];
        } else {
            $result = [
                'tipo' => 'notOk'
            ];
        }
        
        return response()->json($result);
    }

    public function procuraProduto(Request $request)
    {
        // Recupera os Dados
        $pesquisa    = $request->input('pesquisa');
        $valorMaximo = $request->input('valorMaximo');
        $valorMinimo = $request->input('valorMinimo');

        if ($valorMaximo && $valorMinimo) {
            $par_pesquisa = 1;
        } else {
            $par_pesquisa = 2;
        }

        $buscaProdutos = $this->model->qryBuscaProduto(
            $par_pesquisa,
            $pesquisa,
            $valorMaximo,
            $valorMinimo
        );

        return response()->json($buscaProdutos);
    }

    public function procuraCategoria(Request $request)
    {
        // Recupera os Dados
        $idCategoria = $request->input('idCategoria');
        $valorMaximo = $request->input('valorMaximo');
        $valorMinimo = $request->input('valorMinimo');

        if ($valorMaximo && $valorMinimo) {
            $par_pesquisa = 1;
        } else {
            $par_pesquisa = 2;
        }

        $buscaProdutos = $this->model->qryBuscaCategoria(
            $par_pesquisa,
            $idCategoria,
            $valorMaximo,
            $valorMinimo
        );

        return response()->json($buscaProdutos);
    }

    public function excluiProduto(Request $request)
    {
        // Recupera os Dados
        $idProduto = $request->input('idProduto');

        $result = $this->model->qryDeletaProduto($idProduto);

        // Verifica o retorno
        if ($result == 'SUCESSO') {
            $result = [
                'tipo' => 'ok'
            ];
        } else {
            $result = [
                'tipo' => 'notOk'
            ];
        }

        return response()->json($result);
    }
}
