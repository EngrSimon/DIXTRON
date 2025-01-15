<template>
  <div class="profile">
    <userNavbar></userNavbar>
    <div class="container mt-4" style="margin-top:6% !important;">
      <router-link to="/">
        <i class="fas fa-arrow-left mb-3" style="color:rgb(32 48 102);"></i> Home
      </router-link>
      <div class="row">
        <div class="card">
          <div class="card-header" style="background-color:rgb(32 48 102); color:white;">
            Profile Setting
          </div>
          <div class="card-body">
            <form @submit.prevent="updateProfile">
              <div class="log-form">
                <div class="row">
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label class="col-form-label">Surname: {{ userData.providers.surname }}</label>
                      <input type="text" class="form-control" :placeholder="userData.providers.surname" v-model="surname" style="border: 1px solid rgb(32 48 102) !important;">
                      <span class="text-danger text-small">{{formErrors.surname}}</span>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label class="col-form-label">Firstname: {{ userData.providers.firstname }}</label>
                      <input type="text" class="form-control" :placeholder="userData.providers.firstname" v-model="firstname" style="border: 1px solid rgb(32 48 102) !important;">
                      <span class="text-danger text-small">{{formErrors.firstname}}</span>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label class="col-form-label">Email: {{ userData.providers.email}}</label>
                      <input type="email" class="form-control" :placeholder="userData.providers.email" v-model="email" style="border: 1px solid rgb(32 48 102) !important;">
                      <span class="text-danger text-small">{{formErrors.email}}</span>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label class="col-form-label">Mobile: {{ userData.providers.mobile }}</label>
                      <input type="tel" class="form-control" :placeholder="userData.providers.mobile" v-model="mobile" style="border: 1px solid rgb(32 48 102) !important;">
                      <span class="text-danger text-small">{{formErrors.mobile}}</span>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label class="col-form-label">State: {{ userData.providers.state }}</label>
                      <input type="text" class="form-control" :placeholder="userData.providers.state" v-model="state" style="border: 1px solid rgb(32 48 102) !important;">
                      <span class="text-danger text-small">{{formErrors.state}}</span>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label class="col-form-label">Country: {{ userData.providers.country }}</label>
                      <input type="text" class="form-control" :placeholder="userData.providers.country" v-model="country" style="border: 1px solid rgb(32 48 102) !important;">
                      <span class="text-danger text-small">{{formErrors.country}}</span>
                    </div>
                  </div>
                  <!--
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label class="col-form-label">Image</label>
                      <input type="file" class="form-control" style="border: 1px solid rgb(32 48 102) !important;">
                    </div>
                  </div>
                  -->
                  <!-- Success and error messages -->
                  <div class="message-container">
                    <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
                    <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>
                  </div>
                  <!-- End of Success and error messages -->
                  <div class="col-12 col-md-12 mt-3">
                    <div class="form-group">
                      <button class="btn w-100 login-btn" type="submit" style="background-color: #ff6600; color: white;" :disabled="loading">
                        <span v-if="loading" class="spinner-border spinner-border-sm ml-2" role="status" aria-hidden="true"></span>
                        <span v-else>Update Profile</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import userNavbar from '@/components/layouts/usernavbar.vue';
import axios from 'axios';

export default {
  name: 'profile',
  components: {
    userNavbar,
  },
  data() {
    return {
      authenticated: false,
      userData: {
        providers: {}, // Initialize providers object
      },
      loading: false,
      successMessage: '',
      errorMessage: '',
      formErrors: {},
      surname: '', // Initialize surname
      firstname: '', // Initialize firstname
      email: '', // Initialize email
      mobile: '', // Initialize mobile
      state: '', // Initialize state
      country: '', // Initialize country
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
    async updateProfile() {
      try {
        this.loading = true; // Start loading
        // Make a request to update the profile
        const response = await axios.post('/api/profile', {
          surname: this.surname,
          firstname: this.firstname,
          email: this.email,
          mobile: this.mobile,
          state: this.state,
          country: this.country,
        });
        // Handle success response
        this.successMessage = response.data.message;
        // Clear input fields
        this.surname = '';
        this.firstname = '';
        this.email = '';
        this.mobile = '';
        this.state = '';
        this.country = '';
      } catch (error) {
        if (error.response) {
          // Handle validation errors
          const errors = error.response.data.errors;
          Object.keys(errors).forEach((field) => {
            this.formErrors[field] = errors[field][0];
          });
        } else {
          // Handle other types of errors
          this.errorMessage = 'Profile Update Failed. Please try again later.';
        }
      } finally {
        this.loading = false; // Stop loading
      }
    },
  },
  mounted() {
    document.title = 'Profile Setting | Rojax Services';
  },
};
</script>