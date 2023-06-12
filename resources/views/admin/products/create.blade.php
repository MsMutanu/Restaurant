<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Add Product - Admin Panel</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body>
  <header>
    <h1 class="text-center">Admin Panel - Add Product</h1>
  </header>

  <main>
 
<form id="add-product-form" action="{{ route('products.store') }}" method="POST">
  @csrf

  <label for="name_id">Product Name</label>
  <select name="name_id" id="name_id" required>
      @foreach ($productNames as $productName)
          <option value="{{ $productName->id }}">{{ $productName->name }}</option>
      @endforeach
  </select>

  <label for="category_id">Category</label>
  <select name="category_id" id="category_id" required>
      @foreach ($productCategories as $productCategory)
          <option value="{{ $productCategory->id }}">{{ $productCategory->name }}</option>
      @endforeach
  </select>

  <label for="price">Price</label>
  <input type="number" name="price" id="price" required>

  <button type="submit">Add Product</button>
</form>




  </main>

  <script src="path/to/app.js"></script>
</body>
</html>
