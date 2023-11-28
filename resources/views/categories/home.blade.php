<x-app title="Home">
    <section class="my-3 d-flex justify-content-center">
        <h2>Nuestros de productos</h2>
    </section>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($categories as $category)
                <div class="card mx-2 my-3 card_size ">
                    @foreach ($category->products as $product)
                        <h5 class="my-3 d-flex justify-content-center">{{ $category->name }}</h5>
                        <img src="{{ $product->file->route }}" class="card-img-top"
                        alt="Imagen del producto">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product ->name }}</h5>
                            <p class="card-text">{{ $product->format_description }}</p>
                            <div class="d-flex flex-wrap">
                                <span class="w-100">
                                    <strong>Precio: </strong> {{ $product->cost }}
                                </span>
                                <span class="mt-2">
                                    <strong>Stock: </strong> {{ $product->stock }}
                                </span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-grid gap-2">
                                <a href="{{ route('login') }}" class="btn btn-outline-success" type="button">
                                    Agregar al carrito
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</x-app>
