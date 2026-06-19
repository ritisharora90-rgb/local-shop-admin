<!DOCTYPE html>
<html>

<head>

<title>All Users</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2 class="mb-4">
All Users
</h2>

<div class="row">

@forelse($users as $user)

<div class="col-md-4">

<div class="card p-3 mb-3">

<h5>
{{ $user->name }}
</h5>

<p>
{{ $user->email }}
</p>

</div>

</div>

@empty

<p>
No users found
</p>

@endforelse

</div>

</div>

</body>

</html>