<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add your custom styles here */
        /* Rest of the styles... */
    </style>
</head>

<body>
    <div class="container">
        <h1>Products</h1>

        <div class="mb-3">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add New Product</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="productsContainer">
                <!-- Products will be dynamically added here -->
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Fetch products on page load
        document.addEventListener('DOMContentLoaded', fetchProducts);

        // Function to fetch products
        function fetchProducts() {
            axios.get('/products')
                .then(response => {
                    const productsContainer = document.getElementById('productsContainer');
                    productsContainer.innerHTML = '';

                    response.data.forEach(product => {
                        const productHtml = `
                            <tr>
                                <td>${product.product_name}</td>
                                <td>${product.category}</td>
                                <td>${product.description}</td>
                                <td>${product.price}</td>
                                <td>
                                    <a href="{{ route('admin.products.edit', '+product.product_id+') }}">Edit</a>
                                    <button class="delete-button" data-product-id="${product.product_id}">Delete</button>
                                </td>
                            </tr>
                        `;
                        productsContainer.innerHTML += productHtml;
                    });

                    // Add event listener to delete buttons
                    const deleteButtons = document.querySelectorAll('.delete-button');
                    deleteButtons.forEach(button => {
                        button.addEventListener('click', () => {
                            const productId = button.getAttribute('data-product-id');
                            deleteProduct(productId);
                        });
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        }

        // Function to delete a product
        function deleteProduct(productId) {
            axios.delete(`/products/${productId}`)
                .then(response => {
                    console.log(response.data);
                    // Remove the deleted row from the table
                    const row = document.querySelector(`[data-product-id="${productId}"]`).parentNode.parentNode;
                    row.remove();
                })
                .catch(error => {
                    console.error(error);
                });
        }
    </script>
</body>

</html>
