@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="center" align="center">
                        <a class="btn btn-primary" href="{{url('/')}}/category/manage">
                            Manage Categories
                        </a>

                        <a class="btn btn-primary" href="{{url('/')}}/products/manage">
                            Manage Products
                        </a>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
