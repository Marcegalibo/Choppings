<x-app title="Shopping Max | Home">
    <section class="my-3 d-flex justify-content-center">
        <h2>Listado de productos</h2>
    </section>
        <section class="my-3 d-flex justify-content-center">
            @foreach ($categories as $category)
            <h5>{{ $category->name }}</h5>
            @foreach ($category->products as $product)
            <img src="{{ $product->file->route }}" class="card-img-top" alt="Imagen del producto">
                <div class="card mx-2 my-3 card_size">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product ->name }}</h5>
                        <p class="card-text">{{ $product->description_corta }}</p>
                        <p class="card-text">Precio {{ $product->cost }}</p>
                        <p class="card-text">Stock {{ $product->stock }}</p>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary">Comprar</button>
                    </div>
                </div>
            @endforeach
        </section>
        @endforeach
    </section>
</x-app>
