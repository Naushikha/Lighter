// Start navigation bar stuff ////////////////////////////////////////////////

function toggleMobileNav() {
  if ($("nav").hasClass("mobile")) {
    $("#sidenav").width("0px");
    $("nav").removeClass("mobile");
  } else {
    $("#sidenav").width("200px");
    $("nav").addClass("mobile");
  }
}

// hide mobile nav when clicking outside of nav area
$("html").click(function () {
  $("#sidenav").width("0px");
  $("nav").removeClass("mobile");
});

//What does this do??
$("nav").click(function (e) {
  e.stopPropagation();
});

// hide nav on scroll down
var scrolled = false;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $("nav").outerHeight();

$(window).scroll(function (event) {
  scrolled = true;
});

setInterval(function () {
  if (scrolled) {
    hasScrolled();
    scrolled = false;
  }
}, 250);

function hasScrolled() {
  var st = $(this).scrollTop();

  if (Math.abs(lastScrollTop - st) <= delta)
    // make sure user scrolled more than delta
    return;

  if (st > lastScrollTop && st > navbarHeight) {
    if (!$("nav").hasClass("mobile")) {
      $("nav").removeClass("nav-show").addClass("nav-hide");
    }
  } else {
    if (st + $(window).height() < $(document).height()) {
      $("nav").removeClass("nav-hide").addClass("nav-show");
    }
  }

  lastScrollTop = st;
}

// Start modal stuff ////////////////////////////////////////

function showModal(modal, data = "", url = "") {
  var tmpData = { getModal: modal };
  if (data != "") {
    // If data has been passed
    tmpData = { ...tmpData, ...data };
  }
  $.ajax({
    data: tmpData,
    type: "post",
    url: url,
    success: function (res) {
      try {
        var res = JSON.parse(res);
        var title = "";
        var content = "";
        if (res.title && res.content) {
          title = res.title;
          content = res.content;
        }
      } catch (error) {
        console.error(error);
        title = "Error";
        content = "Server returned something that we could not understand.";
      }
      $("#modal-title").html(title);
      $("#modal-content").html(content);
      $("#modal").fadeIn("fast");
    },
  });
}

function hideModal() {
  $("#modal").fadeOut("fast");
  event.preventDefault(); // Useful when called from inside forms (Cancel button)
}

// Useful for setting the size, e.g. dialog boxes should be smaller, others bigger
function styleModal(property, value) {
  $("#modal-box").css(property, value);
}

// Start frag stuff ////////////////////////////////////////

function showFrag(frag, containerID, data = "", url = "") {
  containerID = "#" + containerID;
  var tmpData = { getFrag: frag };
  if (data != "") {
    // If data has been passed
    tmpData = { ...tmpData, ...data };
  }
  $.ajax({
    data: tmpData,
    type: "post",
    url: url,
    success: function (res) {
      try {
        var res = JSON.parse(res);
        var content = "";
        if (res.content) {
          content = res.content;
        }
      } catch (error) {
        console.error(error);
        content =
          "<h1> Error </h1> \
          <p> Server returned something that we could not understand. </p>";
      }
      $(containerID).html(content);
    },
  });
}
