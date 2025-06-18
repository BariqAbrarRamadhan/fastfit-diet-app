// Admin Articles Notification System
class AdminNotification {
    constructor() {
        this.container = this.createContainer();
        this.addStyles();
    }

    createContainer() {
        const container = document.createElement('div');
        container.id = 'notification-container';
        container.className = 'fixed top-4 right-4 z-50 space-y-2';
        document.body.appendChild(container);
        return container;
    }

    addStyles() {
        const style = document.createElement('style');
        style.textContent = `
            .notification {
                min-width: 300px;
                max-width: 400px;
                padding: 1rem;
                border-radius: 0.75rem;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
                backdrop-filter: blur(10px);
                transform: translateX(100%);
                transition: all 0.3s ease-in-out;
                display: flex;
                align-items: center;
                gap: 0.75rem;
            }
            
            .notification.show {
                transform: translateX(0);
            }
            
            .notification.success {
                background: rgba(16, 185, 129, 0.95);
                border: 1px solid rgba(16, 185, 129, 0.3);
                color: white;
            }
            
            .notification.error {
                background: rgba(239, 68, 68, 0.95);
                border: 1px solid rgba(239, 68, 68, 0.3);
                color: white;
            }
            
            .notification.warning {
                background: rgba(245, 158, 11, 0.95);
                border: 1px solid rgba(245, 158, 11, 0.3);
                color: white;
            }
            
            .notification.info {
                background: rgba(59, 130, 246, 0.95);
                border: 1px solid rgba(59, 130, 246, 0.3);
                color: white;
            }
            
            .notification-icon {
                flex-shrink: 0;
                width: 20px;
                height: 20px;
            }
            
            .notification-content {
                flex: 1;
            }
            
            .notification-title {
                font-weight: 600;
                margin-bottom: 0.25rem;
            }
            
            .notification-message {
                font-size: 0.875rem;
                opacity: 0.9;
            }
            
            .notification-close {
                flex-shrink: 0;
                width: 20px;
                height: 20px;
                cursor: pointer;
                opacity: 0.7;
                transition: opacity 0.2s;
            }
            
            .notification-close:hover {
                opacity: 1;
            }
        `;
        document.head.appendChild(style);
    }

    show(type, title, message, duration = 5000) {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        
        const icons = {
            success: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>',
            error: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>',
            warning: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>',
            info: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
        };

        notification.innerHTML = `
            <div class="notification-icon">${icons[type]}</div>
            <div class="notification-content">
                <div class="notification-title">${title}</div>
                <div class="notification-message">${message}</div>
            </div>
            <div class="notification-close">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>
        `;

        this.container.appendChild(notification);

        // Show notification
        setTimeout(() => {
            notification.classList.add('show');
        }, 100);

        // Add close functionality
        const closeBtn = notification.querySelector('.notification-close');
        closeBtn.addEventListener('click', () => {
            this.hide(notification);
        });

        // Auto hide
        if (duration > 0) {
            setTimeout(() => {
                this.hide(notification);
            }, duration);
        }

        return notification;
    }

    hide(notification) {
        notification.classList.remove('show');
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }

    success(title, message, duration) {
        return this.show('success', title, message, duration);
    }

    error(title, message, duration) {
        return this.show('error', title, message, duration);
    }

    warning(title, message, duration) {
        return this.show('warning', title, message, duration);
    }

    info(title, message, duration) {
        return this.show('info', title, message, duration);
    }
}

// Initialize notification system
window.adminNotify = new AdminNotification();

// Helper functions for easy use
window.showSuccess = (title, message, duration) => window.adminNotify.success(title, message, duration);
window.showError = (title, message, duration) => window.adminNotify.error(title, message, duration);
window.showWarning = (title, message, duration) => window.adminNotify.warning(title, message, duration);
window.showInfo = (title, message, duration) => window.adminNotify.info(title, message, duration);

// Form submission helpers
window.handleFormSuccess = (message) => {
    showSuccess('Berhasil!', message || 'Operasi berhasil dilakukan.');
};

window.handleFormError = (message) => {
    showError('Terjadi Kesalahan!', message || 'Terjadi kesalahan saat memproses data.');
};

// Laravel success message integration
document.addEventListener('DOMContentLoaded', function() {
    // Check for Laravel success messages
    const successMessage = document.querySelector('[data-success-message]');
    if (successMessage) {
        const message = successMessage.getAttribute('data-success-message');
        showSuccess('Berhasil!', message);
        successMessage.style.display = 'none';
    }

    // Check for Laravel error messages
    const errorMessage = document.querySelector('[data-error-message]');
    if (errorMessage) {
        const message = errorMessage.getAttribute('data-error-message');
        showError('Terjadi Kesalahan!', message);
        errorMessage.style.display = 'none';
    }
});
