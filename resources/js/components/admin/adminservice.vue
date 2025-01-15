<template>
    <div class="profile">
      <adminNavbar></adminNavbar>
      <div class="container mt-4" style="margin-top:6% !important;">
        <div class="row">
          <div class="card">
            <div class="card-header" style="background-color:rgb(32 48 102); color:white;">
              service(s)
            </div>
            <div class="card-body">
              <!--table-->
       <!-- Conditionally show a message if data is being loaded -->
  <div v-if="loading" class="alert alert-info mt-3 text-center" role="alert">
    Loading services...
  </div>

  <!-- Conditionally show a message if there are no services -->
  <div v-else-if="ProvidersItems.data.length === 0" class="alert alert-warning mt-3 text-center" role="alert">
    No available services.
  </div>

  <!-- Conditionally show the table if there are services -->
  <div v-else class="table-responsive">
    <table class="table">
      <!-- Table headers -->
      <thead>
        <tr>
          <th scope="col">S/N</th>
          <th scope="col">Provider Name</th>
          <th scope="col">Services Title</th>
          <th scope="col">Price</th>
          <th scope="col">Description</th>
          <th scope="col">Time</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <!-- Table body -->
      <tbody>
        <!-- Render each service in a table row -->
        <tr v-for="service in ProvidersItems.data" :key="service.id">
          <td>{{ service.id }}</td>
          <td>{{ service.providers.surname }} {{ service.providers.firstname }}</td>
          <td>{{ service.title }}</td> 
          <td><span style="color:green">&#8358; </span>{{ service.price }}</td>
          <td>{{ service.description?.substr(0, 50) + '...' }}</td>
          <td>{{ formatCreatedAt(service.created_at) }}</td>
          <td>
            <button class="btn btn-success" @click="openItemModal(service.id)" data-bs-toggle="modal" data-bs-target="#itemModal">
              <i class="fas fa-eye"></i>
            </button>
          </td>
          <td>
            <button class="btn btn-danger" @click="showDeleteConfirmation(service.id)">
              <i class="fas fa-trash"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Pagination -->
    <div class="col-md-10 offset-3 d-flex justify-content-center">
      <Bootstrap4Pagination
        :data="ProvidersItems"
        @pagination-change-page="fetchProvidersItems"
      ></Bootstrap4Pagination>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>

       <!-- Confirmation Modal for Deletion-->
<div class="modal" id="confirmationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button  class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this service?
            </div>
             <!-- Success and error messages -->
             <div class="message-container">
                    <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
                    <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>
                  </div>
                  <!-- End of Success and error messages -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">No</button>
                <button type="button" class="btn btn-danger" @click="deleteServiceConfirmed">
                  <span v-if="deleting" class="spinner-border spinner-border-sm ml-2" role="status" aria-hidden="true" style="color:red;"></span>
                  <span>Yes</span>
                </button>
            </div>
        </div>
    </div>
</div>

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
                  <!-- WhatsApp Icon 
                  <a :href="'https://wa.me/' + selectedItem.providers.mobile" target="_blank">
                    <i class="fab fa-whatsapp mb-4" style="color: green;"></i> Chat via WhatsApp
                  </a>
                Carousel for images -->
                  <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img :src="selectedItem.mainimage" class="d-block w-100" alt="First slide">
                      </div>
                      <div class="carousel-item active">
                        <img :src="selectedItem.firstimage" class="d-block w-100" alt="First slide">
                      </div>
                      <div class="carousel-item">
                        <img :src="selectedItem.secondimage" class="d-block w-100" alt="Second slide">
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
  </template>

<script>
import adminNavbar from '@/components/layouts/adminnavbar.vue';
import {Bootstrap4Pagination} from 'laravel-vue-pagination';
import moment from 'moment';
 import axios from 'axios';
  export default {
    name: 'profile',
    components: {
        adminNavbar,
        Bootstrap4Pagination,
    },
 
    data() {
      return {
        authenticated: false,
        ProvidersItems: { data: [] }, 
        loading: false,
        successMessage: '',
        errorMessage: '',
        selectedItem: null,
        deleting:false,
        serviceId:'',
        selectedserviceId:'',
      };
    },
    /*
    created() {
      // Check authentication state when component is created
      this.checkAuthentication();
    }, */
    methods: {
      formatCreatedAt(createdAt) {
      // Use moment.js to format the createdAt date using fromNow
      return moment(createdAt).fromNow();
    },

    showDeleteConfirmation(serviceId) {
    const service = this.ProvidersItems.data.find(item => item.id === serviceId);
    if (service) {
        this.selectedServiceId = service.id;
        $('#confirmationModal').modal('show');
    } else {
        console.error('Service not found:', serviceId);
    }
},

deleteServiceConfirmed() {
    // Perform deletion using the stored service ID
    this.deleting = true;
    axios.post('/api/deleteadminservice', { service_id: this.selectedServiceId })
        .then(response => {
            // Handle success response
            this.successMessage = 'Service deleted successfully.';
            // Update the service list by removing the deleted service
            this.ProvidersItems.data = this.ProvidersItems.data.filter(service => service.id !== this.selectedServiceId);
        })
        .catch(error => {
            // Handle error
            this.errorMessage = 'Service deletion failed. Please try again later.';
            console.error('Error deleting service:', error);
        })
        .finally(() => {
            // Reset loading state or perform other necessary cleanup
            this.deleting = false;
            // Hide the modal
        });
},

    /*
      async checkAuthentication() {
        try {
          // Make a request to the backend to check authentication state and fetch user data
          const response = await axios.get('/api/verify');
          // Set authenticated state based on the response
          this.authenticated = response.data.authenticated;
          // Set user data if authenticated
          if (this.authenticated) {
            this.userData = response.data.user;
            // console.log('User data:', this.userData); // Log user data
          }
        } catch (error) {
          if (error.response && error.response.status === 401) {
        // Redirect to the login page if the session has expired
        this.$router.push('/login');
      } else {
        // Handle other types of errors, e.g., display a generic error message
        //console.error('Error checking authentication:', error);
      }
        }
      },
      */

      async fetchProvidersItems(page = 1) {
      try {
        this.loading = true;
        // Ensure the URL starts with a forward slash to make it absolute
        const response = await axios.get(`/api/adminservices?page=${page}`);
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
    }
    $('#itemModal').modal('show'); // Show the modal using jQuery
},

},
    mounted() {
        this.fetchProvidersItems();
      document.title = 'services | Kojax Services';
    },
  };
  </script>

<style scoped>
@media (max-width: 576px) {
    .custom-select {
        width: 100%;
    }
}
</style>