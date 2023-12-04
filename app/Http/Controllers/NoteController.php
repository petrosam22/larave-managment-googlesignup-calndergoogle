<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use App\Models\Note;
use App\Models\User;

use Spatie\GoogleCalendar\Event;
use Illuminate\Support\Facades\DB;
class NoteController extends Controller
{


public function create(){
    return view('notes.create');

}
    public function store(Request $request)
{
    $user = Auth::user()->id;

    $event = new Event;

    $event->name = $request->name;
    $event->description = $request->description;
    $event->startDateTime = Carbon::now();
    $event->endDateTime = Carbon::now()->addHour();

    $event->save();


    $note = new Note();
    $note->title = $event->name;
    $note->description = $event->description;
    $note->user_id = $user;

    $note->save();
    Cache::put('note', $note);

    return redirect()->route('notes');





}

public function index(Request $request){

    $user = Auth::user();
    $notes = Note::all();

     Cache::put('notes', $notes);
    $notes = Cache::remember('notes:' , $user->id, function () use ($user) {
        return Note::where('user_id', $user->id)->get();
    });

    return view('notes.index', compact('notes'));
}


}
