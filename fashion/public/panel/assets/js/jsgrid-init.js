!function(document, window, $) {
	"use strict";
	var Site = window.Site;
	jsGrid.setDefaults({
		tableClass: "jsgrid-table table table-striped table-hover"
	}),
	jsGrid.setDefaults("text", {
		_createTextBox: function() {
			return $("<input>").attr("type", "text").attr("class", "form-control input-sm")
		}
	}),
	jsGrid.setDefaults("number", {
		_createTextBox: function() {
			return $("<input>").attr("type", "number").attr("class", "form-control input-sm")
		}
	}),
	jsGrid.setDefaults("textarea", {
		_createTextBox: function() {
			return $("<input>").attr("type", "textarea").attr("class", "form-control")
		}
	}),
	jsGrid.setDefaults("control", {
		_createGridButton: function(cls, tooltip, clickHandler) {
			var grid = this._grid;
			return $("<button>").addClass(this.buttonClass).addClass(cls).attr({
				type: "button",
				title: tooltip
			}).on("click", function(e) {
				clickHandler(grid, e)
			})
		}
	}),
	jsGrid.setDefaults("select", {
		_createSelect: function() {
			var $result = $("<select>").attr("class", "form-control input-sm"),
				valueField = this.valueField,
				textField = this.textField,
				selectedIndex = this.selectedIndex;
			return $.each(this.items, function(index, item) {
				var value = valueField ? item[valueField] : index,
					text = textField ? item[textField] : item,
					$option = $("<option>").attr("value", value).text(text).appendTo($result);
				$option.prop("selected", selectedIndex === index)
			}), $result
		}
	}),
	function() {
		$("#basicgrid").jsGrid({
			height: "500px",
			width: "100%",
			filtering: !0,
			editing: !0,
			sorting: !0,
			paging: !0,
			autoload: !0,
			pageSize: 15,
			pageButtonCount: 5,
			deleteConfirm: "آیا از حذف این مورد اطمینان دارید؟",
			controller: db,
			pagerFormat: "{first} {prev} {pages} {next} {last} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; صفحه {pageIndex} از {pageCount}",
			pagePrevText: "قبلی",
			pageNextText: "بعدی",
			pageFirstText: "اولین",
			pageLastText: "آخرین",
			fields: [{
				name: "Name",
				type: "text",
				width: 150,
				title: "نام"
			}, {
				name: "Age",
				type: "number",
				width: 70,
				title: "سن"
			}, {
				name: "Address",
				type: "text",
				width: 200,
				title: "آدرس"
			}, {
				name: "Country",
				type: "select",
				items: db.countries,
				valueField: "Id",
				textField: "Name",
				title: "کشور"
			}, {
				name: "Married",
				type: "checkbox",
				title: "تاهل",
				sorting: !1
			}, {
				type: "control"
			}]
		})
	}(),
	function() {
		$("#staticgrid").jsGrid({
			height: "500px",
			width: "100%",
			sorting: !0,
			paging: !0,
			data: db.clients,
			pagerFormat: "{first} {prev} {pages} {next} {last} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; صفحه {pageIndex} از {pageCount}",
			pagePrevText: "قبلی",
			pageNextText: "بعدی",
			pageFirstText: "اولین",
			pageLastText: "آخرین",
			fields: [{
				name: "Name",
				type: "text",
				width: 150,
				title: "نام"
			}, {
				name: "Age",
				type: "number",
				width: 70,
				title: "سن"
			}, {
				name: "Address",
				type: "text",
				width: 200,
				title: "آدرس"
			}, {
				name: "Country",
				type: "select",
				items: db.countries,
				valueField: "Id",
				textField: "Name",
				title: "کشور"
			}, {
				name: "Married",
				type: "checkbox",
				title: "تاهل"
			}]
		})
	}(),

	function() {
		$("#exampleSorting").jsGrid({
			height: "500px",
			width: "100%",
			autoload: !0,
			selecting: !1,
			controller: db,
			pagerFormat: "{first} {prev} {pages} {next} {last} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; صفحه {pageIndex} از {pageCount}",
			pagePrevText: "قبلی",
			pageNextText: "بعدی",
			pageFirstText: "اولین",
			pageLastText: "آخرین",
			fields: [{
				name: "Name",
				type: "text",
				width: 150,
				title: "نام"
			}, {
				name: "Age",
				type: "number",
				width: 50,
				title: "سن"
			}, {
				name: "Address",
				type: "text",
				width: 200,
				title: "آدرس"
			}, {
				name: "Country",
				type: "select",
				items: db.countries,
				valueField: "Id",
				textField: "Name",
				title: "کشور"
			}, {
				name: "Married",
				type: "checkbox",
				title: "تاهل"
			}]
		}), $("#sortingField").on("change", function() {
			var field = $(this).val();
			$("#exampleSorting").jsGrid("sort", field)
		})
	}();
}(document, window, jQuery);