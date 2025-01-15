<template>
    <div class="profile">
      <adminNavbar></adminNavbar>
      <div class="container mt-4" style="margin-top:6% !important;">
        <div class="row">
          <div class="card">
            <div class="card-header" style="background-color:rgb(32 48 102); color:white;">
              subscriptions(s)
            </div>
            <div class="card-body">
              <!--table-->
       <!-- Conditionally show a message if data is being loaded -->
  <div v-if="loading" class="alert alert-info mt-3 text-center" role="alert">
    Loading Subscriptions...
  </div>

  <!-- Conditionally show a message if there are no subs -->
  <div v-else-if="subscriptions.data.length === 0" class="alert alert-warning mt-3 text-center" role="alert">
    No available Subscriptions.
  </div>

  <!-- Conditionally show the table if there are subs -->
  <div v-else class="table-responsive">
    <table class="table">
      <!-- Table headers -->
      <thead>
        <tr>
          <th scope="col">S/N</th>
          <th scope="col">Provider Name</th>
          <th scope="col">Plans</th>
          <th scope="col">Amount</th>
          <th scope="col">Duration</th>
          <th scope="col">status</th>
          <th scope="col">Activation Date</th>
        </tr>
      </thead>
      <!-- Table body -->
      <tbody>
        <!-- Render each sub in a table row -->
        <tr v-for="sub in subscriptions.data" :key="sub.id">
          <td>{{ sub.id }}</td>
          <td>{{ sub.providers.surname }} {{ sub.providers.firstname }}</td>
          <td>{{ sub.plan.plan}}</td> 
          <td><span style="color:green">&#8358; </span> {{ sub.plan.amount}}</td> 
           <td>{{ sub.plan.duration}}</td> 
           <td v-if="sub.status === 'pending'" class="text-danger">Expired</td> 
           <td v-if="sub.status === 'active'" class="text-success">Active</td> 
          <td>{{ formatCreatedAt(sub.created_at) }}</td>
        </tr>
      </tbody>
    </table>

    <!-- Pagination -->
    <div class="col-md-10 offset-3 d-flex justify-content-center">
      <Bootstrap4Pagination
        :data="subscriptions"
        @pagination-change-page="fetchsubscriptions"
      ></Bootstrap4Pagination>
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
import moment from 'moment';
import {Bootstrap4Pagination} from 'laravel-vue-pagination';
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
        subscriptions: {data:[]}, 
        loading: false,
        successMessage: '',
        errorMessage: '',
    
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

      async fetchsubscriptions() {
      try {
        this.loading = true;
        // Ensure the URL starts with a forward slash to make it absolute
        const response = await axios.get('/api/adminsubscriptions');
        this.subscriptions = response.data;
      } catch (error) {
        console.error('Error fetching subscriptions items:', error);
      } finally {
        this.loading = false;
      }
    },


},
    mounted() {
        this.fetchsubscriptions();
      document.title = 'subscriptions | Kojax subs';
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