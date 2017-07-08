<?php

namespace Ozgurince\Simpleforum\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ozgurince\Simpleforum\Models\Comment;
use Ozgurince\Simpleforum\Jobs\UploadFiles;
use Ozgurince\Simpleforum\Requests\StoreCommentRequest;
use Ozgurince\Simpleforum\Requests\UpdateCommentRequest;


class CommentsController extends Controller
{   

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('store', 'edit', 'update', 'destroy');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreCommentRequest $request)
    {   
        $requestData = $request->except('files');
        $requestData['user_id'] = Auth::user()->id;

        $comment = Comment::create($requestData);

        if ($request->hasFile('files'))             
            $this->dispatch(new UploadFiles(request('files'), "comment", $comment->id));

        return redirect()->route('questions.show', $comment->commentable->id)->with('success', 'Yorumunuz eklendi!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        if (!$comment->canEditOrDelete()) 
            return back();

        return view('simpleforum::comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, UpdateCommentRequest $request)
    {
        $comment = Comment::findOrFail($id);

        if (!$comment->canEditOrDelete()) 
            return back();

        $requestData = $request->all();        
        $comment->update($requestData);
        
        if ($request->hasFile('files'))             
            $this->dispatch(new UploadFiles(request('files'), "comment", $comment->id));

        return redirect()->route('questions.show', $comment->commentable->id)->with('success', 'Yorumunuz başarıyla güncellendi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        Comment::destroy($id);

        return redirect()->route('questions.show', $comment->commentable->id)->with('success', 'Yorumunuz başarıyla silindi!');
    }
}
