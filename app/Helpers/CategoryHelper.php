<?php
namespace App\Helpers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class CategoryHelper
{
    public function getCategory($id = null) : Object
    {
        $categories = null;

        if (empty($id)) {
            $categories = Category::all();
        } else {
            $categories = Category::findOrFail($id);
        }

        return $categories;
    }

    public function selectDropdownForCategory($is_parent = false) 
    {
        $categories = null;

        if (!empty($is_parent)) {
            $categories = Category::whereNull('parent_id')->select('id','name')->pluck('name', 'id');
        } else {
            $categories = Category::select('id','name')->pluck('name', 'id');
        }

        return $categories->all();
    }

    public function getDatatableForCategory() {
        $categories = $this->getCategory();
        $parent_category = $this->selectDropdownForCategory(true);

        return DataTables::of($categories)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = '<a data-href="' . route("categories.show", $row->id) . '" role="button" class="btn btn-info btn-block bg-info btn-sm category_show">
                        <i class="fa-solid fa-eye fa-fw me-1"></i><span>Show</span>
                    </a> &nbsp';

                    if (auth()->user()->id == $row->created_by || Gate::allows('administrator')) {
                        $action .= '<a data-href="' . route("categories.edit", $row->id) . '" role="button" class="btn btn-secondary btn-block bg-secondary btn-sm category_edit">
                            <i class="fas fa-edit fa-fw me-1"></i><span>Edit</span>
                            </a> &nbsp';
                        $action .= '<a href="' . route("categories.destroy", $row->id) . '" role="button" class="btn btn-danger btn-block bg-danger btn-sm">
                                <i class="fa fa-trash fa-fw me-1"></i><span>Delete</span>
                            </a> &nbsp';
                    }

                    return $action;
                })
                ->editColumn('parent_id', function ($row) use ($parent_category) {
                    $parent_name = '';

                    if ($row->parent_id) {
                        foreach ($parent_category as $key => $value) {
                            if ($key == $row->parent_id) {
                                $parent_name = $value;
                            }
                        }
                    }

                    return $parent_name;
                })
                ->editColumn('created_by', function ($row) {
                    $user = User::where('id', $row->created_by)->select('uid', 'name')->first();

                    return $user->name. '<br />(uid: ' . $user->uid .')';
                })
                ->rawColumns(['action', 'parent_id', 'created_by'])
                ->make(true);
    }

    public function createCategory(Array $input) : Object
    {
        $lower_name = strtolower($input['name']);
        $slug = str_replace(" ", "-", $lower_name);
        $code = generateRandomString('012345789ABCDEFGHIJKLMNOPQRSTUVWXYZ', 12);
        $user_id = auth()->user()->id;

        $category = [
            'code' => $code,
            'name' => $input['name'],
            'parent_id' => $input['parent_id'],
            'type' => $input['type'],
            'description' => $input['description'],
            'slug' => $slug,
            'created_by' => $user_id
        ];

        $output = Category::create($category);

        return $output;
    }

    public function updateCategory($id, $input) : Object
    {
        $lower_name = strtolower($input['name']);
        $slug = str_replace(" ", "-", $lower_name);

        $category = $this->getCategory($id);

        $category->name = $input['name'];
        $category->parent_id = $input['parent_id'];
        $category->type = $input['type'];
        $category->description = $input['description'];
        $category->slug = $slug;
        $category->save();

        return $category;
    }

    public function destroyCategory($id) : Bool
    {
        $category = Category::where('id', $id)->delete();

        return true;
    }
}
