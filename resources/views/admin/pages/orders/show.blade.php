@extends('admin/layouts/main')

@section('body')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                </ol>
                            </div>
                            
                        </div>
                    </div>
                </div>

                {{-- {{ $members->links('pagination::bootstrap-4') }} --}}

                <div class="row">
                    <div class="col-12 mt-4">
                        
                        @if(session('message'))
                            <div class="alert alert-success mt-4">
                                {{ session('message') }}
                            </div>
                        @endif

                        <div class="card-box">
                            <h4 class="header-title mb-4">Orders</h4>

                            <div class="table-responsive">
                                <table class="table table-hover table-centered m-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Order ID</th>
                                            <th>Status</th>
                                            <th>User</th>
                                            <th>Products</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $key => $order)
                                        <tr>
                                            <th>
                                                <span class="avatar-sm-box bg-primary">{{ $key + 1 }}</span>
                                            </th>
                                            <td>
                                                <h5 class="m-0 font-15">{{ $order->order_id }} </h5>
                                                <p class="m-0 text-muted"><small>{{($order->transaction_id !== null) ? $order->transaction_id : 'Transaction id not found'}}</small></p>
                                            </td>
                                            <td>{!! ($order->transaction_id !== null) ? '<font color="green">success</font>' : '<font color="red">failed</font>' !!}</td>
                                            <td><a href="{{route('admin.user.edit', ['id' => \App\Models\User::where('id', $order->user_id)->first()->id])}}">Click to show</a></td>
                                            <td>
                                                <code>[
                                                @foreach ($order->orderProducts as $product)
                                                    <a href="{{route('product.withid', ['product_id' => $product->product->id])}}">{{substr($product->product->title, 0, 18)}}...</a>,
                                                @endforeach
                                                ]</code>
                                            </td>
                                        </tr> 
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
