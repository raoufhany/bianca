<!-- BEGIN: Vendor JS-->
<script src="{{asset('/admin_asset/app-assets/vendors/js/vendors.min.js')}}"></script>
{{--<!-- <script src="{{asset('/admin_asset/assets/js/scripts.js')}}"></script>--}}
<script src="{{asset('/admin_asset/assets/js/bidsbooking_custom.js')}}"></script> -->
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
@yield('script')
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('/admin_asset/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{asset('/admin_asset/app-assets/js/core/app.js')}}"></script>
<script src="{{asset('/admin_asset/app-assets/js/scripts/components.js')}}"></script>

<!-- END: Theme JS-->

{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>--}}
{{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>--}}

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@yield('script_chat')

{{--<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>--}}

<script>

	$.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });



    $(function () {
        var inputs = document.getElementsByTagName("INPUT");
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].oninvalid = function (e) {
                e.target.setCustomValidity("");
                if (!e.target.validity.valid) {
                    e.target.setCustomValidity(e.target.getAttribute("data-error"));
                }
            };
        }
    });
</script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>

<!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
<script>
    var firebaseConfig = {
        apiKey: "AIzaSyDbKRIhMVRbZn7gkuqQKeWXjbz-PrHZFp4",
        authDomain: "bcpos-b50ff.firebaseapp.com",
        projectId: "bcpos-b50ff",
        storageBucket: "bcpos-b50ff.appspot.com",
        messagingSenderId: "174253106578",
        appId: "1:174253106578:web:8ad5a032d6fae9ef514d4b",
        measurementId: "G-LN3MB7DJP3"
    };

    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();

    function initNotification() {
        messaging
            .requestPermission().then(function() {

                return messaging.getToken()
            }).then(function(response) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route('save-push-notification-token') }}',
                    type: 'POST',
                    data: {
                        token: response
                    },
                    dataType: 'JSON',
                    success: function(response) {

                        console.log('Device token saved.');
                    },
                    error: function(error) {
                        console.log(error);
                    },
                });
            }).catch(function(error) {
                console.log(error);
            });
    }

    messaging.onMessage(function(payload) {
        const title = payload.notification.title;
        const options = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        console.log(title);
    //    var noticount = $("#noticount").html();
    //    $("#noticount").html(parseInt(noticount)+1);
    //     new Noty({
    //         type: 'alert',
    //         layout: 'topRight',
    //         text: payload.notification.body,
    //         timeout: 8000,
    //     }).show();
        new Notification(title, options);
    });

    initNotification();
</script>
