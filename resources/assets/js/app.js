$(document).foundation();

$(".c-hamburger").click(function () {
    $(".sideNav").addClass("active");
});

$(".sideNav-close").click(function () {
    $(".sideNav").removeClass("active");
});