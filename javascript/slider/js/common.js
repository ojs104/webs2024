hljs.highlightAll();

//모달
const modalBtn = document.querySelector(".modal__btn");
const modalClose = document.querySelector(".modal__close");
const modalCont = document.querySelector(".modal__cont");

modalBtn.addEventListener("click", () => {
    modalCont.classList.add("show");
    modalCont.classList.remove("hide");
})

modalClose.addEventListener("click", () => {
    modalCont.classList.add("hide");
})

//탭메뉴
const tabBtn = document.querySelectorAll(".modal__box .tabs > div");
const tabCont = document.querySelectorAll(".modal__box .cont > div");

tabBtn.forEach((element, index) => {
    element.addEventListener("click", (e) => {
        e.preventDefault();

        tabBtn.forEach(li => li.classList.remove("active"));        
        element.classList.add("active");

        tabCont.forEach(div => div.style.display = "none");
        tabCont[index].style.display = "block";
    })
})