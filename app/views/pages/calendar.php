<?php $this->component('sidebar'); ?>
<?php $this->component('nav-mobile'); ?>

<?php
$month = isset($_GET['month']) ? (int)$_GET['month'] : date('n');
$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

if ($month < 1) {
    $month = 12;
    $year--;
}
if ($month > 12) {
    $month = 1;
    $year++;
}

$prevMonth = $month - 1;
$prevYear = $year;
if ($prevMonth < 1) {
    $prevMonth = 12;
    $prevYear--;
}

$nextMonth = $month + 1;
$nextYear = $year;
if ($nextMonth > 12) {
    $nextMonth = 1;
    $nextYear++;
}

$firstDay = date('w', strtotime("$year-$month-01"));
$totalDays = date('t', strtotime("$year-$month-01"));
$prevMonthDays = date('t', strtotime("$year-$month-01 -1 month"));


$today = date('j');
$currentMonth = date('n');
$currentYear = date('Y');

$days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
?>

<main class="xl:ml-64">

    <div class="h-screen flex flex-col ">


        <div class="flex flex-row justify-between p-6 items-center">
            <div
                class="bg-[#F7F7F7] hidden dark:bg-[#2a2a2a] font-medium xl:flex justify-between items-center rounded-lg w-fit p-1.5">
                <a class="px-2.5 py-1" href="<?php echo BASE_URL; ?>/">Mindforge</a>
                <a class="px-2.5 py-1 rounded bg-white dark:bg-grey-500" href="<?php echo BASE_URL; ?>/calendar">Calendar</a>
            </div>



            <div class="flex items-center gap-4">

                <a href="?month=<?= $prevMonth ?>&year=<?= $prevYear ?>"
                    class="rounded ">
                    <svg class="dark:invert" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 3L8 12L17 21" stroke="#191919" stroke-width="2" />
                    </svg>

                </a>

                <h1 class="text-3xl font-semibold text-grey-500 dark:text-white">
                    <?= date('F', strtotime("$year-$month-01")) ?>
                    <span class="font-regular"><?= $year ?></span>
                </h1>

                <a href="?month=<?= $nextMonth ?>&year=<?= $nextYear ?>">
                    <svg class="dark:invert" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 3L16 12L7 21" stroke="#191919" stroke-width="2" />
                    </svg>

                </a>

            </div>

        </div>

        <div class="flex flex-col flex-1">

            <div class="grid grid-cols-7 auto-rows-fr flex-1 px-6 pb-6">

                <?php
                $day = 1;
                $nextMonthDay = 1;

                for ($i = 0; $i < 35; $i++):

                    $col = $i % 7;
                    $isWeekend = ($col == 0 || $col == 6);
                ?>

                    <div class="border-[#E5E7EB] dark:border-[#383836] border-[0.5px] px-3 py-2 min-h-[100px]
            <?= $isWeekend ? 'bg-[#fafafa] dark:bg-[#202020]' : '' ?>">

                        <?php if ($i < 7): ?>
                            <div class="text-grey-500 dark:text-white">
                                <?= $days[$i] ?>
                            </div>
                        <?php endif; ?>

                        <?php
                        if ($i < $firstDay):
                            echo '<span class="text-gray-400">' . ($prevMonthDays - $firstDay + $i + 1) . '</span>';

                        elseif ($day <= $totalDays):

                            $isToday = ($day == $today && $month == $currentMonth && $year == $currentYear);
                        ?>

                            <div class="flex flex-row justify-between items-center">
                                <?php if ($isToday): ?>
                                    <span class="bg-grey-500 dark:bg-white text-white dark:text-grey-500 w-7 h-7 flex items-center justify-center rounded-full">
                                        <?= $day ?>
                                    </span>
                                <?php else: ?>
                                    <div><?= $day ?></div>
                                <?php endif; ?>

                                <button
                                    class="border openmodalEvent opacity-0 hover:opacity-100 border-[#E0E0E0] dark:border-[#383836] rounded-full p-0.5">
                                    <svg class="dark:invert" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12 2.67188C12.2859 2.67188 12.5605 2.78512 12.7627 2.9873C12.9649 3.18949 13.0781 3.46406 13.0781 3.75V10.9219H20.25C20.5359 10.9219 20.8105 11.0351 21.0127 11.2373C21.2149 11.4395 21.3281 11.7141 21.3281 12C21.3281 12.2859 21.2149 12.5605 21.0127 12.7627C20.8105 12.9649 20.5359 13.0781 20.25 13.0781H13.0781V20.25C13.0781 20.5359 12.9649 20.8105 12.7627 21.0127C12.5605 21.2149 12.2859 21.3281 12 21.3281C11.7141 21.3281 11.4395 21.2149 11.2373 21.0127C11.0351 20.8105 10.9219 20.5359 10.9219 20.25V13.0781H3.75C3.46406 13.0781 3.18949 12.9649 2.9873 12.7627C2.78512 12.5605 2.67188 12.2859 2.67188 12C2.67188 11.7141 2.78512 11.4395 2.9873 11.2373C3.18949 11.0351 3.46406 10.9219 3.75 10.9219H10.9219V3.75C10.9219 3.46406 11.0351 3.18949 11.2373 2.9873C11.4395 2.78512 11.7141 2.67188 12 2.67188Z"
                                            fill="#656565" stroke="#959595" stroke-width="0.09375" />
                                    </svg>

                                </button>
                            </div>

                            <?php if (isset($events[$day])): ?>
                                <?php
                                $dayEvents = $events[$day];
                                $totalEvents = count($dayEvents);
                                ?>
                                <div class="mt-2 bg-blue-500 text-sm font-medium text-white px-2 py-1 rounded-md w-fit truncate max-w-full">
                                    <?= htmlspecialchars($dayEvents[0]['title']) ?>
                                </div>

                                <?php if ($totalEvents > 1): ?>
                                    <div onclick="openDayEventsModal(<?= htmlspecialchars(json_encode($dayEvents), ENT_QUOTES, 'UTF-8') ?>, '<?= "$year-" . str_pad($month, 2, '0', STR_PAD_LEFT) . "-" . str_pad($day, 2, '0', STR_PAD_LEFT) ?>')"
                                        class="mt-2 text-sm px-2 py-1 bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-300 w-fit rounded-md cursor-pointer hover:opacity-80">
                                        +<?= $totalEvents - 1 ?> more
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

                        <?php
                            $day++;
                        else:
                            echo '<span class="text-gray-400">' . $nextMonthDay++ . '</span>';
                        endif;
                        ?>
                    </div>
                <?php endfor; ?>

                <div id="dayEventsModal" class="fixed inset-0 hidden z-50 flex items-center justify-center">
                    <div class="absolute inset-0 bg-black/40" onclick="closeDayEventsModal()"></div>
                    <div class="relative bg-white dark:bg-[#1c1c1c] w-[350px] max-h-[500px] overflow-y-auto rounded-xl p-4 shadow-xl">
                        <h2 id="dayEventsTitle" class="text-lg font-semibold mb-3 text-black dark:text-white">Events</h2>
                        <div id="dayEventsContent" class="flex flex-col gap-3"></div>
                        <div class="flex justify-end mt-4">
                            <button onclick="closeDayEventsModal()" class="text-sm text-gray-500 hover:text-black dark:hover:text-white">
                                Close
                            </button>
                        </div>
                    </div>
                </div>


                <?php $this->component('form-add-event'); ?>
            </div>
        </div>
</main>


<script>
    function openDayEventsModal(events, date) {
        const modal = document.getElementById('dayEventsModal');
        const content = document.getElementById('dayEventsContent');
        const title = document.getElementById('dayEventsTitle');

        content.innerHTML = '';

        title.innerText = new Date(date).toLocaleDateString('en-US', {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });

        events.forEach(event => {
            const div = document.createElement('div');
            div.className = "border border-gray-200 dark:border-[#383836] rounded-lg p-3";

            const startTime = event.start_time ? event.start_time.substring(0, 5) : '';
            const endTime = event.end_time ? event.end_time.substring(0, 5) : '';
            const timeRange = startTime ? `${startTime} - ${endTime}` : 'All Day';

            div.innerHTML = `
                <div class="font-medium text-black dark:text-white">${event.title}</div>
                <div class="text-sm text-gray-500 mt-1">${event.description ?? ''}</div>
                <div class="flex justify-between mt-2 text-xs text-gray-400">
                    <span class="px-2 py-0.5 rounded bg-gray-100 dark:bg-[#2a2a2a] text-gray-600 dark:text-gray-300">
                        ${timeRange}
                    </span>
                </div>
            `;
            content.appendChild(div);
        });

        modal.classList.remove('hidden');
    }

    function closeDayEventsModal() {
        document.getElementById('dayEventsModal').classList.add('hidden');
    }
</script>