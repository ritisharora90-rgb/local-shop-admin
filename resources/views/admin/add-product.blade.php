<!DOCTYPE html>

<html>

<head>

<link 
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>


<body>


<div class="container mt-4">


<h2>Add Product</h2>


<form method="POST"
action="/admin/add-product">


@csrf


<input 
class="form-control mb-2"
name="name"
placeholder="Product Name">


<input 
class="form-control mb-2"
name="price"
placeholder="Price">


<textarea
class="form-control mb-2"
name="description"
placeholder="Description">
</textarea>


<input 
class="form-control mb-2"
name="image"
placeholder="Image URL">


<button class="btn btn-success">

Add Product

</button>


</form>


</div>


</body>

</html>