@extends('home/layouts/main')

@section('title')
    {{ $product->title }}
@endsection

@section('content')
<div class="page-content mt-4">
    <div class="container">
        <div class="product-details-top">
            <div class="row">
                <div class="col-md-5" style="margin-right: 60px !important;">
                    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                        data-owl-options='{
                            "nav": true, 
                            "dots": true,
                            "margin": 30,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "480": {
                                    "items":1
                                },
                                "768": {
                                    "items":1
                                },
                                "992": {
                                    "items":1
                                },
                                "1200": {
                                    "items": 1,
                                    "nav": true,
                                    "dots": false
                                }
                            }
                        }'>

                        @foreach ($product->images as $image)
                        <figure class="product-main-image">
                            <img src="{{ $image }}" alt="{{ $product->title }}">
                        </figure>
                        @endforeach
                    </div>
                </div>

      

                <div class="col-md-6">
                    <div class="product-details">
                        <h1 class="product-title">{{ $product->title }}</h1>

                        <div class="product-price mt-2">
                            @if ($product->discounted_price === null)
                                ${{ $product->formated_price }}
                            @else
                                <span class="new-price">${{ $product->formated_discounted_price }}</span>
                                <span class="old-price">${{ $product->formated_price }}</span>
                            @endif
                        </div>

                        <div class="product-content">
                            <p>Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing. Sed lectus. </p>
                        </div>

                        <div class="details-filter-row details-row-size">
                            
                            <form action="{{ route('cart.add') }}" method="post" id="addToCart__{{ $product->id }}" class="d-flex flex-wrap">
                                <label for="qty">Qty:</label>
                                <div class="product-details-quantity">
                                    <input type="number" id="qty" name="quantity" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required>
                                </div>

                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="ml-4 btn btn-primary">
                                    <span>Add to cart</span>
                                </button>                       
                            </form>
                        </div>

                        <div class="product-details-footer">
                            <div class="product-cat">
                                <span>Category:</span>
                                <a href="#">{{ $product->category->name }}</a>
                            </div>

                            <div class="social-icons social-icons-sm">
                                <span class="social-label">Share:</span>
                                <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="product-details-tab">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                    <div class="product-desc-content">
                        {!! $product->description !!}
                    </div>
                </div>
            </div>
        </div>

        <h2 class="title text-center mb-4">You May Also Like</h2>
        <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
            data-owl-options='{
                "nav": false, 
                "dots": true,
                "margin": 20,
                "loop": false,
                "responsive": {
                    "0": {
                        "items":1
                    },
                    "480": {
                        "items":2
                    },
                    "768": {
                        "items":3
                    },
                    "992": {
                        "items":4
                    },
                    "1200": {
                        "items":4,
                        "nav": true,
                        "dots": false
                    }
                }
            }'>
            <div class="product product-7 text-center">
                <figure class="product-media">
                    {{-- <span class="product-label label-new">New</span> --}}

                    <a href="product.html">
                        <img src="{{ asset('assets/images/products/product-4.jpg') }}" alt="Product image" class="product-image">
                    </a>

                    <div class="product-action">
                        <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                    </div>
                </figure>

                <div class="product-body">
                    <div class="product-cat">
                        <a href="#">Women</a>
                    </div>

                    <h3 class="product-title">
                        <a href="product.html">Brown paperbag waist <br>pencil skirt</a>
                    </h3>
                    
                    <div class="product-price">
                        $60.00
                    </div>
                </div>
            </div>

            <div class="product product-7 text-center">
                <figure class="product-media">
                    {{-- <span class="product-label label-new">New</span> --}}

                    <a href="product.html">
                        <img src="{{ asset('assets/images/products/product-5.jpg') }}" alt="Product image" class="product-image">
                    </a>

                    <div class="product-action">
                        <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                    </div>
                </figure>

                <div class="product-body">
                    <div class="product-cat">
                        <a href="#">Women</a>
                    </div>

                    <h3 class="product-title">
                        <a href="product.html">Brown paperbag waist <br>pencil skirt</a>
                    </h3>
                    
                    <div class="product-price">
                        $60.00
                    </div>
                </div>
            </div>

            <div class="product product-7 text-center">
                <figure class="product-media">
                    {{-- <span class="product-label label-new">New</span> --}}

                    <a href="product.html">
                        <img src="{{ asset('assets/images/products/product-6.jpg') }}" alt="Product image" class="product-image">
                    </a>

                    <div class="product-action">
                        <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                    </div>
                </figure>

                <div class="product-body">
                    <div class="product-cat">
                        <a href="#">Women</a>
                    </div>

                    <h3 class="product-title">
                        <a href="product.html">Brown paperbag waist <br>pencil skirt</a>
                    </h3>
                    
                    <div class="product-price">
                        $60.00
                    </div>
                </div>
            </div>

            <div class="product product-7 text-center">
                <figure class="product-media">
                    {{-- <span class="product-label label-new">New</span> --}}

                    <a href="product.html">
                        <img src="{{ asset('assets/images/products/product-7.jpg') }}" alt="Product image" class="product-image">
                    </a>

                    <div class="product-action">
                        <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                    </div>
                </figure>

                <div class="product-body">
                    <div class="product-cat">
                        <a href="#">Women</a>
                    </div>

                    <h3 class="product-title">
                        <a href="product.html">Brown paperbag waist <br>pencil skirt</a>
                    </h3>
                    
                    <div class="product-price">
                        $60.00
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection