   <?php $this->component('sidebar'); ?>


   <?php $this->component('nav-mobile'); ?>

   <main class="flex-1 xl:ml-64 mb-6 flex-col flex gap-6 p-6">

        <div class="bg-[#F7F7F7] hidden dark:bg-[#2a2a2a] font-medium xl:flex justify-between items-center rounded-lg w-fit p-1.5">
            <a class="px-2.5 py-1" href="index.html">Mindforge</a>
            <a class="px-2.5 py-1 rounded bg-white dark:bg-grey-500" href="tasks.html">My Tasks</a>
        </div>

        <div class="flex justify-between items-center gap-5">
            <form action="" class="relative w-[405px]">
                <div
                    class="flex items-center border border-[#E0E0E0]  dark:border-[#383836] rounded-lg px-3 py-2 gap-2 focus-within:ring-1 focus-within:ring-grey-500">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                            stroke="#828282" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M21.0004 21.0004L16.6504 16.6504" stroke="#828282" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <input type="text" placeholder="Search tasks..."
                        class="outline-none bg-transparent w-full font-regular text-[#828282] placeholder:text-[#828282]">
                </div>
            </form>

            <div
                class="flex  flex-row gap-3 items-center px-3 py-2 border dark:border-[#383836] border-[#E0E0E0] text-[#828282] rounded-lg cursor-pointer">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22 3H2L10 12.46V19L14 21V12.46L22 3Z" stroke="#828282" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p class="hidden xl:block">Filter</p>
            </div>
        </div>

        <div class="flex flex-col xl:flex-row flex-1 gap-6 w-full">

            <div
                class="task-column w-full border font-medium flex gap-3 flex-col border-[#E0E0E0] bg-[#FDFDFD] dark:border-[#383836] dark:bg-[#202020] rounded-lg px-4 py-3 ">
                <div class="flex justify-between mb-2">
                    <div class="flex flex-row gap-2 items-center">
                        <svg class="dark:invert" width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="8" height="8" rx="4" fill="#191919" />
                        </svg>

                        <div> To Do <span class="text-grey-200">(8)</span></div>
                    </div>

                    <div class="border border-[#E0E0E0] dark:border-[#383836] rounded-full p-1.5">
                        <svg class="dark:invert" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 2.67188C12.2859 2.67188 12.5605 2.78512 12.7627 2.9873C12.9649 3.18949 13.0781 3.46406 13.0781 3.75V10.9219H20.25C20.5359 10.9219 20.8105 11.0351 21.0127 11.2373C21.2149 11.4395 21.3281 11.7141 21.3281 12C21.3281 12.2859 21.2149 12.5605 21.0127 12.7627C20.8105 12.9649 20.5359 13.0781 20.25 13.0781H13.0781V20.25C13.0781 20.5359 12.9649 20.8105 12.7627 21.0127C12.5605 21.2149 12.2859 21.3281 12 21.3281C11.7141 21.3281 11.4395 21.2149 11.2373 21.0127C11.0351 20.8105 10.9219 20.5359 10.9219 20.25V13.0781H3.75C3.46406 13.0781 3.18949 12.9649 2.9873 12.7627C2.78512 12.5605 2.67188 12.2859 2.67188 12C2.67188 11.7141 2.78512 11.4395 2.9873 11.2373C3.18949 11.0351 3.46406 10.9219 3.75 10.9219H10.9219V3.75C10.9219 3.46406 11.0351 3.18949 11.2373 2.9873C11.4395 2.78512 11.7141 2.67188 12 2.67188Z"
                                fill="#656565" stroke="#959595" stroke-width="0.09375" />
                        </svg>

                    </div>
                </div>

                <div class="task-list flex flex-col gap-3 min-h-[50px]">

                    <div
                        class="task-card cursor-move w-full flex flex-col gap-3 p-3 border border-[#E0E0E0] dark:border-[#383836] rounded-lg">
                        <p class="bg-grey-50 dark:bg-[#2A2A2A] w-fit px-3 text-[12px] font-medium  py-1 rounded-full">
                            Important
                        </p>
                        <h3 class="font-medium ">UI/UX Design in the age of AI</h3>
                        <p class="text-grey-300 text-[15px] font-regular">Review dan evaluasi anggaran bulanan</p>
                    </div>

                    <div
                        class="task-card cursor-move w-full flex flex-col gap-3 p-3 border border-[#E0E0E0] dark:border-[#383836] rounded-lg">
                        <p class="bg-[#FFFBEB] w-fit px-3 text-[12px] font-medium text-[#F59E0B] py-1 rounded-full dark:bg-[#3a2e12] dark:text-[#fbbf24]">OK
                        </p>
                        <h3 class="font-medium ">Research User Persona</h3>
                        <p class="text-grey-300 text-[15px] font-regular">Menganalisis target audiens untuk proyek baru
                        </p>
                    </div>

                    <div
                        class="task-card cursor-move w-full flex flex-col gap-3 p-3 border border-[#E0E0E0] dark:border-[#383836] rounded-lg">
                        <p class="bg-[#FFF1F2] w-fit px-3 text-[12px] font-medium text-[#F43F5E] py-1 rounded-full dark:bg-[#3a1a1f] dark:text-[#fb7185]">Not
                            that
                            important</p>
                        <h3 class="font-medium ">Update Documentation</h3>
                        <p class="text-grey-300 text-[15px] font-regular">Merapikan file dokumentasi sprint minggu lalu
                        </p>
                    </div>
                </div>

            </div>

            <div
                class="task-column w-full border font-medium flex gap-3 flex-col  border-[#E0E0E0] dark:border-[#383836] bg-[#FDFDFD] dark:bg-[#202020] rounded-lg px-4 py-3 ">
                <div class="flex justify-between mb-2">
                    <div class="flex flex-row gap-2 items-center">
                        <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="8" height="8" rx="4" fill="#F59E0B" />
                        </svg>

                        <div> In Proggres <span class="text-grey-200">(8)</span></div>
                    </div>

                    <div class="border border-[#E0E0E0] dark:border-[#383836] rounded-full p-1.5">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg overflow-hidden">
                            <path
                                d="M12 2.67188C12.2859 2.67188 12.5605 2.78512 12.7627 2.9873C12.9649 3.18949 13.0781 3.46406 13.0781 3.75V10.9219H20.25C20.5359 10.9219 20.8105 11.0351 21.0127 11.2373C21.2149 11.4395 21.3281 11.7141 21.3281 12C21.3281 12.2859 21.2149 12.5605 21.0127 12.7627C20.8105 12.9649 20.5359 13.0781 20.25 13.0781H13.0781V20.25C13.0781 20.5359 12.9649 20.8105 12.7627 21.0127C12.5605 21.2149 12.2859 21.3281 12 21.3281C11.7141 21.3281 11.4395 21.2149 11.2373 21.0127C11.0351 20.8105 10.9219 20.5359 10.9219 20.25V13.0781H3.75C3.46406 13.0781 3.18949 12.9649 2.9873 12.7627C2.78512 12.5605 2.67188 12.2859 2.67188 12C2.67188 11.7141 2.78512 11.4395 2.9873 11.2373C3.18949 11.0351 3.46406 10.9219 3.75 10.9219H10.9219V3.75C10.9219 3.46406 11.0351 3.18949 11.2373 2.9873C11.4395 2.78512 11.7141 2.67188 12 2.67188Z"
                                fill="#656565" stroke="#959595" stroke-width="0.09375" />
                        </svg>

                    </div>
                </div>

                <div class="task-list flex flex-col gap-3 min-h-[50px]">

                    <div
                        class="task-card cursor-move w-full flex flex-col gap-3 p-3 border border-[#E0E0E0] dark:border-[#383836] rounded-lg">
                        <p class="bg-grey-50 dark:bg-[#2A2A2A] w-fit px-3 text-[12px] font-medium  py-1 rounded-full">
                            Important
                        </p>
                        <h3 class="font-medium ">Final Prototype Review</h3>
                        <p class="text-grey-300 text-[15px] font-regular">Presentasi hasil akhir desain ke stakeholder
                        </p>
                    </div>

                    <div
                        class="task-card cursor-move w-full flex flex-col gap-3 p-3 border border-[#E0E0E0] dark:border-[#383836] rounded-lg">
                        <p class="bg-[#FFFBEB] w-fit px-3 text-[12px] font-medium text-[#F59E0B] py-1 rounded-full dark:bg-[#3a2e12] dark:text-[#fbbf24]">OK
                        </p>
                        <h3 class="font-medium ">Asset Exporting</h3>
                        <p class="text-grey-300 text-[15px] font-regular">Menyiapkan aset gambar untuk tim developer</p>
                    </div>

                </div>
            </div>

            <div
                class="task-column w-full border font-medium flex gap-3 flex-col  border-[#E0E0E0] dark:border-[#383836] bg-[#FDFDFD] dark:bg-[#202020] rounded-lg px-4 py-3">
                <div class="flex justify-between mb-2">
                    <div class="flex flex-row gap-2 items-center">
                        <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="8" height="8" rx="4" fill="#22C55E" />
                        </svg>

                        <div> Completed <span class="text-grey-200">(8)</span></div>
                    </div>

                    <div class="border border-[#E0E0E0] dark:border-[#383836] rounded-full p-1.5">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 2.67188C12.2859 2.67188 12.5605 2.78512 12.7627 2.9873C12.9649 3.18949 13.0781 3.46406 13.0781 3.75V10.9219H20.25C20.5359 10.9219 20.8105 11.0351 21.0127 11.2373C21.2149 11.4395 21.3281 11.7141 21.3281 12C21.3281 12.2859 21.2149 12.5605 21.0127 12.7627C20.8105 12.9649 20.5359 13.0781 20.25 13.0781H13.0781V20.25C13.0781 20.5359 12.9649 20.8105 12.7627 21.0127C12.5605 21.2149 12.2859 21.3281 12 21.3281C11.7141 21.3281 11.4395 21.2149 11.2373 21.0127C11.0351 20.8105 10.9219 20.5359 10.9219 20.25V13.0781H3.75C3.46406 13.0781 3.18949 12.9649 2.9873 12.7627C2.78512 12.5605 2.67188 12.2859 2.67188 12C2.67188 11.7141 2.78512 11.4395 2.9873 11.2373C3.18949 11.0351 3.46406 10.9219 3.75 10.9219H10.9219V3.75C10.9219 3.46406 11.0351 3.18949 11.2373 2.9873C11.4395 2.78512 11.7141 2.67188 12 2.67188Z"
                                fill="#656565" stroke="#959595" stroke-width="0.09375" />
                        </svg>

                    </div>
                </div>

                <div class="task-list flex flex-col gap-3 min-h-[50px]">

                    <div
                        class="task-card cursor-move w-full flex flex-col gap-3 p-3 border border-[#E0E0E0] dark:border-[#383836] rounded-lg">
                        <p class="bg-[#FFFBEB] w-fit px-3 text-[12px] font-medium text-[#F59E0B] py-1 rounded-full dark:bg-[#3a2e12] dark:text-[#fbbf24]">OK
                        </p>
                        <h3 class="font-medium ">Benchmarking Competitors</h3>
                        <p class="text-grey-300 text-[15px] font-regular">Melihat fitur-fitur unggulan dari kompetitor
                            sejenis</p>
                    </div>

                    <div
                        class="task-card cursor-move w-full flex flex-col gap-3 p-3 border border-[#E0E0E0] dark:border-[#383836] rounded-lg">
                        <p class="bg-grey-50 dark:bg-[#2A2A2A] w-fit px-3 text-[12px] font-medium  py-1 rounded-full">
                            Important
                        </p>
                        <h3 class="font-medium ">Fixing Design Debt</h3>
                        <p class="text-grey-300 text-[15px] font-regular">Memperbaiki inkonsistensi komponen pada sistem
                            desain</p>
                    </div>

                    <div
                        class="task-card cursor-move w-full flex flex-col gap-3 p-3 border border-[#E0E0E0] dark:border-[#383836] rounded-lg">
                        <p class="bg-[#FFF1F2] w-fit px-3 text-[12px] font-medium text-[#F43F5E] py-1 rounded-full dark:bg-[#3a1a1f] dark:text-[#fb7185]">Not
                            that
                            important</p>
                        <h3 class="font-medium ">Weekly Sync Meeting</h3>
                        <p class="text-grey-300 text-[15px] font-regular">Rapat rutin mingguan untuk sinkronisasi tugas
                        </p>
                    </div>

                </div>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>

    <script>

        document.addEventListener("DOMContentLoaded", function () {

            const columns = document.querySelectorAll('.task-list');

            columns.forEach(list => {
                new Sortable(list, {
                    group: 'kanban',
                    animation: 200,
                    ghostClass: 'opacity-40',
                    forceFallback: true,
                    dragClass: 'rotate-1 scale-105',
                });
            });

        });
    </script>