<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = \App\Models\Category::all();

        return view('book.category.categoryView', compact('categories'));
    }

    public function addView()
    {
        return view('book.category.addCategoryView');
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $data = [
          'name' => $request->name
        ];

        if(\App\Models\Category::where('name', $request->name)->exists()) {
            return redirect('/book/category');
        }
        \App\Models\Category::create($data);

        return redirect('/book/category');
    }

    public function saveView($category_id)
    {
        $category = \App\Models\Category::findOrFail($category_id);

        $old_data = [
            'id' => $category->id,
            'name' => $category->name
        ];

        return view('book.category.saveCategoryView', compact('old_data'));
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        //get category with same name, if exists, set for all books the id of the category
        //found and delete this category
        if(\App\Models\Category::where('name', $request->name)->exists()) {
            $category_id = \App\Models\Category::where('name', $request->name)->first()->id;
            $data = [
                'category_id' => $category_id
            ];
            \App\Models\Book::where('category_id', $request->id)->update($data);
            \App\Models\Category::where('id', $request->id)->delete();

            return redirect('/book/category');
        }
        //else... if it doesn't exist, just change the name
        $data = [
            'name' => $request->name
        ];
        \App\Models\Category::where('id', $request->id)->update($data);

        return redirect('/book/category');
    }

    public function delete($category_id)
    {
        //if there are books in this category, delete the books, then delete the category
        if(\App\Models\Book::where('category_id', $category_id)->exists()) {
            $books = \App\Models\Book::where('category_id', $category_id)->get();
            foreach ($books as $book) {
                Storage::delete('public_html/uploads/'.$book->id.'.pdf');
                $book->delete();
            }
        }

        \App\Models\Category::where('id', $category_id)->delete();

        return redirect('/book/category');
    }
}
