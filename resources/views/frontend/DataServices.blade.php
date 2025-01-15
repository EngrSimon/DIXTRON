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

<!------Business & Pulic Sector IT------->

<div class="hero-section" id="Data-service">
    <div class="hero-overlay">
        <div class="hero-content">
            <h1>Data Services (Backup, Recovery & Destruction)</h1>
            <p>
				We provide a comprehensive suite of data services tailored to meet your business needs. Our data recovery services are designed to retrieve lost or corrupted files, ensuring that critical business information is restored promptly and efficiently. In cases where in-house recovery is not possible, we collaborate with specialised labs to maximize data retrieval success.
            </p>
            <a href="#form-section" class="hero-btn">Contact us today!</a>
        </div>
    </div>
</div> 

<div class="text-card">
	At Dextron Computers, we specialize in providing a comprehensive suite of data services tailored to meet the unique needs of your business. Our data services encompass backup, recovery, and destruction, <br> ensuring the security, integrity, and compliance of your critical business information. <strong>Our Data Services Offerings:</strong> <br> <br>

	<strong>Data Recovery Services</strong> <br>
	Our data recovery services are designed to retrieve lost or corrupted files swiftly and efficiently. We utilize advanced techniques to recover data from various storage media and systems. For complex cases, <br>we collaborate with specialized labs to maximize data retrieval success. <br> <br>
	
	<strong>Data Destruction Services</strong> <br>
	Ensure the permanent erasure of sensitive business data with our professional data destruction services. We securely wipe data from old PCs, laptops, or storage devices, adhering to strict compliance standards. <br>Certificates of destruction are provided for audit and peace of mind. <br> <br>
	
	<strong>Data Migration Services</strong> <br>
	Seamlessly transition your data from legacy systems to new platforms with our expert data migration services. We minimize downtime and ensure data integrity throughout the migration process, allowing your <br>business operations to continue without disruption. <br> <br>
	
	<strong>Customized Backup Solutions</strong> <br>
	Protect your business data against loss or corruption with our customized backup solutions. We tailor backup strategies to meet the specific requirements of your business, implementing robust protocols to <br>safeguard your critical information. <br> <br>
	
	<strong>Why Choose Us?</strong> <br> <br>
	
	<li>Expertise and Reliability: Benefit from our extensive experience and proven track record in data services, ensuring reliable solutions that meet your business needs.</li> <br>
	<li>Compliance and Security: We prioritize data security and compliance, implementing best practices to protect sensitive information and adhere to industry regulations.</li> <br>
	<li>Tailored Solutions: Our services are customized to fit the unique requirements of your business, providing flexible and scalable solutions that grow with your organization.</li> <br>
	<li>Minimal Downtime: With efficient data recovery and migration processes, we minimize downtime and ensure seamless continuity of your business operations.</li> <br> <br>

	Get Started with Our Data Services <br> <br>
	Ready to safeguard your business data and ensure compliance with industry standards? Contact us today to explore how our data services can protect your information, enhance operational efficiency, and <br>provide peace of mind. Let Direct Computers be your trusted partner in data management and security.
</div> <br>



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