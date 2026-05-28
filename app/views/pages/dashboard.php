    <?php $this->component('sidebar'); ?>

    <main class="flex-1 xl:ml-64 mb-6 flex-col flex gap-6">

        <!-- Navbar -->
        <div id="navbar" class=" hidden xl:flex items-center top-0 z-50 justify-between px-6 py-4 sticky 
            bg-white dark:bg-[#191919] transition">

            <div
                class="flex items-center border border-[#E0E0E0] dark:border-[#383836] 
                rounded-lg px-3 py-2 gap-2 focus-within:ring-1 focus-within:ring-grey-300 dark:focus-within:ring-[#444]">

                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                        stroke="#828282" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M21.0004 21.0004L16.6504 16.6504" stroke="#828282" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>

                <input type="text" placeholder="Search..." class="outline-none bg-transparent w-full text-sm 
                    text-grey-700 dark:text-white 
                    placeholder:text-grey-400 dark:placeholder:text-gray-400]">
            </div>

            <form method="POST" action="/mindforge/public/tasks/store" class="flex justify-between mb-2">
                <input type="hidden" name="title" value="Untitled Task">
                <input type="hidden" name="status" value="Todo">
                <input type="hidden" name="priority" value="Low">
                <input type="hidden" name="deadline" value="<?php echo date('Y-m-d'); ?>">
                <input type="hidden" name="project_id" value="">
                <input type="hidden" name="note" value="">
                <input type="hidden" name="from" value="dashboard">

                <button type="submit" class="bg-grey-900 openmodalTask text-white text-sm px-3.5 py-2 font-medium rounded-lg 
                        hover:opacity-90 transition
                        dark:bg-white dark:text-black">
                    Create Task
                </button>
            </form>



        </div>

        <?php $this->component('nav-mobile'); ?>

        <!-- End Navbar -->

        <!-- Greeting Banner -->

        <div class="flex items-start justify-between px-6 ">
            <div class="flex gap-1 flex-col">
                <h1 class="text-[40px] font-bold">
                    Good morning, <span class="capitalize"><?= htmlspecialchars($_SESSION['user']['name']) ?></span>
                </h1>
                <p class="text-grey-300">
                    You have 5 tasks due today and 2 upcoming events. Let's make progress.
                </p>
            </div>

            <div class="relative">

                <button id="openNotifPanel"
                    class="rounded-full p-3 hidden mt-3 border border-[#E0E0E0] dark:border-[#383836] xl:flex items-center justify-center text-grey-400 hover:bg-grey-50 dark:hover:bg-[#2a2a2a] transition shrink-0">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="dark:invert">
                        <path
                            d="M6.44784 7.96942C6.76219 5.14032 9.15349 3 12 3C14.8465 3 17.2378 5.14032 17.5522 7.96942L17.804 10.2356C17.8072 10.2645 17.8088 10.279 17.8104 10.2933C17.9394 11.4169 18.3051 12.5005 18.8836 13.4725C18.8909 13.4849 18.8984 13.4973 18.9133 13.5222L19.4914 14.4856C20.0159 15.3599 20.2782 15.797 20.2216 16.1559C20.1839 16.3946 20.061 16.6117 19.8757 16.7668C19.5971 17 19.0873 17 18.0678 17H5.93223C4.91268 17 4.40291 17 4.12434 16.7668C3.93897 16.6117 3.81609 16.3946 3.77841 16.1559C3.72179 15.797 3.98407 15.3599 4.50862 14.4856L5.08665 13.5222C5.10161 13.4973 5.10909 13.4849 5.11644 13.4725C5.69488 12.5005 6.06064 11.4169 6.18959 10.2933C6.19123 10.279 6.19283 10.2645 6.19604 10.2356L6.44784 7.96942Z"
                            stroke="black" />
                        <path
                            d="M8 17C8 17.5253 8.10346 18.0454 8.30448 18.5307C8.5055 19.016 8.80014 19.457 9.17157 19.8284C9.54301 20.1999 9.98396 20.4945 10.4693 20.6955C10.9546 20.8965 11.4747 21 12 21C12.5253 21 13.0454 20.8965 13.5307 20.6955C14.016 20.4945 14.457 20.1999 14.8284 19.8284C15.1999 19.457 15.4945 19.016 15.6955 18.5307C15.8965 18.0454 16 17.5253 16 17"
                            stroke="black" stroke-linecap="round" />
                    </svg>


                </button>
                <span
                    id="notifBadge"
                    class="absolute top-2 -right-1 min-w-[24px] h-[24px]
           px-1 rounded-full bg-red-500 text-white
           text-[12px] flex items-center justify-center">

                    0
                </span>
            </div>




        </div>
        <!-- End Greeting Banner -->

        <div id="notifPanelOverlay" class="fixed inset-0 hidden z-50">

            <div id="notifBackdrop" class="absolute inset-0 bg-black/10"></div>

            <div id="notifPanel"
                class="absolute right-0 top-0 h-screen w-full max-w-md bg-white dark:bg-[#202020] border-l border-[#E0E0E0] dark:border-[#383836] transform translate-x-full transition duration-300 flex flex-col">

                <div class="px-5 pt-5 ">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold tracking-tight">Notifications</h2>

                        <button id="closeNotifPanel"
                            class="p-2 rounded-lg hidden hover:bg-grey-100 dark:hover:bg-[#2a2a2a] transition">
                            ✕
                        </button>
                    </div>



                </div>

                <div class="flex-1 overflow-y-auto px-5 py-4 space-y-6">
                    <div
                        id="notificationList"
                        class="flex-1 overflow-y-auto px-5 py-4">
                    </div>

                </div>

                <div class="px-5 py-3 flex justify-between items-center text-xs">

                    <button
                        onclick="markAllRead()"
                        class="text-zinc-400 hover:text-black dark:hover:text-white transition">

                        Mark all as read
                    </button>

                    <button class="text-blue-500 hover:opacity-80 transition">
                        Notification settings
                    </button>

                </div>

            </div>
        </div>


        <script>
            async function loadNotifications() {
                try {

                    const response = await fetch(
                        '/mindforge/public/notifications'
                    );

                    const result = await response.json();

                    let todayHtml = '';
                    let earlierHtml = '';

                    const today = new Date().toDateString();

                    result.data.forEach(notif => {

                        const notifDate =
                            new Date(notif.created_at).toDateString();

                        const item = `
                <div
                    class="group flex gap-3 p-3 rounded-xl
                    hover:bg-grey-50
                    dark:hover:bg-[#2a2a2a]
                    transition cursor-pointer">

                    <div class="
                        w-2 h-2 mt-2 rounded-full
                        ${notif.is_read == 0
                            ? 'bg-blue-500'
                            : 'bg-transparent'}
                    ">
                    </div>

                    <div class="flex-1">

                        <p class="text-sm font-medium">
                            ${notif.title}
                        </p>

                        <p class="text-xs text-zinc-400">
                            ${notif.message}
                        </p>

                    </div>

                    ${
                        notif.is_read == 0
                        ?
                        `
                        <button
                            onclick="markRead(${notif.id})"
                            class="opacity-0
                                   group-hover:opacity-100
                                   text-xs
                                   text-blue-500
                                   transition">

                            Mark read
                        </button>
                        `
                        :
                        ''
                    }

                </div>
            `;

                        if (notifDate === today) {
                            todayHtml += item;
                        } else {
                            earlierHtml += item;
                        }

                    });

                    document.getElementById(
                        'notificationList'
                    ).innerHTML = `
            <div>

                <p class="text-xs text-zinc-400 mb-3">
                    Today
                </p>

                <div class="space-y-2">
                    ${
                        todayHtml ||
                        '<p class="text-xs text-zinc-400">No notifications</p>'
                    }
                </div>

            </div>

            <div class="mt-6">

                <p class="text-xs text-zinc-400 mb-3">
                    Earlier
                </p>

                <div class="space-y-2">
                    ${
                        earlierHtml ||
                        '<p class="text-xs text-zinc-400">No older notifications</p>'
                    }
                </div>

            </div>
        `;

                } catch (error) {

                    console.error(
                        'Failed to load notifications:',
                        error
                    );

                }
            }

            async function loadUnreadCount() {
                try {

                    const response = await fetch(
                        '/mindforge/public/notifications/count'
                    );

                    const result = await response.json();

                    const badge =
                        document.getElementById('notifBadge');

                    badge.innerText = result.total;

                    if (result.total <= 0) {
                        badge.classList.add('hidden');
                    } else {
                        badge.classList.remove('hidden');
                    }

                } catch (error) {

                    console.error(
                        'Failed to load unread count:',
                        error
                    );

                }
            }

            async function markRead(id) {
                try {

                    await fetch(
                        '/mindforge/public/notifications/read', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'id=' + id
                        }
                    );

                    await loadNotifications();
                    await loadUnreadCount();

                } catch (error) {

                    console.error(
                        'Failed to mark notification:',
                        error
                    );

                }
            }

            async function markAllRead() {
                try {

                    await fetch(
                        '/mindforge/public/notifications/read-all', {
                            method: 'POST'
                        }
                    );

                    await loadNotifications();
                    await loadUnreadCount();

                } catch (error) {

                    console.error(
                        'Failed to mark all notifications:',
                        error
                    );

                }
            }

            document.addEventListener(
                'DOMContentLoaded',
                function() {

                    loadNotifications();
                    loadUnreadCount();

                    setInterval(() => {

                        loadNotifications();
                        loadUnreadCount();

                    }, 30000);

                }
            );
        </script>



        <!-- Summary Card-->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-[18px] px-6">
            <div
                class="w-full  bg-white dark:bg-[#202020] dark:border-[#383836] rounded-xl border border-[#E0E0E0] p-5">
                <h3 class="text-sm font-semibold  ">Active Projects</h3>
                <h2 class="text-[28px] font-semibold  "><?= htmlspecialchars($dashboardData['activeProjects']['total']) ?> Projects</h2>
                <h3 class="text-sm font-medium  text-grey-300"><span
                        class="text-[#166534] dark:text-[#4ade80]">+<?= htmlspecialchars($dashboardData['activeProjects']['thisMonth']) ?></span> this month</h3>
            </div>

            <div
                class="w-full  bg-white dark:bg-[#202020] dark:border-[#383836] rounded-xl border border-[#E0E0E0] p-5">
                <h3 class="text-sm font-semibold  ">Open Tasks</h3>
                <h2 class="text-[28px] font-semibold  "><?= htmlspecialchars($dashboardData['openTasks']['total']) ?> Tasks</h2>
                <h3 class="text-sm font-medium text-grey-300"><span
                        class="text-[#166534] dark:text-[#4ade80]">+<?= htmlspecialchars($dashboardData['openTasks']['dueToday']) ?></span> due today</h3>
            </div>

            <div
                class="w-full  bg-white rounded-xl dark:bg-[#202020] dark:border-[#383836] border border-[#E0E0E0] p-5">
                <h3 class="text-sm font-bold  ">Upcoming Events</h3>
                <h2 class="text-[28px] font-semibold  "><?= htmlspecialchars($dashboardData['upcomingEvents']['total']) ?> Events</h2>
                <h3 class="text-sm font-medium text-grey-300"><span
                        class="text-[#F59E0B] dark:text-[#fbbf24]">Next:</span> <?= htmlspecialchars($dashboardData['upcomingEvents']['next']) ?></h3>
            </div>

            <div
                class="w-full  bg-white rounded-xl dark:bg-[#202020] dark:border-[#383836] border border-[#E0E0E0] p-5">
                <h3 class="text-sm font-bold  ">Completion Rate</h3>
                <h2 class="text-[28px] font-semibold  "><?= htmlspecialchars($dashboardData['completionRate']['rate']) ?>%</h2>
                <h3 class="text-sm font-medium text-grey-300"><span class="text-[#166534] dark:text-[#4ade80]"><?= htmlspecialchars($dashboardData['completionRate']['trend']) ?></span>
                </h3>
            </div>
        </div>

        <!-- End Summary Card-->

        <?php
        $today = date('Y-m-d');

        $todayTasks = array_filter($tasks, function ($task) use ($today) {
            return $task['deadline'] === $today;
        });
        ?>

        <?php
        function priorityColor($priority)
        {
            return match ($priority) {
                'High' => 'bg-[#FFF1F2] text-[#F43F5E]  dark:bg-[#3a1a1f] dark:text-[#fb7185]',
                'Medium' => 'bg-[#FFFBEB] text-[#F59E0B]   dark:bg-[#3a2e12] dark:text-[#fbbf24]',
                'Low' => 'bg-[#D0F4DD] text-[#166534] dark:bg-[#123524] dark:text-[#4ade80]',
                default => 'bg-gray-100 text-gray-500'
            };
        }
        ?>

        <div class="flex flex-col xl:flex-row gap-6 px-6">
            <div
                class="xl:w-[65%] bg-white dark:bg-[#202020] dark:border-[#383836] rounded-xl border border-[#E0E0E0] p-6 ">
                <h2 class="text-base font-semibold mb-6 ">
                    Today's Tasks
                </h2>

                <div class="space-y-6">

                    <?php if (!empty($todayTasks)): ?>
                        <?php foreach ($todayTasks as $task): ?>

                            <div class="flex justify-between items-center">

                                <div class="flex gap-2 items-start flex-1">
                                    <label class="flex items-center cursor-pointer">

                                        <input
                                            type="checkbox"
                                            class="peer sr-only task-checkbox"
                                            data-id="<?= $task['id']; ?>"
                                            <?= $task['status'] === 'Done' ? 'checked' : '' ?> />

                                        <div class="w-4 h-4 border rounded border-[#E0E0E0] bg-white mt-1 
                                        dark:bg-[#191919] dark:border-[#383836] 
                                        peer-checked:bg-grey-900 peer-checked:border-grey-900 
                                        dark:peer-checked:bg-white dark:peer-checked:border-white 
                                        flex items-center justify-center transition">

                                            <svg class="w-3 h-3 text-white dark:text-grey-500 z-50 transition"
                                                fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                                <path d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                    </label>

                                    <div>
                                        <p class="text-base font-medium">
                                            <?= htmlspecialchars($task['title']); ?>
                                        </p>
                                        <p class="text-sm text-grey-400 font-regular">
                                            <?= htmlspecialchars($task['project_name'] ?? 'Add project please'); ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-end flex-col gap-2 text-xs font-medium text-grey-300 dark:text-grey-500">

                                    <span class="px-3 py-1 rounded-full <?= priorityColor($task['priority']) ?>">
                                        <?= htmlspecialchars($task['priority']); ?>
                                    </span>

                                    <span class="px-3 py-1 rounded-full 
                                bg-grey-100 text-grey-600
                                dark:bg-[#2a2a2a] dark:text-grey-300">
                                        <?= date('H:i', strtotime($task['deadline'])); ?>
                                    </span>

                                </div>
                            </div>
                        <?php endforeach; ?>

                    <?php else: ?>
                        <div class="flex flex-col items-center justify-center text-center">

                            <h3 class="text-base font-semibold text-grey-900 dark:text-white">
                                You're all caught up
                            </h3>

                            <p class="text-sm text-grey-400 mt-1 max-w-[240px] leading-relaxed">
                                No tasks scheduled for today. Take a break or plan your next move.
                            </p>

                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <script>
                document.querySelectorAll('.task-checkbox').forEach(cb => {
                    cb.addEventListener('change', function() {
                        const taskId = this.dataset.id;
                        const status = this.checked ? 'Done' : 'Todo';

                        fetch('/mindforge/public/tasks/update-status', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({
                                    id: taskId,
                                    status: status
                                })
                            })
                            .then(res => res.json())
                            .then(data => {
                                console.log(data);
                            })
                            .catch(err => console.error(err));
                    });
                });
            </script>

            <!-- Upcoming Events -->
            <div
                class="w-full xl:w-[35%] bg-white dark:bg-[#202020] dark:border-[#383836] rounded-xl border border-[#E0E0E0] p-6 shadow-sm">
                <h2 class="text-base font-semibold mb-6 ">
                    Upcoming Events
                </h2>
                <?php if (!empty($dashboardData['upcomingEvents']['list'])): ?>
                    <div class="space-y-6 relative">
                        <div class="absolute left-[9px] top-0 bottom-0 w-[2px] bg-[#EFEFEF] dark:bg-[#383836]"></div>

                        <?php foreach ($dashboardData['upcomingEvents']['list'] as $event):
                            // Format Waktu dan Tanggal secara dinamis
                            $eventDate = $event['event_date'];
                            $today = date('Y-m-d');

                            $startTime = date('H:i', strtotime($event['start_time']));
                            $endTime = (!empty($event['end_time'])) ? date('H:i', strtotime($event['end_time'])) : '';

                            // Cek apakah event hari ini atau bukan
                            if ($eventDate === $today) {
                                $dateDisplay = "Today, " . $startTime . ($endTime ? " – " . $endTime : "");
                            } else {
                                // Mengubah format menjadi: 26 Feb • 10:00
                                $dateDisplay = date('d M • ', strtotime($eventDate)) . $startTime;
                            }
                        ?>
                            <div class="flex gap-4">
                                <div class="relative flex flex-col items-center w-5">
                                    <span class="w-[10px] mt-1 h-[10px] bg-grey-500 dark:bg-white rounded-full"></span>
                                </div>

                                <div>
                                    <p class="text-base font-medium ">
                                        <?= htmlspecialchars($dateDisplay) ?>
                                    </p>
                                    <span
                                        class="inline-block capitalize font-medium mt-2 text-xs px-3 py-1 rounded-full dark:bg-[#2a2a2a] dark:text-grey-300 bg-grey-100 text-grey-500">
                                        <?= htmlspecialchars($event['title']) ?>
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    </div>
            </div>
        </div>


        <!-- Grafik -->

        <div class="flex flex-col xl:flex-row gap-6 px-6">

            <div
                class="xl:w-[60%] bg-white dark:bg-[#202020] dark:border-[#383836] rounded-xl border border-[#E0E0E0] p-6 pb-12 relative shadow-sm">
                <h2 class="text-base font-semibold mb-6 ">Task Completion Trend</h2>

                <div class="relative mx-2 h-48">

                    <div class="absolute inset-0 flex flex-col justify-between">
                        <div class="relative border-t border-grey-100 w-full h-0">
                            <span class="absolute -top-3 -left-2 text-grey-400 text-xs">22</span>
                        </div>
                        <div class="relative border-t border-grey-100 w-full h-0">
                            <span class="absolute -top-3 -left-2 text-grey-400 text-xs">22</span>
                        </div>
                        <div class="relative border-t border-grey-100 w-full h-0">
                            <span class="absolute -top-3 -left-2 text-grey-400 text-xs">19</span>
                        </div>
                        <div class="relative border-t border-grey-100 w-full h-0">
                            <span class="absolute -top-3 -left-2 text-grey-400 text-xs">25</span>
                        </div>
                        <div class="relative border-t border-grey-100 w-full h-0">
                            <span class="absolute -top-3 -left-2 text-grey-400 text-xs">28</span>
                        </div>
                    </div>

                    <svg viewBox="0 0 512 207" class="absolute inset-0 w-full h-full overflow-visible dark:invert"
                        fill="none" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M493 19L429.643 79.2087C429.135 79.6908 428.42 79.8841 427.739 79.7228L400.544 73.2744C400.044 73.1559 399.519 73.2276 399.069 73.4754L261.212 149.407C260.692 149.693 260.075 149.743 259.517 149.543L227.747 138.181C227.186 137.98 226.565 138.031 226.044 138.321L126.21 193.889C125.969 194.023 125.704 194.108 125.43 194.138L26.3545 205L2 205"
                            stroke="black" stroke-width="5" stroke-linecap="round" />

                        <circle cx="493" cy="19" r="6" fill="black" />
                        <circle opacity="0.1" cx="493" cy="19" r="18" fill="black" />
                    </svg>

                    <div class="absolute -bottom-10 left-0 right-0 flex justify-between text-[11px] text-grey-400">
                        <span>23 Nov</span>
                        <span>24 Feb</span>
                        <span>25 Feb</span>
                        <span>26 Feb</span>
                        <span>27 Feb</span>
                    </div>
                </div>
            </div>

            <div class="xl:w-[40%] bg-white dark:bg-[#202020] border border-[#E0E0E0] dark:border-[#383836] rounded-xl p-6 shadow-sm">

                <h2 class="text-base font-semibold mb-6 text-grey-500 dark:text-white">
                    <?= count($dashboardData['projectDistribution']) >= 5 ? 'Top 5 ' : '' ?>Task Distribution by Project
                </h2>

                <div class="space-y-4">
                    <?php if (!empty($dashboardData['projectDistribution'])): ?>
                        <?php foreach ($dashboardData['projectDistribution'] as $project): ?>
                            <div class="group relative">

                                <div class="bg-grey-100 dark:bg-[#2a2a2a] rounded-full h-7 overflow-hidden relative cursor-pointer">

                                    <div class="bg-grey-500 dark:bg-white h-7 rounded-full transition-all duration-500"
                                        style="width: <?= $project['percentage'] ?>%;">
                                    </div>

                                    <div class="absolute inset-0 flex justify-between items-center px-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">

                                        <span class="text-xs font-semibold text-white dark:text-gray-900 truncate max-w-[70%] drop-shadow-[0_1px_2px_rgba(0,0,0,0.4)] dark:drop-shadow-none">
                                            <?= htmlspecialchars($project['name']) ?>
                                        </span>

                                        <span class="text-[11px] font-bold text-white dark:text-gray-900 drop-shadow-[0_1px_2px_rgba(0,0,0,0.4)] dark:drop-shadow-none">
                                            <?= $project['task_count'] ?> Tasks (<?= $project['percentage'] ?>%)
                                        </span>
                                    </div>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-6 text-sm text-gray-400">
                            No data available. Create a project and tasks first.
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        <!-- End Grafik -->


    </main>


    <script>
        const openNotif = document.getElementById("openNotifPanel");
        const notifOverlay = document.getElementById("notifPanelOverlay");
        const notifPanel = document.getElementById("notifPanel");
        const closeNotif = document.getElementById("closeNotifPanel");
        const backdrop = document.getElementById("notifBackdrop");

        openNotif.addEventListener("click", () => {
            notifOverlay.classList.remove("hidden");

            setTimeout(() => {
                notifPanel.classList.remove("translate-x-full");
            }, 10);
        });

        function closePanel() {
            notifPanel.classList.add("translate-x-full");

            setTimeout(() => {
                notifOverlay.classList.add("hidden");
            }, 300);
        }

        closeNotif.addEventListener("click", closePanel);
        backdrop.addEventListener("click", closePanel);
    </script>