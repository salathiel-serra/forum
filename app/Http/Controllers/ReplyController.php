<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use App\Http\Requests\ReplyRequest;

class ReplyController extends Controller
{
    public function store(ReplyRequest $request)
    {
        try {
            $reply = $request->all();
            $reply['user_id'] = 1;

            $thread = Thread::find($request->thread_id);
            $thread->replies()->create($reply);

            flash('Resposta criada com successo!')->success();
            return redirect()->back();

        } catch (\Exception $e) {
            $message = env('APP_ENV') ? $e->getMessage() : "Erro ao publicar resposta!";
            
            flash($message)->warning();
            return redirect()->back();
        }
    }
}
