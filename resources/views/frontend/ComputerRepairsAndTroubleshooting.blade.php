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

    <div class="hero-section" id="repairs">
        <div class="hero-overlay">
            <div class="hero-content">
                <h1>Computer Repairs & Troubleshooting</h1>
                <p>
                    Are you having problems with your PC or laptop? If that's the case, we can help troubleshoot a wide range of issues from corrupt operating systems, faulty hardware, broken screens, malware and more. We can arrange a home visit to diagnose your issue or you can pop by to our offices for a FREE no obligation quote!
                </p>
                <a href="#form-section" class="hero-btn">Contact us today!</a>
            </div>
        </div>
    </div>

	<div class="text-card">
		<p>
			Whilst owning a computer, whether it be a desktop, laptop or all-in-one when brand new out of the box works perfectly, overtime it can start to be problematic, in some cases even from <br>opening it out of a brand new box. The majority of our work is computer or laptop repairs. We also resolve other computer-related problems for our customers. We work on a no-fix, no-fee <br> basis. We provide our services to Dronfield, Sheffield, Derbyshire and South Yorkshire, but not limited to depending on the job. We are also happy for you to ship us your faulty item that <br>needs repairing/troubleshooting and we will also assist remotely where we can. We provide a same-day repair service where possible.
		</p>
		<h5>We can provide assistence with the following issues but not limited to:</h5>
		<br>
		<ol>
			<li>Computer Running Slow</li>
			<li>Error Messages</li>
			<li>Unwanted Pop-Ups</li>
			<li>System Crashes</li>
			<li>Start-Up Problems</li>
			<li>Viruses & Malware</li>
			<li>E-Mail problems</li>
			<li>Data Loss</li>
			<li>Wi-Fi/Broadband/Internet Problems</li>
			<li>Printer Problems</li>
			<li>Laptop Fan Replacement</li>
			<li>Data Loss</li>
			<li>Wi-Fi/Broadband/Internet Problems</li>
			<li>Printer Problems</li>
			<li>Laptop Fan Replacement</li>
			<li>PC Cleaning & Dust Removal</li>
		</ol>

		<p>
			If your problem isn’t listed above, please do still get in touch, we can probably still help, or point you in the right direction. <br> <br>

If you require remote assistance, the cost is <strong>£24</strong> for up to 1 hour. <br> <br>

If a site visit is necessary, there is a minimum charge of <strong>£48.00</strong> for Computer Repair and IT Troubleshooting; this includes up to 1 hour of labour within normal hours. Out of hours support <br> being out of 9AM-5PM Mon-Friday is <strong>£72</strong> for 1 hour of labour. If you’re based in our local area in and around Dronfield mileage charges do not apply, but they may apply if you’re further <br> afield. We will advise on this prior to our visit. <br> <br>

If you drop off your device with us, we will try to identify the issue there and then and provide you with a <strong>FREE no obligation quote,</strong> this may include the cost of replacement parts and our <br> labour charge being <strong>£48</strong> for up to 1 hour. If your issue doesn't require parts we will try to fix your issue the very same day. <br> <br>

Alternatively you can ship your device to us or we can arrange a collection subject to fees depending on the <strong>location, weight and value of your item.</strong> Once fixed we can return this to you.
		</p>
	</div>
  
	
<!----form---->
<hr>
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