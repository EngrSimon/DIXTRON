<template>
    <div class="profile">
  <userNavbar></userNavbar>
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-6 mx-auto">
            <div class="login-wrap">
              <form @submit.prevent="Verify">
                  <div class="login-header text-center mb-0">
                <h3>OTP Verification</h3>
                <p>Check your mail for the OTP.</p>
              </div>
                <div class="log-form">
                  <div class="form-group">
                    <input type="number" class="form-control"  v-model="otp">
                    <span class="text-danger">{{ errors.otp }}</span> <!-- Display input error message -->
                  </div> 
                  <!-- Display success message -->
                <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
                <!-- Display error message -->
                <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>
                </div>
                  <button class="btn w-100 login-btn" type="submit" style="background-color: #ff6600; color:white;" :disabled="loading">
              <span v-if="loading">verifying...</span>
              <span v-else>Verify</span>
            </button>
              </form>
              </div>
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
      name:'verification',
      components: {
      userNavbar,
    },
  
    data() {
      return {
        otp: '',
        errorMessage: '',
        successMessage: '',
        errors: {},
        loading: false, // Add loading state
      };
    },
  
    methods: {
      Verify() {
    // Set loading state to true when login button is clicked
    this.loading = true;
    // Clear previous error messages
    this.errorMessage = '';
    this.successMessage = '';

    // Check if otp and password are provided
    if (!this.otp) {
        this.errorMessage = 'otp required';
        this.loading = false; // Reset loading state
        return;
    }

    axios.post('/api/otp-verification', { otp: this.otp })
        .then(response => {
            // Check if forget password was successful
            if (response.data && response.status === 200) {
                // Set success message
                this.successMessage = 'verification successful.';
                this.$router.push('/dashboard');
            } else {
                // If login was not successful, display error message from server
                this.errorMessage = 'verification failed.';
            }
        })
        .catch(error => {
            // Handle API call errors
            if (error.response && error.response.status === 422) {
                this.errorMessage = 'Invalid OTP.';
            }
            else if(error.response && error.response.status === 423){
              this.errorMessage = 'OTP has Expired.';
            }
            else {
                this.errorMessage = 'verification failed.';
            }
        })
        .then(() => {
            // Reset loading state regardless of success or failure
            this.loading = false;
        });
},
    },
  
    mounted() {
      document.title = 'Verification | Dashboard';
    }
  };
  </script>