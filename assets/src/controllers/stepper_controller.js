import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = ["item", "progress"]

    connect() {
        this.updateProgress()
    }

    updateProgress() {
        if (!this.hasProgressTarget || !this.hasItemTarget) return

        const items = this.itemTargets
        const totalItems = items.length

        if (totalItems <= 1) {
            this.progressTarget.style.width = '0%'
            return
        }

        // Find the current step index (last completed or active item)
        let currentIndex = 0
        items.forEach((item, index) => {
            const status = item.dataset.stepStatus
            if (status === 'complete' || status === 'active') {
                currentIndex = index
            }
        })

        // Calculate progress percentage
        const progressWidth = (currentIndex / (totalItems - 1)) * 100
        this.progressTarget.style.width = `${progressWidth}%`
    }

    // Allow external updates
    refresh() {
        this.updateProgress()
    }
}
