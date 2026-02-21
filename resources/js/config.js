/* =======================
   GLOBAL CONFIG
======================= */

export const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    ?.getAttribute("content");

export const getSubmissionUrl = () => window.SUBMISSION_STORE_URL;
