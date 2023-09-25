@section('title','Shopping')
@include('layouts.header')
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('/') }}">Home</a></li>
                    <li class="breadcrumb-item active">Shop</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-6 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 sidebar">
                    <div class="sub-title">
                        <h2>Categories</h3>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="accordion accordion-flush" id="accordionExample">
                                @foreach ($categories as $key => $category)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-{{ $key }}" aria-expanded="false" aria-controls="collapseOne-{{ $key }}">
                                                {{ $category->name }}
                                            </button>
                                        </h2>
                                        <div id="collapseOne-{{ $key }}" class="accordion-collapse collapse {{ ($categorySelected == $category->id) ? 'show' : '' }}" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                            <div class="accordion-body">
                                                <div class="navbar-nav">
                                                    @foreach ($category->subcategory as $sub)
                                                        <a href="{{ route('product.subCategory', [$category->slug, $sub->slug]) }}" class="nav-item nav-link {{ ($subCategorySelected == $sub->id) ? 'text-primary' : '' }}">{{ $sub->name }}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="sub-title mt-5">
                        <h2>Brand</h3>
                    </div>

                    <div class="card">
                    <div class="card-body">
                    @foreach ($brands as $brand)
                            <div class="form-check mb-2">
                                <input {{ (in_array($brand->id , $brandArray)) ? 'checked' : '' }} class="form-check-input brand-label" type="checkbox" name = "brand[]" value="{{ $brand->id }}" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $brand->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="sub-title mt-5">
                        <h2>Price</h3>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <input type="text" class="js-range-slider" name="my_range" value="" />
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row pb-3">
                        <div class="col-12 pb-1">
                            <div class="d-flex align-items-center justify-content-end mb-4">
                                <div class="ml-2">
                                </div>
                            </div>
                        </div>

                        @foreach ($products as $product)
                            <div class="col-md-4">
                            <div class="card product-card">
                                <div class="product-image position-relative">
                                    <a href="{{ route('product.show',$product->id) }}" class="product-img"><img class="card-img-top" src="{{ asset('storage\images\product-image') . '\\' . $product->picture }}" alt="" style="height:300px"></a>
                                        @if($product->id == App\Models\WishList::where('product_id', $product->id)->where('user_id', auth()->user()->id)->value('product_id'))
                                            <a class="whishlist" href="{{ route('destroy.wishlist', $product->id) }}"><i class="fa fa-heart"></i></a>
                                        @else
                                            <a class="whishlist" href="{{ route('store.wishlist', $product->id) }}"><i class="far fa-heart"></i></a>
                                        @endif
                                    <div class="product-action">
                                        <a class="btn btn-dark" href="{{ route('cart.store', $product->id) }}">
                                            <i class="fa fa-shopping-cart"></i> Add To Cart
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body text-center mt-3">
                                    <a class="h6 link" href="{{ route('product.show',$product->id) }}">{{ $product->title }}</a>
                                    <div class="price mt-2">
                                        <span class="h5"><strong>${{ $product->price }}</strong></span>
                                    </div>
                                </div>
                            </div>
                            </div>
                        @endforeach

                        </div>
                    </div>

                        <div class="col-md-12 pt-5">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@extends('layouts.footer')
@section('custom')

<script>
    rangeSlider = $(".js-range-slider").ionRangeSlider({
        type: "double",
        min: 0,
        max: 100000,
        form: {{ $min_price }},
        step: 10,
        t0: {{ $max_price }},
        skin: "round",
        max_postfix: "+",
        prefix: "$",
        onFinish:function(){
            apply_filters()
        }
    });
    $(".brand-label").change(function(){
        apply_filters();
    });

    function apply_filters(){

        var brands = [];
        var slider = $(".js-range-slider").data("ionRangeSlider");

        $(".brand-label").each(function(){

            if ($(this).is(":checked") == true) {
                brands.push($(this).val());
            }

        });

        var url = '{{ url()->current() }}?';
        url += '&price_min='+slider.result.from+'&price_max='+slider.result.to;
        if(brands.length > 0)
            url += "&brands="+brands.toString()


        window.location.href = url;
    }
</script>
@endsection

