window.onload = function () {
  const hamburger = document.querySelector(".hamburger");
  const navlist = document.querySelector(".nav-list");
  const user = document.querySelector(".user");
  const popup = document.querySelector(".popup");
  const x = document.querySelector(".x-mark2");
  const html = document.querySelector(".html");
  const bodyCont = document.querySelector(".body-cont");

  hamburger.addEventListener("click", function () {
    hamburger.classList.toggle("active");
    navlist.classList.toggle("open");
  });

  user.addEventListener("click", function () {
    popup.classList.toggle("active");
    html.classList.toggle("disable-scroll");
    bodyCont.classList.toggle("blur");
  });

  x.addEventListener("click", function () {
    popup.classList.remove("active");
    html.classList.remove("disable-scroll");
    bodyCont.classList.remove("blur");
  });

  window.onscroll = function () {
    hamburger.classList.remove("active");
    navlist.classList.remove("open");
    popup.classList.remove("active");
    html.classList.remove("disable-scroll");
    bodyCont.classList.remove("blur");
  };
};
