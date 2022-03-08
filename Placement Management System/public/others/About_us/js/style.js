// const parentcontainer = document.querySelector('.read-more');
// parentcontainer.addEventListener('click', event=>{
//     const current = event.target;
//     const isReadMoreBtn =current.className.includes('read-more-btn');
//     if(!isReadMoreBtn) return;

//     const currentText = event.target.parentNode.querySelector('.read-more-text');

//     currentText.classList.toggle('read-more-text--show');
// })
function myFunction() {
    var dots = document.getElementById("dots");
    var moreText = document.getElementById("more");
    var btnText = document.getElementById("myBtn");
  
    if (dots.style.display === "none") {
      dots.style.display = "inline";
      btnText.innerHTML = "Read more"; 
      moreText.style.display = "none";
    } else {
      dots.style.display = "none";
      btnText.innerHTML = "Read less"; 
      moreText.style.display = "inline";
    }
  }