<div class="cart-card">
    <h3>Cart</h3>

    <table class="table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $cartItem)
                <tr>
                    <td>

                        {{ $cartItem->item_name }}

                    </td>
                    <td>

                            {{ $cartItem->pivot->quantity }}


                    </td>
                    <td>
                        Ksh

                            {{ $cartItem->price }}

                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    <p>Total: Ksh {{ $cartTotal }}</p>


</div>
