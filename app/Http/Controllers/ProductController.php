<?php

namespace App\Http\Controllers;

use App\Actions\Products\ProductIndexAction;
use App\Actions\Products\ProductShowAction;
use App\Exceptions\Products\ProductNotFound;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(ProductIndexAction $action): View|RedirectResponse
    {
        try {
            return $action->handle();

        } catch (ProductNotFound $e) {

            session()->flash('error', $e->getMessage());

            return redirect()
                ->back();
        }
    }
    public function show(string $slug, ProductShowAction $action): View|RedirectResponse
    {
        try {
            $product = $action->handle($slug);

            return view('products.show', [
                'product' => $product,
            ]);

        } catch (ProductNotFound $e) {

            session()->flash('error', $e->getMessage());

            return redirect()
                ->back();
        }
    }
}
