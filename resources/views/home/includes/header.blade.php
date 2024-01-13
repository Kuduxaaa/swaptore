<header class="header header-intro-clearance header-3">
    <div class="header-middle">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>
                
                <a href="{{ route('index') }}" class="logo">
                    <p class="logo-text" style="color: #fff;font-size: 29px;font-weight: 600;"><span style="color:#fcb941;">S</span>waptore</p>
                    {{-- <img src="{{ asset('assets/images/demos/demo-3/logo.png') }}" alt="Molla Logo" width="105" height="25"> --}}
                </a>
            </div>

            <div class="header-center">
                <div class="header-search header-search-extended header-search-visible d-none d-lg-block">
                    <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                    <form action="{{route('search')}}" method="get">
                        <div class="header-search-wrapper search-wrapper-wide">
                            <label for="query" class="sr-only">Search</label>
                            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                            <input type="search" class="form-control" name="query" id="query" placeholder="Search product ..." required>
                        </div>
                    </form>
                </div>
            </div>
            <div class="header-right">
                <div class="dropdown cart-dropdown">
                    <a href="{{ route('profile') }}" class="dropdown-toggle">
                        <div class="icon">
                            <i class="icon-user"></i>
                        </div>
                        <p>Account</p>
                    </a>
                </div>
                <div class="dropdown cart-dropdown">
                    <a href="{{ route('cart') }}" class="dropdown-toggle">
                        <div class="icon">
                            <i class="icon-shopping-cart"></i>
                            @if(auth()->user())
                                @php
                                    $cart_count = \App\Models\Cart::where('user_id', auth()->user()->id)->count() ?? 0;
                                @endphp
                                @if ($cart_count >= 0)
                                    <span class="cart-count">{{$cart_count}}</span>
                                @endif
                            @endif
                        </div>
                        <p>Cart</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="header-bottom sticky-header">
        <div class="container">
            <div class="header-left">
                <div class="dropdown category-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="Browse Categories">
                        Browse Categories <i class="icon-angle-down"></i>
                    </a>

                    <div class="dropdown-menu">
                        <nav class="side-nav">
                            <ul class="menu-vertical sf-arrows">
                                @php 
                                    $categories = \App\Models\Categories::all();
                                @endphp
                                @foreach ($categories as $category)
                                    <li><a href="{{route('categories', ['cid' => $category->id])}}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="header-center">
                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        <li><a href="#">Sale</a></li>
                        <li><a href="#">Top-Products</a></li>
                        <li><a href="#">More To Love</a></li>
                    </ul>

                </nav>
            </div>

            <div class="header-right">
                <i class="la la-lightbulb-o"></i><p>Clearance<span class="highlight">&nbsp;Up to 30% Off</span></p>
            </div>
        </div>
    </div>
</header>