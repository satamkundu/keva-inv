<!-- Begin Page Content -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<div class="container-fluid">
	<h1 class="h3 mb-4 text-gray-800">BILL GENERATION</h1>
	<div class="row">
	    <div class="col-lg-12">
	    	<div class="card shadow mb-4">
		        <div class="card-header">
		        	<div class="row">
						<div class="col-md-4"><p class="m-0 font-weight-bold text-primary">BILL TO</p></div>
						<div class="col-md-4">
						      <select id="clientType" class="form-control">
						        <option value="0" selected>Choose Client Type</option>
						        <option value="1">Stock Point</option>
						        <option value="2">Distributer</option>
						      </select>
						</div>
						<div class="col-md-4"><input type="date" class="form-control" id="inputDate" value="<?= date('Y-m-d');?>"></div>
			      	</div>
		        </div>
		        <div class="card-body">
		        	<form id="received_address">
		        		<table style="width: -webkit-fill-available;">
		        			<thead>
		        				<tr>
		        					<th>Name</th>
			        				<th>Address</th>
			        				<th>Phone</th>
			        				<th>GST No/Pan No</th>
			        				<th>Code</th>
			        				<th>Previous Due</th>
		        				<tr>
		        			</thead>
		        			<tbody>
		        				<tr>
		        					<input type="hidden" name="cID" id="clientID">
		        					<td><div class="mar-rig"><input class="form-control" id="inputName" placeholder="Company Name" onkeyup="search_client(this.id)"></div></td>
		        					<td><div class="mar-rig"><input type="text" class="form-control" id="inputAddress" placeholder="Address" disabled ></div></td>
		        					<td><div class="mar-rig"><input type="number" class="form-control" id="inputPhone" placeholder="Phone" disabled ></div></td>
		        					<td><div class="mar-rig"><input type="text" class="form-control" id="inputGST" placeholder="GST No/Pan No" disabled ></div></td>
		        					<td><div class="mar-rig"><input type="text" class="form-control" id="code" placeholder="Code" disabled >
		        					<td><div class="mar-rig"><input type="text" class="form-control" id="prev_due" placeholder="Previous Due" disabled></div>
		        					</td>
		        				</tr>		        				
		        			</tbody>		        			
		        		</table>		        		
		        	</form>
		        </div>
		    </div>
    	</div>
    </div>
</div>

<div class="container-fluid">
	<div class="row">
	    <div class="col-lg-12">
	      <!-- Basic Card Example -->
	      <div class="card shadow mb-4">
	        <div class="card-header py-3">
	          <h6 class="m-0 font-weight-bold text-primary">PRODUCT DESCRIPTIONS</h6>
	        </div>
	        <div class="card-body">
				<form>
					<table style="width: 100%;" id="productTable">
						<thead>
							<tr>
								<th>Product Description</th>								
								<th>Qty</th>
							</tr>
						</thead>
						<tbody>
							<?php
						  		$arrayNumber = 0;
						  		for($x = 1; $x < 2; $x++) { 
						  	?>
						  	<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">
							  	<td>
							  		<div class="form-group mar-rig">
							  			<div class="ui-widget">
											<input type="text" class="form-control" id="pro<?php echo $x; ?>" placeholder="Search Product Name" style="margin-right: 15rem;" onkeyup="search_product(this.id)">
		                                	<input type="hidden" id="pro_id<?php echo $x; ?>">
		                                	<input type="hidden" id="p_rate<?php echo $x; ?>">
		                                	<input type="hidden" id="p_qty<?php echo $x; ?>">
		                                	<input type="hidden" id="p_hsn<?php echo $x; ?>">
											<input type="hidden" id="p_gst<?php echo $x; ?>">
											<input type="hidden" id="p_cgst<?php echo $x; ?>">
											<input type="hidden" id="p_sgst<?php echo $x; ?>">
											<input type="hidden" id="p_igst<?php echo $x; ?>">
											<input type="hidden" id="p_bp<?php echo $x; ?>">
		                                </div>
		                                <div>
		                                	<span>Rate : </span>
		                                		<span class="p_rt<?= $x; ?>" style="margin-right: 3rem"></span>
		                                	<span>Remaining Quantity : </span>
		                                		<span class="p_qt<?= $x; ?>" style="margin-right: 3rem"></span>
		                                	<span>BP : </span>
		                                		<span class="p_bp<?= $x; ?>"></span>
		                                </div>
									</div>
								</td>
								<td>
									<div class="form-group mar-rig">
										<input type="number" id="quantity<?php echo $x; ?>" autocomplete="off" class="form-control" min="1" placeholder="Enter Quantity" onkeyup="check_qty(<?php echo $x; ?>)" disabled/>
										<span>&nbsp;</span>
									</div>
								</td>				  				
							</tr>
						  	<?php
					  			$arrayNumber++;
						  	}
						  	?>
						</tbody>
					</table>				
					<div class="form-group col-md-2">
						<button type="button" class="btn btn-success" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="fas fa-plus-circle"></i> Add Row </button>
					</div>				
				</form>
	        </div>
	      </div><!-- basic card -->
	    </div><!-- col-12 -->
	</div><!-- row -->
</div><!-- /.container-fluid -->



<div class="container-fluid" id="con-bill" style="display: none">
	<div class="row">
	    <div class="col-lg-12">
	      <!-- Basic Card Example -->
	      	<div class="card shadow mb-4">
		        <div class="card-header py-3">
		          <h6 class="m-0 font-weight-bold text-primary">Bill Amount </h6>
		        </div>
		        <div class="card-body">
		        	<p class="bill-sec">
		        		Total Bill Amount : <span class="bill-value">0</span>
		        		<span style="margin-left: 4rem">Total BP : <span class="bp-value">0</span></span>
		        	</p>
		        	<div class="form-check">
					    <input type="checkbox" class="form-check-input" id="billCheck">
					    <label class="form-check-label" for="billCheck">Check Here To Submit Bill Amount</label>
				  	</div>
				  	<div class="form-group mar-rig paid-amount-div" style="display: none;margin-top: 2rem">
				  		<label class="form-check-label">Enter Paid Amount</label>
						<input type="number" id="paid-amount" autocomplete="off" class="form-control" min="1" placeholder="Enter Paid Amount" />
					</div>
		        </div>
		    </div>
		</div>
	</div>
</div>


<div class="container-fluid">
	<div class="row">
	    <div class="col-lg-12">
	    	<button id="calc_res" class="btn btn-block btn-info">Calculate Total Amount</button>
	    	<button id="again_calc" class="btn btn-block btn-info" style="display: none">Calculate Total Bill Again</button>
			<button id="gen_challan" class="btn btn-block btn-info" style="display: none">Submit Data</button>
			<button id="chln_jen" onclick="print_content()" class="btn btn-block btn-info" style="display: none">Print Bill</button>
		</div>
	</div>
</div>

<div style="display:none;" id="res"></div>

<style type="text/css">
	.pad-lef{
		margin-left: 2rem;
	}
	.mar-rig{
		margin-right: 1rem;
	}
	.wid-50{
		width: 50%;
	}
	input[type=number]::-webkit-inner-spin-button, 
	input[type=number]::-webkit-outer-spin-button { 
	    -webkit-appearance: none;
	    -moz-appearance: none;
	    appearance: none;
	    margin: 0; 
	}
    
</style>	

<?php include 'inc/require_page_content/bottom.php'; ?>
<script>

	var details = 
	{
		order_no : "",
		last_order_no : "",
		clent_type : "",
		date:"",
		client_details : {
			client_id : "",
			name : "",
			address : "",
			phone : "",
			gstin : "",
			code : "",
			prev_due :0,
		},		
		item_details :[],
		total_amount : 0.0,
		paid : 0.0,
		total_bp : 0.0,
		due : 0.0
	}

	var product_id = [];

	$(document).ready(function(){
	 	$("#paid-amount").hide();

	 	$('#clientType').change(function(){
	 		details.clientType = $(this).val();
	 	});

	 	$('#billCheck').change(function(){
        	$("#paid-amount")[ this.checked ? 'show' : 'hide']();
        	$(".paid-amount-div")[ this.checked ? 'show' : 'hide']();

        	if($('#billCheck').is(':checked')){}
        	else $("#paid-amount").val(0);        
   		}).change();

   		$('#paid-amount').change(function(){
   			if($(this).val() > 0){
   				details.paid = parseFloat($(this).val());
   			}
   		});

   		$("#calc_res").click(function(){
   			swal({
			  title: "Are you sure?",
			  text: "Calculate Total Amount ?",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((ok) => {
			  if (ok) {
			  	let error = 0;
				if($("#clientType").val() == 0){
					error = 1;
					swal({
					  text: "Choose Client Type",
					  icon: "error",
					});
				}
				if(details.client_details.client_id == ""){
					error = 1;
					swal({
					  text: "Enter Client Name",
					  icon: "error",
					});
				}
				if(error == 0){
				    calc_data();
		   			$("#calc_res").hide();
		   			$("#again_calc").show();
		   			fetch_order_seq();

		   			$("#con-bill").show();

		   			$("#gen_challan").show();
		   		}else{
		   // 			swal({
					//   text: "Fill All Fields Properly",
					//   icon: "error",
					// });
		   		}
			  } else {

			  }
			});			
   		});

   		$("#again_calc").click(function(){
   			$("#calc_res").show();
   			$("#again_calc").hide();
   			$("#con-bill").hide();
	   		$("#gen_challan").hide();
   		});

   		$("#gen_challan").click(function(){
   			swal({
			  title: "Are you sure?",
			  text: "You Want To Save Data ?",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((ok) => {
			  if (ok) {
			  	details.due = parseFloat(details.total_amount) - parseFloat(details.paid);
			    send_data_for_save();
			    $("#again_calc").hide();
	   			$("#gen_challan").hide();
			  } else {

			  }
			});
   		});

	});

	

	function calc_data(){
		details.total_amount = 0;
		details.total_bp = 0;
		details.item_details = [];

		details.date = $("#inputDate").val();

		var tableLength = $("#productTable tbody tr").length;

		var tableRow;
		var arrayNumber;
		var count;

		if(tableLength > 0) {		
			tableRow = $("#productTable tbody tr:last").attr('id');
			count = tableRow.substring(3);

			for(var i = 1; i <= count; i++){
				let qt = parseInt($("#quantity"+i).val());
				let va = ( qt * parseFloat($("#p_rate"+i).val()) );
				let bp = parseInt($("#p_bp"+i).val()) * qt;

				let to = parseFloat(va) + parseFloat($("#p_gst"+i).val()) + parseFloat($("#p_cgst"+i).val()) + parseFloat($("#p_sgst"+i).val()) + parseFloat($("#p_igst"+i).val());

				details.item_details.push({
					"item_id":$("#pro_id"+i).val(),
					"item_name":$("#pro"+i).val(),
					"rate":$("#p_rate"+i).val(),
					"hsn":$("#p_hsn"+i).val(),
					"gst":$("#p_gst"+i).val(),
					"qnty":$("#quantity"+i).val(),
					"value":va,
					"cgst":$("#p_cgst"+i).val(),
					"sgst":$("#p_sgst"+i).val(),
					"igst":$("#p_igst"+i).val(),
					"total" : to,
					"bp":bp,
					"prev_qty" : $("#p_qty"+i).val(),
				});

				details.total_amount += to;

				details.total_bp += bp;
			}
		}

		// console.log(details);
		$(".bill-value").text(details.total_amount);
		$(".bp-value").text(details.total_bp);
		
	}

	function print_content(){

		var hand_written = [];
        hand_written.push('<div id="content2" style="width: 11in;">'+
			'<style>@media print{@page{size: 8.5in 11in;margin-top: 0;}}</style>'+
			'<div style="text-align: center; margin-top:5rem">'+
				'<div style="width: 46%;display: inline-block;">ORIGINAL</div> '+
				'<div style="width: 46%;display: inline-block;">DUPLICATE</div>'+
			'</div>'+
			'<hr/>'+
			'<div style="width: 15%;display:inline-block;">'+
				'<img src="img/keva.png" style="height:4rem;margin-top: -4rem;">'+
			'</div>'+
			'<div style="width: 64%;display:inline-block;text-align:center">'+
				'<h2><?=$c_name?></h2>'+ 
				'<h6><?=$c_add?></h6>'+
				'<h6>Phone <?=$c_phone?> | Tin <?=$c_tin?></h6>'+
			'</div>'+
			'<div style="width: 15%;display:inline-block;">'+
				'<img src="img/kaipo.png" style="height:4rem;float:right">'+
			'</div>'+
			'<hr/>'+
			'<div>'+
				'<p style="display:inline-block;">Stock Transfer Number : '+details.order_no+'</p>'+
				'<p style="display:inline-block;float:right">Transfer Date : ' + details.date + '</p>'+				
			'</div>'+
			'<hr/>'+
			'<div>'+
				'<p style="display:inline-block;width:33%">Stock Amount Rs. : '+ details.total_amount +'</p>'+
				'<p style="display:inline-block;width:20%;text-align: center;">Paid Rs. : '+ details.paid +' </p>'+
				'<p style="display:inline-block;width:43%;text-align: right;">Previous Due : '+ details.client_details.prev_due +' | Due Rs. : '+ details.due +'</p>'+
			'</div>'+
			'<hr/>'+			
			'<div style="line-height: 0.2rem;width: 60%;display:inline-block;height:5rem">'+				
				'<h4>SURYA NATUROPATHY</h4>'+
				'<p>GST NO. XXXXXXXXXXXX</p>'+
				'<p>Super Stockist : MUNSHIRHUT</p>'+
				'<p>Vill. - Ballavbati, P.O. - Munshirhut, Near Munshirhut Post Office, Howrah </p>'+
				'<p> PH. - 7980557596 </p>'+						
			'</div>'+		
			'<div style="line-height: 0.2rem;width: 38%;display:inline-block;height:5rem">'+						
				'<h5>Bill To - <span style="margin-left:-0rem;"> '+ details.client_details.code +'</span></h5>'+
				'<p>Name - '+ details.client_details.name +'</p>'+								
				'<p>Address - '+ details.client_details.address +'</p>'+
				'<p>Phone - '+ details.client_details.phone +'</p>'+
				'<p>GST No / PAN No - '+ details.client_details.gstin +'</p>'+	
			'</div>'+
			'<hr/>'+						
			'<div>'+
				'<table style="width: 100%;border-collapse: collapse;border:0.1rem dotted;height: 5rem;" border="1">'+
					'<tr style="height: 2rem;">'+
						'<th>SL</th>'+
						'<th>PRODUCT DESCRIPTION</th>'+
						'<th>RATE</th>'+
						'<th>HSN</th>'+
						'<th>GST</th>'+
						'<th>QNTY</th>'+
						'<th>VALUE</th>'+
						'<th>CGST</th>'+
						'<th>SGST</th>'+
						'<th>IGST</th>'+
						'<th>TOTAL</th>'+
						'<th>B P</th>'+
					'</tr>');

					var cnt = 1;
					for(var i = 0; i < details.item_details.length; i++){
						hand_written.push('<tr style="height: 2rem;">'+
								'<td style="border: 0.1rem dotted;text-align: center;">'+cnt+'</td>'+
								'<td style="border: 0.1rem dotted;text-align: center;">'+details.item_details[i].item_name+'</td>'+
								'<td style="border: 0.1rem dotted">'+details.item_details[i].rate+'</td>'+
								'<td style="border: 0.1rem dotted;text-align: center;">'+details.item_details[i].hsn+'</td>'+
								'<td style="border: 0.1rem dotted;text-align: center;">'+details.item_details[i].gst+'</td>'+
								'<td style="border: 0.1rem dotted;text-align: center;">'+details.item_details[i].qnty+'</td>'+
								'<td style="border: 0.1rem dotted;text-align: center;">'+details.item_details[i].value+'</td>'+ 
								'<td style="border: 0.1rem dotted;text-align: center;">'+details.item_details[i].cgst+'</td>'+    
								'<td style="border: 0.1rem dotted;text-align: center;">'+details.item_details[i].sgst+'</td>'+    
								'<td style="border: 0.1rem dotted;text-align: center;">'+details.item_details[i].igst+'</td>'+    
								'<td style="border: 0.1rem dotted;text-align: center;">'+details.item_details[i].total+'</td>'+ 
								'<td style="border: 0.1rem dotted;text-align: center;">'+details.item_details[i].bp+'</td>'+                                
							'</tr>');
						cnt++;
					}
					hand_written.push('<tr style="height: 2rem;">'+
					    '<th colspan="10" style="text-align:start">Total</th>'+
						'<th style="text-align:end">'+details.total_amount+'</th>'+						
						'<th style="text-align:end">'+details.total_bp+'</th>'+
					'</tr>');

    	$("#res").html(hand_written.join(""));
		printDiv();
	}

	function printDiv(){
		// var divToPrint=document.getElementById('DivIdToPrint');
		// var divToPrint=document.getElementById('content2');
		//var newWin=window.open('','Print-Window');
		//newWin.document.open();
		//newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
		// newWin.document.close();
		// setTimeout(function(){newWin.close();},10);
		
		var printContents = document.getElementById('content2').innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = "<html><head><title></title></head><body>" + printContents + "</body>";
		window.print();
		document.body.innerHTML = originalContents;

		window.open("product_bill.php");
	}


	function addRow() {
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
			count = 1;
			arrayNumber = 0;
		}

		$(".delete_btn"+(count-1)).hide();

		var tr = '<tr id="row'+count+'" class="'+arrayNumber+'">'+
			  	'<td>'+
			  		'<div class="form-group mar-rig">'+
			  			'<div class="ui-widget">'+
							'<input type="text" class="form-control" id="pro'+count+'" placeholder="Search Product Name" style="margin-right: 15rem;" onkeyup="search_product(this.id)">'+	
		                    '<input type="hidden" id="pro_id'+count+'">'+
	                    	'<input type="hidden" id="p_rate'+count+'">'+
	                    	'<input type="hidden" id="p_qty'+count+'">'+
	                    	'<input type="hidden" id="p_hsn'+count+'">'+
							'<input type="hidden" id="p_gst'+count+'">'+
							'<input type="hidden" id="p_cgst'+count+'">'+
							'<input type="hidden" id="p_sgst'+count+'">'+
							'<input type="hidden" id="p_igst'+count+'">'+
							'<input type="hidden" id="p_bp'+count+'">'+
	                    '</div>'+
	                    ' <div><span>Rate : </span><span class="p_rt'+count+'" style="margin-right: 3rem"></span><span>Remaining Quantity : </span><span class="p_qt'+count+'" style="margin-right: 3rem"></span><span>BP : </span><span class="p_bp'+count+'"></span>'+
					'</div>'+
				'</td>'+
				'<td>'+
					'<div class="form-group mar-rig">'+
						'<input type="number" id="quantity'+count+'" autocomplete="off" class="form-control" min="1" placeholder="Enter Quantity"/>'+
						'<span>&nbsp;</span>'+
					'</div>'+
				'</td>'+
				'<td class="delete_btn'+count+'">'+
  					'<div class="form-group mar-rig">'+
  						'<button class="btn btn-danger btn-circle removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow('+count+')" style="margin-top: -2rem;"><i class="fas fa-trash"></i></button>'+  						
  					'</div>'+
  				'</td>'+
			'</tr>';
		if(tableLength > 0) {							
			$("#productTable tbody tr:last").after(tr);
		} else {				
			$("#productTable tbody").append(tr);
		}
	}

	function removeProductRow(row = null) {
		if(row) {
			$("#row"+row).remove();
			$(".delete_btn"+(row-1)).show();
		} else {
			alert('error! Refresh the page again');
		}
	}

	function send_data_for_save(){		
		var dataString = JSON.stringify(details);
		$.ajax({
			type: 'POST',    
			url:'process/data.php',
			data:{myData2: dataString},
			success: function(msg){
				if(msg == "Data Successfully Recorded"){
					swal({
						text: msg,
						icon: "success",
					});
					$("#chln_jen").show();
				}else{
					swal({
						text: msg,
						icon: "error",
					});
				}						
			}
		});
	}

	function fetch_order_seq() {
		$.ajax({
            url: "process/data.php",
            type: "post",
            dataType: "json",
            data: {
                fetch1 : "fetch_order_seq",
            },
            success: function( data ) {
            	details.order_no = data[0].first_chars + "/" + data[0].financial_year + "/" + data[0].o_number;
            	details.last_order_no = data[0].o_number;
            },
        });
	}

	function check_qty(number){
		let original_qty = parseInt($("#p_qty"+number).val());
		let now_qty = parseInt($("#quantity"+number).val());
		if(now_qty > original_qty){
			swal({
			  text: "Quantity Limit Reached",
			  icon: "error",
			});
			$("#quantity"+number).val(0);
		}
	}

</script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
	function search_product(id){
        $("#"+id).autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url: "process/request.php",
                    dataType: "json",
                    data: {
                        q: request.term,
                        client_type : details.clientType
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
            minLength: 3,
            select: function( event, ui ) {
                var vl = ui.item.id; 
                var qty = ui.item.qty; 
                var num = $("#"+id).attr('id');

                let gst = ui.item.gst;
                let cgst = ui.item.cgst;
                let sgst = ui.item.sgst;
                let igst = ui.item.igst;
                let hsn = ui.item.hsn;
                let bp = ui.item.bp;

                $("#pro_id"+num.substring(3)).val(vl);
                $("#p_rate"+num.substring(3)).val(ui.item.rate);
                $("#p_qty"+num.substring(3)).val(qty);

                $("#p_gst"+num.substring(3)).val(gst);
                $("#p_cgst"+num.substring(3)).val(cgst);
                $("#p_sgst"+num.substring(3)).val(sgst);
                $("#p_igst"+num.substring(3)).val(igst);
                $("#p_hsn"+num.substring(3)).val(hsn);
                $("#p_bp"+num.substring(3)).val(bp);

                $(".p_rt"+num.substring(3)).text(ui.item.rate);
                $(".p_qt"+num.substring(3)).text(qty);
                $(".p_bp"+num.substring(3)).text(bp);

                if(product_id.includes(vl)){
                	swal({
					  title: "Product Already Taken",
					  icon: "error",
					});
                }else{
                	let table = $("#productTable tbody tr:last").attr('id');
                	let num = table.substring(3);
                	if(qty == 0){

                	}else{
                		product_id.push(vl);
                		$("#pro" + num).attr("disabled", true);
                		$("#quantity" + num).attr("disabled", false);
                	}                	
                }

            },
            open: function() {},
            close: function() {},
        });
    }

    function search_client(id){
        $("#"+id).autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url: "process/request.php",
                    dataType: "json",
                    data: {
                        qr: request.term,
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
            minLength: 3,
            select: function( event, ui ) {
            	let clientID = ui.item.id;
            	let clientName = ui.item.value;
            	let clientAdd = ui.item.add;
            	let clientPhone = ui.item.phone;
            	let clientGst = ui.item.gstorpan;
            	let clientCode = ui.item.code;
            	let clientDue = ui.item.due;

                $("#clientID").val(clientID);
                $("#inputAddress").val(clientAdd);
                $("#inputPhone").val(clientPhone);
                $("#inputGST").val(clientGst);
                $("#code").val(clientCode);
                $("#prev_due").val(clientDue);

                details.client_details.client_id = clientID;				
				details.client_details.name = clientName;
                details.client_details.address = clientAdd;
                details.client_details.phone = clientPhone;
                details.client_details.gstin = clientGst;
                details.client_details.code = clientCode;
                details.client_details.prev_due = parseFloat(clientDue);
            },
            open: function() {},
            close: function() {},
        });
    }
</script>