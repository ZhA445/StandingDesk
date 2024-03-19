<div class="product-header">Height-Adjustable Standing Desks & Office Furniture</div>

<div class="paginate">{{ $products->links() }}</div>

<div class="home-product-gp">
    @foreach ($products as $product)
        <div class="home-product">
            <img src="/product/{{ $product->image }}" alt="Product IMG">
            <div class="product-text ">
                <h5>{{ $product->title }}</h5>
                <p class="card-text text-white">{{ $product->description }}</p>

                <div class="product-price-gp">
                    @if ($product->discount_price != null)
                        <p class="card-subtitle">${{ $product->discount_price }}</p>

                        <p class="card-subtitle" style="text-decoration: line-through; color:red">${{ $product->price }}
                        </p>
                    @else
                        <p class="card-subtitle">${{ $product->price }}</p>
                    @endif
                </div>
                <a href="{{ url("/products/detail/$product->id") }}" class="btn product-btn">Shop Now</a>

            </div>
        </div>
    @endforeach


</div>
