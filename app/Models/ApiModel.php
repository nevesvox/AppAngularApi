<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ApiModel extends Model
{
    public function qyrGetAllProdutos() {
        return app('db')->select("SELECT PRODUTO.ID AS idProduto,
                                         PRODUTO.NOME AS nomeProduto,
                                         PRODUTO.DESCRICAO AS descricaoProduto,
                                         PRODUTO.VALOR AS valorProduto,
                                         PRODUTO.ESTOQUE AS estoqueProduto,
                                         CATEGORIA.NOME AS categoriaNome,
                                         CATEGORIA.ID AS categoriaId,
                                         CATEGORIA.DESCRICAO AS categoriaDescricao
                                 FROM PRODUTO
                                 JOIN CATEGORIA ON CATEGORIA.ID = PRODUTO.ID_CATEGORIA");
    }

    public function qryGetAllCategorias() {
        return app('db')->select("SELECT * FROM CATEGORIA");
    }

    public function qryNovaCategoria($nome, $descricao) {
        app('db')->insert('INSERT INTO CATEGORIA (NOME, DESCRICAO) 
                           VALUES (?, ?)', array($nome, $descricao));
        
        return 'SUCESSO';
    }

    public function qryAtualizaCategoria($id, $nome, $descricao) {
        app('db')->update("UPDATE CATEGORIA
                           SET NOME = '$nome',
                               DESCRICAO = '$descricao'
                           WHERE ID = '$id'");
        
        return 'SUCESSO';
    }

    public function qryNovoProduto(
        $idCategoria,
        $nome,
        $descricao,
        $valor,
        $estoque
    ) {
        app('db')->insert('INSERT INTO PRODUTO (ID_CATEGORIA, NOME, DESCRICAO, VALOR, ESTOQUE, CADASTRO) 
                           VALUES (?, ?, ?, ?, ?, ?)',array(
                                $idCategoria,
                                $nome,
                                $descricao,
                                $valor,
                                $estoque,
                                date("Y-m-d H:i:s")
                            ));
        
        return 'SUCESSO';
    }

    public function qryAtualizaProduto(
        $id,
        $nome,
        $descricao,
        $valor,
        $estoque,
        $idCategoria
    ) {
        app('db')->update("UPDATE PRODUTO
                           SET NOME = '$nome',
                               DESCRICAO = '$descricao',
                               VALOR = $valor,
                               ESTOQUE = $estoque,
                               ID_CATEGORIA = '$idCategoria'
                           WHERE ID = '$id'");
        
        return 'SUCESSO';
    }

    public function qryBuscaProduto($par_pesquisa, $pesquisa, $valorMaximo = null, $valorMinimo = null)
    {
        $par_qry = "SELECT PRODUTO.ID AS idProduto,
                           PRODUTO.NOME AS nomeProduto,
                           PRODUTO.DESCRICAO AS descricaoProduto,
                           PRODUTO.VALOR AS valorProduto,
                           PRODUTO.ESTOQUE AS estoqueProduto,
                           CATEGORIA.NOME AS categoriaNome,
                           CATEGORIA.ID AS categoriaId,
                           CATEGORIA.DESCRICAO AS categoriaDescricao
                    FROM PRODUTO
                    JOIN CATEGORIA ON CATEGORIA.ID = PRODUTO.ID_CATEGORIA
                    WHERE PRODUTO.NOME LIKE '%$pesquisa%'";

        if ($par_pesquisa == 1) {
            $par_qry = $par_qry . "AND PRODUTO.VALOR BETWEEN $valorMinimo AND $valorMaximo";
        }

        if ($par_pesquisa == 2) {
            if ($valorMinimo) {
                $par_qry = $par_qry . "AND PRODUTO.VALOR >= $valorMinimo";
            }
            if ($valorMaximo) {
                $par_qry = $par_qry . "AND PRODUTO.VALOR <= $valorMaximo";
            }
        }

        return app('db')->select($par_qry);
    }

    public function qryBuscaCategoria($par_pesquisa, $idCategoria, $valorMaximo = null, $valorMinimo = null)
    {
        $par_qry = "SELECT PRODUTO.ID AS idProduto,
                           PRODUTO.NOME AS nomeProduto,
                           PRODUTO.DESCRICAO AS descricaoProduto,
                           PRODUTO.VALOR AS valorProduto,
                           PRODUTO.ESTOQUE AS estoqueProduto,
                           CATEGORIA.NOME AS categoriaNome,
                           CATEGORIA.ID AS categoriaId,
                           CATEGORIA.DESCRICAO AS categoriaDescricao
                    FROM PRODUTO
                    JOIN CATEGORIA ON CATEGORIA.ID = PRODUTO.ID_CATEGORIA
                    WHERE PRODUTO.ID_CATEGORIA = '$idCategoria'";

        if ($par_pesquisa == 1) {
            $par_qry = $par_qry . "AND PRODUTO.VALOR BETWEEN $valorMinimo AND $valorMaximo";
        }

        if ($par_pesquisa == 2) {
            if ($valorMinimo) {
                $par_qry = $par_qry . "AND PRODUTO.VALOR >= $valorMinimo";
            }
            if ($valorMaximo) {
                $par_qry = $par_qry . "AND PRODUTO.VALOR <= $valorMaximo";
            }
        }

        return app('db')->select($par_qry);
    }

    public function qryDeletaProduto($idProduto)
    {
        app('db')->delete("DELETE FROM PRODUTO
                           WHERE ID = '$idProduto'");
        
        return 'SUCESSO';
    }
}