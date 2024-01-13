@extends('admin/layouts/main')

@section('body')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        
                        <div class="page-title-box">
                            <h4 class="page-title">Products list</h4>
                            
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <a href="{{ route('admin.products.add') }}">
                                        <button class="btn btn-success">Create new</button>
                                    </a>
                                </ol>
                            </div>
                            
                        </div>
                    </div>
                </div>

                @if(session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif

                @php
                    $instance = new App\Models\Product;
                    $fillableColumns = $instance->getFillable();
                @endphp

                {{ $products->links('pagination::bootstrap-4') }}

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">

                            <table id="tech-companies-1" class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th data-priority="0" id="id">#</th>
                                        @foreach ($fillableColumns as $key => $column)
                                            <th data-priority="{{ $key + 1 }}" id="{{ $column }}">{{ ucfirst(str_replace('_', ' ', $column)) }}</th>
                                        @endforeach
                                        <th data-priority="{{ count($fillableColumns) + 1 }}" id="action">Created at</th>
                                        <th data-priority="{{ count($fillableColumns) + 3 }}" id="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($products) && count($products) > 0)
                                        @foreach ($products as $key => $product)
                                            @php
                                                $slug = Illuminate\Support\Str::slug($product->title);
                                            @endphp
                                            <tr>
                                                <th data-priority="0" data-columns="id">{{ $key + 1 }}</th>
                                                <td data-priority="1" data-columns="{{ $fillableColumns[$key] }}">
                                                    @if (count($product->images) > 0) 
                                                        <img src="{{ $product->images[0] }}" alt="{{ $product->title }}" style="height: 60px;width: 60px;border-radius: 9px;object-fit: cover;">
                                                    @else
                                                        No image
                                                    @endif
                                                </td>

                                                <td data-priority="2" data-columns="{{ $fillableColumns[$key] }}">{{ substr($product->title, 0, 56) }}...</td>
                                                <td data-priority="3" data-columns="{{ $fillableColumns[$key] }}">{{ strip_tags(substr($product->description, 0, 80)) }}...</td>
                                                <td data-priority="4" data-columns="{{ $fillableColumns[$key] }}">{{ $product->formated_price }}</td>
                                                <td data-priority="5" data-columns="{{ $fillableColumns[$key] }}">{{ $product->discounted_price ?? 'No discount' }}</td>
                                                <td data-priority="6" data-columns="{{ $fillableColumns[$key] }}">{{ $product->category->name }}</td>
                                                <td data-priority="7" data-columns="{{ $fillableColumns[$key] }}">{{ $product->created_at }}</td>
                                                <td data-priority="8" data-columns="{{ $fillableColumns[$key] }}">
                                                    <a href="{{ route('product', ['product_id' => $product->id, 'product_name' => $slug]) }}" target="_blank">
                                                        <button class="btn btn-primary">View</button>
                                                    </a>
                                                    <a href="{{ route('admin.products.edit', ['id' => $product->id]) }}">
                                                        <button class="btn btn-info">Edit</button>
                                                    </a>
                                                    <a href="{{ route('admin.products.delete', ['id' => $product->id]) }}">
                                                        <button class="btn btn-danger">Remove</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
