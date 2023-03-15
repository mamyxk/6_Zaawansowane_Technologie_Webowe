function toggleMobileMenu(){
    var menu = document.getElementById('menu')
    var span = document.getElementById('mobile')
    
    if(menu.className === "navbar-menu"){
        menu.className += " active"
        span.className += " active"
    } else{
        menu.className = "navbar-menu"
        span.className = "navbar-mobile"
    }
}