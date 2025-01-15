<template>
  <div class="user-dashboard">
    <userNavbar></userNavbar>
    <div class="container mt-4" style="margin-top:6% !important;">
      <div class="d-flex justify-content-between mb-3">
     <router-link to="/"><i class="fas fa-arrow-left mb-0" style="color:#ff6600;"></i> Home</router-link>
     <button v-if="userData.providers.status === 'unverified'"  class="p-2 mt-3" @click="sendVerificationEmail" style="color:white; border-radius:10px;
      background-color:red; border-color:red;"
      > <span v-if="loading" class="spinner-border spinner-border-sm ml-2" role="status" aria-hidden="true"></span>
      <span v-else>Verify Account</span>
    </button>
    </div>
  <marquee v-if="userData.providers.status === 'unverified'" style="font-size:15px; font-weight:bold; color:red">
    Make your services visible by verifying your account. We love and care about your growth.
  </marquee>

      <div class="row">
        <div class="col-sm-6 col-md-4 col-lg-4">
          <router-link to="/myservice">
          <div class="card">
            <div class="card-body"  style="border-radius:10px !important;">
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title m-0">My Service</h5>
              </div>
            </div>
          </div>
        </router-link>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-4">
          <router-link to="/subscription">
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
          <router-link to="/profile">
          <div class="card">
            <div class="card-body" style="border-radius:10px !important;">
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title m-0">profile</h5>
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
              <!-- Conditionally show a message if there are no active subscriptions -->
                <div v-if="subscription.length === 0" class="alert alert-warning mt-3 text-center" role="alert">
                    No active subscriptions.
                </div>
                  <!-- Conditionally show the table if there are active subscriptions -->
                <table v-show="subscription.length > 0" class="table">
                    <thead>
                        <tr>
                            <th scope="col">Plans</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Duration</th>
                            <th scope="col">Status</th> <!-- Corrected "status" to "Status" for consistency -->
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Render each subscription in a table row -->
                        <tr v-for="sub in subscription" :key="sub.id">
                            <td>{{ sub.plan.plan }}</td> <!-- Access the plan details through the "plan" method -->
                            <td>{{ sub.plan.amount }}</td>
                            <td>{{ sub.plan.duration }}</td>
                            <td style="color:green;">{{ sub.status }}</td>
                        </tr>

                    </tbody>
                </table>

       <!--End table-->
            </div>
          </div>
        </div>
      <!--End Of subscription Table-->
      </div>
    </div>
  </div>
</template>

<script>

import userNavbar from '@/components/layouts/usernavbar.vue';
import axios from 'axios';
export default {
  name: 'user-dashboard',
  components: {
    userNavbar,
  },
  data() {
      return {
        subscription: {}, 
        authenticated: false,
        userData: {},
        loading: false,
      };
    },

    created() {
    // Check authentication state when component is created
    this.checkAuthentication();
  },
    methods: {
    async checkAuthentication() {
    try {
      // Make a request to the backend to check authentication state and fetch user data
      const response = await axios.get('/api/verify');
      // Set authenticated state based on the response
      this.authenticated = response.data.authenticated;
      // Set user data if authenticated
      if (this.authenticated) {
        this.userData = response.data.user;
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

   async fetchSubscriptions() {
  try {
    this.loading = true; // Start loading
    // Make a request to fetch user subscriptions
    const response = await axios.get('/api/subscription');
    // Assuming response.data.subscriptions contains user subscriptions
    this.subscription = response.data.subscriptions;
    // Check if subscriptions are empty
    if (!this.subscription || Object.keys(this.subscription).length === 0) {
        //console.log('No subscriptions found');
    } else {
        //console.log(this.subscription);
    }

    // Handle success response
    //this.successMessage = 'Subscriptions fetched successfully.';
  } catch (error) {
    // Handle errors
   // this.errorMessage = 'Failed to fetch subscriptions. Please try again later.';
  } finally {
    this.loading = false; // Stop loading
  }
      },

      sendVerificationEmail() {
  this.loading = true;
  axios.post('/api/send-verification-email')
    .then(response => {
      // Redirect to the page for entering OTP after successful email sending
      this.$router.push('/verification');
    })
    .catch(error => {
      console.error('Error sending verification email:', error);
      // Handle error, such as displaying a message to the user
    })
    .finally(() => {
      // Set loading state to false after submission attempt
      this.loading = false;
    });
}

  },
    mounted() {
    document.title =" Dashboard | Kojax Services";
    this.fetchSubscriptions();

    },
  };
  </script>

