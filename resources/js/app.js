import './bootstrap';

// Import Bootstrap JS (Required for Toasts/Modals to work)
import * as bootstrap from 'bootstrap';

// Make bootstrap available globally (Optional but good for debugging)
window.bootstrap = bootstrap;

// Initialize Toasts when DOM is loaded
document.addEventListener('DOMContentLoaded', function () {
    // Hanapin lahat ng elements na may class na '.toast'
    var toastElList = [].slice.call(document.querySelectorAll('.toast'));
    
    // Loop sa bawat isa at i-activate gamit ang Bootstrap API
    var toastList = toastElList.map(function (toastEl) {
        var toast = new bootstrap.Toast(toastEl, { 
            delay: 5000, // 5 Seconds bago mawala
            animation: true
        });
        toast.show(); 
        return toast;
    });
});

// TOGGLE PASSWORD VISIBILITY
document.addEventListener('DOMContentLoaded', function () {
    // Hanapin lahat ng elements na may class na .toggle-password
    const toggleIcons = document.querySelectorAll('.toggle-password');

    toggleIcons.forEach(function (icon) {
        icon.addEventListener('click', function () {
            // Hanapin ang input field na katabi ng icon (previous sibling)
            const input = this.previousElementSibling;
            
            // Toggle type
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);

            // Toggle Icon Class (Eye vs Eye Slash)
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    });
});

// DATATABLES INITIALIZATION
document.addEventListener('DOMContentLoaded', function () {
    // Check kung may element na '.datatable' sa page bago i-run
    // Gumamit tayo ng interval check para siguraduhing loaded na ang jQuery CDN
    const checkJquery = setInterval(() => {
        if (window.jQuery && window.$.fn.DataTable) {
            clearInterval(checkJquery);
            
            // Run DataTables
            if ($('.datatable').length > 0) {
                $('.datatable').DataTable({
                    "order": [], // Disable initial sorting
                    "language": {
                        "search": "Filter records:",
                        "lengthMenu": "Show _MENU_ entries"
                    }
                });
            }
        }
    }, 100); // Check every 100ms
});

// TOGGLE PASSWORD VISIBILITY 
document.addEventListener('DOMContentLoaded', function () {
    const toggleIcons = document.querySelectorAll('.toggle-password');

    toggleIcons.forEach(function (icon) {
        icon.addEventListener('click', function () {
            // Hanapin ang parent container (.input-group)
            const inputGroup = this.closest('.input-group');
            
            // Sa loob ng container, hanapin ang input tag
            const input = inputGroup.querySelector('input');
            
            if (input) {
                // Toggle type: password <-> text
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);

                // Toggle Icon: Eye <-> Eye Slash
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            }
        });
    });
});

// TOAST INITIALIZATION
document.addEventListener('DOMContentLoaded', function () {
    var toastElList = [].slice.call(document.querySelectorAll('.toast'));
    var toastList = toastElList.map(function (toastEl) {
        // Auto-show toast with 5 seconds delay
        var toast = new bootstrap.Toast(toastEl, { delay: 5000 });
        toast.show();
        return toast;
    });
});

// STOCK MODAL LOGIC (Dynamic Content)
document.addEventListener('DOMContentLoaded', function () {
    const stockModal = document.getElementById('stockModal');
    
    if (stockModal) {
        stockModal.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget;
            
            // Extract info from data-* attributes
            const productId = button.getAttribute('data-id');
            const productName = button.getAttribute('data-name');
            const type = button.getAttribute('data-type'); // 'in' or 'out'

            // Elements to update
            const modalTitle = document.getElementById('modal_title');
            const modalHeader = document.getElementById('modal_header_bg');
            const submitBtn = document.getElementById('modal_submit_btn');
            const hiddenId = document.getElementById('modal_product_id');
            const hiddenType = document.getElementById('modal_type');
            const nameLabel = document.getElementById('modal_product_name');

            // Set Values
            hiddenId.value = productId;
            hiddenType.value = type;
            nameLabel.textContent = productName;

            // Update UI based on Type
            if (type === 'in') {
                modalTitle.textContent = 'Stock IN (Add)';
                modalHeader.className = 'modal-header text-dark bg-light'; 
                submitBtn.className = 'btn btn-primary px-4';
                submitBtn.textContent = 'Add Stock';
            } else {
                modalTitle.textContent = 'Stock OUT (Deduct)';
                modalHeader.className = 'modal-header text-dark bg-light'; 
                submitBtn.className = 'btn btn-danger px-4';
                submitBtn.textContent = 'Deduct Stock';
            }
        });
    }
});

// RESTOCK MODAL LOGIC
document.addEventListener('DOMContentLoaded', function () {
    const restockModal = document.getElementById('restockModal');
    
    if (restockModal) {
        restockModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const productId = button.getAttribute('data-id');
            const productName = button.getAttribute('data-name');

            document.getElementById('restock_product_id').value = productId;
            document.getElementById('restock_product_name').textContent = productName;
        });
    }
});