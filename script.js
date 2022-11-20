window.onload = function () {
  const hamburger = document.querySelector(".hamburger");
  const navlist = document.querySelector(".nav-list");
  const user = document.querySelector("#user-icon");
  const popup = document.querySelector(".popup");
  const x = document.querySelector(".x-mark");
  const html = document.querySelector(".html");
  const bodyCont = document.querySelector(".body-cont");
  var cart = document.getElementsByClassName("cart-login");
  var arrow = document.getElementsByClassName("arrow-login");

  hamburger.addEventListener("click", function () {
    hamburger.classList.toggle("active");
    navlist.classList.toggle("open");
  });

  window.onscroll = function () {
    hamburger.classList.remove("active");
    navlist.classList.remove("open");
  };

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

  for (var i = 0; i < cart.length; i++) {
    cart[i].addEventListener("click", function () {
      popup.classList.toggle("active");
      html.classList.toggle("disable-scroll");
      bodyCont.classList.toggle("blur");
    });
  }

  for (var j = 0; j < arrow.length; j++) {
    arrow[j].addEventListener("click", function () {
      popup.classList.toggle("active");
      html.classList.toggle("disable-scroll");
      bodyCont.classList.toggle("blur");
    });
  }
};
