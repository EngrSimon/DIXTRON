@include('layout.header')
<body>
<!----Navbar starts----->
@include('layout.navbar')




<!----------------------------->

<!-----promo section---->
    <div class="promo-section">
        <div class="promo-text">On-Sale Laptops</div>
        <a href="laptops.html" class="promo-button">Shop now</a>
    </div>



    <section class="brand-section">
        <div class="brand-content">
            <h1>Kingston</h1>
            <p>Kingston was founded through the design of a new type of memory module which fulfilled a demand for memory that would serve to redefine industry standards for years to come. Today, Kingston is a leading global manufacturer of memory and storage solutions, and distributed by Direct Computers.</p>
            <p class="short-text">
                From SATA to NVMe,<span class="dots">...</span>
                <span class="more-text">
                    laptop to server, Kingston SSDs provide the speed and reliability you want for the upgrade you need for PC builds, servers and system builders.

All Kingston memory is backed by 100% testing, a lifetime warranty and over 35 years of design and manufacturing expertise.

Whether you're a PC enthusiast, gamer or content creator, Kingston FURY is the choice for high-performance memory.
                </span>
            </p>
            <a href="javascript:void(0)" class="read-more" onclick="toggleReadMore()">Read More</a>
        </div>
    </section>

    <script>
        function toggleReadMore() {
            var moreText = document.querySelector(".more-text");
            var dots = document.querySelector(".dots");
            var btn = document.querySelector(".read-more");

            if (moreText.style.display === "inline") {
                moreText.style.display = "none";
                dots.style.display = "inline";
                btn.textContent = "Read More";
            } else {
                moreText.style.display = "inline";
                dots.style.display = "none";
                btn.textContent = "Read Less";
            }
        }

        document.addEventListener("DOMContentLoaded", function () {
            document.querySelector(".more-text").style.display = "none";
        });
    </script>

<br> <br> <br> <br> <br>

<!----FOOTER----->
@include('layout.footer')

<script>
	//cart
  document.addEventListener("DOMContentLoaded", function () {
    const addToCartButtons = document.querySelectorAll(".add-to-cart");
    const cartIcon = document.querySelector(".fa-shopping-cart");
    const cart = JSON.parse(localStorage.getItem("cart")) || [];

    // Function to update the cart count
    function updateCartCount() {
      const cartCount = cart.reduce((total, item) => total + item.quantity, 0);
      cartIcon.textContent = ` (${cartCount})`;
    }

    // Function to add an item to the cart
    function addToCart(product) {
      const existingProduct = cart.find(item => item.id === product.id);
      if (existingProduct) {
        existingProduct.quantity += 1;
      } else {
        cart.push({ ...product, quantity: 1 });
      }
      localStorage.setItem("cart", JSON.stringify(cart));
      updateCartCount();
    }

    // Attach event listeners to Add to Cart buttons
    addToCartButtons.forEach(button => {
      button.addEventListener("click", function () {
        const product = {
          id: this.getAttribute("data-id"),
          name: this.getAttribute("data-name"),
          price: parseFloat(this.getAttribute("data-price")),
          image: this.getAttribute("data-image"),
        };
        addToCart(product);
        alert("Item added to cart!");
      });
    });

    // Initialize cart count on page load
    updateCartCount();
  });

//end of cart
	document.getElementById('category-select').addEventListener('change', function () {
    const categoryId = this.value;

    fetch(`/get-products/${categoryId}`)
        .then(response => response.json())
        .then(data => {
            const productSelect = document.getElementById('product-select');
            productSelect.innerHTML = '<option selected disabled>Choose a Product</option>';
            data.products.forEach(product => {
                productSelect.innerHTML += `<option value="${product.id}">${product.name}</option>`;
            });
            productSelect.disabled = false;
        });
});

document.getElementById('product-select').addEventListener('change', function () {
    const productId = this.value;

    fetch(`/get-items/${productId}`)
        .then(response => response.json())
        .then(data => {
            const itemSelect = document.getElementById('item-select');
            itemSelect.innerHTML = '<option selected disabled>Choose an Item</option>';
            data.items.forEach(item => {
                itemSelect.innerHTML += `<option value="${item.id}">${item.name}</option>`;
            });
            itemSelect.disabled = false;
        });
});

//Product functions 
document.addEventListener('DOMContentLoaded', function () {
  // Handle "View More" button click
  document.querySelectorAll('.view-details').forEach(button => {
    button.addEventListener('click', function () {
      const productId = this.getAttribute('data-id');
      const productName = this.getAttribute('data-name');
      const productDescription = this.getAttribute('data-description');
      const productPrice = this.getAttribute('data-price');
      const productImage = this.getAttribute('data-image');
      
      // Populate modal
      document.getElementById('modalName').textContent = productName;
      document.getElementById('modalDescription').textContent = productDescription;
      document.getElementById('modalPrice').textContent = productPrice;
      document.getElementById('modalImage').src = productImage;
      document.getElementById('modalAddToCart').setAttribute('data-id', productId);
    });
  });

  // Handle "Add to Cart" button click
  document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function () {
      const productId = this.getAttribute('data-id');
      // Add to cart logic here (e.g., send an AJAX request)
      alert('Product ' + productId + ' added to cart!');
    });
  });

  // Add to cart from modal
  document.getElementById('modalAddToCart').addEventListener('click', function () {
    const productId = this.getAttribute('data-id');
    // Add to cart logic here (e.g., send an AJAX request)
    alert('Product ' + productId + ' added to cart from modal!');
  });
});

</script>
</body>
</html>