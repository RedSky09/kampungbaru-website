<div
    id="modalKode"
    class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    {{-- CARD --}}
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 p-6 text-center">

        <div class="mb-4">
            <i class="fa-solid fa-circle-check text-4xl text-[#00adb5]"></i>
        </div>

        <h2 class="text-xl font-bold mb-2">
            Pengajuan Berhasil
        </h2>

        <p class="text-gray-600 mb-4">
            Simpan kode berikut untuk melacak status pengajuan Anda
        </p>

        {{-- KODE --}}
        <div class="bg-slate-100 rounded-lg py-3 mb-6">
            <span
                id="kodeUnik"
                class="text-lg font-bold tracking-widest text-[#00adb5]">
                -
            </span>
        </div>

        <button
            onclick="tutupModal()"
            class="bg-[#00adb5] hover:bg-teal-600 text-white px-6 py-2 rounded-lg font-semibold transition">
            Tutup
        </button>

    </div>
</div>
