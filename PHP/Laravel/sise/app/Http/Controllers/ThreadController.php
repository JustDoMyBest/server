<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Channel;
use App\Trending;
use Illuminate\Http\Request;
use App\Filters\ThreadsFilters;
use Illuminate\Support\Facades\Redis;

class ThreadController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth')->only('store'); // 白名单，意味着仅 store 方法需要登录
        $this->middleware('auth')->except(['index','show']); // 白名单，意味着仅 store 方法需要登录
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel,ThreadsFilters $filters,Trending $trending)
    {
        $threads = $this->getThreads($channel, $filters);
        //    dd($threads);

        if(request()->wantsJson()){
            return $threads;
        }

        // $trending = array_map('json_decode',Redis::zrevrange('trending_threads',0,4));

        // return view('threads.index', compact('threads','trending'));

        return view('threads.index',[
            'threads' => $threads,
            'trending' => $trending->get()
        ]);
    }

    // protected function getThreads(Channel $channel)
    // {
    //     if ($channel->exists) {
    //         $threads = $channel->threads()->latest();
    //     } else {
    //         $threads = Thread::latest();
    //     }

    //     if ($username = request('by')) {
    //         $user = \App\User::where('name', $username)->firstOrFail();

    //         $threads->where('user_id', $user->id);
    //     }

    //     $threads = $threads->get();
    //     return $threads;
    // }
    protected function getThreads(Channel $channel, ThreadsFilters $filters)
    {
        // $threads = Thread::latest()->filter($filters);
        $threads = Thread::with('channel')->latest()->filter($filters);

        if ($channel->exists) {
            $threads->where('channel_id', $channel->id);
        }

        // dd($threads->toSql());

        // $threads = $threads->get();
        // $threads = $threads->paginate(20);
        $threads = $threads->paginate(4);

        return $threads;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $this->validate($request,[
            'title' => 'required|spamfree',
            'body' => 'required|spamfree',
            'channel_id' => 'required|exists:channels,id'
        ]);

        // $spam->detect($request['body']);
    
        $thread = Thread::create([
            'user_id' => auth()->id(),
            'channel_id' => request('channel_id'),
            'title' => request('title'),
            'body' => request('body'),
        ]);
    
        return redirect($thread->path())
            // ->with('flash','Your thread has been published!');
            ->with('flash','你已成功发布在线互动学习问答！');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show($channelId,Thread $thread,Trending $trending)
    {
        //
        //return view('threads.show',compact('thread')); 
        // return view('threads.show',[
        //     'thread' => $thread,
        //     // 'replies' => $thread->replies()->paginate(2)
        //     'replies' => $thread->replies()->get()
        // ]);
        if(auth()->check()){
            auth()->user()->read($thread);
        }

        // Redis::zincrby('trending_threads',1,json_encode([
        //     'title' => $thread->title,
        //     'path' => $thread->path()
        // ]));

        $trending->push($thread);

        return view('threads.show',compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy($channel,Thread $thread)
    {
        //
        $this->authorize('update',$thread);
    
        $thread->delete();
    
        if(request()->wantsJson()){
            return response([],204);
        }
    
        return redirect('/threads');
    }
}
