@extends('layouts.main') <?php //captura o layout que foi padronizado?>
@section('title', 'Criar Evento') <?php //seta o título do layout padrão?>

@section('content') <?php //insere o conteúdo?>

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Crie o seu evento</h1>
    <form action="/events" method="post" enctype="multipart/form-data" name="frmCreate">
        @csrf <?php //diretiva para permitir o envio do form ?>
        <div class="form-group">
            <label for="image">Foto do evento:</label>
            <input type="file" class="form-control-file" id="image" name="image" required>
        </div>
        <div class="form-group">
            <label for="title">Evento:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento" required>
        </div>
        <div class="form-group">
            <label for="title">Data do evento:</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <div class="form-group">
            <label for="city">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Local do evento" required>
        </div>
        <div class="form-group">
            <label for="private">O evento é privado?</label>
            <select name="private" id="private" class="form-control">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Descrição:</label>
            <textarea name="description" id="description" class="form-control" placeholder="O que vai acontecer no evento?"></textarea>
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
        <input type="submit" value="Criar Evento" class="btn btn-primary">
    </form>
</div>

@endSection