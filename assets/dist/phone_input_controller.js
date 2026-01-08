// assets/controllers/phone_input_controller.js
import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = ["input", "fullInput", "countryInput", "countryButton", "flag", "dialCode", "chevron", "dropdown", "search", "countryList"]
    static values = {
        countries: { type: Array, default: [] },
        defaultCountry: { type: String, default: 'FR' },
        showDialCode: { type: Boolean, default: false }
    }

    connect() {
        this.isOpen = false
        this.selectedCountry = this.findCountry(this.defaultCountryValue) || this.countriesValue[0]
        this.rawDialCodeInput = ''

        // Close on outside click
        document.addEventListener('click', this.handleOutsideClick.bind(this))
    }

    disconnect() {
        document.removeEventListener('click', this.handleOutsideClick.bind(this))
    }

    findCountry(code) {
        return this.countriesValue.find(c => c.code === code)
    }

    toggleDropdown(event) {
        event.stopPropagation()
        if (this.isOpen) {
            this.closeDropdown()
        } else {
            this.openDropdown()
        }
    }

    openDropdown() {
        this.isOpen = true
        this.dropdownTarget.classList.remove('hidden')
        this.chevronTarget.classList.add('rotate-180')
        this.searchTarget.focus()
    }

    closeDropdown() {
        this.isOpen = false
        this.dropdownTarget.classList.add('hidden')
        this.chevronTarget.classList.remove('rotate-180')
        this.searchTarget.value = ''
        this.filterCountries()
    }

    handleOutsideClick(event) {
        if (!this.element.contains(event.target)) {
            this.closeDropdown()
        }
    }

    filterCountries() {
        const query = this.searchTarget.value.toLowerCase()
        const items = this.countryListTarget.querySelectorAll('li')

        items.forEach(item => {
            const name = item.dataset.name.toLowerCase()
            const code = item.dataset.code.toLowerCase()
            const dialCode = item.dataset.dialCode

            const matches = name.includes(query) || code.includes(query) || dialCode.includes(query)
            item.style.display = matches ? '' : 'none'
        })
    }

    selectCountry(event) {
        const item = event.currentTarget
        const country = {
            code: item.dataset.code,
            name: item.dataset.name,
            dialCode: item.dataset.dialCode,
            flag: item.dataset.flag,
            format: item.dataset.format
        }

        this.selectedCountry = country
        this.countryInputTarget.value = country.code
        this.flagTarget.textContent = country.flag
        this.dialCodeTarget.textContent = country.dialCode

        // Update selected styling
        this.countryListTarget.querySelectorAll('li').forEach(li => {
            li.classList.remove('bg-primary-50', 'dark:bg-primary-900/20')
        })
        item.classList.add('bg-primary-50', 'dark:bg-primary-900/20')

        this.closeDropdown()
        this.updateFullInput()
        this.inputTarget.focus()
    }

    handleInput(event) {
        const inputValue = this.inputTarget.value

        // Check if user is typing a dial code
        if (inputValue.startsWith('+') || inputValue.startsWith('00')) {
            const result = this.parsePhoneWithDialCode(inputValue)

            if (result.country) {
                this.selectedCountry = result.country
                this.countryInputTarget.value = result.country.code
                this.flagTarget.textContent = result.country.flag
                this.dialCodeTarget.textContent = result.country.dialCode
                this.rawDialCodeInput = ''

                const maxDigits = this.getMaxDigitsFromPattern(result.country.format)
                this.inputTarget.value = this.formatPhoneWithPattern(
                    this.limitDigits(result.digits, maxDigits),
                    result.country.format
                )
            } else {
                this.rawDialCodeInput = inputValue
            }
        } else {
            this.rawDialCodeInput = ''
            const digits = this.getPhoneDigits(inputValue)
            const maxDigits = this.getMaxDigitsFromPattern(this.selectedCountry.format)
            const limited = this.limitDigits(digits, maxDigits)
            this.inputTarget.value = this.formatPhoneWithPattern(limited, this.selectedCountry.format)
        }

        this.updateFullInput()
    }

    handlePaste(event) {
        const pastedData = event.clipboardData?.getData('text')
        if (!pastedData) return

        const result = this.parsePhoneWithDialCode(pastedData)

        if (result.country) {
            event.preventDefault()
            this.selectedCountry = result.country
            this.countryInputTarget.value = result.country.code
            this.flagTarget.textContent = result.country.flag
            this.dialCodeTarget.textContent = result.country.dialCode

            const maxDigits = this.getMaxDigitsFromPattern(result.country.format)
            this.inputTarget.value = this.formatPhoneWithPattern(
                this.limitDigits(result.digits, maxDigits),
                result.country.format
            )
            this.updateFullInput()
        }
    }

    parsePhoneWithDialCode(value) {
        const cleaned = value.replace(/\s/g, '')
        const withPlus = cleaned.startsWith('00') ? '+' + cleaned.slice(2) : cleaned

        if (withPlus.startsWith('+')) {
            for (const country of this.countriesValue) {
                if (withPlus.startsWith(country.dialCode)) {
                    const digits = withPlus.slice(country.dialCode.length).replace(/\D/g, '')
                    return { digits, country }
                }
            }
        }

        return { digits: this.getPhoneDigits(value) }
    }

    updateFullInput() {
        const digits = this.getPhoneDigits(this.inputTarget.value)
        if (digits) {
            this.fullInputTarget.value = this.selectedCountry.dialCode + digits
        } else {
            this.fullInputTarget.value = ''
        }
        this.dispatch('change', { detail: { value: this.fullInputTarget.value, country: this.selectedCountry } })
    }

    // Helper methods
    getPhoneDigits(value) {
        return value.replace(/\D/g, '')
    }

    formatPhoneWithPattern(value, pattern) {
        if (!pattern) return value
        const digits = this.getPhoneDigits(value)
        let result = ''
        let digitIndex = 0

        for (const char of pattern) {
            if (digitIndex >= digits.length) break
            if (char === '#') {
                result += digits[digitIndex]
                digitIndex++
            } else {
                result += char
            }
        }

        return result
    }

    getMaxDigitsFromPattern(pattern) {
        if (!pattern) return undefined
        return (pattern.match(/#/g) || []).length
    }

    limitDigits(digits, max) {
        if (max === undefined) return digits
        return digits.slice(0, max)
    }
}
