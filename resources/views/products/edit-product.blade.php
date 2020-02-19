@extends('layouts.app')
@section('content')
    <div class="app-title col-md-6 col-md-offset-3">
        <div>
            <h1><i class="fa fa-shopping-bag"></i> Edit product</h1>
        </div>
    </div>

    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>
    <div class="col-md-12 row" style="margin-bottom: 100px">
        <div class="col-md-6 col-md-offset-3">
            <div class="tab-content">
                <div class="tab-pane active" id="general">
                    <div class="tile">
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <h3 class="tile-title">Product Information</h3>
                            <hr>
                            <div class="tile-body">
                                <input type="hidden" name="product_id" value="{{ $product->id }}"/>
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                    <label class="control-label" for="name">Name</label>
                                    <input
                                            class="form-control"
                                            type="text"
                                            placeholder="Enter product name"
                                            id="name"
                                            name="name"
                                            value="{{ $product->name }}"
                                    />
                                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}

                                </div>

                                <div class="row" id="category-inputs">
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('category') ? 'has-error' : ''}}">
                                            <label class="control-label">Categories</label>
                                            <select name="category" id="category-drop-down" value="{{ old('category') }}" class="form-control">
                                                @foreach($categories as $i=>$category)
                                                    <option @if($category->id == $product->category) selected  @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            {!! $errors->first('category', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row" id="sub-category-inputs">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Sub Categories</label>
                                            <select name="sub_category" id="sub-category-drop-down" value="{{ old('sub-category') }}" class="form-control">
                                                    @foreach($sub_categories as $category)
                                                        <option @if($product->sub_category == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                            </select>
                                            {!! $errors->first('sub-category', '<p class="help-block">:message</p>') !!}

                                        </div>
                                    </div>
                                </div>

                                <div class="row" id="child-category-inputs">
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('child-category') ? 'has-error' : ''}}">
                                            <label class="control-label">Child Categories</label>
                                            <select name="child_category" id="child-category-drop-down" class="form-control">
                                                    @foreach($child_categories as $category)
                                                        <option @if($product->child_category == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                            </select>
                                            {!! $errors->first('child-category', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('actual_price') ? 'has-error' : ''}}">
                                            <label class="control-label" for="price">Actual Price</label>
                                            <input
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    type="text"
                                                    placeholder="Enter actual price"
                                                    id="actual_price"
                                                    name="actual_price"
                                                    value="{{ $product->actual_price }}"
                                            />
                                            {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('discounted_price') ? 'has-error' : ''}}">
                                            <label class="control-label" for="special_price">Discounted Price</label>
                                            <input
                                                    class="form-control"
                                                    type="text"
                                                    placeholder="Enter Discounted price"
                                                    id="discounted_price"
                                                    name="discounted_price"
                                                    value="{{ $product->discounted_price }}"
                                            />
                                            {!! $errors->first('discounted_price', '<p class="help-block">:message</p>') !!}

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('color') ? 'has-error' : ''}}">
                                    <label class="control-label" for="name">Color</label>
                                    <input
                                            class="form-control"
                                            type="text"
                                            placeholder="Enter color"
                                            id="color"
                                            name="color"
                                            value="{{ $product->color }}"
                                    />
                                    {!! $errors->first('color', '<p class="help-block">:message</p>') !!}

                                </div>

                                <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                    <label class="control-label" for="description">Description</label>
                                    <textarea name="description" id="description" value="{{ old('description') }}" rows="8" class="form-control">{{ $product->description }}</textarea>
                                    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
                                            <label class="control-label">Image</label>
                                                <input type="file" name="image" class="form-control">
                                            {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-12 tile-footer">
                                <div class="row d-print-none mt-2">
                                    <div class="col-12 text-right">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Product</button>
                                        <a class="btn btn-danger" href="{{ route('products.index') }}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Go Back</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <script>
        $( document ).ready(function() {

            var subCategories = [];
            var childCategories = [];
            var subCategorydropdown = $("#sub-category-drop-down");
            var childCategorydropdown = $("#child-category-drop-down");

            // subCategorydropdown.html('');
            // childCategorydropdown.html('');
            //
            // $.each(subCategories, function(index, category) {
            //     subCategorydropdown.append($("<option />").val(category.id).text(category.name));
            // });
            //
            // $.each(childCategories, function(index, category) {
            //     childCategorydropdown.append($("<option />").val(category.id).text(category.name));
            // });

            $('#category-drop-down').change(function () {
                var parent_id= $('#category-drop-down').val();
                console.log(parent_id);
                $.ajax({
                    type: 'POST',
                    url: base_url+ '/category/get-sub-category/'+parent_id,
                    data: {
                        '_token': '{{csrf_token()}}'
                    },
                    success: function(resultData) {
                        resetSubCategory(resultData.categories)
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            })

            $('#sub-category-drop-down').change(function () {
                var parent_id = $('#sub-category-drop-down').val();
                console.log(parent_id);
                $.ajax({
                    type: 'POST',
                    url: base_url+ '/category/get-child-category/'+parent_id,
                    data: {
                        '_token': '{{csrf_token()}}'
                    },
                    success: function(resultData) {
                        resetChildCategory(resultData.categories)
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            })

            function resetSubCategory(subCategory){
                subCategorydropdown.html('');
                childCategorydropdown.html('');

                $.each(subCategory, function(index, category) {
                    subCategorydropdown.append($("<option />").val(category.id).text(category.name));
                });

            }

            function resetChildCategory(ChildCategory){
                childCategorydropdown.html('');

                $.each(ChildCategory, function(index, category) {
                    childCategorydropdown.append($("<option />").val(category.id).text(category.name));
                });
            }
        });


    </script>
