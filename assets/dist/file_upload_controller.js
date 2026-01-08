import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['dropzone', 'input', 'icon', 'fileList', 'template'];
    static values = {
        maxSize: { type: Number, default: 0 },
        maxFiles: { type: Number, default: 0 },
        accept: { type: String, default: '' }
    };

    connect() {
        this.files = [];
    }

    click(event) {
        if (!this.inputTarget.disabled) {
            this.inputTarget.click();
        }
    }

    dragover(event) {
        event.preventDefault();
        if (!this.inputTarget.disabled) {
            this.dropzoneTarget.classList.add('border-primary-500', 'bg-primary-50', 'dark:bg-primary-900/20');
            this.dropzoneTarget.classList.remove('border-gray-300', 'dark:border-gray-600');
            this.iconTarget.classList.add('text-primary-500');
            this.iconTarget.classList.remove('text-gray-400');
        }
    }

    dragleave(event) {
        this.resetDropzoneStyle();
    }

    drop(event) {
        event.preventDefault();
        this.resetDropzoneStyle();

        if (this.inputTarget.disabled || !event.dataTransfer?.files) return;
        this.addFiles(event.dataTransfer.files);
    }

    change(event) {
        if (event.target.files) {
            this.addFiles(event.target.files);
            event.target.value = '';
        }
    }

    resetDropzoneStyle() {
        this.dropzoneTarget.classList.remove('border-primary-500', 'bg-primary-50', 'dark:bg-primary-900/20');
        this.dropzoneTarget.classList.add('border-gray-300', 'dark:border-gray-600');
        this.iconTarget.classList.remove('text-primary-500');
        this.iconTarget.classList.add('text-gray-400');
    }

    addFiles(fileList) {
        const files = Array.from(fileList);

        for (const file of files) {
            // Check max files
            if (this.maxFilesValue && this.files.length >= this.maxFilesValue) {
                this.dispatchError(`Maximum ${this.maxFilesValue} files allowed`);
                break;
            }

            // Validate file
            const error = this.validateFile(file);
            if (error) {
                this.dispatchError(`${file.name}: ${error}`);
                continue;
            }

            this.files.push(file);
            this.renderFile(file);
        }

        this.updateFileListVisibility();
        this.dispatch('files-selected', { detail: { files: this.files } });
    }

    validateFile(file) {
        // Check size
        if (this.maxSizeValue && file.size > this.maxSizeValue) {
            return `File too large. Max size: ${this.formatSize(this.maxSizeValue)}`;
        }

        // Check type
        if (this.acceptValue) {
            const acceptedTypes = this.acceptValue.split(',').map(t => t.trim());
            const fileType = file.type;
            const fileExt = '.' + file.name.split('.').pop()?.toLowerCase();

            const isAccepted = acceptedTypes.some(type => {
                if (type.startsWith('.')) {
                    return fileExt === type.toLowerCase();
                }
                if (type.endsWith('/*')) {
                    return fileType.startsWith(type.replace('/*', '/'));
                }
                return fileType === type;
            });

            if (!isAccepted) {
                return 'File type not accepted';
            }
        }

        return null;
    }

    renderFile(file) {
        const template = this.templateTarget.content.cloneNode(true);
        const li = template.querySelector('li');

        li.dataset.fileName = file.name;
        li.querySelector('[data-file-name]').textContent = file.name;
        li.querySelector('[data-file-size]').textContent = this.formatSize(file.size);

        // Update icon based on file type
        const iconSvg = li.querySelector('[data-file-icon]');
        iconSvg.innerHTML = this.getFileIconPath(file);

        this.fileListTarget.appendChild(li);
    }

    removeFile(event) {
        event.stopPropagation();
        const li = event.target.closest('li');
        const fileName = li.dataset.fileName;

        this.files = this.files.filter(f => f.name !== fileName);
        li.remove();

        this.updateFileListVisibility();
        this.dispatch('file-removed', { detail: { fileName } });
    }

    updateFileListVisibility() {
        if (this.files.length > 0) {
            this.fileListTarget.classList.remove('hidden');
        } else {
            this.fileListTarget.classList.add('hidden');
        }
    }

    formatSize(bytes) {
        if (bytes === 0) return '0 B';
        const k = 1024;
        const sizes = ['B', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
    }

    getFileIconPath(file) {
        if (file.type.startsWith('image/')) {
            return '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />';
        }
        if (file.type.startsWith('video/')) {
            return '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" />';
        }
        if (file.type.startsWith('audio/')) {
            return '<path stroke-linecap="round" stroke-linejoin="round" d="M9 9l10.5-3m0 6.553v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 11-.99-3.467l2.31-.66a2.25 2.25 0 001.632-2.163zm0 0V2.25L9 5.25v10.303m0 0v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 01-.99-3.467l2.31-.66A2.25 2.25 0 009 15.553z" />';
        }
        if (file.type.includes('pdf')) {
            return '<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />';
        }
        if (file.type.includes('zip') || file.type.includes('rar') || file.type.includes('compressed')) {
            return '<path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />';
        }
        // Default document icon
        return '<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />';
    }

    dispatchError(message) {
        this.dispatch('error', { detail: { message } });
        console.error('[FileUpload]', message);
    }
}
