<?php

namespace Cisse\Bundle\Ui\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * UI Bundle Controller
 *
 * Provides routes to preview UI components in the browser.
 * Enable by adding the routes to your application.
 */
#[Route('/_ui', name: '_ui_')]
class UiBundleController extends AbstractController
{
    private array $components = [
        'core' => [
            'accordion' => ['label' => 'Accordion', 'description' => 'Collapsible content sections'],
            'avatar' => ['label' => 'Avatar', 'description' => 'User avatar display'],
            'badge' => ['label' => 'Badge', 'description' => 'Status badges and labels'],
            'breadcrumb' => ['label' => 'Breadcrumb', 'description' => 'Navigation breadcrumbs'],
            'button' => ['label' => 'Button', 'description' => 'Primary action buttons with variants'],
            'card' => ['label' => 'Card', 'description' => 'Content container cards'],
            'collapsible-card' => ['label' => 'Collapsible Card', 'description' => 'Expandable/collapsible cards'],
            'container' => ['label' => 'Container', 'description' => 'Base wrapper for visual harmony'],
            'dark-mode-toggle' => ['label' => 'Dark Mode Toggle', 'description' => 'Dark mode switch'],
            'data-table' => ['label' => 'Data Table', 'description' => 'Feature-rich data table'],
            'datalist' => ['label' => 'Data List', 'description' => 'Key-value pair list'],
            'divider' => ['label' => 'Divider', 'description' => 'Visual content separator'],
            'filter-tabs' => ['label' => 'Filter Tabs', 'description' => 'Tab-like filter controls'],
            'menu' => ['label' => 'Menu', 'description' => 'Navigation menu with submenus'],
            'mobile-list' => ['label' => 'Mobile List', 'description' => 'Mobile-optimized list'],
            'popover' => ['label' => 'Popover', 'description' => 'Floating popover panels'],
            'responsive-list' => ['label' => 'Responsive List', 'description' => 'Responsive table/list'],
            'selectable-table' => ['label' => 'Selectable Table', 'description' => 'Table with row selection'],
            'slide-over' => ['label' => 'Slide Over', 'description' => 'Side panel drawers'],
            'stat' => ['label' => 'Stat', 'description' => 'Statistics grid display'],
            'stat/item' => ['label' => 'Stat Item', 'description' => 'Statistics display card'],
            'stepper' => ['label' => 'Stepper', 'description' => 'Multi-step process indicator'],
            'table' => ['label' => 'Table', 'description' => 'Data table display'],
            'tabs' => ['label' => 'Tabs', 'description' => 'Tabbed navigation'],
            'timeline' => ['label' => 'Timeline', 'description' => 'Timeline display'],
            'tooltip' => ['label' => 'Tooltip', 'description' => 'Contextual tooltips'],
        ],
        'feedback' => [
            'alert' => ['label' => 'Alert', 'description' => 'Alert messages with variants'],
            'confirm-dialog' => ['label' => 'Confirm Dialog', 'description' => 'Confirmation modal dialog'],
            'empty-state' => ['label' => 'Empty State', 'description' => 'Empty state display'],
            'loading-spinner' => ['label' => 'Loading Spinner', 'description' => 'Loading indicator'],
            'modal' => ['label' => 'Modal', 'description' => 'Modal dialogs'],
            'notification-list' => ['label' => 'Notification List', 'description' => 'Notification container'],
            'pagination' => ['label' => 'Pagination', 'description' => 'Pagination controls'],
            'progress' => ['label' => 'Progress', 'description' => 'Progress bar'],
            'skeleton' => ['label' => 'Skeleton', 'description' => 'Loading skeleton'],
            'toast' => ['label' => 'Toast', 'description' => 'Toast notifications'],
        ],
        'form' => [
            'checkbox' => ['label' => 'Checkbox', 'description' => 'Checkbox input'],
            'color-picker' => ['label' => 'Color Picker', 'description' => 'Color selection'],
            'combobox' => ['label' => 'Combobox', 'description' => 'Searchable select dropdown'],
            'date-picker' => ['label' => 'Date Picker', 'description' => 'Date selection'],
            'email-input' => ['label' => 'Email Input', 'description' => 'Email input with validation'],
            'file-upload' => ['label' => 'File Upload', 'description' => 'File upload with drag-drop'],
            'form' => ['label' => 'Form', 'description' => 'Form wrapper component'],
            'icon-picker' => ['label' => 'Icon Picker', 'description' => 'Icon selection'],
            'input' => ['label' => 'Input', 'description' => 'Text input fields'],
            'input-addon' => ['label' => 'Input Addon', 'description' => 'Horizontal grouping with connected styling'],
            'input-group' => ['label' => 'Input Group', 'description' => 'Form field wrapper (label + input + help)'],
            'input-wrapper' => ['label' => 'Input Wrapper', 'description' => 'Styled container with before/after slots'],
            'money-input' => ['label' => 'Money Input', 'description' => 'Currency input'],
            'number-input' => ['label' => 'Number Input', 'description' => 'Numeric input'],
            'otp-input' => ['label' => 'OTP Input', 'description' => 'One-time password input'],
            'password-input' => ['label' => 'Password Input', 'description' => 'Password input with toggle'],
            'phone-input' => ['label' => 'Phone Input', 'description' => 'Phone number with country'],
            'quantity-input' => ['label' => 'Quantity Input', 'description' => 'Quantity spinner'],
            'range-slider' => ['label' => 'Range Slider', 'description' => 'Dual-value range slider'],
            'rating' => ['label' => 'Rating', 'description' => 'Star rating input'],
            'search' => ['label' => 'Search Form', 'description' => 'Search form wrapper'],
            'search-input' => ['label' => 'Search Input', 'description' => 'Search input with icon'],
            'select' => ['label' => 'Select', 'description' => 'Dropdown select'],
            'slider' => ['label' => 'Slider', 'description' => 'Range slider'],
            'switch' => ['label' => 'Switch', 'description' => 'Toggle switch'],
            'tags-input' => ['label' => 'Tags Input', 'description' => 'Multiple tag input'],
            'textarea' => ['label' => 'Textarea', 'description' => 'Multi-line text input'],
            'url-input' => ['label' => 'URL Input', 'description' => 'URL input with validation'],
        ],
        'layout' => [
            'auth' => ['label' => 'Auth Layout', 'description' => 'Authentication layout'],
            'base' => ['label' => 'Base Layout', 'description' => 'Main app layout'],
            'page' => ['label' => 'Page Layout', 'description' => 'Page wrapper'],
            'page-hero' => ['label' => 'Page Hero', 'description' => 'Hero section'],
        ],
        'type' => [
            'badge-type' => ['label' => 'Badge Type', 'description' => 'Badge display formatting'],
            'boolean' => ['label' => 'Boolean', 'description' => 'Boolean display'],
            'date-type' => ['label' => 'Date Type', 'description' => 'Date display formatting'],
            'number-type' => ['label' => 'Number Type', 'description' => 'Number display formatting'],
            'text-type' => ['label' => 'Text Type', 'description' => 'Text display formatting'],
        ],
    ];

    #[Route('', name: 'index')]
    public function index(): Response
    {
        // Redirect to the first component (no dashboard)
        $firstCategory = array_key_first($this->components);
        $firstComponent = array_key_first($this->components[$firstCategory]);

        return $this->redirectToRoute('_ui_component', [
            'category' => $firstCategory,
            'component' => $firstComponent,
        ]);
    }

    #[Route('/component/{category}/{component}', name: 'component', requirements: ['component' => '.+'])]
    public function component(string $category, string $component): Response
    {
        if (!isset($this->components[$category][$component])) {
            throw $this->createNotFoundException('Component not found');
        }

        $componentInfo = $this->components[$category][$component];

        return $this->render('@Ui/ui_library/component.html.twig', [
            'category' => $category,
            'component' => $component,
            'componentInfo' => $componentInfo,
            'components' => $this->components,
        ]);
    }
}
