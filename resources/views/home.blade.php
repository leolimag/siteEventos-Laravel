@extends('layouts.main') <?php //captura o layout que foi padronizado?>
@section('title', 'Home') <?php //seta o título do layout padrão?>

@section('content') <?php //insere o conteúdo?>

<div id="search-container" class="col-md-12">
    <h1>Busque um Evento</h1>
    <form action="/" method="get">
        <input type="text" name="search" id="search" class="form-control" placeholder="Procurar...">
    </form>
</div>

<div id="events-container" class="col-md-12">
    @if($search)
        <h2>Buscando por: {{$search}}</h2>
        <a href="/">Ver todos</a>
    @else 
        <h2>Próximos Eventos</h2>
        <p>Veja os eventos dos próximos dias</p>
    @endif
    <div id="cards-container" class="row">
        @foreach($events as $event)
            <div class="card col-md-3">
                <img src="/img/events/{{$event->image}}" alt="{{$event->title}}">
                <div class="card-body">
                    <p class="card-date">{{date('d/m/Y'), strtotime($event->date)}}</p>
                    <h5 class="card-title">{{$event->title}}</h5>
                    <p class="card-participants">{{count($event->users)}} participantes</p>
                    <a href="/events/{{ $event->id }}" class="btn btn-primary">Saber mais</a>
                </div>
            </div>
        @endforeach
        @if(count($events) == 0 && $search)
            <p>Não foi possível encontrar eventos com {{$search}}.</p>
        @elseif(count($events) == 0)
            <p>Não há eventos disponíveis.</p>
        @endif
    </div>
</div>

@endSection