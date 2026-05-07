<?php $this->component('sidebar'); ?>
<?php $this->component('nav-mobile'); ?>

<?php

    $activityLabels = [];
    $activityData = [];

    foreach ($weeklyActivity as $item) {
        $activityLabels[] = $item['day'];
        $activityData[] = $item['total_activity'];
    }

    $taskLabels = [];
    $taskData = [];

    foreach ($taskCompletion as $item) {
        $taskLabels[] = $item['status'];
        $taskData[] = $item['total'];
    }

    $focusLabels = [];
    $focusData = [];

    foreach ($focusTime as $item) {
        $focusLabels[] = $item['week'];
        $focusData[] = $item['total_hours'];
    }

    $moodLabels = [];
    $moodData = [];

    foreach ($moodTracking as $item) {
        $moodLabels[] = $item['day_name'];
        $moodData[] = $item['mood_level'];
    }

?>

<main class="flex-1 xl:ml-64 mb-6 flex flex-col gap-6 p-6">

    <!-- Header -->
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener("DOMContentLoaded", function () {

    const isDark = document.documentElement.classList.contains("dark");

    const textColor  = isDark ? "#E5E7EB" : "#374151";
    const gridColor  = isDark ? "#444444" : "#E5E7EB";

    const mainColor  = isDark ? "#FFFFFF" : "#111827";

    const pendingColor = isDark ? "#6B7280" : "#9CA3AF";

    const pieBorder  = isDark ? "#202020" : "#FFFFFF";

    // WEEKLY ACTIVITY
    new Chart(document.getElementById("activityChart"), {
        type: "bar",
        data: {
            labels: <?= json_encode($activityLabels) ?>,
            datasets: [{
                data: <?= json_encode($activityData) ?>,
                backgroundColor: mainColor,
                borderRadius: 8,
                barThickness: 28
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: textColor
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    ticks: {
                        color: textColor
                    },
                    grid: {
                        color: gridColor
                    }
                }
            }
        }
    });

    // TASK COMPLETION
    new Chart(document.getElementById("trafficPieChart"), {
        type: "pie",
        data: {
            labels: <?= json_encode($taskLabels) ?>,
            datasets: [{
                data: <?= json_encode($taskData) ?>,
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
                        color: textColor
                    }
                }
            }
        }
    });

    // FOCUS TIME
    new Chart(document.getElementById("focusChart"), {
        type: "line",
        data: {
            labels: <?= json_encode($focusLabels) ?>,
            datasets: [{
                data: <?= json_encode($focusData) ?>,
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
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: textColor
                    },
                    grid: {
                        color: gridColor
                    }
                },
                y: {
                    ticks: {
                        color: textColor
                    },
                    grid: {
                        color: gridColor
                    }
                }
            }
        }
    });

    // MOOD TRACKING
    new Chart(document.getElementById("moodChart"), {
        type: "line",
        data: {
            labels: <?= json_encode($moodLabels) ?>,
            datasets: [{
                data: <?= json_encode($moodData) ?>,
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
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: textColor
                    },
                    grid: {
                        color: gridColor
                    }
                },
                y: {
                    ticks: {
                        color: textColor
                    },
                    grid: {
                        color: gridColor
                    }
                }
            }
        }
    });

});

</script>