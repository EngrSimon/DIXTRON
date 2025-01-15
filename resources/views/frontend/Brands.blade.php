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
            <h1>Brands</h1>
            <h3>Welcome to our brands page!</h3>
            <p>Embark on a journey through cutting-edge technology with our exclusive brands. At Direct Computers, we're passionate about bringing you the pinnacle of computing excellence. Dive into a curated selection of the most trusted and innovative computer brands, each handpicked to enhance your digital world.</p>
            <p class="short-text">
                <h4>Why Choose Dextron Computers</h4><span class="dots">...</span>
                <span class="more-text">  for your Computing Needs?
                    Discover the best computing solutionsDiverse Range: Whether you're a gaming enthusiast, a creative professional, or someone seeking reliable computing solutions, our collection caters to all. Discover a diverse range of computer brands, each with a unique offering to meet your specific needs.<br><br>
                    Performance Assurance: We prioritize performance and reliability. Every computer brand featured in our collection undergoes rigorous scrutiny, ensuring you get nothing but top-notch performance and durability.<br><br>
                    Convenience Redefined: With our brands page, we've simplified your search for the perfect computing device. Enjoy the convenience of exploring renowned brands, all in one place, to make an informed decision based on your preferences and requirements.<br><br>
                    Elevate your computing experience with Direct Computers. Discover the power, innovation, and reliability that define our brands. Shop with confidence, knowing you're investing in the best names in the world of technology.
                </span>
            </p>
            <a href="javascript:void(0)" class="read-more" onclick="toggleReadMore()">Read More</a>
        </div>
        <div class="brand-image">
            <img src="assets/Brands _ Direct Computers/7K834EA-ABU_8_1750x1285-min.jpg" alt="Laptop Image">
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

<!---------------next section------------------->

<section class="brands">
    <h2>Brands</h2>
    <div class="brands-grid">
        <div class="brand">
           <a href="asus.html"><img src="assets/Brands _ Direct Computers/ggf.png" alt="ASUS Logo">
            <p>ASUS</p></a>
        </div>
        <div class="brand">
            <a href=""><img src="assets/Brands _ Direct Computers/asd.png" alt="Apple Logo">
            <p>Apple</p></a> 
        </div>
        <div class="brand">
           <a href="amd.html"><img src="assets/Brands _ Direct Computers/aaaad.png" alt="AMD Logo">
            <p>AMD</p></a> 
        </div>
        <div class="brand">
            <a href="Canon.html"><img src="assets/Brands _ Direct Computers/cnnon-logo.png" alt="Canon Logo">
            <p>Canon</p></a> 
        </div>
        <div class="brand">
            <a href="BE QUIET.html"><img src="assets/Brands _ Direct Computers/bquiet.png" alt="Canon Logo">
            <p>be quiet</p></a> 
        </div>
    </div>

    <br> <br>

    <div class="brands-grid">
        <div class="brand">
            <a href="Corsair.html"><img src="assets/Brands _ Direct Computers/corsair-logo.png" alt="ASUS Logo">
            <p>Corsair</p></a> 
        </div>
        <div class="brand">
           <a href="DeepCool.html"> <img src="assets/Brands _ Direct Computers/deepcool_4197bf72-7281-449d-87e5-963e0bfd3fb2.png" alt="Apple Logo">
            <p>DeepCool</p></a> 
        </div>
        <div class="brand">
            <a href="Kingston.html"><img src="assets/Brands _ Direct Computers/kingston-logo.png" alt="AMD Logo">
            <p>Kingston</p></a> 
        </div>
        <div class="brand">
            <a href="HP.html"><img src="assets/Brands _ Direct Computers/hp-logo.png" alt="Canon Logo">
            <p>HP</p></a> 
        </div>
        <div class="brand">
           <a href="HPE.html"> <img src="assets/Brands _ Direct Computers/hpe-240gb-sata-6g-p05319-001-internal-hdd-drives-613.jpeg" alt="Canon Logo">
            <p>HPE</p></a> 
        </div>
    </div>
    <br> <br>

    <div class="brands-grid">
        <div class="brand">
           <a href="Marvo.html"> <img src="assets/Brands _ Direct Computers/marvo.png" alt="ASUS Logo">
            <p>Marvo</p></a> 
        </div>
        <div class="brand">
           <a href="piXL.html"> <img src="assets/Brands _ Direct Computers/pixl.png" alt="Apple Logo">
            <p>piXL</p></a> 
        </div>
        <div class="brand">
           <a href="Samsung.html"> <img src="assets/Brands _ Direct Computers/samsung-logo.png" alt="AMD Logo">
            <p>Samsung</p></a> 
        </div>
        <div class="brand">
           <a href="TP-Link.html"> <img src="assets/Brands _ Direct Computers/tp.png" alt="Canon Logo">
            <p>TP-Link</p></a> 
        </div>
        <div class="brand">
           <a href="Western Digital.html"> <img src="assets/Brands _ Direct Computers/westen-digital.png" alt="Canon Logo">
            <p>Western Digital</p></a> 
        </div>
    </div>
</section>


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