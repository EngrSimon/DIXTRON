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

<div class="hero-section" id="Cyber">
    <div class="hero-overlay">
        <div class="hero-content">
            <h1>Cyber Security Service</h1>
            <p>
                We offer a suite of cyber security services designed to protect your business from evolving threats. Our vulnerability assessment service identifies potential weaknesses in your IT infrastructure, then proceeding to create a tailored plan for safeguarding your business against external threats.
            </p>
            <a href="#form-section" class="hero-btn">Contact us today!</a>
        </div>
    </div>
</div> 

<div class="text-card">
    Safeguard your business from evolving cyber threats with our comprehensive suite of cyber security services. At Dextron Computers, we prioritize protecting your valuable data and sensitive information <br>through proactive threat detection and prevention. <strong>Our Cyber Security Services Include:</strong> <br> <br>

<strong>Vulnerability Assessment</strong> <br>
Identify potential weaknesses in your IT infrastructure with our thorough vulnerability assessment service. We analyze your systems and networks to pinpoint vulnerabilities, followed by creating a tailored <br>plan to strengthen your defenses against external threats. <br> <br>

<strong>24/7 Monitoring and Threat Prevention</strong> <br>
Ensure continuous protection with our 24/7 monitoring and threat prevention services. Our team monitors your systems around the clock, promptly responding to any suspicious activity or security incidents <br>to mitigate risks before they escalate. <br> <br>

<strong>Local System Protection</strong> <br>
Enhance your defense mechanisms with local system anti-virus, browser, and mail protection powered by industry-leading technology. We implement robust security measures to safeguard your endpoints, <br>preventing malware, phishing attacks, and other cyber threats. <br> <br>

<strong>Customized Security Solutions</strong> <br>
We offer customized security solutions to fit your business needs, ensuring comprehensive protection against cyber threats. From small businesses to large enterprises, our solutions are scalable and <br>adaptable to your specific security requirements.  <br> <br>

<strong>Why Choose Us?</strong> <br> <br>

<li>Expertise and Proactive Approach: Benefit from our expertise in cyber security and proactive approach to threat detection and prevention.</li> <br>
<li>Continuous Monitoring: Our 24/7 monitoring ensures real-time threat detection and rapid response to mitigate risks.</li> <br>
<li>Industry-Leading Technology: We utilize advanced tools and technologies to provide robust protection against cyber threats.</li> <br>
<li>Tailored Solutions: Our solutions are tailored to your business size and industry, providing effective security measures that align with your operational needs.</li> <br> <br>

<strong>Get Started with Our Cyber Security Services</strong> <br>
Protect your business with proactive cyber security measures. Contact us today to learn more about how our cyber security services can safeguard your data, mitigate risks, and ensure business continuity. <br>Let Dextron Computers be your trusted partner in defending against cyber threats.

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