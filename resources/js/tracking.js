/* =======================
   CEK STATUS
======================= */

export function cekStatus() {
    const input = document.getElementById("trackingCode");
    const resultBox = document.getElementById("trackingResult");
    const code = input.value.trim().toUpperCase();

    if (!code) {
        alert("Masukkan kode pengajuan");
        return;
    }

    resultBox.classList.remove("hidden");
    resultBox.innerHTML = "Memeriksa...";

    fetch(`/tracking/${code}`)
        .then(async (res) => {
            const data = await res.json();
            if (!res.ok) throw data;
            return data;
        })
        .then((d) => {
            const statusBadge =
                {
                    pending: "bg-yellow-500",
                    approved: "bg-blue-500",
                    rejected: "bg-red-500",
                    finished: "bg-green-600",
                }[d.status] ?? "bg-gray-500";

            let html = `
            <div class="border border-white/20 rounded-lg p-4 space-y-2">
                <p><b>Kode:</b> ${d.code}</p>
                <p><b>Nama:</b> ${d.name}</p>
                <p><b>Jenis Surat:</b> ${d.service_type}</p>
                <p>
                    <b>Status:</b>
                    <span class="px-2 py-1 text-white rounded ${statusBadge}">
                        ${d.status.toUpperCase()}
                    </span>
                </p>
            `;

            if (d.status === "rejected") {
                html += `
                <p class="text-red-400">
                    <b>Alasan:</b> ${d.reason ?? "-"}
                </p>`;
            }

            html += `
                <p class="text-xs text-gray-300">
                    Diajukan pada ${d.created_at}
                </p>
            </div>`;

            resultBox.innerHTML = html;
        })
        .catch((err) => {
            resultBox.innerHTML = `<p class="text-red-400">${err.message || "Kode tidak ditemukan"}</p>`;
        });
}
