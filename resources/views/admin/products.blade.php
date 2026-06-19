<div class="container mt-4">

<h2>Products</h2>

<a href="/admin/add-product"
class="btn btn-primary">

Add Product

</a>


<table class="table mt-3">

<tr>
<th>Name</th>
<th>Price</th>
<th>Action</th>
</tr>

@foreach($products as $product)

<tr>

<td>{{$product->name}}</td>

<td>{{$product->price}}</td>

<td>

<form
action="{{ route('products.destroy',$product->_id ?? $product->id) }}"
method="POST"
>

@csrf
@method('DELETE')

<button
type="submit"
class="btn btn-danger"
>

Delete

</button>

</form>

</td>

</tr>

@endforeach

</table>

</div>