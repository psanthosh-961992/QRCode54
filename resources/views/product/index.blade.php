<title>Products</title>
@extends('layouts.app')
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>
    <strong>Success!</strong> {{ session('success') }}
</div>
@endif
@if(session('error'))
<div class="alert alert-danger alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>
    <strong>Error!</strong> {{ session('error') }}
</div>
@endif
<section class="content">
    <div class="container">
        <form action="{{route('product.store')}}" method="post" autocomplete="off" id="add-product" name="add-product" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Add New Product</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 required">
                                    <div class="form-group ">
                                        <label for="">Product Name</label>
                                        <input type="text" id="prod_name" name="prod_name" class="form-control" placeholder="" maxlength=100 required>
                                    </div>
                                </div>
                                <div class="col-md-4 required">
                                    <div class="form-group tool-tip">
                                        <label for="">Product Code</label>
                                        <input type="text" id="prod_code" name="prod_code" class="form-control" placeholder="" maxlength=100 required>
                                    </div>
                                </div>
                                <div class="col-md-2 modal-footer">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                                <div class="col-md-2 modal-footer">
                                    <a href="{{route('product.qrcode')}}" target="_blank" class="btn btn-primary">Call API</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">List of Products</div>
                    <div class="card-body">
                        @isset($rawdata['list'])
                            @if(count($rawdata['list']) > 0 )
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th>Count</th>
                                            <th>Initialized On</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rawdata['list'] as $product)
                                            <tr>
                                                <td>{{$product->id}}</td>
                                                <td>{{$product->name}}</td>
                                                <td>{{$product->code}}</td>
                                                <td>{{$product->count}}</td>
                                                <td>{{$product->added_on}}</td>
                                                <td><button class="btn btn-primary reload" onclick='window.location.href = "{{route('product.getmaxcount')}}/{{$product->id}}"  '> Increase Qty </button></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                No Data Available !!!
                            @endif
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script> 

let second_api = '{{route("product.getmaxcount")}}';
const dataoffice = { "_token" : $('_token').val() };
$(document).ready(function () {
    $('.auto-capitalization').bind('keyup blur',function(e){ 
                  var start = e.target.selectionStart;
                  var end = e.target.selectionEnd;
                  e.target.value = e.target.value.toUpperCase();
          });
    $('.checkAlphabetsSpacesDot').bind('keyup blur',function(){ 
        var node = $(this);
        node.val(node.val().replace(/[^a-zA-Z. ]/g,'') );    
        });
    $('.checkalphanumeric').bind('keyup blur',function(){ 
        var node = $(this);
        node.val(node.val().replace(/[^a-zA-Z0-9]/g,'') );    
        });
    $('.reload').bind('click',function(){ 
        location.realod();  
        });
    setTimeout(function() {
        $("div.alert.alert-success").remove();
    }, 5000);
    setTimeout(function() {
        $("div.alert.alert-danger").remove();
    }, 5000);
    
});
</script>
@endsection