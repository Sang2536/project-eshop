<?php

namespace App\Http\Controllers;

use App\Helpers\CategoryHelper;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryHelper;
    protected $userHepler;

    public function __construct(CategoryHelper $categoryHelper, UserHelper $userHelper)
    {
        $this->categoryHelper = $categoryHelper;
        $this->userHepler = $userHelper;
    }

    public function index(Request $request)
    {
        if(!auth()->check()) {
            return redirect()->route('login.layout');
        }

        if($request->ajax()) {
            return $this->categoryHelper->getDatatableForCategory();
        }

        return view('categories/index');
    }

    public function create()
    {
        if (!auth()->check()) {
            return redirect()->route('login.layout');
        }

        $parent_category = $this->categoryHelper->selectDropdownForCategory(true);

        return view('categories/create')->with(['parent_category' => $parent_category]);
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login.layout');
        }

        try {
            $request->validate([
                'name' => 'required',
                'type' => 'required',
            ]);

            $input = $request->only(['name', 'parent_id', 'type', 'description']);

            $this->categoryHelper->createCategory($input);
        } catch (\Throwable $th) {
            abort(403, 'Error: ' . $th->getMessage());
        }

        return redirect()->route('categories.index');
    }

    public function show($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login.layout');
        }

        $category = $this->categoryHelper->getCategory($id);

        $output = [];
        if (!empty($category)) {
            $user = $this->userHepler->getUser($category->created_by);

            $output['username'] = $user->name;
            $output['user_uid'] = $user->uid;
        }

        if (!empty($category->parent_id)) {
            $category_name = $this->categoryHelper->getCategory($category->parent_id);

            $output['cate_name'] = $category_name->name;
            $output['cate_code'] = $category_name->code;
        }

        return view('categories/show')->with(['category' => $category, 'output' => $output]);
    }

    public function edit($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login.layout');
        }

        $category = $this->categoryHelper->getCategory($id);
        $parent_category = $this->categoryHelper->selectDropdownForCategory(true);

        return view('categories/edit')->with(['category' => $category, 'parent_category' => $parent_category]);
    }

    public function update(Request $request, $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login.layout');
        }

        try {
            $input = $request->only(['name', 'parent_id', 'type', 'description']);

            $category = $this->categoryHelper->updateCategory($id, $input);
        } catch (\Throwable $th) {
            abort(403, 'Error: ' . $th->getMessage());
        }

        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login.layout');
        }

        try {
            $category = $this->categoryHelper->destroyCategory($id);
        } catch (\Throwable $th) {
            abort(403, 'Error: ' . $th->getMessage());
        }

        return redirect()->route('categories.index');
    }
}
