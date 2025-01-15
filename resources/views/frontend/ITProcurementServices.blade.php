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

<div class="hero-section" id="Procurement">
    <div class="hero-overlay">
        <div class="hero-content">
            <h1>IT Procurement Services</h1>
            <p>
                Our procurement experts handle the entire process, allowing you to focus on your core business activities. We can provide you with a detailed quote based on your project requirements or if you know exactly what you need simply quote based on your list.
            </p>
            <a href="#form-section" class="hero-btn">Contact us today!</a>
        </div>
    </div>
</div> 

<div class="text-card">

At Dextron Computers, we understand that IT procurement is crucial for the smooth operation of your business. Our dedicated procurement experts manage the entire process, ensuring you <br>receive the best hardware and software solutions tailored to your needs. Whether you're upgrading existing systems or setting up new infrastructure, we're here to streamline the procurement journey <br> for you. <strong> Our Services Include:

</strong>
<br> <br>
<strong>Comprehensive Procurement Management</strong> <br>
We handle every aspect of IT procurement, from initial specification to final delivery. Our experts work closely with you to understand your requirements and provide customized solutions that fit your budget <br>and operational needs.
<br> <br>

<strong>Detailed Quoting Process</strong> <br>
Get a detailed quote based on your project requirements. Whether you need specific hardware, software licenses, or complete IT solutions, our transparent quoting process ensures clarity and accuracy. <br> <br>

<strong>IT Equipment Leasing Options</strong> <br>
To provide flexible and cost-effective solutions, we offer IT equipment leasing. This option allows you to acquire the latest technology without significant upfront costs, helping you manage your budget <br>effectively. <a style="text-decoration: underline; color: red;" href="">Learn more</a> <br> <br>

<strong>Cost Management and Optimisation</strong> <br>
We focus on managing costs throughout the procurement process, ensuring that you get the best value for your investment. Our goal is to optimize your IT spending while maintaining quality and reliability. <br> <br>

<strong>Maintenance and Support Considerations</strong> <br> 
Beyond procurement, we assist in planning for ongoing maintenance and support. We ensure that your IT infrastructure is sustainable and supported throughout its lifecycle. <br> <br>

<strong>Transparent Communication and Reporting</strong> <br>
Stay fully informed at every stage of the procurement process. We provide clear communication and regular updates, so you can make informed decisions confidently. <br> <br>

<strong>Why Choose Us?</strong> <br> <br>

<li>Expertise: Our team has extensive experience in IT procurement across various industries.</li>
<li>Efficiency: We streamline the procurement process to save you time and resources.</li>
<li>Cost-Effectiveness: Our solutions are designed to maximize value while minimizing costs.</li>
<li>Customer Satisfaction: We prioritize your satisfaction and strive for excellence in every project.</li>


<br>

<strong>Get Started with Your IT Procurement</strong> <br>
Ready to enhance your IT infrastructure with reliable procurement solutions? Contact us today to discuss your requirements and let us assist you in acquiring the technology you need to support your <br> business growth.
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