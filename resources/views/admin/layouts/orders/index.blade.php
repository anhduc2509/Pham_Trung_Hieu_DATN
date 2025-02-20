@extends('admin.shared.main')
@section('title')
Trinnie Store - Đơn hàng
@endsection
@section('content')
<div class="content_yield">
	<div class="row">
		<h3 class="page_title">ĐƠn hàng</h3>
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
	<div class="col-md-9">
                    <form action="{{route('order.index')}}" method="GET">
                        <div class="sr" style="display: flex;">
                        	<input class="form-control" value="{{old('keyword')}}" name="keyword" placeholder="{{trans('message.Search')}}..." type="text">
                        <button type="submit"> <i class="fa fa-search"></i> </button>
                        </div>
                    </form>
    </div>
	<table class="table table_xk table-hover table-bordered">
		<thead class="thead_green">
			<tr>
				<th class="text-center">STT</th>
				<th class="text-center">Tên khách hàng</th>
				<th class="text-center">Trạng thái</th>
				<th class="text-center">Trạng thái thanh toán</th>
				<th class="text-center">Ngày giao dịch</th>
				<th class="text-center">#</th>
			</tr>
		</thead>
		<tbody>
			<!-- Loop -->
			@foreach($orders as $key => $order)
			<tr>
				<td class="text-center">{{++$key}}</td>
				<td class="text-center">{{$order->customers->full_name}}</td>
				<td class="text-center">
					{{ Form::open(['route'=>['order.update',$order->id],'method'=>'put']) }}
					<button class="btn btn-sm btn-success btn-confirmation" type="submit">
						{{$order->order_status == 1 ? 'Đang chờ giao' : 'Đã giao Hàng'}}
					</button>
					{{ Form::close() }}
				</td>

				<td class="text-center">
					@if($order->payment_status == 1)
						<button class="btn btn-sm btn-danger btn-payment" value="{{$order->id}}">COD</button>
					@elseif($order->payment_status == 2)
						<button class="btn btn-sm btn-success btn-payment" value="{{$order->id}}" >Momo</button>
					@else
						<button class="btn btn-sm btn-success btn-payment" value="{{$order->id}}" >VNPAY</button>
					@endif
				</td>

				<td class="text-center">{!! Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->created_at)->format('d.m.Y') !!}</td>

				<td class="text-center action_icon">
					<a href="{{url('admin/order/show/'.$order->id)}}"><i class="fa fa-info detail"></i></a>
					<a type="button" class="fas fa-trash-alt deletebutton text-danger btn" data-id="{{$order->id}}" data-toggle="modal" data-target="#Modal"></a>
				</td>
			</tr>
			@endforeach
			<!-- End loop -->
		</tbody>
	</table>
</div>

{{Form::open(['route' => ['order.delete'], 'method' => 'DELETE'])}}
@include('admin.modal.modaldelete')
{{ Form::close() }}
<script>
	$(document).on('click','.deletebutton',function(){
		var id=$(this).attr('data-id');
		console.log(id);
		$('#id').val(id);
	});
	setTimeout(function() {
		var element = document.getElementById("div-alert");
		element.classList.add("fade");
	}, 2000)

	//Ajax show order detail
</script>
@endsection
