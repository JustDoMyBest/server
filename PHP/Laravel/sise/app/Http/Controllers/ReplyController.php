<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use Illuminate\Http\Request;
use App\Spam;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\CreatePostRequest;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' => 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($channelId,Thread $thread)
    {
        //
        return $thread->replies()->paginate(2);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($channelId,Thread $thread,CreatePostRequest $request)
    {
        // if(Gate::denies('create',new Reply)) {
        //     return response(
        //         'You are posting too frequently.Please take a break.:)',422
        //     );
        // }

        // try{
        //     // $this->authorize('create',new Reply);
        //     $this->validate(request(),['body' => 'required|spamfree']);

            // $reply = $thread->addReply([
            //     'body' => request('body'),
            //     'user_id' => auth()->id(),
            // ]);
        // }catch (\Exception $e){
            // return response(
                // 'Sorry,your reply could not be saved at this time.',422
            // );
        // };

        // if(request()->expectsJson()){
            // return $reply->load('owner');
        // }
    
        // return back()->with('flash','Your reply has been left.');
        // return $reply->load('owner');
        return $reply = $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id(),
        ])->load('owner');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Reply $reply)
    {
        $this->authorize('update',$reply);

        //
        // try{
        //     // $this->validateReply();
        //     $this->validate(request(),['body' => 'required|spamfree']);

        //     $reply->update(request(['body']));
        // }catch (\Exception $e){
        //     return response(
        //         'Sorry,your reply could not be saved at this time.',422
        //     );
        // }
        $this->validate(request(),['body' => 'required|spamfree']);

        $reply->update(request(['body']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        //
        // if($reply->user_id != auth()->id()){
        //     return response([],403);
        // }
        $this->authorize('update',$reply);

        $reply->delete();

        if (request()->expectsJson()){
            return response(['status' => 'Reply deleted']);
        }

        return back();
    }

    // protected function validateReply()
    // {
    //     $this->validate(request(),['body' => 'required']);

    //     resolve(Spam::class)->detect(request('body'));
    // }
}
