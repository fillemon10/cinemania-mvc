(function () {
  ('use strict');

  /*=====================================
	Sticky
	======================================= */
  window.onscroll = function () {
    var header_navbar = document.querySelector('.navbar-area');
    var sticky = header_navbar.offsetTop;

    if (window.pageYOffset > sticky) {
      header_navbar.classList.add('sticky');
    } else {
      header_navbar.classList.remove('sticky');
    }

    // show or hide the back-top-top button
    var backToTo = document.querySelector('.scroll-top');
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
      backToTo.style.display = 'block';
    } else {
      backToTo.style.display = 'none';
    }
  };

  //===== navbar-toggler
  let navbarToggler = document.querySelector('.navbar-toggler');
  navbarToggler.addEventListener('click', function () {
    navbarToggler.classList.toggle('active');
  });

  //WOW Scroll Spy
  var wow = new WOW({
    //disabled for mobile
    mobile: false,
  });
  wow.init();

  var navLinks = document.querySelectorAll('.navbar-nav .nav-item a');

  navLinks.forEach(function (navLink) {
    navLink.addEventListener('click', function (event) {
      event.target.parentNode.childNodes.forEach(function (node) {
        if (!node.isEqualNode(event.target) && node.classList) {
          node.classList.toggle('show');
        }
      });
    });
  });

  navLinks.forEach((e) =>
    e.addEventListener('click', () => {
      e.classList.toggle('show');
    })
  );
})();

function openSinglePost(slug) {
  window.url = 'single_post?post-slug=' + slug;
}
