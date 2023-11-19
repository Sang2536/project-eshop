<?php
namespace App\Helpers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Unit;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class ProductHelper
{
    public function getProduct($id = null) : Object
    {
        $products = null;

        if (empty($id)) {
            $products = Product::all();
        } else {
            $products = Product::findOrFail($id);
        }

        return $products;
    }

    public function selectDropdownForProduct() : Object
    {
        $products = Product::select('id', DB::raw('CONCAT(name, " (sku: ", sku, ")") as name_sku'))->pluck('name_sku', 'id');

        return $products;
    }

    public function getDatatableForProduct()
    {
        $products = Product::all();

        return DataTables::of($products)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $action = '<a data-href="' . route("products.show", $row->id) . '" role="button" class="btn btn-info btn-block bg-info btn-sm product_show">
                            <i class="fa-solid fa-eye fa-fw me-1"></i><span>Show</span>
                        </a> &nbsp';

                if (auth()->user()->id == $row->created_by || Gate::allows('administrator')) {
                        $action .= '<a href="' . route("products.edit", $row->id) . '" role="button" class="btn btn-secondary btn-block bg-secondary btn-sm">
                        <i class="fas fa-edit fa-fw me-1"></i><span>Edit</span>
                    </a> &nbsp';
                    $action .= '<a href="' . route("products.destroy", $row->id) . '" role="button" class="btn btn-danger btn-block bg-danger btn-sm">
                            <i class="fa fa-trash fa-fw me-1"></i><span>Delete</span>
                        </a> &nbsp';
                }

                return $action;
            })
            ->addColumn('category_name', function ($row) {
                //con
                $category = Category::where('id', $row->category_id)->select('id', 'parent_id', 'name')->first();

                $category_name = '';

                if (!empty($category->parent_id)) {
                    $category_parent_name = Category::where('id', $category->parent_id)->select('id', 'name')->first();

                    $category_name = $category_parent_name->name . '<br /><i class="fa-solid fa-arrow-right"></i> ' . $category->name;
                } else {
                    $category_name = $category->name;
                }

                return $category_name;
            })
            ->addColumn('unit_name', function ($row) {
                $unit = Unit::where('id', $row->unit_id)->select('id', 'name', 'abbr')->first();

                $unit_name = $unit->name . '(' . $unit->abbr .')';

                return $unit_name;
            })
            ->editColumn('created_by', function ($row) {
                $user = User::where('id', $row->created_by)->select('uid', 'name')->first();

                return $user->name. '<br />(uid: ' . $user->uid .')';
            })
            ->editColumn('price_buy', function ($row) {
                $price_buy = formatCurrency($row->price_buy) . '<i class="fa-solid fa-dong-sign"></i>';

                return $price_buy;
            })
            ->editColumn('price_sale', function ($row) {
                $price_sale = formatCurrency($row->price_sale) . '<i class="fa-solid fa-dong-sign"></i>';

                return $price_sale;
            })
            ->editColumn('photo', function ($row) {
                $photo = '<img src="'. $row->photo .'" class="rounded mx-auto d-block" alt="'. $row->cid .'">';

                return $photo;
            })
            ->rawColumns(['action', 'category_name', 'unit_name', 'created_by', 'price_buy', 'price_sale', 'photo'])
            ->make(true);
    }

    public function createProduct(array $input) : Object
    {
        $product = [
            'name' => $input['name'],
            'category_id' => $input['category_id'],
            'type' => $input['type'],
            'quantity' => $input['quantity'],
            'unit_id' => $input['unit_id'],
            'price_buy' => $input['price_buy'],
            'price_sale' => $input['price_sale'],
            'short_description' => $input['short_description']
        ];

        if (empty($input['sku'])) {
            $product['sku'] = generateRandomString('012345789ABCDEFGHIJKLMNOPQRSTUVWXYZ', 12);
        } else {
            $product['sku'] = $input['sku'];
        }

        if (!empty($input['photo'])) {
            $photo = uploadPhoto($input['photo']);

            $contact['photo'] = $photo;
        }

        $contact['created_by'] = auth()->user()->id;

        $output = Product::create($product);

        return $output;
    }

    public function updateProduct($id, $input) : Object
    {
        $product = $this->getProduct($id);

        $product->name = $input['name'];
        $product->category_id = $input['category_id'];
        $product->type = $input['type'];
        $product->quantity = $input['quantity'];
        $product->unit_id = $input['unit_id'];
        $product->price_buy = $input['price_buy'];
        $product->price_sale = $input['price_sale'];
        $product->short_description = $input['short_description'];
        $product->photo = $input['photo'];
        $product->save();

        return $product;
    }

    public function destroyProduct($id) : bool
    {
        $product = Product::where('id', $id)->delete();

        return true;
    }

    public function updateQuantityForProduct($id, $quantity)
    {
        $product = Product::findOrFail($id);

        $product->quantity = $quantity;
        $product->save();
    }
}
