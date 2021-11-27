@extends('layouts/main')

@section('title')
    
    <section class="d-flex flex-row align-items-center justify-content-between mb-4">
        <h3>Entrar</h3>
        <a href="/user/register" class="text-decoration-none text-primary">Cadastrar</a>
    </section>

@endsection

@section('content')

    <section class="mb-4 flex-fill">
        <form action="/user/login" method="post">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input name="email" type="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input name="password" type="password" class="form-control" id="password">
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
    </section>

@endsection