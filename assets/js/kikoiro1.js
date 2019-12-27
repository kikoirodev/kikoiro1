$(function() {

	var clipboard = new ClipboardJS('.copy-button');
	clipboard.on('success',function(e) {
		$('.copy-button').hide().fadeIn(300).addClass('success').text('コピーしました');
	});

	var members = $("#members");

	objectFitImages('img.articleTopImage');

	$('.drawer').drawer({
		class: {
		  nav: 'drawer-nav',
		  toggle: 'drawer-toggle',
		  overlay: 'drawer-overlay',
		  open: 'drawer-open',
		  close: 'drawer-close',
		  dropdown: 'drawer-dropdown'
		},
		iscroll: {
		  mouseWheel: true,
		  preventDefault: false
		},
		showOverlay: true
	  });

	$('a[href^=#]').click(function() {
		var href= $(this).attr("href");
		var target = $(href == "#" || href == "" ? 'html' : href);
		var y = target.offset().top - 0;
		$('body,html').animate({ scrollTop: y }, 400, 'swing');
		return false;
	});

	//show more
	var showMoreNews = $("#showMoreNews");
	var pagenation = $("nav.pagination");
	var showMoreNewsClicked = false;
	if (showMoreNews.length) {
		showMoreNews.click(function() {
			if (showMoreNewsClicked) return;
			showMoreNewsClicked = true;
			var items = $("#itemsContainer > div.items");
			var h = items.outerHeight();
			items.css({ maxHeight: "" + h + "px" });
		
			$.ajax({
				type: "POST",
				url: "/wp-admin/admin-ajax.php",
				data: {
					action: 'mark_message_as_read',
					message_id: "12345"
				},
				success: function (output) {
					items.append(output.data);
					var h2 = items.prop('scrollHeight'); 
					items.css({ maxHeight: "" + h2 + "px" });
					showMoreNews.css({ display: "none" });
					if (pagenation) {
						pagenation.toggleClass('show', true);
					}
				}
			});
		});
	}

	$("div.listBottom > span.showMore").click(function() {
		$(this).parent().css({ display: "none" });
		var article = $(this).parent().parent();
		var h = article.prop('scrollHeight'); 
		article.css({ maxHeight: "" + h + "px" });
	});

	//search bar
	var isSearchBarVisible = false;
	var searchFormBar = $("#searchFormBar");
	
	if (searchFormBar.hasClass("show")) {
		isSearchBarVisible = true;
	}

	$("#searchForm").submit(function() {
		searchFormBar.toggleClass('show', false);
		searchFormBar.toggleClass('hide', true);
		searchFormBar.css({ visibility: "hidden" });
		isSearchBarVisible = false;
        $(this).submit();
    });

	searchFormBar.on('transitionend webkitTransitionEnd oTransitionEnd mozTransitionEnd', function() {
		if (!isSearchBarVisible) {
			searchFormBar.css({ visibility: "hidden" });
		}
		else {
			$('#searchField').focus();
		}
	});

	$("#searchButton").on('click', function(e) {
		isSearchBarVisible = true;
		searchFormBar.css({ visibility: "visible" });
		searchFormBar.toggleClass('hide', false);
		searchFormBar.toggleClass('show', true);
	});

	$("#searchCloseButton").on('click', function() {
		isSearchBarVisible = false;
		searchFormBar.toggleClass('show', false);
		searchFormBar.toggleClass('hide', true);
	});

	//header toggle
	var smallLogoContainer = $("#smallLogoContainer");
	var header = $("#header");
	var headerNavigation = $("#headerNavigation");
  	var isTiny = false;
  	var tinyTimer = false;
	var headerTogglePisitionY = 108;
	

	//scroll
	$(window).on("scroll touchmove", function() {
		//also called when history backs to scrolled page
		onScroll(true);
	});

	smallLogoContainer.on('transitionend webkitTransitionEnd oTransitionEnd mozTransitionEnd', function() {
		if (!isTiny) {
			smallLogoContainer.css({ visibility: "hidden" });
		}
	});

	var container = $("#container");
	var mobileWidthThreshold = 876;
	var useMasonryThreshold = 680;
	var navigationHidden = false;

	function onScroll(isOnScroll) {
		var w = container.css("width").replace("px", "") - 0;
		if (w <= mobileWidthThreshold) {
			if (!navigationHidden) {
				navigationHidden = true;
				header.css({ height: "100px" });
				headerNavigation.css({ display: "none" });
			}
			return;
		}
		if (navigationHidden) {
			navigationHidden = false;
			headerNavigation.css({ display: "flex" });
			header.css({ height: "168px" });
		}

		var scrollTop = $(document).scrollTop();

		var toTiny = ($(document).scrollTop() > headerTogglePisitionY);

		var top = (toTiny) ? -108 : -scrollTop;
		if (top > 0) top = 0;

		header.css({ top: "" + top + "px" });

		if (isTiny == toTiny) {
			if (tinyTimer !== false) {
				clearTimeout(tinyTimer);
				tinyTimer = false;
			}
			return;
		}
		if (tinyTimer !== false) return;
		tinyTimer = setTimeout(function() {
			if (tinyTimer !== false) {
				clearTimeout(tinyTimer);
				tinyTimer = false;
			}
			var toTiny = ($(document).scrollTop() > headerTogglePisitionY);
			if (!isTiny && toTiny) {
				isTiny = true;
			}
			else if (isTiny && !toTiny) {
				isTiny = false;
			}
			else {
				return;
			}

			var headerIsAlreadyTiny = header.hasClass("tiny");
			if (toTiny != headerIsAlreadyTiny) {
				header.toggleClass('tiny', toTiny);
				smallLogoContainer.toggleClass('tiny', toTiny);
			}
			if (toTiny) {
				smallLogoContainer.css({ visibility: "visible" });
			}
		},
		100);
	}

	var masonryTimer = false;
	$(window).on('resize', function(){	
		onResize(false);
	});
	function onResize() {
		var w = container.css("width").replace("px", "") - 0;
		if (w < mobileWidthThreshold) {
			var headerIsAlreadyTiny = header.hasClass("tiny");
			if (headerIsAlreadyTiny) {
				clearTimeout(tinyTimer);
				header.toggleClass('tiny', false);
				header.css({ top: "0px" });
				smallLogoContainer.toggleClass('tiny', false);
				smallLogoContainer.css({ visibility: "hidden" });
			}
			if (!navigationHidden) {
				navigationHidden = true;
				header.css({ height: "100px" });
				headerNavigation.css({ display: "none" });
			}
		}
		onScroll();

		if (members.masonry) {
			if (masonryTimer !== false) {
				clearTimeout(masonryTimer);
			}
			masonryTimer = setTimeout(function() {
					updateMasonry();
				},
				200);
		}
	}
	onResize();

	function updateMasonry() {
		if (members.masonry) {
			members.masonry("destroy");
		}
		var w = container.css("width").replace("px", "") - 0;
		if (w >= useMasonryThreshold) {
			members.masonry({
				itemSelector: '.person',　
				fitWidth: true,
				columnWidth: ".person",
				gutter: 16
			});
		}
	}
});
