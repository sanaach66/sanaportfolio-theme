(function() {
  // Make sure wp.customize exists
  if (typeof wp === "undefined" || !wp.customize) {
     return;
  }

  // === Hero Title ===
  wp.customize("sanaportfolio_hero_title", function(value) {
    value.bind(function(newVal) {
      const el = document.querySelector(".hero-title");
      if (el) {
        el.textContent = newVal;
      }
    });
  });

  // === Hero Subtitle ===
  wp.customize("sanaportfolio_hero_subtitle", function(value) {
    value.bind(function(newVal) {
      const el = document.querySelector(".hero-subtitle");
      if (el) el.textContent = newVal;
    });
  });

  // === Hero Button Text ===
  wp.customize("sanaportfolio_hero_btn_text", function(value) {
    value.bind(function(newVal) {
      const el = document.querySelector(".hero-btn");
      if (el) el.textContent = newVal;
    });
  });

  // === Hero Button Link ===
  wp.customize("sanaportfolio_hero_btn_link", function(value) {
    value.bind(function(newVal) {
      const el = document.querySelector(".hero-btn");
      if (el) el.setAttribute("href", newVal);
    });
  });

  // === Hero Background Image ===
  wp.customize("sanaportfolio_hero_bg", function(value) {
    value.bind(function(newVal) {
      const section = document.querySelector(".hero");
      if (section) section.style.backgroundImage = `url(${newVal})`;
    });
  });

  //------------------------------------------------
  // ------About Section live preview code----------
  //-------------------------------------------------

  // === About Title ===
  wp.customize("sanaportfolio_about_title", function(value) {
    value.bind(function(newVal) {
      const el = document.querySelector(".about-title");
      if (el) {
        el.textContent = newVal;
      }
    });
  });

  // === About Description ===
  wp.customize("sanaportfolio_about_text", function(value) {
    value.bind(function(newVal) {
      const el = document.querySelector(".about-desc");
      if (el) {
        el.textContent = newVal;
      }
    });
  });

  // === About BUtton Text ===
  wp.customize("sanaportfolio_about_btn_text", function(value) {
    value.bind(function(newVal) {
      const el = document.querySelector(".btn-learn-more");
      if (el) {
        el.textContent = newVal;
      }
    });
  });
  // === About Image ===
  wp.customize("sanaportfolio_about_image", function (value) {
  value.bind(function (newVal) {
    const img = document.querySelector(".about-image img");
    if (img) {
      img.src = newVal;
    }
  });
});

// === Services Section Live Preview ===
wp.customize("sanaportfolio_services_title", function (value) {
  value.bind(function (newVal) {
    const el = document.querySelector(".services-section .section-title");
    if (el) el.textContent = newVal;
  });
});

wp.customize("sanaportfolio_services_count", function (value) {
  value.bind(function (newVal) {
    const section = document.querySelector(".services-section");
    if (section) {
      const infoEl = section.querySelector(".services-info-count");
      if (infoEl) {
        infoEl.textContent = `(Displaying ${newVal} services)`;
      }
    }
  });
});

// === Portfolio Section Live Preview ===
wp.customize("sanaportfolio_portfolio_title", function (value) {
  value.bind(function (newVal) {
    const el = document.querySelector(".portfolio-section .section-title");
    if (el) el.textContent = newVal;
  });
});

// Blog Section live preview
wp.customize('sanaportfolio_blog_title', function(value) {
  value.bind(function(newval) {
    document.querySelector('.blog-section .section-title').textContent = newval;
  });
});

wp.customize('sanaportfolio_blog_subtitle', function(value) {
  value.bind(function(newval) {
    document.querySelector('.blog-section .section-subtitle').textContent = newval;
  });
});

// Blog Section - Number of posts (trigger refresh)
wp.customize('sanaportfolio_blog_count', function(value) {
  value.bind(function() {
    location.reload(); // Simple way to refresh post count preview
  });
});



})();
