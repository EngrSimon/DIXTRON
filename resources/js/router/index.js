import { createRouter, createWebHashHistory } from 'vue-router';
import { createStore } from 'vuex';
// Import middleware functions
import { requireAuth, requireAdminAuth, preventProviderAccess } from '@/middleware/index.js';

// Import components
import Home from '@/components/frontend/home.vue';
import Services from '@/components/frontend/services.vue';
import About from '@/components/frontend/aboutus.vue';
import Contact from '@/components/frontend/contact.vue';
import Search from '@/components/frontend/search.vue';
import Login from '@/components/auth/login.vue';
import Register from '@/components/auth/register.vue';
import ForgetPassword from '@/components/auth/forgetpassword.vue';
import PasswordResetForm from '@/components/auth/resetform.vue';

//User Routes
import DashBoard from '@/components/users/dashboard.vue';
import UserServices from '@/components/users/myservices.vue';
import Profile from '@/components/users/profile.vue';
import Subscription from '@/components/users/subscriptions.vue';
import Verification from '@/components/users/verification.vue';

// Admin Routes
import AdminDashboard from '@/components/admin/dashboard.vue';
import AdminSubscriptions from '@/components/admin/adminsubscription.vue';
import AdminContacts from '@/components/admin/admincontact.vue';
import AdminServices from '@/components/admin/adminservice.vue';
import AdminProviders from '@/components/admin/adminprovider.vue';
import AdminPlans from '@/components/admin/plan.vue';
import AdminCategory from '@/components/admin/category.vue';

const routes = [
    // Public Routes
    { path: '/', component: Home },
    { path: '/services', component: Services },
    { path: '/aboutus', component: About },
    { path: '/contactus', component: Contact },
    { path: '/search', name: 'search', component: Search },
    { path: '/login', component: Login },
    { path: '/forgotpassword', component: ForgetPassword },
    { path: '/resetpasswordform', component: PasswordResetForm },
    { path: '/register', component: Register },
  
    // User Routes
    { path: '/dashboard', component: DashBoard, meta: { requiresAuth: true } },
    { path: '/profile', component: Profile, meta: { requiresAuth: true } },
    { path: '/subscription', component: Subscription, meta: { requiresAuth: true } },
    { path: '/myservice', component: UserServices, meta: { requiresAuth: true } },
    { path: '/verification', component: Verification, meta: { requiresAuth: true } },

    // Admin Routes
    { path: '/admin', component: AdminDashboard, meta: { requiresAdmin: true } },
    { path: '/adminsubscriptions', component: AdminSubscriptions, meta: { requiresAdmin: true } },
    { path: '/admincontacts', component: AdminContacts, meta: { requiresAdmin: true } },
    { path: '/adminservices', component: AdminServices, meta: { requiresAdmin: true } },
    { path: '/providers', component: AdminProviders, meta: { requiresAdmin: true, preventProviderAccess: true } },
    { path: '/plans', component: AdminPlans, meta: { requiresAdmin: true, preventProviderAccess: true } },
    { path: '/category', component: AdminCategory, meta: { requiresAdmin: true, preventProviderAccess: true } },
  
    { path: '/:pathMatch(.*)*', component: Home } // Catch-all route
  ];
  
  const router = createRouter({
    history: createWebHashHistory(),
    routes
  });
  
  router.beforeEach(async (to, from, next) => {
    // Check if the route requires authentication
    if (to.meta.requiresAuth) {
      try {
        // Make a request to check authentication state
        const response = await axios.get('/api/verify');
        const authenticated = response.data.authenticated;
  
        // If authenticated, proceed to the route
        if (authenticated) {
          next();
        } else {
          // If not authenticated, redirect to the login page
          next('/login');
        }
      } catch (error) {
        // Handle errors
        console.error('Error checking authentication:', error);
        next('/login');
      }
    } else if (to.meta.requiresAdmin) {
      try {
        // Make a request to check if the user is an admin
        const response = await axios.get('/api/checkAdmin');
        const isAdmin = response.data.isAdmin;
  
        // If user is an admin, proceed to the route
        if (isAdmin) {
          next();
        } else {
          // If not an admin, redirect to the login page
          next('/login');
        }
      } catch (error) {
        // Handle errors
        console.error('Error checking admin status:', error);
        next('/login');
      }
    } else if (to.meta.preventProviderAccess) {
      try {
        // Make a request to check if the user is a provider
        const response = await axios.get('/api/checkProvider');
        const isProvider = response.data.isProvider;
  
        // If user is a provider, prevent access to admin route and redirect to user dashboard
        if (isProvider) {
          next('/dashboard');
        } else {
          next();
        }
      } catch (error) {
        // Handle errors
        console.error('Error checking provider status:', error);
        next('/login');
      }
    } else {
      // For other routes, proceed without authentication
      next();
    }
  });
  
  const store = createStore({
    // Vuex store configuration...
});

export { router, store };