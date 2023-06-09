<!-- latest jquery-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Bootstrap js-->
<script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
<!-- feather icon js-->
<script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
<!-- scrollbar js-->
<script src="{{ asset('assets/js/scrollbar/simplebar.js') }}"></script>
<script src="{{ asset('assets/js/scrollbar/custom.js') }}"></script>
<!-- Sidebar jquery-->
<script src="{{ asset('assets/js/config.js') }}"></script>
<!-- Plugins JS start-->
<script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
<script src="{{ asset('assets/js/chart/apex-chart/stock-prices.js') }}"></script>
<script id="menu" src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
<script src="{{ asset('assets/js/slick/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/slick/slick.js') }}"></script>
<script src="{{ asset('assets/js/header-slick.js') }}"></script>
<!-- bootstrap notify js -->
<script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('assets/js/notify/notify-script.js') }}"></script>
@yield('js')

@if (Route::current()->getName() != 'popover')
    <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
@endif

<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="{{ asset('assets/js/script.js') }}"></script>
{{-- <script src="{{ asset('assets/js/theme-customizer/customizer.js') }}"></script> --}}


@yield('script')

<script>
    function notify(title, message, type) {
        $.notify({
            title: title,
            message: message
        }, {
            type: type,
            allow_dismiss: false,
            newest_on_top: false,
            mouse_over: false,
            showProgressbar: false,
            spacing: 10,
            timer: 2000,
            placement: {
                from: 'top',
                align: 'right'
            },
            offset: {
                x: 30,
                y: 30
            },
            delay: 1000,
            z_index: 10000,
            animate: {
                enter: 'animated bounce',
                exit: 'animated bounce'
            }
        });
    }

    function deleteData(url, datatable) {
        swal({
                title: "Anda yakin menghapus data ?",
                text: "Data yang sudah dihapus tidak dapat dikembalikan!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "JSON",
                        success: function(response) {
                            swal(response.message, {
                                icon: "success",
                            });
                            $(datatable).DataTable().ajax.reload();
                        }
                    });
                } else {
                    swal("Data tidak jadi dihapus!");
                }
            });
    }

    function deleteDatas(url, datatable, ids) {
        swal({
                title: "Anda yakin menghapus semua data yang dipilih?",
                text: "Data yang sudah dihapus tidak dapat dikembalikan!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            ids: ids
                        },
                        dataType: "JSON",
                        success: function(response) {
                            swal(response.message, {
                                icon: "success",
                            });
                            $(datatable).DataTable().ajax.reload();
                        }
                    });
                } else {
                    swal("Data tidak jadi dihapus!");
                }
            });
    }
</script>
{{-- @if (Route::current()->getName() == 'index')
	<script src="{{asset('assets/js/layout-change.js')}}"></script>
@endif --}}
