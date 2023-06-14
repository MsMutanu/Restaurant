<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 500px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            background-color: #f7f7f7;
            padding: 20px;
            border-radius: 5px;
        }

        label {
            font-weight: bold;
        }

        select,
        input {
            margin-bottom: 10px;
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Add Product</h1>

        <main>
            <form id="add-product-form" method="POST" action="{{ route('admin.products.store') }}">
              
                

                <select name="name_id" id="name_id" required>
                    @foreach ($productNames as $productName)
                        <option value="{{ $productName->name_id }}">{{ $productName->product_name }}</option>
                    @endforeach
                </select>
                              
              

                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" required>
                    @foreach ($productCategories as $productCategory)
                        <option value="{{ $productCategory->category_id }}">{{ $productCategory->category }}</option>
                    @endforeach
                </select>

                <label for="product_price">Price</label>
                <input type="number" name="product_price" id="product_price" required>

                <label for="product_details">Product Details</label>
                <textarea name="product_details" id="product_details" rows="4" required></textarea>

                <button type="submit">Add Product</button>
            </form>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Get the form element
        const form = document.getElementById('add-product-form');

        // Handle form submission
        form.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the form from submitting normally
            console.log
            // Get the form data
            const formData = new FormData(form);

            // Convert form data to JSON
            const jsonData = {};
            for (const [key, value] of formData.entries()) {
                jsonData[key] = value;
            }

            // Send the data using Axios
            axios.post('http://localhost:8000/api/product', jsonData)
                .then(function (response) {
                    console.log(response.data);
                    

                    window.location.href = '/admin/product';
                })
                .catch(function (error) {
                    console.log(error);
                    // Handle any errors here
                });
        });
    </script>
</body>

</html>
