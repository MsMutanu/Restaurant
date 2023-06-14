<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product Name</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add your custom styles here */
        /* Rest of the styles... */
    </style>
</head>

<body>
    <div class="container">
        <h1>Add Product Name</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="createForm" method="POST" action="{{ route('productnames.store') }}">
            @csrf

            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" id="product_name" name="product_name" class="form-control" required>
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
                const categoryInput = document.getElementById('product_name').value;

                axios
                    .post('http://localhost:8000/api/productname', { name: nameInput })
                    .then(response => {
                        console.log(response.data);
                        // Redirect to the product names index page
                        window.location.href = '/admin/productname';
                    })
                    ..catch(error => {
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
