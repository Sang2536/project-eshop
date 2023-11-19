<?php

namespace App\Http\Controllers;

use App\Helpers\CategoryHelper;
use App\Helpers\ProductHelper;
use App\Helpers\UnitHelper;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productHelper;
    protected $categorytHelper;
    protected $unitHelper;

    public function __construct (ProductHelper $productHelper, categoryHelper $categorytHelper, UnitHelper $unitHelper)
    {
        $this->productHelper = $productHelper;
        $this->categorytHelper = $categorytHelper;
        $this->unitHelper = $unitHelper;
    }

    public function index(Request $request)
    {
        if(!auth()->check()) {
            return redirect()->route('login.layout');
        }

        if ($request->ajax()) {
            return $this->productHelper->getDatatableForProduct();
        }

        return view('products/index');
    }

    public function create()
    {
        if(!auth()->check()) {
            return redirect()->route('login.layout');
        }

        $units = $this->unitHelper->selectDropdownForUnit();
        $categories = $this->categorytHelper->selectDropdownForCategory();
        $types = [
            'single' => 'Single',
            'vaiable' => 'Variable',
            'modifier' => 'Modifier',
            'combo' => 'Combo'
        ];

        return view('products/create')->with(['units' => $units, 'categories' => $categories, 'types' => $types]);
    }

    public function store(Request $request)
    {
        if(!auth()->check()) {
            return redirect()->route('login.layout');
        }

        try {
            $input = $request->only(['name', 'category_id', 'type', 'quantity', 'unit_id', 'price_buy', 'price_sale', 'short_description']);

            $product = $this->productHelper->createProduct($input);
        } catch (\Throwable $th) {
            abort(403, 'Error: ' . $th->getMessage());
        }

        return redirect()->route('products.index');
    }

    public function show($id)
    {
        if(!auth()->check()) {
            return redirect()->route('login.layout');
        }

        $product = $this->productHelper->getProduct($id);

        return view('products/show')->with(['product' => $product]);
    }

    public function edit($id)
    {
        if(!auth()->check()) {
            return redirect()->route('login.layout');
        }

        $product = $this->productHelper->getProduct($id);
        $categories = $this->categorytHelper->selectDropdownForCategory();
        $units = $this->unitHelper->selectDropdownForUnit();
        $types = [
            'single' => 'Single',
            'vaiable' => 'Variable',
            'modifier' => 'Modifier',
            'combo' => 'Combo'
        ];

        return view('products/edit')->with(['product' => $product, 'categories' => $categories, 'units' => $units, 'types' => $types]);
    }

    public function update(Request $request, $id)
    {
        if(!auth()->check()) {
            return redirect()->route('login.layout');
        }

        try {
            $input = $request->only(['name', 'category_id', 'type', 'quantity', 'unit_id', 'price_buy', 'price_sale', 'short_description']);

            $product = $this->productHelper->updateProduct($id, $input);
        } catch (\Throwable $th) {
            abort(403, 'Error: ' . $th->getMessage());
        }

        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        if(!auth()->check()) {
            return redirect()->route('login.layout');
        }

        try {
            $product = $this->productHelper->destroyProduct($id);
        } catch (\Throwable $th) {
            abort(403, 'Error: ' . $th->getMessage());
        }

        return redirect()->route('products.index');
    }
}
