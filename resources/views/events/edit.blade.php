@extends('layouts.main') <?php //captura o layout que foi padronizado?>
@section('title', 'Editando ' . $event->title) <?php //seta o título do layout padrão?>

@section('content') <?php //insere o conteúdo?>

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Editando {{$event->title}}</h1>
    <form action="/events/update/{{$event->id}}" method="post" enctype="multipart/form-data">
        @csrf <?php //diretiva para permitir o envio do form ?>
        @method('put')
        <div class="form-group">
            <label for="image">Foto do evento:</label>
            <input type="file" class="form-control-file" id="image" name="image">
            <img src="/img/events/{{$event->image}}" alt="{{$event->title}}" class="img-preview">
        </div>
        <div class="form-group">
            <label for="title">Evento:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento" value="{{$event->title}}">
        </div>
        <div class="form-group">
            <label for="title">Data do evento:</label>
            <input type="date" class="form-control" id="date" name="date" value="{{$event->date->format('Y-m-d')}}">
        </div>
        <div class="form-group">
            <label for="city">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Local do evento" value="{{$event->city}}">
        </div>
        <div class="form-group">
            <label for="private">O evento é privado?</label>
            <select name="private" id="private" class="form-control">
                <option value="0">Não</option>
                <option value="1" {{ $event->private == 1 ? "selected='selected'" : ""}}>Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Descrição:</label>
            <textarea name="description" id="description" class="form-control" placeholder="O que vai acontecer no evento?">{{$event->description}}</textarea>
        </div>
        <div class="form-group">
            <label for="title">Adicione itens de infraestrutura:</label>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Refil"> Refil
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Open food"> Open food
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Gincana"> Gincana
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Bar"> Bar
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Fotos"> Fotos
            </div>   
        </div>
        <input type="submit" value="Editar Evento" class="btn btn-primary">
    </form>
</div>

@endSection