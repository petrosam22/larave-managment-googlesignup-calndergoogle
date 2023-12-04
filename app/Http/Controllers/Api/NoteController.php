<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Note;
use App\Models\User;

use Spatie\GoogleCalendar\Event;
use Illuminate\Support\Facades\DB;



class NoteController extends Controller
{



public function create(Request $request)
{

    $user = User::first();
    auth()->login($user);

    $event = new Event;

    $event->name = $request->name;
    $event->description = $request->description;
    $event->startDateTime = Carbon::now();
    $event->endDateTime = Carbon::now()->addHour();

    $event->save();


    $note = new Note();
    $note->title = $event->name;
    $note->description = $event->description;
    $note->user_id = $user->id;

    $note->save();
    Cache::put('note', $note);


    return response()->json([
        'note'=>$note,
        'message'=>'Note Created Successfully'
    ]);




}


public function index(Request $request){

    $user = User::first();
    auth()->login($user);
    $notes = Note::all();

     Cache::put('notes', $notes);


     $userNotes = Cache::remember('notes:' , $user->id,   function () use ($user) {
        return Note::where('user_id', $user->id)->paginate(5);
    });

    return $userNotes;
}

public function update(Request $request){
    $events = Event::get();



// update existing event
$firstEvent = $events->first();
$note =Note::where('title',$firstEvent->name)->first();
$note->update(['title'=>$request->name , 'description' => $request->description]);
$firstEvent->description = $request->description;

$firstEvent->name =$request->name;

 $firstEvent->save();


    return response()->json([
        'note'=>$note,
        'message' => 'Event updated successfully.',
    ]);
}


public function delete()
{
    $events = Event::get();
    $firstEvent = $events->first();
    
    $noteTitle = $firstEvent->name;
    
    // Find the note based on its title
    $note = Note::where('title', $noteTitle)->first();
    
    if ($note) {
        $user = $note->user;
        
        $note->delete();
        
        // Remove the note from the cache for the specific user
        Cache::forget('notes:' . $user->id);
        
        $firstEvent->delete();
        
        return response()->json([
            'message' => 'Event deleted successfully.',
        ]);
    }
    
    return response()->json([
        'message' => 'Note not found.',
    ], 404);
}

 

}
