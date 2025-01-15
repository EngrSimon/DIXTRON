<template>
    <div class="profile">
      <adminNavbar></adminNavbar>
      <div class="container mt-4" style="margin-top:6% !important;">
        <div class="d-flex justify-content-end">
          <button class="btn" style="background-color:rgb(32 48 102);; color:white;" data-bs-toggle="modal" data-bs-target="#addPlanModal">Add Plan</button>
        </div>
        <div class="row">
          <div class="card">
            <div class="card-header" style="background-color:rgb(32 48 102); color:white;">
              Plan(s)
            </div>
            <div class="card-body">
              <!--table-->
       <!-- Conditionally show a message if data is being loaded -->
  <div v-if="loading" class="alert alert-info mt-3 text-center" role="alert">
    Loading Plans...
  </div>

  <!-- Conditionally show a message if there are no plans -->
  <div v-else-if="plans.data.length === 0" class="alert alert-warning mt-3 text-center" role="alert">
    No available Plan.
  </div>

  <!-- Conditionally show the table if there are plans -->
  <div v-else class="table-responsive">
    <table class="table">
      <!-- Table headers -->
      <thead>
        <tr>
          <th scope="col">S/N</th>
          <th scope="col">Plan</th>
          <th scope="col">Amount</th>
          <th scope="col">Duration</th>
          <th scope="col">Time</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <!-- Table body -->
      <tbody>
        <!-- Render each plan in a table row -->
        <tr v-for="plan in plans.data" :key="plan.id">
          <td>{{ plan.id }}</td>
          <td>{{ plan.plan }}</td>
          <td>{{ plan.amount}}</td> 
          <td>{{ plan.duration}}</td> 
          <td>{{ formatCreatedAt(plan.created_at) }}</td>
          <td>
            <button class="btn btn-success" @click="openUpdateModal(plan.id)" data-bs-toggle="modal" data-bs-target="#updatePlanModal">
              <i class="fas fa-edit"></i>
            </button>
          </td>
          <td>
            <button class="btn btn-danger" @click="showDeleteConfirmation(plan.id)">
              <i class="fas fa-trash"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Pagination -->
    <div class="col-md-10 offset-3 d-flex justify-content-center">
      <Bootstrap4Pagination
        :data="plans"
        @pagination-change-page="fetchplans"
      ></Bootstrap4Pagination>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>

   

       <!-- Confirmation Modal for Deletion-->
<div class="modal" id="confirmationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button  class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this plan?
            </div>
             <!-- Success and error messages -->
             <div class="message-container">
                    <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
                    <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>
                  </div>
                  <!-- End of Success and error messages -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">No</button>
                <button type="button" class="btn btn-danger" @click="deleteplanConfirmed">
                  <span v-if="deleting" class="spinner-border spinner-border-sm ml-2" role="status" aria-hidden="true" style="color:red;"></span>
                  <span>Yes</span>
                </button>
            </div>
        </div>
    </div>
</div>
<!--Add Plan Model-->
<div class="modal" id="addPlanModal" tabindex="-1" aria-labelledby="addPlanModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-header" style="background-color:rgb(32 48 102); color:white;">
            Add Plan
          </div>
          <div class="card-body">
            <form @submit.prevent="addPlan">
              <div class="log-form">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="What is the plan name?" v-model="planname"  style="border: 1px solid rgb(32 48 102) !important;">
                      <span class="text-danger text-small">{{ formErrors.planname}}</span>
                    </div>
                    <div class="form-group">
                      <input type="number" class="form-control"  placeholder="how much is the plan?" v-model="amount" style="border: 1px solid rgb(32 48 102) !important;">
                      <span class="text-danger text-small">{{ formErrors.amount}}</span>
                    </div>
                    <div class="form-group">
                      <input type="number" class="form-control"  placeholder="The plan is for how many weeks?" v-model="duration" style="border: 1px solid rgb(32 48 102) !important;">
                      <span class="text-danger text-small">{{ formErrors.duration}}</span>
                    </div>  
                  <!-- Success and error messages -->
                  <div class="message-container">
                    <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
                    <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>
                  </div>
                  <!-- End of Success and error messages -->
                    <div class="form-group">
                      <button class="btn w-100 login-btn" type="submit" style="background-color:rgb(32 48 102); color: white;" :disabled="loading">
                        <span v-if="adding" class="spinner-border spinner-border-sm ml-2" role="status" aria-hidden="true"></span>
                        <span v-else>Done</span>
                      </button>
                  </div>
                </div>
            </form>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
  <!--End Of Add Service Model-->

<!--Update plan Model -->
<div class="modal" id="updatePlanModal" tabindex="-1" aria-labelledby="addPlanModalLabel" aria-hidden="true" v-if="selectedplan">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-header" style="background-color:#ff6600; color:white;">
           Update Plan
          </div>
          <div class="card-body">
            <form @submit.prevent="updatePlan">
              <div class="log-form">
                    <div class="form-group">
                      <input type="text" class="form-control" :placeholder="'Plan Name: ' + selectedplan.plan" v-model="planname"  style="border: 1px solid rgb(32 48 102) !important;">
                      <span class="text-danger text-small">{{ formErrors.planname}}</span>
                    </div>
                    <div class="form-group">
                      <input type="number" class="form-control"  :placeholder="'Plan Amount: ' + selectedplan.amount" v-model="amount" style="border: 1px solid rgb(32 48 102) !important;">
                      <span class="text-danger text-small">{{ formErrors.amount}}</span>
                    </div>
                    <div class="form-group">
                      <input type="number" class="form-control" :placeholder="'Plan Duration: ' + selectedplan.duration" v-model="duration" style="border: 1px solid rgb(32 48 102) !important;">
                      <span class="text-danger text-small">{{ formErrors.duration}}</span>
                    </div>  
                  <!-- Success and error messages -->
                  <div class="message-container">
                    <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
                    <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>
                  </div>
                  <!-- End of Success and error messages -->
                    <div class="form-group">
                      <button class="btn w-100 login-btn" type="submit" style="background-color:rgb(32 48 102); color: white;" :disabled="loading">
                        <span v-if="updating" class="spinner-border spinner-border-sm ml-2" role="status" aria-hidden="true"></span>
                        <span v-else>update</span>
                      </button>
                  </div>
                </div>
            </form>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
  <!--End Of update plan Model-->
  </template>
 <script>
  import adminNavbar from '@/components/layouts/adminnavbar.vue';
  import moment from 'moment';
  import {Bootstrap4Pagination} from 'laravel-vue-pagination';
 import axios from 'axios';
  export default {
    name: 'profile',
    components: {
        adminNavbar,
        Bootstrap4Pagination,
    },
    data() {
  return {
    authenticated: false,
    plans: { data: [] },
    loading: false,
    updating:false,
    deleting:false,
    adding:false,
    successMessage: '',
    errorMessage: '',
    selectedItem: null,
    deleting: false,
    planId: '',
    selectedplanId: '',
    planname: '',
    amount: '',
    duration: '',
    formErrors: {}, // Initialize formErrors object
    selectedplan: {} // Define selectedplan in data
  };
},
    /*
    created() {
      // Check authentication state when component is created
      this.checkAuthentication();
    }, */
    methods: {
      formatCreatedAt(createdAt) {
      // Use moment.js to format the createdAt date using fromNow
      return moment(createdAt).fromNow();
    },

    showDeleteConfirmation(plansId) {
    const plans = this.plans.data.find(item => item.id === plansId);
    if (plans) {
        this.selectedplansId = plans.id;
        $('#confirmationModal').modal('show');
    } else {
        console.error('plans not found:', plansId);
    }
},

deleteplanConfirmed() {
    // Perform deletion using the stored plans ID
    this.deleting = true;
    axios.post('/api/deleteplan', { plan_id: this.selectedplansId })
        .then(response => {
            // Handle success response
            this.successMessage = 'plans deleted successfully.';
            // Update the plans list by removing the deleted plans
            this.plans.data = this.plans.data.filter(plans => plans.id !== this.selectedplansId);
        })
        .catch(error => {
            // Handle error
            this.errorMessage = 'plans deletion failed. Please try again later.';
        })
        .finally(() => {
            // Reset loading state or perform other necessary cleanup
            this.deleting = false;
            // Hide the modal
        });
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
      

  async addPlan() {
  try {
    // Reset error messages and loading state
    this.formErrors = {};
    this.errorMessage = '';
    this.successMessage = '';
    this.adding = true;
    
    // Create form data
    const formData = new FormData();
    formData.append('planname', this.planname);
    formData.append('amount', this.amount);
    formData.append('duration', this.duration);

    // Submit registration data
    const response = await axios.post('/api/addplan', formData, {
      headers: { 'Content-Type': 'multipart/form-data' }
    });

    // Show success message
    this.successMessage = 'Your has been created.';

    // Reset form fields
    this.planname = '';
    this.amount = '';
    this.duration = '';

    setTimeout(() => {
    window.location.reload(); // Reload the page
    }, 2000);
  } catch (error) {
    //console.error('Error adding services:', error);
    if (error.response && error.response.status === 422) {
      // Handle validation errors
      const errors = error.response.data.errors;
      Object.keys(errors).forEach(field => {
        this.formErrors[field] = errors[field][0];
      });
    } else {
      // Handle other types of errors
      this.errorMessage = 'Plan Failed. Please try again later.';
    }
  } finally {
    // Set loading state to false after submission attempt
    this.adding = false;
  }
},

openUpdateModal(id) {
    this.selectedplan = this.plans.data.find(item => item.id === id);
    $('#updatePlanModal').modal('show');
},
async updatePlan() {
  try {
    // Reset error messages and loading state
    this.formErrors = {};
    this.errorMessage = '';
    this.successMessage = '';
    this.updating = true;
    
    // Create form data
    const formData = new FormData();
    formData.append('planId', this.selectedplan.id); // Include the ID
    formData.append('planname', this.planname);
    formData.append('amount', this.amount);
    formData.append('duration', this.duration);

    // Submit registration data
    const response = await axios.post('/api/updateplan', formData, {
      headers: { 'Content-Type': 'multipart/form-data' }
    });

    // Show success message
    this.successMessage = 'Plan update was Successful.';

    // Reset form fields
    this.planname = '';
    this.amount = '';
    this.duration = '';

    setTimeout(() => {
    window.location.reload(); // Reload the page
    }, 2000);
  } catch (error) {
    if (error.response && error.response.status === 422) {
      // Handle validation errors
      const errors = error.response.data.errors;
      Object.keys(errors).forEach(field => {
        this.$set(this.formErrors, field, errors[field][0]);
      });
    } else {
      // Handle other types of errors
      this.errorMessage = 'plan Update Failed. Please try again later.';
    }
  } finally {
    // Set loading state to false after submission attempt
    this.updating = false;
  }
},

      async fetchplans() {
      try {
        this.loading = true;
        // Ensure the URL starts with a forward slash to make it absolute
        const response = await axios.get('/api/adminplans');
        this.plans = response.data;
      } catch (error) {
        console.error('Error fetching plans items:', error);
      } finally {
        this.loading = false;
      }
    },
    openItemModal(id) {
    // Check if the item exists in plans
    const itemInplans = this.plans.data.find(item => item.id === id);
    if (itemInplans) {
        this.selectedItem = itemInplans;
    }
    $('#itemModal').modal('show'); // Show the modal using jQuery
},


},
    mounted() {
        this.fetchplans();
      document.title = 'plans | Kojax plans';
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