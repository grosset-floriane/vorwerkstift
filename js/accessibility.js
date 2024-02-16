/**
 * File accessibility.js.
 *
 * Handles add various accessibility cues
 * - add indication of opening tabs in new link
 */
const OPEN_TEXT = {
  de: "öffnet in einem neuen Tab",
  en: "opens in a new tab"
};

(function () {
  // Indicate a link is going to open in a new tab
  // Add noopener to prevent vulnerability
  function addNoOpener(link) {
    const linkTypes = (link.getAttribute("rel") || "").split(" ");
    if (!linkTypes.includes("noopener")) {
      linkTypes.push("noopener");
    }
    link.setAttribute("rel", linkTypes.join(" ").trim());
  }

  const lang = document.location.href.split("/")[3];

  function addNewTabMessage(link) {
    if (!link.querySelector(".screen-reader-only")) {
      link.insertAdjacentHTML(
        "beforeend",
        ` <span class="screen-reader-only">(${OPEN_TEXT[lang]})</span>`
      );
    }
  }

  document.querySelectorAll('a[target="_blank"]').forEach((link) => {
    addNoOpener(link);
    addNewTabMessage(link);
  });
})();
