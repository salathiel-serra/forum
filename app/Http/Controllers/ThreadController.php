<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\{
    Thread, User, Channel
};

class ThreadController extends Controller
{
    private $thread;
    public function __construct(Thread $thread)
    {
        $this->thread = $thread;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Channel $channel)
    {
        $channelParam = $request->channel;
        if (null !== $channelParam) {
            $threads = $channel->whereSlug($channelParam)->first()->threads()->paginate(5);
        } else {
            $threads = $this->thread->orderBy('created_at', 'DESC')->paginate(5);
        }
        return view('threads.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $thread         = $request->all();
            $thread['slug'] = Str::slug($thread['title']);

            $user = User::find(1);
            $thread = $user->threads()->create($thread);

            flash('Tópico criado com sucesso!')->success();
            return redirect()->route('threads.show', $thread->slug);
            
        } catch (\Exception $e) {
            $message = env('APP_ENV') ? $e->getMessage() : "Erro ao processar sua requisição!";
            
            flash($message)->warning();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $thread
     * @return \Illuminate\Http\Response
     */
    public function show($thread)
    {
        $thread = $this->thread->whereSlug($thread)->first();
        if(!$thread) return redirect()->route('threads.index');
        return view('threads.show', compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit($thread)
    {
        $thread = $this->thread->whereSlug($thread)->first();
        return view('threads.edit', compact('thread'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $thread)
    {
        try {
            $thread = $this->thread->whereSlug($thread)->first();
            $thread->update($request->all());

            flash('Tópico atualizado com sucesso!')->success();
            return redirect()->route('threads.show', $thread->slug);

        } catch (\Exception $e) {
            $message = env('APP_ENV') ? $e->getMessage() : "Erro ao processar sua requisição!";
            
            flash($message)->warning();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy($thread)
    {
        try {
            $thread = $this->thread->whereSlug($thread)->first();
            $thread->delete();

            flash('Tópico removido com sucesso!')->success();
            return redirect()->route('threads.index');

        } catch (\Exception $e) {
            $message = env('APP_ENV') ? $e->getMessage() : "Erro ao processar sua requisição!";
            
            flash($message)->warning();
            return redirect()->back();
        }
    }
}
