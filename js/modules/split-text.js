import { SplitText } from "../SplitText.js";
import { ScrambleTextPlugin } from "../ScrambleTextPlugin.js";

export function splitText() {
  gsap.registerPlugin(SplitText);
  gsap.registerPlugin(ScrambleTextPlugin);

  const skills = document.querySelectorAll('.skills');

  function animateSkills() {
    const timeline = gsap.timeline({ repeat: -1 });

    skills.forEach((skill, index) => {
      const split = new SplitText(skill, { type: 'chars' });
      const startTime = index === 0 ? 0 : '+=0.1';

      timeline
        .set(skill, { autoAlpha: 1, visibility: 'visible' }, startTime)
        .from(split.chars, {
          duration: 0.1,
          autoAlpha: 0,
          stagger: { each: 0.05 },
        }, '<')
        .to(skill, {
          autoAlpha: 0,
          visibility: 'hidden',
          duration: 0.3,
          delay: 0.5,
        }, '<0.5');
    });
  }
  animateSkills();
}