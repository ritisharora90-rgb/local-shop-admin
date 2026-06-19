<h2>Orders</h2>

@foreach($orders as $order)

<div style="
border:1px solid #ddd;
padding:20px;
margin-bottom:15px;
">

<p>Product: {{ $order->productName }}</p>

<p>Price: ₹{{ $order->price }}</p>

<p>Quantity: {{ $order->quantity }}</p>

<p>Status: {{ $order->status }}</p>

@if(($order->status ?? 'Pending') === 'Pending')

<form
action="/admin/orders/{{$order->_id}}/accept"
method="POST"
>

@csrf

<button type="submit">
Accept
</button>

</form>

<br>

<form
action="/admin/orders/{{$order->_id}}/reject"
method="POST"
>

@csrf

<button type="submit">
Reject
</button>

</form>

@endif

</div>

@endforeach