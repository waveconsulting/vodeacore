<!-- plugins:js -->
<script src="{!! url('/') !!}/assets/vodeacore/vendors/js/vendor.bundle.base.js"></script>
<script src="{!! url('/') !!}/assets/vodeacore/vendors/js/vendor.bundle.addons.js"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<script src="{!! url('/') !!}/assets/vodeacore/vendors/tinymce/tinymce.min.js"></script>
<script src="{!! url('/') !!}/assets/vodeacore/vendors/tinymce/themes/modern/theme.js"></script>

<script src="{!! url('/') !!}/assets/vodeacore/vendors/ladda/js/ladda.jquery.min.js"></script>
<script src="{!! url('/') !!}/assets/vodeacore/vendors/ladda/js/spin.min.js"></script>
<script src="{!! url('/') !!}/assets/vodeacore/vendors/ladda/js/ladda.min.js"></script>
<!-- End plugin js for this page-->

<!-- inject:js -->
<script src="{!! url('/') !!}/assets/vodeacore/js/shared/off-canvas.js"></script>
<script src="{!! url('/') !!}/assets/vodeacore/js/shared/hoverable-collapse.js"></script>
<script src="{!! url('/') !!}/assets/vodeacore/js/shared/misc.js"></script>
<script src="{!! url('/') !!}/assets/vodeacore/js/shared/settings.js"></script>
<script src="{!! url('/') !!}/assets/vodeacore/js/shared/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{!! url('/') !!}/assets/vodeacore/js/dashboard.js"></script>

<script src="{!! url('/') !!}/assets/vodeacore/js/form-engine.js"></script>
<!-- End custom js for this page-->


@if(session()->has('notification'))
    <script>
        var notification = {!! session()->get('notification') !!}

        $(window).on('load', function() {
            showNotification(notification.type, notification.title , notification.message, notification.position);
        });
    </script>
@endif