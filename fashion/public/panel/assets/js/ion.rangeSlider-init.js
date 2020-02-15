$("#range_01").ionRangeSlider({
	prettify_separator: ',',
	from: 23
});

$("#range_02").ionRangeSlider({
	min: 100,
	max: 1000,
	from: 550,
	prettify_separator: ','
});
$("#range_03").ionRangeSlider({
	type: "double",
	grid: true,
	min: 0,
	max: 100000,
	from: 25000,
	to: 80000,
	postfix: " تومان",
	step: 1000,
	prettify_separator: ','
});
$("#range_04").ionRangeSlider({
	type: "double",
	grid: true,
	min: -1000,
	max: 1000,
	from: -500,
	to: 500,
	prettify_separator: ','
});
$("#range_16").ionRangeSlider({
	grid: true,
	min: 18,
	max: 70,
	from: 30,
	prefix: "سن ",
	max_postfix: "+",
	prettify_separator: ','
});
$("#range_18").ionRangeSlider({
	type: "double",
	min: 100,
	max: 200,
	from: 145,
	to: 155,
	prefix: "وزن: ",
	postfix: " کیلوگرم",
	decorate_both: false,
	prettify_separator: ','
});
$("#range_22").ionRangeSlider({
	type: "double",
	min: 1000,
	max: 2000,
	from: 1200,
	to: 1800,
	hide_min_max: true,
	hide_from_to: true,
	grid: true,
	prettify_separator: ','
});

