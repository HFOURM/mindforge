<?php $this->component('sidebar'); ?>
<?php $this->component('nav-mobile'); ?>

<main class="flex-1 xl:ml-64 mb-6 flex flex-col gap-6 p-6">

    <!-- Header Tabs -->
    <div class="bg-[#F7F7F7] hidden dark:bg-[#2a2a2a] font-medium xl:flex rounded-lg w-fit p-1.5">
        <a class="px-4 py-2" href="#">Mindforge</a>
        <a class="px-4 py-2 rounded bg-white dark:bg-grey-500" href="#">Analytics</a>
    </div>

    <!-- GRID -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Weekly Activity -->
        <div class="w-full bg-white dark:bg-[#202020] border rounded-xl shadow-sm p-6">
            <div class="pb-4 border-b">
                <h5 class="text-2xl font-bold">Weekly Activity</h5>
            </div>
            <div class="mt-4" style="position: relative; height: 288px; width: 100%;">
                <canvas id="activityChart"></canvas>
            </div>
        </div>

        <!-- Task Completion -->
        <div class="w-full bg-white dark:bg-[#202020] border rounded-xl shadow-sm p-6">
            <div class="pb-4 border-b">
                <h5 class="text-2xl font-bold">Task Completion</h5>
            </div>
            <div class="mt-4" style="position: relative; height: 288px; width: 100%;">
                <canvas id="trafficPieChart"></canvas>
            </div>
        </div>

        <!-- Focus Time -->
        <div class="w-full bg-white dark:bg-[#202020] border rounded-xl shadow-sm p-6">
            <div class="flex justify-between mb-6">
                <div>
                    <h5 class="text-2xl font-bold">Focus Time</h5>
                    <p class="text-sm text-gray-500">48 Hours</p>
                </div>
            </div>
            <div style="position: relative; height: 220px; width: 100%;">
                <canvas id="focusChart"></canvas>
            </div>
        </div>

        <!-- Mood Tracking -->
        <div class="w-full bg-white dark:bg-[#202020] border rounded-xl shadow-sm p-6">
            <div class="flex justify-between mb-6">
                <div>
                    <h5 class="text-2xl font-bold">Mood Tracking</h5>
                </div>
            </div>
            <div style="position: relative; height: 220px; width: 100%;">
                <canvas id="moodChart"></canvas>
            </div>
        </div>

    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const isDark = document.documentElement.classList.contains("dark");

    const textColor  = isDark ? "#E5E7EB" : "#374151";
    const gridColor  = isDark ? "#444444" : "#E5E7EB";

    const mainColor  = isDark ? "#FFFFFF" : "#111827";

    const pendingColor = isDark ? "#6B7280" : "#9CA3AF";

    const pieBorder  = isDark ? "#202020" : "#FFFFFF";

    new Chart(document.getElementById("activityChart"), {
        type: "bar",
        data: {
            labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
            datasets: [{
                data: [5, 7, 3, 8, 6, 4, 2],
                backgroundColor: mainColor,
                borderRadius: 8,
                barThickness: 28,
                maxBarThickness: 32
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: { padding: { top: 4, bottom: 0, left: 0, right: 4 } },
            plugins: { legend: { display: false } },
            scales: {
                x: {
                    ticks: { color: textColor, font: { size: 11 } },
                    grid: { display: false }
                },
                y: {
                    min: 0,
                    max: 8,
                    ticks: {
                        color: textColor,
                        font: { size: 11 },
                        stepSize: 1,
                        autoSkip: false,
                        maxTicksLimit: 9,
                        callback: function(value) {
                            return Number.isInteger(value) ? value : undefined;
                        }
                    },
                    grid: { color: gridColor }
                }
            }
        }
    });

    new Chart(document.getElementById("trafficPieChart"), {
        type: "pie",
        data: {
            labels: ["Completed", "Pending"],
            datasets: [{
                data: [66, 34],
                backgroundColor: [mainColor, pendingColor],
                borderColor: pieBorder,
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: "bottom",
                    labels: {
                        color: textColor,
                        font: { size: 12 },
                        usePointStyle: true,
                        pointStyle: "circle",
                        padding: 16
                    }
                }
            }
        }
    });

    new Chart(document.getElementById("focusChart"), {
        type: "line",
        data: {
            labels: ["Week 1", "Week 2", "Week 3", "Week 4"],
            datasets: [{
                data: [10, 14, 8, 16],
                borderColor: mainColor,
                backgroundColor: "transparent",
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: mainColor
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: {
                    ticks: { color: textColor, font: { size: 11 } },
                    grid: { color: gridColor }
                },
                y: {
                    min: 0,
                    max: 18,
                    ticks: {
                        color: textColor,
                        font: { size: 11 },
                        stepSize: 2,
                        autoSkip: false,
                        maxTicksLimit: 10,
                        callback: function(value) {
                            const list = [0,2,4,6,8,10,12,14,16,18];
                            return list.includes(value) ? value : undefined;
                        }
                    },
                    grid: { color: gridColor }
                }
            }
        }
    });

    new Chart(document.getElementById("moodChart"), {
        type: "line",
        data: {
            labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
            datasets: [{
                data: [3, 4, 2, 5, 4, 3, 4],
                borderColor: mainColor,
                backgroundColor: "transparent",
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: mainColor
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: {
                    ticks: { color: textColor, font: { size: 11 } },
                    grid: { color: gridColor }
                },
                y: {
                    min: 1,
                    max: 5,
                    ticks: {
                        color: textColor,
                        font: { size: 11 },
                        stepSize: 1,
                        autoSkip: false,
                        maxTicksLimit: 5,
                        callback: function(value) {
                            const list = [1,2,3,4,5];
                            return list.includes(value) ? value : undefined;
                        }
                    },
                    grid: { color: gridColor }
                }
            }
        }
    });

});
</script>