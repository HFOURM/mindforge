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
            <path d="M17 3L8 12L17 21" stroke="#191919" stroke-width="2"/>
            </svg>

        </a>

        <h1 class="text-3xl font-semibold text-grey-500 dark:text-white">
            <?= date('F', strtotime("$year-$month-01")) ?>
            <span class="font-regular"><?= $year ?></span>
        </h1>

        <a href="?month=<?= $nextMonth ?>&year=<?= $nextYear ?>">
            <svg class="dark:invert" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7 3L16 12L7 21" stroke="#191919" stroke-width="2"/>
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

            <?php if ($isToday): ?>
                <span class="bg-grey-500 dark:bg-white text-white dark:text-grey-500 w-7 h-7 flex items-center justify-center rounded-full">
                    <?= $day ?>
                </span>
            <?php else: ?>
                <div><?= $day ?></div>
            <?php endif; ?>

            <?php if (isset($tasks[$day])): ?>

                <?php
                $dayTasks = $tasks[$day];
                $totalTask = count($dayTasks);
                ?>

                <div class="mt-2 bg-grey-500 text-sm font-medium dark:bg-white text-white dark:text-grey-500 px-2 py-1 rounded-md w-fit">
                    <?= $dayTasks[0]['title'] ?>
                </div>

                <?php if ($totalTask > 1): ?>
                    <div class="mt-2 text-sm px-2 py-1 bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400 w-fit rounded-md">
                        +<?= $totalTask - 1 ?> more
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

</div>
</div>
</div>
</main>