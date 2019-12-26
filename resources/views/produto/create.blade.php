@extends('layouts.app')
@section('title', 'Adicionar um produto')
@section('content')
<h1>Criar um novo produto</h1>
@if(Session::has('mensagem'))
    <div class="alert alert-success">
        {{Session::get('mensagem')}}
    </div>
@endif
@if(count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
        </ul>
    </div>
@endif

<button type="button" class="btn btn-info" data-toggle="modal" data-target="#janela">
    Adicionar
</button>

{{Form::open(['class'=>'modal fade', 'action' => 'ProdutosController@store', 'id' => 'janela'])}}
<!-- Janela Modal -->
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

@endsection