<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    @section('htmlheader')
        @include('partials.htmlheader')
    @show

</head>

<body class="skin-blue sidebar-mini">
    <div id="app">
        <div class="wrapper">

        @include('partials.header')

        @include('partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            @include('partials.contenthead')

            <!-- Main content -->
            <section class="content">
                <!-- Your Page Content Here -->
                @yield('main-content')
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        @include('partials.controlsidebar')

        @include('partials.footer')

    </div><!-- ./wrapper -->
</div>
@section('scripts')
    @include('partials.scripts')
@show
<script type="text/javascript">
    
$(function () {
    ajaxCall();
    setInterval(ajaxCall, 5000); 

    function ajaxCall() 
    {
        
        $.ajax({
            url:"/cemos-admin/get-notif",
            success: function(res){
                var p = JSON.parse(res);
                $('#count-n').html(p.length);
                $('#status-head').html('You have '+p.length+' order products that require supplier assignment.');

                var li = "";
                $.each(p, function (i, item) {
        
                    li+= "<li>";
                        li+= "<a href='/cemos-admin/order-details/"+item.orderId+"/"+item.id+"'>";
                            li += "<i class='fa fa-shopping-cart text-green'></i> "+ item.product.description+" - Step "+item.step+" ";
                        li += "</a>";
                    li+="</li>";

                });
                $('#menu-n').html('');
                $('#menu-n').append(li);
            }
                
        });
    }
});
</script>

</body>>
</html>

