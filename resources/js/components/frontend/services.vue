<template>
  <div id="services">
    <Navbar></Navbar>
    <section class="hero-section-two">
      <div class="banner-slider slider">
        <div class="banner">
          <img class="img-fluid" :src="'assets/img/banner-02.jpg'" alt="img">
        </div>
      </div>
      <div class="banner-search">
        <div class="container">
          <div class="row">
            <div class="col-md-10 mx-auto">
              <h1>World's Largest <span>Services</span></h1>
              <p>Search and Get your desired service</p>
              <!--Desktop view search form-->
              <!--End of search form in desktop view-->
              <div class="search-container mb-4">
                <div class="d-none d-md-block">
                  <form class="search-form" @submit.prevent="search" style="width: 100%;">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder=" What Service(s) do you need?" v-model="service" style="border-top-left-radius: 30px; border-bottom-left-radius: 30px;">
                      <input type="text" class="form-control" placeholder=" what state?" v-model="location">
                      <button type="submit" class="btn"  :disabled="searching" style="border-top-right-radius: 30px; border-bottom-right-radius: 30px; background-color: #ff6600; color:#fff;">
                        <span v-if="searching" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span v-else>Search</span>
                      </button>
                    </div>
                  </form>
                </div>
              </div>
              <!--End of search form in desktop view-->
            </div>
          </div>
        </div>
      </div>
    </section>
      <!-- Search Form-->
      <div class="search-container feature-section-two  mb-4 d-md-none"> <!-- Show only on mobile screens -->
          <form class="search-form" @submit.prevent="search" style="width: 100%;">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-map-marker-alt" style="color: #ff6600;"></i></span>
              </div>
              <input type="text" class="form-control" placeholder=" What Service(s) do you need?" v-model="service">
            </div>
            <div class="input-group mt-2">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search" style="color: #ff6600;"></i></span>
              </div>
              <input type="text" class="form-control"  placeholder=" what state?" v-model="location" style="border-radius:0px 10px 10px 0px;">
              <div class="input-group-append">
                <button type="submit" class="btn " :disabled="searching" style="background-color: #ff6600; color: white;border-radius:0px 10px 10px 0px; 
                ">
                  <span v-if="searching" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                  <span v-else>Search</span>
                </button>
              </div>
            </div>
          </form>
        </div>
       <!-- End of search form -->
    <section class="feature-section-two">
      <div class="container" >
<div v-if="searchResult && searchResult.data.length > 0" >
  <section class="feature-section-two" >
    <div class="container">
      <h4>Found {{ searchResult.total }} result(s) from your location.</h4>
      <div class="row mt-3">
        <!-- Display provider items -->
          <div v-for="provider in searchResult.data" :key="provider.id" class="col-12 col-md-3 col-lg-3 mb-4">
            <!-- Provider card -->
            <div class="card" style="border-radius: 15px; background-color: rgb(32, 48, 102); color: white;">
              <img :src="'/storage/service_images/'+provider.mainimage" class="card-img-top position-relative" alt="Service Image" style="border-radius: 15px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);">
              <div class="card-body position-relative" style="z-index: 2;">
                <h5 class="card-title" style="color:#ff6600">{{ provider.title }}</h5>
                <p class="card-text" @click="openItemModal(provider.id)" data-bs-toggle="modal" data-bs-target="#itemModal"><u>{{ provider.description?.substr(0,70) + '...' }}</u></p>
                <div class="d-flex justify-content-between p-2">
                  <p><i style="color:#ff6600;" class="fas fa-user"></i> {{ provider.providers.firstname }}</p>
                  <p><i style="color:#ff6600;" class="fas fa-map-marker-alt"></i> {{ provider.providers.state }}</p>
                </div>
                <div class="d-flex justify-content-around" style="border-radius:10px; background-color: white; border: 1px solid rgb(32 48 102); color: #ff6600;">
                  <a :href="'https://wa.me/' + provider.providers.mobile" target="_blank" class="pt-2">
                    <i class="fab fa-whatsapp" style="color: green;"></i> Chat
                  </a>
                  <p class="pt-2"><span style="color:rgb(32 48 102); font-weight:bold;">&#8358; </span> {{ provider.price }}</p>
                </div>
              </div>
              <!-- End of provider card -->
            </div>
            <div class="col-md-10 offset-4 d-flex justify-content-center text-center" > <!-- Adjusted class -->
                <Bootstrap4Pagination
                :data="searchResult"
                @pagination-change-page="search"
                ></Bootstrap4Pagination>
              </div>
          </div>
        <!-- Bootstrap alert -->
        <div v-if="searchResult.data.length === 0" class="alert alert-warning mt-3 text-center" role="alert">
            No Result Found. Check another Location.
        </div>
      </div>
      <!-- End of search Result -->
  

            </div>
          </section>
          <!-- Modal for displaying item details -->
          <div>
          </div>
        </div>
        <div v-else>
          <div class="row mt-3">
            <div class="section-heading-two">
          <h2>Kojax Featured Services</h2>
          <p>What do you need to find?</p>
        </div>
            <!-- Display provider items -->
            <div v-for="provider in ProvidersItems.data" :key="provider.id" class="col-12 col-md-3 col-lg-3 mb-4">
              <!-- Provider card -->
              <div class="card" style="border-radius: 15px; background-color: rgb(32, 48, 102); color: white;">
                <img :src="'/storage/service_images/'+provider.mainimage" class="card-img-top position-relative" alt="Service Image"
                style="border-radius: 15px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);">
                <div class="card-body position-relative" style="z-index: 2;">
                  <div class="d-flex justify-content-between">
                  <h5 class="card-title" style="color:#ff6600">{{ provider.title }}</h5>
                  <i class="fas fa-check-circle" style="color:#1DA1F2; font-size: 20px;"></i>
                </div>
                  <p class="card-text" @click="openItemModal(provider.id)" data-bs-toggle="modal" data-bs-target="#itemModal"><u>{{ provider.description?.substr(0,70) + '...' }}</u></p>
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
            <!-- Pagination component -->
            <div class="row mt-2">
              <!-- Display provider items -->
              <div class="col-md-10 offset-4  d-flex justify-content-center" > <!-- Adjusted class -->
                <Bootstrap4Pagination
                :data="ProvidersItems"
                @pagination-change-page="fetchProvidersItems"
                 style="text-align: center;"></Bootstrap4Pagination>
              </div>
            </div>
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
      </div>
      <!--End of how it works section-->
    </section>
    <!-- Modal for displaying item details -->
    <div>
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
  </div>
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
        const response = await axios.get(`/api/services?page=${page}`);
        this.ProvidersItems = response.data;
        
        // Update the URL with the current page number
        const url = new URL(window.location.href);
        const baseUrl = url.origin + url.pathname;
        url.href = `${baseUrl}#/services?page=${page}`;
        window.history.pushState({}, '', url);
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

    
    async search() {
      try {
        this.searching = true; // Set searching to true when search begins
        this.loading = true; // Set loading to true
        
        // Set service and location based on user input
        const service = this.service;
        const location = this.location;
        
        // Make the search request
        const response = await axios.get('/api/search', {
          params: { service, location }
        });
        
        // Update the search results with the response data
        this.searchResult = response.data;
        // Clear the search input
        
      } finally {
        this.loading = false; // Set loading to false when search completes
        this.searching = false; // Set searching to false when search completes
      }
    }
  },
  
  mounted() {
    document.title = 'Services | Kojax Services';
    this.fetchProvidersItems();
  },
};

</script>

<style scoped>
.overlay {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background-color: rgba(0, 0, 0, 0.5); /* Adjust opacity as needed */
}
</style>
