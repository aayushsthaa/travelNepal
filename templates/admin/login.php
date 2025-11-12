<?php
$page_title = 'Admin Login - travelNepal';
$page_description = 'Admin access to travelNepal content management system.';

ob_start();
?>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-nepal-50 to-mountain-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Header -->
        <div class="text-center animate-fade-in-down">
            <div class="flex items-center justify-center mb-6">
                <img src="<?php echo SITE_URL; ?>/assets/images/logo.svg" alt="logo" class="w-20 h-20">
                <div>
                    <h2 class="text-3xl font-display font-bold text-gradient">Admin Portal</h2>
                </div>
            </div>
            <p class="mt-2 text-mountain-600">
                Sign in to manage your travel content
            </p>
        </div>

        <!-- Login Form -->
        <div class="bg-white rounded-2xl shadow-2xl p-8 animate-fade-in-up">
            <?php if (isset($error)): ?>
            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i>
                    <span class="text-red-700"><?php echo htmlspecialchars($error); ?></span>
                </div>
            </div>
            <?php endif; ?>

            <?php if (isset($success)): ?>
            <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    <span class="text-green-700"><?php echo htmlspecialchars($success); ?></span>
                </div>
            </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo siteUrl('admin/login'); ?>" class="space-y-6" id="login-form">
                <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                <div>
                    <label for="username" class="block text-sm font-medium text-mountain-700 mb-2">
                        <i class="fas fa-user mr-2"></i>Username
                    </label>
                    <input type="text" 
                           id="username" 
                           name="username" 
                           required 
                           class="w-full px-4 py-3 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent transition-all duration-200 bg-mountain-50 focus:bg-white"
                           placeholder="Enter your username"
                           autocomplete="username">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-mountain-700 mb-2">
                        <i class="fas fa-lock mr-2"></i>Password
                    </label>
                    <div class="relative">
                        <input type="password" 
                               id="password" 
                               name="password" 
                               required 
                               class="w-full px-4 py-3 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent transition-all duration-200 bg-mountain-50 focus:bg-white pr-12"
                               placeholder="Enter your password"
                               autocomplete="current-password">
                        <button type="button" 
                                class="absolute inset-y-0 right-0 flex items-center px-4 text-mountain-400 hover:text-mountain-600"
                                onclick="togglePassword()">
                            <i class="fas fa-eye" id="password-toggle"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" 
                               id="remember" 
                               name="remember" 
                               class="h-4 w-4 text-nepal-600 focus:ring-nepal-500 border-mountain-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-mountain-700">
                            Remember me
                        </label>
                    </div>
                    <div class="text-sm">
                        <a href="#" class="text-nepal-600 hover:text-nepal-500">
                            Forgot password?
                        </a>
                    </div>
                </div>

                <button type="submit" 
                        class="w-full bg-gradient-to-r from-nepal-500 to-nepal-600 hover:from-nepal-600 hover:to-nepal-700 text-white font-semibold px-8 py-3 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg text-center justify-center"
                        id="login-btn">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Sign In
                </button>
            </form>

        </div>

        <!-- Footer -->
        <div class="text-center animate-fade-in-up">
            <p class="text-mountain-500 text-sm">
                &copy; 2025 travelNepal. All rights reserved.
            </p>
            <a href="<?php echo siteUrl(); ?>" class="text-nepal-600 hover:text-nepal-500 text-sm font-medium">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Website
            </a>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('password-toggle');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}

document.getElementById('login-form').addEventListener('submit', function(e) {
    const btn = document.getElementById('login-btn');
    
    // Show loading state
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Signing In...';
    btn.disabled = true;
    
    // Reset loading state after form submission
    setTimeout(function() {
        btn.innerHTML = originalText;
        btn.disabled = false;
    }, 2000);
});

// Add floating label effect
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('input[type="text"], input[type="password"]');
    
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('focused');
            }
        });
    });
});
</script>

<style>
.focused label {
    transform: translateY(-0.5rem);
    font-size: 0.75rem;
    color: #ed703f;
}
</style>

<?php
$content = ob_get_contents();
ob_end_clean();
include TEMPLATES_PATH . '/admin-layout.php';
?>