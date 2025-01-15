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

    <div class="hero-section" id="Recovery">
        <div class="hero-overlay">
            <div class="hero-content">
                <h1>Data Recovery</h1>
                <p>
                    One of the most traumatic experiences of using a computer is data loss. It might be irreplaceable family photos or your life's work, either way, the feeling is gut-wrenching. However, in many cases, we can help you recover some or all that precious data. We have a number of methods for data recovery so get it touch!
                </p>
                <a href="#form-section" class="hero-btn">Contact us today!</a>
            </div>
        </div>
    </div>

	<div class="text-card">
		First things first, Data Recovery is a minefield and unfortunately, there isn’t a one size fits all solution. The process can be either simple or complex. Unfortunately, there are also a lot of operators <br>within the field, who will charge you several hundred pounds for a relatively simple job. On the other hand some jobs are very complex and do require sending off to the lab. <br> <br>

If you’ve ended up here, it’s probably because you can’t access your data, and you’re wondering how you can get it back, how long it might take and how much it might cost.The truth is, we might <br> be able to recover all your data within a couple of days, or even within a few hours. There’s also a chance that we might be able to recover only some of your data or none of it. It really depends <br> on the reason why you can’t access your data and the hardware you're using.<br> <br>

Our prices for data recovery are set with our standard hourly rate of £48. To note we do not charge for time spent waiting for data to be transfered as this could take a very long time and this <br>processes is left running.<br> <br>

In some cases, advanced recovery is required and unfortunately, this is where the process gets both expensive and time-consuming. This is done on a quote by quote basis and the storage <br>device will need to be sent off to the lab.<br> <br>

The reason advanced data recovery is so expensive is that it must be performed within a laboratory environment, and includes extended engineering, advanced board work, micro-soldering, and <br>chip-level recovery. It often also requires donor components.<br> <br>

Many of our customers prefer to just explore the basic data recovery method, and we’re happy to accommodate this and can do so on a no recovery, no-fee basis. We understand that most <br>people are happy to pay the basic fee, but when it becomes more expensive, they would rather explore other options.<br> <br>

In addition to the cost of data recovery, you’ll also need an external hard drive for your data, which you can either provide yourself, or we can supply for you. If you provide your own, it must be <br>blank, of sufficient capacity and preferably new.

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