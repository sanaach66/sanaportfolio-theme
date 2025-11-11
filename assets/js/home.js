/**
 * -----------------------------------------------------------------------------
 * ----------------------------------------------------------------------------
 *          JS for adding animation to About section
 * ------------------------------------------------------------------------------
 * -------------------------------------------------------------------------------
 */

/*
document.addEventListener("DOMContentLoaded", () => {
  const fadeElements = document.querySelectorAll(".fade-in");

  const observer = new IntersectionObserver(
    (entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.2 }
  );

  fadeElements.forEach(el => observer.observe(el));
});
*/

// ===============================
// Fade-In on Scroll Animation Script
// ===============================
// This script waits for the DOM to load, then observes all elements
// with the class `.fade-in`. When they appear in the viewport (20% visible),
// it adds the `.visible` class to trigger a CSS fade-in animation.
// ===============================

document.addEventListener("DOMContentLoaded", initFadeInAnimation);

/**
 * Initializes the fade-in animation behavior after DOM is ready.
 */
function initFadeInAnimation() {
  // Select all elements that should fade in
  const fadeElements = document.querySelectorAll(".fade-in");

  // Create an IntersectionObserver to detect when elements enter the viewport
  const observer = new IntersectionObserver(handleIntersection, {
    threshold: 0.2 // 20% of the element must be visible before triggering
  });

  // Observe each fade-in element
  fadeElements.forEach(el => observer.observe(el));
}

/**
 * Handles intersection (visibility) changes for observed elements.
 * @param {IntersectionObserverEntry[]} entries - Array of observed entries
 * @param {IntersectionObserver} observer - The observer instance
 */
function handleIntersection(entries, observer) {
  entries.forEach(entry => {
    // Check if the element is currently visible in the viewport
    if (entry.isIntersecting) {
      // Add the "visible" class to trigger the CSS fade-in animation
      entry.target.classList.add("visible");

      // Stop observing this element once it has become visible
      observer.unobserve(entry.target);
    }
  });
}
