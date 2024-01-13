@extends('home/layouts/main')

@section('title')
    Cart
@endsection

@section('js')
<script>
    $(document).ready(function () {
        
        function get_total() {
            var total = 0;

            document.querySelectorAll('#total').forEach((val, i) => {
                total += parseFloat(val.innerText.replace('$', ''));
            })

            return total.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });;
        }

        $('.cart-product-quantity input').on('input', function () {
            $('.cart-product-quantity input').each(function () {
                var row = $(this).closest('tr');
                var price = parseFloat(row.find('input[name="price_int"]').val());
                var quantity = parseInt($(this).val());
                var total = price * quantity;

                row.find('.total-col').text('$' + total.toFixed(2));
            });

            $('.summary-total > td:eq(1)').text('$' + get_total());
        });
    });

</script>
@endsection

@section('content')
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Shopping Cart<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            @include('messages')
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="cart">
            <div class="container">
                <form action="{{ route('cart.checkout') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-9">
                            <table class="table table-cart table-mobile">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                
                                @php
                                    $cartItemsArray = $cart_items->items();

                                    $total = $cart_items->map(function ($item) {
                                        return ($item->product->discounted_price !== null) ? $item->product->discounted_price : $item->product->price;
                                    })->sum();
                                @endphp


                                <tbody>
                                    @foreach ($cart_items as $item)
                                        @php $price = ($item->product->discounted_price !== null) ? $item->product->discounted_price : $item->product->price @endphp
                                        <tr>
                                            <input type="hidden" name="cart_items[{{ $loop->index }}][product_id]" value="{{ $item->product->id }}">
                                            <input type="hidden" name="cart_items[{{ $loop->index }}][price]" value="{{ $item->product->discounted_price ?: $item->product->price }}">

                                            <input type="hidden" name="price_int" value="{{$price}}">
                                            <td class="product-col">
                                                <div class="product">
                                                    <figure class="product-media">
                                                        <a href="#">
                                                            <img src="{{ $item->product->images[0] }}" alt="{{ $item->product->title }}">
                                                        </a>
                                                    </figure>
        
                                                    <h3 class="product-title">
                                                        <a href="{{ route('product', ['product_id' => $item->product->id, 'product_name' => Illuminate\Support\Str::slug($item->product->title)]) }}">{{ $item->product->title }}</a>
                                                    </h3>
                                                </div>
                                            </td>
                                            <td class="price-col">${{ ($item->product->discounted_price !== null) ? $item->product->formated_discounted_price : $item->product->formated_price }}</td>
                                            <td class="quantity-col">
                                                <div class="cart-product-quantity">
                                                    <input type="number" name="cart_items[{{ $loop->index }}][quantity]" class="form-control" value="{{ $item->quantity }}" min="1" max="10" step="1" data-decimals="0" required>
                                                </div>
                                            </td>
                                            <td class="total-col" id="total">${{ number_format($price * $item->quantity, 2, '.', ',') }}</td>
                                            <td class="remove-col"><a href="{{route('cart.delete', ['product_id' => $item->product->id])}}" class="btn-remove"><i class="icon-close"></i></a></td>
                                        </tr>
                                    @endforeach

                                    
                                </tbody>
                            </table>

                            <div class="cart-bottom justify-content-between">
                                <div class="d-flex align-items-center justify-content-right">
                                    {{ $cart_items->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                        <aside class="col-lg-3">
                            <div class="summary summary-cart">
                                <h3 class="summary-title">Cart Total</h3>

                                <table class="table table-summary">
                                    <tbody>
                
                                        <tr class="summary-shipping-estimate">
                                            <td>Estimate for Your Country<br> <a onclick="localStorage.setItem('lastActiveTab', 'tab-address');" href="{{route('profile')}}">Change address</a></td>
                                            <td>&nbsp;</td>
                                        </tr>

                                        <tr class="summary-total">
                                            <td>Total:</td>
                                            <td>${{ number_format($total, 2, '.', ',') }}</td>
                                        </tr>
                                    </tbody>
                                </table>


                                <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</button>
                            </div>

                            <a href="{{ route('index') }}" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                        </aside>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection