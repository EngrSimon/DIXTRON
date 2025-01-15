<template>
  <div id="services">
    <Navbar></Navbar>
    <section class="hero-section-two">
      <div class="banner-slider slider">
        <div class="banner">
          <img class="img-fluid" :src="'assets/img/banner-02.jpg'" alt="img">
        </div>
      </div>
      <div class="banner-search ">
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
    
    <section class="feature-section-two">
  <div class="container">
    <div class="row mt-3">
      <!-- Display provider items -->
      <div v-if="searchResult.data.length > 0">
  <div v-for="provider in searchResult.data" :key="provider.id" class="col-12 col-md-3 col-lg-3 mb-4">
    <!-- Provider card -->
    <p >Found {{ searchResult.total }} result(s). From your location</p>
    <div class="card" style="border-radius: 15px; background-color: rgb(32, 48, 102); color: white;">
      <img :src="provider.mainimage" class="card-img-top position-relative" alt="Service Image" style="border-radius: 15px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);">
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
  </div>
</div>
<!-- Bootstrap alert -->
<div v-if="loading" class="alert alert-info mt-3 text-center" role="alert">
  <span class="spinner-border spinner-border-sm ml-2" role="status" aria-hidden="true"></span>
  <span class="mr-2">searching...</span>
</div>
<div v-else-if="searchResult.data.length === 0" class="alert alert-warning mt-3 text-center" role="alert">
  No Result Found. Check another Location.
</div>
</div>
      </div>
    </section>
   
  <Footer></Footer>
  </div>
</template>

<script>
import Navbar from '@/components/layouts/navbar.vue';
import Footer from '@/components/layouts/footer.vue';
import axios from 'axios';
import { Bootstrap4Pagination } from 'laravel-vue-pagination';

export default {
  name: 'services',
  components: {
    Navbar,
    Footer,
    Bootstrap4Pagination,
  },
  data() {
    return {
      searchResult: { data: [] },
      searching: false,
      loading: false,
      service: '',
      location: '',
    };
  },
  methods: {
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
    console.log(this.searchResult);
  } catch (error) {
    console.error('Error during search:', error);
  } finally {
    this.loading = false; // Set loading to false when search completes
    this.searching = false; // Set searching to false when search completes
  }
}

  },
  mounted() {
  },
};
</script>


