import "./bootstrap";

/* =======================
   IMPORT MODULES
======================= */
import { submitForm } from "./form-handler.js";
import { cekStatus } from "./tracking.js";
import { tutupModal } from "./modal.js";
import { initCounters } from "./counter.js";
import { initDynamicForm } from "./dynamic-form.js";
import { initSmoothScroll } from "./smooth-scroll.js";
import { initReveal } from "./animations.js";

/* =======================
   EXPORT TO GLOBAL WINDOW
======================= */
window.submitForm = submitForm;
window.cekStatus = cekStatus;
window.tutupModal = tutupModal;

/* =======================
   INITIALIZE ON DOM READY
======================= */
document.addEventListener("DOMContentLoaded", () => {
    initCounters();
    initDynamicForm();
    initSmoothScroll(65);
    initReveal();
});
