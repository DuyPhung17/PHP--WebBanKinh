window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop >= 500 || document.documentElement.scrollTop >= 500) {
    document.getElementById("navbar").style.padding = "3px";
    document.getElementById("logo").style.width = "auto";
    document.getElementById("logo").style.height = "30px";
  } else {
    document.getElementById("navbar").style.padding = "15px";
    document.getElementById("logo").style.width = "auto";
    document.getElementById("logo").style.height = "50px";
  }
}

$(document).ready(function () {
  $.lockfixed("#sidebar", {offset: {top: 4, bottom: 4} });
 });