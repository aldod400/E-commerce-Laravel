@section('title',"$product->title")

@include('layouts.header')
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('products') }}">Shop</a></li>
                    <li class="breadcrumb-item">{{ $product->title }}</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-7 pt-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col-md-5">
                    <div id="product-carousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner bg-light">
                            <div class="carousel-item">
                                <img class="w-100 h-100" src="{{ asset('storage\images\product-image\\' . $product->picture) }}" alt="Image">
                            </div>
                            <div class="carousel-item active">
                                <img class="w-100 h-100" src="{{ asset('storage\images\product-image\\' . $product->picture) }}" alt="Image">
                            </div>
                            <div class="carousel-item">
                                <img class="w-100 h-100" src="{{ asset('storage\images\product-image\\' . $product->picture) }}" alt="Image">
                            </div>
                            <div class="carousel-item">
                                <img class="w-100 h-100" src="{{ asset('storage\images\product-image\\' . $product->picture) }}" alt="Image">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#product-carousel" data-bs-slide="prev">
                            <i class="fa fa-2x fa-angle-left text-dark"></i>
                        </a>
                        <a class="carousel-control-next" href="#product-carousel" data-bs-slide="next">
                            <i class="fa fa-2x fa-angle-right text-dark"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="bg-light right">
                        <h1>{{ $product->title }}</h1>
                        <h2 class="price ">${{ $product->price }}</h2>

                        <p>{{ $product->description }}</p>
                        <a href="{{ route('cart.store', $product->id) }}" class="btn btn-dark"><i class="fas fa-shopping-cart"></i> &nbsp;ADD TO CART</a>
                    </div>
                </div>

                <div class="col-md-12 mt-5">
                    <div class="bg-light">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                <p>
                                    {{ $product->description }}
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-5 section-8">
        <div class="container">
            <div class="section-title">
                <h2>Related Products</h2>
            </div>
            <div class="col-md-12">
                <div id="related-products" class="carousel">
                    @foreach ($related_products as $product)
                        @if ($product->id != $id)
                            <div class="card product-card">
                            <div class="product-image position-relative">
                            <a href="{{ route('product.show', $product->id) }}" class="product-img"><img class="card-img-top" src="{{ asset('storage\images\product-image\\' . $product->picture) }}" style = "height:300px" alt=""></a>
                            <a class="whishlist" href="#"><i class="far fa-heart"></i></a>

                            <div class="product-action">
                                <a class="btn btn-dark" href="#">
                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                </a>
                            </div>
                            </div>
                            <div class="card-body text-center mt-3">
                            <a class="h6 link" href="{{ route('product.show', $product->id) }}">{{ $product->title }}</a>
                            <div class="price mt-2">
                                <span class="h5"><strong>${{ $product->price }}</strong></span>
                            </div>
                            </div>
                    </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</main>
@include('layouts.footer')
