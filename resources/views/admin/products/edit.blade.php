<!DOCTYPE html>

<html>

<head>

<title>Update Product</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>

Update Product

</h2>


<form

action="/admin/update-product/{{$product->_id ?? $product->id}}"

method="POST"

enctype="multipart/form-data"

>

@csrf


<input

type="text"

name="name"

value="{{$product->name}}"

class="form-control mb-3"

placeholder="Product Name"

>


<input

type="number"

name="price"

value="{{$product->price}}"

class="form-control mb-3"

placeholder="Price"

>


<input

type="text"

name="category"

value="{{$product->category ?? ''}}"

class="form-control mb-3"

placeholder="Category"

>


<textarea

name="description"

class="form-control mb-3"

>

{{$product->description ?? ''}}

</textarea>


<input

type="file"

name="image"

class="form-control mb-3"

>


<button

class="btn btn-success"

>

Update Product

</button>


</form>

</div>

</body>

</html>