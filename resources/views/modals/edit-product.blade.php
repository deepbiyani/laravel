<div class="modal" tabindex="-1" role="dialog" id="editProductModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="tile">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <h3 class="tile-title">Product Information</h3>
                    <hr>
                    <div class="tile-body">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                            <label class="control-label" for="name">Name</label>
                            <input
                                    class="form-control"
                                    type="text"
                                    placeholder="Enter product name"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                            />
                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}

                        </div>

                        <div class="row" id="category-inputs">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('category') ? 'has-error' : ''}}">
                                    <label class="control-label">Categories</label>
                                    <select name="category" id="category-drop-down" value="{{ old('category') }}" class="form-control">
                                        @php
                                            $selectedCategory = $categories[0];
                                        @endphp
                                        @foreach($categories as $i=>$category)
                                            <option @if($category->id == $selectedCategory->id) selected  @endif value="{{ $category->id }}">{{ $category->name }}</option>
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
                                            @php
                                                if($category->parent_id == $selectedCategory->id){
                                                    $selectedSubCategory = $sub_categories[$i];
                                                }
                                            @endphp
                                            @if($category->parent_id == $selectedCategory->id){
                                            <option  value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endif
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
                                            @php
                                                if($category->parent_id == $selectedSubCategory->id){
                                                    $selectedChildCategory = $child_categories[$i];
                                                }
                                            @endphp
                                            @if($category->parent_id == $selectedSubCategory->id){
                                            <option @if($category->id == "{{ old('child-category') }}") selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    {!! $errors->first('child-category', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
                                    <label class="control-label" for="price">Price</label>
                                    <input
                                            class="form-control @error('price') is-invalid @enderror"
                                            type="text"
                                            placeholder="Enter product price"
                                            id="price"
                                            name="price"
                                            value="{{ old('price') }}"
                                    />
                                    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('color') ? 'has-error' : ''}}">
                                    <label class="control-label" for="special_price">Color</label>
                                    <input
                                            class="form-control"
                                            type="text"
                                            placeholder="Enter color"
                                            id="special_price"
                                            name="color"
                                            value="{{ old('color') }}"
                                    />
                                    {!! $errors->first('color', '<p class="help-block">:message</p>') !!}

                                </div>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                            <label class="control-label" for="description">Description</label>
                            <textarea name="description" id="description" value="{{ old('description') }}" rows="8" class="form-control">{{ old('description') }}</textarea>
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
                                <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Product</button>
                                <a class="btn btn-danger" href="{{ route('products.index') }}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Go Back</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>