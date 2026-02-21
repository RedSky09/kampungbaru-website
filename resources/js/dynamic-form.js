/* =======================
   DYNAMIC FORM SURAT
======================= */

const suratConfig = {
    Ket_Kematian: {
        syarat: [
            "Pengantar Ketua RT/RW",
            "Fotokopi KK / KTP yang Meninggal",
            "Foto kuburan",
        ],
    },
    Ket_Pengantar_Nikah: {
        syarat: [
            "Pengantar Ketua RT/RW",
            "Fotokopi KK / KTP Calon Pengantin",
            "Fotokopi KK / KTP Kedua Orang Tua",
            "Fotokopi Akta Cerai Bagi yang Berstatus Duda/Janda",
            "Pas foto 1 lembar masing-masing calon pengantin",
        ],
    },
    SKCK_BlmMenikah_dll: {
        syarat: [
            "Pengantar Ketua RT/RW",
            "Fotokopi KK / KTP yang Bersangkutan",
        ],
    },
    Ket_Penguburan: {
        syarat: ["Pengantar RT/RW", "Surat Keterangan Kematian"],
    },
};

function renderSyarat(jenis, syaratBox) {
    syaratBox.innerHTML = "";

    if (!suratConfig[jenis]) return;

    const ul = document.createElement("ul");
    ul.className = "list-decimal pl-5 space-y-1";

    suratConfig[jenis].syarat.forEach((item) => {
        const li = document.createElement("li");
        li.textContent = item;
        ul.appendChild(li);
    });

    syaratBox.appendChild(ul);
}

function renderUploadInput(jenis, uploadBox) {
    const submitBtn = uploadBox.querySelector("#submitBtn");

    // ❗ Hapus container upload lama (bukan tombol)
    const oldContainer = uploadBox.querySelector(".upload-container");
    if (oldContainer) oldContainer.remove();

    if (!suratConfig[jenis]) return;

    const inputsContainer = document.createElement("div");
    inputsContainer.className = "upload-container flex-1 space-y-3";

    // Render input file sebanyak jumlah persyaratan
    suratConfig[jenis].syarat.forEach((syarat, index) => {
        const wrapper = document.createElement("div");

        const label = document.createElement("label");
        label.className = "block text-sm font-medium mb-1";
        label.textContent = `${index + 1}. ${syarat}`;

        const input = document.createElement("input");
        input.type = "file";
        input.name = "document[]"; // Array untuk multiple files
        input.required = true;
        input.accept = ".jpg,.jpeg,.png,.pdf";
        input.className = `
            block text-sm text-gray-700
            file:mr-3 file:py-1.5 file:px-3
            file:rounded-md file:border-0
            file:bg-gray-200 file:text-gray-700
            hover:file:bg-gray-300
            bg-white rounded-md 
        `;

        wrapper.appendChild(label);
        wrapper.appendChild(input);
        inputsContainer.appendChild(wrapper);
    });

    // Insert sebelum tombol submit
    if (submitBtn) {
        uploadBox.insertBefore(inputsContainer, submitBtn);
    } else {
        uploadBox.appendChild(inputsContainer);
    }
}

export function initDynamicForm() {
    const selectSurat = document.getElementById("jenisSurat");
    const syaratBox = document.getElementById("syaratBox");
    const uploadBox = document.getElementById("uploadBox");

    if (!selectSurat) return;

    // Tambahkan class untuk ubah warna saat ada value
    selectSurat.addEventListener("change", function () {
        const jenis = this.value;

        // Ubah warna select jadi hitam saat ada value
        if (jenis) {
            this.classList.remove("text-gray-400");
            this.classList.add("text-gray-800");
        }

        renderSyarat(jenis, syaratBox);
        renderUploadInput(jenis, uploadBox);
    });
}
