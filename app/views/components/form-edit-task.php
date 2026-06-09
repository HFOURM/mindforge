<div id="taskPanelOverlay" class="fixed inset-0 hidden z-50  bg-black/10">

            <form method="POST" action="/mindforge/public/tasks/update" id="taskPanel" class="absolute right-0 top-0 h-screen w-full shadow-sm max-w-lg bg-white dark:bg-[#202020] border-l text-grey-500 dark:text-white border-[#E0E0E0] dark:border-[#383836] flex flex-col transform translate-x-full transition duration-300 ">
                

                <div class="flex items-center justify-between px-5 py-3 ">

                    <button id="closeTaskPanel" type="button"
                        class="p-2 rounded-lg hover:bg-grey-100 dark:hover:bg-[#2a2a2a] transition">

                        <svg class="dark:invert" width="22" height="22" viewBox="0 0 24 24" fill="none">
                            <path d="M12 18L18 12L12 6" stroke="#191919" stroke-width="1.8" />
                            <path d="M6 18L12 12L6 6" stroke="#191919" stroke-width="1.8" />
                        </svg>

                    </button>

                    <button id="saveStatus"
                        class="bg-grey-900 text-white text-sm px-3.5 py-2 font-medium rounded-lg
                hover:opacity-90 transition
                dark:bg-white dark:text-black">
                        Submit
                    </button>

                </div>

                <div class="px-14 pt-8 pb-6 overflow-y-auto flex-1">
                    <input type="text" name="title" placeholder="Untitled task..."
                        class="w-full text-3xl font-semibold  text-grey-500 dark:text-grey-100 placeholder-grey-300 dark:placeholder-grey-200 bg-transparent focus:outline-none mb-8" />

                    <div class="grid grid-cols-1 gap-2">

                        <div
                            class="group flex items-center gap-4 py-2 rounded-xl hover:bg-grey-50 dark:hover:bg-[#2a2a2a] transition-colors">
                            <div class="w-5 flex justify-center">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="4" y="6" width="17" height="14" rx="2" stroke="#656565" stroke-width="2" />
                                    <rect x="4" y="10" width="17" height="2" fill="#656565" />
                                    <path d="M8 3L8 6" stroke="#656565" stroke-width="2" stroke-linecap="round" />
                                    <path d="M17 3L17 6" stroke="#656565" stroke-width="2" stroke-linecap="round" />
                                </svg>

                            </div>
                            <span class="w-28 text-sm font-medium">Deadline</span>
                            <input id="deadlineInput" name="deadline" type="date" min="<?= date('Y-m-d') ?>"
                                class="flex-1 bg-transparent text-sm focus:outline-none  font-semibold cursor-pointer">
                        </div>

                        <input type="hidden" name="id" id="taskId">


                        <div class="custom-dropdown" data-name="priority_id">

                            <div 
                                class="dropdown-trigger group flex items-center gap-4 py-2 rounded-xl hover:bg-grey-50 dark:hover:bg-[#2a2a2a] cursor-pointer">

                                <div class="w-5 flex justify-center">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.6358 3.90949C15.2888 3.47412 15.6153 3.25643 15.9711 3.29166C16.3269 3.32689 16.6044 3.60439 17.1594 4.15938L19.8406 6.84062C20.3956 7.39561 20.6731 7.67311 20.7083 8.02888C20.7436 8.38465 20.5259 8.71118 20.0905 9.36424L18.4419 11.8372C17.88 12.68 17.5991 13.1013 17.3749 13.5511C17.2086 13.8845 17.0659 14.2292 16.9476 14.5825C16.7882 15.0591 16.6889 15.5557 16.4902 16.5489L16.2992 17.5038C16.2986 17.5072 16.2982 17.5089 16.298 17.5101C16.1556 18.213 15.3414 18.5419 14.7508 18.1351C14.7497 18.1344 14.7483 18.1334 14.7455 18.1315C14.7322 18.1223 14.7255 18.1177 14.7189 18.1131C11.2692 15.7225 8.27754 12.7308 5.88691 9.28108C5.88233 9.27448 5.87772 9.26782 5.86851 9.25451C5.86655 9.25169 5.86558 9.25028 5.86486 9.24924C5.45815 8.65858 5.78704 7.84444 6.4899 7.70202C6.49113 7.70177 6.49282 7.70144 6.49618 7.70076L7.45114 7.50977C8.44433 7.31113 8.94092 7.21182 9.4175 7.05236C9.77083 6.93415 10.1155 6.79139 10.4489 6.62514C10.8987 6.40089 11.32 6.11998 12.1628 5.55815L14.6358 3.90949Z"
                                            stroke="#656565" stroke-width="2" />
                                        <path d="M5 19L9.5 14.5" stroke="#656565" stroke-width="2"
                                            stroke-linecap="round" />
                                    </svg>
                                </div>

                                <span class="w-28 text-sm  font-medium">Priority</span>

                                <div class="dropdown-value  w-fit text-sm font-semibold px-2 py-1 rounded-md bg-gray-100 text-[#2a2a2a] 
                                                dark:bg-[#2a2a2a] dark:text-gray-200 
                                                cursor-pointer">
                                    Empty
                                </div>

                            </div>

                                <input type="hidden" name="priority" class="dropdown-input w-fit">

                            <div class="dropdown-menu hidden ml-[162px] mt-3 text-sm">

                                <div class="rounded-xl w-40 text-sm font-semibold flex flex-row gap-3">
                                    
                                    <div data-value="Low"
                                        class="option px-3 py-1 w-fit rounded-md bg-[#D0F4DD] text-[#166534] cursor-pointer dark:bg-[#123524] dark:text-[#4ade80]">
                                        Low</div>
                                    <div data-value="Medium"
                                        class="option px-3 py-1 rounded-md w-fit bg-[#FFFBEB] text-[#F59E0B]  cursor-pointer dark:bg-[#3a2e12] dark:text-[#fbbf24]">
                                        Medium
                                    </div>
                                    <div data-value="High"
                                        class="option px-3 py-1 rounded-md w-fit bg-[#FFF1F2] text-[#F43F5E]  cursor-pointer dark:bg-[#3a1a1f] dark:text-[#fb7185] ">
                                        High</div>

                                </div>

                            </div>

                        </div>

                        <div class="custom-dropdown" data-name="project_id">

                            <div class="dropdown-trigger group flex items-center gap-4 py-2 rounded-xl hover:bg-grey-50 dark:hover:bg-[#2a2a2a] cursor-pointer">
                                <div class="w-5 flex justify-center">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4 9C4 7.11438 4 6.17157 4.58579 5.58579C5.17157 5 6.11438 5 8 5H8.34315C9.16065 5 9.5694 5 9.93694 5.15224C10.3045 5.30448 10.5935 5.59351 11.1716 6.17157L11.8284 6.82843C12.4065 7.40649 12.6955 7.69552 13.0631 7.84776C13.4306 8 13.8394 8 14.6569 8H16C17.8856 8 18.8284 8 19.4142 8.58579C20 9.17157 20 10.1144 20 12V15C20 16.8856 20 17.8284 19.4142 18.4142C18.8284 19 17.8856 19 16 19H8C6.11438 19 5.17157 19 4.58579 18.4142C4 17.8284 4 16.8856 4 15V9Z"
                                        stroke="#656565" stroke-width="2" />
                                </svg>
                                </div>

                                <span class="w-28 text-sm font-medium">Project</span>

                                <div class="dropdown-value text-sm font-semibold px-2 py-1 rounded-md bg-gray-100 text-[#2a2a2a] 
                                                dark:bg-[#2a2a2a] dark:text-gray-200 
                                                cursor-pointer">
                                    Empty
                                </div>
                            </div>

                            <input type="hidden" name="project_id" class="dropdown-input">

                            <div class="dropdown-menu hidden ml-[162px] mt-3 text-sm">
                                <div class="flex gap-2 flex-wrap">

                                    <div class="option px-3 py-1 rounded-md font-semibold 
                                        bg-gray-100 text-[#2a2a2a] 
                                        dark:bg-[#2a2a2a] dark:text-gray-200 cursor-pointer"
                                        data-value="">
                                        Empty
                                    </div>

                                    <?php foreach ($projects as $project): ?>

                                        <div class="option px-3 py-1 rounded-md 
                                            bg-blue-100 text-blue-600 
                                            dark:bg-blue-900/30 dark:text-blue-400 
                                            cursor-pointer"
                                            data-value="<?= $project['id'] ?>">

                                            <?= htmlspecialchars($project['name']) ?>

                                        </div>

                                    <?php endforeach; ?>

                                </div>
                            </div>

                        </div>

                        <div class="custom-dropdown" data-name="status">

                            <div class="dropdown-trigger group flex items-center gap-4 py-2 rounded-xl hover:bg-grey-50 dark:hover:bg-[#2a2a2a] cursor-pointer">
                                <div class="w-5 flex justify-center">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12" cy="12" r="9" stroke="#656565" stroke-width="1.5" />
                                    <path d="M8 12L11 15L16 9" stroke="#656565" stroke-width="1.5" />
                                </svg>
                                </div>

                                <span class="w-28 text-sm font-medium">Status</span>

                                <div class="dropdown-value w-fit text-sm font-semibold px-2 py-1 rounded-md bg-gray-100 text-[#2a2a2a] 
                                                dark:bg-[#2a2a2a] dark:text-gray-200 
                                                cursor-pointer">
                                    Todo
                                </div>
                            </div>

                            <input type="hidden" name="status" class="dropdown-input" value="Todo">

                            <div class="dropdown-menu hidden ml-[162px] text-sm mt-3">
                                <div class="flex gap-2 flex-wrap">

                                    <div class="option px-3 py-1 rounded-md bg-gray-100 text-[#2a2a2a] 
                                                dark:bg-[#2a2a2a] dark:text-gray-200 
                                                cursor-pointer" data-value="Todo">
                                        Todo
                                    </div>

                                    <div class="option px-3 py-1 rounded-md text-[#F59E0B]  dark:bg-[#3a2e12] dark:text-[#fbbf24]
                                                cursor-pointer" data-value="In Progress">
                                        In Progress
                                    </div>

                                    <div class="option px-3 py-1 rounded-md text-[#166534] dark:bg-[#123524] dark:text-[#4ade80]
                                                cursor-pointer" data-value="Done">
                                        Done
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="space-y-3 text-sm  mt-5">
                        <textarea name="note" placeholder="Enter task note..."
                            class="flex-1 placeholder-grey-200 bg-transparent w-full focus:outline-none resize-none"
                            rows="4"></textarea>
                    </div>

                </div>

            </form>
        </div>
        
        <script>
            document.querySelectorAll(".custom-dropdown").forEach(dropdown => {
                const trigger = dropdown.querySelector(".dropdown-trigger");
                const menu = dropdown.querySelector(".dropdown-menu");
                const value = dropdown.querySelector(".dropdown-value");
                const input = dropdown.querySelector(".dropdown-input");

                // toggle
                trigger.addEventListener("click", () => {
                    menu.classList.toggle("hidden");
                });

                // pilih option
                dropdown.querySelectorAll(".option").forEach(opt => {
                    opt.addEventListener("click", (e) => {
                        e.stopPropagation();

                        value.textContent = opt.textContent;
                        input.value = opt.dataset.value;

                        // reset class (biar ga numpuk)
                        value.className = "dropdown-value text-sm font-semibold px-2 py-1 rounded-md w-fit";

                        // copy class warna dari option
                        opt.classList.forEach(cls => {
                            if (
                                cls.includes("bg-") ||
                                cls.includes("text-") ||
                                cls.includes("dark:")
                            ) {
                                value.classList.add(cls);
                            }
                        });

                        menu.classList.add("hidden");
                    });
                });

                // close kalau klik luar
                document.addEventListener("click", (e) => {
                    if (!dropdown.contains(e.target)) {
                        menu.classList.add("hidden");
                    }
                });
            });
</script>

<script>
    const editTaskDateInput = document.getElementById("deadlineInput");

    editTaskDateInput.addEventListener("click", () => {
        editTaskDateInput.showPicker();
    });
</script>

<script>
    const editTaskOverlay = document.getElementById("taskPanelOverlay");
    const editTaskPanel = document.getElementById("taskPanel");
    const editTaskBtns = document.querySelectorAll(".openmodalTask");
    const editTaskCloseBtn = document.getElementById("closeTaskPanel");

    function openEditTaskPanel(task) {

    console.log(task.dataset);

        editTaskOverlay.classList.remove("hidden");
        setTimeout(() => {
            editTaskPanel.classList.remove("translate-x-full");
        }, 10);

        document.querySelector('#taskPanel input[name="id"]').value = task.dataset.id;
        editTaskPanel.querySelector('input[name="title"]').value = task.dataset.title;
        editTaskPanel.querySelector('input[name="deadline"]').value = task.dataset.deadline;
        document.querySelector('#taskPanel textarea[name="note"]').value = task.dataset.note;

        setEditTaskDropdown("priority_id", task.dataset.priority);
        setEditTaskDropdown("status", task.dataset.status);
        setEditTaskDropdown("project_id", task.dataset.project);
    }

    

    function setEditTaskDropdown(name, value) {
        const dropdown = document.querySelector(`.custom-dropdown[data-name="${name}"]`);
        if (!dropdown) return;

        const input = dropdown.querySelector(".dropdown-input");
        const valueEl = dropdown.querySelector(".dropdown-value");

        const option = dropdown.querySelector(`.option[data-value="${value}"]`);

        if (option) {
            input.value = value;
            valueEl.textContent = option.textContent;

            // reset class
            valueEl.className = "dropdown-value text-sm font-semibold px-2 py-1 rounded-md w-fit";

            option.classList.forEach(cls => {
                if (cls.includes("bg-") || cls.includes("text-") || cls.includes("dark:")) {
                    valueEl.classList.add(cls);
                }
            });
        }
    }

    editTaskBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            openEditTaskPanel(btn);
        });
    });

    function closeEditTaskPanel() {
    editTaskPanel.classList.add("translate-x-full");
    setTimeout(() => {
        editTaskOverlay.classList.add("hidden");
    }, 300);
}

    editTaskCloseBtn?.addEventListener("click", closeEditTaskPanel);

    editTaskOverlay.addEventListener("click", (e) => {
        if (!editTaskPanel.contains(e.target)) {
            closeEditTaskPanel();
        }
    });

    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") {
            closeEditTaskPanel();
        }
    });
</script>