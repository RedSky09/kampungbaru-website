@extends('layouts.app')

@section('title', 'Layanan Kelurahan Kampung Baru')

@section('content')
<section class="py-10 sm:py-20 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 grid grid-cols-1 lg:grid-cols-3 gap-8 sm:gap-10">

        {{-- FORM LAYANAN --}}
        <div class="lg:col-span-2">

            <h2 class="text-lg sm:text-xl font-bold text-[#00adb5] mb-2">
                Form Layanan
            </h2>
            <p class="text-sm sm:text-base text-gray-800 mb-4">
                Silakan lengkapi data diri dan pilih jenis surat yang ingin diajukan
            </p>

            <form
                id="layananForm"
                enctype="multipart/form-data"
                class="bg-[#222831] rounded-xl p-5 sm:p-8 shadow-lg text-white"
            >
                @csrf

                {{-- Jenis Surat --}}
                <div class="mb-6">
                    <label class="block text-base sm:text-lg font-bold mb-2">
                        Jenis Surat
                    </label>
                    <div class="relative">
                        <select
                            id="jenisSurat"
                            name="service_type"
                            required
                            class="appearance-none font-bold w-full h-11 rounded-md px-4 pr-10
                            bg-white text-gray-400 focus:text-gray-800 transition-colors text-sm sm:text-base"
                        >
                            <option value="" disabled selected hidden>
                                Pilih Jenis Surat
                            </option>
                            <option value="Ket_Kematian">Surat Keterangan Kematian</option>
                            <option value="Ket_Pengantar_Nikah">Surat Keterangan Pengantar Nikah</option>
                            <option value="SKCK_BlmMenikah_dll">Surat Keterangan SKCK / Belum Menikah dan Lain-Lain</option>
                            <option value="Ket_Penguburan">Surat Keterangan Penguburan</option>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-600 pointer-events-none"></i>
                    </div>
                </div>

                {{-- Persyaratan --}}
                <div class="mb-6">
                    <label class="block text-base sm:text-lg font-bold mb-2">
                        Persyaratan Dokumen
                    </label>
                    <div
                        id="syaratBox"
                        class="font-medium bg-white text-gray-600 rounded-md p-4 text-sm min-h-[80px]"
                        data-placeholder="Silahkan pilih jenis surat untuk melihat persyaratan dokumen"
                    >
                        Silahkan pilih jenis surat untuk melihat persyaratan dokumen
                    </div>
                </div>

                {{-- Data Pribadi --}}
                <h3 class="text-base sm:text-lg font-bold mb-3">
                    Data Pribadi
                </h3>

                <div class="space-y-4 mb-6">
                    <input
                        name="nik"
                        type="text"
                        inputmode="numeric"
                        maxlength="16"
                        required
                        placeholder="NIK"
                        class="font-bold w-full h-11 rounded-md px-4 bg-white text-gray-800 text-sm sm:text-base"
                    >

                    {{-- Di mobile: stack vertical, di desktop: 2 kolom --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <input
                            name="name"
                            type="text"
                            required
                            placeholder="Nama Lengkap"
                            class="font-bold h-11 rounded-md px-4 bg-white text-gray-800 text-sm sm:text-base"
                        >
                        <input
                            name="phone"
                            type="text"
                            inputmode="numeric"
                            required
                            placeholder="No. HP"
                            class="font-bold h-11 rounded-md px-4 bg-white text-gray-800 text-sm sm:text-base"
                        >
                    </div>

                    <textarea
                        name="note"
                        placeholder="Keperluan / Catatan"
                        class="font-bold w-full h-28 rounded-md px-4 py-3 bg-white text-gray-800 resize-none text-sm sm:text-base"
                    ></textarea>
                </div>

                {{-- Upload Dokumen --}}
                <h3 class="text-base sm:text-lg font-bold mb-3">
                    Upload Dokumen
                </h3>

                {{-- Di mobile: stack vertical, tombol full width --}}
                <div id="uploadBox" class="flex flex-col sm:flex-row gap-4 sm:items-end">
                    {{-- Area ini akan diisi oleh JS --}}

                    <button
                        type="button"
                        id="submitBtn"
                        onclick="submitForm()"
                        class="w-full sm:w-auto h-10 px-6 rounded-md font-semibold whitespace-nowrap flex-shrink-0
                               bg-[#00adb5] hover:bg-teal-600 text-white transition"
                    >
                        Kirim
                    </button>
                </div>

            </form>
        </div>

        {{-- STATUS PENGAJUAN --}}
        <div>
            <h2 class="text-lg sm:text-xl font-bold text-[#00adb5] mb-2">
                Status Pengajuan
            </h2>
            <p class="text-sm sm:text-base text-gray-800 mb-4">
                Pantau perkembangan pengajuan surat anda
            </p>

             <div class="bg-[#222831] rounded-xl p-5 sm:p-8 shadow-lg text-white">
                <div class="flex items-center gap-2">
                    <input
                        id="trackingCode"
                        type="text"
                        placeholder="Masukkan kode"
                        class="flex-1 min-w-0 h-11 rounded-md px-4 bg-white text-gray-800 font-bold uppercase text-sm"
                    >
                    <button
                        onclick="cekStatus()"
                        class="shrink-0 h-11 bg-[#00adb5] hover:bg-teal-600 px-4 rounded-md font-semibold transition whitespace-nowrap text-sm"
                    >
                        Cek
                    </button>
                </div>
                <div id="trackingResult" class="mt-6 hidden text-sm"></div>
            </div>
        </div>

    </div>
</section>

{{-- MODAL --}}
<div id="modalKode" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4">
    <div class="bg-white rounded-xl w-full max-w-md p-5 sm:p-6 text-center shadow-xl">

        <div class="mb-3">
            <i class="fa-solid fa-circle-check text-4xl text-[#00adb5]"></i>
        </div>

        <h3 class="text-lg sm:text-xl font-bold text-[#00adb5] mb-2">
            Pengajuan Berhasil
        </h3>

        <p class="text-sm text-gray-600 mb-4">
            Simpan kode berikut untuk melacak status pengajuan Anda
        </p>

        <div class="bg-gray-100 rounded-lg py-3 px-4 mb-2 flex items-center justify-between gap-2">
            <span
                id="kodeUnik"
                class="text-base sm:text-lg font-bold tracking-widest text-[#00adb5]"
            >
                KB-XXXX-0000
            </span>
            <button
                id="btnSalin"
                onclick="salinKode()"
                class="text-sm bg-[#00adb5] text-white px-3 py-1 rounded-md transition-all duration-300 flex items-center gap-1 active:scale-95 whitespace-nowrap"
            >
                <i class="fa-regular fa-copy"></i>
                Salin
            </button>
        </div>

        <p
            id="statusSalin"
            class="text-sm text-green-600 mb-4 opacity-0 transition-opacity duration-300"
        >
            ✓ Kode berhasil disalin
        </p>

        <button
            onclick="tutupModal()"
            class="bg-[#00adb5] hover:bg-teal-600 text-white px-6 py-2 rounded-lg font-semibold transition"
        >
            Tutup
        </button>
    </div>
</div>

@endsection