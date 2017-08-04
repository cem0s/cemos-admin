
 $(function () {
    // $('input').iCheck({
    //   checkboxClass: 'icheckbox_square-blue',
    //   radioClass: 'iradio_square-blue',
    //   increaseArea: '20%' // optional
    // });
    $('#data-table').DataTable();
    $('.select2').select2();
    $('input[name="price"]').on('input', function() {
	    this.value = this.value.match(/\d{0,6}(\.\d{0,2})?/)[0];
	  });


});

function changeStatus(id, orderId)
{
	$.ajax({
		url:'/cemos-admin/change-order-status',
		data: {id: id, orderId:orderId},
		success: function(res) {
			console.log(res);
			if(res) {
				location.reload();
			} else {
				alert('Ops, there\\s an error in updating the order status. Kindly contact the web admin.');
				return false;
			}
		}
	});
}

function changeSupplier(id, nId)
{
	getModalForSupplier(id, nId);
	getSupplierType();
	$('#modal-supplier').modal('show');

}

function getModalForSupplier(id, nId)
{
	var modal = '';

	modal+='<div class="modal fade" id="modal-supplier">'
	    modal+='<div class="modal-dialog">';
	        modal+='<div class="modal-content">';
		        modal+='<div class="modal-header">';
		            modal+='<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
		               modal+='<span aria-hidden="true">&times;</span></button>';
		            modal+='<h4 class="modal-title">Choose Supplier</h4>';
		        modal+='</div>';
		        modal+='<div class="modal-body">';
		            modal+='<select class="form-control" name="type" id="type" onclick="showSupplier()"></select><br>';
		            modal+='<select class="form-control" name="supplier" id="supplier"></select>';
		        modal+='</div>';
		        modal+='<div class="modal-footer">';
		            modal+='<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>';
		            modal+='<button type="button" class="btn btn-primary" onclick="assign('+id+ ','+nId+ ')">Assign Supplier</button>';
		        modal+='</div>';
	        modal+='</div>';
	   modal+=' </div>';
   modal+=' </div>';

   $('body').append(modal);
}

function getSupplierList()
{
	$.ajax({
		url: "/cemos-admin/get-suppliers",
		success: function(res){

		}
	});
}

function getSupplierType()
{
	$('#modal-supplier select[name="type"]').html('');
	$.ajax({
		url: "/cemos-admin/get-supplier-type",
		success: function(res){
			var d = $.parseJSON(res);
            var options = '<option value="-">--Select Supplier Type--</option>';
            $.each(d, function (i, item) {
                options += '<option value="' + item.id + '">' + item.name + '</option>';

            });
            $('#modal-supplier select[name="type"]').append(options);
		}
	});
}

function showSupplier()
{

	var typeId = $('#type').val();

	$.ajax({
		url: "/cemos-admin/get-supplier-by-type",
		data: {id: typeId},
		success: function(res){
			var d = $.parseJSON(res);
            var options = '<option value="-">--Select Supplier--</option>';
            $.each(d, function (i, item) {
                options += '<option value="' + item.id + '">' + item.name + '</option>';

            });

            $('#modal-supplier select[name="supplier"]').html(options);
		}
	});
}

function assign(id, nId)
{
	var supId = $('#supplier').val();

	$.ajax({
		url: '/cemos-admin/assign-supplier',
		data:{ id: id, supplier:supId, nId:nId},
		success: function(res)
		{
			if(res) {
				location.reload();
			} else {
				alert('Ops, there is something wrong in assigning this product to a supplier. Kindly contact the web admin.');
				return;
			}

		}
	});
}

function addCompany()
{
	$('#company-modal').modal('show');
}

function compDelModal(id)
{
	getDelConfirmationCom(id);
	$('#modal-del-comp').modal('show');
}

function getDelConfirmationCom(id)
{
	var modal = '';

	modal+='<div class="modal fade" id="modal-del-comp">'
	    modal+='<div class="modal-dialog">';
	        modal+='<div class="modal-content">';
		        modal+='<div class="modal-header">';
		            modal+='<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
		               modal+='<span aria-hidden="true">&times;</span></button>';
		            modal+='<h4 class="modal-title">Confirmation</h4>';
		        modal+='</div>';
		        modal+='<div class="modal-body">';
		            modal+='Are you sure you want to delete this company?<br>';
		            modal+='Please be noted that the orders associated with it will not be available upon deletion.';
		        modal+='</div>';
		        modal+='<div class="modal-footer">';
		            modal+='<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>';
		            modal+='<button type="button" class="btn btn-primary" onclick="delCompany('+id+')">Yes</button>';
		        modal+='</div>';
	        modal+='</div>';
	   modal+=' </div>';
   modal+=' </div>';

   $('body').append(modal);
}

function delCompany(id)
{
	$.ajax({
		url: "/cemos-admin/del-company/"+id,
		beforeSend:  function () {

		},
		success: function (res) {
			if(res) {
				location.reload();
			} else {
				alert('Oops, there\'s an error in submitting the form. Kindly contact the web admin.');
			}
		}
	});
}

function editCompany(id)
{
	$('#company-edit').modal('show');
	$('#company-edit #type').html('');
	$.ajax({
		url: "/cemos-admin/edit-company/"+id,
		beforeSend: function () {
			$('#company-edit #status-msg').css('display','block');
			$('#company-edit .modal-body').css('display','none');
		},
		success: function (res) {
			$('#company-edit #status-msg').css('display','none');
			$('#company-edit .modal-body').css('display','block');
			var d = JSON.parse(res);
			var stag = "";
			var op1 = "";
			var op2 = "";
			var op3 = "";
			$('#company-edit #company').val(d.name);
			$('#company-edit #phone').val(d.phone);
			$('#company-edit #company_id').val(d.id);
			op1 += "<option value='1'>Admin</option>";
			op2 += "<option value='2'>Realtor</option>";
			op3 += "<option value='2'>Supplier</option>";
			$.each(d.type, function(i, v){
				if(v=="Admin"){
					op1 = "<option value='1' selected='selected'>Admin</option>";
				} 
				if(v=="Realtor"){
					op2 = "<option value='2' selected='selected'>Realtor</option>";
				} 
				if(v=="Supplier"){
					op3 = "<option value='3' selected='selected'>Supplier</option>";
				} 
			});
			stag += op1 + op2 + op3;


			$('#company-edit #type').append(stag);


			
		}
	});
}


function addProduct()
{
	$('#product-modal').modal('show');
}

function prodDelModal(id)
{
	getDelConfirmationProd(id);
	$('#product-del').modal('show');
}

function getDelConfirmationProd(id)
{
	var modal = '';

	modal+='<div class="modal fade" id="product-del">'
	    modal+='<div class="modal-dialog">';
	        modal+='<div class="modal-content">';
		        modal+='<div class="modal-header">';
		            modal+='<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
		               modal+='<span aria-hidden="true">&times;</span></button>';
		            modal+='<h4 class="modal-title">Confirmation</h4>';
		        modal+='</div>';
		        modal+='<div class="modal-body">';
		            modal+='Are you sure you want to delete this product?<br>';
		        modal+='</div>';
		        modal+='<div class="modal-footer">';
		            modal+='<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>';
		            modal+='<button type="button" class="btn btn-primary" onclick="delProduct('+id+')">Yes</button>';
		        modal+='</div>';
	        modal+='</div>';
	   modal+=' </div>';
   modal+=' </div>';

   $('body').append(modal);
}

function delProduct(id)
{
	$.ajax({
		url: "/cemos-admin/del-product/"+id,
		beforeSend:  function () {

		},
		success: function (res) {
			if(res) {
				location.reload();
			} else {
				alert('Oops, there\'s an error in submitting the form. Kindly contact the web admin.');
			}
		}
	});
}

function editProduct(id)
{
	$('#product-edit').modal('show');
	$.ajax({
		url: "/cemos-admin/edit-product/"+id,
		beforeSend: function () {
			$('#product-edit #status-msg').css('display','block');
			$('#product-edit .modal-body').css('display','none');
		},
		success: function (res) {
			$('#product-edit #status-msg').css('display','none');
			$('#product-edit .modal-body').css('display','block');
			var d = JSON.parse(res);
			var t = "";
			var category = [
				{name:"Photography",value:"Photo"},
				{name:"Video",value:"Video"},
				{name:"Architectural",value:"Archi"},
				{name:"Marketing",value:"Market"},
			];

			$('#product-edit #product_id').val(d.id);
			$('#product-edit #name').val(d.name);
			$('#product-edit #desc').val(d.description);
			$('#product-edit #price').val(d.price);

			
			$.each(category, function(i, v){
				if(v.value== d.category) {
					t += "<option value="+v.value+" selected='selected'>"+v.name+"</option>";
				}
				t += "<option value="+v.value+">"+v.name+"</option>";	
			});

			$('#product-edit #category').append(t);

		}
	});
}