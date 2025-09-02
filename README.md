# Symfony UI Bundle

🎨 A modern Symfony UI bundle with **60+ reusable Twig components** styled with TailwindCSS. Build beautiful, consistent interfaces faster with pre-built form controls, navigation, tables, and more.

## ✨ Features

- 🧩 **60+ Components** - Forms, tables, navigation, tabs, modals, cards, and more
- 🎨 **TailwindCSS Styled** - Modern, responsive design out of the box
- 🔧 **Fully Customizable** - Override styles and extend components easily  
- ⚡ **Smart Class Merging** - Intelligent TailwindCSS class deduplication
- 🌙 **Dark Mode Ready** - Built-in dark theme support
- 📱 **Mobile First** - Responsive components for all devices
- 🔒 **Type Safe** - Full IDE support and autocompletion

## 🚀 Quick Start

### 1. Install the Bundle

```bash
composer require cisse/ui-bundle
```

### 2. Register the Bundle (if not using Flex)

Add to your `config/bundles.php`:

```php
<?php
return [
    // ...
    Cisse\Bundle\UiBundle\UiBundleBundle::class => ['all' => true],
];
```

### 3. Install Dependencies

```bash
# Required for TailwindCSS integration
composer require symfonycasts/tailwind-bundle

# Recommended for advanced class merging
composer require gehrisandro/tailwind-merge-php
```

### 4. Configure Your CSS (Required)

Create your main CSS file with the required setup:

```css
@import "tailwindcss";
@source "../../vendor/cisse/ui-bundle";  /* ⚠️ MANDATORY */

/* Your custom theme variables... */
```

## 📋 Requirements

- **PHP** 8.1+
- **Symfony** 6.1+ or 7.0+
- **Twig** 3.0+
- **TailwindCSS** (via symfonycasts/tailwind-bundle)

## 🧩 Component Library

### 📝 Form Components
| Component | Description |
|-----------|-------------|
| `<twig:Ui:input>` | Smart input with automatic type detection |
| `<twig:Ui:input:text>` `<twig:Ui:input:textarea>` | Text inputs and textareas |
| `<twig:Ui:input:checkbox>` `<twig:Ui:input:date>` | Checkboxes and date pickers |
| `<twig:Ui:label>` | Form labels with proper styling |
| `<twig:Ui:select>` | Styled select dropdowns |
| `<twig:Ui:form>` | Form container with validation |
| `<twig:Ui:input-group>` `<twig:Ui:input-wrapper>` | Input grouping and wrapping |

### 🎨 UI Components  
| Component | Description |
|-----------|-------------|
| `<twig:Ui:button>` | Buttons with multiple variants (primary, secondary, error) |
| `<twig:Ui:badge>` | Status badges with colors, sizes, and variants |
| `<twig:Ui:alert>` | Alert notifications with icons and dismiss functionality |
| `<twig:Ui:card>` | Card layouts with header, content, and footer sections |
| `<twig:Ui:modal>` | Modal dialogs with backdrop |
| `<twig:Ui:slide-over>` | Slide-out panels for details |
| `<twig:Ui:divider>` | Visual content separators |
| `<twig:Ui:tooltip>` | Contextual tooltips |

### 🧭 Navigation
| Component | Description |
|-----------|-------------|
| `<twig:Ui:menu>` `<twig:Ui:menu:item>` | Navigation menus with sub-menus |
| `<twig:Ui:tabs>` `<twig:Ui:tabs:item>` | Tabbed navigation with keyboard support |
| `<twig:Ui:pagination>` | Pagination controls |

### 📊 Tables & Data
| Component | Description |
|-----------|-------------|
| `<twig:Ui:table>` `<twig:Ui:data-table>` | Responsive tables with sorting |
| `<twig:Ui:thead>` `<twig:Ui:tbody>` `<twig:Ui:tfoot>` | Table sections |
| `<twig:Ui:tr>` `<twig:Ui:th>` `<twig:Ui:td>` | Table rows and cells |
| `<twig:Ui:datalist>` | Definition lists for key-value pairs |
| `<twig:Ui:search>` | Search interfaces with filters |
| `<twig:Ui:boolean>` | Boolean value display with icons |

### 📈 Advanced Components
| Component | Description |
|-----------|-------------|
| `<twig:Ui:accordion>` | Collapsible content sections |

## 💡 Usage Examples

### 🔘 Buttons
```twig
{# Button variants - now using data attributes #}
<twig:Ui:button color="primary">Save Changes</twig:Ui:button>
<twig:Ui:button color="secondary">Cancel</twig:Ui:button>  
<twig:Ui:button color="error">Delete Account</twig:Ui:button>

{# Link buttons #}
<twig:Ui:button href="/dashboard" color="primary">Go to Dashboard</twig:Ui:button>

{# Custom styling #}
<twig:Ui:button color="primary" class="w-full mt-4">Full Width Submit</twig:Ui:button>

{# Backward compatibility - boolean props still work #}
<twig:Ui:button primary>Legacy Usage</twig:Ui:button>
```

### 🏷️ Badges
```twig
{# Basic badges with different colors #}
<twig:Ui:badge>Default</twig:Ui:badge>
<twig:Ui:badge color="primary">Primary</twig:Ui:badge>
<twig:Ui:badge color="success">Success</twig:Ui:badge>
<twig:Ui:badge color="error">Error</twig:Ui:badge>
<twig:Ui:badge color="warning">Warning</twig:Ui:badge>
<twig:Ui:badge color="info">Info</twig:Ui:badge>

{# Different sizes #}
<twig:Ui:badge size="sm">Small</twig:Ui:badge>
<twig:Ui:badge>Default</twig:Ui:badge>
<twig:Ui:badge size="lg">Large</twig:Ui:badge>

{# Different variants #}
<twig:Ui:badge variant="solid" color="primary">Solid</twig:Ui:badge>
<twig:Ui:badge variant="outline" color="primary">Outline</twig:Ui:badge>
<twig:Ui:badge variant="soft" color="primary">Soft</twig:Ui:badge>

{# Badge with dot indicator #}
<twig:Ui:badge dot color="success">Online</twig:Ui:badge>
<twig:Ui:badge dot color="error">Offline</twig:Ui:badge>

{# Clickable badges (links) #}
<twig:Ui:badge href="/admin/users" color="info">5 Users</twig:Ui:badge>
<twig:Ui:badge href="/notifications" color="error">3 Alerts</twig:Ui:badge>

{# Status badges for lists #}
<div class="space-y-2">
    <div class="flex items-center justify-between">
        <span>Database Connection</span>
        <twig:Ui:badge color="success" dot>Connected</twig:Ui:badge>
    </div>
    <div class="flex items-center justify-between">
        <span>Background Jobs</span>
        <twig:Ui:badge color="warning" dot>2 Pending</twig:Ui:badge>
    </div>
    <div class="flex items-center justify-between">
        <span>Error Logs</span>
        <twig:Ui:badge color="error" variant="outline">5 Errors</twig:Ui:badge>
    </div>
</div>

{# Boolean prop shortcuts (backward compatibility) #}
<twig:Ui:badge primary>Primary</twig:Ui:badge>
<twig:Ui:badge success small>Success Small</twig:Ui:badge>
<twig:Ui:badge error outline>Error Outline</twig:Ui:badge>
```

### 🚨 Alerts
```twig
{# Basic alerts with different types #}
<twig:Ui:alert color="success" title="Success!">
    Your changes have been saved successfully.
</twig:Ui:alert>

<twig:Ui:alert color="error" title="Error occurred">
    There was a problem processing your request. Please try again.
</twig:Ui:alert>

<twig:Ui:alert color="warning" title="Warning">
    Your session will expire in 5 minutes. Please save your work.
</twig:Ui:alert>

<twig:Ui:alert color="info" title="Information">
    New features are now available. Check out the changelog.
</twig:Ui:alert>

{# Alert without icon #}
<twig:Ui:alert color="primary" title="Notice" icon="false">
    This is a simple alert without an icon.
</twig:Ui:alert>

{# Alert with only content (no title) #}
<twig:Ui:alert color="success">
    Quick success message without a title.
</twig:Ui:alert>

{# Dismissible alerts #}
<twig:Ui:alert color="info" title="Dismissible Alert" dismissible>
    You can close this alert by clicking the X button.
</twig:Ui:alert>

{# Outline variant #}
<twig:Ui:alert variant="outline" color="warning" title="Outline Warning">
    This alert has an outline style instead of filled background.
</twig:Ui:alert>

{# Rich content alert #}
<twig:Ui:alert color="success" title="Payment Confirmation">
    <p>Payment for <strong>{{ user.name }}</strong> has been processed successfully.</p>
    <div class="mt-3">
        <twig:Ui:button color="success" size="sm" href="/receipt">
            View Receipt
        </twig:Ui:button>
        <twig:Ui:button variant="outline" color="success" size="sm" href="/dashboard">
            Back to Dashboard
        </twig:Ui:button>
    </div>
</twig:Ui:alert>

{# Form validation alerts #}
{% if form.vars.errors|length > 0 %}
    <twig:Ui:alert color="error" title="Form Validation Errors" dismissible>
        <ul class="list-disc list-inside space-y-1">
            {% for error in form.vars.errors %}
                <li>{{ error.message }}</li>
            {% endfor %}
        </ul>
    </twig:Ui:alert>
{% endif %}

{# Boolean shortcuts (backward compatibility) #}
<twig:Ui:alert success title="Success">Success alert using boolean prop</twig:Ui:alert>
<twig:Ui:alert error outline dismissible title="Error">Error outline alert</twig:Ui:alert>
```

#### JavaScript Integration:
```javascript
// Listen for alert dismiss events
document.addEventListener('alert:dismissed', (event) => {
    console.log('Alert dismissed:', event.detail)
    
    // Optional: Track analytics
    gtag('event', 'alert_dismissed', {
        'alert_color': event.detail.color,
        'alert_variant': event.detail.variant
    })
})

// Programmatically dismiss alerts
const alertController = application.getControllerForElementAndIdentifier(
    document.querySelector('[data-controller="cisse--ui-bundle--alert"]'),
    'cisse--ui-bundle--alert'
)
alertController.hide()
```

### 🃏 Cards
```twig
<twig:Ui:card divide>
    <twig:block name="title">🎯 Project Overview</twig:block>
    <twig:block name="description">Track your project progress and metrics</twig:block>
    
    <twig:block name="content">
        <div class="space-y-4">
            <p>✅ 12 tasks completed</p>
            <p>⏳ 3 tasks in progress</p>
        </div>
    </twig:block>
    
    <twig:block name="actions">
        <twig:Ui:button primary>View Details</twig:Ui:button>
        <twig:Ui:button secondary>Edit Project</twig:Ui:button>
    </twig:block>
</twig:Ui:card>
```

### 📝 Forms  
```twig
{# Symfony Form Integration #}
<twig:Ui:form>
    <div class="space-y-4">
        <div>
            <twig:Ui:label>{{ form_label(form.email) }}</twig:Ui:label>
            <twig:Ui:input form="{{ form.email }}" />
        </div>
        
        <div>
            <twig:Ui:label>{{ form_label(form.message) }}</twig:Ui:label>
            <twig:Ui:input:textarea form="{{ form.message }}" rows="4" />
        </div>
        
        <twig:Ui:button type="submit" primary class="w-full">
            Send Message
        </twig:Ui:button>
    </div>
</twig:Ui:form>

{# Standalone Form Elements #}
<div class="space-y-4">
    <twig:Ui:input type="email" 
                   name="email" 
                   placeholder="your@email.com" 
                   required />
                   
    <twig:Ui:select name="role">
        <option value="">Choose a role...</option>
        <option value="admin">Administrator</option>
        <option value="user">User</option>
    </twig:Ui:select>
</div>
```

### 🧭 Tabs
```twig
{# Basic tabs with different colors #}
<twig:Ui:tabs current="{{ current_filter }}">
    <twig:Ui:tabs:item href="{{ path('dashboard_index') }}" 
                       current="{{ current_filter == 'all' }}">
        All Items
    </twig:Ui:tabs:item>
    
    <twig:Ui:tabs:item href="{{ path('dashboard_index', {filter: 'active'}) }}" 
                       color="success"
                       current="{{ current_filter == 'active' }}">
        Active
    </twig:Ui:tabs:item>
    
    <twig:Ui:tabs:item href="{{ path('dashboard_index', {filter: 'pending'}) }}" 
                       color="warning"
                       current="{{ current_filter == 'pending' }}">
        Pending
    </twig:Ui:tabs:item>
    
    <twig:Ui:tabs:item href="{{ path('dashboard_index', {filter: 'errors'}) }}" 
                       color="error"
                       current="{{ current_filter == 'errors' }}">
        Errors
    </twig:Ui:tabs:item>
</twig:Ui:tabs>

{# Advanced features #}
<twig:Ui:tabs current="settings">
    <twig:Ui:tabs:item href="/profile" current>
        👤 Profile
    </twig:Ui:tabs:item>
    
    <twig:Ui:tabs:item href="/security" color="info">
        🔒 Security
    </twig:Ui:tabs:item>
    
    <twig:Ui:tabs:item href="/billing" disabled>
        💳 Billing (Coming Soon)
    </twig:Ui:tabs:item>
</twig:Ui:tabs>

{# JavaScript/Stimulus Integration #}
<div data-controller="my-dashboard" 
     data-action="tabs:selected->my-dashboard#handleTabChange">
    <twig:Ui:tabs current="{{ current_filter }}">
        <twig:Ui:tabs:item href="{{ path('dashboard_index') }}" 
                           data-dashboard-section="overview"
                           current="{{ current_filter == 'overview' }}">
            📊 Overview
        </twig:Ui:tabs:item>
        
        <twig:Ui:tabs:item href="{{ path('dashboard_index', {section: 'analytics'}) }}" 
                           data-dashboard-section="analytics"
                           color="info"
                           current="{{ current_filter == 'analytics' }}">
            📈 Analytics
        </twig:Ui:tabs:item>
    </twig:Ui:tabs>
    
    <div data-my-dashboard-target="content" class="mt-6">
        <!-- Dynamic content loaded here -->
    </div>
</div>
```

#### JavaScript Controller Example:
```javascript
// assets/controllers/my_dashboard_controller.js
import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = ["content"]
    
    connect() {
        console.log("Dashboard controller connected")
    }
    
    // Handle tab selection events from the tabs component
    handleTabChange(event) {
        const { item, href, text } = event.detail
        const section = item.dataset.dashboardSection
        
        console.log(`Tab changed to: ${text} (${section})`)
        
        // Update content based on selection
        this.loadSection(section)
        
        // Optional: Update URL without page reload
        if (href && window.history) {
            window.history.pushState({}, '', href)
        }
    }
    
    loadSection(section) {
        // Example: Load content via fetch
        this.contentTarget.innerHTML = `<div class="animate-pulse">Loading ${section}...</div>`
        
        fetch(`/api/dashboard/${section}`)
            .then(response => response.text())
            .then(html => {
                this.contentTarget.innerHTML = html
            })
            .catch(() => {
                this.contentTarget.innerHTML = `<div class="text-red-600">Error loading ${section}</div>`
            })
    }
    
    // Public API: programmatically switch tabs
    switchToTab(section) {
        const tabsController = this.application.getControllerForElementAndIdentifier(
            document.querySelector('[data-controller*="cisse--ui-bundle--tabs"]'),
            'cisse--ui-bundle--tabs'
        )
        
        if (tabsController) {
            const tabItem = document.querySelector(`[data-dashboard-section="${section}"]`)
            if (tabItem) {
                tabsController.setActiveTab(tabItem)
            }
        }
    }
}
```

#### Advanced Stimulus Integration:
```twig
{# Real-time notifications with tab updates #}
<div data-controller="notifications"
     data-action="tabs:selected->notifications#trackTabView">
     
    <twig:Ui:tabs>
        <twig:Ui:tabs:item href="/inbox" current>
            📧 Inbox
            <span data-notifications-target="inboxCount" 
                  class="ml-2 bg-red-500 text-white rounded-full px-2 py-1 text-xs">
                {{ unread_count }}
            </span>
        </twig:Ui:tabs:item>
        
        <twig:Ui:tabs:item href="/sent" color="success">
            📤 Sent
        </twig:Ui:tabs:item>
    </twig:Ui:tabs>
</div>
```

```javascript
// assets/controllers/notifications_controller.js  
import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = ["inboxCount"]
    
    connect() {
        // Setup real-time updates
        this.setupWebSocket()
    }
    
    trackTabView(event) {
        // Analytics tracking
        const tabName = event.detail.text
        gtag('event', 'tab_view', {
            'tab_name': tabName,
            'timestamp': Date.now()
        })
    }
    
    setupWebSocket() {
        // Example WebSocket for real-time count updates
        this.ws = new WebSocket('/ws/notifications')
        this.ws.onmessage = (event) => {
            const data = JSON.parse(event.data)
            if (data.type === 'inbox_count') {
                this.updateInboxCount(data.count)
            }
        }
    }
    
    updateInboxCount(count) {
        if (this.hasInboxCountTarget) {
            this.inboxCountTarget.textContent = count
            this.inboxCountTarget.classList.toggle('hidden', count === 0)
        }
    }
}
```

### 📊 Data Tables
```twig
<twig:Ui:table>
    <twig:Ui:thead>
        <twig:Ui:tr>
            <twig:Ui:th>👤 User</twig:Ui:th>
            <twig:Ui:th>📧 Email</twig:Ui:th>
            <twig:Ui:th>📅 Joined</twig:Ui:th>
            <twig:Ui:th>⚙️ Actions</twig:Ui:th>
        </twig:Ui:tr>
    </twig:Ui:thead>
    <twig:Ui:tbody>
        {% for user in users %}
            <twig:Ui:tr>
                <twig:Ui:td>
                    <div class="font-medium">{{ user.name }}</div>
                </twig:Ui:td>
                <twig:Ui:td>{{ user.email }}</twig:Ui:td>
                <twig:Ui:td>{{ user.createdAt|date('M j, Y') }}</twig:Ui:td>
                <twig:Ui:td>
                    <div class="flex gap-2">
                        <twig:Ui:button href="/users/{{ user.id }}" secondary size="sm">
                            View
                        </twig:Ui:button>
                        <twig:Ui:button href="/users/{{ user.id }}/edit" primary size="sm">
                            Edit
                        </twig:Ui:button>
                    </div>
                </twig:Ui:td>
            </twig:Ui:tr>
        {% endfor %}
    </twig:Ui:tbody>
</twig:Ui:table>
```

## ⚙️ Configuration

The bundle can be configured in `config/packages/ux_components.yaml`:

```yaml
ux_components:
    enabled: true  # Default: true
```

## 🎨 TailwindCSS Setup (Critical)

### ⚠️ Required CSS Configuration

**CRITICAL**: Your main CSS file must include these required elements:

```css
@import "tailwindcss";
@source "../../vendor/cisse/ui-bundle";  /* ⚠️ MANDATORY - Bundle styles */

/* ⚠️ REQUIRED - Color variables for components to function */
@theme {
    --color-primary: /* your primary color */;
    --color-secondary: /* your secondary color */;
    --color-primary-foreground: /* text color for primary backgrounds */;
    --color-secondary-foreground: /* text color for secondary backgrounds */;
    /* ... additional color variants */
}
```

### 🔧 Smart Class Merging

All components include intelligent TailwindCSS class merging:

- **Advanced merging** with `gehrisandro/tailwind-merge-php` (if installed)
- **Fallback deduplication** for basic class conflicts
- **Predictable overrides** - later classes take precedence

```twig
{# Example: Custom classes override component defaults #}
<twig:Ui:button class="bg-red-500" primary>
    <!-- Results in proper primary button styling (not red) -->
    Custom Button
</twig:Ui:button>
```

### 🌙 Dark Mode Support

Built-in dark mode with CSS custom properties:

```css
@import "tailwindcss";
@source "../../vendor/cisse/ui-bundle";

@custom-variant dark (&:is(.dark *));

@theme {
    --color-primary: oklch(64.758% 0.19626 284.46);
    --color-primary-50: oklch(100% 0 none);
    --color-primary-100: oklch(100% 0 none);
    --color-primary-200: oklch(96.104% 0.02008 292.15);
    --color-primary-300: oklch(85.6% 0.07608 289.69);
    --color-primary-400: oklch(74.93% 0.13633 287.4);
    --color-primary-500: oklch(64.758% 0.19626 284.46);
    --color-primary-600: oklch(52.771% 0.26674 276.96);
    --color-primary-700: oklch(46.068% 0.30705 267.23);
    --color-primary-800: oklch(38.845% 0.26206 266.82);
    --color-primary-900: oklch(30.792% 0.20614 267.64);
    --color-primary-950: oklch(26.578% 0.17671 268.39);

    --color-secondary: oklch(29.515% 0.15616 273.84);
    --color-secondary-50: oklch(57.49% 0.18681 281.61);
    --color-secondary-100: oklch(53.218% 0.20688 279.56);
    --color-secondary-200: oklch(45.476% 0.24238 273.8);
    --color-secondary-300: oklch(40.165% 0.2236 272.43);
    --color-secondary-400: oklch(34.814% 0.19049 273.08);
    --color-secondary-500: oklch(29.515% 0.15616 273.84);
    --color-secondary-600: oklch(21.742% 0.10552 275.99);
    --color-secondary-700: oklch(13.321% 0.04444 281.55);
    --color-secondary-800: oklch(0% 0 none);
    --color-secondary-900: oklch(0% 0 none);
    --color-secondary-950: oklch(0% 0 none);

    --color-primary-foreground: oklch(0% 0 none);
    --color-primary-foreground-50: oklch(47.478% 0 none);
    --color-primary-foreground-100: oklch(43.86% 0 none);
    --color-primary-foreground-200: oklch(36.002% 0 none);
    --color-primary-foreground-300: oklch(28.094% 0 none);
    --color-primary-foreground-400: oklch(19.125% 0 none);
    --color-primary-foreground-500: oklch(0% 0 none);
    --color-primary-foreground-600: oklch(0% 0 none);
    --color-primary-foreground-700: oklch(0% 0 none);
    --color-primary-foreground-800: oklch(0% 0 none);
    --color-primary-foreground-900: oklch(0% 0 none);
    --color-primary-foreground-950: oklch(0% 0 none);

    --color-secondary-foreground: oklch(100% 0 none);
    --color-secondary-foreground-50: oklch(100% 0 none);
    --color-secondary-foreground-100: oklch(100% 0 none);
    --color-secondary-foreground-200: oklch(100% 0 none);
    --color-secondary-foreground-300: oklch(100% 0 none);
    --color-secondary-foreground-400: oklch(100% 0 none);
    --color-secondary-foreground-500: oklch(100% 0 none);
    --color-secondary-foreground-600: oklch(91.583% 0 none);
    --color-secondary-foreground-700: oklch(82.968% 0 none);
    --color-secondary-foreground-800: oklch(74.123% 0 none);
    --color-secondary-foreground-900: oklch(65.004% 0 none);
    --color-secondary-foreground-950: oklch(60.325% 0 none);

    --color-app: var(--color-secondary);
    --color-app-50: var(--color-secondary-50);
    --color-app-100: var(--color-secondary-100);
    --color-app-200: var(--color-secondary-200);
    --color-app-300: var(--color-secondary-300);
    --color-app-400: var(--color-secondary-400);
    --color-app-500: var(--color-secondary-500);
    --color-app-600: var(--color-secondary-600);
    --color-app-700: var(--color-secondary-700);
    --color-app-800: var(--color-secondary-800);
    --color-app-900: var(--color-secondary-900);
    --color-app-950: var(--color-secondary-950);

    --color-app-foreground: var(--color-secondary-foreground);
    --color-app-foreground-50: var(--color-secondary-foreground-50);
    --color-app-foreground-100: var(--color-secondary-foreground-100);
    --color-app-foreground-200: var(--color-secondary-foreground-200);
    --color-app-foreground-300: var(--color-secondary-foreground-300);
    --color-app-foreground-400: var(--color-secondary-foreground-400);
    --color-app-foreground-500: var(--color-secondary-foreground-500);
    --color-app-foreground-600: var(--color-secondary-foreground-600);
    --color-app-foreground-700: var(--color-secondary-foreground-700);
    --color-app-foreground-800: var(--color-secondary-foreground-800);
    --color-app-foreground-900: var(--color-secondary-foreground-900);
    --color-app-foreground-950: var(--color-secondary-foreground-950);
}

@layer base {
    .dark {
        --color-app: var(--color-primary);
        --color-app-50: var(--color-primary-50);
        --color-app-100: var(--color-primary-100);
        --color-app-200: var(--color-primary-200);
        --color-app-300: var(--color-primary-300);
        --color-app-400: var(--color-primary-400);
        --color-app-500: var(--color-primary-500);
        --color-app-600: var(--color-primary-600);
        --color-app-700: var(--color-primary-700);
        --color-app-800: var(--color-primary-800);
        --color-app-900: var(--color-primary-900);
        --color-app-950: var(--color-primary-950);

        --color-app-foreground: var(--color-primary-foreground);
        --color-app-foreground-50: var(--color-primary-foreground-50);
        --color-app-foreground-100: var(--color-primary-foreground-100);
        --color-app-foreground-200: var(--color-primary-foreground-200);
        --color-app-foreground-300: var(--color-primary-foreground-300);
        --color-app-foreground-400: var(--color-primary-foreground-400);
        --color-app-foreground-500: var(--color-primary-foreground-500);
        --color-app-foreground-600: var(--color-primary-foreground-600);
        --color-app-foreground-700: var(--color-primary-foreground-700);
        --color-app-foreground-800: var(--color-primary-foreground-800);
        --color-app-foreground-900: var(--color-primary-foreground-900);
        --color-app-foreground-950: var(--color-primary-foreground-950);
    }
}

@layer utilities {
    /* For Remove Date Icon */
    input[type="date"]::-webkit-inner-spin-button,
    input[type="time"]::-webkit-inner-spin-button,
    input[type="date"]::-webkit-calendar-picker-indicator,
    input[type="time"]::-webkit-calendar-picker-indicator {
        display: none;
        -webkit-appearance: none;
    }
}
```

> **⚠️ Critical**: The `@source "../../vendor/cisse/ui-bundle";` directive is **mandatory** and must be included in your CSS file for the components to work properly.

Example:
```twig
{# Classes are automatically merged, with later classes taking precedence #}
<twig:Ui:button class="bg-red-500" primary>
    {# Results in proper primary styling, not red #}
</twig:Ui:button>
```

## 🔧 Customization

### Component Properties
All components accept standard HTML attributes plus component-specific props:

```twig
<twig:Ui:button 
    type="submit"
    primary
    size="lg"
    class="mt-4 shadow-lg"
    data-turbo="false"
    id="submit-btn"
    disabled="{{ not form.valid }}">
    🚀 Submit Form
</twig:Ui:button>
```

### Extending Components
Override any component by creating templates in your application:

```
templates/
└── components/
    └── ux/
        ├── button.html.twig       # Custom button styling
        ├── card.html.twig         # Custom card layout  
        └── input/
            └── text.html.twig     # Custom text input
```

### Theme Customization
Customize the entire design system by modifying CSS variables:

```css
@theme {
    /* Brand colors */
    --color-primary: oklch(/* your brand color */);
    --color-secondary: oklch(/* your accent color */);
    
    /* Component-specific overrides */
    --ui-button-radius: 12px;
    --ui-input-border: 2px solid theme(colors.gray.300);
}
```

## 🚀 Development

### Contributing
We welcome contributions! To get started:

1. **Clone the repository**
   ```bash
   git clone https://github.com/cisse/ui-bundle.git
   cd ui-bundle
   ```

2. **Install dependencies**  
   ```bash
   composer install
   npm install  # For TailwindCSS compilation
   ```

3. **Run tests**
   ```bash
   composer test
   php bin/phpunit
   ```

4. **Code standards**
   ```bash  
   composer cs-fix  # Fix coding standards
   composer analyze # Run static analysis
   ```

### Project Structure
```
src/
├── Components/          # Twig component classes  
├── Resources/
│   ├── views/          # Component templates
│   └── assets/         # CSS and JS assets
└── UiBundleBundle.php  # Bundle configuration
```

## 📄 License

This bundle is released under the **MIT License**. See the [LICENSE](LICENSE) file for details.

## 🔗 Useful Links

- 📖 [Symfony UX Documentation](https://symfony.com/doc/current/frontend.html)
- 🎨 [TailwindCSS Documentation](https://tailwindcss.com)  
- 🔧 [Twig Documentation](https://twig.symfony.com)
- 💬 [GitHub Issues](https://github.com/cisse/ui-bundle/issues)
- 🐛 [Report a Bug](https://github.com/cisse/ui-bundle/issues/new)

---

<div align="center">
  
**Made with ❤️ for the Symfony community**

⭐ **Star this repo** if you find it useful!

</div>
