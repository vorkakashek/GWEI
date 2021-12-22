document.addEventListener('DOMContentLoaded', function () {

	// console.log('ready!')

	// Parallax Scroll
	paralaxInit();
	var lastScrollTop = 0;

	function elemInViewport(elem, full) {
		if (elem !== null) {
			var box = elem.getBoundingClientRect();
			var top = box.top;
			var left = box.left;
			var bottom = box.bottom;
			var right = box.right;
			var width = document.documentElement.clientWidth;
			var height = document.documentElement.clientHeight;
			var maxWidth = 0;
			var maxHeight = 0;
			if (full && elem !== null) {
				maxWidth = right - left;
				maxHeight = bottom - top;
			};
			return Math.min(height, bottom) - Math.max(0, top) >= maxHeight && Math.min(width, right) - Math.max(0, left) >= maxWidth;
		}


	};


	function offset(el, top) {
		if (el !== null) {
			var rect = el.getBoundingClientRect(),
				scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
				scrollTop = window.pageYOffset || document.documentElement.scrollTop,
				result = undefined;

			if (top) {
				result = rect.top + scrollTop;
			} else {
				result = rect.top + scrollTop, rect.left + scrollLeft;
			}
			return parseInt(result);
		}
	}

	// Сразу после загрузки скрипта расставим параллакс элементы по местам

	function paralaxInit() {
		var scrollVal = window.pageYOffset || document.documentElement.scrollTop; // сколько проскроллено от верха стр

		for (const element of document.querySelectorAll('section')) {
			var parallaxElem = element.querySelector('.parallax-elem'); // parallax объект
			var windowH = window.innerHeight;
			let offsetVal = windowH / 100;

			if (parallaxElem !== null && elemInViewport(parallaxElem, false)) {
				const offsetY = (parallaxElem.getBoundingClientRect().top - parallaxElem.getBoundingClientRect().height / 5) / (windowH / 100);
				parallaxElem.style.transform = "translateY(" + offsetY / 2.5 + "%)";
				parallaxElem.style.opacity = offsetY / 2.5;
			}
		}
	}


	window.addEventListener("scroll", function () {
		var scrollVal = window.pageYOffset || document.documentElement.scrollTop; // сколько проскроллено от верха стр

		for (const element of document.querySelectorAll('section')) {
			var parallaxElem = element.querySelector('.parallax-elem'); // parallax объект
			var windowH = window.innerHeight;
			let offsetVal = windowH / 100;

			if (parallaxElem !== null && elemInViewport(parallaxElem, false)) {
				const offsetY = (parallaxElem.getBoundingClientRect().top - parallaxElem.getBoundingClientRect().height / 5) / (windowH / 100);
				
				const elemOpacity = 1 - (offsetY * .01);
				const elemOffsetY = offsetY / 2.5;
				
				if (elemOffsetY > 0) {
					parallaxElem.style.transform = "translateY(" + elemOffsetY + "%)";
				}

				if (elemOpacity < 1.1) {
					parallaxElem.style.opacity = elemOpacity;
				}
				
				
			}
		}
	});

}, false);