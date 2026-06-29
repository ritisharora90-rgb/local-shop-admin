<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-4">
    <h2>Add Product</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="/admin/add-product" enctype="multipart/form-data">
        @csrf

        {{-- NAME --}}
        <input
            class="form-control mb-2"
            name="name"
            placeholder="Product Name"
            required>

        {{-- PRICE --}}
        <input
            class="form-control mb-2"
            name="price"
            placeholder="Price"
            type="number"
            required>

        {{-- CATEGORY --}}
        <select class="form-control mb-2" name="category" required>
            <option value="">-- Select Category --</option>
            <option value="dairy">Dairy</option>
            <option value="pulses">Pulses</option>
            <option value="snacks">Snacks</option>
            <option value="beverages">Beverages</option>
            <option value="spices">Spices</option>
            <option value="grains">Grains</option>
            <option value="oils">Oils</option>
            <option value="other">Other</option>
        </select>

        {{-- DESCRIPTION --}}
        <textarea
            class="form-control mb-2"
            name="description"
            placeholder="Description">
        </textarea>

        {{-- IMAGE --}}
        <input
            class="form-control mb-2"
            name="image"
            type="file"
            accept="image/*">

        <button class="btn btn-success">
            Add Product
        </button>

    </form>
</div>
</body>
</html>