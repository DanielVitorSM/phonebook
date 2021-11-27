@extends('layouts/main')

@section('title')

    <section class="d-flex flex-row align-items-center justify-content-between mb-4">
        <h3>Contatos</h3>
        <a href="/add" class="text-decoration-none text-primary">Adicionar</a>
    </section>

@endsection

@section('content')

    @if (count($contacts) > 0 || $search != '')
        <section class="mb-4">
            <form action="/" method="get">
                <div class="row g-2 justify-content-center">
                    <div class="col-auto">
                        <input value="{{ $search }}" name="search" type="text" class="form-control" placeholder="Pesquisar nome ou número...">
                    </div>
                    <div class="col-auto">
                        @if ($search)
                        <a href="/" class="btn btn-danger">Limpar</a>
                        @endif
                        <button class="btn btn-primary">Pesquisar</button>
                    </div>
                </div>
            </form>
        </section>
    @endif

    <section class="scrollable">
        @if (count($contacts) > 0)
            @foreach ($contacts as $contact)
                <a href="/{{ $contact->cell }}" class="d-flex flex-row text-reset text-decoration-none mb-2">
                    <img width="50" height="50" class="rounded-circle me-3" src="/images/contacts/{{ $contact->image }}">
                    <div>
                        <strong>{{ $contact->name }}</strong> <br>
                        <small>{{ $contact->getCellFormatted() }}</small>
                    </div>
                </a>
            @endforeach
        @else
            <p class="text-center">Nenhum contato encontrado</p>
        @endif
    </section>

@endsection