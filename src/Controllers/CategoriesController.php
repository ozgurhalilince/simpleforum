<?php

namespace Ozgurince\Simpleforum\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ozgurince\Simpleforum\Models\Category;
use Ozgurince\Simpleforum\Models\User;
use Ozgurince\Simpleforum\Requests\StoreCategoryRequest;
use Ozgurince\Simpleforum\Requests\UpdateCategoryRequest;


class CategoriesController extends Controller
{   

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin')->only('store', 'edit', 'update', 'destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {/*
        dd(User::all()->each(function ($item)
        {
            $item->update(['photo_path' => asset('vendor/simpleforum/img/user-avatar.png')]);
        }));
        */

        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $categories = Category::where('name', 'LIKE', "%$keyword%")				
                ->paginate($perPage);
        } else {
            $categories = Category::paginate($perPage);
        }
        
        return view('simpleforum::categories.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreCategoryRequest $request)
    {
        $requestData = $request->all();
        // $requestData['slug'] = str_slug($request->name, '-');

        Category::create($requestData);

        return redirect()->route('categories.index')->with('success', 'Kategori eklendi!');
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
        $category = Category::findOrFail($id);

        return view('simpleforum::categories.show', compact('category'));
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
        $category = Category::findOrFail($id);
        //$select_categories = Category::pluck('name', 'id')->toArray();
        $select_categories = Category::all();
        return view('simpleforum::categories.edit', compact('category', 'select_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, UpdateCategoryRequest $request)
    {
        $category = Category::findOrFail($id);
        $requestData = $request->all();
        //$requestData['slug'] = str_slug($request->name, '-');
        
        $category->update($requestData);

        return redirect()->route('categories.index')->with('success', 'Kategori güncellendi!');
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
        Category::destroy($id);

        return redirect()->route('categories.index')->with('success', 'Kategori silindi!');
    }
}
