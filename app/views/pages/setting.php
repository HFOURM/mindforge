  <?php $this->component('sidebar'); ?>
  
  <?php $this->component('nav-mobile'); ?>

  <main class="flex-1 xl:ml-64 mb-6 flex-col flex gap-6 p-6">

            <div
                class="bg-[#F7F7F7] hidden  dark:bg-[#2a2a2a] font-medium xl:flex justify-between items-center rounded-lg w-fit p-1.5">
                <a class="px-2.5 py-1" href="index.html">Mindforge</a>
                <a class="px-2.5 py-1 rounded bg-white dark:bg-grey-500" href="setting.html">Settings</a>
            </div>

            



            <div class="max-w-3xl flex flex-col gap-6">

                <div id="account" class="space-y-8">

                    <div>
                        <h2 class="text-sm font-semibold text-zinc-400 mb-4">Account</h2>

                        <form method="POST" action="<?php echo BASE_URL; ?>/settings/update" class="bg-white dark:bg-[#202020] border border-[#E5E7EB] dark:border-[#383836] rounded-xl p-5 shadow-sm space-y-4">
                            

                            <div>
                                <label class="text-xs text-zinc-400">Full Name</label>
                                <input type="text" name="name"
                                    value="<?= htmlspecialchars($user['name']) ?>" 
                                    class="w-full mt-1 rounded-lg px-3 py-2 text-sm
                                bg-grey-50 dark:bg-[#2a2a2a]
                                border border-zinc-200 dark:border-zinc-700 outline-none">


                            </div>

                            <div>
                                <label class="text-xs text-zinc-400">Email</label>
                                <input type="email" name="email"
                                    value="<?= htmlspecialchars($user['email']) ?>" 
                                    class="w-full mt-1 rounded-lg px-3 py-2 text-sm
                                bg-grey-50 dark:bg-[#2a2a2a]
                                border border-zinc-200 dark:border-zinc-700 outline-none">
                            </div>

                            <div class="">
                                <button type="submit"
                                    class="text-sm px-3 py-1.5  bg-blue-600 text-white rounded-lg">
                                    Save Changes
                                </button>
                            </div>

                            <div>
                                <a href="/mindforge/public/auth/logout"
                                class="text-sm px-3 py-1.5  bg-red-500 text-white rounded-lg">
                                Logout
                            </a>
                            </div>

                        </form>

                        
                    </div>

                </div>

                <div id="preferences" class=" space-y-8">

                    <div>
                        <h2 class="text-sm font-semibold text-zinc-400 mb-4">Appearance</h2>

                        <div
                            class="bg-white dark:bg-[#202020] border border-[#E5E7EB] dark:border-[#383836] rounded-xl p-5 flex justify-between items-center">

                            <div>
                                <p class="text-sm font-medium">Dark Mode</p>
                                <p class="text-xs pt-0.5 text-zinc-400">Switch theme</p>
                            </div>

                            <button id="themeToggle"
                                class="w-11 h-6 bg-zinc-300 dark:bg-zinc-700 rounded-full relative transition">
                                <span
                                    class="dot absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-all"></span>
                            </button>

                        </div>
                    </div>

                </div>

                <div id="notifications" class=" space-y-8">

                    <div>
                        <h2 class="text-sm font-semibold text-zinc-400 mb-4">Notifications</h2>

                        <div
                            class="bg-white dark:bg-[#202020] border border-[#E5E7EB] dark:border-[#383836] rounded-xl p-5 space-y-4">

                            <div class="flex justify-between items-center">
                                <p class="text-sm">Email Notifications</p>
                                <button class="w-11 h-6 bg-blue-600 rounded-full relative">
                                    <span class="absolute right-1 top-1 w-4 h-4 bg-white rounded-full"></span>
                                </button>
                            </div>

                            <div class="flex justify-between items-center">
                                <p class="text-sm">Push Notifications</p>
                                <button class="w-11 h-6 bg-zinc-300 rounded-full relative">
                                    <span class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full"></span>
                                </button>
                            </div>

                        </div>
                    </div>

                </div>



                <div class="space-y-4">
                    <h2 class="text-sm font-semibold text-zinc-400">Security</h2>

                    <div
                        class="bg-white dark:bg-[#202020] border border-[#E5E7EB] dark:border-[#383836] rounded-xl">

                        <div class="flex justify-between items-center p-5 border-b border-[#E5E7EB] dark:border-[#383836]">
                            <div>
                                <p class="text-sm font-medium">Password</p>
                                <p class="text-xs text-zinc-400 pt-0.5">Last changed 2 months ago</p>
                            </div>
                            <button
                                class="text-sm px-3 py-1.5 bg-grey-100 dark:bg-[#2a2a2a] rounded-lg hover:opacity-80">
                                Change
                            </button>
                        </div>

                        <div class="flex justify-between items-center p-5">
                            <div>
                                <p class="text-sm font-medium">Two-Factor Authentication</p>
                                <p class="text-xs text-zinc-400 pt-0.5">Add extra security</p>
                            </div>
                            <button class="w-11 h-6 bg-zinc-300 rounded-full relative">
                                <span class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full"></span>
                            </button>
                        </div>

                    </div>
                </div>

                <div class="space-y-4">
                    <h2 class="text-sm font-semibold text-zinc-400">Productivity</h2>

                    <div class="bg-white dark:bg-[#202020] border border-[#E5E7EB] dark:border-[#383836] rounded-xl p-5 space-y-4">

                        <div class="flex justify-between items-center">
                            <p class="text-sm">Auto-schedule tasks</p>
                            <button class="w-11 h-6 bg-blue-600 rounded-full relative">
                                <span class="absolute right-1 top-1 w-4 h-4 bg-white rounded-full"></span>
                            </button>
                        </div>

                        <div class="flex justify-between items-center">
                            <p class="text-sm">Focus Mode</p>
                            <select class="text-sm bg-grey-50 dark:bg-[#2a2a2a] border rounded-lg px-2 py-1">
                                <option>25 min</option>
                                <option>50 min</option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="space-y-4">
                    <h2 class="text-sm font-semibold text-red-400">Danger Zone</h2>

                    <div class="border border-red-300 rounded-xl p-5 flex justify-between items-center">

                        <div>
                            <p class="text-sm font-medium text-red-500">Delete Account</p>
                            <p class="text-xs text-zinc-400 pt-0.5">This action cannot be undone</p>
                        </div>

                        <button class="px-3 py-1.5 bg-red-500 text-white rounded-lg hover:opacity-80">
                            Delete
                        </button>

                    </div>
                </div>
            </div>

        </main>


        <script>
            const toggle = document.getElementById("themeToggle");

            if (localStorage.getItem("theme") === "dark") {
                document.documentElement.classList.add("dark");
                setToggle(true);
            }

            toggle.addEventListener("click", () => {
                const isDark = document.documentElement.classList.toggle("dark");
                localStorage.setItem("theme", isDark ? "dark" : "light");
                setToggle(isDark);
            });

            function setToggle(isDark) {
                const dot = toggle.querySelector(".dot");

                if (isDark) {
                    toggle.classList.add("bg-blue-600");
                    dot.style.transform = "translateX(20px)";
                } else {
                    toggle.classList.remove("bg-blue-600");
                    dot.style.transform = "translateX(0)";
                }
            }
        </script>