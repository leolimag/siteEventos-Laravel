<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

//actions

class EventController extends Controller
{
    public function index(){

        $search = request('search');

        if ($search){ 
            $events = Event::where([['title', 'like', '%'.$search .'%']])->get(); //comando like do sql, com '%' para verificar se há algum título que contenha a busca
        } else {
            $events = Event::all();
        }

        return view('home', ['events' => $events, 'search' => $search]);   
    }

    public function create() {
        return view('events.create');
    }

    public function store(Request $request) {
        $event = new Event();
        $event->title = $request->title;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items;
        $event->date = $request->date;

        //imagem upload
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/events'), $imageName);
            $event->image = $imageName;
        }

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect("/")->with('msg', 'Evento criado com sucesso!');
    }

    public function show($id){
        $event = Event::findOrFail($id);
        $user = auth()->user();
        $hasUserJoined = false;

        if($user) {
            $userEvents = $user->eventsAsParticipants->toArray();
            foreach($userEvents as $userEvent) {
                if($userEvent['id'] == $id){
                    $hasUserJoined = true;
                }
            }
        }

        $owner = User::where('id', $event->user_id)->first()->toArray();

        return view('events.show', ['event' => $event, 'owner' => $owner, 'hasUserJoined' => $hasUserJoined]);
    }

    public function dashboard() {
        $user = auth()->user();
        $events = $user->events;
        $eventsAsParticipant = $user->eventsAsParticipants;
        return view('events.dashboard', ['events' => $events, 'eventsAsParticipants' => $eventsAsParticipant]);
    }

    public function destroy($id) {
        Event::findOrFail($id)->delete();
        return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso!');
    }

    public function edit($id) {
        $user = auth()->user();
        $event = Event::findOrFail($id);
        if ($user->id != $event->user_id){
            return redirect('/dashboard');
        }

        return view('events.edit', ['event' => $event]);
    }

    public function update(Request $request) {
        $data = $request->all();
        
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/events'), $imageName);
            $data['image'] = $imageName;
        
        }

        Event::findOrFail($request->id)->update($data);
        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso!');
    }

    public function joinEvent($id) {
        $user = auth()->user();
        $user->eventsAsParticipants()->attach($id);
        $event = Event::findOrFail($id);
        return redirect('/dashboard')->with('msg', 'Sua presença está confirmada no evento ' . $event->title . "!");
    }

    public function leaveEvent($id) {
        $user = auth()->user();
        $user->eventsAsParticipants()->detach($id);
        $event = Event::findOrFail($id);
        return redirect('/dashboard')->with('msg', 'Você saiu do evento ' . $event->title . "!");
    }


} 
