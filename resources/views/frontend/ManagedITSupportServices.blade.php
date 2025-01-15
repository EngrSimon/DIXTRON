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

<div class="hero-section" id="managedIT">
    <div class="hero-overlay">
        <div class="hero-content">
            <h1>Managed IT Support Services</h1>
            <p>
                We provide expert IT support services for public sector and businesses of all sizes, partnering with you and your team to ensure seamless and secure operations. We offer customized support packages designed to meet your specific needs, with flexibility and expertise at the core of our service.
            </p>
            <a href="#form-section" class="hero-btn">Contact us today!</a>
        </div>
    </div>
</div> 

<div class="text-card">

At Dextron Computers, we understand that IT procurement is crucial for the smooth operation of your business. Our dedicated procurement experts manage the entire process, ensuring you <br>receive the best hardware and software solutions tailored to your needs. Whether you're upgrading existing systems or setting up new infrastructure, we're here to streamline the procurement journey <br> for you. <strong> Our Services Include:</strong> <br> <br>

    Customised Support Packages
We offer a range of support packages tailored to your business requirements. Whether you need comprehensive IT management or specific services, we have a solution <br>to fit your needs. <br> <br>

<strong>Remote Monitoring and Proactive Maintenance</strong> <br>
Our team continuously monitors your systems remotely to identify and address potential issues before they become major problems. Proactive maintenance helps optimize performance and prevent <br>downtime. <br> <br>

<strong>Disaster Recovery and Incident Response</strong> <br>
In the event of a disaster or minor issue, our dedicated team is ready to assist you promptly. We provide comprehensive disaster recovery planning and swift incident response to minimize disruptions. <br> <br>

<strong>Cybersecurity Solutions</strong> <br>
Protecting your business from cyber threats is our priority. We implement robust security measures, including firewalls, antivirus software, and regular security audits, to safeguard your data and systems. <br> <br>

<strong>Network Management</strong> <br>
We ensure your network is reliable and efficient, handling everything from setup to ongoing management. Our services include network design, implementation, and support. <br> <br>

<strong>Cloud Services</strong> <br>
Leverage the power of cloud computing with our cloud services. We offer cloud migration, management, and support to help you achieve greater flexibility and scalability. <br> <br>

<strong>IT Consulting</strong>  <br>
Our experts provide strategic IT consulting to help you make informed decisions about your technology investments. We assist with IT planning, budgeting, and project management. <br> <br>

<strong>Help Desk Support</strong>  <br>
Our help desk is available to assist with any IT-related issues your team may encounter. We offer fast and effective support to ensure minimal disruption to your operations. <br> <br>

<strong>Why Choose Us?</strong> <br> <br>

<li>Expertise: Our team consists of highly skilled IT professionals with extensive experience.</li>
<li>Scalability: Our services grow with your business, adapting to your changing needs.</li>
<li>Proactive Approach: We prevent issues before they impact your business with proactive monitoring and maintenance.</li>
<li>Tailored Solutions: Our services are customized to meet the unique needs of your business.</li>
<br>
Ready to take your business to the next level with our Managed IT Support services? Contact us today to discuss how we can help optimize your IT infrastructure and support your growth.

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