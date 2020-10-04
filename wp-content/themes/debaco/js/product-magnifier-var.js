"use strict";
var debaco_magnifier_vars;
var yith_magnifier_options = {
		sliderOptions: {
			responsive: debaco_magnifier_vars.responsive,
			circular: debaco_magnifier_vars.circular,
			infinite: debaco_magnifier_vars.infinite,
			direction: 'up',
			debug: false,
			auto: false,
			align: 'left',
			height: "100%",
			width: 100,
			prev    : {
				button  : "#slider-prev",
				key     : "left"
			},
			next    : {
				button  : "#slider-next",
				key     : "right"
			},
			scroll : {
				items     : 1,
				pauseOnHover: true
			},
			items   : {
				visible: Number(debaco_magnifier_vars.visible),
			},
			swipe : {
				onTouch:    true,
				onMouse:    true
			},
			mousewheel : {
				items: 1
			}
		},
		showTitle: false,
		zoomWidth: debaco_magnifier_vars.zoomWidth,
		zoomHeight: debaco_magnifier_vars.zoomHeight,
		position: debaco_magnifier_vars.position,
		lensOpacity: debaco_magnifier_vars.lensOpacity,
		softFocus: debaco_magnifier_vars.softFocus,
		adjustY: 0,
		disableRightClick: false,
		phoneBehavior: debaco_magnifier_vars.phoneBehavior,
		loadingLabel: debaco_magnifier_vars.loadingLabel,
	};