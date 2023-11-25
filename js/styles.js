(function () {
    // Styles adjustments for the social media aside on desktop
  const heroSection = document.getElementById("hero-section");
  if (heroSection) {
    const stickyElementDesktop = document.getElementById("block-13");
    const heightStickyElement = stickyElementDesktop.offsetHeight;

    const heightOfScreen = Math.max(
      document.documentElement.clientHeight || 0,
      window.innerHeight || 0
    );

    if (stickyElementDesktop) {
      stickyElementDesktop.style.top = `${
        heightOfScreen - heightStickyElement - 8 * 2
      }px`;
    }
  }
})();
