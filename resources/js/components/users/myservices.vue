<template>
  <div id="myservices">
    <userNavbar></userNavbar>
    <section class="feature-section-two">
      <div class="container">
        <div class="d-flex justify-content-end">
          <button class="btn" style="background-color: #ff6600; color:white;" data-bs-toggle="modal" data-bs-target="#addServiceModal">Add Service</button>
        </div>
         <div class="row mt-3">
          <!-- Display provider items -->
          <div v-for="provider in ProvidersItems.data" :key="provider.id" class="col-12 col-md-3 col-lg-3 mb-4">
            <!-- Provider card -->
            <div class="card" style="border-radius: 15px; background-color: rgb(32, 48, 102); color: white; height:300px;">
              <!--
            <img :src="'/storage/service_images/'+provider.mainimage" class="card-img-top position-relative" alt="Service Image"
                style="border-radius: 15px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); height:200px;">
                -->
              <div class="card-body position-relative" style="z-index: 2;">
                <h5 class="card-title" style="color:#ff6600">{{ provider.title }}</h5>
                <p class="card-text" @click="openItemModal(provider.id)" data-bs-toggle="modal" data-bs-target="#itemModal"><u>{{ provider.description?.substr(0,50) + '...' }}</u></p>
                <div class="d-flex justify-content-between p-2">
                  <p><i style="color:#ff6600;" class="fas fa-map-marker-alt"></i> {{ provider.providers.state }}</p>
                  <p><i style="color:green;" class="fas fa-currency"></i> {{ provider.price}}</p>
              </div>
              </div>
              <div class="d-flex justify-content-around" style="border-radius:10px; background-color: white; border: 1px solid rgb(32 48 102); color: #ff6600;">
                <p class="pt-2"><span style="color:green">&#8358;{{ provider.price }}</span></p>
                <p class="pt-2"  @click="openItemModal(provider.id)" data-bs-toggle="modal" data-bs-target="#itemModal"><i style="color:green"  class="fas fa-edit"></i></p>
                <p class="pt-2" @click="showDeleteConfirmation(provider.id)"><i style="color:red" class="fas fa-trash"></i>
                </p>
              </div>
            </div>
            <!-- End of provider card -->
          </div>
          <!-- End of provider item display -->
           <!-- Pagination component -->
           <div class="row mt-2">
          <!-- Display provider items -->
          <div class="col-md-10 offset-3 d-flex justify-content-center" > <!-- Adjusted class -->
            <Bootstrap4Pagination
              :data="ProvidersItems"
              @pagination-change-page="fetchProvidersItems"
           ></Bootstrap4Pagination>
          </div>
        </div>


        </div>
        <!-- Bootstrap alert -->
        <div v-if="loading" class="alert alert-info mt-3 text-center" role="alert">
          <span class="spinner-border spinner-border-sm ml-2" role="status" aria-hidden="true"></span>
          <span class="mr-2">Loading Up Your Service(s)...</span>
        </div>
        <div v-else-if="ProvidersItems.data.length === 0" class="alert alert-warning mt-3 text-center" role="alert">
          Sorry,You don`t have any services available.
        </div>
      </div>
    </section>
    <!-- Modal for displaying item details -->
<div>
  <div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="itemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content" style="background-color:rgb(32 48 102);">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="itemModalLabel" style="color:#ff6600; text-align: center;">Your Service Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: white !important;"></button>
        </div>
        <div class="row">
          <div class="col-12 col-md-6">
        <div class="modal-body" v-if="selectedItem">
          <!-- Display item details here -->
          <div class="card" style="background-color: #ccc;">
          <div class="card-body">
            <h5 class="card-title" style="color:rgb(32 48 102); font-size:25px;">{{ selectedItem.title }}</h5>
            <p class="card-text mt-3">{{ selectedItem.description }}</p>
            <p class="card-text"><strong style="color:rgb(32 48 102);" >Location:</strong> {{ selectedItem.providers.state }}</p>
            <p class="card-text"><strong style="color:rgb(32 48 102);">Price:</strong><span style="color:green">&#8358;  {{ selectedItem.price }}</span></p>
            <!-- Carousel for images -->
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img :src="'/storage/service_images/'+selectedItem.mainimage" class="d-block w-100" alt="First slide" style="height:350px !important;">
                </div>
                <div class="carousel-item active">
                  <img :src="'/storage/service_images/'+selectedItem.firstimage" class="d-block w-100" alt="First slide" style="height:350px !important;">
                </div>
                <div class="carousel-item">
                  <img :src="'/storage/service_images/'+selectedItem.secondimage" class="d-block w-100" alt="Second slide" style="height:350px !important;">
                </div>
                <!-- Add more carousel items here for additional images -->
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next" >
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
        </div>
        </div>
        </div>
        <!--Edit form-->
        <div class="col-12 col-md-6">
          <div class="card mt-4">
          <div class="card-header" style="background-color:#ff6600; color:white;">
            Update Your Service
          </div>
          <div class="card-body">
            <form @submit.prevent="UpdateService">
              <div class="log-form">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="What Service do offer?" v-model="servicetitle"  style="border: 1px solid rgb(32 48 102) !important;">
                      <span class="text-danger text-small">{{ formErrors.servicetitle}}</span>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control"  placeholder="How much do you charge?" v-model="price" style="border: 1px solid rgb(32 48 102) !important;">
                      <span class="text-danger text-small">{{ formErrors.price}}</span>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control"  placeholder="Choose category of service" v-model="category" style="border: 1px solid rgb(32 48 102) !important;">
                      <span class="text-danger text-small">{{ formErrors.category}}</span>
                    </div>
                    <div class="form-group">
                      <label class="col-form-label">Main Image</label>
                      <input type="file" class="form-control" name="mainimage"   @change="onFileChange" style="border: 1px solid rgb(32 48 102) !important;">
                      <span class="text-danger text-small">{{ formErrors.mainimage}}</span>
                    </div>
                    <div class="form-group">
                      <label class="col-form-label">Description Image</label>
                      <input type="file" class="form-control" name="descriptionimage"  @change="onFileChange" style="border: 1px solid rgb(32 48 102) !important;">
                      <span class="text-danger text-small">{{ formErrors.descriptionimage}}</span>
                    </div>
                    <div class="form-group">
                      <label class="col-form-label">Description Image2</label>
                      <input type="file" class="form-control" name="descriptionimage2"   @change="onFileChange" style="border: 1px solid rgb(32 48 102) !important;">
                      <span class="text-danger text-small">{{ formErrors.descriptionimage2}}</span>
                    </div>
                    <div class="form-group">
                      <label class="col-form-label">Description</label>
                      <textarea class="form-control"  placeholder="A good description of what you do can get you many customers." v-model="description" style="border: 1px solid rgb(32 48 102) !important;"></textarea>
                      <span class="text-danger text-small">{{ formErrors.description}}</span>
                    </div>
                   
                  <!-- Success and error messages -->
                  <div class="message-container">
                    <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
                    <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>
                  </div>
                  <!-- End of Success and error messages -->
                    <div class="form-group">
                      <button class="btn w-100 login-btn" type="submit" style="background-color:rgb(32 48 102); color: white;" :disabled="loading">
                        <span v-if="loading" class="spinner-border spinner-border-sm ml-2" role="status" aria-hidden="true"></span>
                        <span v-else>Update</span>
                      </button>
                  </div>
                </div>
            </form>
          </div>
        </div>
        </div>
         <!--End of Edit form-->
      </div>
      </div>
      
    </div>
  </div>
</div>
  </div>

  <!--Add Services Model-->
  <div class="modal" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-header" style="background-color:#ff6600; color:white;">
            Add Service
          </div>
          <div class="card-body">
            <form @submit.prevent="AddService">
              <div class="log-form">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="What Service do offer?" v-model="servicetitle"  style="border: 1px solid rgb(32 48 102) !important;">
                      <span class="text-danger text-small">{{ formErrors.servicetitle}}</span>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control"  placeholder="How much do you charge?" v-model="price" style="border: 1px solid rgb(32 48 102) !important;">
                      <span class="text-danger text-small">{{ formErrors.price}}</span>
                    </div>
                    <div class="form-group">
                    <select v-model="category" class="form-control">
                    <option value="" style="border: 1px solid #ff6600;">Select a Category</option>
                    <option v-for="activecategory in allCategory" :key="activecategory.id" :value="activecategory.id">
                       {{ activecategory.name }}
                    </option>
                    <span class="text-danger text-small">{{ formErrors.category}}</span>
                      </select>
                      </div>
                    <div class="form-group">
                      <label class="col-form-label">Main Image</label>
                      <input type="file" class="form-control" name="mainimage"   @change="onFileChange" style="border: 1px solid rgb(32 48 102) !important;">
                      <span class="text-danger text-small">{{ formErrors.mainimage}}</span>
                    </div>
                    <div class="form-group">
                      <label class="col-form-label">Description Image</label>
                      <input type="file" class="form-control" name="descriptionimage"  @change="onFileChange" style="border: 1px solid rgb(32 48 102) !important;">
                      <span class="text-danger text-small">{{ formErrors.descriptionimage}}</span>
                    </div>
                    <div class="form-group">
                      <label class="col-form-label">Description Image2</label>
                      <input type="file" class="form-control" name="descriptionimage2"   @change="onFileChange" style="border: 1px solid rgb(32 48 102) !important;">
                      <span class="text-danger text-small">{{ formErrors.descriptionimage2}}</span>
                    </div>
                    <div class="form-group">
                      <label class="col-form-label">Description</label>
                      <textarea class="form-control"  placeholder="A good description of what you do can get you many customers." v-model="description" style="border: 1px solid rgb(32 48 102) !important;"></textarea>
                      <span class="text-danger text-small">{{ formErrors.description}}</span>
                    </div>
                    
                    
                  <!-- Success and error messages -->
                  <div class="message-container">
                    <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
                    <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>
                  </div>
                  <!-- End of Success and error messages -->
                    <div class="form-group">
                      <button class="btn w-100 login-btn" type="submit" style="background-color:rgb(32 48 102); color: white;" :disabled="loading">
                        <span v-if="loading" class="spinner-border spinner-border-sm ml-2" role="status" aria-hidden="true"></span>
                        <span v-else>Add</span>
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
                Are you sure you want to delete this service?
            </div>
             <!-- Success and error messages -->
             <div class="message-container">
                    <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
                    <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>
                  </div>
                  <!-- End of Success and error messages -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">No</button>
                <button type="button" class="btn btn-danger" @click="deleteServiceConfirmed">
                  <span v-if="deleting" class="spinner-border spinner-border-sm ml-2" role="status" aria-hidden="true" style="color:red;"></span>
                  <span>Yes</span>
                </button>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import userNavbar from '@/components/layouts/usernavbar.vue';
import axios from 'axios';
import {Bootstrap4Pagination} from 'laravel-vue-pagination'; // Make sure vuejs-paginator is correctly installed and imported

export default {
  name: 'myservices',
  components: {
    userNavbar,
    Bootstrap4Pagination,
  },
  data() {
    return {
      servicetitle: '',
      price: '',
      category: '',
      serviceId:'',
      description: '',
      mainimage: null,
      descriptionimage:null,
      descriptionimage2:null,
      errorMessage: '',
      successMessage: '',
      ProvidersItems:{data: [] },
      loading: false,
      deleting:false,
      paginationOptions: {
        wrapperClass: 'pagination float-right',
        current: 1,
        total: 0,
        perPage: 8,
        visiblePages: 5,
        allCategory :{}, 
      },
      selectedItem: null, // Track the selected item for modal display
      formErrors: {} // Define formErrors object here
    };
  },
  methods: {
    async fetchProvidersItems(page = 1) {
            try {
              this.loading = true;
              //console.log('Fetching providers items...');
              // Ensure the URL starts with a forward slash to make it absolute
              const response = await axios.get(`/api/myservice?page=${page}`);
              this.ProvidersItems = response.data;
            } catch (error) {
              console.error('Error fetching providers items:', error);
            } finally {
              this.loading = false;
            }
        },
     openItemModal(id) {
              this.selectedItem = this.ProvidersItems.data.find(item => item.id === id);
              $('#itemModal').modal('show'); // Show the modal using jQuery
            },

    onFileChange(event) {
  // Check which input field triggered the change event
  const fieldName = event.target.name;

  // Assign the file to the appropriate field
  if (fieldName === 'mainimage') {
    this.mainimage = event.target.files[0];
  } else if (fieldName === 'descriptionimage') {
    this.descriptionimage = event.target.files[0];
  } else if (fieldName === 'descriptionimage2') {
    this.descriptionimage2 = event.target.files[0];
  }
    },
    async AddService() {
  try {
    // Reset error messages and loading state
    this.formErrors = {};
    this.errorMessage = '';
    this.successMessage = '';
    this.loading = true;
    
    // Create form data
    const formData = new FormData();
    formData.append('servicetitle', this.servicetitle);
    formData.append('price', this.price);
    formData.append('category', this.category);
    formData.append('description', this.description);
    formData.append('mainimage', this.mainimage);
    formData.append('descriptionimage', this.descriptionimage);
    formData.append('descriptionimage2', this.descriptionimage2);

    // Submit registration data
    const response = await axios.post('/api/myservice', formData, {
      headers: { 'Content-Type': 'multipart/form-data' }
    });

    // Show success message
    this.successMessage = 'Service was Successfully added.';

    // Reset form fields
    this.servicetitle = '';
    this.price = '';
    this.category = '';
    this.description = '';
    this.mainimage = null;
    this.descriptionimage = null;
    this.descriptionimage2 = null;

    await this.fetchProvidersItems();
  } catch (error) {
    //console.error('Error adding services:', error);
    if (error.response && error.response.status === 422) {
      // Handle validation errors
      const errors = error.response.data.errors;
      Object.keys(errors).forEach(field => {
        this.formErrors[field] = errors[field][0];
      });
    } else if (error.response && error.response.status === 401) {
      // Handle exceeding maximum services
      this.errorMessage = 'Sorry, you can\'t add more than 2 services';
    } else {
      // Handle other types of errors
      this.errorMessage = 'Services Failed. Please try again later.';
    }
  } finally {
    // Set loading state to false after submission attempt
    this.loading = false;
  }
},
async UpdateService() {
  try {
    // Reset error messages and loading state
    this.formErrors = {};
    this.errorMessage = '';
    this.successMessage = '';
    this.loading = true;
    
    // Create form data
    const formData = new FormData();
    formData.append('serviceId', this.selectedItem.id); // Include the ID
    formData.append('servicetitle', this.servicetitle);
    formData.append('price', this.price);
    formData.append('category', this.category);
    formData.append('description', this.description);
    formData.append('mainimage', this.mainimage);
    formData.append('descriptionimage', this.descriptionimage);
    formData.append('descriptionimage2', this.descriptionimage2);
    
    // Submit registration data
    const response = await axios.post('/api/updateservice', formData, {
      headers: { 'Content-Type': 'multipart/form-data' }
    });

    // Show success message
    this.successMessage = 'Service update was Successful.';

    // Reset form fields
    this.servicetitle = '';
    this.price = '';
    this.category = '';
    this.description = '';
    this.mainimage = null;
    this.descriptionimage = null;
    this.descriptionimage2 = null;

    await this.fetchProvidersItems();
  } catch (error) {
    if (error.response && error.response.status === 422) {
      // Handle validation errors
      const errors = error.response.data.errors;
      Object.keys(errors).forEach(field => {
        this.$set(this.formErrors, field, errors[field][0]);
      });
    } else {
      // Handle other types of errors
      this.errorMessage = 'Service Update Failed. Please try again later.';
    }
  } finally {
    // Set loading state to false after submission attempt
    this.loading = false;
  }
},
showDeleteConfirmation(serviceId) {
    const service = this.ProvidersItems.data.find(item => item.id === serviceId);
    if (service) {
        this.selectedServiceId = service.id;
        $('#confirmationModal').modal('show');
    } else {
        console.error('Service not found:', serviceId);
    }
},

deleteServiceConfirmed() {
    // Perform deletion using the stored service ID
    this.deleting = true;
    axios.post('/api/deleteservice', { service_id: this.selectedServiceId })
        .then(response => {
            // Handle success response
            this.successMessage = 'Service deleted successfully.';
            // Update the service list by removing the deleted service
            this.ProvidersItems.data = this.ProvidersItems.data.filter(service => service.id !== this.selectedServiceId);
        })
        .catch(error => {
            // Handle error
            this.errorMessage = 'Service deletion failed. Please try again later.';
            console.error('Error deleting service:', error);
        })
        .finally(() => {
            // Reset loading state or perform other necessary cleanup
            this.deleting = false;
            // Hide the modal
            $('#confirmationModal').modal('hide');
        });
},

async fetchCategories(){
        const response = await axios.get('/api/categories');
    // Assuming response.data.subscriptions contains user subscriptions
        this.allCategory = response.data.categories;
    },
           
  },
          mounted() {
            document.title = 'My Services | Kojax Services';
            this.fetchCategories();
            this.fetchProvidersItems();
          },
        }

</script>


