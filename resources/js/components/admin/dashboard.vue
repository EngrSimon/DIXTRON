<template>
    <div class="user-dashboard">
    <adminNavbar></adminNavbar>
      <div class="container mt-4" style="margin-top:6% !important;">
       <router-link to="/"><i class="fas fa-arrow-left mb-0" style="color:#ff6600;"></i> Home</router-link>
        <div class="row">
          <div class="col-sm-6 col-md-4 col-lg-4">
            <router-link to="/providers">
            <div class="card">
              <div class="card-body"  style="border-radius:10px !important;">
                <div class="d-flex justify-content-between align-items-center">
                  <h5 class="card-title m-0">Providers</h5>
                </div>
              </div>
            </div>
          </router-link>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-4">
            <router-link to="/adminsubscriptions">
            <div class="card">
              <div class="card-body" style="border-radius:10px !important;">
                <div class="d-flex justify-content-between align-items-center">
                  <h5 class="card-title m-0">Subscriptions</h5>
                </div>
              </div>
            </div>
          </router-link>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-4">
            <router-link to="/admincontacts">
            <div class="card">
              <div class="card-body" style="border-radius:10px !important;">
                <div class="d-flex justify-content-between align-items-center">
                  <h5 class="card-title m-0">ContactUs</h5>
                </div>
              </div>
            </div>
          </router-link>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-4">
            <router-link to="/adminservices">
            <div class="card">
              <div class="card-body" style="border-radius:10px !important;">
                <div class="d-flex justify-content-between align-items-center">
                  <h5 class="card-title m-0">Services</h5>
                </div>
              </div>
            </div>
          </router-link>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-4">
            <router-link to="/plans">
            <div class="card">
              <div class="card-body" style="border-radius:10px !important;">
                <div class="d-flex justify-content-between align-items-center">
                  <h5 class="card-title m-0">Plan</h5>
                </div>
              </div>
            </div>
          </router-link>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-4">
            <router-link to="/category">
            <div class="card">
              <div class="card-body" style="border-radius:10px !important;">
                <div class="d-flex justify-content-between align-items-center">
                  <h5 class="card-title m-0">Category</h5>
                </div>
              </div>
            </div>
          </router-link>
          </div>
        </div>
        <div>
          <!--End Of subscription Table-->
          <div class="row">
            <div class="card">
              <div class="card-header" style="background-color:rgb(32 48 102); color:white;">
                Subscription(s)
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
        <!--End Of subscription Table-->
        </div>
      </div>
    </div>
  </template>
  
  <script>
  
  import adminNavbar from '@/components/layouts/adminnavbar.vue';
  import axios from 'axios';
  import moment from 'moment';
import {Bootstrap4Pagination} from 'laravel-vue-pagination';
export default {
  name: 'user-dashboard',
  components: {
    adminNavbar,
    Bootstrap4Pagination,
  },
  data() {
      return {
        subscriptions: {data:[]}, 
      };
    },
    methods: {
      formatCreatedAt(createdAt) {
      // Use moment.js to format the createdAt date using fromNow
      return moment(createdAt).fromNow();
    },

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
    document.title =" Dashboard | Kojax Services";
    this.fetchsubscriptions();

    },
  };
  </script>