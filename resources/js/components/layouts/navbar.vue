<template>
  <header :class="{'header': true, 'header-two': true, 'authenticated': authenticated}" style="background-color:rgb(32 48 102); color:white;">
    <div class="container">
      <nav class="navbar header-nav">
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
              <img :src="'assets/img/logo/navbar.png'" class="img-fluid img-responsive" alt="Logo" style="max-width:70px;">
            </a>
            <a id="menu_close" class="menu-close" href="javascript:void(0);"> <i class="fas fa-times"></i></a>
          </div>
          <ul class="main-nav">
          <li class="has-submenu megamenu nav-item">
            <router-link class="nav-link" to="/" style="color:white;">Home</router-link>
          </li>
          <!--
          <li class="has-submenu nav-item" @click.native="reloadServicesPage">
            <router-link class="nav-link" to="/services" style="color:white;">Services</router-link>
          </li>-->
          <li class="has-submenu nav-item">
            <router-link class="nav-link" to="/services" style="color:white;">Services</router-link>
          </li>
          <li class="has-submenu nav-item">
            <router-link class="nav-link" id="about-link" to="/aboutus" style="color:white;">About Us</router-link>
          </li>
          <li class="has-submenu nav-item">
            <router-link class="nav-link" id="contact-link" to="/contactus" style="color:white;">Contact Us</router-link>
          </li>
        </ul>

        </div>
        <ul class="nav header-navbar-rht">
      <transition name="slide-up">
        <router-link v-if="authenticated" class="nav-link" to="/dashboard" key="authenticated">
          <img v-if="userData.providers && userData.providers.image" 
              v-bind:src="'/storage/profile_images/' + userData.providers.image" 
              alt="User Image" class="ml-2 user-image">
          <i v-else class="fas fa-user-circle fa-lg slide-icon" style="color: #ff6600"></i>
        </router-link>
        <router-link v-else class="nav-link" to="/login" key="login">
          <i class="fas fa-user-circle fa-lg slide-icon" style="color: #ff6600"></i>
        </router-link>
      </transition>
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
    this.checkAuthentication();
  },
  methods: {
    async checkAuthentication() {
      try {
        const response = await axios.get('/api/verify');
        this.authenticated = response.data.authenticated;
        if (this.authenticated) {
          this.userData = response.data.user;
        }
      } catch (error) {
        if (error.response && error.response.status === 401) {
          // Redirect to the login page if the session has expired
        } else {
          // Handle other types of errors
        }
      }
    },

    /*
    reloadServicesPage() {
      // Reload the Services page
      window.location.reload();
    }, */
  },
}
</script>

<style scoped>
.user-image {
  width: 30px; /* Adjust the width as needed */
  height: 30px; /* Adjust the height as needed */
  border-radius: 50%; /* To make it a circular image */
}
.authenticated {
  background-color: rgb(32 48 102);
  .nav-link {
    color: white;
  }
}
.slide-up-enter-active, .slide-up-leave-active {
  transition: transform 0.5s, opacity 0.5s;
}
.slide-up-enter, .slide-up-leave-to {
  transform: translateY(20px);
  opacity: 0;
}

.slide-icon {
  animation: slide 1.5s infinite;
}

@keyframes slide {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-5px);
  }
}
.nav-link {
  color: white;
  transition: color 0.3s;
}

.nav-link:hover,
.nav-link:focus,
.router-link-exact-active {
  color:#ff6600 !important;
  font-size:16px;
  
}





/* CSS for mobile view */
@media only screen and (max-width: 768px) {
  .nav-link {
    color: rgb(32 48 102) !important;
  }
}
</style>
