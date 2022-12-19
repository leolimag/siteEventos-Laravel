@extends('layouts.main') 
@section('title', $event->title) 

@section('content') 

<div class="col-md-10 offset-md-1">
        <div class="row">
            <div id="image-container" class="col-md-6">
                <img src="/img/events/{{ $event->image }}" class="img-fluid" alt="{{ $event->title }}">
            </div>
            <div id="info-container" class="col-md 6">
                <h1>{{ $event-> title }}</h1>
                <div class="div-events-info"><img src="/img/map_icon.png" alt="map icon" class="icon" <p class="event-city">   {{ $event->city }}</p></div>
                <div class="div-events-info"><img src="/img/profile_icon.png" alt="participants icon" class="icon" <p class="events-participants">   {{ count($event->users) }} Participantes</p></div>  
                <div class="div-events-info"><img src="/img/star_icon.png" alt="owner icon" class="icon" <p class="event-owner">   {{ $owner['name'] }}</p></div>  
                @if($event->items != null)
                    <h3 id="event-h3">O evento possui:</h3>
                    <ul id="items-list">
                        @foreach ($event->items as $item)
                            <li>{{$item}}</li>
                        @endforeach  
                    </ul>
                @endif
                @if(!$hasUserJoined)
                    <form action="/events/join/{{$event->id}}" method="post">
                        @csrf
                        <a href="/events/join/{{$event->id}}" class="btn btn-primary" id="confirm" onclick="event.preventDefault(); this.closest('form').submit();">Confirmar Presença</a>
                    </form>   
                @else
                    <p class="already-joined-msg">Você está confirmado para este evento.</p>
                @endif
            </div>
            <div class="col-md-12" id="description-container">
                <h3>Sobre o evento:</h3>
                <p class="event-description"> {{ $event->description }}</p>
            </div>
        </div>
</div>

@endSection