<style>
    /* Hilangkan icon bawaan time */
.hide-time-icon::-webkit-calendar-picker-indicator {
    opacity: 0;
    display: none;
    -webkit-appearance: none;
}

/* Hilangkan tombol clear */
.hide-time-icon::-webkit-clear-button {
    display: none;
}

/* Hilangkan spinner */
.hide-time-icon::-webkit-inner-spin-button {
    display: none;
}

/* Hilangkan appearance bawaan */
.hide-time-icon {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: textfield;
}
</style>

<div id="eventPanelOverlay" class="fixed inset-0 hidden z-50 bg-black/10">

    <form method="POST" action="/mindforge/public/calendar/store" id="projectPanel"
        class="absolute right-0 top-0 h-screen w-full shadow-sm max-w-lg bg-white dark:bg-[#202020] border-l text-grey-500 dark:text-white border-[#E0E0E0] dark:border-[#383836] flex flex-col transform translate-x-full transition duration-300">

        <div class="flex items-center justify-between px-5 py-3">

            <button id="closeEventPanel" type="button"
                class="p-2 rounded-lg hover:bg-grey-100 dark:hover:bg-[#2a2a2a] transition">

                <svg class="dark:invert" width="22" height="22" viewBox="0 0 24 24" fill="none">
                    <path d="M12 18L18 12L12 6" stroke="#191919" stroke-width="1.8" />
                    <path d="M6 18L12 12L6 6" stroke="#191919" stroke-width="1.8" />
                </svg>

            </button>

            <button
                class="bg-grey-900 text-white text-sm px-3.5 py-2 font-medium rounded-lg
                hover:opacity-90 transition
                dark:bg-white dark:text-black">
                Submit
            </button>

        </div>

        <div class="px-14 pt-8 pb-6 overflow-y-auto flex-1">

            <input type="text" required name="title" placeholder="Untitled event..."
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

                    <span class="w-28 text-sm font-medium">Event Date</span>

                    <input required id="event_date" name="event_date" type="date"
                        class="flex-1 bg-transparent text-sm focus:outline-none font-semibold cursor-pointer">
                </div>

                <div class="group flex items-center gap-4 py-2 rounded-xl hover:bg-grey-50 dark:hover:bg-[#2a2a2a] transition-colors">
                    <div class="w-5 flex justify-center">

                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect x="4" y="6" width="17" height="14" rx="2" stroke="#656565" stroke-width="2" />
                            <rect x="4" y="10" width="17" height="2" fill="#656565" />
                            <path d="M8 3L8 6" stroke="#656565" stroke-width="2" stroke-linecap="round" />
                            <path d="M17 3L17 6" stroke="#656565" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </div>

                    <span class="w-28 text-sm font-medium">Start Time</span>

                    <input required id="start_time" name="start_time" type="time"
                        class="flex-1 bg-transparent hide-time-icon text-sm focus:outline-none font-semibold cursor-pointer">
                </div>

                <div class="group flex items-center gap-4 py-2 rounded-xl hover:bg-grey-50 dark:hover:bg-[#2a2a2a] transition-colors">
                    <div class="w-5 flex justify-center">

                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect x="4" y="6" width="17" height="14" rx="2" stroke="#656565" stroke-width="2" />
                            <rect x="4" y="10" width="17" height="2" fill="#656565" />
                            <path d="M8 3L8 6" stroke="#656565" stroke-width="2" stroke-linecap="round" />
                            <path d="M17 3L17 6" stroke="#656565" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </div>

                    <span class="w-28 text-sm font-medium">End Time</span>

                    <input required id="end_time" name="end_time" type="time"
                        class="flex-1 hide-time-icon bg-transparent text-sm focus:outline-none font-semibold cursor-pointer">
                </div>

            </div>

            <div class="space-y-3 text-sm mt-5">
                <textarea required name="description" placeholder="Enter project description..." 
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
    const dateInput = document.getElementById("event_date");

    dateInput.addEventListener("click", () => {
        dateInput.showPicker();
    });
</script>

<script>
    const timeInputs = document.getElementById("start_time");

    timeInputs.addEventListener("click", () => {
        timeInputs.showPicker();
    });
</script>

<script>
    const timeInput = document.getElementById("end_time");

    timeInput.addEventListener("click", () => {
        timeInput.showPicker();
    });
</script>

<script>
    const overlay = document.getElementById("eventPanelOverlay");
    const panel = document.getElementById("projectPanel");
    const openBtns = document.querySelectorAll(".openmodalEvent");
    const closeBtn = document.getElementById("closeEventPanel");

    openBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            overlay.classList.remove("hidden");
            setTimeout(() => {
                panel.classList.remove("translate-x-full");
            }, 10);
        });
    });

    function closePanel() {
        panel.classList.add("translate-x-full");
        setTimeout(() => {
            overlay.classList.add("hidden");
        }, 300);
    }

    closeBtn?.addEventListener("click", closePanel);

    overlay.addEventListener("click", (e) => {
        if (!panel.contains(e.target)) {
            closePanel();
        }
    });

    

    function setDropdown(name, value) {
        const dropdown = document.querySelector(`.custom-dropdown[data-name="${name}"]`);
        if (!dropdown) return;

        const input = dropdown.querySelector(".dropdown-input");
        const valueEl = dropdown.querySelector(".dropdown-value");

        const option = dropdown.querySelector(`.option[data-value="${value}"]`);

        if (option) {
            input.value = value;
            valueEl.textContent = option.textContent;


            valueEl.className = "dropdown-value text-sm font-semibold px-2 py-1 rounded-md w-fit";

            option.classList.forEach(cls => {
                if (cls.includes("bg-") || cls.includes("text-") || cls.includes("dark:")) {
                    valueEl.classList.add(cls);
                }
            });
        }
    }
</script>