<?php

namespace App\Http\Controllers;

use App\ContentCat;
use App\Repository\Contracts\ControllerRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $controllerRepo;
    protected $model = 'App\Category';

    /**
     * CategoryController constructor.
     * @param $controllerRepo
     */
    public function __construct(ControllerRepository $controllerRepo)
    {
        $this->controllerRepo = $controllerRepo;
    }


    /**'App\ContentCat'
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.cat.index')
            ->withItems($this->controllerRepo->getModel($this->model)->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'description' => 'required',
        ],
            [
                'name.unique' => 'The category already exist',
                'name.required' => 'The category field is required'
            ]
        );

        $this->controllerRepo->getModel($this->model)->create($request->all());

        notify()->success("Added successfully");

        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContentCat  $contentCat
     * @return \Illuminate\Http\Response
     */
    public function show(ContentCat $contentCat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContentCat  $contentCat
     * @return \Illuminate\Http\Response
     */
    public function edit($contentCat)
    {
        return view('admin.cat.edit')
            ->withItem($this->controllerRepo->getModel($this->model)->find($contentCat));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContentCat  $contentCat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $contentCat)
    {
        $this->controllerRepo->getModel($this->model)->update($contentCat, $request->all());

        notify()->success("Updated successfully");

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContentCat  $contentCat
     * @return \Illuminate\Http\Response
     */
    public function delete( $contentCat)
    {
        $this->controllerRepo->getModel($this->model)->delete($contentCat);

        notify()->success("Deleted successfully");

        return back();
    }
}
