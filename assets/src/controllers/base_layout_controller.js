import { Controller } from '@hotwired/stimulus';

const STORAGE_KEY = 'ui-sidebar-collapsed';

export default class extends Controller {
    static targets = ['sidebar', 'backdrop', 'sunIcon', 'moonIcon'];

    connect() {
        // Restore collapsed state from localStorage, default to expanded on desktop
        const savedState = localStorage.getItem(STORAGE_KEY);
        if (savedState !== null) {
            this.sidebarOpen = savedState !== 'true';
        } else {
            this.sidebarOpen = window.innerWidth >= 1024;
        }

        this.handleResize = this.handleResize.bind(this);
        window.addEventListener('resize', this.handleResize);

        // Apply initial state on desktop
        if (window.innerWidth >= 1024 && !this.sidebarOpen) {
            this.applyCollapsedState();
        }
    }

    disconnect() {
        window.removeEventListener('resize', this.handleResize);
    }

    handleResize() {
        // Reset sidebar state when crossing the lg breakpoint
        if (window.innerWidth >= 1024) {
            // On desktop: remove mobile classes, apply desktop state
            this.sidebarTarget.classList.remove('max-lg:-translate-x-full');
            this.backdropTarget.classList.add('hidden');
            if (!this.sidebarOpen) {
                this.applyCollapsedState();
            }
        } else {
            // On mobile: remove desktop collapsed state, apply mobile state
            this.removeCollapsedState();
            if (!this.sidebarOpen) {
                this.sidebarTarget.classList.add('max-lg:-translate-x-full');
                this.backdropTarget.classList.add('hidden');
            }
        }
    }

    toggleSidebar() {
        if (this.sidebarOpen) {
            this.closeSidebar();
        } else {
            this.openSidebar();
        }
    }

    openSidebar() {
        this.sidebarOpen = true;
        this.saveState(false);
        if (window.innerWidth >= 1024) {
            // Desktop: expand sidebar
            this.removeCollapsedState();
        } else {
            // Mobile: slide in
            this.sidebarTarget.classList.remove('max-lg:-translate-x-full');
            this.backdropTarget.classList.remove('hidden');
        }
    }

    closeSidebar() {
        this.sidebarOpen = false;
        this.saveState(true);
        if (window.innerWidth >= 1024) {
            // Desktop: collapse sidebar to icon width
            this.applyCollapsedState();
        } else {
            // Mobile: slide out
            this.sidebarTarget.classList.add('max-lg:-translate-x-full');
            this.backdropTarget.classList.add('hidden');
        }
    }

    applyCollapsedState() {
        // Set data-collapsed attribute - CSS handles the rest via Tailwind data variants
        this.sidebarTarget.dataset.collapsed = 'true';
    }

    removeCollapsedState() {
        // Remove data-collapsed attribute
        delete this.sidebarTarget.dataset.collapsed;
    }

    saveState(collapsed) {
        // Only persist on desktop
        if (window.innerWidth >= 1024) {
            localStorage.setItem(STORAGE_KEY, collapsed ? 'true' : 'false');
        }
    }

    toggleDark() {
        document.documentElement.classList.toggle('dark');
        this.dispatch('dark-mode-changed', {
            detail: { dark: document.documentElement.classList.contains('dark') }
        });
    }
}
