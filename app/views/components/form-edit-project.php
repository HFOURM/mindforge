<style>
/* Hilangkan icon bawaan time dan date */
.hide-time-icon::-webkit-calendar-picker-indicator {
    opacity: 0;
    display: none;
    -webkit-appearance: none;
}
.hide-time-icon::-webkit-clear-button { display: none; }
.hide-time-icon::-webkit-inner-spin-button { display: none; }
.hide-time-icon {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: textfield;
}
</style>

<div id="editProjectPanelOverlay" class="fixed inset-0 hidden z-50 bg-black/10">

    <form method="POST" action="/mindforge/public/project/update" id="editProjectPanel"
        class="absolute right-0 top-0 h-screen w-full shadow-sm max-w-lg bg-white dark:bg-[#202020] border-l text-grey-500 dark:text-white border-[#E0E0E0] dark:border-[#383836] flex flex-col transform translate-x-full transition duration-300">

        <div class="flex items-center justify-between px-5 py-3">

            <button id="closeEditProjectPanel" type="button"
                class="p-2 rounded-lg hover:bg-grey-100 dark:hover:bg-[#2a2a2a] transition">

                <svg class="dark:invert" width="22" height="22" viewBox="0 0 24 24" fill="none">
                    <path d="M12 18L18 12L12 6" stroke="#191919" stroke-width="1.8" />
                    <path d="M6 18L12 12L6 6" stroke="#191919" stroke-width="1.8" />
                </svg>

            </button>

            <input type="hidden" name="id" id="projectIdInput" >

            <button
                class="bg-grey-900 text-white text-sm px-3.5 py-2 font-medium rounded-lg
                hover:opacity-90 transition
                dark:bg-white dark:text-black">
                Submit
            </button>

        </div>

        <div class="px-14 pt-8 pb-6 overflow-y-auto flex-1">

            <input type="text" required name="title" placeholder="Untitled project..." id="projectTitleInput"
                class="w-full text-3xl font-semibold text-grey-500 dark:text-grey-100 placeholder-grey-300 dark:placeholder-grey-200 bg-transparent focus:outline-none mb-8" />

            <div class="grid grid-cols-1 gap-2">

                <div class="group flex items-center gap-4 py-2 rounded-xl hover:bg-grey-50 dark:hover:bg-[#2a2a2a] transition-colors">
                    <div class="w-5 flex justify-center">

                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect x="4" y="6" width="17" height="14" rx="2" stroke="#656565" stroke-width="2" />
                            <rect x="4" y="10" width="17" height="2" fill="#656565" />
                            <path d="M8 3L8 6" stroke="#656565" stroke-width="2" stroke-linecap="round" />
                            <path d="M17 3L17 6" stroke="#656565" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </div>

                    <span class="w-28 text-sm font-medium">Deadline</span>

                    <input required  id="projectDeadlineInput" name="deadline" type="date" min="<?= date('Y-m-d') ?>"
                        class="flex-1 bg-transparent text-sm focus:outline-none font-semibold cursor-pointer">
                </div>

                <div class="custom-dropdown" data-name="priority">

                    <div class="dropdown-trigger group flex items-center gap-4 py-2 rounded-xl hover:bg-grey-50 dark:hover:bg-[#2a2a2a] cursor-pointer">

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

                        <span class="w-28 text-sm font-medium">Priority</span>

                        <div class="dropdown-value text-sm font-semibold px-2 py-1 rounded-md bg-gray-100 text-[#2a2a2a] 
                            dark:bg-[#2a2a2a] dark:text-gray-200">
                            Empty
                        </div>

                    </div>

                    <input required type="hidden" name="priority" class="dropdown-input">

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

            </div>

            <div class="group flex items-start gap-4 py-2 rounded-xl hover:bg-grey-50 dark:hover:bg-[#2a2a2a] transition-colors">
                    <div class="w-5 flex justify-center mt-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" 
                                stroke="#656565" 
                                stroke-width="2" 
                                stroke-linecap="round" 
                                stroke-linejoin="round" />
                        </svg>
                    </div>

                    <div class="flex-1 flex flex-col gap-2">
                        <span class="text-sm font-medium">Set Reminder</span>

                        <select id="reminder_preset" onchange="handleReminderPreset(this)"
                            class="bg-transparent border border-[#E0E0E0] dark:border-[#383836] text-grey-900 dark:text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-grey-900 dark:focus:border-white transition-colors cursor-pointer">
                            <option value="">Tidak ada reminder</option>
                            <option value="at_start">Saat event dimulai</option>
                            <option value="1_hour">1 jam sebelum</option>
                            <option value="1_day">1 hari sebelum</option>
                            <option value="2_days">2 hari sebelum</option>
                            <option value="3_days">3 hari sebelum</option>
                            <option value="1_week">1 minggu sebelum</option>
                            <option value="custom">Custom</option>
                        </select>
                        
                        <div id="reminder_custom" class="hidden flex-col gap-2">
                            <div class="group flex items-center gap-4 py-2">
                                <span class="w-36 text-sm text-grey-500 dark:text-gray-400">Tanggal Reminder</span>
                                <input type="date" id="reminder_date" name="reminder_date"
                                    class="flex-1 bg-transparent hide-time-icon text-sm focus:outline-none font-semibold cursor-pointer [color-scheme:light] dark:[color-scheme:dark]">
                            </div>
                            <div class="group flex items-center gap-4 py-2">
                                <span class="w-36 text-sm text-grey-500 dark:text-gray-400">Jam Reminder</span>
                                <input type="time" id="reminder_time" name="reminder_time"
                                    class="flex-1 bg-transparent hide-time-icon text-sm focus:outline-none font-semibold cursor-pointer [color-scheme:light] dark:[color-scheme:dark]">
                            </div>
                        </div>

                        <input type="hidden" id="reminder" name="reminder">

                    <p class="text-xs text-grey-500 dark:text-gray-400">Kosongkan jika tidak perlu pengingat.</p>
                </div>
            </div>

            <div class="space-y-3 text-sm mt-5">
                <textarea required name="description" id="projectDescriptionInput" placeholder="Enter project description..." 
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

                trigger.addEventListener("click", () => {
                    menu.classList.toggle("hidden");
                });

                dropdown.querySelectorAll(".option").forEach(opt => {
                    opt.addEventListener("click", (e) => {
                        e.stopPropagation();

                        value.textContent = opt.textContent;
                        input.value = opt.dataset.value;

                        value.className = "dropdown-value text-sm font-semibold px-2 py-1 rounded-md w-fit";

                        const colorMap = {
                            Low: "bg-[#D0F4DD] text-[#166534] dark:bg-[#123524] dark:text-[#4ade80]",
                            Medium: "bg-[#FFFBEB] text-[#F59E0B] dark:bg-[#3a2e12] dark:text-[#fbbf24]",
                            High: "bg-[#FFF1F2] text-[#F43F5E] dark:bg-[#3a1a1f] dark:text-[#fb7185]"
                        };

                        value.className = "dropdown-value text-sm font-semibold px-2 py-1 rounded-md w-fit";

                        if (colorMap[input.value]) {
                            value.classList.add(...colorMap[input.value].split(" "));
                        }

                        menu.classList.add("hidden");
                    });
                });

                document.addEventListener("click", (e) => {
                    if (!dropdown.contains(e.target)) {
                        menu.classList.add("hidden");
                    }
                });
            });
</script>

<script>
    const dateInput = document.getElementById("projectDeadlineInput");

    dateInput.addEventListener("click", () => {
        dateInput.showPicker();
    });
</script>

<script>
    const editProjectOverlay = document.getElementById("editProjectPanelOverlay");
    const editProjectPanel = document.getElementById("editProjectPanel");
    const editProjectBtns = document.querySelectorAll(".openmodalProject");
    const editProjectCloseBtn = document.getElementById("closeEditProjectPanel");

    editProjectBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            editProjectOverlay.classList.remove("hidden");
            setTimeout(() => {
                editProjectPanel.classList.remove("translate-x-full");
            }, 10);

            // ambil data dari button/div
            const id = btn.dataset.id;
            const title = btn.dataset.title;
            const description = btn.dataset.description;
            const deadline = btn.dataset.deadline;
            const priority = btn.dataset.priority;

            // isi form
            document.getElementById("projectIdInput").value = id;
            document.getElementById("projectTitleInput").value = title;
            document.getElementById("projectDescriptionInput").value = description;
            document.getElementById("projectDeadlineInput").value = deadline;

            // isi custom dropdown priority
            setEditProjectDropdown("priority", priority);
        });
    });

    function closeEditProjectPanel() {
        editProjectPanel.classList.add("translate-x-full");
        setTimeout(() => {
            editProjectOverlay.classList.add("hidden");
        }, 300);
    }

    editProjectCloseBtn?.addEventListener("click", closeEditProjectPanel);

    editProjectOverlay.addEventListener("click", (e) => {
        if (!editProjectPanel.contains(e.target)) {
            closeEditProjectPanel();
        }
    });

    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") {
            closeEditProjectPanel();
        }
    });

    function setEditProjectDropdown(name, selectedValue) {

        const dropdown = document.querySelector(
            `.custom-dropdown[data-name="${name}"]`
        );

        if (!dropdown) return;

        const value = dropdown.querySelector(".dropdown-value");
        const input = dropdown.querySelector(".dropdown-input");

        input.value = selectedValue;
        value.textContent = selectedValue;

        const colorMap = {
            Low: "bg-[#D0F4DD] text-[#166534] dark:bg-[#123524] dark:text-[#4ade80]",
            Medium: "bg-[#FFFBEB] text-[#F59E0B] dark:bg-[#3a2e12] dark:text-[#fbbf24]",
            High: "bg-[#FFF1F2] text-[#F43F5E] dark:bg-[#3a1a1f] dark:text-[#fb7185]"
        };

        value.className =
            "dropdown-value text-sm font-semibold px-2 py-1 rounded-md w-fit";

        if (colorMap[selectedValue]) {
            value.classList.add(...colorMap[selectedValue].split(" "));
        }
    }
</script>

<script>
    function calculateReminder(presetValue, deadlineDate) {
        if (!deadlineDate) return '';
        // Karena form task/project biasanya tidak ada start_time, kita default jam 00:00 atau jam saat ini
        const defaultTime = "00:00"; 
        const dateObj = new Date(`${deadlineDate}T${defaultTime}:00`);
        
        if (isNaN(dateObj.getTime())) return '';
        
        const minutesToSubtract = parseInt(presetValue, 10);
        dateObj.setMinutes(dateObj.getMinutes() - minutesToSubtract);
        
        const tzOffset = dateObj.getTimezoneOffset() * 60000;
        const localISOTime = new Date(dateObj - tzOffset).toISOString().slice(0, 19).replace('T', ' ');
        return localISOTime;
    }

    function handleReminderPreset(select) {
        const customDiv = document.getElementById('reminder_custom');
        const reminderInput = document.getElementById('reminder');
        
        // Asumsi ID input deadline mu adalah "deadline"
        const deadlineInput = document.getElementById('deadline'); 
        const value = select.value;

        if (value === 'custom') {
            customDiv.classList.remove('hidden');
            customDiv.classList.add('flex');
            reminderInput.value = '';
        } else {
            customDiv.classList.add('hidden');
            customDiv.classList.remove('flex');
            reminderInput.value = calculateReminder(value, deadlineInput ? deadlineInput.value : '');
        }
    }

    // Trigger update jika opsi custom date & time diubah
    document.getElementById('reminder_date')?.addEventListener('change', updateCustomReminder);
    document.getElementById('reminder_time')?.addEventListener('change', updateCustomReminder);

    function updateCustomReminder() {
        const date = document.getElementById('reminder_date').value;
        const time = document.getElementById('reminder_time').value || '00:00';
        if (date) {
            document.getElementById('reminder').value = `${date} ${time}:00`;
        }
    }

    // Hitung ulang jika deadline diubah
    const deadlineInputListener = document.getElementById('deadline');
    if (deadlineInputListener) {
        deadlineInputListener.addEventListener('change', function() {
            const preset = document.getElementById('reminder_preset').value;
            if (preset && preset !== 'custom') {
                document.getElementById('reminder').value = calculateReminder(preset, this.value);
            }
        });
    }

    // Klik untuk buka picker kalender & jam custom
    document.getElementById("reminder_date")?.addEventListener("click", function() {
        this.showPicker();
    });
    document.getElementById("reminder_time")?.addEventListener("click", function() {
        this.showPicker();
    });
</script>