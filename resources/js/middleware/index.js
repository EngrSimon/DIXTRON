// middleware.js

// Middleware function to require authentication
export function requireAuth(to, from, next) {
    // Check if the user is authenticated
    if (!localStorage.getItem('token')) {
        // Redirect to the login page if not authenticated
        next('/login');
    } else {
        // Continue to the next route if authenticated
        next();
    }
}

// Middleware function to require admin authentication
export function requireAdminAuth(to, from, next) {
    // Check if the user is authenticated and is an admin
    if (!localStorage.getItem('token') || localStorage.getItem('role') !== 'admin') {
        // Redirect to the login page if not authenticated or not an admin
        next('/login');
    } else {
        // Continue to the next route if authenticated and is an admin
        next();
    }
}

// Middleware function to prevent provider access to admin routes
export function preventProviderAccess(to, from, next) {
    // Check if the user is authenticated and is a provider
    if (localStorage.getItem('token') && localStorage.getItem('role') === 'provider') {
        // Redirect to the dashboard or any other appropriate route for providers
        next('/dashboard');
    } else {
        // Continue to the next route if not a provider
        next();
    }
}
