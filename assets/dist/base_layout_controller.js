import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['sidebar', 'backdrop', 'sunIcon', 'moonIcon'];

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
                this.sidebarTarget.classList.add('lg:-translate-x-full', 'lg:w-0', 'lg:overflow-hidden');
            }
        } else {
            // On mobile: remove desktop classes, apply mobile state
            this.sidebarTarget.classList.remove('lg:-translate-x-full', 'lg:w-0', 'lg:overflow-hidden');
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
            // Desktop: remove collapse classes
            this.sidebarTarget.classList.remove('lg:-translate-x-full', 'lg:w-0', 'lg:overflow-hidden');
        } else {
            // Mobile: slide in
            this.sidebarTarget.classList.remove('max-lg:-translate-x-full');
            this.backdropTarget.classList.remove('hidden');
        }
    }

    closeSidebar() {
        this.sidebarOpen = false;
        if (window.innerWidth >= 1024) {
            // Desktop: add collapse classes
            this.sidebarTarget.classList.add('lg:-translate-x-full', 'lg:w-0', 'lg:overflow-hidden');
        } else {
            // Mobile: slide out
            this.sidebarTarget.classList.add('max-lg:-translate-x-full');
            this.backdropTarget.classList.add('hidden');
        }
    }

    toggleDark() {
        document.documentElement.classList.toggle('dark');
        this.dispatch('dark-mode-changed', {
            detail: { dark: document.documentElement.classList.contains('dark') }
        });
    }
}
