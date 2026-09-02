const navlinks = document.querySelectorAll("#homenav a");

// Get previously selected link
const activePage = localStorage.getItem("activeNav");

if (activePage) {
    navlinks.forEach(link => {
        if (link.getAttribute("href") === activePage) {
            link.classList.add("active");
        }
    });
}

// When clicked
navlinks.forEach(link => {
    link.addEventListener("click", function () {

        navlinks.forEach(item => {
            item.classList.remove("active");
        });

        this.classList.add("active");

        // Save selected page
        localStorage.setItem("activeNav", this.getAttribute("href"));
    });
});