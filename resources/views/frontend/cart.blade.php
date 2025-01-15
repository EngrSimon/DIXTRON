@include('layout.header')
<body>
    <!----Navbar starts----->
    @include('layout.navbar')

    <div style="max-width: 900px; margin: 40px auto; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <h1 style="color: #000; text-align: center; margin-bottom: 20px; font-size:3rem;">Your Cart</h1>
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <thead>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 12px; text-align: center; background-color: #eb0905; color: #fff; font-weight: bold;">Product</th>
                    <th style="border: 1px solid #ddd; padding: 12px; text-align: center; background-color: #eb0905; color: #fff; font-weight: bold;">Quantity</th>
                    <th style="border: 1px solid #ddd; padding: 12px; text-align: center; background-color: #eb0905; color: #fff; font-weight: bold;">Total</th>
                </tr>
            </thead>
            <tbody id="cart-list" style="text-align: center;">
                <!-- Cart items will be dynamically added here -->
            </tbody>
        </table>
        <div style="text-align: right; margin-top: 20px;">
            <p id="cart-total" style="font-size: 1.5em; font-weight: bold;">Total: £0.00</p>
            <button id="clear-cart" style="background-color: #eb0905; color: #fff; border: none; padding: 10px 20px; font-size: 1em; cursor: pointer; border-radius: 4px; transition: background-color 0.3s;">
                Clear Cart
            </button>
        </div>
    </div>

<!----Footer starts----->
@include('layout.footer')

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    const cartList = document.getElementById("cart-list");
    const cartTotal = document.getElementById("cart-total");

    // Render the cart items
    function renderCart() {
        cartList.innerHTML = ""; // Clear existing items
        let total = 0;

        if (cart.length === 0) {
            cartList.innerHTML = `<tr><td colspan="3" class="text-center">Your cart is empty.</td></tr>`;
            cartTotal.textContent = "Total: £0.00";
            return;
        }

        cart.forEach((item, index) => {
            const itemRow = document.createElement("tr");
            itemRow.innerHTML = `
                <td>
                    <div class="cart-info">
                        <img src="${item.image}" alt="${item.name}" style="width: 50px;">
                        <div>
                            <p>${item.name}</p>
                            <small>Price: £${item.price.toFixed(2)}</small>
                            <br>
                            <a href="#" class="remove-item" data-index="${index}">Remove</a>
                        </div>
                    </div>
                </td>
                <td>
                    <input type="number" value="${item.quantity}" class="quantity-input" data-index="${index}" min="1">
                </td>
                <td>£${(item.price * item.quantity).toFixed(2)}</td>
            `;
            cartList.appendChild(itemRow);
            total += item.price * item.quantity;
        });

        cartTotal.textContent = `Total: £${total.toFixed(2)}`;
    }

    // Remove item
    cartList.addEventListener("click", function (e) {
        if (e.target.classList.contains("remove-item")) {
            const index = e.target.getAttribute("data-index");
            cart.splice(index, 1);
            localStorage.setItem("cart", JSON.stringify(cart));
            renderCart();
        }
    });

    // Update quantity
    cartList.addEventListener("change", function (e) {
        if (e.target.classList.contains("quantity-input")) {
            const index = e.target.getAttribute("data-index");
            const newQuantity = parseInt(e.target.value, 10) || 1;
            cart[index].quantity = newQuantity;
            localStorage.setItem("cart", JSON.stringify(cart));
            renderCart();
        }
    });

    // Clear the cart
    document.getElementById("clear-cart").addEventListener("click", function () {
        localStorage.removeItem("cart");
        renderCart();
        alert("Cart cleared!");
    });

    // Initial render
    renderCart();
});

</script>