var dataTableList = [];
var dataTableOption = {};
var dataTableAction = '';

$(document).ready(function () {
	datatable = $('.datatable').each(function(datatableIndex){
		var hasNewConfigSection = $(this).closest('.card').find('.card-header.card-header-config').length > 0;
		var isAjax = $(this).data('use-ajax') == true;
		var self = $(this);
		dataTableOption = {
			"order": [],
			stateLoadParams: function(settings, data ) {
				if (data.order) delete data.order;
			},
			"aLengthMenu": [
				[5, 10, 15, -1],
				[5, 10, 15, "All"]
			],
			"iDisplayLength": 10,
			"language": {
				search: ""
			},
			stateSave: true,
			/*initComplete: function initComplete(settings, json) {

				var tableSearchTagOpen = '<div class="card-header card-header-config "><div class="table-search">';
				var tableSearchTagClose = '</div></div>';
				var cardBodyElement = $(this).closest('.card').find('.card-body');

				if (isAjax && !hasNewConfigSection){
					cardBodyElement.before( tableSearchTagOpen + '<label><input type="search" class="form-control input-sm" placeholder="Search..." aria-controls="DataTables_Table_0"></label>' + tableSearchTagClose);
				} else if(!isAjax){
					cardBodyElement.before( tableSearchTagOpen + tableSearchTagClose);
					$('div.dataTables_filter input').attr('placeholder', 'Search...');
				}
				initAllElement();

				$('.datatable').fadeIn('slow');
				$(window).resize();
				$('[tooltip]').each(function(){
					if ($(this).attr('tooltip')) $(this).tooltip({title: $(this).attr('tooltip') });
				});
			},*/
			fnDrawCallback: function (oSettings) {
				initAllElement();
				$(window).resize();
			},
			aaSorting: [],
			searching: isAjax ? false : true
		};
		var theads = $(this).find('th')
		if (isAjax){
			var thisDatatableElement = $(this);
			dataTableOption.processing = true;
			dataTableOption.serverSide = true;
			dataTableOption.ajax = {
				url: $(this).data('ajax-url'),
				type: 'POST',
				dataSrc: function(data){
					var datatableFormat = [];
					$.each(data.data, function(index, row){
						datatableFormat[index] = [];
						$.each(theads, function(theadIndex, thead){
							var name = $(thead).data('column-name');
							if (name == undefined || name == '') datatableFormat[index].push('');

							if (name == 'ALL')
								datatableFormat[index].push(row);
							else
								datatableFormat[index].push(getValue(row, name));
						})
					})
					return datatableFormat;
				},
			};
			dataTableOption.ajax.data = function ( filter ) {
				if (!filter) filter = {};
				if (dataTableAction && dataTableAction != '') filter.datatableAction = dataTableAction;
				if (typeof customFilter === "function") filter = customFilter(filter, datatableIndex);
				if (filter.order){
					filter.order.forEach(function(row){
						if (row['column'] || row['column'] == 0){
							var index = row['column'];
							row['columnName'] = $(theads[index]).data('column-name');
						}
					});
				}
				filter.headers = {};
				$.each(theads, function(theadIndex, thead){
					var name = $(thead).data('column-name');
					var excludeExport = $(thead).data('column-name');
					if ((name != undefined || name != '') && $(thead).attr('exclude-export') != undefined) {
						filter.headers[name] = $(thead).html();
					}
				});
				if (filter.search == undefined) filter.search = {};
				filter.search.value = self.closest('.card').find('.table-search input').val();
				return filter;
			}

		}
		if (typeof customColumns === "function") {
			var myCustomColumns = customColumns(datatableIndex);
			var columns = [];
			$.each(theads, function(theadIndex, thead){
				if (myCustomColumns[theadIndex] == undefined){
					columns.push({ data: theadIndex, autoWidth: true });
				} else {
					columns.push({ data: theadIndex, autoWidth: true, render: function(data, type, row, meta){ return myCustomColumns[theadIndex](data, type, row, meta)}, class : "text-center",   });
				}
			});
			dataTableOption.columns = columns;
		}
		var datatable = $(this).DataTable(dataTableOption).columns.adjust();

		$(this).closest('.card').find('.table-search input').keyup(function() {
			delay(function(){
				datatable.ajax.reload();
			}, 200 );
		});
		dataTableList.push(datatable);
	});
	initAllElement();

	initTableButtonExport('xlsx');
	initTableButtonExport('csv');

});

function initTableButtonExport(type) {
	$('.table-setting.table-setting-' + type).click(function() {
		dataTableAction = type;
		var form = $('.table-setting-' + type+'-form').first();
		form.attr('action', dataTableOption.ajax.url);
		form.find('input[type=hidden]').remove();
		$.each(dataTableOption.ajax.data(), function(key, value){
			if (key == 'headers'){
				form.append('<input type="hidden" name="'+key+'" value=\''+JSON.stringify(value)+'\'/>');
			}
			else if (Array.isArray(value)){
				$.each(value, function(arrayKey, arrayValue){
					form.append('<input type="hidden" name="'+key+'[]" value="'+arrayValue+'"/>');
				});
			} else{
				form.append('<input type="hidden" name="'+key+'" value="'+value+'"/>');
			}
		});
		form.submit();
		dataTableAction = '';
	});
}
