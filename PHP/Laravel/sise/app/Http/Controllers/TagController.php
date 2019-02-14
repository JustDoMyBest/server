<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use App\Filters\TagFilters;

class TagController extends Controller
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
    public function index(Request $request, TagFilters $filters)
    {
        //
        $request->session()->flash('by', $request['by']);
        $request->session()->flash('tag', $request['tag']);
        $request->session()->flash('enabled', $request['enabled']);
            
        $tags = $this->getTag($filters);
        // dd($filters);
        // dd($tags);
        // $old = $request;
        // return view('awesome_sharing_courses_resources.backend_BS_JQ.tag_list', [
        return view('awesome_sharing_courses_resources.backend_BS_JQ.tag_index', [
            'tags' => $tags,
            // 'old' => $old,
        ])->with('by',$request['by']);
    }

    public function getTag(TagFilters $filters){
        $tags = Tag::latest()->filter($filters);

        $tags = $tags->paginate(5);

        return $tags;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // dd(123);exit;
        return view('awesome_sharing_courses_resources.backend_BS_JQ.tag_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd(('创建成功'),
        // request('tag'),
        // !!request('enabled'));
        $this->validate($request, [
            'tag' => 'required'
        ]);

        Tag::create([
            'user_id' => auth()->id(),
            'tag' => request('tag'),
            'enabled' => !!request('enabled')
        ]);

        return redirect('/tag');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
        // dd('editting');
        return view('awesome_sharing_courses_resources.backend_BS_JQ.tag_edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        //
        // dd($tag->enabled());
        // dd('updating');
        if ($request['enabled'] === '1') {
            $enabled = true;
        }else {
            $enabled = false;
        }
        // dd($request['enabled']);
        // dd($request['tag']);
        // dd($enabled);
        $tag->update([
            'tag' => $request['tag'],
            'enabled' => $enabled,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Tag $tag)
    public function destroy($tagId)
    {
        //
        // dd('deleting');
        // dd($tag);
        // dd($tagId);
        // dd(func_get_args());
        $tagId=is_array($tagId)? $tagId: (is_string($tagId)? explode(',', $tagId):func_get_args());
        // dd($tagId);
        \DB::table('tags')->whereIn('id',$tagId)->delete();
        // Tag::delete($tagId);
        // $tag->delete();
        return redirect()->back();
    }
}
