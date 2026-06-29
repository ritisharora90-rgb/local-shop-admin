<!DOCTYPE html>
<html>

<head>

<title>Add Product</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
rel="stylesheet">

<link
href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-7">

<div class="card shadow-lg border-0 rounded-4">

<div class="card-header bg-primary text-white text-center rounded-top-4">

<h3>
<i class="bi bi-bag-plus"></i>
Add New Product
</h3>

</div>

<div class="card-body p-5">


<form
method="POST"
action="/admin/products"
enctype="multipart/form-data">

@csrf


<label class="form-label">
Product Name
</label>

<div class="input-group mb-3">

<span class="input-group-text">
<i class="bi bi-box"></i>
</span>

<input
type="text"
class="form-control"
name="name"
placeholder="Enter product name"
required>

</div>



<label class="form-label">
Price
</label>

<div class="input-group mb-3">

<span class="input-group-text">
₹
</span>

<input
type="number"
class="form-control"
name="price"
placeholder="Enter price"
required>

</div>



<label class="form-label">
Category
</label>

<div class="input-group mb-3">

<span class="input-group-text">
<i class="bi bi-tags"></i>
</span>

<input
type="text"
class="form-control"
name="category"
placeholder="Enter category">

</div>



<label class="form-label">
Upload Image
</label>

<div class="input-group mb-3">

<span class="input-group-text">
<i class="bi bi-image"></i>
</span>

<input
type="file"
class="form-control"
name="image"
accept="image/*">

</div>



<label class="form-label">
Description
</label>

<textarea
class="form-control mb-4"
rows="4"
name="description"
placeholder="Write product description">
</textarea>



<button
type="submit"
class="btn btn-success w-100 btn-lg">

<i class="bi bi-plus-circle"></i>

Add Product

</button>

</form>

</div>

</div>

</div>

</div>

</div>

</body>

</html>