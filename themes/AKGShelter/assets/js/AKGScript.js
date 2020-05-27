console.log("akg script new loaded")

document.querySelector(".menu-toggle").addEventListener("click", function(){
    
    TweenMax.to(".menu-main-menu-container", 0.5, {
        delay: 0.1,
        display: "block"
    })
}
)
