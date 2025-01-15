<template>
  <div class="register">
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
                <h3>Register</h3>
                <p>Fill the form with the correct details</p>
              </div>
              
              <form action="">
                <div class="log-form">
                  <div class="form-group">
                    <label class="col-form-label">Surname</label>
                    <input type="name" class="form-control" placeholder="surname" v-model="surname">
                    <span class="text-danger text-small">{{ formErrors.surname }}</span>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Firstname</label>
                    <input type="name" class="form-control" placeholder="Firstname" v-model="firstname">
                    <span class="text-danger text-small">{{ formErrors.firstname}}</span>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Email</label>
                    <input type="email" class="form-control" placeholder="Andy@example.com" v-model="email">
                    <span class="text-danger text-small">{{ formErrors.email}}</span>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Mobile</label>
                    <input type="tel" class="form-control" placeholder="Mobile" v-model="mobile">
                    <span class="text-danger text-small">{{ formErrors.mobile}}</span>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">State</label>
                    <input type="text" class="form-control" placeholder="State" v-model="state">
                    <span class="text-danger text-small">{{ formErrors.state}}</span>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Country</label>
                    <input type="text" class="form-control" placeholder="country" v-model="country">
                    <span class="text-danger text-small">{{ formErrors.country}}</span>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Username</label>
                    <input type="text" class="form-control" placeholder="Choose Username" v-model="name">
                    <span class="text-danger text-small">{{formErrors.name}}</span>
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
                      <span class="text-danger text-small">{{ formErrors.password}}</span>
                    </div>
                    <div class="form-group mt-4">
                      <label class="col-form-label">Choose Profile Image</label>
                      <input type="file" class="form-control" @change="onFileChange">
                      <span class="text-danger text-small">{{ formErrors.profile_image }}</span>
                    </div>
                    
                  </div>
                </div>
                <!-- Success and error messages -->
                <div class="message-container">
                  <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
                  <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>
                </div>
                
                <!-- Registration button -->
                <button 
                class="btn w-100 login-btn" 
                type="button"
                :class="{ 'loading': loading }" 
                style="background-color: #ff6600; color:white;"
                @click="register"
                >
                {{ loading ? 'Registering...' : 'Register' }}
              </button>
              
              <!-- Link to login page -->
              <p class="no-acc">Already have an account? <router-link to="/login">Sign In</router-link></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Register',
  data() {
    return {
      surname: '',
      firstname: '',
      email: '',
      mobile: '',
      state: '',
      country: '',
      name: '',
      password: '',
      profile_image: null,
      errorMessage: '',
      successMessage: '',
      loading: false,
      formErrors: {},
      showPassword: false,
    };
  },
  methods: {
    onFileChange(event) {
      this.profile_image = event.target.files[0];
    },
    async register() {
      try {
        // Reset error messages and loading state
        this.formErrors = {};
        this.errorMessage = '';
        this.loading = true;
        
        // Create form data
        const formData = new FormData();
        formData.append('surname', this.surname);
        formData.append('firstname', this.firstname);
        formData.append('email', this.email);
        formData.append('mobile', this.mobile);
        formData.append('state', this.state);
        formData.append('country', this.country);
        formData.append('name', this.name);
        formData.append('password', this.password);
        formData.append('profile_image', this.profile_image);
        
        // Log input data
        console.log('Registration data:', {
          surname: this.surname,
          firstname: this.firstname,
          email: this.email,
          mobile: this.mobile,
          state: this.state,
          country: this.country,
          username: this.name,
          password: this.password
        });
        
        // Submit registration data
        const response = await axios.post('/api/register', formData, {
          headers: { 'Content-Type': 'multipart/form-data' }
        });
        
        // Show success message
        this.successMessage = 'Registration successful!';
        
        // Redirect to dashboard after a short delay
        setTimeout(() => {
          this.$router.push('/dashboard');
        }, 2000); // Redirect after 3 seconds
      } catch (error) {
        if (error.response && error.response.status === 422) {
          // Handle validation errors
          const errors = error.response.data.errors;
          Object.keys(errors).forEach(field => {
            this.formErrors[field] = errors[field][0];
          });
        } else {
          // Handle other types of errors
          this.errorMessage = 'Registration Failed. Please try again later.';
        }
      } finally {
        // Set loading state to false after registration attempt
        this.loading = false;
      }
    },
    togglePassword() {
      this.showPassword = !this.showPassword;
    },
  },
  mounted() {
    document.title = 'Register | Kojax Services';
  }
};
</script>

<style scoped>
.nav-link {
  color: white !important;
}

/* CSS for mobile view */
@media only screen and (max-width: 768px) {
  .nav-link {
    color: rgb(32 48 102) !important;
  }
}
</style>