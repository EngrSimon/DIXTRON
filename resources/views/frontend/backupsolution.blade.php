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

    <div class="hero-section" id="Backup">
        <div class="hero-overlay">
            <div class="hero-content">
                <h1>Backup Solutions</h1>
                <p>
                    Storage devices are much more reliable than they used to be, but they're notinfallibleand your data won't survive theft or fire and a possible windows corruption! That's why it's really important to keep backups of your data. We can help with a number of backup solutions.
                </p>
                <a href="#form-section" class="hero-btn">Contact us today!</a>
            </div>
        </div>
    </div>

	<div class="text-card">
		Failing to backup is similar to driving without a seat belt, sooner or later you could pay the price. That price could then be irreversible damage. How would you feel if you lost your documents and <br>consequently months of work? How about your digital photo collection and a lifetime of memories? Or perhaps the music you’ve spent years collecting? <br> <br>

For most of us, the scenarios above don’t bear thinking about, so it’s really important to have a backup solution in place.<br> <br>

We can help with a number of backup solutions for physical and cloud such as setting up a local backup on your PC or Laptop to an internal/external hard drive, setting up a local NAS <br>(Network Attached Storage) to backup your data across your network and finally we can setup a cloud backup which means that not only will your data be safe, it will be accessible wherever <br>you go.They may also be automatic or manual. Choosing the best option for your situation depends on a number of factors, from how much you want to spend, to how much data you need to <br>backup, to how quickly you need to get back up and running if ever faced with disaster.<br> <br>

Local Backup Solutions <br> <br>


<li>External Hard Drives: Brands like Seagate, Western Digital, and Toshiba offer various capacities.</li><br>
<li>Network Attached Storage (NAS): Synology, QNAP, and Western Digital provide NAS solutions for home use.</li><br>
<li>USB Flash Drives: Portable and easy to use, suitable for smaller backups.</li><br>
<li>Time Machine (macOS): Built-in backup feature for macOS users, requires an external drive.</li><br>
<li>File History (Windows): Built-in feature in Windows, requires an external drive or network location.</li>


<br> 
Cloud Backup Solutions <br> <br>

<li>Google Drive: Offers 15GB of free storage, integrates with Google services.</li><br>
<li>Dropbox: Simple interface, 2GB of free storage, various paid plans.</li><br>
<li>Microsoft OneDrive: 5GB of free storage, integrates with Microsoft Office.</li><br>
<li>iCloud: Apple users get 5GB free, works seamlessly with Apple devices.</li><br>
<li>Backblaze: Unlimited backup for a flat fee, known for ease of use.</li><br>
<li>Carbonite: Automatic backup, unlimited storage options for a fee.</li><br>
<li>IDrive: Offers 5GB free, combines cloud and local backup, supports multiple devices.</li><br> <br>

Free solutions do have their limitations, but they do have their place and we certainly recommend they form part of the overall backup plan for everyone. If you like the way they work, you can <br> pay for extra storage and we can help set this up for you. <br> <br>

We can help you choose the best backup solution to meet your needs and we can also help with setup if required. Just get in touch for help and we'll point you in the right direction!<br> <br>

Pricing is dependant on if any hardware is needed for the backup solutions and then with our <strong>standard hourly rate of £48 to setup the backup.</strong>

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