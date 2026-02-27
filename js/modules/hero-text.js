import gsap from "gsap";
import SplitText from "../SplitText.js";

export function heroText() {

 gsap.registerPlugin(SplitText);

  const skills = document.querySelectorAll('.skills');

  function animateSkills() {
    const timeline = gsap.timeline({ repeat: -1 });

    skills.forEach((skill) => {
      const split = new SplitText(skill, { type: 'chars' });

      timeline
        .set(skill, { autoAlpha: 1, visibility: 'visible' })
        .from(split.chars, {
          duration: 0.1,
          autoAlpha: 0,
          stagger: { each: 0.05 },
        })
        .to(skill, {
          autoAlpha: 0,
          visibility: 'hidden',
          duration: 0.3,
          delay: 0.5,
        });
    });
  }
  animateSkills();
}