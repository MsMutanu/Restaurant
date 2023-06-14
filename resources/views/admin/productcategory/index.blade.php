<!DOCTYPE html>
<html>
<head>
    <title>Product Categories</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add your CSS styles here */
        html {
            font-family: sans-serif;
        }
      
        html, body {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }
        /* Rest of the CSS styles... */
    </style>
</head>
<body>
    <div class="container">
        <h1>Product Categories</h1>

        <div class="mb-3">
            <a href="{{ route('productcategory.create') }}" class="btn btn-primary">Add New Category</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->category_id }}</td>
                        <td>{{ $category->category }}</td>
                        <td>
                            <a href="{{ route('admin.productcategory.edit', $category->category_id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('admin.productcategory.destroy', $category->category_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Add the necessary code here
        document.addEventListener('DOMContentLoaded', function() {
            // Select the table body
            const tbody = document.querySelector('tbody');
    
            // Function to create a table row
            function createTableRow(category) {
                const tr = document.createElement('tr');
                tr.innerHTML = 
                    <td>${category.category_id}</td>
                    <td>${category.category}</td>
                    <td>
                        <a href="{{ route('admin.productcategory.show', $category->category_id) }}" class= "btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.productcategory.destroy', $category->category_id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="deleteCategory(${category.category_id})">Delete</button>
                        </form>
                    </td>
                ;
                return tr;
            }
    
            // Make the API request to fetch product categories
            axios.get('http://localhost:8000/api/productcategory')
                .then(response => {
                    console.log(response.data);
                    // Clear the table body
                    tbody.innerHTML = '';
                    // Iterate over the categories and create table rows
                    response.data.forEach(category => {
                        const tr = createTableRow(category);
                        tbody.appendChild(tr);
                    });
                })
                .catch(error => {
                    console.error(error);
                    // Handle any errors
                });
        });
    
        function deleteCategory(categoryId) {
            // Send a DELETE request to the API endpoint
            axios.delete(`http://localhost:8000/api/productcategory/${categoryId}`)
                .then(response => {
                    console.log(response.data);
                    
                    // Remove the deleted row from the table
                    const row = document.getElementById(`row-${categoryId}`);
                    if (row) {
                        row.remove();
                    }
                })
                .catch(error => {
                    console.error(error);
                    // Handle any errors
                });
        }
    </script>
    
</body>
</html>
