(function ($) {
  "use strict";

  //===== Preloader
  function handlePreloader() {
    if ($(".loader-wrap").length) {
      $(".loader-wrap").delay(1000).fadeOut(500);
    }
    TweenMax.to($(".loader-wrap .overlay"), 1.2, {
      force3D: true,
      left: "100%",
      ease: Expo.easeInOut,
    });
  }

  if ($(".preloader-close").length) {
    $(".preloader-close").on("click", function () {
      $(".loader-wrap").delay(200).fadeOut(500);
    });
  }

  $(window).on("load", function () {
    handlePreloader();
  });

  jQuery(document).on("ready", function () {
    //===== Sticky

    jQuery(window).on("scroll", function (event) {
      var scroll = jQuery(window).scrollTop();
      if (scroll < 150) {
        jQuery(".aai-sticky").removeClass("sticky");
      } else {
        jQuery(".aai-sticky").addClass("sticky");
      }
    });

    // wow js
    if ($(".wow").length) {
      var wow = new WOW({
        boxClass: "wow", // animated element css class (default is wow)
        animateClass: "animated", // animation css class (default is animated)
        offset: 250, // distance to the element when triggering the animation (default is 0)
        mobile: true, // trigger animations on mobile devices (default is true)
        live: true, // act on asynchronously loaded content (default is true)
      });
      wow.init();
    }

    //====== Magnific Popup

    jQuery(".aai-video-popup").magnificPopup({
      type: "iframe",
      // other options
    });

    //===== Magnific Popup

    jQuery(".aai-image-popup").magnificPopup({
      type: "image",
      gallery: {
        enabled: true,
      },
    });

    //===== Back to top

    // Show or hide the sticky footer button
    jQuery(window).on("scroll", function (event) {
      if (jQuery(this).scrollTop() > 600) {
        jQuery(".back-to-top").fadeIn(200);
      } else {
        jQuery(".back-to-top").fadeOut(200);
      }
    });

    //Animate the scroll to yop
    jQuery(".back-to-top").on("click", function (event) {
      event.preventDefault();

      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;

      jQuery("*").animate(
        {
          scrollTop: 0,
        },
        1500
      );
    });

    /*---canvas menu activation---*/
    $(".canvas_open").on("click", function () {
      $(".offcanvas_menu_wrapper,.off_canvars_overlay").addClass("active");
    });

    $(".canvas_close,.off_canvars_overlay").on("click", function () {
      $(".offcanvas_menu_wrapper,.off_canvars_overlay").removeClass("active");
    });

    // cursor

    const cursorDot = document.querySelector("[data-cursor-dot]");
    const cursorOutline = document.querySelector("[data-cursor-outline]");

    window.addEventListener("mousemove", function (e) {
      const posX = e.clientX;
      const posY = e.clientY;

      cursorDot.style.left = `${posX}px`;
      cursorDot.style.top = `${posY}px`;

      cursorOutline.animate(
        {
          left: `${posX}px`,
          top: `${posY}px`,
        },
        { duration: 2000, fill: "forwards" }
      );
    });

    // gsap custom code for image reval effect

    gsap.registerPlugin(ScrollTrigger);

    let revealContainers = document.querySelectorAll(".reveal");

    revealContainers.forEach((container) => {
      let image = container.querySelector("img");
      let tl = gsap.timeline({
        scrollTrigger: {
          trigger: container,
          toggleActions: "restart none none reset",
        },
      });

      tl.set(container, { autoAlpha: 1 });
      tl.from(container, 1.5, {
        xPercent: -100,
        ease: Power2.out,
      });
      tl.from(image, 1.5, {
        xPercent: 100,
        scale: 1.3,
        delay: -1.5,
        ease: Power2.out,
      });
    });

    /*---Off Canvas Menu---*/
    var $offcanvasNav = $(".offcanvas_main_menu"),
      $offcanvasNavSubMenu = $offcanvasNav.find(".sub-menu");
    $offcanvasNavSubMenu
      .parent()
      .prepend(
        '<span class="menu-expand"><i class="fa fa-angle-down"></i></span>'
      );

    $offcanvasNavSubMenu.slideUp();

    $offcanvasNav.on("click", "li a, li .menu-expand", function (e) {
      var $this = $(this);
      if (
        $this
          .parent()
          .attr("class")
          .match(/\b(menu-item-has-children|has-children|has-sub-menu)\b/) &&
        ($this.attr("href") === "#" || $this.hasClass("menu-expand"))
      ) {
        e.preventDefault();
        if ($this.siblings("ul:visible").length) {
          $this.siblings("ul").slideUp("slow");
        } else {
          $this.closest("li").siblings("li").find("ul:visible").slideUp("slow");
          $this.siblings("ul").slideDown("slow");
        }
      }
      if (
        $this.is("a") ||
        $this.is("span") ||
        $this.attr("clas").match(/\b(menu-expand)\b/)
      ) {
        $this.parent().toggleClass("menu-open");
      } else if (
        $this.is("li") &&
        $this.attr("class").match(/\b('menu-item-has-children')\b/)
      ) {
        $this.toggleClass("menu-open");
      }
    });
  });

  var isIe = /(trident|msie)/i.test(navigator.userAgent);

  if (isIe && document.getElementById && window.addEventListener) {
    window.addEventListener(
      "hashchange",
      function () {
        var id = location.hash.substring(1),
          element;

        if (!/^[A-z0-9_-]+$/.test(id)) {
          return;
        }

        element = document.getElementById(id);

        if (element) {
          if (!/^(?:a|select|input|button|textarea)$/i.test(element.tagName)) {
            element.tabIndex = -1;
          }

          element.focus();
        }
      },
      false
    );
  }
})(jQuery);
