document.getElementById("btn-wema").onclick = function () {
    document.getElementById("wema").style.display= "block";
    document.getElementById("sterling").style.display="none";
    document.getElementById("monniepoint").style.display="none";
}
document.getElementById("btn-monniepoint").onclick = function () {
    document.getElementById("monniepoint").style.display="block";
    document.getElementById("sterling").style.display= "none";
    document.getElementById("wema").style.display="none";
}
document.getElementById("btn-sterling").onclick = function () {
    document.getElementById("sterling").style.display="block";
    document.getElementById("monniepoint").style.display= "none";
    document.getElementById("wema").style.display="none";
};


function toggleMenu() {
    var menu = document.getElementById('nav-menu');
    if (menu.style.display === 'block') {
        menu.style.display = 'none';
    } else {
        menu.style.display = 'block';
    }
}