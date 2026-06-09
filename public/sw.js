self.addEventListener('push', (event) => {
    let payload = {};

    if (event.data) {
        try {
            payload = event.data.json();
        } catch (e) {
            payload = {
                title: 'Notifikasi Baru',
                body: event.data.text()
            };
        }
    }

    const title = payload.title || 'Flo Demi Notification';
    const options = {
        body: payload.body || 'Ada info baru untuk Anda.',
        icon: payload.icon || '/assets/logo.png',
        badge: payload.badge || '/assets/logo.png',
        tag: payload.tag || 'flo-demi-alert',
        renotify: true,
        data: {
            url: payload.data?.url || '/'
        }
    };

    event.waitUntil(
        self.registration.showNotification(title, options)
    );
});

self.addEventListener('notificationclick', (event) => {
    event.notification.close();

    const targetUrl = event.notification.data?.url || '/';
    const fullUrl = new URL(targetUrl, self.location.origin).href;

    event.waitUntil(
        clients.matchAll({ type: 'window', includeUncontrolled: true }).then((windowList) => {
            const activeWindow = windowList.find(client => client.url === fullUrl);

            if (activeWindow) {
                return activeWindow.focus();
            }

            if (windowList.length > 0) {
                const anyWindow = windowList[0];
                anyWindow.navigate(fullUrl);
                return anyWindow.focus();
            }

            return clients.openWindow(fullUrl);
        })
    );
});
