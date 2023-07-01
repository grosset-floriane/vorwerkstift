/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */

;(function () {
  const siteNavigation = document.getElementById("site-navigation")
  const header = document.getElementById("masthead")

  // Return early if the navigation doesn't exist.
  if (!siteNavigation) {
    return
  }

  const button = header.getElementsByTagName("button")[0]

  // Return early if the button doesn't exist.
  if ("undefined" === typeof button) {
    return
  }

  const menu = siteNavigation.getElementsByTagName("ul")[0]
  // Hide menu toggle button if menu is empty and return early.
  if ("undefined" === typeof menu) {
    button.style.display = "none"
    return
  }

  if (!menu.classList.contains("nav-menu")) {
    menu.classList.add("nav-menu")
  }

  const tabbables = header.querySelectorAll('li.menu-item-has-children > a, a[rel="home"]')


  function watchKeypress(e) {
    // When press escape, close the menu
    if (e.key === "Escape") {
      button.click()
      header.removeEventListener('keypress', watchKeypress)
      return
    }
    if ( e.key.toLowerCase() !== "tab" ) {
      return
    }

    const {target} = e
    // Going backwards
    if(e.shiftKey) {
      // If the focus is on the first element or the container itself, focus the last element.
      if ( target === header || target === tabbables[0] ) {
        // Force focus to last element in container.
        e.preventDefault()
        tabbables[tabbables.length - 1].focus()
      }
    } else {
      // going forward
      const lastTabbableChildren = tabbables[tabbables.length - 1].parentNode.querySelectorAll('a[href]')
      if (target === tabbables[tabbables.length - 1] && !tabbables[tabbables.length - 1].classList.contains('focus')) {
        // Force focus to first element in container if the last element is not open
        e.preventDefault()
        tabbables[0].focus()
      } else if (target === lastTabbableChildren[lastTabbableChildren.length - 1]) {
        // Force focus to first element in container if the last element is open
        // this enable to focus the inner children of the last element
        e.preventDefault()
        tabbables[0].focus()
      }
    }

  }

  // Toggle the .toggled class and the aria-expanded value each time the button is clicked.
  button.addEventListener("click", function () {
    siteNavigation.classList.toggle("toggled")
    header.classList.toggle("toggled")

    // If the menu is open, focus the header and trap the focus inside the menu
    header.setAttribute('tabindex', '-1')
    header.focus()
    header.addEventListener('keydown', watchKeypress)
    
    button.classList.toggle("toggled")

    if (button.getAttribute("aria-expanded") === "true") {
      button.setAttribute("aria-expanded", "false")
      button.innerHTML = "menu"
      button.setAttribute("aria-label", "open menu")
    } else {
      button.setAttribute("aria-expanded", "true")
      button.innerHTML = ""
      button.setAttribute("aria-label", "close menu")
    }
  })

  // Add class on parent element when a child is active
  const activeLinks = siteNavigation.querySelectorAll('a[aria-current="page"]')
  for (const active of activeLinks) {
    // The links are not the language ones
    if (active.innerHTML !== "Home") {
      active.parentNode.parentNode.parentNode.classList.add("active-child")
    }
  }

  // Get all the link elements within the menu.
  const links = menu.getElementsByTagName("a")

  // Get all the link elements with children within the menu.
  const linksWithChildren = menu.querySelectorAll(
    ".menu-item-has-children > a, .page_item_has_children > a"
  )

  // Toggle focus each time a menu link is focused or blurred.
  for (const link of links) {
    link.addEventListener("focus", toggleFocus, true)
    link.addEventListener("blur", toggleFocus, true)
    link.setAttribute("tabindex", "0")
  }

  // Toggle focus each time a menu link with children receive a touch event.
  for (const link of linksWithChildren) {
    link.addEventListener("touchstart", toggleFocus, false)
    link.addEventListener("keypress", toggleFocus, false)
    link.setAttribute("role", "button")
    link.setAttribute("aria-haspopup", "true")
    link.setAttribute("aria-expanded", "false")
    const subMenuTitle = link.innerHTML
    link.setAttribute("aria-label", `open ${subMenuTitle} submenu`)
    const subMenuSlug = `submenu-${subMenuTitle.toLowerCase().replace(/\s/g, '-')}`
    link.parentNode.querySelector("ul").setAttribute("id", subMenuSlug)
    link.setAttribute("aria-controls", subMenuSlug)

  }

  // Sets or removes .focus class on an element.

  function toggleFocus(event) {
    if (
      event.type === "keypress" &&
      event.key !== "Enter" &&
      event.key !== " "
    ) {
      return
    }
    if (event.type === "focus" || event.type === "blur") {
      let self = this
      // Move up through the ancestors of the current link until we hit .nav-menu.
      while (!self.classList.contains("nav-menu")) {
        // On li elements toggle the class .focus.
        if ("li" === self.tagName.toLowerCase()) {
          self.classList.toggle("focus")
        }
        self = self.parentNode
      }
    }

    if (event.type === "touchstart" || event.type === "keypress") {
      const menuItem = this.parentNode
      const innerLink = this
      event.preventDefault()
      for (const link of menuItem.parentNode.children) {
        // innerHTML === '.' is referring to the language nav
        if (
          menuItem !== link &&
          link.querySelectorAll("a")[0].innerHTML !== "."
        ) {
          link.querySelectorAll("a")[0].classList.remove("focus")
          link.querySelectorAll("a")[0].setAttribute("aria-expanded", "false")

        }
      }
      innerLink.classList.toggle("focus")
      if (innerLink.classList.contains("focus")) {
        innerLink.setAttribute("aria-expanded", "true")
      } else {
        innerLink.setAttribute("aria-expanded", "false")
      }
    }
  }
})()
