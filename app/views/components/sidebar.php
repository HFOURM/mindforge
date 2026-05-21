<aside id="sidebar-nav"
    class="fixed w-full  top-0 left-0 z-40 h-screen xl:w-64 transform -translate-x-full lg:translate-x-0  transition-transform duration-300 flex flex-col justify-between shrink-0 px-3 py-5  bg-white dark:bg-[#202020]  border-r border-[#E5E7EB] dark:border-[#383836]">

        <div class="flex flex-col gap-6">
            <div class="flex flex-row justify-between items-center">
                <h2 class="text-xl pl-3 font-semibold">
                    Mindforge
                </h2>

            <button onclick="toggleSidebar()" class="lg:hidden p-2 mr-2">
                close
            </button>
            </div>

            <nav class="space-y-4">
                <div>
                    <h3 class=" font-semibold  mb-1 pl-3">
                        Overview
                    </h3>

                    <a href="<?php echo BASE_URL; ?>/"
                        class="flex items-center px-3 py-2 rounded-lg mb-1">
                        <img src="<?php echo BASE_URL; ?>/icons/home.png" class="w-5 h-5 mr-3 dark:invert" />
                        <span class="text-base font-medium dark:text-white text-grey-900">Dashboard</span>
                    </a>

                    <a href="<?php echo BASE_URL; ?>/tasks"
                        class="flex items-center px-3 py-2 rounded-lg hover:bg-grey-50 dark:hover:bg-[#2A2A2A]  transition mb-1">
                        <img src="<?php echo BASE_URL; ?>/icons/list.png" class="w-5 h-5 mr-3 dark:invert" />
                        <span class="text-base font-medium dark:text-white text-grey-900">My Tasks</span>
                    </a>
                </div>

                <div>
                    <h3 class="font-semibold  mb-1 pl-3">
                        Workspace
                    </h3>

                    <a href="<?php echo BASE_URL; ?>/projects"
                        class="flex items-center px-3 py-2 rounded-lg hover:bg-grey-50 dark:hover:bg-[#2A2A2A]  transition mb-1">
                        <img src="<?php echo BASE_URL; ?>/icons/Folder.png" class="w-5 h-5 mr-3 dark:invert" />
                        <span class="text-base font-medium dark:text-white text-grey-900">Projects</span>
                    </a>


                    <a href="<?php echo BASE_URL; ?>/calendar"
                        class="flex items-center px-3 py-2 rounded-lg hover:bg-grey-50 dark:hover:bg-[#2A2A2A]  transition">
                        <img src="<?php echo BASE_URL; ?>/icons/Date_today.png" class="w-5 h-5 mr-3 dark:invert" />
                        <span class="text-base font-medium dark:text-white text-grey-900">Calendar</span>
                    </a>
                </div>

                <div>
                    <h3 class=" font-semibold  mb-1 pl-3">
                        Insight
                    </h3>

                    <a href="<?php echo BASE_URL; ?>/analytics"
                        class="flex items-center px-3 py-2 rounded-lg hover:bg-grey-50 dark:hover:bg-[#2A2A2A]  transition">
                        <img src="<?php echo BASE_URL; ?>/icons/Frame 4.png" class="w-5 h-5 mr-3 dark:invert" />
                        <span class="text-base font-medium dark:text-white text-grey-900">Analytics</span>
                    </a>
                </div>

            </nav>
        </div>

        <div>
            <a href="<?php echo BASE_URL; ?>/settings" class="flex items-center px-3 py-2 rounded-lg hover:bg-grey-50 dark:hover:bg-[#2A2A2A] transition">

                <img src="<?php echo BASE_URL; ?>/icons/Setting_line.png" class="w-5 h-5 mr-3 dark:invert" />

                <span class="text-base font-medium dark:text-white text-grey-900">Settings</span>
            </a>
        </div>

    </aside>