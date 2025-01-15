<template>
    <div class="profile">
      <userNavbar></userNavbar>
      <div class="container mt-4" style="margin-top:6% !important;">
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

                <!--subscription form-->
    <div class="justify-content-end" v-if="subscription.length === 0">
        <div class="col-md-4" style="background-color:#ccc;"> <!-- Adjust the width of the card as needed -->
            <div class="card">
                <div class="card-header" style="background-color:#ff6600; color:white;">
                    Subscribe Below
                </div>
                <form @submit.prevent="submitPlan">
                    <div class="card-body">
                        <div class="form-group">
                            <select v-model="selectedPlanId" class="form-control">
                                <option value="" style="border: 1px solid #ff6600;">Select a Plan</option>
                                <option v-for="activeplan in plan" :key="activeplan.id" :value="activeplan.id">
                                    {{ activeplan.plan }} - &#8358;{{ activeplan.amount }} - {{ activeplan.duration }} days
                                </option>
                            </select>
                        </div>
                        <!-- Success and error messages -->
                        <div class="message-container">
                            <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
                            <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>
                        </div>
                  <!-- End of Success and error messages -->
                        <!-- Add more form elements as needed -->
                        <button type="submit" class="btn btn-primary" style="background-color:rgb(32 48 102); color:white;" :disabled="loading" @click="subscribe">
                            <span v-if="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            <span v-if="loading" class="visually-hidden">Loading...</span>
                            <span v-else>Subscribe</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
                <!--End of subscription form-->     
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
                            <td>{{ sub.status }}</td>
                        </tr>

                    </tbody>
                </table>

       <!--End table-->
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
        subscription: {}, 
        plan:{}, 
        loading: false,
        successMessage: '',
        errorMessage: '',
        selectedPlanId: '',
    
      };
    },
    created() {
      // Check authentication state when component is created
      this.checkAuthentication();
    },
    methods: {
     closeModal() {
      // Emit an event to notify the parent component to close the modal
      this.$emit('close-modal');
    },
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

    async fetchPlans(){
        const response = await axios.get('/api/plans');
    // Assuming response.data.subscriptions contains user subscriptions
        this.plan = response.data.plans;
    },
    submitPlan() {
    // Clear any existing messages
    this.successMessage = '';
    this.errorMessage = '';

    // Set loading to true to start the spinning animation
    this.loading = true;

    axios.post('/api/subscription', { plan_id: this.selectedPlanId })
        .then(response => {
            // Handle success response
            // Extract the authorization URL from the response
            const authorizationUrl = response.data.authorization_url;

            // Redirect the user to the authorization URL
            window.location.href = authorizationUrl;

            // Function to check payment status via webhook after payment
            const checkPaymentStatus = () => {
                // Send a request to your backend to check if payment is confirmed
                axios.get('/api/payment/status', { params: { reference: paymentReference } })
                    .then(response => {
                        if (response.data.payment_confirmed) {
                            // Payment has been confirmed, redirect back to the subscription page or display a success message
                            this.successMessage = 'Your subscription was successful.';
                        } else {
                            // Payment not confirmed yet, wait and check again
                            setTimeout(checkPaymentStatus, 3000); // Retry after 3 seconds
                        }
                    })
                    .catch(error => {
                        console.error('Error checking payment status:', error);
                        // Retry after 3 seconds in case of error
                        setTimeout(checkPaymentStatus, 3000);
                    });
            };

            // Start checking payment status after a delay
            setTimeout(checkPaymentStatus, 5000); // Start after 5 seconds
        })
        .catch(error => {
            // Handle error
            this.errorMessage = 'Payment failed.';
        })
        .finally(() => {
            // Set loading to false to stop the spinning animation
            this.loading = false;
        });
}

},
    mounted() {
        this.fetchPlans();
        this.fetchSubscriptions();
      document.title = 'Subscriptions | Kojax Services';
    },
  };
  </script>

<style scoped>
@media (max-width: 576px) {
    .custom-select {
        width: 100%;
    }
}
</style>