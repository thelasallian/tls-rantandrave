window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
        document.getElementById("navbar").style.height = "4rem";
        document.getElementById("nav-logo").style.width = "2.5rem";
    } else {
        document.getElementById("navbar").style.height = "5.75rem";
        document.getElementById("nav-logo").style.width = "3rem";
    }
}