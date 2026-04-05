   <?php $this->component('sidebar'); ?>

   <?php
        $todoTasks = array_filter($tasks, fn($t) => $t['status'] === 'Todo');
        $progressTasks = array_filter($tasks, fn($t) => $t['status'] === 'In Progress');
        $doneTasks = array_filter($tasks, fn($t) => $t['status'] === 'Done');
    ?>

    <?php
        function priorityColor($priority) {
            return match($priority) {
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
                            data-project="<?= $task['project_id'] ?? '' ?>"
                        >
                            
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
                            data-project="<?= $task['project_id'] ?? '' ?>"
                        >
                            
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
                            data-project="<?= $task['project_id'] ?? '' ?>"
                        >
                            
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
        </div>

        <?php $this->component('form-edit-task', ['projects' => $projects]); ?>

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
        dragClass: 'rotate-1',

        onEnd: function (evt) {
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
                if(data.success) {
           
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