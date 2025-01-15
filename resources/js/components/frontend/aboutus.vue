<template>
    <div id="aboutus">
        <Navbar></Navbar>
        <section class="hero-section-two">
            <div class="banner-slider slider">
                <div class="banner">
                    <img class="img-fluid" :src="'assets/img/banner.jpg'" alt="About Kojax Services">
                </div>
            </div>
            <div class="banner-search " >
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 mx-auto">
                            <h1>About <span style="color: #ff6600;">Kojax Services</span></h1>
                            <p>The World`s Largest Services Place.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="container">
            <div style="margin-top:10%;">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6 mb-4">
                        <img class="img-fluid img-responsive" :src="'assets/img/banner-03.jpg'" alt="About Kojax Services">
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <h3 class="title mb-3 " style="color:#ff6600; font-weight:bold;">WELCOME TO KOJAX SERVICES</h3>
                        <p style=" margin-bottom:15px; line-height:1.8; font-size:18px;">At Kojax Services, we understand the value of time and the importance of convenience when it comes to finding the right services tailored to your needs. Our platform is designed to simplify your search process,
                            connecting you with a diverse range of service providers efficiently and effectively.</p>
                        </div>
                    </div>
                </div>
            </section>
            
            <div class="container mt-5">
                <div class="section-heading"  style="margin-top:6%;">
                        <h2 style="color: #ff6600;" class="text-center">What We Offer</h2>
                    </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="offer-item">
                            <h5 style="color:rgb(32 48 102);">Wide Range of Services</h5>
                            <p>From home maintenance to professional assistance, Kojax Services offers a comprehensive array of services to cater to every aspect of your life. Whether you're looking for home repairs, beauty treatments, or tutoring services, we've got you covered.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="offer-item">
                            <h5 style="color:rgb(32 48 102);">Verified Service Providers</h5>
                            <p>Rest assured, all service providers listed on Kojax Services undergo a rigorous verification process to ensure reliability and quality. We prioritize your safety and satisfaction, partnering only with trusted professionals who meet our stringent standards.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="offer-item">
                            <h5 style="color:rgb(32 48 102);">Community Engagement</h5>
                            <p>At Kojax Services, we foster a sense of community by facilitating feedback and reviews from users like you. Your input matters, helping us maintain transparency and accountability while continuously improving our services.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <!-- How it works section -->
                <div class="container">
                    <div class="row justify-content-center">
              <div class="col-md-12 mt-5">
              <div class="section-heading text-center" >
                  <h2>How It Works</h2>
                  <p>Discover how our platform simplifies your service search process.</p>
              </div>
          </div>
              <div class="col-lg-4 col-md-6 mt-0">
                <div class="work-wrap-box work-first ">
                  <div class="work-icon">
                    <span>
                      <img :src="'assets/img/icons/work-icon-01.svg'" alt="img">
                    </span>
                  </div>
                  <h5>Choose What To Do</h5>
                  <p>Explore a wide range of services categorized for your convenience.</p>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="work-wrap-box ">
                  <div class="work-icon">
                    <span>
                      <img :src="'assets/img/icons/work-icon-02.svg'" alt="img">
                    </span>
                  </div>
                  <h5>Find What You Want</h5>
                  <p>Use our search feature to quickly find the exact service you're looking for.</p>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="work-wrap-box ">
                  <div class="work-flex">
                    <div class="work-icon">
                      <span>
                        <img :src="'assets/img/icons/work-icon-03.svg'" alt="img">
                      </span>
                    </div>
                    <h5>Discover Amazing Places</h5>
                    <p>Explore service providers in your area and discover amazing places to fulfill your needs.</p>
                  </div>
                </div>
                </div>
                </div>
                </div> 
        </div>
        <Footer></Footer>
    </template>
    
    <script>
    import Header from '@/components/layouts/header.vue';
    import Navbar from '@/components/layouts/navbar.vue';
    import Footer from '@/components/layouts/footer.vue';
    export default {
        name: 'aboutus',
        components: {
            Header,
            Navbar,
            Footer,
        },
        
        mounted() {
            document.title = 'About Us| Kojax Services';
        },
        
        
    }
</script>

<style scoped>
.offer-item {
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-bottom: 30px;
    line-height:1.7;
    font-size:15px;
}

.offer-item h5 {
    margin-bottom: 15px;
}

.offer-item p {
    margin-bottom: 0;
}

</style>