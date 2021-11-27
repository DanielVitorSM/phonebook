@extends('layouts/main')

@section('content')

<section class="d-flex flex-row align-items-center justify-content-between mb-4">
    <h3>{{ $contact->name }}</h3>
    <a href="/" class="text-decoration-none text-primary">Voltar</a>
</section>

<section class="mb-4 flex-fill">
    <form action="/update/{{ $contact->id }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="image" class="form-label">Imagem</label>
        <div class="mb-3 d-flex flex-row align-items-center">
            <img width="150" height="150" src="/images/contacts/{{ $contact->image }}" class="rounded-circle">
            <div class="col-auto">
                <input name="image" type="file" class="form-control" id="image">
            </div>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input value="{{ $contact->name }}" name="name" type="text" class="form-control" id="name" required>
        </div>
        <div class="mb-3">
            <label for="cell" class="form-label">Celular</label>
            <input value="{{ $contact->getCellFormatted() }}" name="cell" type="text" class="form-control cell_with_ddd" id="cell" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Telefone Fixo</label>
            <input value="{{ $contact->getPhoneFormatted() }}" name="phone" type="text" class="form-control phone_with_ddd" id="phone">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input value="{{ $contact->email }}" name="email" type="email" class="form-control" id="email">
        </div>
        <div class="d-flex flex-row justify-content-between">
            <a onclick="showSureAlert(event)" href="/delete/{{ $contact->id }}" class="btn btn-danger">Excluir Contato</a>
            <button type="submit" class="btn btn-secondary">Atualizar Contato</button>
        </div>
    </form>
</section>

<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/jquery.mask.min.js"></script>
<script>
    $(document).ready(function(){
        $('.cell_with_ddd').mask('(00) 00000-0000');
        $('.phone_with_ddd').mask('(00) 0000-0000');
    });
    
    function showSureAlert(event) {
        var result = confirm("Tem certeza que deseja excluir esse contato? Essa ação NÃO PODERÁ SER DESFEITA!");
        if(!result) {
            event.preventDefault();
        }
    }
</script>

@endsection