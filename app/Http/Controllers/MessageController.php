<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\Point;
use App\User;
use App\Message;
//use App\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    public function __construct()
    {
        $this->middleware('headmaster')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        $user_id = Auth::id();

        return view('messages.index')->with([
            'messages' => Message::with('sender')->orderBy('created_at', 'DESC')->where('receiver_id', $user_id)->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
        return view('messages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'receiver_name' => 'required',
            'subject' => 'required|max:255',
            'content' => 'required|max:1000000',
        ]);

        $receiver = User::where('name', $request->get('receiver_name'))->first();

        if(!empty($receiver)){
            try
            {
                \DB::beginTransaction();

                $message = new Message;
                $message->sender_id = \Auth::id();
                $message->receiver_id = $receiver->id;
                $message->subject = $request->get('subject');
                $message->content = $request->get('content');
                $message->save();

                // TODO: make support for attachments here (now just adding the same attachment for testing)
                $points = new Point;
                $points->receiver_id = $receiver->id;
                $points->benefactor_id = $message->sender_id;
                $points->score_type_id = 1;
                $points->save();

                $attachment = new Attachment;
                $attachment->message_id = $message->id;
                $attachment->type_id = Attachment::TYPE_POINTS;
                $attachment->points_id = $points->id;

                $message->attachments()->save($attachment);
                $message->save();

                // create the message
                \DB::commit();
            } catch (\Exception $e)
            {
                \DB::rollback();
                return redirect()->back()->with('error', 'Error creating message.' . var_export($e->getMessage(), true));
            }

            return redirect()->route('message.index')->with('success','Message successfully sent.');
        }

        return redirect()->back()->withInput()->with('error','Receiver not found!');
    }

    /**
     * Display the specified resource.
     *
     * @param  Message $message
     * @return mixed
     */
    public function show(Message $message)
    {
        return view('messages.show', [
            'message' => $message
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Message $message
     * @return mixed
     */
    public function edit(Message $message)
    {
        return view('messages.edit', [
            'message' => $message
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Message $message
     * @return mixed
     */
    public function destroy(Message $message)
    {
        $subject = $message->subject;

        $message->delete();

        return redirect()->route('message.index')->with('success','Message with subject: \'' . $subject . '\' successfully removed.');
    }
}
