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

    <!------Local IT Support Services------->

    <div class="hero-section" id="setup">
        <div class="hero-overlay">
            <div class="hero-content">
                <h1>Computer Setup & Data Transfer</h1>
                <p>
                    If you've just bought a new PC or Laptop and you aren't tech savvy, the thought of setting it up and moving your data from one device to the other may very well fill you with fear. Especially when you have lots of important data that you don't want to lose. That's where we can help!
                </p>
                <a href="#form-section" class="hero-btn">Contact us today!</a>
            </div>
        </div>
    </div>

	<div class="text-card">

        There’s no doubt about it, for some people, setting up a new computer is a fairly easy task and they’ll take it in their stride. Espeically for the younger generation who are used to switching out devices <br>and models every year. For others, it can be much more of a challenge, and perhaps even a little intimidating. The chances are, if you’ve arrived here, you’d like a little help with it. It might be that <br>you’ve just bought your first computer, or perhaps you’ve replaced an old one and want to move all your files & photos across. Either way we can help. <br> <br>

If you’re here because you’re thinking about buying a new computer and wondering about how to get up and running, feel free to contact us for some free buying advice before you make the purchase. <br>We not also help setting up PCs but also supply them as well so feel free to view what we've got on offer below.
<br> <br>
<strong>Destop PCs - <span style="text-decoration: underline; color: red;">Click Here</span></strong> <br> <br>
<strong>Laptops - <span style="text-decoration: underline; color: red;">Click Here</span></strong> <br> <br>

We are able to help with pretty much everything regarding setting up your new PC and moving data across.
<br> <br>
The below applies to a majority of operating systems mainly including Windows and Apple MacOS but not limited to Linux.
<br> <br>
<ol>
<li>Unpack device (where required)</li> <br>
<li>Connect and set up peripheral devices such as keyboards, monitors, mice and printers (where required)</li><br>
<li>Install Printer & Scanner Software</li><br>
<li>Connect to Wi-Fi</li><br>
<li>Setup Microsoft Windows or macOS</li><br>
<li>Install chosen Applications (Subject to applicable licenses, keys & software availability)</li><br>
<li>Setup chosen Anti-Virus Solution</li><br>
<li>Setup chosen backup solution</li><br>
<li>Setup E-Mail (if required)</li><br>
<li>Transfer of your Internet Bookmarks</li><br>
<li>Transfer of all the files and photos from your old computer</li><br>
</ol>

<br> <br>
If you think you need something a little different then please get in touch, we’ll be happy to put a bespoke package together for you. <br> <br>

Our pricing is dependant on the amount of setup required and data to be transfered. <strong> We charge on our standard hourly rate of £48.</strong>
	</div> <hr>
  
	
<!----form---->

<div id="form-section" class="contact-form-container">
    <h2>Contact us today to find out how we can help</h2>
    <p>We aim to respond to all requests within 24 working hours.</p>
    <form>
        <label for="name">Your Name *</label>
        <input type="text" id="name" name="name" placeholder="Your Name" required>

        <label for="email">Email *</label>
        <input type="email" id="email" name="email" placeholder="Email" required>

        <label for="phone">Phone</label>
        <input type="tel" id="phone" name="phone" placeholder="Phone">

        <label for="service">What IT Service do you require? *</label>
        <select id="service" name="service" required>
            <option value="" disabled selected>Please select</option>
            <option value="option1">Computer Repairs & Troubleshooting</option>
            <option value="option2">Computer Upgrades and Optimisation</option>
            <option value="option3">Computer Setup & Data Transfer</option>
            <option value="option1">Virus & Malware Removal</option>
            <option value="option2">Backup Solutions</option>
            <option value="option3">Data Recovery</option>
            <option value="option3">Data Destruction</option>
        </select>

        <label for="comments">Additional comments</label>
        <textarea id="comments" name="comments" rows="2"></textarea>

        <button type="submit">Submit</button>
    </form>
</div>



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