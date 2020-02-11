var ticker;
var tickerCounter = 0;
var modalShown = false;

jQuery(document).ready(function($) {
  // Shrinks size of Tap List Name if it's too long
  var tapListNameEl = $(".tap-list-name");
  if (tapListNameEl && tapListNameEl.text().length > 40) {
    tapListNameEl.css("font-size", "20px");
  }

  // Dynamic input labels
  $("#searchptf").dynamicInputLabels();
  $("#mce-EMAIL").dynamicInputLabels();

  if ($("#eventTodayModal").length > 0 && modalShown == false) {
    console.log("modalShown");
    $("#eventTodayModal").reveal({
      animation: "fadeAndPop", //fade, fadeAndPop, none
      animationspeed: 300, //how fast animtions are
      closeonbackgroundclick: true, //if you click background will modal close?
      dismissmodalclass: "close-reveal-modal" //the class of a button or element that will close an open modal
    });
    modalShown = true;
  }

  // Category selection
  /*var theCatLinks = $('.by-category a');
	theCatLinks.click(function(){
		if ( !$(this).parent('li').hasClass('active-category') ) {
			theCatLinks.not(this).animate({width:'203px'}, 'fast', 'easeInOutExpo');
			theCatLinks.parent('li').removeClass('active-category');
			$(this).animate({width:'390px'}, 'fast', 'easeInOutExpo');
			$(this).parent('li').addClass('active-category');
		}
		return false;
	});*/

  // Alphabet active states
  /*var alphabAs = $('.alphabetical a');
	alphabAs.click(function(){
		alphabAs.removeClass('active-alphabet');
		$(this).addClass('active-alphabet');
		return false;
	});*/

  // Results Grid Active States
  /*var resultsAs = $('.results-grid a');
	resultsAs.click(function(){
		resultsAs.removeClass('active-result');
		$(this).addClass('active-result');
		return false;
	});*/

  // Search Drop Down
  var searchDrop = $(".search-auto-fills");

  /*$('#searchptf').keyup(function(){
		searchDrop.show();
	});*/

  // Remove "Bubbles" from google map embeds
  var aGoogSrc = "";
  var fixedGoogSrc = "";
  $(".a-google-map").each(function() {
    aGoogSrc = $(this)
      .find("iframe")
      .attr("src");
    fixedGoogSrc = aGoogSrc.replace(/iwloc=(.*)&/g, "iwloc=near&");
    $(this)
      .find("iframe")
      .attr("src", fixedGoogSrc);
  });

  // Disable search submit button
  $('#primary-search input[type="submit"]').attr("disabled", "disabled");

  // Home page blog "ticker"
  ticker = setInterval(runTicker, 5000);

  // Parallax Scroll

  /*var speed = 25;
    $(window).scroll(function(){
    	$('.bg-container').css({'backgroundPosition': '50% ' + (-window.scrollY / speed) + 'px'});
    });*/

  $(".back-to-bars").click(function() {
    history.back(-1);
    return false;
  });

  $("#event-today .close").click(function(e) {
    e.preventDefault();
    $("#event-today").fadeOut("slow");
  });

  $("#event-today").click(function(e) {
    if (e.target == this) {
      $("#event-today").fadeOut("slow");
    }
  });

  // Tracks square ad click
  $(".display-ad-square").live("click", function() {
    console.log("Square ad clicked: " + $(this).attr("title"));
    window.ga("send", "event", "Ad", "Clicked", $(this).attr("title"));
  });

  // Tracks leaderboard ad click
  $(".display-ad-leaderboard").live("click", function() {
    console.log("Leaderboard clicked: " + $(this).attr("title"));
    window.ga("send", "event", "Ad", "Clicked", $(this).attr("title"));
  });

  $(".homepage-featured-bar").live("click", function(e) {
    console.log("Featured bar clicked: " + $(this).data("featured-bar-title"));
    window.ga(
      "send",
      "event",
      "Ad",
      "Clicked",
      "Featured Bar: " + $(this).data("featured-bar-title")
    );
  });

  $(".homepage-featured-brewery").live("click", function(e) {
    console.log(
      "Featured brewery clicked: " + $(this).data("featured-brewery-title")
    );
    window.ga(
      "send",
      "event",
      "Ad",
      "Clicked",
      "Featured Brewery: " + $(this).data("featured-brewery-title")
    );
  });

  function runTicker() {
    tickerCounter++;
    var howMany = $(".links-pane a")
      .filter(":first")
      .attr("data-link-number");

    // console.log(howMany);
    if (tickerCounter == howMany) {
      $(".links-pane")
        .stop()
        .animate({ top: "0px" });
      tickerCounter = 0;
    } else {
      $(".links-pane")
        .stop()
        .animate({ top: "-=60px" });
    }
  }
});
