// assets/controllers/range_slider_controller.js
import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = ["track", "range", "minHandle", "maxHandle", "minInput", "maxInput", "minLabel", "maxLabel"]
    static values = {
        min: { type: Number, default: 0 },
        max: { type: Number, default: 100 },
        step: { type: Number, default: 1 },
        disabled: { type: Boolean, default: false }
    }

    connect() {
        this.dragging = null
        this.updatePositions()
    }

    get currentMin() {
        return parseFloat(this.minInputTarget.value)
    }

    set currentMin(value) {
        this.minInputTarget.value = value
        if (this.hasMinLabelTarget) {
            this.minLabelTarget.textContent = value
        }
    }

    get currentMax() {
        return parseFloat(this.maxInputTarget.value)
    }

    set currentMax(value) {
        this.maxInputTarget.value = value
        if (this.hasMaxLabelTarget) {
            this.maxLabelTarget.textContent = value
        }
    }

    updatePositions() {
        const minPercent = ((this.currentMin - this.minValue) / (this.maxValue - this.minValue)) * 100
        const maxPercent = ((this.currentMax - this.minValue) / (this.maxValue - this.minValue)) * 100

        this.minHandleTarget.style.left = `${minPercent}%`
        this.maxHandleTarget.style.left = `${maxPercent}%`
        this.rangeTarget.style.left = `${minPercent}%`
        this.rangeTarget.style.width = `${maxPercent - minPercent}%`
    }

    getValueFromPosition(clientX) {
        const rect = this.trackTarget.getBoundingClientRect()
        const percent = Math.max(0, Math.min(1, (clientX - rect.left) / rect.width))
        const rawValue = this.minValue + percent * (this.maxValue - this.minValue)
        const steppedValue = Math.round(rawValue / this.stepValue) * this.stepValue
        return Math.max(this.minValue, Math.min(this.maxValue, steppedValue))
    }

    handleMinMouseDown(event) {
        if (this.disabledValue) return
        event.preventDefault()
        this.dragging = 'min'
        this.minHandleTarget.classList.add('ring-4', 'ring-primary-200', 'dark:ring-primary-800')

        const handleMouseMove = (e) => this.updateMin(this.getValueFromPosition(e.clientX))
        const handleMouseUp = () => {
            this.dragging = null
            this.minHandleTarget.classList.remove('ring-4', 'ring-primary-200', 'dark:ring-primary-800')
            document.removeEventListener('mousemove', handleMouseMove)
            document.removeEventListener('mouseup', handleMouseUp)
            this.dispatch('change', { detail: { min: this.currentMin, max: this.currentMax } })
        }

        document.addEventListener('mousemove', handleMouseMove)
        document.addEventListener('mouseup', handleMouseUp)
    }

    handleMaxMouseDown(event) {
        if (this.disabledValue) return
        event.preventDefault()
        this.dragging = 'max'
        this.maxHandleTarget.classList.add('ring-4', 'ring-primary-200', 'dark:ring-primary-800')

        const handleMouseMove = (e) => this.updateMax(this.getValueFromPosition(e.clientX))
        const handleMouseUp = () => {
            this.dragging = null
            this.maxHandleTarget.classList.remove('ring-4', 'ring-primary-200', 'dark:ring-primary-800')
            document.removeEventListener('mousemove', handleMouseMove)
            document.removeEventListener('mouseup', handleMouseUp)
            this.dispatch('change', { detail: { min: this.currentMin, max: this.currentMax } })
        }

        document.addEventListener('mousemove', handleMouseMove)
        document.addEventListener('mouseup', handleMouseUp)
    }

    handleMinTouchStart(event) {
        if (this.disabledValue) return
        event.preventDefault()
        this.dragging = 'min'

        const handleTouchMove = (e) => this.updateMin(this.getValueFromPosition(e.touches[0].clientX))
        const handleTouchEnd = () => {
            this.dragging = null
            document.removeEventListener('touchmove', handleTouchMove)
            document.removeEventListener('touchend', handleTouchEnd)
            this.dispatch('change', { detail: { min: this.currentMin, max: this.currentMax } })
        }

        document.addEventListener('touchmove', handleTouchMove)
        document.addEventListener('touchend', handleTouchEnd)
    }

    handleMaxTouchStart(event) {
        if (this.disabledValue) return
        event.preventDefault()
        this.dragging = 'max'

        const handleTouchMove = (e) => this.updateMax(this.getValueFromPosition(e.touches[0].clientX))
        const handleTouchEnd = () => {
            this.dragging = null
            document.removeEventListener('touchmove', handleTouchMove)
            document.removeEventListener('touchend', handleTouchEnd)
            this.dispatch('change', { detail: { min: this.currentMin, max: this.currentMax } })
        }

        document.addEventListener('touchmove', handleTouchMove)
        document.addEventListener('touchend', handleTouchEnd)
    }

    updateMin(value) {
        const clampedValue = Math.min(value, this.currentMax)
        this.currentMin = clampedValue
        this.updatePositions()
    }

    updateMax(value) {
        const clampedValue = Math.max(value, this.currentMin)
        this.currentMax = clampedValue
        this.updatePositions()
    }

    handleTrackClick(event) {
        if (this.disabledValue) return

        const value = this.getValueFromPosition(event.clientX)
        const distToMin = Math.abs(value - this.currentMin)
        const distToMax = Math.abs(value - this.currentMax)

        if (distToMin <= distToMax) {
            this.updateMin(value)
        } else {
            this.updateMax(value)
        }

        this.dispatch('change', { detail: { min: this.currentMin, max: this.currentMax } })
    }
}
