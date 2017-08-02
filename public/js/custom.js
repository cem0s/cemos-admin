
 $(function () {
    // $('input').iCheck({
    //   checkboxClass: 'icheckbox_square-blue',
    //   radioClass: 'iradio_square-blue',
    //   increaseArea: '20%' // optional
    // });
    $('#ordertable').DataTable()




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