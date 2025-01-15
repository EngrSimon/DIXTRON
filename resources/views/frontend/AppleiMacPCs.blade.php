@include('layout.header')
<body>
<!----Navbar starts----->
@include('layout.navbar')




<!----------------------------->

<br>

<div class="next-text">
<h1 style="font-size: 40px;"> <strong>Apple iMac PCs</strong></h1>
<p style="font-size: 15px;">Apple desktops are beautifully designed, offering sleek lines and an iconic minimal aesthetic. The simplicity of the design of <br>Apple iMacs is not matched by their components. The power and performance that the newest iMacs provide are <br>unparalleled.</p>
</div> <hr>

<br>

<!--------->
         <div class="center_product_1r3 tab-content">
          
                        <div class="click clearfix">
                          <div class="arriv_2 mgt clearfix">
                           <div class="col-sm-4">
                            <div class="arriv_2m clearfix">
                             <div class="arriv_2m1 clearfix">
                               <a href="product_detail.html"><img src="assets/Apple iMac PCs _ Direct Computers/1 (1).jpg" alt="abc" class="iw"></a>						  </div>
                             <div class="arriv_2m2 clearfix">
                              <h5 class="text-center mgt">SALE</h5>
                             </div>
                             <div class="arriv_2m3 clearfix">
                              <h4 class="bold mgt font_24 text-center"><a class="col_1" href="product_detail.html">Apple Computers</a></h4>
                              <p>APPLE iMac 4.5K 24" (2023) - M3, 256 GB SSD, Green</p>
                              <span class="span_1">
                               <i class="fa fa-star"></i>
                               <i class="fa fa-star"></i>
                               <i class="fa fa-star"></i>
                               <i class="fa fa-star"></i>
                               <i class="fa fa-star"></i>						   </span>
                              <h5>
                              <span style="color: #d01f1f;" class="span_2">£1,824.99</span>
                              <span class="span_3 col_2"> £1,724</span> 
                              <span class="span_4 pull-right col_2">Limited Offer!</span>						   </h5>
                             </div>
                            </div>
                           </div>

                           <div class="col-sm-4">
                            <div class="arriv_2m clearfix">
                             <div class="arriv_2m1 clearfix">
                               <a href="product_detail.html"><img src="assets/Apple iMac PCs _ Direct Computers/1 (2).jpg" alt="abc" class="iw"></a>						  </div>
                             <div class="arriv_2m2 clearfix">
                              <h5 class="text-center mgt">SALE</h5>
                             </div>

                             <div class="arriv_2m3 clearfix">
                               <h4 class="bold mgt font_24 text-center"><a class="col_1" href="product_detail.html">Apple Computers</a></h4>
                              <p>APPLE iMac 5K 27" (2020) - Intel® Core™ i5, 512 GB SSD</p>
                              <span class="span_1">
                               <i class="fa fa-star"></i>
                               <i class="fa fa-star"></i>
                               <i class="fa fa-star"></i>
                               <i class="fa fa-star"></i>
                               <i class="fa fa-star"></i>						   </span>
                              <h5>
                              <span style="color: #d01f1f;" class="span_2">£1,099.99</span>
                              <span class="span_3 col_2"> £999.99</span> 
                              <span class="span_4 pull-right col_2">Limited Offer!</span>						   </h5>
                             </div>
                            </div>
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