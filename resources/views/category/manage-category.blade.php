@extends('layouts.app')
@section('content')
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>

</head>
<body>


<div class="panel-body">
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success')  }}
        </div>
    @endif
</div>

<div class="container py-3">
    @include('modals.edit-category')
    <div class="row">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    <h3>Categories</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group" >
                        @foreach ($categories as $category)
                        <li class="list-group-item" style="background-color: #c5c5bc; margin-bottom: 15px">
                            <div class="justify-content-between input-group">
                                {{ $category->name }}

                                <div class="input-group d-flex">
                                    <button style="margin-right: 15px" type="button" onclick="loadEditModal('category', '{{ $category->id }}','{{ $category->name }}', '{{ $category->parent_id }}', [])" class="btn btn-sm btn-primary mr-1 edit-category"
                                            data-toggle="modal"
                                            data-target="#editCategoryModal"
                                            data-category-type="category"
                                            data-id="{{ $category->id }}"
                                            data-name="{{ $category->name }}">Edit</button>
                                    <a type="submit" href="{{ url('/') }}/category/delete-category/{{ $category->id }}" class="btn btn-sm btn-danger">Delete</a>

                                </div>
                            </div>

                            @if ($category->children)
                            <ul class="list-group mt-1" style="margin: 15px 0px">
                                @foreach ($category->children as $subcat)
                                <li class="list-group-item" style="background-color: #9e9e9e; margin-bottom: 15px">
                                    <div class="d-flex justify-content-between">
                                        {{ $subcat->name }}

                                        <div class="input-group d-flex">
                                            <button style="margin-right: 15px" type="button"
                                                    data-toggle="modal"
                                                    data-target="#editCategoryModal"
                                                onclick="loadEditModal('sub-category', '{{ $subcat->id }}', '{{ $subcat->name }}', '{{ $subcat->parent_id }}', {{json_encode($categories)}})" class="btn btn-sm btn-primary mr-1 edit-category"
                                                  >Edit</button>
                                            <a type="submit" href="{{ url('/') }}/category/delete-sub-category/{{ $subcat->id }}" class="btn btn-sm btn-danger">Delete</a>

                                        </div>
                                    </div>

                                    @if ($subcat->children)
                                        <ul class="list-group mt-1" style="margin: 15px 0px">
                                            @foreach ($subcat->children as $child)
                                                <li class="list-group-item" style="background-color: #fbfffb; margin-bottom: 15px">
                                                    <div class="d-flex justify-content-between">
                                                        {{ $child->name }}

                                                        <div class="input-group d-flex">
                                                            <button style="margin-right: 15px" type="button" onclick="loadEditModal('child-category', '{{ $child->id }}','{{ $child->name }}', '{{ $child->parent_id }}', {{json_encode($subcategories)}})" class="btn btn-sm btn-primary mr-1 edit-category"
                                                                    data-toggle="modal"
                                                                    data-target="#editCategoryModal"
                                                                    data-category-type="category"
                                                                    data-id="{{ $category->id }}"
                                                                    data-name="{{ $category->name }}">Edit</button>
                                                            <a type="submit" href="{{ url('/') }}/category/delete-child-category/{{ $category->id }}" class="btn btn-sm btn-danger">Delete</a>

                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif

                                </li>


                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Create Category</h3>
                    </div>

                    <div class="card-body">
                        <form action="{{url('/')}}/category/add-category" method="POST">
                            {{csrf_field()}}

                            <div class="form-group">
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Category Name" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @if ($categories)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Create Sub Category</h3>
                        </div>

                        <div class="card-body">
                            <form action="{{url('/')}}/category/add-sub-category" method="POST">
                                {{csrf_field()}}

                                <div class="form-group">
                                    <select class="form-control" name="parent_id" required>
                                        <option value="">Select Parent Category</option>
                                        @foreach ($categories as $parentcat)
                                            <option value="{{ $parentcat->id }}">{{ $parentcat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Category Name" required>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

            @if ($subcategories)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Create Child Category</h3>
                        </div>

                        <div class="card-body">
                            <form action="{{url('/')}}/category/add-child-category" method="POST">
                                {{csrf_field()}}

                                <div class="form-group">
                                    <select class="form-control" name="parent_id">
                                        <option value="">Select Child Category</option>
                                        @foreach ($subcategories as $subparentcat)
                                            <option value="{{ $subparentcat->id }}">{{ $subparentcat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Category Name" required>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>



    </div>
</div>

<script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>

<script type="text/javascript">
    $('.edit-category').on('click', function() {
        var id = $(this).data('id');
        var parent_id = $(this).data('parent_id');
        var name = $(this).data('name');
        var type = $(this).data('category-type');
        var url = "{{ url('/') }}/category/edit-" + type + '/' + id;
        console.log(id, parent_id, name, type, url);

        $('#editCategoryModal form').attr('action', url);
        $('#editCategoryModal form input[name="parent_id"]').val(parent_id);
        $('#editCategoryModal form input[name="name"]').val(name);
    });

    function loadEditModal(type, id , name, parentID, parents){
        var url = "{{ url('/') }}/category/edit-" + type + '/' + id;
        $('#editCategoryModal form').attr('action', url);
        $('#editCategoryModal form input[name="name"]').val(name);

        var dropdown = $("#edit-parent-dropdown");
        $("#edit-parent-dropdown").html('');
        $.each(parents, function(index, parent) {
            dropdown.append($("<option />").val(parent.id).text(parent.name));
        });

        console.log(url);
        type === 'category' ? $("#edit-parent-dropdown").hide() : $("#edit-parent-dropdown").show();
        $("#edit-parent-dropdown").val(parentID)

    }

</script>
</body>
</html>

@endsection()