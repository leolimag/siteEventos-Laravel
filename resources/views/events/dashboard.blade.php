@extends('layouts.main') 
@section('title', 'Dashboard') 
@section('content') 

<div class="col-md-6 offset-md-1 dashboard-title-container">
    <h1>Meus Eventos</h1>
</div>
<div class="col-md-6 offset-md-1 dashboard-events-container">
    @if(count($events) > 0)
        <table class="table">
          <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Participantes</th>
                <th scope="col">Ações</th>
            </tr>
          </thead>  
          <tbody>
            @foreach($events as $event)
                <tr>
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                    <td>{{ count($event->users) }}</td>
                    <td><a href="/events/edit/{{$event->id}}" class="btn btn-info edit-btn">Editar</a>
                    <form action="/events/{{$event->id}}" method="post" name="frmDelete">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger delete-btn" onclick="confirmDelete()">Deletar</button>
                    </form>
                </tr>
            @endforeach
          </tbody>
        </table>
    @else   
        <p>Você ainda não possui eventos. <a href="/events/create">Crie um evento</a> agora!</p>
    @endif
</div>
<div class="col-md-6 offset-md-1 dashboard-title-container">
    <h1>Eventos que estou participando</h1>
</div>
<div class="col-md-6 offset-md-1 dashboard-events-container">
    @if(count($eventsAsParticipants) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Participantes</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>  
            <tbody>
                @foreach($eventsAsParticipants as $event)
                    <tr>
                        <td scope="row">{{ $loop->index + 1 }}</td>
                        <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                        <td>{{ count($event->users) }}</td>
                        <td>
                            <form action="/events/leave/{{$event->id}}" method="post" name="frmExit">
                                @csrf
                                @method("delete")
                                <button class="btn btn-danger delete-btn" onclick="confirmExit()">Sair do Evento</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else 
        <p>Você ainda não está participando de nenhum evento! <a href="">Clique aqui</a> para ver todos os eventos.</p>
    @endif
</div>

@endSection
