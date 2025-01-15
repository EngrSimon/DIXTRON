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

<div class="hero-section" id="Microsoft">
    <div class="hero-overlay">
        <div class="hero-content">
            <h1>Microsoft 365 Services</h1>
            <p>
                We offer a comprehensive range of services to help you fully leverage Microsoft’s suite of technology. As an official Microsoft Solutions Provider, our Microsoft 365 Services enhance your business's productivity, security, and collaboration capabilities. We manage Microsoft 365 implementation to ensure seamless integration into your operations and provide various licensing options to meet your specific needs.
            </p>
            <a href="#form-section" class="hero-btn">Contact us today!</a>
        </div>
    </div>
</div> 

<div class="text-card">

    Empower your business with our comprehensive suite of Microsoft 365 services, designed to maximize productivity, enhance security, and foster collaboration across your organization. As an official <br> Microsoft Solutions Provider, Direct Computers is committed to delivering tailored solutions that align with your business goals and leverage Microsoft’s powerful suite of technologies. <br> <strong>Our Microsoft 365 Services Include:
    </strong> <br> <br>

    <strong>Seamless Implementation</strong> <br>
    We manage the seamless integration of Microsoft 365 into your operations, ensuring a smooth transition and minimal disruption to your workflow. Whether you’re starting fresh or upgrading, <br>our experts handle all aspects of implementation. <br> <br>
    
    <strong>Customized Licensing Options</strong> <br>
    Choose from a variety of licensing options tailored to your specific needs and budget. We help you select the right Microsoft 365 plans and licenses, ensuring cost-effectiveness and maximizing <br> the value of your investment. <br> <br>
    
    <strong>SharePoint Migration and Management</strong> <br>
    Efficiently migrate your folders and files to secure SharePoint environments with customized access controls. Our solutions enhance collaboration and streamline document management across different <br>areas of your business. <br> <br>
    
    <strong>VOIP Transition with Microsoft Teams</strong> <br>
    Transform your communication infrastructure with our VOIP transition services using Microsoft Teams. We integrate your old telephone systems seamlessly, consolidating all communication channels <br>under one unified platform for enhanced efficiency and connectivity. <br> <br>
    
    <strong>Productivity Tools</strong> <br> 
    Harness the full potential of Microsoft 365’s productivity tools, including Microsoft Office applications, Exchange Online for robust email hosting, OneDrive for secure cloud storage, and more. <br>We optimize these tools to boost your team’s productivity and collaboration capabilities. <br> <br>
    
    <strong>Security and Compliance</strong> <br>
    Protect your data with advanced security features within Microsoft 365, including threat protection, data loss prevention, and compliance management. We ensure your business remains secure and <br> compliant with industry standards. <br> <br>
    
    <strong>Why Choose Us?</strong> <br> <br>
    
    <li>Expertise and Certification: Benefit from our extensive expertise as an official Microsoft Solutions Provider, ensuring efficient deployment and management of <br>Microsoft 365 solutions.</li> <br>
    <li>Tailored Solutions: We customize our services to meet the unique needs of your business, delivering solutions that drive productivity and innovation.</li> <br>
    <li>Integration Excellence: Our solutions are designed for seamless integration with your existing systems, optimizing performance and minimizing disruptions.</li> <br>
    <li>Support and Training: Beyond implementation, we provide ongoing support and training to empower your team in leveraging Microsoft 365 effectively for business growth.</li> <br> <br>

    <strong>Get Started with Microsoft 365</strong> <br>
    Ready to enhance productivity, improve collaboration, and bolster security with Microsoft 365? Contact us today to discover how our Microsoft 365 services can transform your business operations. <br>Let Direct Computers be your trusted partner in harnessing the full potential of Microsoft’s technology suite.

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