/* =======================
   SUBMIT FORM - FIXED
======================= */

import { csrfToken, getSubmissionUrl } from "./config.js";

export function submitForm() {
    const form = document.getElementById("layananForm");
    const submitBtn = document.getElementById("submitBtn");

    if (!form || submitBtn.disabled) return;

    // ✅ FIX 1: Validasi form sebelum submit
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    // Disable button & show loading
    submitBtn.disabled = true;
    submitBtn.classList.add("opacity-70");

    // ✅ FIX 2: SVG spinner yang benar (lengkap dengan path)
    submitBtn.innerHTML = `
        <span class="flex items-center gap-2 justify-center">
            <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Mengirim...</span>
        </span>
    `;

    const formData = new FormData(form);

    fetch(getSubmissionUrl(), {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
        body: formData,
    })
        .then(async (res) => {
            const data = await res.json();
            if (!res.ok) throw data;
            return data;
        })
        .then((data) => {
            // Tampilkan kode di modal
            document.getElementById("kodeUnik").innerText = data.code;
            document.getElementById("modalKode").classList.remove("hidden");
            document.getElementById("modalKode").classList.add("flex");

            // Reset form
            form.reset();

            // Reset warna select ke default
            const selectSurat = document.getElementById("jenisSurat");
            if (selectSurat) {
                selectSurat.classList.remove("text-gray-800");
                selectSurat.classList.add("text-gray-400");
            }

            // ✅ FIX 3: Reset upload box TANPA menghapus tombol submit
            const uploadBox = document.getElementById("uploadBox");
            if (uploadBox) {
                // Hapus hanya container yang dibuat oleh dynamic-form.js
                const uploadContainer =
                    uploadBox.querySelector(".upload-container");
                if (uploadContainer) {
                    uploadContainer.remove();
                }
                // Tombol submit TIDAK DIHAPUS karena di luar upload-container
            }

            // Reset syarat box
            const syaratBox = document.getElementById("syaratBox");
            if (syaratBox) {
                syaratBox.innerHTML =
                    "Silahkan pilih jenis surat untuk melihat persyaratan dokumen";
            }
        })
        .catch((err) => {
            console.error("Submit error:", err);

            // Better error handling
            if (err?.errors) {
                const errorMessages = Object.values(err.errors)
                    .flat()
                    .join("\n");
                alert("Terjadi kesalahan:\n\n" + errorMessages);
            } else {
                alert(
                    err?.message ||
                        "Terjadi kesalahan saat mengirim form. Silakan coba lagi.",
                );
            }
        })
        .finally(() => {
            // Reset button ke state awal
            submitBtn.disabled = false;
            submitBtn.classList.remove("opacity-70");
            submitBtn.innerHTML = "Kirim";
        });
}

export function salinKode() {
    const kode = document.getElementById("kodeUnik")?.innerText;
    if (!kode || kode === "-") return;

    const btn = document.getElementById("btnSalin");
    const status = document.getElementById("statusSalin");

    navigator.clipboard.writeText(kode).then(() => {
        // animasi tombol
        btn.innerHTML = '<i class="fa-solid fa-check"></i> Tersalin';
        btn.classList.remove("bg-[#00adb5]");
        btn.classList.add("bg-green-500");

        // fade text
        status.classList.remove("opacity-0");
        status.classList.add("opacity-100");

        // bounce kecil
        btn.animate(
            [
                { transform: "scale(1)" },
                { transform: "scale(1.1)" },
                { transform: "scale(1)" },
            ],
            { duration: 300 },
        );

        setTimeout(() => {
            btn.innerHTML = '<i class="fa-regular fa-copy"></i> Salin';
            btn.classList.add("bg-[#00adb5]");
            btn.classList.remove("bg-green-500");
            status.classList.add("opacity-0");
            status.classList.remove("opacity-100");
        }, 2000);
    });
}

// Export ke window untuk onclick
window.submitForm = submitForm;
window.salinKode = salinKode;
