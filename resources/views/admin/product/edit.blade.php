@extends('layout.master')
@section('page-css')
<script src="{{ asset('assets/plugins/select2/select2.min.css') }}"></script>
@endsection
@section('content')
    @include('admin.includes.breadcrumb')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Product Create</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('product')}}" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-feather="server"></i>
                Product
            </a>
        </div>
    </div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Product Create</h6>
                <form class="forms-sample" action="{{route('product.update',$data->id)}} " method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('title') ? 'has-danger' : '' }}">
                                <label for="title">Product Title</label>
                                <input type="text" class="form-control form-control-danger" id="title" name="title" autocomplete="off" placeholder="Product Title" value="{{ old('title', isset($data) ? $data->title : '') }}" aria-invalid="true" required>
                                @if($errors->has('title'))
                                    <label id="name-error" class="error mt-2 text-danger" for="name">Please enter a title</label>
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('price') ? 'has-danger' : '' }}">
                                <label for="price">Product Price</label>
                                <input type="number" step="0.01" class="form-control form-control-danger" id="price" name="price" autocomplete="off" placeholder="Product Price" value="{{ old('price', isset($data) ? $data->price : '') }}" aria-invalid="true" required>
                                @if($errors->has('price'))
                                    <label id="name-error" class="error mt-2 text-danger" for="name">Please enter a price</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group {{ $errors->has('stock') ? 'has-danger' : '' }}">
                                <label for="stock">Stock</label>
                                <select class="form-control" name="stock" id="stock" required>
                                    <option selected="" disabled="">Select Stock Status</option>
                                    <option value="1" {{ $data->stock == 1 ? 'selected' : '' }}>In Stock</option>
                                    <option value="0" {{ $data->stock == 0 ? 'selected' : '' }}>Out Stock</option>
                                </select>
                                @if($errors->has('stock'))
                                    <label id="name-error" class="error mt-2 text-danger" for="name">Please enter a stock</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group {{ $errors->has('qty') ? 'has-danger' : '' }}">
                                <label for="qty">Product Qty</label>
                                <input type="number" class="form-control form-control-danger" id="qty" name="qty" autocomplete="off" placeholder="Product qty" value="{{ old('qty', isset($data) ? $data->qty : '') }}" aria-invalid="true" required>
                                @if($errors->has('qty'))
                                    <label id="name-error" class="error mt-2 text-danger" for="qty">Please enter a qty</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('total_page_number') ? 'has-danger' : '' }}">
                                <label for="total_page_number">Total page number</label>
                                <input type="number" class="form-control form-control-danger" id="total_page_number" name="total_page_number" autocomplete="off" placeholder="Total page number" value="{{ old('total_page_number', isset($data) ? $data->total_page_number : '') }}" aria-invalid="true">
                                @if($errors->has('total_page_number'))
                                    <label id="name-error" class="error mt-2 text-danger" for="name">Please enter a total page number</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('description') ? 'has-danger' : '' }}">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" cols="30" rows="3" class="form-control form-control-danger" autocomplete="off" placeholder="Description"  aria-invalid="true" required>{{ old('description', isset($data) ? $data->description : '') }}</textarea>
                                @if($errors->has('description'))
                                    <label id="name-error" class="error mt-2 text-danger" for="name">Please enter a description</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('best_for_age') ? 'has-danger' : '' }}">
                                <label for="best_for_age">Best For Ages</label>
                                <input type="text" class="form-control form-control-danger" id="best_for_age" name="best_for_age" autocomplete="off" placeholder="Best For Ages" value="{{ old('best_for_age', isset($data) ? $data->best_for_age : '') }}" aria-invalid="true">
                                @if($errors->has('best_for_age'))
                                    <label id="name-error" class="error mt-2 text-danger" for="name">Please enter Best For Ages</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('cover_type') ? 'has-danger' : '' }}">
                                <label for="cover_type">Cover type</label>
                                <input type="text" class="form-control form-control-danger" id="cover_type" name="cover_type" autocomplete="off" placeholder="Cover type" value="{{ old('cover_type', isset($data) ? $data->cover_type : '') }}" aria-invalid="true">
                                @if($errors->has('cover_type'))
                                    <label id="name-error" class="error mt-2 text-danger" for="name">Please enter cover type</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group {{ $errors->has('shipping_day_from') ? 'has-danger' : '' }}">
                                <label for="shipping_day_from">Shipping Day From</label>
                                <input type="number" class="form-control form-control-danger" id="shipping_day_from" name="shipping_day_from" autocomplete="off" placeholder="Shipping Day From" value="{{ old('shipping_day_from', isset($data) ? $data->shipping_day_from : '') }}" aria-invalid="true">
                                @if($errors->has('shipping_day_from'))
                                    <label id="name-error" class="error mt-2 text-danger" for="name">Please enter cover type</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group {{ $errors->has('shipping_day_to') ? 'has-danger' : '' }}">
                                <label for="shipping_day_to">Shipping Day To</label>
                                <input type="number" class="form-control form-control-danger" id="shipping_day_to" name="shipping_day_to" autocomplete="off" placeholder="Shipping Day To" value="{{ old('shipping_day_to', isset($data) ? $data->shipping_day_to : '') }}" aria-invalid="true">
                                @if($errors->has('shipping_day_to'))
                                    <label id="name-error" class="error mt-2 text-danger" for="name">Please enter cover type</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="clearfix"><strong class="text-info">Filter Options</strong><br></div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('family') ? 'has-danger' : '' }}">
                                <label for="family">Family</label>
                                <select class="form-control" id="family" name="family[]" required multiple="multiple">
                                    @foreach($families as $single)
                                        <option value="{{ $single->id }}"   @foreach($data->families as $row){{ $row->pivot->family_id == $single->id ? 'selected': ''}}   @endforeach> {{ $single->label }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('family'))
                                    <label id="name-error" class="error mt-2 text-danger" for="name">Please enter family</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('festival') ? 'has-danger' : '' }}">
                                <label for="festival">Festival</label>
                                <select class="form-control" id="festival" name="festival[]" required multiple="multiple">
                                    @foreach($festivals as $single)
                                        <option value="{{ $single->id }}"   @foreach($data->festivals as $row){{ $row->pivot->festival_id == $single->id ? 'selected': ''}}   @endforeach> {{ $single->label }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('festival'))
                                    <label id="name-error" class="error mt-2 text-danger" for="name">Please enter festival</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('others') ? 'has-danger' : '' }}">
                                <label for="others">Others</label>
                                <select class="form-control" id="others" name="others[]" required multiple="multiple">
                                    @foreach($others as $single)
                                        <option value="{{ $single->id }}"   @foreach($data->others as $row){{ $row->pivot->other_id == $single->id ? 'selected': ''}}   @endforeach> {{ $single->label }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('others'))
                                    <label id="name-error" class="error mt-2 text-danger" for="name">Please enter others</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="clearfix"><strong class="text-primary">Images</strong><br></div>
                        </div>

                        <div class="col-md-10">
                            <div class="form-group {{ $errors->has('image_url') ? 'has-danger' : '' }}">
                                <label for="image_url">Feature Image upload</label>
                                <input type="file" id="image_url" name="image_url"
                                       class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled=""
                                           placeholder="Upload">
                                    <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary"
                                            type="button">Upload</button>
                                    </span>
                                </div>

                                @if($errors->has('image_url'))
                                    <label id="name-error" class="error mt-2 text-danger"
                                           for="name"> {{ $errors->first('image_url') }}
                                    </label>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group pt-4">
                                <img src="{{ asset('uploads/products/'.$data->images['0']->image_url) }}" alt="" height="40" weight="40">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                @foreach ($data->images->skip(1) as $item)
                                    <img src="{{ asset('uploads/products/'.$item->image_url) }}" alt="" height="40" width="40">
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="imageFile">Product multiple images</label>
                            <div class="user-image mb-2 text-center">
                                <div class="imgPreview"> </div>
                            </div>
                            <div class="custom-file form-group {{ $errors->has('imageFile') ? 'has-danger' : '' }}">
                                <label class="custom-file-label" for="images">Choose images</label>
                                <input type="file" name="imageFile[]" class="custom-file-input file-upload-default" id="images" multiple="multiple">
                            </div>

                            @if($errors->has('imageFile'))
                                <label id="name-error" class="error mt-2 text-danger"
                                        for="name"> {{ $errors->first('imageFile') }}
                                </label>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <div class="clearfix"><strong class="text-info">Personalization</strong><br></div>
                        </div><br>
                        <div class="col-md-12">
                            @foreach ($data->personalization as $item)
                                    <span class="badge badge-pill badge-primary">{{ $item->label }}</span>
                            @endforeach
                        </div>
                        <div class="col-md-10">
                            <div id="inputFormRow">
                                <div class="input-group mb-3">
                                    {{-- <label class="custom-file-label" for="personalization_label">Personalization</label> --}}
                                    <input type="text" name="personalization_label[]" class="form-control m-input" placeholder="Enter Personalization" autocomplete="off">
                                    <div class="input-group-append">
                                        <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                                    </div>
                                </div>
                            </div>

                            <div id="newRow"></div>
                        </div>
                        <div class="col-md-2">
                            <label for="">&nbsp;</label>
                            <button id="addRow" type="button" class="btn btn-success">+</button>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-js')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#family').select2();
            $('#festival').select2();
            $('#others').select2();
        });
    </script>
    <script type="text/javascript">
    $(function() {
            // Multiple images preview with JavaScript
            var multiImgPreview = function(input, imgPreviewPlaceholder) {
                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };

            $('#images').on('change', function() {
                multiImgPreview(this, 'div.imgPreview');
            });
        });
</script>
<script type="text/javascript">
    // add row
    $("#addRow").click(function () {
        var html = '';
        html += '<div id="inputFormRow">';
        html += '<div class="input-group mb-3">';
        html += '<input type="text" name="personalization_label[]" class="form-control m-input" placeholder="Enter title" autocomplete="off">';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
        html += '</div>';
        html += '</div>';

        $('#newRow').append(html);
    });

    // remove row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
    });
</script>
@endsection
