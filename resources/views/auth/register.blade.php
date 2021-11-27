@extends('layouts/main')

@section('title')
    
    <section class="d-flex flex-row align-items-center justify-content-between mb-4">
        <h3>Cadastrar</h3>
        <a href="/user/login" class="text-decoration-none text-primary">Entrar</a>
    </section>

@endsection

@section('content')

    <section class="mb-4 flex-fill">
        <form action="/user/register" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input name="name" type="text" class="form-control" id="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input name="email" type="email" class="form-control" id="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input name="password" type="password" class="form-control" id="password">
            </div>
            <button type="submit" class="btn btn-primary">Criar conta</button>
        </form>
    </section>

@endsection