@extends('layouts/main')

@section('content')

<section class="d-flex flex-row align-items-center justify-content-between mb-4">
    <h3>Adicionar</h3>
    <a href="/" class="text-decoration-none text-primary">Voltar</a>
</section>

<section class="mb-4 flex-fill">
    <form action="/add" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="image" class="form-label">Imagem</label>
            <input name="image" type="file" class="form-control" id="image">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input name="name" type="text" class="form-control" id="name" required>
        </div>
        <div class="mb-3">
            <label for="cell" class="form-label">Celular</label>
            <input name="cell" type="text" class="form-control cell_with_ddd" id="cell" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Telefone Fixo</label>
            <input name="phone" type="text" class="form-control phone_with_ddd" id="phone">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input name="email" type="email" class="form-control" id="email">
        </div>
        <button type="submit" class="btn btn-primary">Adicionar Contato</button>
    </form>
</section>

<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/jquery.mask.min.js"></script>
<script>
    $(document).ready(function(){
        $('.cell_with_ddd').mask('(00) 00000-0000');
        $('.phone_with_ddd').mask('(00) 0000-0000');
    });
</script>
@endsection