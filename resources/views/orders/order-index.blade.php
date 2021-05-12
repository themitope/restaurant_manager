@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
        <h2>Manage orders for {{$resto->name}} </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        <a href="{{route('restos.orders.add', $resto->id)}}" class="btn btn-primary float-right mb-3">Add Order</a>
            @if($orders->count() > 0)
            <manage-orders :orders="{{json_encode($orders)}}"></manage-orders>
                <!-- <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Customer Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->amount}}</td>
                                <td>{{($order->isComplete) ? 'Completed' : 'Incomplete'}}</td>
                                <td>
                                    Name: {{$order['order_details']['customer_name']}}
                                    <br>
                                    Phone: {{$order['order_details']['customer_phone']}}
                                    <br>
                                    Address: {{$order['order_details']['customer_address']}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> -->
            {{$orders->links()}}
            @else
                <p>You do not have any order yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection
