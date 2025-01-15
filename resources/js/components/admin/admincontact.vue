<template>
    <div class="profile">
      <adminNavbar></adminNavbar>
      <div class="container mt-4" style="margin-top:6% !important;">
        <div class="row">
          <div class="card">
            <div class="card-header" style="background-color:rgb(32 48 102); color:white;">
              Contact(s)
            </div>
            <div class="card-body">
              <!--table-->
       <!-- Conditionally show a message if data is being loaded -->
  <div v-if="loading" class="alert alert-info mt-3 text-center" role="alert">
    Loading Messages...
  </div>

  <!-- Conditionally show a message if there are no contacts -->
  <div v-else-if="contacts.data.length === 0" class="alert alert-warning mt-3 text-center" role="alert">
    No available Messages.
  </div>

  <!-- Conditionally show the table if there are contacts -->
  <div v-else class="table-responsive">
    <table class="table">
      <!-- Table headers -->
      <thead>
        <tr>
          <th scope="col">S/N</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Message</th>
          <th scope="col">Time</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <!-- Table body -->
      <tbody>
        <!-- Render each contact in a table row -->
        <tr v-for="contact in contacts.data" :key="contact.id">
          <td>{{ contact.id }}</td>
          <td>{{ contact.name }}</td>
          <td>{{ contact.email}}</td> 
          <td>{{ contact.message?.substr(0, 50) + '...' }}</td>
          <td>{{ formatCreatedAt(contact.created_at) }}</td>
          <td>
            <button class="btn btn-success" @click="openItemModal(contact.id)" data-bs-toggle="modal" data-bs-target="#itemModal">
              <i class="fas fa-eye"></i>
            </button>
          </td>
          <td>
            <button class="btn btn-danger" @click="showDeleteConfirmation(contact.id)">
              <i class="fas fa-trash"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Pagination -->
    <div class="col-md-10 offset-3 d-flex justify-content-center">
      <Bootstrap4Pagination
        :data="contacts"
        @pagination-change-page="fetchcontacts"
      ></Bootstrap4Pagination>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>

    <!--Model for contact Detail-->
    <div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="itemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="background-color:rgb(32 48 102);">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="itemModalLabel" style="color:#ff6600; text-align: center;">Contact Detail</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: white !important;"></button>
        </div>
        <div class="modal-body" v-if="selectedItem">
          <!-- Display item details here -->
          <div class="card" style="background-color: #ccc;">
          <div class="card-body">
            <h5 class="card-title" style="color:rgb(32 48 102); font-size:25px;">{{ selectedItem.name }}</h5>
            <p class="card-text mt-3">Email: {{ selectedItem.email}}</p>
            <p class="card-text mt-3">{{ selectedItem.message}}</p>
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
                Are you sure you want to delete this Contact?
            </div>
             <!-- Success and error messages -->
             <div class="message-container">
                    <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
                    <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>
                  </div>
                  <!-- End of Success and error messages -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">No</button>
                <button type="button" class="btn btn-danger" @click="deleteContactConfirmed">
                  <span v-if="deleting" class="spinner-border spinner-border-sm ml-2" role="status" aria-hidden="true" style="color:red;"></span>
                  <span>Yes</span>
                </button>
            </div>
        </div>
    </div>
</div>
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
    contacts: { data: [] }, // Ensure that contacts is initialized with a data property
    loading: false,
    successMessage: '',
    errorMessage: '',
    selectedItem: null,
    deleting: false,
    contactId: '',
    selectedContactId: '',
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

    showDeleteConfirmation(contactsId) {
    const contacts = this.contacts.data.find(item => item.id === contactsId);
    if (contacts) {
        this.selectedcontactsId = contacts.id;
        $('#confirmationModal').modal('show');
    } else {
        console.error('contacts not found:', contactsId);
    }
},

deleteContactConfirmed() {
    // Perform deletion using the stored contacts ID
    this.deleting = true;
    axios.post('/api/deletecontact', { contact_id: this.selectedcontactsId })
        .then(response => {
            // Handle success response
            this.successMessage = 'contacts deleted successfully.';
            // Update the contacts list by removing the deleted contacts
            this.contacts.data = this.contacts.data.filter(contacts => contacts.id !== this.selectedcontactsId);
        })
        .catch(error => {
            // Handle error
            this.errorMessage = 'contacts deletion failed. Please try again later.';
            console.error('Error deleting contacts:', error);
        })
        .finally(() => {
            // Reset loading state or perform other necessary cleanup
            this.deleting = false;
            // Hide the modal
        });
},

    /*
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
      */

      async fetchcontacts() {
      try {
        this.loading = true;
        // Ensure the URL starts with a forward slash to make it absolute
        const response = await axios.get('/api/admincontacts');
        this.contacts = response.data;
      } catch (error) {
        console.error('Error fetching contacts items:', error);
      } finally {
        this.loading = false;
      }
    },
    openItemModal(id) {
    // Check if the item exists in contacts
    const itemIncontacts = this.contacts.data.find(item => item.id === id);
    if (itemIncontacts) {
        this.selectedItem = itemIncontacts;
    }
    $('#itemModal').modal('show'); // Show the modal using jQuery
},


},
    mounted() {
        this.fetchcontacts();
      document.title = 'contacts | Kojax contacts';
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