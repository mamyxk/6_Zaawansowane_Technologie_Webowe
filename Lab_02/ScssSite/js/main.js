function toggleMobileMenu(){
    var menu = document.getElementById('menu')
    var span = document.getElementById('mobile')
    
    if(menu.className === "navbar__menu"){
        menu.className += " active"
    } else{
        menu.className = "navbar__menu"
    }

    if(span.className === "navbar__mobile"){
        span.className += " active"
    } else{
        span.className = "navbar__mobile"
    }
}