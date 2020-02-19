@extends('layouts.app')
@section('content')

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">

    <div class="app-title col-md-10 col-md-offset-1">
        <div class="row" style="padding: 15px">
            <h1><i class="fa fa-tags"></i> Products</h1>
            <p>Manage Products</p>
            <a href="{{ route('products.create') }}" class="btn btn-primary pull-right">Add Product</a>
        </div>
        <div>
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success')  }}
                </div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error')  }}
                </div>
            @endif
        </div>
    </div>
{{--    @include('admin.partials.flash')--}}
    <div class="row" style="margin-top:15px">
        <div class="col-md-10 col-md-offset-1">
            <div class="title">
                <div class="title-body">
                    <table class="table table-striped table-bordered " style="width:100%" id="sampleTable">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th> Name </th>
                            <th class="text-center"> Price </th>
                            <th class="text-center"> Category </th>
                            <th class="text-center"> Sub Category </th>
                            <th class="text-center"> Child Category </th>
                            <th class="text-center"> Color </th>
                            <th class="text-center"> Image </th>
                            <th style="width:100px; min-width:100px;" class="text-center text-danger"> Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($products) && count($products))
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->categoryDetails->name }}</td>
                                <td>{{ $product->subCategoryDetails->name }}</td>
                                <td>{{ $product->childCategoryDetails->name }}</td>
                                <td>{{ $product->color }}</td>
                                <td>
                                    <div>
                                        <img src="{{ $image_path . $product->image}}" width="100" height="100" alt="Image"/>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="input-group" role="group">
                                        <a style="display: inline; margin-right: 15px" href="{{ route('products.edit', $product->id) }}" class="input-group btn btn-sm btn-primary">Edit</a>
                                        <a style="display: inline" href="{{ route('products.delete', $product->id) }}" class="input-group btn btn-sm btn-danger">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @else
                            <tr>
                                <td colspan="10" align="center">
                                    No Records
                                </td>
                            </tr>
                        @endif()
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
<script type="text/javascript">

        $(document).ready(function() {
            console.log('loaded');
            $('#sampleTable').DataTable();

        } );

    </script>
