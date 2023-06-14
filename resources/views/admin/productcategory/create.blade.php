<!DOCTYPE html>
<html>
<head>
    <title>Add Product Category</title>
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
        <h1>Add Product Category</h1>

    

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('productcategory.store') }}">
            @csrf

            <div class="form-group">
                <label for="category">Category Name</label>
                <input type="text" class="form-control" id="category" name="category" required>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        
        document.addEventListener('DOMContentLoaded', function() {
            // Select the form element
            const form = document.querySelector('form');

            // Function to handle form submission
            function handleSubmit(event) {
                event.preventDefault();
                const categoryInput = document.getElementById('category').value;

                // Make the API request to create a product category
                axios.post('http://localhost:8000/api/productcategory', { category: categoryInput })
                    .then(response => {
                        console.log(response.data);
                        // Redirect to the product category index page
                        window.location.href = '/admin/productcategory';
                    })
                    .catch(error => {
                        console.error(error);
                        // Handle any errors
                    });
            }

            // Add form submission event listener
            form.addEventListener('submit', handleSubmit);
        });
    </script>
</body>
</html>
