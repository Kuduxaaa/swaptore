@extends('admin/layouts/main')

@section('css')
    <link href="{{ asset('assets/admin/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin/plugins/summernote/summernote.min.css') }}" rel="stylesheet">
@endsection

@section('js')
<script src="{{ asset('assets/admin/plugins/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/summernote/summernote.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
        $('.dropify').dropify();
    });
</script>
@endsection

@section('body')
    <div class="content-page">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Add / Edit Product </h4>
                        </div>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger mt-4">
                        @foreach ($errors->all() as $error)
                            <span>{{ $error }}</span><br>
                        @endforeach
                    </div>
                @endif

                <div class="row justify-content-center">
                    <div class="col-lg-12 @if ($errors->any()) mt-0 @else mt-4 @endif">
                        <div class="card-box">
                            <form method="post" action="" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="form-group mb-4">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Enter title" @if (isset($product)) value="{{ $product->title }}" @endif>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control" name="price" id="price" placeholder="Price" @if (isset($product)) value="{{ $product->price }}" @endif>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="discounted_price">Discounted Price</label>
                                    <input type="text" class="form-control" name="discounted_price" id="discounted_price" placeholder="Discounted Price (optional)" @if (isset($product)) value="{{ $product->discounted_price }}" @endif>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="summernote">Description</label>
                                    <textarea class="form-control" name="description" id="summernote" placeholder="Enter product description">@if (isset($product)){{$product->description}}@endif</textarea>
                                </div>
                                
                                <div class="form-group mb-4">
                                    <select class="form-select form-control" name="category_id" aria-label="Category" required>
                                        <option selected>Select Category</option>

                                        @if (isset($categories))
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}" @if (isset($product) && $product->category_id == $item->id) selected @endif>{{ $item->name }}</option>
                                            @endforeach                                            
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="images">Upload images</label>
                                    {{-- <input type="file" id="images" name="images[]" class="form-control" accept="image/*" multiple> --}}
                                    <input type="file" id="MemberImage" name="images[]" class="dropify" accept="image/*" data-height="220" multiple/>

                                </div>

                                {{-- <div class="form-group mb-4">
                                    <label>Description</label>
                                    @include('admin/includes/summernote')
                                </div> --}}



                                <button type="submit" class="btn btn-success waves-effect waves-light mr-1">Save</button>

                                <a href="{{ route('admin.products') }}">
                                    <button type="button" class="btn btn-danger waves-effect waves-light">Discard</button>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endsection
