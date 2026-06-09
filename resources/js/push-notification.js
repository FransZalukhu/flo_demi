/**
 * Web Push Notification Handler
 * Manages Service Worker, Permissions, and Subscriptions
 */
class PushNotification {
    constructor(vapidPublicKey) {
        this.vapidPublicKey = vapidPublicKey;
        this.swRegistration = null;
        this.isSubscribed = false;
    }

    async init() {
        if (!('serviceWorker' in navigator) || !('PushManager' in window)) {
            console.warn('Push messaging is not supported');
            return;
        }

        try {
            this.swRegistration = await navigator.serviceWorker.register('/sw.js');
            await this.checkSubscription();
        } catch (error) {
            console.error('Service Worker Error', error);
        }
    }

    async checkSubscription() {
        const subscription = await this.swRegistration.pushManager.getSubscription();
        this.isSubscribed = !(subscription === null);
    }

    showSoftPrompt(title = 'Aktfikan Notifikasi', message = 'Aktifkan notifikasi kamu tidak kelewatan Kabar dan Info Terbaru') {
        if (!('Notification' in window) || Notification.permission !== 'default') return;
        if (localStorage.getItem('push_prompt_dismissed') === 'true') return;

        const promptUI = document.createElement('div');
        promptUI.id = 'push-soft-prompt';
        
        // Gunakan inline style agar jalan di Admin (SCSS) maupun Mentee (Tailwind)
        Object.assign(promptUI.style, {
            position: 'fixed',
            bottom: '24px',
            right: '24px',
            width: '360px',
            backgroundColor: 'rgba(255, 255, 255, 0.95)',
            backdropFilter: 'blur(20px)',
            borderRadius: '30px',
            padding: '24px',
            zIndex: '10000',
            boxShadow: '0 25px 70px rgba(0,0,0,0.2)',
            border: '1px solid rgba(255, 255, 255, 0.2)',
            transform: 'translateY(50px)',
            opacity: '0',
            transition: 'all 0.7s cubic-bezier(0.4, 0, 0.2, 1)',
            display: 'flex',
            flexDirection: 'column',
            gap: '20px',
            fontFamily: "'Manrope', sans-serif"
        });
        
        promptUI.innerHTML = `
            <button id="soft-prompt-close" style="position:absolute; top:16px; right:20px; border:none; background:none; color:#9ca3af; cursor:pointer; font-size:20px;">
                <i class="ri-close-line"></i>
            </button>

            <div style="display:flex; align-items:center; gap:16px;">
                <div style="flex-shrink:0; width:48px; height:48px; background:rgba(159,102,175,0.1); border-radius:16px; display:flex; align-items:center; justify-content:center; color:#9F66AF;">
                    <i class="ri-notification-3-line" style="font-size:24px;"></i>
                </div>
                <div style="flex:1; min-width:0; padding-right:15px;">
                    <h4 style="margin:0; font-weight:800; color:#1a1a2e; font-size:15px; line-height:1.2;">${title}</h4>
                    <p style="margin:4px 0 0; font-size:12px; color:#6b7280; font-weight:500; line-height:1.4;">${message}</p>
                </div>
            </div>

            <div style="display:flex; align-items:center; gap:12px;">
                <button id="soft-prompt-yes" style="flex:2; height:44px; font-weight:700; font-size:13px; background:#9F66AF; color:white; border:none; border-radius:16px; cursor:pointer; transition:all 0.3s; box-shadow:0 8px 20px rgba(159,102,175,0.3);">
                    Aktifkan
                </button>
                <button id="soft-prompt-no" style="flex:1; height:44px; font-weight:700; font-size:13px; color:#9ca3af; border:none; background:none; cursor:pointer; transition:all 0.3s;">
                    Nanti
                </button>
            </div>
        `;

        document.body.appendChild(promptUI);

        // Dark mode support
        if (document.documentElement.getAttribute('data-theme') === 'dark' || document.documentElement.classList.contains('dark')) {
            promptUI.style.backgroundColor = 'rgba(26, 25, 38, 0.95)';
            promptUI.style.borderColor = 'rgba(255, 255, 255, 0.05)';
            promptUI.querySelector('h4').style.color = '#f0eef5';
            promptUI.querySelector('p').style.color = '#9b97ae';
        }

        requestAnimationFrame(() => {
            promptUI.style.transform = 'translateY(0)';
            promptUI.style.opacity = '1';
        });

        const closePrompt = () => {
            promptUI.style.transform = 'translateY(50px)';
            promptUI.style.opacity = '0';
            setTimeout(() => promptUI.remove(), 700);
        };

        document.getElementById('soft-prompt-close').addEventListener('click', closePrompt);
        document.getElementById('soft-prompt-no').addEventListener('click', () => {
            localStorage.setItem('push_prompt_dismissed', 'true');
            closePrompt();
        });

        document.getElementById('soft-prompt-yes').addEventListener('click', async () => {
            closePrompt();
            try {
                await this.subscribeUser();
                this.toast('Berhasil!', 'Notifikasi Anda kini telah aktif.');
                
                const toggle = document.getElementById('pushToggle');
                if (toggle) toggle.checked = true;
            } catch (e) {
                this.toast('Gagal', 'Tidak dapat mengaktifkan notifikasi.', 'error');
            }
        });
    }

    toast(title, message, type = 'success') {
        const toast = document.createElement('div');
        const color = type === 'success' ? '#10b981' : '#3b82f6';
        const bgColor = type === 'success' ? 'rgba(16, 185, 129, 0.1)' : 'rgba(59, 130, 246, 0.1)';
        const icon = type === 'success' ? 'ri-checkbox-circle-fill' : 'ri-information-fill';

        Object.assign(toast.style, {
            position: 'fixed',
            top: '24px',
            right: '24px',
            zIndex: '10001',
            display: 'flex',
            alignItems: 'center',
            gap: '16px',
            backgroundColor: 'rgba(255, 255, 255, 0.9)',
            backdropFilter: 'blur(20px)',
            padding: '16px',
            paddingRight: '24px',
            borderRadius: '20px',
            boxShadow: '0 20px 50px rgba(0,0,0,0.15)',
            border: '1px solid rgba(255, 255, 255, 0.2)',
            transition: 'all 0.5s ease',
            fontFamily: "'Manrope', sans-serif"
        });

        // Dark mode for toast
        if (document.documentElement.getAttribute('data-theme') === 'dark' || document.documentElement.classList.contains('dark')) {
            toast.style.backgroundColor = 'rgba(26, 25, 38, 0.9)';
            toast.style.borderColor = 'rgba(255, 255, 255, 0.05)';
        }

        toast.innerHTML = `
            <div style="display:flex; height:40px; width:40px; flex-shrink:0; align-items:center; justify-content:center; border-radius:12px; background:${bgColor}; color:${color}; font-size:20px;">
                <i class="${icon}"></i>
            </div>
            <div>
                <p style="margin:0; font-size:13px; font-weight:800; color:${type === 'success' ? '#10b981' : '#3b82f6'};">${title}</p>
                <p style="margin:2px 0 0; font-size:11px; color:#6b7280;">${message}</p>
            </div>
        `;

        document.body.appendChild(toast);
        
        // Animasi masuk
        toast.style.transform = 'translateX(50px)';
        toast.style.opacity = '0';
        requestAnimationFrame(() => {
            toast.style.transform = 'translateX(0)';
            toast.style.opacity = '1';
        });

        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(50px)';
            setTimeout(() => toast.remove(), 500);
        }, 4000);
    }

    async subscribeUser() {
        const applicationServerKey = this.urlB64ToUint8Array(this.vapidPublicKey);
        
        try {
            const subscription = await this.swRegistration.pushManager.subscribe({
                userVisibleOnly: true,
                applicationServerKey: applicationServerKey
            });

            await this.sendSubscriptionToServer(subscription);
            this.isSubscribed = true;
            console.log('User is subscribed.');
        } catch (err) {
            console.error('Failed to subscribe the user: ', err);
        }
    }

    async unsubscribeUser() {
        try {
            const subscription = await this.swRegistration.pushManager.getSubscription();
            if (subscription) {
                await fetch('/push-subscriptions', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ endpoint: subscription.endpoint })
                });
                await subscription.unsubscribe();
                this.isSubscribed = false;
                console.log('User is unsubscribed.');
            }
        } catch (err) {
            console.error('Error unsubscribing', err);
        }
    }

    async sendSubscriptionToServer(subscription) {
        const response = await fetch('/push-subscriptions', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(subscription)
        });

        if (!response.ok) throw new Error('Bad status code from server');
    }

    urlB64ToUint8Array(base64String) {
        const padding = '='.repeat((4 - base64String.length % 4) % 4);
        const base64 = (base64String + padding).replace(/-/g, '+').replace(/_/g, '/');
        const rawData = window.atob(base64);
        const outputArray = new Uint8Array(rawData.length);
        for (let i = 0; i < rawData.length; ++i) {
            outputArray[i] = rawData.charCodeAt(i);
        }
        return outputArray;
    }
}

window.PushNotification = PushNotification;
