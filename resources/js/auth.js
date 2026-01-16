export function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password');
    const icon = document.getElementById('passwordToggleIcon');
    
    if (passwordInput && icon) {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
}

// Attach the function to the window object or use event listeners
// For simplicity in migration, we can attach to window if inline onclick is used,
// OR (Better) attach event listener if we can identify the button.
// The button has onclick="togglePasswordVisibility()" in blade.
// To keep it working without changing blade too much, we can attach to window.
window.togglePasswordVisibility = togglePasswordVisibility;
