const toggleBtn = document.getElementById("toggleBtn");
const sidebar = document.getElementById("sidebar");
const content = document.getElementById("content");
const overlay = document.getElementById("overlay");

toggleBtn.addEventListener("click", () => {
    if(window.innerWidth >= 992){
        // Desktop: collapse
        sidebar.classList.toggle("collapsed");
        content.classList.toggle("collapsed");
    } else {
        // Mobile: overlay
        sidebar.classList.toggle("show");
        overlay.classList.toggle("active");
    }
});

overlay.addEventListener("click", ()=>{
    sidebar.classList.remove("show");
    overlay.classList.remove("active");
});

window.addEventListener("resize", ()=>{
    if(window.innerWidth >= 992){
        sidebar.classList.remove("show");
        overlay.classList.remove("active");
    }
});
