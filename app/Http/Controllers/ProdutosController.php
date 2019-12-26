<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto; //trazendo o model
use Session;

class ProdutosController extends Controller
{
    //trazendo todos os produtos
    public function index()
    {
        $produtos = Produto::paginate(4);
        return view('produto.index', array('produtos' => $produtos, 'busca' => null));
    }

    //encontrando produto especifico
    public function show($id)
    {
        $produto = Produto::find($id);
        return view('produto.show', ['produto' => $produto]);
        /*
        echo "<pre>";
        var_dump($produto);
        echo "</pre>";
        */
    }

    //inserindo um novo produto na tabela
    public function store(Request $request)
    {
        $this->validate($request, [
            'referencia' => 'required|unique:produtos|min:3', //campo unico no banco
            'titulo' => 'required|min:3',
        ]);

        $produto = new Produto();
        $produto->referencia = $request->input('referencia');
        $produto->titulo = $request->input('titulo');
        $produto->descricao = $request->input('descricao');
        $produto->preco = $request->input('preco');
        if ($produto->save()) {
            Session::flash('mensagem', 'Produto inserido com sucesso!');
            return redirect('produtos');
        }
    }

    //criando um formaulario
    public function create()
    {
        return view('produto.create');//nome da pasta.nome do arquivo
    }

    //tras os dados no formulário para serem alterados
    public function edit($id)
    {
        $produto = Produto::find($id);
        return view('produto.edit', array('produto' => $produto));
    }

    //função para alterar os dados
    public function update($id, Request $request)
    {
        $produto = Produto::find($id);
        $this->validate($request, [
            'referencia' => 'required|unique:produtos|min:3', //campo unico no banco
            'titulo' => 'required|min:3',
        ]);

        if ($request->hasFile('fotoproduto')) {
            $imagem = $request->file('fotoproduto');
            $nomearquivo = md5($id) .".". $imagem->getClientOriginalExtension();
            $request->file('fotoproduto')->move(public_path('./img/produtos/'), $nomearquivo);
        }

        $produto->referencia = $request->input('referencia');
        $produto->titulo = $request->input('titulo');
        $produto->descricao = $request->input('descricao');
        $produto->preco = $request->input('preco');
        $produto->save();

        Session::flash('mensagem', 'Produto alterado com sucesso!');
        return redirect('produtos');
    }

    //usado para deletar um item do banco
    public function destroy($id)
    {
        $produto = Produto::find($id);
        $produto->delete();
        Session::flash('mensagem', 'Produto excluido com sucesso!');
        return redirect()->back();
    }

    //executa a busca na barra de busca na page index
    public function buscar(Request $request)
    {
        $produtos = Produto::where('titulo', 'LIKE',
        '%' . $request->input('busca') . '%')->orwhere('descricao', 'LIKE',
        '%' . $request->input('busca') . '%')->paginate(4);
        return view('produto.index', array('produtos' => $produtos, 'busca' => $request->input('busca')));
    }
}
