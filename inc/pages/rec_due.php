<!-- Begin Page Content -->
<div class="container-fluid">
	<h1 class="h3 mb-4 text-gray-800">Product Receive</h1>
	<div class="row">
	    <div class="col-lg-12">
	    	<div class="card shadow mb-4">
		        <div class="card-header">
		        	<div class="row">
		        		<div class="col-md-12 text-right" style="margin-bottom: 4rem"><button  onclick="location.reload();" type="button" class="btn btn-danger">Click Here For Product Insert With New Invoice</button></div>
						<div class="col-md-8"><p class="m-0 font-weight-bold text-primary">PRODUCT</p></div>						
						<div class="col-md-4"><input type="date" class="form-control" id="inputDate" value="<?= date('Y-m-d');?>"></div>
			      	</div>
		        </div>
		        <div class="card-body">
		        	<form id="received_product">
		        		<table style="width: -webkit-fill-available;">		        			
		        			<tbody>
		        				<tr>
		        				 	<td colspan="2"><div class="mar-rig"><input type="text" class="form-control" id="inputInvoice" placeholder="INVOICE NUMBER"></div></td>
                                    <td><div class="mar-rig"><input type="text" class="form-control" id="inputRefe" placeholder="REFERANCE NUMBER"></div></td>
                                </tr>                               
		        			</tbody>
		        		</table>

		        		<table style="width: -webkit-fill-available;margin-top: 3rem">		        			
		        			<tbody>		        				
                                <tr>
                                	<td><div class="mar-rig"><input type="text" class="form-control" id="inputProduct" placeholder="Search Product Name"></div>
		        					<ul id="searchResult"></ul>
                                    <input type="hidden" id="pro_id">
                                    </td>
                                   
		        					<td><div class="mar-rig"><input type="number" class="form-control" id="inputQTY" placeholder="Product Qty."></div></td>
		        					<td><button type="button" class="btn btn-success btn-block" id="submit_product" name="submit_product">Update</button></td>
		        				</tr>
		        			</tbody>
		        		</table>
		        	</form>
		        </div>
		    </div>
    	</div>
    </div>
</div>
<div class="container-fluid" id="pro_dis" style="display: none">
	<div class="row">
	    <div class="col-lg-12">
	    	<div class="card shadow mb-4">
		        <div class="card-header">
		        	<div class="row">
						<div class="col-md-8"><p class="m-0 font-weight-bold text-primary">PRODUCT DETAILS</p></div>
						<div class="col-md-12">
							<h6>Rate : <span class="p_rate"></span></h6>
							<h6>Total Quantity : <span class="p_qty"></span></h6>
						</div>
			      	</div>
		        </div>
		        <div class="card-body">
			        <div class="container-fluid">
			          <div class="card shadow mb-4">				            
			            <div class="card-body">
			              <div class="table-responsive">
			                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			                  <thead>
			                    <tr>
			                      <th>Invoice Number</th>
			                      <th>Referance Number</th>
			                      <th>Quantity</th>
			                      <th>Date</th>
			                    </tr>
			                  </thead>			                 
			                  <tbody class="product_history"></tbody>
			                </table>
			              </div>
			            </div>
			          </div>
			        </div>
		        </div>
		    </div>
		</div>
	</div>
</div>


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
	#searchResult{
        list-style: none;
        padding: 0px;
        width: 100%;
        margin: 0;
    }

    #searchResult li{
        background: lavender;
        padding: 4px;
        margin-bottom: 1px;
    }

    #searchResult li:nth-child(even){
        background: cadetblue;
        color: white;
    }

    #searchResult li:hover{
        cursor: pointer;
    }
</style>
<?php include 'inc/require_page_content/bottom.php'; ?>
<script>

    $(document).ready(function(){
		$("#inputProduct").on('change keyup paste mouseup', function(){
            var search = $(this).val();
            // console.log(search);
            if(search != ""){
                $.ajax({
                    url: 'process/data.php',
                    type: 'post',
                    data: {search:search, type:1},
                    dataType: 'json',
                    success:function(response){
                    	// console.log(response);
                        var len = response.length;
                        $("#searchResult").empty();
                        for( var i = 0; i<len; i++){
                            var id = response[i]['id'];
                            var name = response[i]['name'];
                            $("#searchResult").append("<li class='mar-rig' value='"+id+"'>"+name+"</li>");
                        }
                        // binding click event to li
                        $("#searchResult li").bind("click",function(){
                            setText(this);
                        });

                    }
                });
            }
		});
	});

	// Set Text to search client name and get details
	function setText(element){
		if($(element).text() == 'No Product Name Found'){					
		}else{
			var value = $(element).text();
			var proid = $(element).val();

			$("#inputProduct").val(value);
	        $("#pro_id").val(proid);

	        $("#pro_dis").show();

	        fetchProductDetails(proid);
		}
		$("#searchResult").empty();	
	}

	function fetchProductDetails(proid) {
		$.ajax({
            url: 'process/data.php',
            type: 'post',
            data: {search:proid, type:2},
            dataType: 'json',
            success:function(response){
            	$(".p_rate").text(response[0].rate);
            	$(".p_qty").text(response[0].qty);             
            }
        });

        $.ajax({
            url: 'process/data.php',
            type: 'post',
            data: {search:proid, type:3},
            dataType: "html", 
	        success: function(response){                    
	            $(".product_history").html(response); 
	        }
        });
	}

	// this is the id of the form
	$("#submit_product").click(function(e) {
		var formData = {
		  id: $("#pro_id").val(),
		  inputInvoice: $("#inputInvoice").val(),
		  inputRefe: $("#inputRefe").val(),
		  inputQTY: $("#inputQTY").val(),
		  prev_qty:$(".p_qty").text(),
		  date:$("#inputDate").val(),
		  purpose: 'product insertion',
		};
	    $.ajax({
           type: "POST",
           url: 'process/data.php',
           data: formData,
           success: function(data){
           		fetchProductDetails($("#pro_id").val());
           		$("#pro_id").val("");
           		$("#inputProduct").val("");
           		$("#inputQTY").val("");
               swal(data);               
           },
           error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            },
	    });
	});
</script>