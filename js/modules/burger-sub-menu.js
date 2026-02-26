export function burgerSubMenu() {

    const innerHamburger = document.querySelector("#inner-hamburger");
    const innerMobileMenu = document.querySelector("#inner-mobile-menu");

    if (innerHamburger && innerMobileMenu) {

        function toggleInnerMenu() {
            innerMobileMenu.classList.toggle("open");
            innerHamburger.classList.toggle("active");
        }

        innerHamburger.addEventListener("click", toggleInnerMenu);

        innerMobileMenu.querySelectorAll("a").forEach(link => {
            link.addEventListener("click", toggleInnerMenu);
        });
    }
}