<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\ProductSold;
use App\Models\Product;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function terminarOCancelarVenta(Request $request)
    {
        if ($request->input("accion") == "terminar") {
            return $this->terminarVenta($request);
        } else {
            return $this->cancelarVenta();
        }
    }

    public function terminarVenta(Request $request)
    {
        // Crear una venta
        $shoppingcart = new ShoppingCart();
        $shoppingcart->user_id = $request->input("user_id");
        $shoppingcart->saveOrFail();
        $shoppingcart_id = $shoppingcart->id;
        $product = $this->obtenerProductos();
        // Recorrer carrito de compras
        foreach ($product as $product) {
            // El producto que se vende...
            $productSold = new ProductSold();
            $productSold->fill([
                "shoppingcart_id " => $shoppingcart_id,
                "name" => $product->name,
                "description" => $product->description,
                "cost" => $product->cost,
                "amount" => $product->amount,
            ]);
            // Lo guardamos
            $productSold->saveOrFail();
            // Y restamos la existencia del original
            $updatedProduct = Product::find($product->id);
            $updatedProduct->stock -= $productSold->amount;
            $updatedProduct->saveOrFail();
        }
        $this->vaciarProductos();
        return redirect()
            ->route("shoppingcarts.index")
            ->with("mensaje", "Venta terminada");
    }

    private function obtenerProductos()
    {
        $products = session("products");
        if (!$products) {
            $products = [];
        }
        return $products;
    }

    private function vaciarProductos()
    {
        $this->guardarProductos(null);
    }

    private function guardarProductos($products)
    {
        session(["products" => $products,
        ]);
    }

    public function cancelarVenta()
    {
        $this->vaciarProductos();
        return redirect()
            ->route("shoppingcarts.index")
            ->with("mensaje", "Venta cancelada");
    }

    public function quitarProductoDeVenta(Request $request)
    {
        $indice = $request->post("indice");
        $products = $this->obtenerProductos();
        array_splice($products, $indice, 1);
        $this->guardarProductos($products);
        return redirect()
            ->route("shoppingcarts.index");
    }

    public function agregarProductoVenta(Request $request)
    {
        $product = Product::with('category');
        if (!$product) {
            return redirect()
                ->route("shoppingcarts.index")
                ->with("mensaje", "Producto no encontrado");
        }
        $this->agregarProductoACarrito($product);
        return redirect()
            ->route("shoppingcarts.index");
    }

    private function agregarProductoACarrito($product)
    {
        if ($product->stock <= 0) {
            return redirect()->route("shoppingcarts.index")
                ->with([
                    "mensaje" => "No hay existencias del producto",
                    "tipo" => "danger"
                ]);
        }
        $products = $this->obtenerProductos();
        $possibleIndex = $this->buscarIndiceDeProducto($product->id, $products);
        // Es decir, producto no fue encontrado
        if ($possibleIndex === -1) {
            $product->amount = 1;
            array_push($products, $product);
        } else {
            if ($products[$possibleIndex]->amount + 1 > $product->stock) {
                return redirect()->route('shoppingcarts.index')
                    ->with([
                        "mensaje" => "No se pueden agregar más productos de este tipo, se quedarían sin existencia",
                        "tipo" => "danger"
                    ]);
            }
            $products[$possibleIndex]->amount++;
        }
        $this->guardarProductos($products);
    }

    public function index()
    {
        $total = 0;
        foreach ($this->obtenerProductos() as $product) {
            $total += $product->amount * $product->cost;
        }
        return view('shoppingcarts.index',
            [
                "total" => $total,
                "users" => User::all(),
            ]);
    }
}
