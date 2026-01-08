import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['sidebar', 'backdrop', 'sunIcon', 'moonIcon'];

    connect() {
        this.sidebarOpen = false;
        this.handleResize = this.handleResize.bind(this);
        window.addEventListener('resize', this.handleResize);
    }

    disconnect() {
        window.removeEventListener('resize', this.handleResize);
    }

    handleResize() {
        // Close sidebar on large screens when resizing
        if (window.innerWidth >= 1024 && this.sidebarOpen) {
            this.closeSidebar();
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
        this.sidebarTarget.classList.remove('max-lg:-translate-x-full');
        this.backdropTarget.classList.remove('hidden');
    }

    closeSidebar() {
        this.sidebarOpen = false;
        this.sidebarTarget.classList.add('max-lg:-translate-x-full');
        this.backdropTarget.classList.add('hidden');
    }

    toggleDark() {
        document.documentElement.classList.toggle('dark');
        this.dispatch('dark-mode-changed', {
            detail: { dark: document.documentElement.classList.contains('dark') }
        });
    }
}
