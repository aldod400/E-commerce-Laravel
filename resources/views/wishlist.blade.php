@section('title','My Wish List')
@include('layouts.header')
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
                    <li class="breadcrumb-item">Settings</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-11 ">
        <div class="container  mt-5">
            <div class="row">
                <div class="col-md-3">
                    @include('layouts.account-panel')
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">My Favourites</h2>
                        </div>
                        <div class="card-body p-4">
                            @foreach ($products as $product)
                                <div class="d-sm-flex justify-content-between mt-lg-4 mb-4 pb-3 pb-sm-2 border-bottom">
                                <div class="d-block d-sm-flex align-items-start text-center text-sm-start"><a class="d-block flex-shrink-0 mx-auto me-sm-4" href="{{ route('product.show', $product->id) }}" style="width: 10rem;"><img src="{{ asset('storage\images\product-image\\' . $product->picture ) }}" alt="Product"></a>
                                    <div class="pt-2">
                                        <h3 class="product-title fs-base mb-2"><a href="{{ route('product.show', $product->id) }}">{{ $product->title }}</a></h3>
                                        <div class="fs-lg text-accent pt-2">${{ $product->price }}</div>
                                    </div>
                                </div>
                                <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                                    <form action="{{ route('destroy.wishlist',$product->id) }}" method="GET" style=" display:inline;">
                                        @csrf
                                        <button class="btn btn-outline-danger btn-sm" type="submit"><i class="fas fa-trash-alt me-2"></i>Remove</button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="card-footer clearfix">
								{{ $products->onEachSide(1)->links() }}
							</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@include('layouts.footer')
