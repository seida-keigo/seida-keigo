
// 折れ線を表現するための関数
var lineFormatter = function(value, data, cell, row, options) {
	setTimeout(function() {
		cell.sparkline(value, {
			width : "100%",
			type : "line",
			disableTooltips : true
		});
	}, 10);
};

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
	{id:1, name:"Oli Bob", progress:12, gender:"male", rating:1, col:"red", dob:"", car:1, lucky_no:5, activity:[1, 20, 5, 3, 10, 13, 17, 15, 9, 11, 10, 12, 14, 16, 13, 9, 7, 11, 10, 13]},
	{id:2, name:"Mary May", progress:1, gender:"female", rating:2, col:"blue", dob:"14/05/1982", car:true, lucky_no:10, activity:[10, 12, 14, 16, 13, 9, 7, 11, 10, 13, 1, 2, 5, 4, 1, 16, 4, 2, 1, 3]},
	{id:3, name:"Christine Lobowski", progress:42, gender:"female", rating:0, col:"green", dob:"22/05/1982", car:"true", lucky_no:12, activity:[1, 2, 5, 4, 1, 16, 4, 2, 1, 3, 3, 7, 9, 1, 4, 8, 2, 6, 4, 2]},
	{id:4, name:"Brendon Philips", progress:100, gender:"male", rating:1, col:"orange", dob:"01/08/1980", lucky_no:18, activity:[3, 7, 9, 1, 4, 8, 2, 6, 4, 2, 1, 3, 1, 3, 3, 1, 1, 3, 1, 3]},
	{id:5, name:"Margret Marmajuke", progress:16, gender:"female", rating:5, col:"yellow", dob:"31/01/1999", lucky_no:33, activity:[1, 3, 1, 3, 3, 1, 1, 3, 1, 3, 20, 17, 15, 11, 16, 9, 12, 14, 20, 12]},
	{id:6, name:"Frank Harbours", progress:38, gender:"male", rating:4, col:"red", dob:"12/05/1966", car:1, lucky_no:2, activity:[20, 17, 15, 11, 16, 9, 12, 14, 20, 12, 11, 7, 6, 12, 14, 13, 11, 10, 9, 6]},
	{id:7, name:"Jamie Newhart", progress:23, gender:"male", rating:3, col:"green", dob:"14/05/1985", car:true, lucky_no:63, activity:[11, 7, 6, 12, 14, 13, 11, 10, 9, 6, 4, 17, 11, 12, 0, 5, 12, 14, 18, 11]},
	{id:8, name:"Gemma Jane", progress:60, gender:"female", rating:0, col:"red", dob:"22/05/1982", car:"true", lucky_no:72, activity:[4, 17, 11, 12, 0, 5, 12, 14, 18, 11, 11, 15, 19, 20, 17, 16, 16, 5, 3, 2]},
	{id:9, name:"Emily Sykes", progress:42, gender:"female", rating:1, col:"maroon", dob:"11/11/1970", lucky_no:44, activity:[11, 15, 19, 20, 17, 16, 16, 5, 3, 2, 1, 2, 3, 4, 5, 4, 2, 5, 9, 8]},
	{id:10, name:"James Newman", progress:73, gender:"male", rating:5, col:"red", dob:"22/03/1998", lucky_no:9, activity:[1, 20, 5, 3, 10, 13, 17, 15, 9, 11, 1, 2, 3, 4, 5, 4, 2, 5, 9, 8]},
	{id:11, name:"Martin Barryman", progress:20, gender:"male", rating:5, col:"violet", dob:"04/04/2001", activity:[1, 2, 3, 4, 5, 4, 11, 7, 6, 12, 14, 13, 11, 10, 9, 6, 2, 5, 9, 8]},
	{id:12, name:"Jenny Green", progress:56, gender:"female", rating:4, col:"indigo", dob:"12/11/1998", car:true, activity:[11, 15, 19, 20, 17, 15, 11, 16, 9, 12, 14, 20, 12, 20, 17, 16, 16, 5, 3, 2]},
	{id:13, name:"Alan Francis", progress:90, gender:"male", rating:3, col:"blue", dob:"07/08/1972", car:true, activity:[4, 17, 11, 7, 6, 12, 14, 13, 11, 10, 9, 6, 11, 12, 0, 5, 12, 14, 18, 11]},
	{id:14, name:"John Phillips", progress:80, gender:"male", rating:1, col:"green", dob:"24/09/1950", car:true, activity:[11, 7, 6, 12, 14, 1, 20, 5, 3, 10, 13, 17, 15, 9, 1, 13, 11, 10, 9, 6]},
	{id:15, name:"Ed White", progress:70, gender:"male", rating:0, col:"yellow", dob:"19/06/1976", activity:[20, 17, 15, 11, 16, 9, 4, 17, 11, 12, 0, 5, 12, 14, 18, 11, 12, 14, 20, 12]},
	{id:16, name:"Paul Branderson", progress:60, gender:"male", rating:5, col:"orange", dob:"01/01/1982", activity:[1, 3, 1, 3, 3, 1, 11, 15, 19, 20, 17, 16, 16, 5, 3, 2, 1, 3, 1, 3]},
	{id:18, name:"Emma Netwon", progress:40, gender:"female", rating:4, col:"brown", dob:"07/10/1963", car:true, activity:[3, 7, 9, 1, 4, 8, 3, 7, 9, 1, 4, 8, 2, 6, 4, 2, 2, 6, 4, 2]},
	{id:19, name:"Hannah Farnsworth", progress:30, gender:"female", rating:1, col:"pink", dob:"11/02/1991", activity:[1, 2, 5, 4, 1, 16, 10, 12, 14, 16, 13, 9, 7, 11, 10, 13, 4, 2, 1, 3]},
	{id:20, name:"Victoria Bath", progress:20, gender:"female", rating:2, col:"purple", dob:"22/03/1986", activity:[10, 12, 14, 16, 13, 9, 7, 1, 2, 3, 4, 5, 4, 2, 5, 9, 8, 11, 10, 13]},
];

var table_title = [
    {title:"ID", field:"id", width:60, align:"center", sorter:"number", editable:false},
    {title:"Name", field:"name", sorter:"string", editable:true},
    {title:"Task Progress", field:"progress", sorter:"number", align:"left", formatter:"progress", editable:true},
    {title:"Activity", field:"activity", width:160, formatter:lineFormatter},
    {title:"Gender", field:"gender", width:90, sorter:"string", editable:true, editor:genderEditor},
    {title:"Rating", field:"rating", formatter:"star", align:"center", sorter:"number", width:100, editable:true},
    {title:"Favourite Color", field:"col", width:130, sorter:"string", sortable:false, editable:true},
    {title:"Date Of Birth", field:"dob", width:130, sorter:"date", align:"center"},
    {title:"Driver", field:"car", width:80,  align:"center", formatter:"tickCross", sorter:"boolean", editable:true}
 ];

$(window).resize(function() {
	$("#tabulator-example").tabulator("redraw");
});

// フィルター
$("#tabulator-controls input[name=name]").on(
		"keyup",
		function() {
			$("#tabulator-example").tabulator("setFilter", "name", "like",
					$(this).val())
		});

$("#tabulator-controls  button[name=hide-col]").on("click", function() {
	$(this).toggleClass("col-hide");

	if ($(this).hasClass("col-hide")) {
		$("#tabulator-example").tabulator("showCol", "rating");
	} else {
		$("#tabulator-example").tabulator("hideCol", "rating");
	}
});

// 行の追加
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


