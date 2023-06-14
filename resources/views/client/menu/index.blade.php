<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add your custom styles here */
        /* Rest of the styles... */
    </style>
</head>

<body>
    <div class="container">
        <h1>Menu</h1>

        <div id="categoryContainer" class="mb-3">
            @foreach ($categories as $category)
        <button class="category-button" data-category="{{ $category->id }}">{{ $category->name }}</button>
    @endforeach
        </div>

        <div id="productContainer">
            @foreach ($products as $product)
        <div class="product">
            <h3>{{ $product->product_details }}</h3>
            <p>{{ $product->product_price }}</p>
        </div>
    @endforeach
        </div>

        <div id="cartContainer">
            <!-- Cart container -->
        </div>
    </div>
    <script>
        // Add event listener to category buttons
        document.querySelectorAll('.category-button').forEach(button => {
            button.addEventListener('click', () => {
                const category = button.getAttribute('data-category');
                fetchProductsByCategory(category);
            });
        });
    
        // Function to fetch products based on category
        function fetchProductsByCategory(category) {
            axios.get(`http://localhost:8000/api/product/category/${category}`)
                .then(response => {
                    const productsContainer = document.getElementById('productsContainer');
                    productsContainer.innerHTML = '';
    
                    response.data.forEach(product => {
                        const productHtml = `
                            <div class="product">
                                <h3>${product.name}</h3>
                                <p>${product.description}</p>
                                <p>${product.price}</p>
                            </div>
                        `;
                        productsContainer.innerHTML += productHtml;
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryContainer = document.getElementById('categoryContainer');
            const productContainer = document.getElementById('productContainer');
            const cartContainer = document.getElementById('cartContainer');

            // Function to create a category button
            function createCategoryButton(category) {
                const button = document.createElement('button');
                button.className = 'btn btn-primary mr-2';
                button.textContent = category.category;
                button.addEventListener('click', function() {
                    fetchProductsByCategory(category.category_id);
                });
                return button;
            }

            // Function to create a product card
            function createProductCard(product) {
                const card = document.createElement('div');
                card.className = 'card mb-3';
                card.innerHTML = `
                    <img src="${product.image}" class="card-img-top" alt="Product Image">
                    <div class="card-body">
                        <h5 class="card-title">${product.name_id}</h5>
                        <p class="card-text">${product.product_price}</p>
                        <button class="btn btn-primary" onclick="addToCart(${product.product_id})">Add to Cart</button>
                    </div>
                `;
                return card;
            }

            // Function to create the cart item
            function createCartItem(orderitem) {
                const cartItem = document.createElement('div');
                cartItem.className = 'alert alert-primary mb-2';
                cartItem.textContent = orderitem.name;
                return cartItem;
            }

            // Function to fetch products by category
            function fetchProductsByCategory(category_id) {
                axios.get(`http://localhost:8000/api/product=${category_id}`)
                    .then(response => {
                        console.log(response.data);
                        // Clear the product container
                        productContainer.innerHTML = '';
                        // Iterate over the products and create product cards
                        response.data.forEach(product => {
                            const card = createProductCard(product);
                            productContainer.appendChild(card);
                        });
                    })
                    .catch(error => {
                        console.error(error);
                        // Handle any errors
                    });
            }

            // Function to fetch all categories
            function fetchCategories() {
                axios.get('http://localhost:8000/api/productcategory')
                    .then(response => {
                        console.log(response.data);
                        // Clear the category container
                        categoryContainer.innerHTML = '';
                        // Iterate over the categories and create category buttons
                        response.data.forEach(category => {
                            const button = createCategoryButton(category);
                            categoryContainer.appendChild(button);
                        });
                    })
                    .catch(error => {
                        console.error(error);
                        // Handle any errors
                    });
            }

            // Function to add a product to the cart
            function addToCart(productId) {
                axios.post('http://localhost:8000/api/orderitem', { product_id: productId })
                    .then(response => {
                        console.log(response.data);
                        // Handle the successful response
                        // Add the cart item to the cart container
                        const cartItem = createCartItem(response.data);
                        cartContainer.appendChild(cartItem);
                    })
                    .catch(error => {
                        console.error(error);
                        // Handle any errors
                    });
            }

            // Fetch categories and initialize the page
            fetchCategories();

            // Check if the cart is empty
            axios.get('http://localhost:8000/api/orderitem')
                .then(response => {
                    console.log(response.data);
                    // Clear the cart container
                    cartContainer.innerHTML = '';
                    // Check if the cart is empty
                    if (response.data.length === 0) {
                        const emptyCartMessage = document.createElement('div');
                        emptyCartMessage.textContent = 'Cart empty. Add menu items.';
                        cartContainer.appendChild(emptyCartMessage);
                    } else {
                        // Iterate over the cart items and create cart items in the cart container
                        response.data.forEach(item => {
                            const cartItem = createCartItem(item);
                            cartContainer.appendChild(cartItem);
                        });
                    }
                })
                .catch(error => {
                    console.error(error);
                    // Handle any errors
                });
        });
    </script>
</body>

</html>
