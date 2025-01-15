<template>
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
                <li class=" has-submenu nav-item">
                  <router-link class="nav-link link" id="about-link" to="/admin">Dashboard</router-link>
                </li>
                <li class=" has-submenu nav-item">
                  <router-link class="nav-link link" id="about-link" to="/providers">Providers</router-link>
                </li>
                <li class=" has-submenu nav-item">
                  <router-link class="nav-link link" id="about-link" to="/adminsubscriptions">Subscriptions</router-link>
                </li>
                <li class=" has-submenu nav-item">
                  <router-link class="nav-link link" id="about-link" to="/adminservices">Services</router-link>
                </li>
                <li class=" has-submenu nav-item">
                  <router-link class="nav-link link" id="about-link" to="/admincontacts">Contacts</router-link>
                </li>
                <li class=" has-submenu nav-item">
                  <router-link class="nav-link link" id="about-link" to="/category">Category</router-link>
                </li>
                <li class=" has-submenu nav-item">
                  <router-link class="nav-link link" id="about-link" to="/plans">Plan</router-link>
                </li>
                <li class=" has-submenu nav-item">
                  <router-link class="nav-link link" id="about-link" to="/logout">SignOut</router-link>
                </li>
              </ul>
            </div>
            <ul class="nav header-navbar-rht">
              <li class="nav-item">
                <!--
                <div v-if="authenticated">
                 Display user profile information 
                <router-link class="nav-link" to="/profile">
                  <img v-if="userData.providers.image" v-bind:src="'/storage/profile_images/'+userData.providers.image" alt="User Image" class="ml-2 user-image">
                  <i v-else class="fas fa-user-circle fa-lg" style="color: #ff6600"></i>
                </router-link>
              </div>
              <div v-else>
                 Display login/register link or a message 
                <router-link class="nav-link " to="/profile"><i class="fas fa-user-circle fa-lg" style="color:#ff6600"></i></router-link>
                </div>
                -->
                <router-link class="nav-link" to="/logout" @click="logout"><i class="fas fa-sign-out" style="color:#ff6600"></i></router-link>
              </li>
            </ul>
          </nav>
        </div>
      </header>
  </template>
  
  <script>
  import axios from 'axios';
export default {
  data() {
    return {
      authenticated: false,
      userData: {}
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
    logout() {
      axios.post('/api/logout')
        .then(response => {
          // Handle successful logout
          this.$router.push('/home');
          window.location.reload(); // Reload the page
        })
        .catch(error => {
          // Handle logout error
          //console.error('Logout error:', error);
        });
    }
  },
};
</script>
  
  <style scoped>
  .user-image {
    width: 30px; /* Adjust the width as needed */
    height: 30px; /* Adjust the height as needed */
    border-radius: 50%; /* To make it a circular image */
  }
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