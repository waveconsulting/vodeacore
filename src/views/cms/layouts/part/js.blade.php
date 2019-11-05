<!-- plugins:js -->
@js(/assets/vodea/vodeacore/vendors/js/vendor.bundle.base.js)
@js(/assets/vodea/vodeacore/vendors/js/vendor.bundle.addons.js)
<!-- endinject -->
<!-- Plugin js for this page-->
@js(/assets/vodea/vodeacore/vendors/tinymce/tinymce.min.js)
@js(/assets/vodea/vodeacore/vendors/tinymce/themes/modern/theme.js)

@js(/assets/vodea/vodeacore/vendors/ladda/js/ladda.jquery.min.js)
@js(/assets/vodea/vodeacore/vendors/ladda/js/spin.min.js)
@js(/assets/vodea/vodeacore/vendors/ladda/js/ladda.min.js)

@js(/assets/vodea/vodeacore/vendors/autonumeric/autoNumeric.min.js)

@js(/assets/vodea/vodeacore/vendors/chartjs/Chart.bundle.min.js)
<!-- End plugin js for this page-->

<!-- inject:js -->
@js(/assets/vodea/vodeacore/js/shared/off-canvas.js)
@js(/assets/vodea/vodeacore/js/shared/hoverable-collapse.js)
@js(/assets/vodea/vodeacore/js/shared/misc.js)
@js(/assets/vodea/vodeacore/js/shared/settings.js)
@js(/assets/vodea/vodeacore/js/shared/todolist.js)
<!-- endinject -->
<!-- Custom js for this page-->
@js(/assets/vodea/vodeacore/js/dashboard.js)

@js(/assets/vodea/vodeacore/js/util.js)
@js(/assets/vodea/vodeacore/js/form-engine.autocomplete.js)
@js(/assets/vodea/vodeacore/js/form-engine.js)
@js(/assets/vodea/vodeacore/js/datatable.js)
<!-- End custom js for this page-->


@if(session()->has('notification'))
    <script>
        var notification = {!! session()->get('notification') !!}

        $(window).on('load', function() {
            showNotification(notification.type, notification.title , notification.message, notification.position);
        });
    </script>
@endif
