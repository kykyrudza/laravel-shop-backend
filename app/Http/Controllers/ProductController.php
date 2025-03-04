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
        return $this->handleAction(fn() => $action->handle(), 'products.index', 'products');
    }

    public function show(string $slug, ProductShowAction $action): View|RedirectResponse
    {
        return $this->handleAction(fn() => $action->handle($slug), 'products.show', 'product');
    }

    private function handleAction(callable $callback, string $view, string $dataKey): View|RedirectResponse
    {
        try {
            $data = $callback();

            return view($view, [$dataKey => $data]);

        } catch (ProductNotFound $e) {
            session()->flash('error', $e->getMessage());

            return redirect()->back();
        }
    }
}
