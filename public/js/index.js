// alert('tutu');
// scrollreavel
const sr2 = ScrollReveal();
sr2.reveal('.scroll',{duration : 350,origin : 'right',scale : 0.5,interval: 150,});
// click cookies
document.querySelector(".cookies").addEventListener("click", () =>{ 
document.querySelector(".cookies").style.display="none";});
// Retour achat
function delayBack() {
    setTimeout(function(){history.go(-1);}, 1000);
};
