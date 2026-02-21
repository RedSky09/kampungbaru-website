<section class="relative min-h-[75vh] md:min-h-[92vh] w-full overflow-hidden">

    <!-- Background Image -->
    <img 
        src="{{ asset('images/hero.jpeg') }}" 
        alt="Hero"
        class="absolute inset-0 w-full h-full object-cover"
    >

    <!-- Overlay -->
    <div class="absolute inset-0 bg-gradient-to-r 
                from-black/90 md:from-black/80 
                via-black/70 md:via-black/60 
                to-transparent"></div>

    <!-- Content -->
    <div class="relative z-10 min-h-[75vh] md:min-h-[92vh] 
                max-w-7xl mx-auto px-6 
                flex items-center 
                justify-center md:justify-start">

        <div class="max-w-xl text-white 
                    text-center md:text-left">

            <h1 class="text-3xl sm:text-4xl md:text-5xl 
                       font-bold leading-tight">
                Selamat Datang di Website Kelurahan Kampung Baru!
            </h1>

            <p class="mt-4 text-base md:text-lg text-white/90">
                Pusat layanan dan informasi Kelurahan Kampung Baru
            </p>

            <div class="mt-8 md:mt-10 
            flex justify-center md:justify-start">

    <a 
        href="#telusuri"
        class="group inline-flex items-center gap-2
               bg-teal-500 hover:bg-teal-600
               text-white text-sm md:text-base
               px-6 py-3 rounded-xl font-semibold
               shadow-md
               transition-all duration-300 ease-out
               hover:-translate-y-1
               hover:shadow-xl">

        Jelajahi Kampung Baru

        <i class="fa-solid fa-arrow-turn-down
                  transition-transform duration-300
                  group-hover:translate-y-1"></i>
    </a>

</div>

        </div>
    </div>
</section>
