<template>
  <div id="services">
    <Navbar></Navbar>
    <section class="hero-section-two">
      <div class="banner-slider slider">
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-inner">
              <div class="banner carousel-item active  ">
                <img :src="'assets/img/banner-02.jpg'" class="d-block w-100" alt="Kojax services">
              </div>
              <div class="banner carousel-item">
                <img :src="'assets/img/banner-03.jpg'" class="d-block w-100" alt="Kojax services">
              </div>
              <div class="banner carousel-item">
                <img :src="'assets/img/banner-04.jpg'" class="d-block w-100" alt="Kojax services">
              </div>
            </div>
        </div>
        </div>
      <div class="banner-search">
        <div class="container">
          <div class="row">
            <div class="col-md-10 mx-auto">
              <h1>World's Largest <span>Services</span></h1>
              <p>Get your desired service </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="mt-4">
      <div class="container" >
          <div class="row">
            <div class="section-heading-two mb-0">
          <h2 style="font-size:30px; color: #ff6600;">Featured Services</h2>
        </div>
            <!-- Display provider items -->
            <div v-for="provider in ProvidersItems.data" :key="provider.id" class="col-6 col-md-3 col-lg-3 mb-4">
              <!-- Provider card -->
              <div class="card" style="border-radius: 15px; background-color: rgb(32, 48, 102); color: white;">
                <img :src="'/storage/service_images/'+provider.mainimage" class="card-img-top position-relative" alt="Service Image"
                style="border-radius: 15px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);">
                <div class="card-body position-relative" style="z-index: 2;">
                  <div class="d-flex justify-content-between">
                  <h5 class="card-title" style="color:#ff6600">{{ provider.title }}</h5>
                  <i class="fas fa-check-circle" style="color:#1DA1F2; font-size: 20px;"></i>
                </div>
                  <p class="card-text" @click="openItemModal(provider.id)" data-bs-toggle="modal" data-bs-target="#itemModal"><u>{{ provider.description?.substr(0,40) + '...' }}</u></p>
                  <div class="d-flex justify-content-between p-2">
                    <p><i style="color:#ff6600;" class="fas fa-user"></i> {{ provider.providers.firstname }}</p>
                    <p><i style="color:#ff6600;" class="fas fa-map-marker-alt"></i> {{provider.providers.state}}</p>
                  </div>
                  <div class="d-flex justify-content-around" style="border-radius:10px; background-color: white; border: 1px solid rgb(32 48 102); color: #ff6600;">
                    <a :href="'https://wa.me/' + provider.providers.mobile" target="_blank" class="pt-2">
                      <i class="fab fa-whatsapp" style="color: green;"></i> Chat
                    </a>
                    <p class="pt-2"><span style="color:rgb(32 48 102); font-weight:bold;">&#8358; </span> {{ provider.price }}</p>
                  </div>
                </div>
              </div>
              <!-- End of provider card -->
            </div>
            <!-- End of provider item display -->
          </div>
          <!-- Bootstrap alert -->
          <div v-if="loading" class="alert alert-info mt-3 text-center" role="alert">
            <span class="spinner-border spinner-border-sm ml-2" role="status" aria-hidden="true"></span>
            <span class="mr-2">Loading Services...</span>
          </div>
          <div v-else-if="ProvidersItems.data.length === 0" class="alert alert-warning mt-3 text-center" role="alert">
            No items or services Available.
          </div>
        </div>
      </section>
      </div>
      <!--How it works section-->
      <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
          <div class="section-heading text-center" >
            <h2 style="color: rgb(32 48 102);">How It Works</h2>
            <p style="color:black;">Discover how our platform simplifies your service search process.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mt-0">
          <div class="work-wrap-box work-first " style="background-color: rgb(32 48 102);">
            <div class="work-icon">
              <span>
                <img :src="'assets/img/icons/work-icon-01.svg'" alt="img">
              </span>
            </div>
            <h5 style="color:white">Choose What To Do</h5>
            <p style="color:white">Explore a wide range of services categorized for your convenience.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="work-wrap-box " style="background-color: rgb(32 48 102);">
            <div class="work-icon">
              <span>
                <img :src="'assets/img/icons/work-icon-02.svg'" alt="img">
              </span>
            </div>
            <h5 style="color:white">Find What You Want</h5>
            <p style="color:white">Use our search feature to quickly find the exact service you're looking for.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="work-wrap-box " style="background-color: rgb(32 48 102);">
            <div class="work-flex">
              <div class="work-icon">
                <span>
                  <img :src="'assets/img/icons/work-icon-03.svg'" alt="img">
                </span>
              </div>
              <h5 style="color:white">Discover Amazing Places</h5>
              <p style="color:white">Explore service providers in your area and discover amazing places to fulfill your needs.</p>
            </div>
          </div>
        </div>



    <!-- Modal for displaying item details -->
      <div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="itemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content" style="background-color:rgb(32 48 102);">
            <div class="modal-header">
              <h5 class="modal-title text-center" id="itemModalLabel" style="color:#ff6600; text-align: center;">Service Details</h5>
              <button data-bs-dismiss="modal" aria-label="Close" ><i  class="fas fa-window-close"></i></button>
            </div>
            <div class="modal-body" v-if="selectedItem">
              <!-- Display item details here -->
              <div class="card" style="background-color: #ccc;">
                <div class="card-body">
                  <h5 class="card-title" style="color:rgb(32 48 102); font-size:25px;">{{ selectedItem.title }}</h5>
                  <p class="card-text mt-3">{{ selectedItem.description }}</p>
                  <p class="card-text"><strong style="color:rgb(32 48 102);" >Location:</strong> {{ selectedItem.providers.state }}, {{selectedItem.providers.country}}</p>
                  <p class="card-text"><strong style="color:rgb(32 48 102);">Price:</strong><span style="color:green"> &#8358;  {{ selectedItem.price }}</span></p>
                  <!-- WhatsApp Icon -->
                  <a :href="'https://wa.me/' + selectedItem.providers.mobile" target="_blank">
                    <i class="fab fa-whatsapp mb-4" style="color: green;"></i> Chat via WhatsApp
                  </a>
                  <!-- Carousel for images -->
                  <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img :src="'/storage/service_images/'+selectedItem.mainimage" class="d-block w-100" alt="First slide">
                      </div>
                      <div class="carousel-item active">
                        <img :src="'/storage/service_images/'+selectedItem.firstimage" class="d-block w-100" alt="First slide">
                      </div>
                      <div class="carousel-item">
                        <img :src="'/storage/service_images/'+selectedItem.secondimage" class="d-block w-100" alt="Second slide">
                      </div>
                      <!-- Add more carousel items here for additional images -->
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next" >
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<!-- Whatsapp -->
<div style="position: fixed; bottom: 40px; right: 20px; text-align: center; cursor: pointer; z-index: 9999;">
    <a href="https://wa.me/" target="_blank" style="text-decoration: none; color: #fff;">
        <i class="fab fa-whatsapp" style="font-size: 40px; color:#25d366; z-index: 9999;"></i>
    </a>
</div>
<!-- End of Whatsapp -->

    <Footer></Footer>
</template>
<script>
import Navbar from '@/components/layouts/navbar.vue';
import Footer from '@/components/layouts/footer.vue';
import axios from 'axios';
import {Bootstrap4Pagination} from 'laravel-vue-pagination'; // Make sure vuejs-paginator is correctly installed and imported

export default {
  name: 'services',
  components: {
    Navbar,
    Footer,
    Bootstrap4Pagination,
  },
  data() {
    return {
      ProvidersItems:{data: [] },
      searchResult:{data:[]},
      searching: false,
      loading: false,
      service: '',
      location: '',
      paginationOptions: {
        wrapperClass: 'pagination float-right',
        current: 1,
        total: 0,
        perPage: 8,
        visiblePages: 5,
      },
      selectedItem: null, // Track the selected item for modal display
    };
  },
  methods: {
    async fetchProvidersItems(page = 1) {
      try {
        this.loading = true;
        // Ensure the URL starts with a forward slash to make it absolute
        const response = await axios.get(`/api/home?page=${page}`);
        this.ProvidersItems = response.data;
      } catch (error) {
        console.error('Error fetching providers items:', error);
      } finally {
        this.loading = false;
      }
    },
    openItemModal(id) {
    // Check if the item exists in ProvidersItems
    const itemInProvidersItems = this.ProvidersItems.data.find(item => item.id === id);
    if (itemInProvidersItems) {
        this.selectedItem = itemInProvidersItems;
        this.SearchselectedItem = null; // Reset SearchselectedItem
    } else {
        // Check if the item exists in searchResults
        const itemInSearchResults = this.searchResult.data.find(item => item.id === id);
        if (itemInSearchResults) {
            this.selectedItem = itemInSearchResults; // Reset selectedItem
            this.SearchselectedItem = itemInSearchResults;
        }
    }
    $('#itemModal').modal('show'); // Show the modal using jQuery
},

  },
  
  mounted() {
    document.title = 'Home | Kojax Services';
    this.fetchProvidersItems();
  },
};

document.addEventListener('DOMContentLoaded', function() {
    var myCarousel = document.querySelector('#carouselExampleCaptions');
    var carousel = new bootstrap.Carousel(myCarousel, {
        interval: 3500,
        ride: 'carousel'
    });
});

</script>
