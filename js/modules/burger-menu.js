// MAIN HAMBURGER MENU (Homepage)
export function burgerMenu() {
    const hamburger = document.querySelector("#hamburger");
    const mobileMenu = document.querySelector("#mobile-menu");

    if (hamburger && mobileMenu) {

        function toggleMenu() {
            mobileMenu.classList.toggle("open");
            hamburger.classList.toggle("active");
        }

        hamburger.addEventListener("click", toggleMenu);

        mobileMenu.querySelectorAll("a").forEach(link => {
            link.addEventListener("click", toggleMenu);
        });
    }
}