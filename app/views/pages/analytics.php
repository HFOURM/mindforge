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
?>

<main class="flex-1 xl:ml-64 mb-6 flex flex-col gap-6 p-6">

    <div class="bg-[#F7F7F7] hidden dark:bg-[#2a2a2a] font-medium xl:flex rounded-lg w-fit p-1.5">
        <a class="px-4 py-2" href="#">Mindforge</a>
        <a class="px-4 py-2 rounded bg-white dark:bg-grey-500" href="#">Analytics</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="w-full bg-white dark:bg-[#202020] dark:border-[#383836] rounded-xl border border-[#E0E0E0] p-6 ">

            <div class="flex justify-between  dark:border-gray-700">
                <div>
                    <p class="text-base font-semibold mb-6">
                        Activities this week
                    </p>
                </div>

                <div>
                    <span
                        class="inline-flex items-center bg-green-100 text-green-600 text-xs font-medium px-2 py-1 rounded">
                        ↑ <?= $activityGrowth ?? 0 ?>%
                    </span>
                </div>
            </div>

            <div id="ActivityChart"></div>

        </div>

        <div class="w-full bg-white dark:bg-[#202020] dark:border-[#383836] rounded-xl border border-[#E0E0E0] p-6 ">
            <div class="pb-4 ">
                <h5 class="text-base font-semibold mb-2">Task Completion</h5>
            </div>

            <div class="mt-4" style="position: relative; height: 260px; width: 100%;">
                <div id="taskCompletionChart"></div>
            </div>
        </div>

        



    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const isDark = document.documentElement.classList.contains("dark");

        const textColor = isDark ? "#E5E7EB" : "#374151";
        const gridColor = isDark ? "#444444" : "#E5E7EB";

        const mainColor = isDark ? "#FFFFFF" : "#111827";

        const pendingColor = isDark ? "#6B7280" : "#9CA3AF";

        const pieBorder = isDark ? "#202020" : "#FFFFFF";

        const labels = <?= json_encode($activityLabels) ?>;
        const data = <?= json_encode($activityData) ?>;

        const chartColor = isDark ? '#FFFFFF' : '#191919';

        const getTextColor = () => {
            return document.documentElement.classList.contains('dark') ?
                '#D1D5DB' :
                '#6B7280';
        };

        const options = {
            series: [{
                name: 'Focus Hours',
                data: data
            }],

            chart: {
                type: 'area',
                height: 288,
                toolbar: {
                    show: false
                },
                fontFamily: 'Inter, sans-serif'
            },

            colors: [chartColor],

            stroke: {
                curve: 'smooth',
                width: 4
            },

            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.5,
                    opacityTo: 0,
                    stops: [0, 100]
                }
            },

            dataLabels: {
                enabled: false
            },

            xaxis: {
                categories: labels,
                labels: {
                    style: {
                        colors: getTextColor()
                    }
                },
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                }
            },

            yaxis: {
                labels: {
                    style: {
                        colors: getTextColor()
                    }
                }
            },

            grid: {
                borderColor: '#E5E7EB',
                strokeDashArray: 4
            },

            tooltip: {
                y: {
                    formatter: function(value) {
                        return value + ' hrs';
                    }
                }
            },

            legend: {
                show: false
            }
        };

        const chart = new ApexCharts(
            document.querySelector("#ActivityChart"),
            options
        );

        chart.render();

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

        

    });
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const isDark = document.documentElement.classList.contains("dark");

    const primaryColor = isDark
        ? "#FFFFFF"
        : "#191919";

    const secondaryColor = isDark
        ? "#52525B"
        : "#D4D4D8";

    const taskLabels = <?= json_encode($taskLabels) ?>;
    const taskData   = <?= json_encode($taskData) ?>;

    const taskChartOptions = {
        series: taskData,

        labels: taskLabels,

        colors: [
            primaryColor,
            secondaryColor
        ],

        chart: {
            type: "donut",
            height: 320,
            fontFamily: "Inter, sans-serif",
            toolbar: {
                show: false
            }
        },

        stroke: {
            colors: ["transparent"]
        },

        plotOptions: {
            pie: {
                donut: {
                    size: "72%",

                    labels: {
                        show: true,

                        name: {
                            show: true
                        },

                        value: {
                            show: true
                        },

                        total: {
                            show: true,
                            label: "Tasks",

                            formatter: function () {
                                return taskData.reduce(
                                    (total, current) => total + current,
                                    0
                                );
                            }
                        }
                    }
                }
            }
        },

        dataLabels: {
            enabled: false
        },

        legend: {
            position: "bottom",
            fontSize: "14px"
        },

        tooltip: {
            theme: isDark ? "dark" : "light",

            y: {
                formatter: function (value) {
                    return value + " task";
                }
            }
        },

        responsive: [
            {
                breakpoint: 480,

                options: {
                    chart: {
                        height: 280
                    }
                }
            }
        ]
    };

    const taskChart = new ApexCharts(
        document.querySelector("#taskCompletionChart"),
        taskChartOptions
    );

    taskChart.render();

});
</script>


