   <?php $this->component('sidebar'); ?>

   <?php $this->component('nav-mobile'); ?>

   <main class="flex-1 xl:ml-64 mb-6 flex-col flex gap-6 p-6">

       <div
           class="bg-[#F7F7F7] hidden  dark:bg-[#2a2a2a] font-medium xl:flex justify-between items-center rounded-lg w-fit p-1.5">
           <a class="px-2.5 py-1" href="<?php echo BASE_URL; ?>/">Mindforge</a>
           <a class="px-2.5 py-1 rounded bg-white dark:bg-grey-500" href="<?php echo BASE_URL; ?>/projects">Projects</a>
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


                   <input
                       class="outline-none bg-transparent w-full font-regular text-sm text-[#828282] placeholder:text-[#828282]"
                       type="text"
                       placeholder="Search tasks..."
                       name="search"
                       value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                       oninput="clearTimeout(window.searchTimer);
             window.searchTimer=setTimeout(()=>{
                 this.form.submit();
             },500)">
               </div>
           </form>

           <form method="GET" class="flex gap-2">

               <input
                   type="hidden"
                   name="priority"
                   id="priorityInput"
                   value="<?= $_GET['priority'] ?? '' ?>">

               <input type="hidden" name="status" id="statusInput"
                   value="<?= $_GET['status'] ?? '' ?>">

               <div class="flex gap-2">

                   <div class="relative">

                       <button
                           id="priorityBtn"
                           type="button"
                           class="flex items-center gap-2 px-3 py-2.5
                       border border-[#E0E0E0]
                       dark:border-[#383836]
                       bg-white dark:bg-[#202020]
                       rounded-lg text-sm">

                           <span id="priorityLabel">
                               <?= !empty($_GET['priority'])
                                    ? htmlspecialchars($_GET['priority'])
                                    : 'All Priority'
                                ?>
                           </span>

                           <svg class="dark:invert" width="16" height="16" viewBox="0 0 24 24">
                               <path d="M6 9L12 15L18 9" stroke="black" stroke-width="2" />
                           </svg>

                       </button>

                       <div
                           id="priorityMenu"
                           class="hidden absolute top-full mt-2 left-0
                       min-w-[180px]
                       bg-white dark:bg-[#202020]
                       border border-[#E0E0E0]
                       dark:border-[#383836]
                       rounded-lg shadow-lg overflow-hidden z-50">

                           <button
                               type="button"
                               class="priority-option block w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-[#2a2a2a]"
                               data-value="">
                               All Priority
                           </button>

                           <button
                               type="button"
                               class="priority-option block w-full text-left px-4 py-2  hover:bg-gray-100 dark:hover:bg-[#2a2a2a]"
                               data-value="High">
                               High
                           </button>

                           <button
                               type="button"
                               class="priority-option block w-full text-left px-4 py-2  hover:bg-gray-100 dark:hover:bg-[#2a2a2a]"
                               data-value="Medium">
                               Medium
                           </button>

                           <button
                               type="button"
                               class="priority-option block w-full text-left px-4 py-2  hover:bg-gray-100 dark:hover:bg-[#2a2a2a]"
                               data-value="Low">
                               Low
                           </button>

                       </div>

                   </div>

                   


                   <div class="relative">

                       <button
                           id="statusBtn"
                           type="button"
                           class="flex items-center gap-2 px-3 py-2.5
                       border border-[#E0E0E0]
                       dark:border-[#383836]
                       bg-white dark:bg-[#202020]
                       rounded-lg text-sm">

                           <span id="statusLabel">
                               <?= !empty($_GET['status'])
                                    ? htmlspecialchars($_GET['status'])
                                    : 'All Status'
                                ?>
                           </span>

                           <svg class="dark:invert" width="16" height="16" viewBox="0 0 24 24">
                               <path d="M6 9L12 15L18 9" stroke="black" stroke-width="2" />
                           </svg>

                       </button>

                       <div id="statusMenu"
                           class="hidden absolute top-full mt-2 left-0
    min-w-[180px]
    bg-white dark:bg-[#202020]
    border border-[#E0E0E0]
    dark:border-[#383836]
    rounded-lg shadow-lg overflow-hidden z-50">

                           <button
                               type="button"
                               class="status-option block w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-[#2a2a2a]"
                               data-value="">
                               All Status
                           </button>

                           <button
                               type="button"
                               class="status-option block w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-[#2a2a2a]"
                               data-value="Todo">
                               Todo
                           </button>

                           <button
                               type="button"
                               class="status-option block w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-[#2a2a2a]"
                               data-value="In Progress">
                               In Progress
                           </button>

                           <button
                               type="button"
                               class="status-option block w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-[#2a2a2a]"
                               data-value="Done">
                               Done
                           </button>

                       </div>

                   </div>

               </div>

               <div
                 
                   class="px-4 openmodalProject cursor-pointer py-2 border border-[#E0E0E0]
               dark:border-[#383836]
               rounded-lg text-sm dark:bg-white bg-[#191919]">

                  <svg class="dark:invert" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 2.67188C12.2859 2.67188 12.5605 2.78512 12.7627 2.9873C12.9649 3.18949 13.0781 3.46406 13.0781 3.75V10.9219H20.25C20.5359 10.9219 20.8105 11.0351 21.0127 11.2373C21.2149 11.4395 21.3281 11.7141 21.3281 12C21.3281 12.2859 21.2149 12.5605 21.0127 12.7627C20.8105 12.9649 20.5359 13.0781 20.25 13.0781H13.0781V20.25C13.0781 20.5359 12.9649 20.8105 12.7627 21.0127C12.5605 21.2149 12.2859 21.3281 12 21.3281C11.7141 21.3281 11.4395 21.2149 11.2373 21.0127C11.0351 20.8105 10.9219 20.5359 10.9219 20.25V13.0781H3.75C3.46406 13.0781 3.18949 12.9649 2.9873 12.7627C2.78512 12.5605 2.67188 12.2859 2.67188 12C2.67188 11.7141 2.78512 11.4395 2.9873 11.2373C3.18949 11.0351 3.46406 10.9219 3.75 10.9219H10.9219V3.75C10.9219 3.46406 11.0351 3.18949 11.2373 2.9873C11.4395 2.78512 11.7141 2.67188 12 2.67188Z"
                                fill="#ffffff" stroke="#ffffff" stroke-width="0.09375" />
                        </svg>

</div>

               <script>
                   const statusBtn = document.getElementById('statusBtn');
                   const statusMenu = document.getElementById('statusMenu');

                   statusBtn.addEventListener('click', () => {
                       statusMenu.classList.toggle('hidden');
                   });

                   document.querySelectorAll('.status-option').forEach(item => {

                       item.addEventListener('click', () => {

                           document.getElementById('statusInput').value =
                               item.dataset.value;

                           document.getElementById('statusLabel').textContent =
                               item.textContent.trim();

                           statusMenu.classList.add('hidden');
                       });

                   });
               </script>

               <script>
                   const priorityBtn = document.getElementById('priorityBtn');
                   const priorityMenu = document.getElementById('priorityMenu');

                   priorityBtn.addEventListener('click', () => {
                       priorityMenu.classList.toggle('hidden');
                   });

                   document.querySelectorAll('.priority-option').forEach(item => {

                       item.addEventListener('click', () => {

                           document.getElementById('priorityInput').value =
                               item.dataset.value;

                           document.getElementById('priorityLabel').textContent =
                               item.textContent.trim();

                           priorityMenu.classList.add('hidden');
                           item.closest('form').submit();
                       });

                   });
               </script>

           </form>
       </div>




       <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 w-full">

           <?php foreach ($projects as $project): ?>

               <a href="<?php echo BASE_URL; ?>/projects/<?= $project['id'] ?>" class="task-column border font-medium flex gap-2 flex-col border-[#E0E0E0] dark:border-[#383836] dark:bg-[#202020] bg-[#FDFDFD] rounded-lg px-4 py-3">

                   <div class="flex flex-row justify-between items-center">
                       <svg class="dark:invert" width="18" height="16" viewBox="0 0 18 16" fill="none"
                           xmlns="http://www.w3.org/2000/svg">
                           <path
                               d="M0.75 4.75024C0.75 2.86463 0.75 1.92182 1.33579 1.33603C1.92157 0.750244 2.86438 0.750244 4.75 0.750244H5.09315C5.91065 0.750244 6.3194 0.750244 6.68694 0.902485C7.05448 1.05473 7.34351 1.34376 7.92157 1.92182L8.57843 2.57867C9.15649 3.15673 9.44552 3.44576 9.81306 3.598C10.1806 3.75024 10.5894 3.75024 11.4069 3.75024H12.75C14.6356 3.75024 15.5784 3.75024 16.1642 4.33603C16.75 4.92182 16.75 5.86463 16.75 7.75024V10.7502C16.75 12.6359 16.75 13.5787 16.1642 14.1645C15.5784 14.7502 14.6356 14.7502 12.75 14.7502H4.75C2.86438 14.7502 1.92157 14.7502 1.33579 14.1645C0.75 13.5787 0.75 12.6359 0.75 10.7502V4.75024Z"
                               stroke="black" stroke-width="1.5" />
                       </svg>

                       <?php
                        // 1. Definisikan mapping warna status di bagian atas file view (atau sebelum perulangan/foreach)
                        $statusClasses = [
                            'To Do'       => 'bg-[#EFF6FF] text-[#2563EB] dark:bg-[#1e293b] dark:text-[#60A5FA]', // Biru (Tenang, Siap dimulai)
                            'In Progress' => 'bg-[#FFFBEB] text-[#D97706] dark:bg-[#3a2e12] dark:text-[#FBBF24]', // Oranye/Kuning (Aktif, Butuh Fokus)
                            'Done'        => 'bg-[#ECFDF5] text-[#059669] dark:bg-[#064e3b] dark:text-[#34D399]', // Hijau (Sukses, Selesai)
                        ];

                        // 2. Berikan fallback/warna cadangan jika ada status di luar 3 pilihan di atas
                        $currentStatus = $project['status'] ?? 'To Do';
                        $badgeClass = $statusClasses[$currentStatus] ?? 'bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400';
                        ?>

                        <p class="w-fit px-3 text-[12px] font-medium py-1 rounded-full <?= $badgeClass ?>">
                            <?= htmlspecialchars($currentStatus) ?>
                        </p>

                   </div>

                   <div class="flex flex-col gap-2 border-b border-[#E0E0E0] dark:border-[#383836] pb-3">
                       <h2 class="font-medium "><?= htmlspecialchars($project['name']) ?></h2>
                       <p class="text-grey-300 font-medium text-xs truncate" title="<?= htmlspecialchars($project['description'] ?? '') ?>">
    <?= $project['description'] ? htmlspecialchars($project['description']) : 'No description' ?>
</p>
                       <div class="flex text-sm font-regular flex-row justify-between items-center">
                           <p><?= date('M d Y', strtotime($project['deadline'])) ?></p>
                           <div class="flex gap-2 items-center">
                               <svg class="dark:invert" width="10" height="11" viewBox="0 0 10 11" fill="none"
                                   xmlns="http://www.w3.org/2000/svg">
                                   <rect y="7" width="2" height="4" rx="1" fill="black" />
                                   <rect x="4" y="4" width="2" height="7" rx="1" fill="black" />
                                   <rect x="8" width="2" height="11" rx="1" fill="#D9D9D9" />
                               </svg>

                               <p class=" font-medium text-xs">
                               <p class="text-xs"><?= $project['priority'] ?></p>
                               </p>

                           </div>
                       </div>

                   </div>

                   <div class="flex flex-row justify-between items-center">
                       <div class="flex gap-1 items-center">
                           <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                               <g clip-path="url(#clip0_515_1238)">
                                   <rect width="18" height="18" rx="9" fill="#F8F8F8" />
                                   <rect x="9" y="-3" width="13" height="29" fill="#029562" />
                               </g>
                               <rect x="0.5" y="0.5" width="17" height="17" rx="8.5" stroke="black" />
                               <defs>
                                   <clipPath id="clip0_515_1238">
                                       <rect width="18" height="18" rx="9" fill="white" />
                                   </clipPath>
                               </defs>
                           </svg>

                           <p class="text-grey-300 font-medium text-xs"><?= $project['progress'] ?> %</p>
                       </div>

                       <p class="text-grey-300 font-medium text-xs"><?= $project['completed_tasks'] ?> / <?= $project['total_tasks'] ?> Tasks</p>
                   </div>
               </a>

           <?php endforeach; ?>




           <?php $this->component('form-add-project'); ?>




       </div>

       <div class="w-full flex justify-end  mt-6 mb-2">
           <div class="flex gap-2">

               <?php if ($page > 1): ?>
                   <a href="?page=<?= $page - 1 ?>"
                       class="px-4 py-2.5 border border-[#E0E0E0] dark:border-[#383836]  rounded-lg">
                       Previous
                   </a>
               <?php endif; ?>

               <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                   <a href="?page=<?= $i ?>"
                       class="px-4 py-2.5 rounded-lg border border-[#E0E0E0] dark:border-[#383836] 
               <?= $page == $i ? 'bg-grey-500 text-white dark:bg-[#202020] ' : '' ?>">
                       <?= $i ?>
                   </a>
               <?php endfor; ?>

               <?php if ($page < $totalPages): ?>
                   <a href="?page=<?= $page + 1 ?>"
                       class="px-4 py-2.5 border border-[#E0E0E0] dark:border-[#383836]  rounded-lg">
                       Next
                   </a>
               <?php endif; ?>

           </div>
       </div>



       </div>
   </main>