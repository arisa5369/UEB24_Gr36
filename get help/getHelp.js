window.onscroll = function () {
    const backToTopButton = document.getElementById("back-to-top");
    if (document.documentElement.scrollTop > 100) {
        backToTopButton.classList.add("show");
    } else {
        backToTopButton.classList.remove("show");
    }
};


function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
}