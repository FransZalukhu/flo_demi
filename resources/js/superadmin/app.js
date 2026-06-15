// Main Application JavaScript

// Import components
import { initFormValidation } from "./components/form-validation.js";
import { initAllDataTables } from "./components/datatables.js";

// Initialize on DOM ready
document.addEventListener("DOMContentLoaded", () => {
    // Initialize custom components
    initFormValidation();
    initAllDataTables();
});
