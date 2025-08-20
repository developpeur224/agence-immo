import './bootstrap';
import './base';

// Import complet de Bootstrap (JS + composants accessibles)
import * as bootstrap from 'bootstrap';

// Tom Select
import TomSelect from "tom-select";

// Initialisation automatique des <select multiple>
document.addEventListener('DOMContentLoaded', function () {
    const multiSelects = document.querySelectorAll('select[multiple]');
    if (multiSelects.length > 0) {
        multiSelects.forEach(select => {
            try {
                new TomSelect(select, {
                    plugins: ['remove_button'],
                    placeholder: 'Sélectionnez...',
                });
            } catch (e) {
                console.error('Erreur initialisation TomSelect:', e);
            }
        });
    }

    // Initialisation des toasts Bootstrap
    document.querySelectorAll('.toast').forEach(toastEl => {
        new bootstrap.Toast(toastEl, {
            autohide: true,
            delay: 5000
        }).show();
    });
});
