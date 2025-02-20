@extends('admin.shared.main')
@section('title')
Trinnie Store- Sản phẩm
@endsection
@section('content')
<div class="content_yield">
	<div class="row">
		<h3 class="page_title">Sản phẩm</h3>
		<div class="col-md-12">
			@if(Session::has('message'))
			<div id="div-alert" style="position:absolute; right: 10px;" class="float-right mt-2 alert alert-success alert-dismissible show" role="alert" style="position: absolute;">
				<strong>{{ Session::get('message') }}</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			@elseif(Session::has('err'))
			<div id="div-alert" style="position:absolute; right: 10px;" class="float-right mt-2 alert alert-success alert-dismissible show" role="alert" style="position: absolute;">
				<strong>{{ Session::get('err') }}</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			@endif
		</div>
	</div>
	<a href="{{ route('product.create') }}" class="btn bg-color-green add_new_button"><i class="fas fa-plus"></i> Thêm mới</a>
	<div class="col-md-9">
                    <form action="{{route('product.index')}}" method="GET">
                        <div class="sr" style="display: flex;">
                        	<input class="form-control" value="{{old('keyword')}}" name="keyword" placeholder="{{trans('message.Search')}}..." type="text">
                        <button type="submit"> <i class="fa fa-search"></i> </button>
                        </div>
                    </form>
                </div>
	<table class="table table_xk table-hover table-bordered">
		<thead class="thead_green">
			<tr>
				<th class="text-center" style="width: 3%">STT</th>
				<th class="text-center" style="width: 10%">Tên</th>
				<th class="text-center" style="width: 5%">Hình ảnh</th>
				<th class="text-center" style="width: 10%">Giá</th>
				<th class="text-center" style="width: 10%">Giá khuyến mãi</th>
				<th class="text-center" style="width: 5%">Số lương</th>
				<th class="text-center" style="width: 3%">Hot</th>
				<th class="text-center" style="width: 3%">New</th>
				<th class="text-center" style="width: 4%">#</th>
			</tr>
		</thead>
		<tbody>
			<!-- Loop -->
			@foreach($products as $key => $product)
			<tr>
				<td class="text-center">{{++$key}}</td>
				<td class="text-center">
					<a href="">
						<h4>{{  $product->name }}</h4>
					</a>
				</td>
				<td class="text-center">
					<img src="{{asset('images/'.$product->url_image)}}" width="60" alt="image">
				</td>
				<td class="text-center">{{ $product->price }}</td>
				<td class="text-center">{{ $product->promotion_price }}</td>
				<td class="text-center">{{ $product->quantity }}</td>
				<td class="text-center">
					{!! $product->is_hot == 1 ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>' !!}
				</td>
				<td class="text-center">
					{!! $product->is_new == 1 ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>' !!}
				</td>
				<td class="text-center action_icon">
					<a href="{{route('product.edit',$product->id)}}"><i class="far fa-edit edit"></i></a>
					<a type="button" class="fas fa-trash-alt deletebutton text-danger btn" data-id="{{$product->id}}" data-toggle="modal" data-target="#Modal"></a>
				</td>
			</tr>
			@endforeach
			<!-- End loop -->
		</tbody>
	</table>
</div>
{{Form::open(['route' => ['product.delete'], 'method' => 'DELETE'])}}
@include('admin.modal.modaldelete')
{{ Form::close() }}
<script>
	$(document).on('click','.deletebutton',function(){
		var id=$(this).attr('data-id');
		console.log(id);
		$('#id').val(id);
	});
</script>
<script>
    setTimeout(function() {
        var element = document.getElementById("div-alert");
        element.classList.add("fade");
    }, 2000)
</script>
@endsection
