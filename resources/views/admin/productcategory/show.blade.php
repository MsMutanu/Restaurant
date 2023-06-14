<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product Category</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add your custom styles here */
        /* Rest of the styles... */
    </style>
</head>

<body>
    <div class="container">
        <h1>Edit Product Category</h1>

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <form id="editForm" action="{{ route('admin.productcategory.update', $category->category_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="category">Category Name</label>
                <input type="text" id="category" name="category" class="form-control" value="{{ $category->category }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('editForm');
            const categoryId = "{{ $category->category_id }}";
    
            form.addEventListener('submit', function(event) {
                event.preventDefault();
    
                const formData = new FormData(form);
    
                axios
                    .put(`http://localhost:8000/api/productcategory/${categoryId}`, formData)
                    .then(function(response) {
                        console.log(response.data);
                        // Handle the successful response
                        // You can redirect or show a success message here
                        window.location.href = '/admin/productcategory'
                    })
                    .catch(function(error) {
                        console.error(error);
                        // Handle any errors
                    });
            });
        });
    </script>
    
</body>

</html>
