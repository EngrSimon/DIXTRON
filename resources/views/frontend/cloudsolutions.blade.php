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

<div class="hero-section" id="cloud">
    <div class="hero-overlay">
        <div class="hero-content">
            <h1>Cloud Solutions</h1>
            <p>
                We offer a wide range of cloud solutions designed to meet the diverse needs of your business. Our cloud backup services ensure your data is safely stored and easily recoverable. Through our cloud consulting services, we help you harness the full potential of cloud computing, whether you're new to the cloud or looking to upgrade.
            </p>
            <a href="#form-section" class="hero-btn">Contact us today!</a>
        </div>
    </div>
</div> 

<div class="text-card">

At Dextron Computers, we understand that IT procurement is crucial for the smooth operation of your business. Our dedicated procurement experts manage the entire process, ensuring you <br>receive the best hardware and software solutions tailored to your needs. Whether you're upgrading existing systems or setting up new infrastructure, we're here to streamline the procurement journey <br> for you. <strong> Our Services Include:</strong> <br> <br>

<strong>Cloud Backup Services</strong> <br>
Ensure your data is securely stored and easily recoverable with our robust cloud backup solutions. Our services are designed to protect your critical data, providing peace of mind with automated <br>backups and rapid recovery options. <br> <br>

<strong>Cloud Consulting Services</strong>
Maximize the potential of cloud computing with our expert consulting services. Whether you're just starting with cloud technology or planning to upgrade your existing <br>infrastructure, we provide strategic guidance to help you achieve your business goals. <br> <br>

<strong>Cloud Migration Services</strong> <br>
Transition smoothly to the cloud with our comprehensive migration services. Our team manages the entire process, ensuring minimal disruption to your operations while moving your data, <br> applications, and workloads to the cloud seamlessly.  <br> <br>

<strong>Cloud Networking Solutions</strong>
Optimize your network for maximum efficiency with our cloud networking services. We design and implement scalable, secure, and high-performance networking <br>solutions that enhance connectivity and streamline your IT infrastructure. <br> <br>

<strong>Tailored Cloud Storage Solutions</strong> <br>
Choose from a range of cloud storage options tailored to your specific needs. Our flexible solutions are designed to accommodate various workloads, ensuring that your data is stored efficiently <br>and securely. <br> <br>

<strong>Cloud Disaster Recovery Solutions</strong> <br>
Enhance your data security and ensure business continuity with our cloud disaster recovery services. Our solutions are designed to protect your data and keep it accessible even in the event of <br>a disaster, minimizing downtime and data loss. <br> <br>

<strong>Why Choose Us?</strong> <br> <br>

<li>Comprehensive Expertise: Our team has extensive experience in cloud technology, offering you the knowledge and skills needed to implement effective solutions.</li>
<li>Customized Solutions: We tailor our services to meet the specific needs of your business, ensuring optimal performance and value.
    Seamless Integration: Our <br>  solutions are designed for easy integration with your existing systems, ensuring a smooth transition to the cloud.</li>
<li>Security and Compliance: We prioritize the security and compliance of your data, implementing best practices to protect your information and meet industry standards.</li>
<li>Ongoing Support: Our commitment to your success extends beyond implementation. We provide continuous support and management to ensure your cloud solutions <br>remain efficient and effective.</li>

<br> <br>
<strong>Get Started with Our Cloud Solutions</strong> <br>
Ready to transform your business with advanced cloud technology? Contact us today to learn how our cloud solutions can enhance your operations, protect your data, and drive growth. Let Dextron <br> Computers be your trusted partner in cloud technology.
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