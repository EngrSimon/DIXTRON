<template>
    <div class="login">
      <header class="header header-two"  style="background-color:rgb(32 48 102);">
        <div class="container">
          <nav class="navbar navbar-expand-lg header-nav">
            <div class="navbar-header">
              <a id="mobile_btn" href="javascript:void(0);">
                <span class="bar-icon">
                  <span></span>
                  <span></span>
                  <span></span>
                </span>
              </a>
              <router-link class="navbar-brand logo"to="/">
                <img :src="'assets/img/logo/navbar.png'" class="img-fluid img-responsive" alt="Logo">
              </router-link>
              <router-link class="navbar-brand logo-small"to="/">
                <img :src="'assets/img/logo/navbar.png'" class="img-fluid img-responsive" alt="Logo">
              </router-link>
            </div>
            <div class="main-menu-wrapper">
              <div class="menu-header">
                <a class="menu-logo">
                  <img :src="'assets/img/logo/navbar.png'" class="img-fluid img-responsive" alt="Logo" style="width:70px;">
                </a>
                <a id="menu_close" class="menu-close" href="javascript:void(0);"> <i class="fas fa-times"></i></a>
              </div>
              <ul class="main-nav">
                <li class="has-submenu megamenu nav-item">
              <router-link class="active nav-link" to="/" style="color:white;">Home</router-link>
            </li>
              <li class="  has-submenu nav-item">
                <router-link class=" nav-link" to="/services">Services</router-link>
              </li>
                <li class=" has-submenu nav-item">
                  <router-link class="nav-link link" id="about-link" to="/aboutus">About Us</router-link>
                </li>
                <li class=" has-submenu nav-item">
                  <router-link class="nav-link link" id="about-link" to="/contactus">ContactUs</router-link>
                </li>
              </ul>
            </div>
            <ul class="nav header-navbar-rht">
              <li class="nav-item">
                <router-link class="nav-link " to="/login"><i class="fas fa-user-circle fa-lg" style="color:#ff6600"></i></router-link>
              </li>
            </ul>
          </nav>
        </div>
      </header>
      <div class="content">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-lg-6 mx-auto">
              <div class="login-wrap">
                <form @submit.prevent="resetPassword">
                    <div class="login-header text-center mb-0">
                  <h3>Choose A New Password</h3>
                </div>
                  <div class="log-form">
                    <div class="form-group">
                      <label class="col-form-label">Choose Password</label>
                      <input type="password" class="form-control" placeholder="*********" v-model="password">
                      <span class="text-danger">{{ errors.password }}</span> <!-- Display input error message -->
                    </div> 
                    <div class="form-group">
                      <label class="col-form-label">Confirm Password</label>
                      <input type="password" class="form-control" placeholder="*********" v-model="password_confirmation">
                      <span class="text-danger">{{ errors.password_confirmation }}</span> <!-- Display input error message -->
                    </div> 
                    <!-- Display success message -->
                  <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
                  <!-- Display error message -->
                  <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>
                  </div>
                    <button class="btn w-100 login-btn" type="submit" style="background-color: #ff6600; color:white;" :disabled="loading">
                <span v-if="loading">Reseting...</span>
                <span v-else>Reset</span>
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
    import Header from '@/components/layouts/header.vue';
    import Navbar from '@/components/layouts/navbar.vue';
    import axios from 'axios';
    
    export default {
      name: 'login',
      components: {
        Header,
        Navbar,
      },
    
      data() {
        return {
          password: '',
          password_confirmation:'',
          errorMessage: '',
          successMessage: '',
          errors: {},
          loading: false, // Add loading state
        };
      },
    
      methods: {
        resetPassword() {
          // Set loading state to true when login button is clicked
          this.loading = true;
    
          // Clear previous error messages
          this.errorMessage = '';
          this.successMessage = '';
    
          // Check if email and password are provided
          if (!this.password || !this.password_confirmation) {
            this.errorMessage = 'Passwords Required';
            this.loading = false; // Reset loading state
            return;
          }
          if(this.password !== this.password_confirmation){
            this.errorMessage = 'Passwords does not match';
            this.loading = false; // Reset loading state
            return;
          }
    
     axios.post(`/api/resetpassword?token=${this.$route.query.token}`, {
        password: this.password,
        password_confirmation: this.password_confirmation
    })
    .then(response => {
      // Check if forget password was successful
      if (response.data && response.status === 200) {
        // Set success message
        this.successMessage = 'Password reset successful.';
      }
      if (response.data && response.status === 400) {
        // Set success message
        this.errorMessage = response.data.message;
      }
      if (response.data && response.status === 404) {
        // Set success message
        this.errorMessage = response.data.message;
      }
       else {
        // If login was not successful, display error message from server
        this.errorMessage = 'password reset failed. Please try again.';
      }
    })
    .catch(error => {
      // Handle API call errors
      if (error.response) {
          // Handle validation errors
          const errors = error.response.data.errors;
          Object.keys(errors).forEach(field => {
            this.formErrors[field] = errors[field][0];
          });
        } else {
          // Handle other types of errors
          this.errorMessage = 'Password Reset Failed. Please try again later.';
    }
    })
    .then(() => {
      // Reset loading state regardless of success or failure
      this.loading = false;
    });
        },
      },
    
      mounted() {
        document.title = 'Password Reset Form | Kojax Services';
      }
    };
    </script>
  
  <style scoped>
  .nav-link{
    color:white !important;
  }
  /* CSS for mobile view */
  @media only screen and (max-width: 768px) {
    .nav-link {
      color: rgb(32 48 102) !important;
    }
  }
  </style>