<template>
    <div class="profile">
      <adminNavbar></adminNavbar>
      <div class="container mt-4" style="margin-top:6% !important;">
        <div class="d-flex justify-content-end">
          <button class="btn" style="background-color:rgb(32 48 102);; color:white;" data-bs-toggle="modal" data-bs-target="#addcategoryModal">Add category</button>
        </div>
        <div class="row">
          <div class="card">
            <div class="card-header" style="background-color:rgb(32 48 102); color:white;">
              category(s)
            </div>
            <div class="card-body">
              <!--table-->
       <!-- Conditionally show a message if data is being loaded -->
  <div v-if="loading" class="alert alert-info mt-3 text-center" role="alert">
    Loading categorys...
  </div>

  <!-- Conditionally show a message if there are no categorys -->
  <div v-else-if="categories.data.length === 0" class="alert alert-warning mt-3 text-center" role="alert">
    No available category.
  </div>

  <!-- Conditionally show the table if there are categorys -->
  <div v-else class="table-responsive">
    <table class="table">
      <!-- Table headers -->
      <thead>
        <tr>
          <th scope="col">S/N</th>
          <th scope="col">category</th>
          <th scope="col">Time</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <!-- Table body -->
      <tbody>
        <!-- Render each category in a table row -->
        <tr v-for="category in categories.data" :key="category.id">
          <td>{{ category.id }}</td>
          <td>{{ category.name }}</td>
          <td>{{ formatCreatedAt(category.created_at) }}</td>
          <td>
            <button class="btn btn-success" @click="openUpdateModal(category.id)" data-bs-toggle="modal" data-bs-target="#updatecategoryModal">
              <i class="fas fa-edit"></i>
            </button>
          </td>
          <td>
            <button class="btn btn-danger" @click="showDeleteConfirmation(category.id)">
              <i class="fas fa-trash"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Pagination -->
    <div class="col-md-10 offset-3 d-flex justify-content-center">
      <Bootstrap4Pagination
        :data="categories"
        @pagination-change-page="fetchcategories"
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
                Are you sure you want to delete this category?
            </div>
             <!-- Success and error messages -->
             <div class="message-container">
                    <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
                    <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>
                  </div>
                  <!-- End of Success and error messages -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">No</button>
                <button type="button" class="btn btn-danger" @click="deletecategoryConfirmed">
                  <span v-if="deleting" class="spinner-border spinner-border-sm ml-2" role="status" aria-hidden="true" style="color:red;"></span>
                  <span>Yes</span>
                </button>
            </div>
        </div>
    </div>
</div>
<!--Add category Model-->
<div class="modal" id="addcategoryModal" tabindex="-1" aria-labelledby="addcategoryModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-header" style="background-color:#ff6600; color:white;">
            Add A Category
          </div>
          <div class="card-body">
            <form @submit.prevent="addcategory">
              <div class="log-form">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="What is the category name?" v-model="categoryname"  style="border: 1px solid rgb(32 48 102) !important;">
                      <span class="text-danger text-small">{{ formErrors.categoryname}}</span>
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

<!--Update category Model -->
<div class="modal" id="updatecategoryModal" tabindex="-1" aria-labelledby="addcategoryModalLabel" aria-hidden="true" v-if="selectedcategory">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-header" style="background-color:#ff6600; color:white;">
           Update category
          </div>
          <div class="card-body">
            <form @submit.prevent="updatecategory">
              <div class="log-form">
                    <div class="form-group">
                      <input type="text" class="form-control" :placeholder="'category Name: ' + selectedcategory.name" v-model="categoryname"  style="border: 1px solid rgb(32 48 102) !important;">
                      <span class="text-danger text-small">{{ formErrors.categoryname}}</span>
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
  <!--End Of update category Model-->
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
    categories: { data: [] },
    loading: false,
    updating:false,
    deleting:false,
    adding:false,
    successMessage: '',
    errorMessage: '',
    selectedItem: null,
    deleting: false,
    categoryId: '',
    selectedcategoryId: '',
    categoryname: '',
    amount: '',
    duration: '',
    formErrors: {}, // Initialize formErrors object
    selectedcategory: {} // Define selectedcategory in data
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

    showDeleteConfirmation(categorysId) {
    const category = this.categories.data.find(item => item.id === categorysId);
    if (category) {
        this.selectedcategoryId = category.id;
        $('#confirmationModal').modal('show');
    } else {
        console.error('categorys not found:');
    }
},

deletecategoryConfirmed() {
    // Perform deletion using the stored categorys ID
    this.deleting = true;
    axios.post('/api/deletecategory', { category_id: this.selectedcategoryId })
        .then(response => {
            // Handle success response
            this.successMessage = 'categorys deleted successfully.';
            // Update the categorys list by removing the deleted categorys
            this.categories.data = this.categories.data.filter(categories => categories.id !== this.selectedcategoryId);
        })
        .catch(error => {
            // Handle error
            this.errorMessage = 'categorys deletion failed. Please try again later.';
            console.error('Error deleting categorys:', error);
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
      

  async addcategory() {
  try {
    // Reset error messages and loading state
    this.formErrors = {};
    this.errorMessage = '';
    this.successMessage = '';
    this.adding = true;
    
    // Create form data
    const formData = new FormData();
    formData.append('categoryname', this.categoryname);

    // Submit registration data
    const response = await axios.post('/api/addcategory', formData, {
      headers: { 'Content-Type': 'multipart/form-data' }
    });

    // Show success message
    this.successMessage = 'Your category has been created.';

    // Reset form fields
    this.categoryname = '';

     // Fetch updated categories
     await this.fetchcategories();

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
      this.errorMessage = 'category Failed. Please try again later.';
    }
  } finally {
    // Set loading state to false after submission attempt
    this.adding = false;
  }
},

openUpdateModal(id) {
    this.selectedcategory = this.categories.data.find(item => item.id === id);
    $('#updatecategoryModal').modal('show');
},
async updatecategory() {
  try {
    // Reset error messages and loading state
    this.formErrors = {};
    this.errorMessage = '';
    this.successMessage = '';
    this.updating = true;
    
    // Create form data
    const formData = new FormData();
    formData.append('categoryId', this.selectedcategory.id); // Include the ID
    formData.append('categoryname', this.categoryname);

    // Submit registration data
    const response = await axios.post('/api/updatecategory', formData, {
      headers: { 'Content-Type': 'multipart/form-data' }
    });

    // Show success message
    this.successMessage = 'category update was Successful.';

    // Reset form fields
    this.categoryname = '';
    
    // Fetch updated categories
    await this.fetchcategories();
  } catch (error) {
    if (error.response && error.response.status === 422) {
      // Handle validation errors
      const errors = error.response.data.errors;
      Object.keys(errors).forEach(field => {
        this.$set(this.formErrors, field, errors[field][0]);
      });
    } else {
      // Handle other types of errors
      this.errorMessage = 'category Update Failed. Please try again later.';
    }
  } finally {
    // Set loading state to false after submission attempt
    this.updating = false;
  }
},

      async fetchcategories() {
      try {
        this.loading = true;
        // Ensure the URL starts with a forward slash to make it absolute
        const response = await axios.get('/api/admincategories');
        this.categories = response.data;
      } catch (error) {
        console.error('Error fetching categorys items:', error);
      } finally {
        this.loading = false;
      }
    },
    openItemModal(id) {
    // Check if the item exists in categorys
    const itemIncategories  = this.categories.data.find(item => item.id === id);
    if (itemIncategories ) {
        this.selectedItem = itemIncategories;
    }
    $('#itemModal').modal('show'); // Show the modal using jQuery
},


},
    mounted() {
        this.fetchcategories();
      document.title = 'Category | Kojax categorys';
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