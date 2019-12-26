@extends('layouts.app')
@section('title', 'Listagem de produtos')
@section('content')
<h1>Produtos</h1>
    @if(Session::has('mensagem'))
        <div class="alert alert-success">{{Session::get('mensagem')}}</div>
    @endif
    {{Form::open(['url' => ['produtos/buscar']])}}
    <div class="row">
        <div class="col-lg-12">
            <div class="input-group">
                {{Form::text('busca', $busca ,['class'=>'form-control','required','placeholder'=>'Buscar'])}}
                <span class="input-group-btn">
                    {{Form::submit('Buscar', ['class' => 'btn btn-outline-dark'])}}                    
                    <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#janela">
                        Adicionar
                    </button>
                    
                    <!--<a class= 'btn btn-outline-dark' href="adicionar-produto/">Adicionar</a>-->
                    
                </span>
            </div>
        </div>
    </div>
    {{Form::close()}}

    <!-- Janela Modal -->
    {{Form::open(['class'=>'modal fade', 'action' => 'ProdutosController@store', 'id' => 'janela'])}}
    <!-- <form class="modal fade" id="janela"> -->
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <!-- Cabecalho -->
                <div class="modal-header">
                    <h4 class="modal-title">Adicionar Produto</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>                
                    </button>
                </div>

                <!-- Corpo -->
                <div class="modal-body">

                    <div class="form-group">
                        {{Form::label('referencia', 'Referência')}}
                        {{Form::text('referencia','',['class'=>'form-control','required','placeholder'=>'Referência'])}}
                    </div>

                    <div class="form-group">
                        {{Form::label('titulo', 'Título')}}
                        {{Form::text('titulo','', ['class'=>'form-control','required','placeholder'=>'Título'])}}
                    </div>

                    <div class="form-group">
                        {{Form::label('descricao', 'Descrição')}}
                        {{Form::textarea('descricao','', ['rows' => 3, 'class' => 'form-control','required','placeholder' => 'Descrição'])}}
                    </div>

                    <div class="form-group">
                        {{Form::label('preco', 'Preço')}}
                        {{Form::text('preco','', ['class' => 'form-control','required','placeholder' => 'Preço'])}}
                    </div>
                
                </div>

                <!-- Rodape -->
                <div class="modal-footer">
                    {{Form::submit('Adicionar', ['class' => 'btn btn-info'])}}
                    <!--<button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancelar               
                    </button>

                    <button type="submit" class="btn btn-primary">
                        Logar               
                    </button> -->                
                </div>
            
            </div>
        
        </div>
    <!-- </form> -->
    {{Form::close()}}

    <div class="row">
        @foreach ($produtos as $produto)
            <div class="col-md-3">
                <h4>{{$produto->titulo}}</h4>
                @if(file_exists("./img/produtos/" . md5($produto->id) . ".jpg"))
                    <a class="thumbnail" href="{{ url('produtos/'. $produto->id) }}">
                        {{Html::image(asset("img/produtos/" . md5($produto->id) . ".jpg"))}}
                    </a>
                @else
                    <a class="thumbnail" href="{{ url('produtos/'. $produto->id) }}">
                        {{$produto->titulo}}}
                    </a>
                @endif
                {{Form::open(['route' => ['produtos.destroy', $produto->id], 'method' => 'DELETE'])}}
                <a class='btn btn-secondary' href="{{ url('produtos/' . $produto->id . '/edit') }}">Editar</a>
                {{Form::submit('Excluir', ['class' => 'btn btn-dark'])}}
                {{Form::close()}}
                <!--Ao invés do  {{$produto->titulo}} poderia ser usado <php echo $produto->titulo;?>-->
            </div>
        @endforeach
    </div>
{{ $produtos->links() }}
@endsection