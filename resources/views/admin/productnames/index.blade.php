<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Names</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add your custom styles here */
        /* Rest of the styles... */
    </style>
</head>

<body>
    <div class="container">
        <h1>Product Names</h1>

        <div class="mb-3">
            <a href="{{ route('productnames.create') }}" class="btn btn-primary">Add New Name</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Name ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($names as $name)
                    <tr>
                        <td>{{ $name->name_id }}</td>
                        <td>{{ $name->product_name }}</td>
                        <td>
                            <a href="/admin/productnames/{{ $name->name_id }}/edit" class="btn btn-sm btn-primary">Edit</a>
                            <button type="button" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this name?')">Delete</button>
                    </tr>
                @endforeach
            </tbody>
            
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tbody = document.querySelector('tbody');

            // Function to create a table row
            function createTableRow(name) {
                const tr = document.createElement('tr');
                tr.innerHTML = 
                    <td>${name.name_id}</td>
                    <td>${name.prduct_name}</td>
                    <td>
                        <a href="/admin/productnames/${name.name_id}/edit" class="btn btn-sm btn-primary">Edit</a>
                        <button type="button" class="btn btn-sm btn-danger" onclick="deleteName(${name.name_id})">Delete</button>
                    </td>
                ;
                return tr;
            }

            // Make the API request to fetch product names
            axios.get('http://localhost:8000/api/productname')
                .then(response => {
                    console.log(response.data);
                    // Clear the table body
                    tbody.innerHTML = '';
                    // Iterate over the names and create table rows
                    response.data.forEach(name => {
                        const tr = createTableRow(name);
                        tbody.appendChild(tr);
                    });
                })
                .catch(error => {
                    console.error(error);
                    // Handle any errors
                });
        });

        function deleteName(nameId) {
            axios.delete(`http://localhost:8000/api/productname/${nameId}`)
                .then(response => {
                    console.log(response.data);
                    // Handle the successful response
                    // Remove the deleted row from the table
                    const row = document.getElementById(`row-${nameId}`);
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
