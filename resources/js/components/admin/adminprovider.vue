<template>
    <div class="profile">
      <adminNavbar></adminNavbar>
      <div class="container mt-4" style="margin-top:6% !important;">
        <div class="row">
          <div class="card">
            <div class="card-header" style="background-color:rgb(32 48 102); color:white;">
              provider(s)
            </div>
            <div class="card-body">
              <!--table-->
       <!-- Conditionally show a message if data is being loaded -->
  <div v-if="loading" class="alert alert-info mt-3 text-center" role="alert">
    Loading providers...
  </div>

  <!-- Conditionally show a message if there are no providers -->
  <div v-else-if="providers.data.length === 0" class="alert alert-warning mt-3 text-center" role="alert">
    No available providers.
  </div>

  <!-- Conditionally show the table if there are providers -->
  <div v-else class="table-responsive">
    <table class="table">
      <!-- Table headers -->
      <thead>
        <tr>
          <th scope="col">S/N</th>
          <th scope="col">FullName</th>
          <th scope="col">Email</th>
          <th scope="col">Mobile</th>
          <th scope="col">State</th>
          <th scope="col">Country</th>
          <th scope="col">Joined At</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <!-- Table body -->
      <tbody>
        <!-- Render each provider in a table row -->
        <tr v-for="provider in providers.data" :key="provider.id">
          <td>{{ provider.id }}</td>
          <td>{{ provider.surname }} {{ provider.firstname }}</td>
          <td>{{ provider.email }}</td> 
          <td>{{ provider.mobile }}</td> 
          <td>{{ provider.state}}</td>
          <td>{{ provider.country }}</td>  
          <td>{{ formatCreatedAt(provider.created_at) }}</td>
          <td>
            <button class="btn btn-danger" @click="showDeleteConfirmation(provider.id)">
              <i class="fas fa-trash"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Pagination -->
    <div class="col-md-10 offset-3 d-flex justify-content-center">
      <Bootstrap4Pagination
        :data="providers"
        @pagination-change-page="fetchproviders"
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
                Are you sure you want to delete this provider?
            </div>
             <!-- Success and error messages -->
             <div class="message-container">
                    <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
                    <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>
                  </div>
                  <!-- End of Success and error messages -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">No</button>
                <button type="button" class="btn btn-danger" @click="deleteproviderConfirmed">
                  <span v-if="deleting" class="spinner-border spinner-border-sm ml-2" role="status" aria-hidden="true" style="color:red;"></span>
                  <span>Yes</span>
                </button>
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
        providers: { data: [] }, 
        loading: false,
        successMessage: '',
        errorMessage: '',
        selectedItem: null,
        deleting:false,
        providerId:'',
        selectedproviderId:'',
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

    showDeleteConfirmation(providerId) {
    const provider = this.providers.data.find(item => item.id === providerId);
    if (provider) {
        this.selectedproviderId = provider.id;
        $('#confirmationModal').modal('show');
    } else {
        console.error('provider not found:', providerId);
    }
},

deleteproviderConfirmed() {
    // Perform deletion using the stored provider ID
    this.deleting = true;
    axios.post('/api/deleteprovider', { provider_id: this.selectedproviderId })
        .then(response => {
            // Handle success response
            this.successMessage = 'provider deleted successfully.';
            // Update the provider list by removing the deleted provider
            this.providers.data = this.providers.data.filter(provider => provider.id !== this.selectedproviderId);
        })
        .catch(error => {
            // Handle error
            this.errorMessage = 'provider deletion failed. Please try again later.';
            console.error('Error deleting provider:', error);
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

      async fetchproviders() {
      try {
        this.loading = true;
        // Ensure the URL starts with a forward slash to make it absolute
        const response = await axios.get('/api/providers');
        this.providers = response.data;
      } catch (error) {
        console.error('Error fetching providers items:', error);
      } finally {
        this.loading = false;
      }
    },
    openItemModal(id) {
    // Check if the item exists in providers
    const itemInproviders = this.providers.data.find(item => item.id === id);
    if (itemInproviders) {
        this.selectedItem = itemInproviders;
    }
    $('#itemModal').modal('show'); // Show the modal using jQuery
},

},
    mounted() {
        this.fetchproviders();
      document.title = 'providers | Kojax providers';
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