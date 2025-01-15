<template>
    <div id="contactus">
      <Navbar></Navbar>
      <div class="contact-us">
        <!-- Banner -->
        <div class="contact">
          <h1>Contact Us</h1>
          <p style="font-weight:small; font-family:poppins;">
            If you have any inquiries or suggestion, feel free to reach out to us.
          </p>
        </div>
  
         <!-- Contact Form -->
      <div class="contact-form mt-5 mb-5">
        <h2 class="mt-5">Get in Touch</h2>
        <form id="contactForm" @submit.prevent="submitForm">
          <div class="form-group">
            <input type="text" v-model="formData.name" required placeholder="Enter Full Name">
            <span v-if="errors.name" class="error">{{ errors.name }}</span>
          </div>
          <div class="form-group">
            <input type="email" v-model="formData.email" required placeholder="What is your email Address?">
            <span v-if="errors.email" class="error">{{ errors.email }}</span>
          </div>
          <div class="form-group">
            <textarea v-model="formData.message" required placeholder="What is your message?"></textarea>
            <span v-if="errors.message" class="error">{{ errors.message }}</span>
          </div>
          <button class="mb-5" type="submit" :disabled="sending">{{ sending ? 'Sending...' : 'Send Message' }}</button>
        </form>
        <div v-if="responseMessage" class="mt-3 text-center alert alert-success text-dark">{{ responseMessage }}</div>
      </div>
    </div>
      <Footer></Footer>
    </div>
  </template>
  <script>
  import Header from '@/components/layouts/header.vue';
  import Navbar from '@/components/layouts/navbar.vue';
  import Footer from '@/components/layouts/footer.vue';
  import axios from 'axios';
  
  export default {
    name: 'contactus',
    components: {
      Header,
      Navbar,
      Footer,
    },
    data() {
      return {
        formData: {
          name: '',
          email: '',
          message: ''
        },
        errors: {}, // Hold error messages for input fields
        sending: false,
        responseMessage: ''
      };
    },
    methods: {
      async submitForm() {
        try {
          this.validateForm();
          if (Object.keys(this.errors).length === 0) {
            this.sending = true;
            const response = await axios.post('/api/contact', this.formData);
            this.responseMessage = response.data.message;
            this.clearForm();
          }
        } catch (error) {
         // console.error('Error submitting form:', error);
          this.responseMessage = 'An error occurred. Please try again later.';
        } finally {
          this.sending = false;
        }
      },
      validateForm() {
        this.errors = {};
        if (!this.formData.name) {
          this.errors.name = 'Please enter your name';
        }
        if (!this.formData.email) {
          this.errors.email = 'Please enter your email';
        } else if (!this.isValidEmail(this.formData.email)) {
          this.errors.email = 'Please enter a valid email address';
        }
        if (!this.formData.message) {
          this.errors.message = 'Please enter your message';
        }
      },
      isValidEmail(email) {
        // Simple email validation regex
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
      },
      clearForm() {
        this.formData.name = '';
        this.formData.email = '';
        this.formData.message = '';
      }
    },
    mounted() {
      document.title = 'Contact Us | Kojax Services';
    },
  }
  </script>
  
  <style scoped>
  /* Your existing CSS styles */
  
  .response-message {
    margin-top: 10px;
    font-weight: bold;
  }

.contact{
    background-color: rgb(32 48 102);
    color: white;
    padding: 50px 0;
    text-align: center;
}

.contact-form {
    max-width: 600px;
    margin: 0 auto;
    border:1px solid #ccc;
    padding:20px;
    box-shadow:10px #ccc;
}

.contact-form h2 {
    text-align: center;
    margin-bottom: 20px;
    color: rgb(32 48 102);
}

.form-group {
    margin-bottom: 20px;
}


input[type="text"],
input[type="email"],
textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button[type="submit"] {
    background-color: rgb(32 48 102);
    color: white;
    border: none;
    width: 100% !important;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #e65c00;
}
  </style>