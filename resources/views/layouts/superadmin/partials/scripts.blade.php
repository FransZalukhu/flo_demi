<!-- Core JavaScript -->
@vite(['resources/js/superadmin/app.js'])

@auth
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const vapidKey = "{{ config('webpush.vapid.public_key') }}";
            if (vapidKey && window.PushNotification) {
                const push = new PushNotification(vapidKey);
                push.init().then(() => {
                    push.showSoftPrompt(
                        'Aktifkan Notifikasi Admin',
                        'Dapatkan update langsung terkait pendaftaran dan pembayaran baru.'
                    );
                });
            }
        });
    </script>
@endauth