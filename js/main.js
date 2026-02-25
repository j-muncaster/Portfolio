import { aboutAnimation } from "./modules/about-animations.js";
import { burgerMenu } from "./modules/burger-menu.js";
import { burgerSubMenu } from "./modules/burger-sub-menu.js";
import { contactAnimation } from "./modules/contact-animations.js";
import { heroAnimation } from "./modules/hero-animation.js";
import { projectAnimation } from "./modules/project-animations.js";
import { scrollTo } from "./modules/scroll-to.js";
import { videoPlayer } from "./modules/video-player.js";

// ALL PAGES
    scrollTo();

// PAGE SPECIFIC
    if(document.body.dataset.page === "home") {
        burgerMenu();
        heroAnimation();
        videoPlayer();
    }else if(document.body.dataset.page === "contact"){
        burgerSubMenu();
        contactAnimation();
    }else if(document.body.dataset.page === "about"){
        burgerSubMenu();
        aboutAnimation();
    }else if(document.body.dataset.page === "project"){
        burgerSubMenu();
        projectAnimation();
    }