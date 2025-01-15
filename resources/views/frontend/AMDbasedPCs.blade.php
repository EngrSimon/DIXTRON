@include('layout.header')
<body>
<!----Navbar starts----->
@include('layout.navbar')


<br>
	
    <div class="next-text">
        <h1 style="font-size: 40px;"> <strong>AMD Gaming PCs</strong></h1>
        <p style="font-size: 15px;">Step up your Gaming with our AMD Gaming PC collection. Expertly crafted, our Custom Built AMD Gaming PCs showcase <br> top-of-the-line components from Nvidia, Radeon and AMD, including the formidable AMD Ryzen 3, 5, 7 and 9 processors. <br> Built on AMD motherboards including A320M, A520M, A620M, B450M, B450, B550M, B550, B650M, B650, X570, X670 find a <br> combination of DDR4 and DDR5 motherboards. All used from the top manufacturers like ASUS ROG Strix and MSI Gaming, <br>housed in sleek cases from Corsair and NZXT, and cooled with premium solutions from Cooler Master and Noctua, our rigs <br> are a testament to quality. Whether you're a streamer, content creator, or professional gamer, explore a variety of options. <br> Personalize your gaming setup effortlessly using our user-friendly configurator, supported by flexible finance choices, a solid <br> 3-year warranty, and free UK delivery. Each PC comes with a FREE copy of Windows 10 or 11 Pro. </p>
        </div> 

        <br>
<div class="box-cat">
        <div class="box-container">
      <a href="{{route('AMDRyzen5PCs')}}"><div class="box">AMD Ryzen 5 <br> PCs</a></div>
      <a href="{{route('AMDRyzen7PCs')}}"><div class="box">AMD Ryzen 7<br> PCs</div></a> 
      <a href="{{route('AMDRyzen9PCs')}}"><div class="box">AMD Ryzen 9<br> PCs</div></a>
      <a href="{{route('AMDRyzen7000SeriesCustomPCs')}}"><div class="box">AMD Ryzen 7000 <br>Series Custom PCs</div></a>
<!---      <a href=""><div class="box">Trading<br> PCs</div></a>
      <a href=""><div class="box">Architecture <br> PCs</div></a>
      <a href=""><div class="box">Game Development <br>PCs</div></a> ------>
      </div> <br>
    </div><hr>





<!--------------------->

<section id="arrival" class="py-5 bg-light" style="padding: 40px 0; background-color: #f8f9fa;">
  <div class="container" style="max-width: 1200px; margin: 0 auto;">
    <h3 class="text-center mb-5" style="font-family: Arial, Helvetica, sans-serif; text-align: center; margin-bottom: 3rem;"></h3>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
  
      <div class="col">
        <div class="card h-100">
          <img src="assets/Custom Built AMD Gaming PCs _ AMD Ryzen 3_ 5_ 7 and 9 Gaming PCs _ Direct Computers/1 (1).jpg" class="card-img-top" alt="#">
          <div class="card-body text-center" style="background-color:rgb(253 239 228)">
			<!--
            <h5 class="card-title text-uppercase" style="color: #eb0905;">{{ $product->sale_label ?? 'SALE' }}</h5>
			-->
            <h4 class="bold" style="margin-bottom: 10px;">
              <a href="#" class="text-decoration-none" style="color: #eb0905;">Dixtron Computers</a>
            </h4>
            <p style="font-size: 14px;">Ryzen 9 7900X3D, 32GB DDR5, RTX 4080 Super 16GB, 2TB SSD, 32" QHD 165Hz Monitor Gaming PC </p>
            <div class="mb-2">
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
            </div>
            <p style="margin-bottom: 8px;">
              <span class="price-old" style="text-decoration: line-through; color: #6c757d;">£510.99</span>
              <span class="price-new" style="color: #28a745; font-weight: bold;">£499.99</span>
            </p>
            <button class="btn btn-primary btn-sm view-details" 
                    data-bs-toggle="modal" 
                    data-bs-target="#productModal" 
                    data-id="#" 
                    data-name="#" 
                    data-description="#" 
                    data-price="#" 
                    data-image="assets/Custom Built Desktop Gaming PCs _ Intel_ AMD _ Nvidia Custom Built PCs _ Direct Computers/1 (6).jpeg">
              View More
            </button>
			<button class="btn btn-primary add-to-cart" 
				style="color: #fff; background-color:#eb0905; border-color:white"
				data-id="#" 
				data-name="#" 
				data-price="#" 
				data-image="assets/Custom Built Desktop Gaming PCs _ Intel_ AMD _ Nvidia Custom Built PCs _ Direct Computers/1 (6).jpeg">
				Add to Cart
			</button>
          </div>
        </div>
      </div>
      
      <div class="col">
        <div class="card h-100">
          <img src="assets/Custom Built AMD Gaming PCs _ AMD Ryzen 3_ 5_ 7 and 9 Gaming PCs _ Direct Computers/1 (2).jpg" class="card-img-top" alt="#">
          <div class="card-body text-center" style="background-color:rgb(253 239 228)">
			<!--
            <h5 class="card-title text-uppercase" style="color: #eb0905;">{{ $product->sale_label ?? 'SALE' }}</h5>
			-->
            <h4 class="bold" style="margin-bottom: 10px;">
              <a href="#" class="text-decoration-none" style="color: #eb0905;">Dixtron Computers</a>
            </h4>
            <p style="font-size: 14px;">Matrix - Ryzen 9 7900X3D, 32GB DDR5, RTX 4080 Super 16GB, 2TB SSD, AMD Gaming PC</p>
            <div class="mb-2">
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
            </div>
            <p style="margin-bottom: 8px;">
              <span class="price-old" style="text-decoration: line-through; color: #6c757d;">£510.99</span>
              <span class="price-new" style="color: #28a745; font-weight: bold;">£499.99</span>
            </p>
            <button class="btn btn-primary btn-sm view-details" 
                    data-bs-toggle="modal" 
                    data-bs-target="#productModal" 
                    data-id="#" 
                    data-name="#" 
                    data-description="#" 
                    data-price="#" 
                    data-image="assets/Custom Built Desktop Gaming PCs _ Intel_ AMD _ Nvidia Custom Built PCs _ Direct Computers/1 (6).jpeg">
              View More
            </button>
			<button class="btn btn-primary add-to-cart" 
				style="color: #fff; background-color:#eb0905; border-color:white"
				data-id="#" 
				data-name="#" 
				data-price="#" 
				data-image="assets/Custom Built Desktop Gaming PCs _ Intel_ AMD _ Nvidia Custom Built PCs _ Direct Computers/1 (6).jpeg">
				Add to Cart
			</button>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card h-100">
          <img src="assets/Custom Built AMD Gaming PCs _ AMD Ryzen 3_ 5_ 7 and 9 Gaming PCs _ Direct Computers/1 (4).jpg" class="card-img-top" alt="#">
          <div class="card-body text-center" style="background-color:rgb(253 239 228)">
			<!--
            <h5 class="card-title text-uppercase" style="color: #eb0905;">{{ $product->sale_label ?? 'SALE' }}</h5>
			-->
            <h4 class="bold" style="margin-bottom: 10px;">
              <a href="#" class="text-decoration-none" style="color: #eb0905;">Dixtron Computers</a>
            </h4>
            <p style="font-size: 14px;">Raptor - Ryzen 7 7800X3D, 16GB DDR5, RTX 4070 Ti Super 16GB, 1TB SSD, AMD Gaming PC</p>
            <div class="mb-2">
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
            </div>
            <p style="margin-bottom: 8px;">
              <span class="price-old" style="text-decoration: line-through; color: #6c757d;">£510.99</span>
              <span class="price-new" style="color: #28a745; font-weight: bold;">£499.99</span>
            </p>
            <button class="btn btn-primary btn-sm view-details" 
                    data-bs-toggle="modal" 
                    data-bs-target="#productModal" 
                    data-id="#" 
                    data-name="#" 
                    data-description="#" 
                    data-price="#" 
                    data-image="assets/Custom Built Desktop Gaming PCs _ Intel_ AMD _ Nvidia Custom Built PCs _ Direct Computers/1 (6).jpeg">
              View More
            </button>
			<button class="btn btn-primary add-to-cart" 
				style="color: #fff; background-color:#eb0905; border-color:white"
				data-id="#" 
				data-name="#" 
				data-price="#" 
				data-image="assets/Custom Built Desktop Gaming PCs _ Intel_ AMD _ Nvidia Custom Built PCs _ Direct Computers/1 (6).jpeg">
				Add to Cart
			</button>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card h-100">
          <img src="assets/Custom Built Desktop Gaming PCs _ Intel_ AMD _ Nvidia Custom Built PCs _ Direct Computers/1 (4).jpeg" class="card-img-top" alt="#">
          <div class="card-body text-center" style="background-color:rgb(253 239 228)">
			<!--
            <h5 class="card-title text-uppercase" style="color: #eb0905;">{{ $product->sale_label ?? 'SALE' }}</h5>
			-->
            <h4 class="bold" style="margin-bottom: 10px;">
              <a href="#" class="text-decoration-none" style="color: #eb0905;">Dixtron Computers</a>
            </h4>
            <p style="font-size: 14px;">Ryzen 5 5600G, 16GB DDR4, Vega 7 Graphics, 500GB SSD, AMD Gaming PC</p>
            <div class="mb-2">
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
            </div>
            <p style="margin-bottom: 8px;">
              <span class="price-old" style="text-decoration: line-through; color: #6c757d;">£510.99</span>
              <span class="price-new" style="color: #28a745; font-weight: bold;">£499.99</span>
            </p>
            <button class="btn btn-primary btn-sm view-details" 
                    data-bs-toggle="modal" 
                    data-bs-target="#productModal" 
                    data-id="#" 
                    data-name="#" 
                    data-description="#" 
                    data-price="#" 
                    data-image="assets/Custom Built Desktop Gaming PCs _ Intel_ AMD _ Nvidia Custom Built PCs _ Direct Computers/1 (6).jpeg">
              View More
            </button>
			<button class="btn btn-primary add-to-cart" 
				style="color: #fff; background-color:#eb0905; border-color:white"
				data-id="#" 
				data-name="#" 
				data-price="#" 
				data-image="assets/Custom Built Desktop Gaming PCs _ Intel_ AMD _ Nvidia Custom Built PCs _ Direct Computers/1 (6).jpeg">
				Add to Cart
			</button>
          </div>
        </div>
      </div>
    
    </div>
  </div>
</section>


       
 
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