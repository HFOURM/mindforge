   <?php $this->component('sidebar'); ?>

   <?php
    $todoTasks = array_filter($tasks, fn($t) => $t['status'] === 'Todo');
    $progressTasks = array_filter($tasks, fn($t) => $t['status'] === 'In Progress');
    $doneTasks = array_filter($tasks, fn($t) => $t['status'] === 'Done');
    ?>

   <?php
    function priorityColor($priority)
    {
        return match ($priority) {
            'High' => 'bg-[#FFF1F2] text-[#F43F5E]  dark:bg-[#3a1a1f] dark:text-[#fb7185]',
            'Medium' => 'bg-[#FFFBEB] text-[#F59E0B]   dark:bg-[#3a2e12] dark:text-[#fbbf24]',
            'Low' => 'bg-[#D0F4DD] text-[#166534] dark:bg-[#123524] dark:text-[#4ade80]',
            default => 'bg-gray-100 text-gray-500'
        };
    }
    ?>


   <?php $this->component('nav-mobile'); ?>

   <main class="flex-1 xl:ml-64 mb-6 flex-col flex gap-6 p-6">




       <div class="bg-[#F7F7F7] hidden dark:bg-[#2a2a2a] font-medium xl:flex justify-between items-center rounded-lg w-fit p-1.5">
           <a class="px-2.5 py-1" href="<?php echo BASE_URL; ?>/">Mindforge</a>
           <a class="px-2.5 py-1 rounded bg-white dark:bg-grey-500" href="<?php echo BASE_URL; ?>/tasks">My Tasks</a>
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

               <input
                   type="hidden"
                   name="project_id"
                   id="projectInput"
                   value="<?= $_GET['project_id'] ?? '' ?>">

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

                   <?php
                    $selectedProjectName = 'All Projects';

                    foreach ($projects as $project) {
                        if (
                            isset($_GET['project_id']) &&
                            $_GET['project_id'] == $project['id']
                        ) {
                            $selectedProjectName = $project['name'];
                            break;
                        }
                    }
                    ?>

                   <script>
                       document.querySelectorAll('.project-option')
                           .forEach(item => {

                               item.addEventListener('click', () => {

                                   document.getElementById('projectInput').value =
                                       item.dataset.value;

                                   document.getElementById('projectLabel').textContent =
                                       item.textContent.trim();

                                   projectMenu.classList.add('hidden');
                               });

                           });
                   </script>

                   <!-- PROJECT -->
                   <div class="relative">

                       <button
                           id="projectBtn"
                           type="button"
                           class="flex items-center gap-2 px-3 py-2.5
           border border-[#E0E0E0]
           dark:border-[#383836]
           bg-white dark:bg-[#202020]
           rounded-lg text-sm">

                           <span id="projectLabel">
                               <?= htmlspecialchars($selectedProjectName) ?>
                           </span>

                           <svg class="dark:invert" width="16" height="16" viewBox="0 0 24 24">
                               <path d="M6 9L12 15L18 9" stroke="black" stroke-width="2" />
                           </svg>

                       </button>

                       <div
                           id="projectMenu"
                           class="hidden absolute top-full mt-2 left-0
                       min-w-[220px]
                       bg-white dark:bg-[#202020]
                       border border-[#E0E0E0]
                       dark:border-[#383836]
                       rounded-lg shadow-lg overflow-hidden z-50">

                           <button
                               type="button"
                               class="project-option block w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-[#2a2a2a]"
                               data-value="">
                               All Projects
                           </button>

                           <?php foreach ($projects as $project): ?>

                               <button
                                   type="button"
                                   class="project-option block w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-[#2a2a2a]"
                                   data-value="<?= $project['id'] ?>">

                                   <?= htmlspecialchars($project['name']) ?>

                               </button>

                           <?php endforeach; ?>

                       </div>

                   </div>

               </div>

               <button
                   type="submit"
                   class="px-4 py-2 border border-[#E0E0E0]
               dark:border-[#383836]
               rounded-lg text-sm">

                   Apply

               </button>

           </form>
       </div>



       <div class="flex flex-col xl:flex-row flex-1 gap-6 w-full">

           <div
               class="task-column w-full border font-medium flex gap-3 flex-col border-[#E0E0E0] bg-[#FDFDFD] dark:border-[#383836] dark:bg-[#202020] rounded-lg px-4 py-3 ">
               <form method="POST" action="/mindforge/public/tasks/store" class="flex justify-between mb-2">
                   <div class="flex flex-row gap-2 items-center">
                       <svg class="dark:invert" width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <rect width="8" height="8" rx="4" fill="#191919" />
                       </svg>

                       <div> To Do <span class="text-grey-200">(<?= count($todoTasks) ?>)</span></div>
                   </div>

                   <input type="hidden" name="title" value="Untitled Task">
                   <input type="hidden" name="status" value="Todo">
                   <input type="hidden" name="priority" value="Low">
                   <input type="hidden" name="deadline" value="<?php echo date('Y-m-d'); ?>">
                   <input type="hidden" name="project_id" value="">
                   <input type="hidden" name="note" value="describe task here...">

                   <button type="submit" class="border  border-[#E0E0E0] dark:border-[#383836] rounded-full p-1.5">
                       <svg class="dark:invert" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path
                               d="M12 2.67188C12.2859 2.67188 12.5605 2.78512 12.7627 2.9873C12.9649 3.18949 13.0781 3.46406 13.0781 3.75V10.9219H20.25C20.5359 10.9219 20.8105 11.0351 21.0127 11.2373C21.2149 11.4395 21.3281 11.7141 21.3281 12C21.3281 12.2859 21.2149 12.5605 21.0127 12.7627C20.8105 12.9649 20.5359 13.0781 20.25 13.0781H13.0781V20.25C13.0781 20.5359 12.9649 20.8105 12.7627 21.0127C12.5605 21.2149 12.2859 21.3281 12 21.3281C11.7141 21.3281 11.4395 21.2149 11.2373 21.0127C11.0351 20.8105 10.9219 20.5359 10.9219 20.25V13.0781H3.75C3.46406 13.0781 3.18949 12.9649 2.9873 12.7627C2.78512 12.5605 2.67188 12.2859 2.67188 12C2.67188 11.7141 2.78512 11.4395 2.9873 11.2373C3.18949 11.0351 3.46406 10.9219 3.75 10.9219H10.9219V3.75C10.9219 3.46406 11.0351 3.18949 11.2373 2.9873C11.4395 2.78512 11.7141 2.67188 12 2.67188Z"
                               fill="#656565" stroke="#959595" stroke-width="0.09375" />
                       </svg>

                   </button>
               </form>

               <div data-status="Todo" class="task-list flex flex-col gap-3 min-h-[50px]">

                   <?php foreach ($todoTasks as $task): ?>
                       <div class="task-card openmodalTask cursor-move w-full flex flex-col gap-3 p-3 border border-[#E0E0E0] dark:border-[#383836] rounded-lg"

                           data-id="<?= $task['id'] ?>"
                           data-title="<?= htmlspecialchars($task['title']) ?>"
                           data-note="<?= htmlspecialchars($task['note'] ?? '') ?>"
                           data-priority="<?= $task['priority'] ?>"
                           data-status="<?= $task['status'] ?>"
                           data-deadline="<?= $task['deadline'] ?>"
                           data-project="<?= $task['project_id'] ?? '' ?>">

                           <p class="<?= priorityColor($task['priority']) ?> px-3 py-1 rounded-full text-xs w-fit">
                               <?= htmlspecialchars($task['priority']) ?>
                           </p>

                           <h3 class="font-medium">
                               <?= htmlspecialchars($task['title']) ?>
                           </h3>

                           <p class="text-grey-300 text-[15px]">
                               <?= htmlspecialchars($task['note'] ?? '') ?>
                           </p>

                           <div class="flex justify-between items-center border-t border-[#E0E0E0] dark:border-[#383836] pt-2 mt-2 text-xs">

                               <span
                                   title="<?= htmlspecialchars($task['project_name'] ?? '') ?>"
                                   class="px-2 py-0.5 rounded-md bg-blue-100 text-blue-600 
                                    dark:bg-blue-900/30 dark:text-blue-400
                                    max-w-[120px] truncate inline-block">

                                   <?= htmlspecialchars($task['project_name'] ?? 'No Project') ?>
                               </span>

                               <span class="px-2 py-0.5 rounded-md bg-gray-100 text-gray-500 
                                            dark:bg-[#2a2a2a] dark:text-gray-300">
                                   <?= htmlspecialchars($task['deadline'] ?? '') ?>
                               </span>



                           </div>

                       </div>
                   <?php endforeach; ?>

               </div>

           </div>

           <div
               class="task-column w-full border font-medium flex gap-3 flex-col  border-[#E0E0E0] dark:border-[#383836] bg-[#FDFDFD] dark:bg-[#202020] rounded-lg px-4 py-3 ">
               <form method="POST" action="/mindforge/public/tasks/store" class="flex justify-between mb-2">
                   <div class="flex flex-row gap-2 items-center">
                       <svg class="dark:invert" width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <rect width="8" height="8" rx="4" fill="#191919" />
                       </svg>

                       <div> In Progress <span class="text-grey-200">(<?= count($progressTasks) ?>)</span></div>
                   </div>

                   <input type="hidden" name="title" value="Untitled Task">
                   <input type="hidden" name="status" value="In Progress">
                   <input type="hidden" name="priority" value="Low">
                   <input type="hidden" name="deadline" value="<?php echo date('Y-m-d'); ?>">
                   <input type="hidden" name="project_id" value="">
                   <input type="hidden" name="note" value="describe task here...">

                   <button type="submit" class="border  border-[#E0E0E0] dark:border-[#383836] rounded-full p-1.5">
                       <svg class="dark:invert" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path
                               d="M12 2.67188C12.2859 2.67188 12.5605 2.78512 12.7627 2.9873C12.9649 3.18949 13.0781 3.46406 13.0781 3.75V10.9219H20.25C20.5359 10.9219 20.8105 11.0351 21.0127 11.2373C21.2149 11.4395 21.3281 11.7141 21.3281 12C21.3281 12.2859 21.2149 12.5605 21.0127 12.7627C20.8105 12.9649 20.5359 13.0781 20.25 13.0781H13.0781V20.25C13.0781 20.5359 12.9649 20.8105 12.7627 21.0127C12.5605 21.2149 12.2859 21.3281 12 21.3281C11.7141 21.3281 11.4395 21.2149 11.2373 21.0127C11.0351 20.8105 10.9219 20.5359 10.9219 20.25V13.0781H3.75C3.46406 13.0781 3.18949 12.9649 2.9873 12.7627C2.78512 12.5605 2.67188 12.2859 2.67188 12C2.67188 11.7141 2.78512 11.4395 2.9873 11.2373C3.18949 11.0351 3.46406 10.9219 3.75 10.9219H10.9219V3.75C10.9219 3.46406 11.0351 3.18949 11.2373 2.9873C11.4395 2.78512 11.7141 2.67188 12 2.67188Z"
                               fill="#656565" stroke="#959595" stroke-width="0.09375" />
                       </svg>

                   </button>
               </form>

               <div data-status="In Progress" class="task-list flex flex-col gap-3 min-h-[50px]">

                   <?php foreach ($progressTasks as $task): ?>
                       <div class="task-card openmodalTask cursor-move w-full flex flex-col gap-3 p-3 border border-[#E0E0E0] dark:border-[#383836] rounded-lg"

                           data-id="<?= $task['id'] ?>"
                           data-title="<?= htmlspecialchars($task['title']) ?>"
                           data-note="<?= htmlspecialchars($task['note'] ?? '') ?>"
                           data-priority="<?= $task['priority'] ?>"
                           data-status="<?= $task['status'] ?>"
                           data-deadline="<?= $task['deadline'] ?>"
                           data-project="<?= $task['project_id'] ?? '' ?>">

                           <p class="<?= priorityColor($task['priority']) ?> px-3 py-1 rounded-full text-xs w-fit">
                               <?= htmlspecialchars($task['priority']) ?>
                           </p>

                           <h3 class="font-medium">
                               <?= htmlspecialchars($task['title']) ?>
                           </h3>

                           <p class="text-grey-300 text-[15px]">
                               <?= htmlspecialchars($task['note'] ?? '') ?>
                           </p>

                           <div class="flex justify-between items-center border-t border-[#E0E0E0] dark:border-[#383836] pt-2 mt-2 text-xs">

                               <span
                                   title="<?= htmlspecialchars($task['project_name'] ?? '') ?>"
                                   class="px-2 py-0.5 rounded-md bg-blue-100 text-blue-600 
                                    dark:bg-blue-900/30 dark:text-blue-400
                                    max-w-[120px] truncate inline-block">

                                   <?= htmlspecialchars($task['project_name'] ?? 'No Project') ?>
                               </span>

                               <span class="px-2 py-0.5 rounded-md bg-gray-100 text-gray-500 
                                            dark:bg-[#2a2a2a] dark:text-gray-300">
                                   <?= htmlspecialchars($task['deadline'] ?? '') ?>
                               </span>



                           </div>

                       </div>
                   <?php endforeach; ?>

               </div>
           </div>

           <div
               class="task-column w-full border font-medium flex gap-3 flex-col  border-[#E0E0E0] dark:border-[#383836] bg-[#FDFDFD] dark:bg-[#202020] rounded-lg px-4 py-3">
               <form method="POST" action="/mindforge/public/tasks/store" class="flex justify-between mb-2">
                   <div class="flex flex-row gap-2 items-center">
                       <svg class="dark:invert" width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <rect width="8" height="8" rx="4" fill="#191919" />
                       </svg>

                       <div> Completed <span class="text-grey-200">(<?= count($doneTasks) ?>)</span></div>
                   </div>

                   <input type="hidden" name="title" value="Untitled Task">
                   <input type="hidden" name="status" value="Done">
                   <input type="hidden" name="priority" value="Low">
                   <input type="hidden" name="deadline" value="<?php echo date('Y-m-d'); ?>">
                   <input type="hidden" name="project_id" value="">
                   <input type="hidden" name="note" value="describe task here...">

                   <button type="submit" class="border  border-[#E0E0E0] dark:border-[#383836] rounded-full p-1.5">
                       <svg class="dark:invert" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path
                               d="M12 2.67188C12.2859 2.67188 12.5605 2.78512 12.7627 2.9873C12.9649 3.18949 13.0781 3.46406 13.0781 3.75V10.9219H20.25C20.5359 10.9219 20.8105 11.0351 21.0127 11.2373C21.2149 11.4395 21.3281 11.7141 21.3281 12C21.3281 12.2859 21.2149 12.5605 21.0127 12.7627C20.8105 12.9649 20.5359 13.0781 20.25 13.0781H13.0781V20.25C13.0781 20.5359 12.9649 20.8105 12.7627 21.0127C12.5605 21.2149 12.2859 21.3281 12 21.3281C11.7141 21.3281 11.4395 21.2149 11.2373 21.0127C11.0351 20.8105 10.9219 20.5359 10.9219 20.25V13.0781H3.75C3.46406 13.0781 3.18949 12.9649 2.9873 12.7627C2.78512 12.5605 2.67188 12.2859 2.67188 12C2.67188 11.7141 2.78512 11.4395 2.9873 11.2373C3.18949 11.0351 3.46406 10.9219 3.75 10.9219H10.9219V3.75C10.9219 3.46406 11.0351 3.18949 11.2373 2.9873C11.4395 2.78512 11.7141 2.67188 12 2.67188Z"
                               fill="#656565" stroke="#959595" stroke-width="0.09375" />
                       </svg>

                   </button>
               </form>

               <div data-status="Done" class="task-list flex flex-col gap-3 min-h-[50px]">

                   <?php foreach ($doneTasks as $task): ?>
                       <div
                           class="task-card openmodalTask cursor-move w-full flex flex-col gap-3 p-3 border border-[#E0E0E0] dark:border-[#383836] rounded-lg"

                           data-id="<?= $task['id'] ?>"
                           data-title="<?= htmlspecialchars($task['title']) ?>"
                           data-note="<?= htmlspecialchars($task['note'] ?? '') ?>"
                           data-priority="<?= $task['priority'] ?>"
                           data-status="<?= $task['status'] ?>"
                           data-deadline="<?= $task['deadline'] ?>"
                           data-project="<?= $task['project_id'] ?? '' ?>">

                           <p class="<?= priorityColor($task['priority']) ?> px-3 py-1 rounded-full text-xs w-fit">
                               <?= htmlspecialchars($task['priority']) ?>
                           </p>

                           <h3 class="font-medium ">
                               <?= htmlspecialchars($task['title']) ?>
                           </h3>

                           <p class="text-grey-300 text-[15px]">
                               <?= htmlspecialchars($task['note'] ?? '') ?>
                           </p>

                           <div class="flex justify-between items-center border-t border-[#E0E0E0] dark:border-[#383836] pt-2 mt-2 text-xs">

                               <span
                                   title="<?= htmlspecialchars($task['project_name'] ?? '') ?>"
                                   class="px-2 py-0.5 rounded-md bg-blue-100 text-blue-600 
                                    dark:bg-blue-900/30 dark:text-blue-400
                                    max-w-[120px] truncate inline-block">

                                   <?= htmlspecialchars($task['project_name'] ?? 'No Project') ?>
                               </span>

                               <span class="px-2 py-0.5 rounded-md bg-gray-100 text-gray-500 
                                            dark:bg-[#2a2a2a] dark:text-gray-300">
                                   <?= htmlspecialchars($task['deadline'] ?? '') ?>
                               </span>



                           </div>

                       </div>
                   <?php endforeach; ?>

               </div>
           </div>
       </div>

       <?php $this->component('form-edit-task', ['projects' => $projects]); ?>

   </main>

   <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>


   <script>
       let pressTimer;
       let isLongPress = false;
       const LONG_PRESS_DURATION = 600;

       function createActionMenu(taskId) {
           const div = document.createElement('div');
           div.id = "active-action-menu";
           div.className = "mt-1 mb-1 text-xs rounded-lg shadow-sm flex justify-center animate-in fade-in slide-in-from-top-1";
           div.innerHTML = `
                <button onclick="event.stopPropagation(); confirmDelete('${taskId}')" class=" font-bold flex justify-center items-center text-red-500 transition">
                    
                
                Delete task
                </button>
            `;
           return div;
       }

       function confirmDelete(id) {
           if (confirm('Hapus task ini?')) {

               const form = document.createElement('form');
               form.method = 'POST';
               form.action = `/mindforge/public/tasks/delete`;

               const input = document.createElement('input');
               input.type = 'hidden';
               input.name = 'id';
               input.value = id;

               form.appendChild(input);
               document.body.appendChild(form);
               form.submit();
           }
       }

       function clearActiveState() {
           document.querySelectorAll('.task-card').forEach(card => card.classList.remove('is-active'));
           const existingMenu = document.getElementById('active-action-menu');
           if (existingMenu) existingMenu.remove();
       }

       document.addEventListener('mousedown', handleStart);
       document.addEventListener('touchstart', handleStart);
       document.addEventListener('mouseup', handleEnd);
       document.addEventListener('touchend', handleEnd);

       function handleStart(e) {
           const card = e.target.closest('.task-card');
           if (!card) return;

           isLongPress = false;
           pressTimer = setTimeout(() => {
               isLongPress = true;
               clearActiveState();

               card.classList.add('is-active');
               const menu = createActionMenu(card.dataset.id);
               card.parentNode.insertBefore(menu, card.nextSibling);

               if (window.navigator.vibrate) window.navigator.vibrate(50);
           }, LONG_PRESS_DURATION);
       }

       function handleEnd() {
           clearTimeout(pressTimer);
       }

       document.addEventListener('click', function(e) {
           const card = e.target.closest('.task-card');

           if (card) {
               if (isLongPress) {

                   e.stopImmediatePropagation();
                   e.preventDefault();
                   isLongPress = false;
               } else {

                   if (!e.target.closest('#active-action-menu')) {
                       clearActiveState();
                   }
               }
           } else {
               clearActiveState();
           }
       }, true);

       document.addEventListener('contextmenu', e => {
           if (e.target.closest('.task-card')) e.preventDefault();
       });
   </script>

   <script>
       const priorityInput =
           document.getElementById('priorityInput');

       const projectInput =
           document.getElementById('projectInput');

       const priorityLabel =
           document.getElementById('priorityLabel');

       const projectLabel =
           document.getElementById('projectLabel');

       document
           .querySelectorAll('.priority-option')
           .forEach(btn => {

               btn.addEventListener('click', () => {

                   priorityInput.value =
                       btn.dataset.value;

                   priorityLabel.textContent =
                       btn.textContent.trim();

                   priorityMenu.classList.add('hidden');
               });

           });

       document
           .querySelectorAll('.project-option')
           .forEach(btn => {

               btn.addEventListener('click', () => {

                   projectInput.value =
                       btn.dataset.value;

                   projectLabel.textContent =
                       btn.textContent.trim();

                   projectMenu.classList.add('hidden');
               });

           });
   </script>


   <script>
       document.addEventListener("DOMContentLoaded", function() {

           const columns = document.querySelectorAll('.task-list');

           columns.forEach(list => {
               new Sortable(list, {
                   group: 'kanban',
                   animation: 200,
                   ghostClass: 'opacity-40',
                   forceFallback: true,
                   dragClass: 'rotate-1',

                   onEnd: function(evt) {
                       const task = evt.item;
                       const taskId = task.dataset.id;
                       const newStatus = evt.to.dataset.status;

                       fetch('/mindforge/public/tasks/update-status', {
                               method: 'POST',
                               headers: {
                                   'Content-Type': 'application/json'
                               },
                               body: JSON.stringify({
                                   id: taskId,
                                   status: newStatus
                               })
                           })
                           .then(async res => {
                               const text = await res.text();
                               try {
                                   return JSON.parse(text);
                               } catch (err) {
                                   console.error("Server returned non-JSON response:", text);
                                   throw new Error("Invalid JSON response from server");
                               }
                           })
                           .then(data => {
                               if (data.success) {

                                   task.setAttribute('data-status', newStatus);
                               } else {
                                   console.error("Update failed:", data.error);
                               }
                           })
                           .catch(err => console.error("Fetch Error:", err));
                   }
               });
           });

       });
   </script>
   <script>
       const priorityBtn =
           document.getElementById('priorityBtn');

       const priorityMenu =
           document.getElementById('priorityMenu');

       priorityBtn.addEventListener('click', () => {
           priorityMenu.classList.toggle('hidden');
       });

       const projectBtn =
           document.getElementById('projectBtn');

       const projectMenu =
           document.getElementById('projectMenu');

       projectBtn.addEventListener('click', () => {
           projectMenu.classList.toggle('hidden');
       });

       document.addEventListener('click', (e) => {

           if (!priorityBtn.contains(e.target) &&
               !priorityMenu.contains(e.target)) {

               priorityMenu.classList.add('hidden');
           }

           if (!projectBtn.contains(e.target) &&
               !projectMenu.contains(e.target)) {

               projectMenu.classList.add('hidden');
           }

       });
   </script>