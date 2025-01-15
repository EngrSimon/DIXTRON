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
              <div class="login-header text-center mb-0">
                <h3>Login</h3>
                <p>Please enter your details</p>
              </div>
              
              <form @submit.prevent="login">
                <div class="log-form">
                  <div class="form-group">
                    <label class="col-form-label">Email</label>
                    <input type="text" class="form-control" placeholder="johndoe@example.com" v-model="email">
                    <span class="text-danger">{{ errors.email }}</span> <!-- Display input error message -->
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col">
                        <label class="col-form-label">Password</label>
                      </div>
                    </div>
                    <div class="pass-group">
                      <input
                      v-if="!showPassword"
                      type="password"
                      class="form-control pass-input"
                      placeholder="*************"
                      v-model="password"
                      />
                      <input
                      v-else
                      type="text"
                      class="form-control pass-input"
                      placeholder="*************"
                      v-model="password"
                      />
                      <span 
                      class="toggle-password feather-eye-off" 
                      @click="showPassword = !showPassword"
                      ></span>
                      </div>
                      </div>
                  <div class="row">
                    <div class="col-6">
                      <label class="custom_check">
                        <input type="checkbox" name="rememberme" class="rememberme" style="color: #ff6600 !important; border-color:#ff6600;">
                        <span class="checkmark" style="color: #ff6600 !important;"></span>Remember Me
                      </label>
                    </div>
                    <div class="col-6 text-end">
                    <router-link to="/forgotpassword" class="forgot-link">Forgot password?</router-link>
                  </div>
                  </div>
                  <!-- Display success message -->
                <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
                <!-- Display error message -->
                <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>
                </div>
                  <button class="btn w-100 login-btn" type="submit" style="background-color: #ff6600; color:white;" :disabled="loading">
              <span v-if="loading">Signing in...</span>
              <span v-else>Login</span>
            </button>
                <p class="no-acc">Don't have an account? <router-link to="/register">Sign Up</router-link></p>
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
        email: '',
        password: '',
        errorMessage: '',
        successMessage: '',
        errors: {},
        loading: false, // Add loading state
        showPassword: false,
      };
    },
  
    methods: {
      login() {
    // Set loading state to true when login button is clicked
    this.loading = true;

    // Clear previous error messages
    this.errorMessage = '';
    this.successMessage = '';

    // Check if email and password are provided
    if (!this.email || !this.password) {
        this.errorMessage = 'Email and password are required';
        this.loading = false; // Reset loading state
        return;
    }

    axios.post('/api/login', { email: this.email, password: this.password })
        .then(response => {
            // Check if login was successful
            if (response.data && response.data.message === 'Login successful') {
                // Set success message
                this.successMessage = response.data.message;

                // Check user's role
                const role = response.data.role;
                if (role === 'admin') {
                    // Redirect admin to admin dashboard
                    this.$router.push('/admin');
                } else if (role === 'provider') {
                    // Redirect provider to dashboard
                    this.$router.push('/dashboard');
                } else {
                    // Redirect other roles to a default route
                    this.$router.push('/');
                }
            } else {
                // If login was not successful, display error message from server
                this.errorMessage = response.data.message || 'Login failed. Please try again.';
            }
        })
        .catch(error => {
            // Handle API call errors
            if (error.response && error.response.status === 422) {
                // Set errors returned by server
                this.errors = error.response.data.errors;
            } else {
                // Set generic error message
                console.log(error);
                this.errorMessage = 'Incorrect email or password.';
            }
        })
        .then(() => {
            // Reset loading state regardless of success or failure
            this.loading = false;
        });
},

       togglePassword() {
      this.showPassword = !this.showPassword;
    },
    },
  
    mounted() {
      document.title = 'Login | Kojax Services';
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