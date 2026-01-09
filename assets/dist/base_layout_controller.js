import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['sidebar', 'backdrop', 'sunIcon', 'moonIcon', 'appName', 'menuContainer'];

    connect() {
        this.sidebarOpen = window.innerWidth >= 1024; // Open by default on desktop
        this.handleResize = this.handleResize.bind(this);
        window.addEventListener('resize', this.handleResize);
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
        // Collapse sidebar to w-16 (icon width)
        this.sidebarTarget.classList.remove('lg:w-60');
        this.sidebarTarget.classList.add('lg:w-16');

        // Hide app name
        if (this.hasAppNameTarget) {
            this.appNameTarget.classList.add('lg:hidden');
        }

        // Center menu items
        if (this.hasMenuContainerTarget) {
            this.menuContainerTarget.classList.remove('items-start');
            this.menuContainerTarget.classList.add('items-center');
        }
    }

    removeCollapsedState() {
        // Expand sidebar to w-60
        this.sidebarTarget.classList.remove('lg:w-16');
        this.sidebarTarget.classList.add('lg:w-60');

        // Show app name
        if (this.hasAppNameTarget) {
            this.appNameTarget.classList.remove('lg:hidden');
        }

        // Align menu items to start
        if (this.hasMenuContainerTarget) {
            this.menuContainerTarget.classList.remove('items-center');
            this.menuContainerTarget.classList.add('items-start');
        }
    }

    toggleDark() {
        document.documentElement.classList.toggle('dark');
        this.dispatch('dark-mode-changed', {
            detail: { dark: document.documentElement.classList.contains('dark') }
        });
    }
}
