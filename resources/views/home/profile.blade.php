@extends('home/layouts/main')

@section('title')
    Profile
@endsection

@section('js')
<script>
    $(document).ready(function() {
        var lastActiveTab = localStorage.getItem('lastActiveTab');

        if (lastActiveTab) {
            $('#tab-dashboard').removeClass('active show');
            $(`#${lastActiveTab}`).tab('show');
        }

        $('a[data-toggle="tab"]').on('click', function (e) {
            var activeTab = $(e.target).attr('href').substring(1);
            localStorage.setItem('lastActiveTab', activeTab);
        });
    });
</script>
<style>
    .ui-state-disabled {
        display: none;
    }
</style>
@endsection

@section('content')
    @php $user = auth()->user(); @endphp
    <main class="main">
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">My Account<span>Shop</span></h1>
            </div>
        </div>
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
            <div class="container">
                @include('messages')
            </div>
        </nav>

        <div class="page-content">
            <div class="dashboard">
                <div class="container">
                    <div class="row">
                        <aside class="col-md-4 col-lg-3">
                            <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab-dashboard-link" data-toggle="tab"
                                        href="#tab-dashboard" role="tab" aria-controls="tab-dashboard"
                                        aria-selected="true">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-orders-link" data-toggle="tab" href="#tab-orders"
                                        role="tab" aria-controls="tab-orders" aria-selected="false">Orders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-address-link" data-toggle="tab" href="#tab-address"
                                        role="tab" aria-controls="tab-address" aria-selected="false">Adresses</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account"
                                        role="tab" aria-controls="tab-account" aria-selected="false">Account Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('auth.logout') }}">Sign Out</a>
                                </li>
                            </ul>
                        </aside>

                        <div class="col-md-8 col-lg-9">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel"
                                    aria-labelledby="tab-dashboard-link">
                                    <p>Hello <span
                                            class="font-weight-normal text-dark">{{ auth()->user()->first_name }}</span>
                                        (not <span
                                            class="font-weight-normal text-dark">{{ auth()->user()->first_name }}</span>? <a
                                            href="{{ route('auth.logout') }}">Log out</a>)
                                        <br>
                                        From your account dashboard you can view your <a href="#tab-orders"
                                            class="tab-trigger-link link-underline">recent orders</a>, manage your <a
                                            href="#tab-address" class="tab-trigger-link">shipping and billing addresses</a>,
                                        and <a href="#tab-account" class="tab-trigger-link">edit your password and account
                                            details</a>.
                                    </p>
                                </div>

                                <div class="tab-pane fade" id="tab-orders" role="tabpanel"
                                    aria-labelledby="tab-orders-link">
                                    @if (count($user->orders) > 0)
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Status</th>
                                                        <th>Product</th>
                                                        <th>Transaction ID</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($orders as $order)
                                                        <tr>
                                                            <td style="padding-right:20px;">{{ ($order->transaction_id !== null) ? 'Success' : 'Failed' }}</td>
                                                            <td>
                                                                @php $images = json_decode($order->images, true) @endphp
                                                                <a target="_blank" href="{{ route('product.withid', ['product_id' => $order->product_id]) }}" class="d-flex">
                                                                    <img src="{{ $images[0] }}" style="min-width: 63px;width:63px;border-radius: 6px;height:70px;" alt="{{ substr($order->title, 0, 22) }}...">
                                                                    <span class="pl-4">{{ substr($order->title, 0, 42) }}...</span>
                                                                </a>
                                                            </td>
                                                            <td>{{ $order->transaction_id }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>                                                
                                            </table>
                                        </div>
                                    @else
                                        <p>No order has been made yet.</p>
                                        <a href="{{route('index')}}" class="btn btn-outline-primary-2"><span>GO SHOP</span><i
                                                class="icon-long-arrow-right"></i></a>
                                    @endif
                                    {{ $orders->links('pagination::bootstrap-4') }}
                                </div>

                                <div class="tab-pane fade" id="tab-address" role="tabpanel"
                                    aria-labelledby="tab-address-link">

                                    <form action="{{ route('profile.update') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="country">Country *</label>
                                                <select name="country" class="form-control" id="country">
                                                    <option label="Select a country ... " selected="selected">Select a
                                                        country ... </option>

                                                    <optgroup label="Africa">
                                                        @php
                                                            $africanCountries = ['Algeria', 'Angola', 'Benin', 'Botswana', 'Burkina Faso', 'Burundi', 'Cameroon', 'Cape Verde', 'Central African Republic', 'Chad', 'Comoros', 'Congo - Brazzaville', 'Congo - Kinshasa', 'Côte d’Ivoire', 'Djibouti', 'Egypt', 'Equatorial Guinea', 'Eritrea', 'Ethiopia', 'Gabon', 'Gambia', 'Ghana', 'Guinea', 'Guinea-Bissau', 'Kenya', 'Lesotho', 'Liberia', 'Libya', 'Madagascar', 'Malawi', 'Mali', 'Mauritania', 'Mauritius', 'Mayotte', 'Morocco', 'Mozambique', 'Namibia', 'Niger', 'Nigeria', 'Rwanda', 'Réunion', 'Saint Helena', 'Senegal', 'Seychelles', 'Sierra Leone', 'Somalia', 'South Africa', 'Sudan', 'Swaziland', 'São Tomé and Príncipe', 'Tanzania', 'Togo', 'Tunisia', 'Uganda', 'Western Sahara', 'Zambia', 'Zimbabwe'];
                                                        @endphp

                                                        @foreach ($africanCountries as $country)
                                                            <option value="{{ $country }}"
                                                                @if ($user->addresses && $user->addresses->country == $country) selected="selected" @endif>
                                                                {{ $country }}</option>
                                                        @endforeach
                                                    </optgroup>

                                                    <optgroup label="Americas">
                                                        @php
                                                            $americanCountries = ['Anguilla', 'Antigua and Barbuda', 'Argentina', 'Aruba', 'Bahamas', 'Barbados', 'Belize', 'Bermuda', 'Bolivia', 'Brazil', 'British Virgin Islands', 'Canada', 'Cayman Islands', 'Chile', 'Colombia', 'Costa Rica', 'Cuba', 'Dominica', 'Dominican Republic', 'Ecuador', 'El Salvador', 'Falkland Islands', 'French Guiana', 'Greenland', 'Grenada', 'Guadeloupe', 'Guatemala', 'Guyana', 'Haiti', 'Honduras', 'Jamaica', 'Martinique', 'Mexico', 'Montserrat', 'Netherlands Antilles', 'Nicaragua', 'Panama', 'Paraguay', 'Peru', 'Puerto Rico', 'Saint Barthélemy', 'Saint Kitts and Nevis', 'Saint Lucia', 'Saint Martin', 'Saint Pierre and Miquelon', 'Saint Vincent and the Grenadines', 'Suriname', 'Trinidad and Tobago', 'Turks and Caicos Islands', 'U.S. Virgin Islands', 'United States', 'Uruguay', 'Venezuela'];
                                                        @endphp

                                                        @foreach ($americanCountries as $country)
                                                            <option value="{{ $country }}"
                                                                @if ($user->addresses && $user->addresses->country == $country) selected="selected" @endif>
                                                                {{ $country }}</option>
                                                        @endforeach
                                                    </optgroup>

                                                    <optgroup label="Asia">
                                                        @php
                                                            $asianCountries = ['Afghanistan', 'Armenia', 'Azerbaijan', 'Bahrain', 'Bangladesh', 'Bhutan', 'Brunei', 'Cambodia', 'China', 'Hong Kong SAR China', 'India', 'Indonesia', 'Iran', 'Iraq', 'Israel', 'Japan', 'Jordan', 'Kazakhstan', 'Kuwait', 'Kyrgyzstan', 'Laos', 'Lebanon', 'Macau SAR China', 'Malaysia', 'Maldives', 'Mongolia', 'Myanmar [Burma]', 'Nepal', 'Neutral Zone', 'North Korea', 'Oman', 'Pakistan', 'Palestinian Territories', 'People\'s Democratic Republic of Yemen', 'Philippines', 'Qatar', 'Saudi Arabia', 'Singapore', 'South Korea', 'Sri Lanka', 'Syria', 'Taiwan', 'Tajikistan', 'Thailand', 'Timor-Leste', 'Turkey', 'Turkmenistan', 'United Arab Emirates', 'Uzbekistan', 'Vietnam', 'Yemen'];
                                                        @endphp

                                                        @foreach ($asianCountries as $country)
                                                            <option value="{{ $country }}"
                                                                @if ($user->addresses && $user->addresses->country == $country) selected="selected" @endif>
                                                                {{ $country }}</option>
                                                        @endforeach
                                                    </optgroup>

                                                    <optgroup label="Europe">
                                                        @php
                                                            $europeanCountries = ['Albania', 'Andorra', 'Austria', 'Belarus', 'Belgium', 'Bosnia and Herzegovina', 'Bulgaria', 'Croatia', 'Cyprus', 'Czech Republic', 'Denmark', 'East Germany', 'Georgia', 'Estonia', 'Faroe Islands', 'Finland', 'France', 'Germany', 'Gibraltar', 'Greece', 'Guernsey', 'Hungary', 'Iceland', 'Ireland', 'Isle of Man', 'Italy', 'Jersey', 'Latvia', 'Liechtenstein', 'Lithuania', 'Luxembourg', 'Macedonia', 'Malta', 'Metropolitan France', 'Moldova', 'Monaco', 'Montenegro', 'Netherlands', 'Norway', 'Poland', 'Portugal', 'Romania', 'Russia', 'San Marino', 'Serbia', 'Serbia and Montenegro', 'Slovakia', 'Slovenia', 'Spain', 'Svalbard and Jan Mayen', 'Sweden', 'Switzerland', 'Ukraine', 'Union of Soviet Socialist Republics', 'United Kingdom', 'Vatican City', 'Åland Islands'];
                                                        @endphp

                                                        @foreach ($europeanCountries as $country)
                                                            <option value="{{ $country }}"
                                                                @if ($user->addresses && $user->addresses->country == $country) selected="selected" @endif>
                                                                {{ $country }}</option>
                                                        @endforeach
                                                    </optgroup>

                                                    <optgroup label="Oceania">
                                                        @php
                                                            $oceaniaCountries = ['American Samoa', 'Antarctica', 'Australia', 'Bouvet Island', 'British Indian Ocean Territory', 'Christmas Island', 'Cocos [Keeling] Islands', 'Cook Islands', 'Fiji', 'French Polynesia', 'French Southern Territories', 'Guam', 'Heard Island and McDonald Islands', 'Kiribati', 'Marshall Islands', 'Micronesia', 'Nauru', 'New Caledonia', 'New Zealand', 'Niue', 'Norfolk Island', 'Northern Mariana Islands', 'Palau', 'Papua New Guinea', 'Pitcairn Islands', 'Samoa', 'Solomon Islands', 'South Georgia and the South Sandwich Islands', 'Tokelau', 'Tonga', 'Tuvalu', 'U.S. Minor Outlying Islands', 'Vanuatu', 'Wallis and Futuna'];
                                                        @endphp

                                                        @foreach ($oceaniaCountries as $country)
                                                            <option value="{{ $country }}"
                                                                @if ($user->addresses && $user->addresses->country == $country) selected="selected" @endif>
                                                                {{ $country }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>

                                            </div>

                                            <div class="col-sm-6">
                                                <label>City *</label>
                                                <input type="text" class="form-control" name="city"
                                                    value="{{ $user->addresses->city }}" required>
                                            </div>
                                        </div>

                                        <label>Primary Address *</label>
                                        <input type="text" class="form-control" name="primary_address"
                                            value="{{ $user->addresses->primary_address }}">

                                        <label>Secondary Address (optional)</label>
                                        <input type="text" class="form-control" name="secondary_address"
                                            value="{{ $user->address->secondary_address ?? '' }}" required>

                                        <label>Zip Code *</label>
                                        <input type="text" class="form-control" name="zip_code"
                                            value="{{ $user->addresses->zip_code }}" disabled>

                                        <button type="submit" class="btn btn-outline-primary-2 mt-2">
                                            <span>SAVE CHANGES</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>
                                    </form>
                                    {{-- <p>The following addresses will be used on the checkout page by default.</p>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card card-dashboard">
                                            <div class="card-body">
                                                <h3 class="card-title">Billing Address</h3>

                                                <p>User Name<br>
                                                User Company<br>
                                                John str<br>
                                                New York, NY 10001<br>
                                                1-234-987-6543<br>
                                                yourmail@mail.com<br>
                                                <a href="#">Edit <i class="icon-edit"></i></a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="card card-dashboard">
                                            <div class="card-body">
                                                <h3 class="card-title">Shipping Address</h3>

                                                <p>You have not set up this type of address yet.<br>
                                                <a href="#">Edit <i class="icon-edit"></i></a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                </div>

                                <div class="tab-pane fade" id="tab-account" role="tabpanel"
                                    aria-labelledby="tab-account-link">
                                    <form action="{{ route('profile.update') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>First Name *</label>
                                                <input type="text" class="form-control" name="first_name"
                                                    value="{{ $user->first_name }}" required>
                                            </div>

                                            <div class="col-sm-6">
                                                <label>Last Name *</label>
                                                <input type="text" class="form-control" name="last_name"
                                                    value="{{ $user->last_name }}" required>
                                            </div>
                                        </div>

                                        <label>Email Address</label>
                                        <input type="text" class="form-control" value="{{ $user->email }}" disabled>
                                        <small class="form-text">You can't change your email address. If you have some
                                            troubles please contact us</small>

                                        <label>Phone number *</label>
                                        <input type="tel" name="phone_number" class="form-control"
                                            value="{{ $user->phone_number }}" required>

                                        <div class="mt-4">
                                            <label>Current password (leave blank to leave unchanged)</label>
                                            <input type="password" name="current_password" class="form-control">

                                            <label>New password (leave blank to leave unchanged)</label>
                                            <input type="password" name="password" class="form-control">

                                            <label>Confirm new password</label>
                                            <input type="password" name="password_confirmation"
                                                class="form-control mb-2">
                                        </div>

                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>SAVE CHANGES</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
