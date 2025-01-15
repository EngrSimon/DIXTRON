@include('layout.header')
<body>
<!----Navbar starts----->
@include('layout.navbar')


<!----Carousel ----->
<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
  <!-- Indicators/Dots -->
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="3" aria-label="Slide 4"></button>
    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="4" aria-label="Slide 5"></button>
  </div>

  
  <!-- Slides -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/slide1.jpg" class="d-block w-100" alt="Slide 1" style="height:240px !important; object-fit:cover;">
    </div>
    <div class="carousel-item">
      <img src="assets/slide2.jpg" class="d-block w-100" alt="Slide 2" style="height:240px !important; object-fit:cover;">
    </div>
    <div class="carousel-item">
      <img src="assets/slide3.jpg" class="d-block w-100" alt="Slide 3" style="height:240px !important; object-fit:cover;">
    </div>
    <div class="carousel-item">
      <img src="assets/slide4.jpg" class="d-block w-100" alt="Slide 4" style="height:240px !important; object-fit:cover;">
    </div>
    <div class="carousel-item">
      <img src="assets/slide5.jpg" class="d-block w-100" alt="Slide 5" style="height:240px !important; object-fit:cover;">
    </div>
  </div>

  <!-- Controls -->
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


   <!-- Search Bar -->
 <!-- Search Bar -->
<form class="d-flex d-lg-none mx-auto mt-4" role="search" style="
  width: 100%; 
  background-color: #f8f9fa; 
  border: 1px solid #ddd; 
  border-radius: 5px; 
  padding: 10px; 
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
  <input 
    class="form-control me-2" 
    type="search" 
    placeholder="Search here..." 
    aria-label="Search" 
    style="
      border: none; 
      border-radius: 3px; 
      padding: 10px; 
      font-size: 16px;">
  <button 
    class="btn" 
    type="submit" 
    style="
      padding: 10px 20px; 
      font-size: 16px; 
      border: none; 
      border-radius: 3px; 
      font-weight: bold; background-color:#eb0905; color:#fff">
    Search
  </button>
</form>


<!----category----->
  <!-- Category Section -->
 <!-- Category Section -->
<div class="container my-5">
    <h1 class="text-center cat-text mb-4">Our Best Selling Categories...</h1>
    <div class="row">
        @foreach ($categories as $category)
            <div class="col-6 col-lg-2 mb-4">
                <div class="card">
                    <a href="{{route('custompcs')}}"><img src="{{ asset('assets/cat/' . $category->image) }}" class="card-img-top" alt="{{ $category->name }}"></a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->name }}</h5>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>



 <!----category----->


<!-- Container for form and finance options -->

<section class=" py-5" style="background-color: #000;">
  <div class="container">
    <div class="row align-items-center">
      <!-- Left Side: Finance Options -->
      <div class="col-md-6 text-white mb-4 mb-md-0">
        <h4 class="finance-subtitle text-uppercase">Clearpay, Klarna & PayPal Credit</h4>
        <h1 class="finance-title display-4">Flexible Finance Options</h1>
        <p class="finance-description">Spread the cost of payments with our finance options. Pay in 3, pay in 4, pay in 30 days and pay monthly options.</p>
        <button class="btn btn-danger btn-lg">Learn More</button>
      </div>

      <!-- Right Side: Quick Shop Form -->
      <div class="col-md-6">
    <div class="p-4 bg-white rounded shadow" style="max-width:500px; margin:auto;">
        <h3 class="quick-shop-title mb-4 text-center">Quick Shop</h3>
        <form id="quick-shop-form">
            <div class="mb-3">
                <select id="category-select" class="form-select">
                    <option selected disabled>Choose a Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <select id="product-select" class="form-select" disabled>
                    <option selected disabled>Choose a Product</option>
                </select>
            </div>
            <div class="mb-3">
                <select id="item-select" class="form-select" disabled>
                    <option selected disabled>Choose an Item</option>
                </select>
            </div>
            <button type="submit" class="btn btn-danger w-100">Search</button>
        </form>
    </div>
</div>

    </div>
  </div>
</section>

<!-- Recently Added Section -->
<section id="arrival" class="py-5 bg-light" style="padding: 40px 0; background-color: #f8f9fa;">
  <div class="container" style="max-width: 1200px; margin: 0 auto;">
    <h3 class="text-center mb-5" style="font-family: Arial, Helvetica, sans-serif; text-align: center; margin-bottom: 3rem;">Recently Added</h3>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
      @foreach($recentproducts as $product)
      <div class="col">
        <div class="card h-100">
          <img src="{{ asset('assets/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
          <div class="card-body text-center" style="background-color:rgb(253 239 228)">
			<!--
            <h5 class="card-title text-uppercase" style="color: #eb0905;">{{ $product->sale_label ?? 'SALE' }}</h5>
			-->
            <h4 class="bold" style="margin-bottom: 10px;">
              <a href="#" class="text-decoration-none" style="color: #eb0905;">{{ $product->name }}</a>
            </h4>
            <p style="font-size: 14px;">{{ $product->description }}</p>
            <div class="mb-2">
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
            </div>
            <p style="margin-bottom: 8px;">
              <span class="price-old" style="text-decoration: line-through; color: #6c757d;">£1,449.99</span>
              <span class="price-new" style="color: #28a745; font-weight: bold;">£{{ number_format($product->price, 2) }}</span>
            </p>
            <button class="btn btn-primary btn-sm view-details" 
                    data-bs-toggle="modal" 
                    data-bs-target="#productModal" 
                    data-id="{{ $product->id }}" 
                    data-name="{{ $product->name }}" 
                    data-description="{{ $product->description }}" 
                    data-price="{{ $product->price }}" 
                    data-image="{{ asset('assets/' . $product->image) }}">
              View More
            </button>
			<button class="btn btn-primary add-to-cart" 
				style="color: #fff; background-color:#eb0905; border-color:white"
				data-id="{{ $product->id }}" 
				data-name="{{ $product->name }}" 
				data-price="{{ $product->price }}" 
				data-image="{{ asset('assets/' . $product->image) }}">
				Add to Cart
			</button>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- Product Modal -->

<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productModalLabel">Product Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <img id="modalImage" src="" alt="Product Image" class="img-fluid">
          </div>
          <div class="col-md-6">
            <h4 id="modalName"></h4>
            <p id="modalDescription"></p>
            <h5 class="text-success">£<span id="modalPrice"></span></h5>
            <button class="btn btn-success add-to-cart" id="modalAddToCart" data-id="">Add to Cart</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- the End of Product Modal -->


<div class="brands-section" style="overflow:hidden">
    <h2 class="text-center mt-4 mb-4" style="font-family: Arial, Helvetica, sans-serif; text-align: center;">Brands we work with</h2>
    <div class="row">
        <div class="col-4 col-md-2 mb-2">
            <a href="asus.html">
                <div class="brand-logo">
                    <img src="assets/Brands _ Direct Computers/ggf.png" alt="ASUS" class="img-fluid">
                </div>
            </a>
        </div>
        <div class="col-4 col-md-2 mb-2">
            <a href="Apple.html">
                <div class="brand-logo">
                    <img src="assets/Brands _ Direct Computers/asd.png" alt="Apple" class="img-fluid">
                </div>
            </a>
        </div>
        <div class="col-4 col-md-2 mb-2">
            <a href="amd.html">
                <div class="brand-logo">
                    <img src="assets/Brands _ Direct Computers/aaaad.png" alt="AMD" class="img-fluid">
                </div>
            </a>
        </div>
        <div class="col-4 col-md-2 mb-2">
            <a href="Canon.html">
                <div class="brand-logo">
                    <img src="assets/Brands _ Direct Computers/cnnon-logo.png" alt="Canon" class="img-fluid">
                </div>
            </a>
        </div>
        <div class="col-4 col-md-2 mb-2">
            <a href="BE QUIET.html">
                <div class="brand-logo">
                    <img src="assets/Brands _ Direct Computers/bquiet.png" alt="Be Quiet" class="img-fluid">
                </div>
            </a>
        </div>
        <div class="col-4 col-md-2 mb-2">
            <a href="Corsair.html">
                <div class="brand-logo">
                    <img src="assets/Brands _ Direct Computers/corsair-logo.png" alt="Corsair" class="img-fluid">
                </div>
            </a>
        </div>
        <!-- Repeat the structure for the next 6 brands -->
        <div class="col-4 col-md-2 mb-2">
            <a href="DeepCool.html">
                <div class="brand-logo">
                    <img src="assets/Brands _ Direct Computers/deepcool_4197bf72-7281-449d-87e5-963e0bfd3fb2.png" alt="DeepCool" class="img-fluid">
                </div>
            </a>
        </div>
        <div class="col-4 col-md-2 mb-2">
            <a href="Kingston.html">
                <div class="brand-logo">
                    <img src="assets/Brands _ Direct Computers/kingston-logo.png" alt="Kingston" class="img-fluid">
                </div>
            </a>
        </div>
        <div class="col-4 col-md-2 mb-2">
            <a href="HP.html">
                <div class="brand-logo">
                    <img src="assets/Brands _ Direct Computers/hp-logo.png" alt="HP" class="img-fluid">
                </div>
            </a>
        </div>
        <div class="col-4 col-md-2 mb-2">
            <a href="HPE.html">
                <div class="brand-logo">
                    <img src="assets/Brands _ Direct Computers/hpe-240gb-sata-6g-p05319-001-internal-hdd-drives-613.jpeg" alt="Hewlett Packard Enterprise" class="img-fluid">
                </div>
            </a>
        </div>
        <div class="col-4 col-md-2 mb-2">
            <a href="Marvo.html">
                <div class="brand-logo">
                    <img src="assets/Brands _ Direct Computers/marvo.png" alt="Marvo" class="img-fluid">
                </div>
            </a>
        </div>
        <div class="col-4 col-md-2 mb-2">
            <a href="piXL.html">
                <div class="brand-logo">
                    <img src="assets/Brands _ Direct Computers/pixl.png" alt="Pixl" class="img-fluid">
                </div>
            </a>
        </div>
        <div class="col-4 col-md-2 mb-2">
            <a href="Samsung.html">
                <div class="brand-logo">
                    <img src="assets/Brands _ Direct Computers/samsung-logo.png" alt="Samsung" class="img-fluid">
                </div>
            </a>
        </div>
        <div class="col-4 col-md-2 mb-2">
            <a href="TP-Link.html">
                <div class="brand-logo">
                    <img src="assets/Brands _ Direct Computers/tp.png" alt="TP-Link" class="img-fluid">
                </div>
            </a>
        </div>
        <div class="col-4 col-md-2 mb-2">
            <a href="Western Digital.html">
                <div class="brand-logo">
                    <img src="assets/Brands _ Direct Computers/westen-digital.png" alt="WD" class="img-fluid">
                </div>
            </a>
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
