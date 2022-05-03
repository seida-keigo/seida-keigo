
//選択項目を出力するための関数
var genderEditor = function(cell, value) {
	// cell - JQuery object for current cell
	// value - the current value for current cell

	var items = ['', 'male', 'female'];
	var select = '';
	for (var key in items) {
		select += "<option value='" + items[key] + "'>" + items[key] + "</option>";
	}
	select = "<select>" + select + "</select>";

	// create and style editor
	var editor = $(select);
	editor.css({
		"border" : "1px",
		"background" : "transparent",
		"padding" : "3px",
		"width" : "100%",
		"box-sizing" : "border-box",
	})

	// Set value of editor to the value of the cell
	.val(value);

	// set focus on the select box when the editor is selected (timeout allows
	// for editor to be added to DOM)
	setTimeout(function() {
		editor.focus();
	}, 100)

	// when the value has been set, update the cell
	editor.on("change blur", function(e) {
		cell.trigger("editval", editor.val());
	});

	// return the editor element
	return editor;
}

var table_data = [
	{id:1, name:"Oli Bob", progress:12, gender:"male"},
	{id:2, name:"Mary May", progress:1, gender:"female"},
	{id:3, name:"Christine Lobowski", progress:42, gender:"female"},
	{id:4, name:"Brendon Philips", progress:100, gender:"male"},
	{id:5, name:"Margret Marmajuke", progress:16, gender:"female"},
	{id:6, name:"Frank Harbours", progress:38, gender:"male"},
	{id:7, name:"Jamie Newhart", progress:23, gender:"male"},
	{id:8, name:"Gemma Jane", progress:60, gender:"female"},
	{id:9, name:"Emily Sykes", progress:42, gender:"female"},
	{id:10, name:"James Newman", progress:73, gender:"male"},
	{id:11, name:"Martin Barryman", progress:20, gender:"male"},
	{id:12, name:"Jenny Green", progress:56, gender:"female"},
	{id:13, name:"Alan Francis", progress:90, gender:"male"},
	{id:14, name:"John Phillips", progress:80, gender:"male"},
	{id:15, name:"Ed White", progress:70, gender:"male"},
	{id:16, name:"Paul Branderson", progress:60, gender:"male"},
	{id:18, name:"Emma Netwon", progress:40, gender:"female"},
	{id:19, name:"Hannah Farnsworth", progress:30, gender:"female"},
	{id:20, name:"Victoria Bath", progress:20, gender:"female"},
];

var table_title = [
	{title:"ID", field:"id", width:60, align:"center", sorter:"number", editable:false},
	{title:"Name", field:"name", width:200, sorter:"string", editable:true},
	{title:"Task Progress", field:"progress", width:200, formatter:"progress", sorter:"number", editable:true},
	{title:"Gender", field:"gender", width:90, sorter:"string", editable:true, editor:genderEditor},
];


//フィルター
$("#tabulator-controls input[name=name]").on(
		"keyup",
		function() {
			$("#tabulator-example").tabulator("setFilter", "name", "like",
					$(this).val())
		});

//gender非表示
$("#tabulator-controls  button[name=hide-col]").on("click", function() {
	$(this).toggleClass("col-hide");

	if ($(this).hasClass("col-hide")) {
		$("#tabulator-example").tabulator("showCol", "gender");
	} else {
		$("#tabulator-example").tabulator("hideCol", "gender");
	}
});

//行の追加
$("#tabulator-controls  button[name=add-row]").on("click", function() {
	$("#tabulator-example").tabulator("addRow", {});
});

//ダウンロード
$("#tabulator-controls  button[name=download-csv]").on(
		"click",
		function() {
			$("#tabulator-example").tabulator("download", "csv",
					"Tabulator Example Download.csv");
		});

//ダウンロード
$("#tabulator-controls  button[name=download-json]").on(
		"click",
		function() {
			$("#tabulator-example").tabulator("download", "json",
					"Tabulator Example Download.json");
		});
