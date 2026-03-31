(function () {
    if (localStorage.getItem("theme") === "dark") {
        document.documentElement.classList.add("dark");
    }
})();

document.addEventListener("DOMContentLoaded", function () {

    const currentPath = window.location.pathname.split("/").pop();
    const navLinks = document.querySelectorAll("#sidebar-nav a");

    const isDark = document.documentElement.classList.contains("dark");

    navLinks.forEach(link => {
        const linkPath = link.getAttribute("href");
        link.classList.remove(
            "bg-grey-100",
            "bg-[#2A2A2A]",
            "bg-[#ffffff0e]",
            "text-[#191919]",
            "text-white",
            "text-grey-500"
        );

        if (currentPath === linkPath) {
            if (isDark) {
                link.classList.add(
                    "bg-[#ffffff0e]",
                    "text-white"
                );
            } else {
                link.classList.add(
                    "bg-grey-100",
                    "text-[#191919]"
                );
            }

        } else {
            if (isDark) {
                link.classList.add("text-white");
            } else {
                link.classList.add("text-grey-500");
            }

        }
    });
});