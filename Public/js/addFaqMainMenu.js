let navbar = document.querySelector(".navbar .navbar-nav");
let liTag = document.createElement("li");
let aTag = document.createElement("a");
let linkText = document.createTextNode("FAQ");
aTag.title = "FAQ";
aTag.href = "/hc/766851457";
aTag.appendChild(linkText);
liTag.appendChild(aTag);
navbar.prepend(liTag)