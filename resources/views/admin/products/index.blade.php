<!DOCTYPE html>

<html>

<head>

<title>Products</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<h2 class="mb-4">

Products

</h2>

<a
href="/admin/add-product"
class="btn btn-primary mb-4"
>

Add Product

</a>

<div class="row">

@foreach($products as $product)

<div
class="col-12 col-sm-6 col-lg-3 mb-4"
>

<div
class="card shadow h-100"
>

@if(!empty($product->image))

<img
src="{{ asset('storage/'.$product->image) }}"
class="card-img-top"
style="
height:220px;
object-fit:cover;
">

@endif


<div
class="card-body d-flex flex-column"
>

<h5>

{{$product->name}}

</h5>

<p>

₹ {{$product->price}}

</p>


<div class="mt-auto">

<a
href="/admin/edit-product/{{$product->_id ?? $product->id}}"
class="btn btn-warning w-100 mb-2"
>

Update

</a>


<form
action="{{ route(
'products.destroy',
$product->_id ?? $product->id
) }}"
method="POST"
>

@csrf
@method('DELETE')

<button
type="submit"
class="btn btn-danger w-100"
>

Delete

</button>

</form>

</div>

</div>

</div>

</div>

@endforeach

</div>

</div>

</body>

</html>