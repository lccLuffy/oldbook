<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;
use App\Http\Requests\CategoryUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryCreateRequest;

class CategoryController extends Controller
{
    //
    protected $fields = [
        'name' => '',
        'meta_description' => '',
        'category_image' => '',
    ];


    public function index()
    {
        $data = array();
        $data['categories'] = Category::all();

        return view('auth.admin.show_categories')->with($data);
    }

    public function create()
    {
        $data = [];
        foreach ($this->fields as $field => $default) {
            $data[$field] = old($field,$default);
        }
        return view('auth.admin.create_category',$data);
    }

    public function store(CategoryCreateRequest $request)
    {
        echo 'store';
        $tag = new Category();
        foreach (array_keys($this->fields) as $field) {
            $tag->$field = $request->get($field);
        }
        $tag->save();

        return redirect()
            ->route('admin.category.index')
            ->withSuccess("The Category '$tag->name' was created.");
    }

    public function edit($id)
    {
        $tag = Category::findOrFail($id);
        $data = ['id' => $id];
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $tag->$field);
        }

        return view('auth.admin.edit_category', $data);
    }
    public function update(CategoryUpdateRequest $request, $id)
    {
        $tag = Category::findOrFail($id);

        foreach (array_keys($this->fields) as $field) {
            $tag->$field = $request->get($field);
        }

        $tag->save();

        return redirect()
            ->route('admin.category.edit',$id)
            ->withSuccess("Changes saved.");
    }
    public function destroy($id)
    {
        $tag = Category::findOrFail($id);

        $tag->delete();

        return redirect()
            ->route('admin.category.index')
            ->withSuccess("The '$tag->name' tag has been deleted.");
    }
}
