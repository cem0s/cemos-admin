
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
	getSelectTagOptions('modal-supplier','type','get-supplier-type');
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

function getSelectTagOptions(modalName, inputName, url)
{
	$('#'+modalName+' select[name="'+inputName+'"]').html('');
	$.ajax({
		url: "/cemos-admin/"+url,
		success: function(res){
			var d = $.parseJSON(res);
            var options = '<option value="">--Select Here--</option>';
            $.each(d, function (i, item) {
                options += '<option value="' + item.id + '">' + item.name + '</option>';

            });
            $('#'+modalName+' select[name="'+inputName+'"]').append(options);
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


function addSupplier()
{
	getSelectTagOptions('add-supplier-modal','supplier','get-company-json');
	getSelectTagOptions('add-supplier-modal','supplierType','get-supplier-type');
	$('#add-supplier-modal').modal('show');
}

function addSupplierType()
{
	$('#add-supp-type-modal').modal('show');
}

function addStatus()
{
	$('#add-status').modal('show');
}

function addUser()
{
	getSelectTagOptions('user-modal','company_name','get-company-json');
	$('#user-modal').modal('show');
}

function compDelModal(id)
{
	getDelConfirmationCom(id);
	$('#modal-del-comp').modal('show');
}


function compDelSup(id, typeId)
{
	getSupplierDeleteConf(id, typeId);
	$('#modal-del-sup').modal('show');
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

function getSupplierDeleteConf(id, typeId)
{
	var modal = '';

	modal+='<div class="modal fade" id="modal-del-sup">'
	    modal+='<div class="modal-dialog">';
	        modal+='<div class="modal-content">';
		        modal+='<div class="modal-header">';
		            modal+='<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
		               modal+='<span aria-hidden="true">&times;</span></button>';
		            modal+='<h4 class="modal-title">Confirmation</h4>';
		        modal+='</div>';
		        modal+='<div class="modal-body">';
		            modal+='Are you sure you want to delete this supplier?<br>';
		        modal+='</div>';
		        modal+='<div class="modal-footer">';
		            modal+='<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>';
		            modal+='<button type="button" class="btn btn-primary" onclick="delSupplier('+id+','+typeId+')">Yes</button>';
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



function delSupplier(id, typeId)
{
	$.ajax({
		url: "/cemos-admin/del-supplier",
		data: {id:id, typeId:typeId},
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

			$('#product-edit #category').html(t);

		}
	});
}

function editType(id)
{
	$('#edit-type').modal('show');

	$.ajax({
		url: "/cemos-admin/edit-supplier-type/"+id,
		success:function(res){
			var d = $.parseJSON(res);
			$('#typeName').val(d.name);
			$('#typeId').val(d.id);
		}
	});
}

function editStatus(id)
{
	$('#edit-status').modal('show');

	$.ajax({
		url: "/cemos-admin/edit-status/"+id,
		success:function(res){

			var d = $.parseJSON(res);
			$('#statusName').val(d.name);
			$('#statusId').val(d.id);

			var t = "";
			var type = [
				{name:"Order",value:"1"},
				{name:"Order Product",value:"2"}
			];

			$.each(type, function(i, v){
				if(v.value == d.type) {
					t += "<option value="+v.value+" selected='selected'>"+v.name+"</option>";
				} else {
					t += "<option value="+v.value+">"+v.name+"</option>";	
				}
				
			});

			$('#edit-status #typeId').html(t);

			
		}
	});
}

function editUser(id)
{
	$('#user-edit').modal('show');

	$.ajax({
		url: "/cemos-admin/get-user/"+id,
		success:function(res) {
			var d = $.parseJSON(res);
			var debt = "";
			var g = "";


			$("#userId").val(d.user.id);
			$("#first_name").val(d.user.firstname);
			$("#last_name").val(d.user.lastname);
			$("#email").val(d.user.email);
			$("#password").val("");
			$("#address_1").val(d.address.address_1);
			$("#addressId").val(d.address.id);
			$("#inAddressId").val(d.invoiceaddress.id);
			$("#address_2").val(d.address.address_2);
			$("#postal_code").val(d.address.zipcode);
			$("#town").val(d.address.town);
			$("#iban").val(d.invoiceaddress.cocNumber);
			$("#tax_number").val(d.invoiceaddress.tax);

			if(d.user.group_id == 1) {
				g += "<option value='1' selected='selected'> Admin </option>";
				g += "<option value='0' > User </option>";
			} else {
				g += "<option value='1' > Admin </option>";
				g += "<option value='0' selected='selected'> User </option>";
			}	

			getCompanyJson(d.user.company_id);


			if(d.invoiceaddress.payment == "Debit") {
				debt += "<input type='radio' name='isDebit' value='Debit' checked='checked'> Debit  ";
				debt += "<input type='radio' name='isDebit' value='Invoice'> Invoice";
			} else {
				debt += "<input type='radio' name='isDebit' value='Debit'> Debit  ";
				debt += "<input type='radio' name='isDebit' value='Invoice' checked='checked'> Invoice";
			}
			$('#debitOpt').html(debt);
			$('#groupId').html(g);




		}
	});
}

function successCallback(data, id) 
{
	var d = $.parseJSON(data);
	var opt = ""; 
	$.each(d, function (i, v){

		if(v.id == id) {
			opt += "<option value="+v.id+" selected='selected'> "+v.name+"</option>";
		} else {
			opt += "<option value="+v.id+"> "+v.name+"</option>";
		}
	});
	$('#user-edit #company_id').html(opt);
}

function getCompanyJson(id)
{
	$.ajax({
		url: "/cemos-admin/get-company-json",
		success: function (res) {
			successCallback(res, id);
		}
	});
}

function deactivateUser(id)
{
	getDeacUserModal(id);
	$('#user-deac').modal('show');
}


function getDeacUserModal(id)
{
	var modal = '';

	modal+='<div class="modal fade" id="user-deac">'
	    modal+='<div class="modal-dialog">';
	        modal+='<div class="modal-content">';
		        modal+='<div class="modal-header">';
		            modal+='<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
		               modal+='<span aria-hidden="true">&times;</span></button>';
		            modal+='<h4 class="modal-title">Confirmation</h4>';
		        modal+='</div>';
		        modal+='<div class="modal-body">';
		            modal+='Are you sure you want to deactivate this user?<br>';
		            modal+='Please be noted that the orders associated with it will not be available upon deletion.';
		        modal+='</div>';
		        modal+='<div class="modal-footer">';
		            modal+='<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>';
		            modal+='<button type="button" class="btn btn-primary" onclick="deacUser('+id+')">Yes</button>';
		        modal+='</div>';
	        modal+='</div>';
	   modal+=' </div>';
   modal+=' </div>';

   $('body').append(modal);
}

function deacUser(id)
{
	$.ajax({
		url: "/cemos-admin/deac-user/"+id,
		success: function(res){
			if(res) {
				alert("User has been deactivated");
				location.reload();
			} else {
				alert("There\'s an error in deactivating the user. Kindly contact the web admin.");
			}
		}
	});
}