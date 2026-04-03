<?php $this->component('sidebar'); ?>
<?php $this->component('nav-mobile'); ?>

<main class="flex-1 xl:ml-64 mb-6 flex-col flex gap-6 p-6">

        <div
            class="bg-[#F7F7F7] hidden  dark:bg-[#2a2a2a] font-medium xl:flex justify-between items-center rounded-lg w-fit p-1.5">
            <a class="px-2.5 py-1" href="index.html">Mindforge</a>
            <a class="px-2.5 py-1 rounded bg-white dark:bg-grey-500" href="projects.html">Analytics</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Card 1: Weekly Activity -->
                <div class="bg-white dark:bg-[#202020] p-4 rounded-xl shadow-sm border dark:border-gray-700">
                    <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">
                        Weekly Activity
                    </h2>
                    <canvas id="activityChart"></canvas>
                </div>

                <!-- Card 2: Task Completion -->
                <div class="bg-white dark:bg-[#202020] p-4 rounded-xl shadow-sm border dark:border-gray-700">
                    <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">
                        Task Completion
                    </h2>
                    <canvas id="taskChart"></canvas>
                </div>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Card 3: Focus Time -->
                <div class="bg-white dark:bg-[#202020] p-4 rounded-xl shadow-sm border dark:border-gray-700">
                    <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">
                        Focus Time (Hours)
                    </h2>
                    <canvas id="focusChart"></canvas>
                </div>

                <!-- Card 4: Mood Tracking -->
                <div class="bg-white dark:bg-[#202020] p-4 rounded-xl shadow-sm border dark:border-gray-700 md:col-span-2">
                    <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">
                        Mood Tracking
                    </h2>
                    <canvas id="moodChart"></canvas>
                </div>

            </div>


</main>


<script>
    const isDark = document.documentElement.classList.contains("dark");

    const textColor = isDark ? "#E5E7EB" : "#374151";
    const gridColor = isDark ? "#444" : "#E5E7EB";

    // Weekly Activity (Bar)
    new Chart(document.getElementById("activityChart"), {
        type: "bar",
        data: {
            labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
            datasets: [{
                label: "Tasks",
                data: [5, 7, 3, 8, 6, 4, 2],
                backgroundColor: "#111827"
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
                x: { ticks: { color: textColor }, grid: { color: gridColor } },
                y: { ticks: { color: textColor }, grid: { color: gridColor } }
            }
        }
    });

    // Task Completion (Doughnut)
    new Chart(document.getElementById("taskChart"), {
        type: "doughnut",
        data: {
            labels: ["Completed", "Pending"],
            datasets: [{
                data: [75, 25],
                backgroundColor: ["#111827", "#9CA3AF"]
            }]
        },
        options: {
            plugins: {
                legend: {
                    labels: { color: textColor }
                }
            }
        }
    });

    // Focus Time (Line)
    new Chart(document.getElementById("focusChart"), {
        type: "line",
        data: {
            labels: ["Week 1", "Week 2", "Week 3", "Week 4"],
            datasets: [{
                label: "Hours",
                data: [10, 14, 8, 16],
                borderColor: "#111827",
                tension: 0.4
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
                x: { ticks: { color: textColor }, grid: { color: gridColor } },
                y: { ticks: { color: textColor }, grid: { color: gridColor } }
            }
        }
    });

    // Mood Tracking (Line)
    new Chart(document.getElementById("moodChart"), {
        type: "line",
        data: {
            labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
            datasets: [{
                label: "Mood Score",
                data: [3, 4, 2, 5, 4, 3, 4],
                borderColor: "#111827",
                tension: 0.4
            }]
        },
        options: {
            plugins: {
                legend: {
                    labels: { color: textColor }
                }
            },
            scales: {
                x: { ticks: { color: textColor }, grid: { color: gridColor } },
                y: {
                    ticks: { color: textColor },
                    grid: { color: gridColor },
                    min: 1,
                    max: 5
                }
            }
        }
    });
</script>