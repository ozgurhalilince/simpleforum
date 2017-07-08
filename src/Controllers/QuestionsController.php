<?php

namespace Ozgurince\Simpleforum\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ozgurince\Simpleforum\Models\Question;
use Ozgurince\Simpleforum\Models\User;
use Ozgurince\Simpleforum\Jobs\UploadFiles;
use Ozgurince\Simpleforum\Models\Category;
use Ozgurince\Simpleforum\Requests\StoreQuestionRequest;
use Ozgurince\Simpleforum\Requests\UpdateQuestionRequest;

class QuestionsController extends Controller
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
    public function store(StoreQuestionRequest $request)
    {
        $requestData = $request->except('files');
        //$requestData['slug'] = str_slug($request->name, '-');
        $requestData["user_id"] = Auth::user()->id;

        $question = Question::create($requestData);
        
        if ($request->hasFile('files'))             
            $this->dispatch(new UploadFiles(request('files'), "question", $question->id));

        return redirect()->route('questions.show', $question->id)->with('success', 'Soru eklendi!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {           
        $question = Question::findOrFail($id);
       
        $comments = $question->comments()->with('likes')->get()->sortByDesc(function($comment)
        {
            return $comment->likes->count();
        });

        return view('simpleforum::questions.show', compact('question', 'comments'));
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
        $question = Question::findOrFail($id);

        if (!$question->canEditOrDelete()) 
            return back();

        $categories = Category::all();
        return view('simpleforum::questions.edit', compact('question', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, UpdateQuestionRequest $request)
    {
        $question = Question::findOrFail($id);

        if (!$question->canEditOrDelete()) 
            return back();

        $requestData = $request->all();
        
        $question->update($requestData);
        
        if ($request->hasFile('files'))             
            $this->dispatch(new UploadFiles(request('files'), "question", $question->id));

        return redirect()->route('questions.show', $question->id)->with('success', 'Soru güncellendi!');
    }
}
