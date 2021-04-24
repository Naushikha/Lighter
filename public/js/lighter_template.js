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

// What does this do??
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
var modalID = 0;
function showModal(modal, width = "", data = "", url = "") {
  event.preventDefault(); // Useful when called from inside forms (e.g. Cancel button)
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
        // Load a CSS if specified
        if (res.css) {
          // Check if previously loaded
          if ($("style").data("css") != res.css) {
            $.ajax({
              url: res.css,
              success: function (file) {
                $("head").append(
                  "<style data-css='" + res.css + "'>" + file + "</style>"
                );
              },
            });
          }
        }
      } catch (error) {
        console.error(error);
        title = "Error";
        content = "Server returned something that we could not understand.";
      }
      // Modal HTML
      var modalHTML = `
        <div id="modal${modalID}" data-id="${modalID}" class="modal" style="display: none;" onclick="if (event.target.id == 'modal${modalID}') closeModal(${modalID})">
          <div id="modal${modalID}-box" class="modal-box">
            <div class="modal-header row">
              <div class="modal-title ten columns">
                ${title}
              </div>
              <div class="two columns">
                <span id="modal${modalID}-close" class="modal-close u-pull-right" onclick="closeModal(${modalID})">&times;</span>
              </div>
            </div>
            <div class="modal-content row">
              ${content}
            </div>
          </div>
        </div>
      `;
      $("main").append(modalHTML);
      $(`#modal${modalID}`).css(
        "z-index",
        parseInt($(`#modal${modalID}`).css("z-index")) + modalID
      );
      if (width != "") {
        $(`#modal${modalID}-box`).css("width", width);
      }
      $(`#modal${modalID}`).fadeIn("fast");

      modalID++;
    },
  });
  return modalID - 1; // Can be used to refer to the modal just created
}

function closeModal(modalID) {
  if (typeof modalID === "object") {
    modalID = $(modalID).closest(".modal").data("id");
  }
  event.preventDefault(); // Useful when called from inside forms (e.g. Cancel button)
  $(`#modal${modalID}`).fadeOut("fast", function () {
    // Remove modal from DOM
    $(`#modal${modalID}`).remove();
  });
}

// Start frag stuff ////////////////////////////////////////

function showFrag(frag, containerID, data = "", url = "") {
  event.preventDefault(); // Useful when called from inside forms (e.g. Cancel button)
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
        // Load a CSS if specified
        if (res.css) {
          // Check if previously loaded
          if ($("style").data("css") != res.css) {
            $.ajax({
              url: res.css,
              success: function (file) {
                $("head").append(
                  "<style data-css='" + res.css + "'>" + file + "</style>"
                );
              },
            });
          }
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
