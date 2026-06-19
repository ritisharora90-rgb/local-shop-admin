<!DOCTYPE html>

<html>

<head>

<title>Admin Dashboard</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
rel="stylesheet">

<style>

body{
background:#f5f7fa;
}

.sidebar{
min-height:100vh;
background:#111827;
}

.sidebar a{
color:white;
text-decoration:none;
padding:12px;
display:block;
border-radius:10px;
margin-bottom:8px;
}

.sidebar a:hover{
background:#1f2937;
}

.stat-card{
border:none;
border-radius:16px;
transition:.3s;
cursor:pointer;
}

.stat-card:hover{
transform:translateY(-5px);
}

.user-card{
border:none;
border-radius:14px;
}

</style>

</head>

<body>

<div class="container-fluid">

<div class="row">

<!-- Sidebar -->

<div class="col-md-2 sidebar text-white p-4">

<h3 class="mb-4">
LocalShop
</h3>

<a href="/admin">
Dashboard
</a>

<a href="/admin/products">
Manage Products
</a>

<a href="/admin/products/create">
Add Product
</a>

<a href="admin/orders">
Orders
</a>

</div>

<!-- Main -->

<div class="col-md-10 p-5">

<div class="d-flex flex-row justify-content-between">
<h2 class="mb-4">
Dashboard
</h2>
<h4>
Welcome,
{{ session('admin_name') }}
</h4>
</div>

<!-- Stats -->

<div class="row g-4">

<!-- Products -->

<div class="col-md-4">

<a
href="/admin/products"
style="text-decoration:none;color:black">

<div class="card stat-card shadow p-4">

<h6>
Total Products
</h6>

<h1>
{{ $productsCount }}
</h1>

<p class="text-primary">
View All Products →
</p>

</div>

</a>

</div>

<!-- Users -->

<div class="col-md-4">

<a
href="/admin/users"
style="text-decoration:none;color:black">

<div class="card stat-card shadow p-4">

<h6>
Total Users
</h6>

<h1>
{{ $usersCount }}
</h1>

<p class="text-success">
View All Users →
</p>

</div>

</a>

</div>

<!-- Orders -->

<div class="col-md-4">

<div class="card stat-card shadow p-4">

<h6>
Total Orders
</h6>

<h1>
80
</h1>

<p class="text-secondary">
Coming Soon
</p>

</div>

</div>

</div>

<!-- Recent Users -->

<div class="mt-5">

<h3 class="mb-4">
Recent Users
</h3>

<div class="row">

@forelse($users as $user)

<div class="col-md-3 mb-4">

<div class="card user-card shadow p-3">

<h5>
{{ $user->name }}
</h5>

<p class="text-muted">

{{ $user->email }}

</p>

</div>

</div>

@empty

<div class="col-12">

<div class="alert alert-warning">

No users found

</div>

</div>

@endforelse

</div>

</div>

</div>

</div>

</div>

</body>

</html>
