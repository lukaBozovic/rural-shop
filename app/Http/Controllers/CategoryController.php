<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Tables\CategoryTable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use ProtoneMedia\Splade\Facades\Toast;

class CategoryController extends Controller
{
    public function index() : View
    {
        return view('categories.index',  ['categories' => CategoryTable::class]);
    }
    public function create()
    {
        return view('categories.create');
    }

    public function store(StoreCategoryRequest $request) : RedirectResponse
    {
        $category = Category::query()->create($request->except('cover_image'));
        ImageHelper::addCoverPhoto($category, $request);

        Toast::message("Uspješno kreirana kategorija!")->autoDismiss(5);

        return redirect()->route('categories.index');
    }

    public function update(Category $category, StoreCategoryRequest $request)
    {

        $category->update($request->except('cover_image'));
        ImageHelper::addCoverPhoto($category, $request);

        Toast::message("Uspješno izmijenjena kategorija!")->autoDismiss(5);

        return redirect()->route('categories.index');
    }

    public function edit(Category $category) : View
    {
        return view('categories.edit', [
            'category' => $category,
        ]);
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return redirect()->back();
    }
}
