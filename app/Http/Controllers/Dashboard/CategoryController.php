<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\PutRequest;
use App\Http\Requests\Category\StoreRequest;
use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = category::all();
        echo view('dashboard.category.index', ["category" => $category]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $category = new category();
        echo view('dashboard.category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        //
        category::create($request->validated());
        return to_route("category.index")->with('status',"Registro creado.");
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        return view("dashboard.category.show", compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        //

        echo view('dashboard.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, category $category)
    {
        //
        // dd($request->validated());
        $data = $request->validated();

        $category->update($data);
        // $request->session()->flash('status',"Registro actualizado.");
        return to_route("category.index")->with('status',"Registro actualizado.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        //
        $category->delete();
        return to_route("category.index")->with('status',"Registro eliminado.");
    }
}
