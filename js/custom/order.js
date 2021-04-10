
function addRow() {
	$("#addRowBtn").button("loading");

	var tableLength = $("#productTable tbody tr").length;

	var tableRow;
	var arrayNumber;
	var count;

	if(tableLength > 0) {		
		tableRow = $("#productTable tbody tr:last").attr('id');
		arrayNumber = $("#productTable tbody tr:last").attr('class');
		count = tableRow.substring(3);	
		count = Number(count) + 1;
		arrayNumber = Number(arrayNumber) + 1;					
	} else {
		// no table row
		count = 1;
		arrayNumber = 0;
	}

	
	$("#addRowBtn").button("reset");	

	var tr = '<tr id="row'+count+'" class="'+arrayNumber+'">'+
		  	'<td>'+
		  		'<div class="form-group mar-rig">'+
					'<input type="text" class="form-control" id="inputDescription" placeholder="Enter Description of Goods Delivered" style="margin-right: 15rem;">'+
				'</div>'+
			'</td>'+
			'<td>'+
				'<div class="form-group mar-rig">'+
					'<input type="number" name="quantity[]" id="quantity'+count+'" autocomplete="off" class="form-control" min="1" />'+
				'</div>'+
			'</td>'+
			'<td>'+
				'<div class="form-group mar-rig">'+
					'<input type="number" name="rate[]" id="rate'+count+'" autocomplete="off" class="form-control" />'+
				'</div>'+
			'</td>'+
			'<td>'+
				'<div class="form-group mar-rig">'+
  					'<input type="text" name="hsn[]" id="hsn'+count+'" autocomplete="off" class="form-control" />'+	
  				'</div>'+			  					
				'</td>'+
				'<td>'+
					'<div class="form-group mar-rig">'+
						'<button class="btn btn-danger btn-circle removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow('+count+')"><i class="fas fa-trash"></i></button>'+
				'</td>'+
		'</tr>';


	if(tableLength > 0) {							
		$("#productTable tbody tr:last").after(tr);
	} else {				
		$("#productTable tbody").append(tr);
	}	

} // /add row

function removeProductRow(row = null) {
	if(row) {
		$("#row"+row).remove();


		subAmount();
	} else {
		alert('error! Refresh the page again');
	}
}


function addRowForProduced() {
	$("#addRowBtnForProduced").button("loading");

	var tableLengthNext = $("#productTableForProduced tbody tr").length;

	var tableRowNext;
	var arrayNumberNext;
	var countNext;

	if(tableLengthNext > 0) {		
		tableRowNext = $("#productTableForProduced tbody tr:last").attr('id');
		arrayNumberNext = $("#productTableForProduced tbody tr:last").attr('class');
		countNext = tableRowNext.substring(3);	
		countNext = Number(countNext) + 1;
		arrayNumberNext = Number(arrayNumberNext) + 1;					
	} else {
		// no table row
		countNext = 1;
		arrayNumberNext = 0;
	}

	
	$("#addRowBtn").button("reset");	

	var tr = '<tr id="row'+countNext+'" class="'+arrayNumberNext+'">'+
		  	'<td>'+
		  		'<div class="form-group mar-rig">'+
					'<input type="text" class="form-control" id="inputDescriptionForProduced" placeholder="Enter Description of Goods To Be Produced" style="margin-right: 15rem;">'+
				'</div>'+
			'</td>'+
			'<td>'+
				'<div class="form-group mar-rig">'+
					'<input type="number" name="quantityForProduced[]" id="quantityForProduced'+countNext+'" autocomplete="off" class="form-control" min="1" />'+
				'</div>'+
			'</td>'+
			'<td>'+
				'<div class="form-group mar-rig">'+
					'<input type="number" name="rateForProduced[]" id="rateForProduced'+countNext+'" autocomplete="off" class="form-control" />'+
				'</div>'+
			'</td>'+
			'<td>'+
				'<div class="form-group mar-rig">'+
  					'<input type="text" name="hsnForProduced[]" id="hsnForProduced'+countNext+'" autocomplete="off" class="form-control"/>'+
  				'</div>'+			  					
				'</td>'+
				'<td>'+
					'<div class="form-group mar-rig">'+
						'<button class="btn btn-danger btn-circle removeProductRowBtnForProduced" type="button" id="removeProductRowBtnForProduced" onclick="removeProductRowForProduced('+countNext+')"><i class="fas fa-trash"></i></button>'+
				'</td>'+
		'</tr>';


	if(tableLengthNext > 0) {							
		$("#productTableForProduced tbody tr:last").after(tr);
	} else {				
		$("#productTableForProduced tbody").append(tr);
	}	

} // /add row

function removeProductRowForProduced(row = null) {
	if(row) {
		$("#row"+row).remove();
		subAmount();
	} else {
		alert('error! Refresh the page again');
	}
}

