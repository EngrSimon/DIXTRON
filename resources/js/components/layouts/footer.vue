<template>
  <footer class="footer footer-two mt-4 pt-5" style="background-color:rgb(32 48 102); color:white;">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-3">
            <div class="footer-widget">
              <div class="footer-logo">
                <img :src="'assets/img/logo/navbar.png'" alt="Kojax Services" class="img-fluid img-responsive">
                <p class="mt-2">Welcome to World's Largest Services</p>
                <div class="footer-address">
                  <div>
                    <h6>Email Address</h6>
                    <p>customer@kojaxservices.com</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-3">
            <div class="footer-widget footer-menu">
              <h2 class="footer-title">Company</h2>
              <ul>
                <li>
                  <router-link to="/aboutus" style="color:white;">About Us</router-link>
                </li>
                <li>
                  <router-link to="/services" style="color:white;">Services</router-link>
                </li>
                <li>
                  <router-link to="/contactus" style="color:white;">Contactus</router-link>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3 col-md-3">
            <div class="footer-widget footer-menu">
              <h2 class="footer-title">Quick Links</h2>
              <ul>
                <li>
                  <router-link to="/contactus" style="color:white;">Contact us</router-link>
                </li>
                <li>
                  <a href="" style="color:white;">Online Chat</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3 col-md-3">
            <div class="newsletter-form">
              <h4>Subscribe to Our Newsletter</h4>
              <form action="#" method="post">
                <div class="form-group">
                  <input type="email" class="form-control" placeholder="Enter your email" required>
                </div>
                <button type="submit" class="btn btn-primary" style=" background-color: #ff6600 !important;">Subscribe</button>
              </form>
            </div>
          </div>
          <div class="copyright-text text-center mb-3">
      <p class="mb-0"> © {{ currentYear }} Kojax Services. All Rights Reserved.</p>
    </div>
    <p class="copyright text-center">
      <a style="color: #ff6600;" href="https://www.nexainnova.com" target="_blank"> Developed By Nexainnova.</a>
    </p>
        </div>
  </div>
  </footer>
</template>
<script>
export default {
  data() {
    return {
      currentYear: new Date().getFullYear(),
    };
  },
};
</script>
