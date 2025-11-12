<?php
$page_title = 'Change Password - travelNepal Admin';
$page_description = 'Change your admin password securely.';

ob_start();
?>

<!-- Include Admin Sidebar -->
<?php include __DIR__ . '/../components/admin-sidebar.php'; ?>

<!-- Main Content Area (with sidebar padding) -->
<div class="lg:ml-64">

<!-- Page Header -->
<div class="bg-gradient-to-r from-nepal-500 to-nepal-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center animate-fade-in-down">
            <i class="fas fa-key text-3xl mr-4"></i>
            <div>
                <h1 class="text-3xl font-display font-bold mb-2">Change Password</h1>
                <p class="opacity-90">Update your admin account password</p>
            </div>
        </div>
    </div>
</div>

<!-- Password Change Form -->
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-fade-in-up">
        <div class="px-8 py-6 bg-mountain-50 border-b border-mountain-200">
            <h2 class="text-xl font-bold text-mountain-800 flex items-center">
                <i class="fas fa-shield-alt mr-3 text-nepal-600"></i>
                Security Settings
            </h2>
            <p class="text-mountain-600 mt-2">Update your password to keep your account secure</p>
        </div>

        <div class="p-8">
            <!-- Success/Error Messages -->
            <?php if (isset($error)): ?>
            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4 animate-fade-in-down">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i>
                    <span class="text-red-700"><?php echo htmlspecialchars($error); ?></span>
                </div>
            </div>
            <?php endif; ?>

            <?php if (isset($success)): ?>
            <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4 animate-fade-in-down">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    <span class="text-green-700"><?php echo htmlspecialchars($success); ?></span>
                </div>
            </div>
            <?php endif; ?>

            <!-- Password Requirements Info -->
            <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <h3 class="font-semibold text-blue-800 mb-2 flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    Password Requirements
                </h3>
                <ul class="text-blue-700 text-sm space-y-1">
                    <li>• Minimum 8 characters long</li>
                    <li>• Must be different from your current password</li>
                    <li>• Use a strong, unique password</li>
                </ul>
            </div>

            <!-- Change Password Form -->
            <form method="POST" action="<?php echo siteUrl('admin/change-password'); ?>" class="space-y-6" id="change-password-form">
                <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">

                <!-- Current Password -->
                <div>
                    <label for="current_password" class="block text-sm font-medium text-mountain-700 mb-2">
                        <i class="fas fa-lock mr-2"></i>Current Password
                    </label>
                    <div class="relative">
                        <input type="password" 
                               id="current_password" 
                               name="current_password" 
                               required 
                               class="w-full px-4 py-3 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent transition-all duration-200 bg-mountain-50 focus:bg-white pr-12"
                               placeholder="Enter your current password"
                               autocomplete="current-password">
                        <button type="button" 
                                class="absolute inset-y-0 right-0 flex items-center px-4 text-mountain-400 hover:text-mountain-600"
                                onclick="togglePasswordVisibility('current_password', 'current-toggle')">
                            <i class="fas fa-eye" id="current-toggle"></i>
                        </button>
                    </div>
                </div>

                <!-- New Password -->
                <div>
                    <label for="new_password" class="block text-sm font-medium text-mountain-700 mb-2">
                        <i class="fas fa-key mr-2"></i>New Password
                    </label>
                    <div class="relative">
                        <input type="password" 
                               id="new_password" 
                               name="new_password" 
                               required 
                               minlength="8"
                               class="w-full px-4 py-3 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent transition-all duration-200 bg-mountain-50 focus:bg-white pr-12"
                               placeholder="Enter your new password"
                               autocomplete="new-password">
                        <button type="button" 
                                class="absolute inset-y-0 right-0 flex items-center px-4 text-mountain-400 hover:text-mountain-600"
                                onclick="togglePasswordVisibility('new_password', 'new-toggle')">
                            <i class="fas fa-eye" id="new-toggle"></i>
                        </button>
                    </div>
                    <!-- Password strength indicator -->
                    <div class="mt-2">
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div id="password-strength" class="h-2 rounded-full transition-all duration-300" style="width: 0%;"></div>
                        </div>
                        <p id="password-strength-text" class="text-sm text-mountain-500 mt-1">Password strength</p>
                    </div>
                </div>

                <!-- Confirm New Password -->
                <div>
                    <label for="confirm_password" class="block text-sm font-medium text-mountain-700 mb-2">
                        <i class="fas fa-check-double mr-2"></i>Confirm New Password
                    </label>
                    <div class="relative">
                        <input type="password" 
                               id="confirm_password" 
                               name="confirm_password" 
                               required 
                               class="w-full px-4 py-3 border border-mountain-200 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-transparent transition-all duration-200 bg-mountain-50 focus:bg-white pr-12"
                               placeholder="Confirm your new password"
                               autocomplete="new-password">
                        <button type="button" 
                                class="absolute inset-y-0 right-0 flex items-center px-4 text-mountain-400 hover:text-mountain-600"
                                onclick="togglePasswordVisibility('confirm_password', 'confirm-toggle')">
                            <i class="fas fa-eye" id="confirm-toggle"></i>
                        </button>
                    </div>
                    <div id="password-match-indicator" class="mt-2 text-sm"></div>
                </div>

                <!-- Form Actions -->
                <div class="flex space-x-4 pt-6">
                    <a href="<?php echo siteUrl('admin/dashboard'); ?>" 
                       class="flex-1 bg-mountain-200 text-mountain-700 py-3 px-6 rounded-lg hover:bg-mountain-300 transition-colors text-center font-medium">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Cancel
                    </a>
                    <button type="submit" 
                            id="submit-btn"
                            class="flex-1 bg-gradient-to-r from-nepal-500 to-nepal-600 hover:from-nepal-600 hover:to-nepal-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                        <i class="fas fa-save mr-2"></i>
                        Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>

<script>
// Toggle password visibility
function togglePasswordVisibility(inputId, iconId) {
    const passwordInput = document.getElementById(inputId);
    const toggleIcon = document.getElementById(iconId);
    
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

// Password strength checker
function checkPasswordStrength(password) {
    let strength = 0;
    let feedback = '';
    
    if (password.length >= 8) strength += 25;
    if (password.length >= 12) strength += 25;
    if (/[A-Z]/.test(password)) strength += 15;
    if (/[a-z]/.test(password)) strength += 15;
    if (/[0-9]/.test(password)) strength += 10;
    if (/[^A-Za-z0-9]/.test(password)) strength += 10;
    
    const strengthBar = document.getElementById('password-strength');
    const strengthText = document.getElementById('password-strength-text');
    
    if (strength < 40) {
        strengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-red-500';
        feedback = 'Weak password';
    } else if (strength < 70) {
        strengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-yellow-500';
        feedback = 'Fair password';
    } else if (strength < 90) {
        strengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-blue-500';
        feedback = 'Good password';
    } else {
        strengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-green-500';
        feedback = 'Strong password';
    }
    
    strengthBar.style.width = Math.min(strength, 100) + '%';
    strengthText.textContent = feedback;
}

// Password match checker
function checkPasswordMatch() {
    const newPassword = document.getElementById('new_password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    const indicator = document.getElementById('password-match-indicator');
    
    if (confirmPassword === '') {
        indicator.textContent = '';
        return;
    }
    
    if (newPassword === confirmPassword) {
        indicator.innerHTML = '<i class="fas fa-check text-green-500 mr-1"></i><span class="text-green-600">Passwords match</span>';
    } else {
        indicator.innerHTML = '<i class="fas fa-times text-red-500 mr-1"></i><span class="text-red-600">Passwords do not match</span>';
    }
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    const newPasswordInput = document.getElementById('new_password');
    const confirmPasswordInput = document.getElementById('confirm_password');
    
    newPasswordInput.addEventListener('input', function() {
        checkPasswordStrength(this.value);
        checkPasswordMatch();
    });
    
    confirmPasswordInput.addEventListener('input', checkPasswordMatch);
    
    // Form submission handler
    document.getElementById('change-password-form').addEventListener('submit', function(e) {
        const btn = document.getElementById('submit-btn');
        const newPassword = document.getElementById('new_password').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        
        // Validate passwords match
        if (newPassword !== confirmPassword) {
            e.preventDefault();
            alert('Passwords do not match. Please check and try again.');
            return;
        }
        
        // Show loading state
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Updating Password...';
        btn.disabled = true;
        
        // Reset loading state if form validation fails
        setTimeout(function() {
            btn.innerHTML = originalText;
            btn.disabled = false;
        }, 3000);
    });
});
</script>

<?php
$content = ob_get_contents();
ob_end_clean();
include TEMPLATES_PATH . '/admin-layout.php';
?>