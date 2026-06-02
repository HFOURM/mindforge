<main class="min-h-screen flex flex-col items-center justify-center bg-[hsl(0,0%,100%)] dark:bg-[#191919] antialiased font-sans px-4">
    <div class="w-full max-w-md bg-white dark:bg-[#202020]  rounded-xl p-8 md:p-12 shadow-sm text-center">
        
    
        <div class="flex justify-center mb-6">
            <div class="w-10 h-10  rounded-lg flex items-center justify-center">
       
                <svg class="dark:invert" width="73" height="65" viewBox="0 0 73 65" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M25 0H5C2.23858 0 0 2.23858 0 5V25C0 27.7614 2.23858 30 5 30H25C27.7614 30 30 27.7614 30 25V5C30 2.23858 27.7614 0 25 0Z" fill="#191919"/>
<path d="M67.5 0H47.5C44.7386 0 42.5 2.23858 42.5 5V60C42.5 62.7614 44.7386 65 47.5 65H67.5C70.2614 65 72.5 62.7614 72.5 60V5C72.5 2.23858 70.2614 0 67.5 0Z" fill="#191919"/>
</svg>

            </div>
        </div>

        <h1 class="text-2xl md:text-3xl font-medium tracking-tight text-grey-200 dark:text-grey-200 mb-8 leading-tight">
            Welcome to <span class="text-[#191919] dark:text-white font-bold">Mindforge</span>.<br>
            All in one place.
        </h1>

        <div class="w-full space-y-4 mb-6">
            <a href="<?php echo BASE_URL; ?>/auth/google" class="flex items-center justify-center w-full gap-3 bg-black dark:bg-white hover:bg-grey-200 dark:hover:bg-grey-200 text-white dark:text-black text-[15px] font-medium py-3.5 px-6 rounded-xl transition shadow-sm">
                <svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24">
                    <!-- Menggunakan warna putih/monokrom jika tombolnya solid hitam agar kontras -->
                    <path fill="currentColor" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="currentColor" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="currentColor" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="currentColor" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                <span>Continue with Google</span>
            </a>
        </div>

        <!-- Footer Notice (Kecil & Muted di dalam card) -->
        <p class="text-[11px] text-grey-200 dark:text-grey-200 leading-relaxed max-w-[300px] mx-auto">
            By clicking "Continue with Google", you acknowledge that you have read and understood, and agree to Mindforge's <a href="#" class="underline hover:text-black dark:hover:text-white">Terms & Conditions</a> and <a href="#" class="underline hover:text-black dark:hover:text-white">Privacy Policy</a>.
        </p>
    </div>
</main>