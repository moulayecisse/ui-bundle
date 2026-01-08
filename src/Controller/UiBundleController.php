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
            'button' => ['label' => 'Button', 'description' => 'Primary action buttons with variants'],
            'badge' => ['label' => 'Badge', 'description' => 'Status badges and labels'],
            'avatar' => ['label' => 'Avatar', 'description' => 'User avatar display'],
            'card' => ['label' => 'Card', 'description' => 'Content container cards'],
            'collapsible-card' => ['label' => 'Collapsible Card', 'description' => 'Expandable/collapsible cards'],
            'divider' => ['label' => 'Divider', 'description' => 'Visual content separator'],
            'alert' => ['label' => 'Alert', 'description' => 'Alert messages with variants'],
            'tabs' => ['label' => 'Tabs', 'description' => 'Tabbed navigation'],
            'accordion' => ['label' => 'Accordion', 'description' => 'Collapsible content sections'],
            'menu' => ['label' => 'Menu', 'description' => 'Navigation menu with submenus'],
            'breadcrumb' => ['label' => 'Breadcrumb', 'description' => 'Navigation breadcrumbs'],
            'timeline' => ['label' => 'Timeline', 'description' => 'Timeline display'],
            'stepper' => ['label' => 'Stepper', 'description' => 'Multi-step process indicator'],
            'tooltip' => ['label' => 'Tooltip', 'description' => 'Contextual tooltips'],
            'popover' => ['label' => 'Popover', 'description' => 'Floating popover panels'],
            'modal' => ['label' => 'Modal', 'description' => 'Modal dialogs'],
            'slide-over' => ['label' => 'Slide Over', 'description' => 'Side panel drawers'],
            'dark-mode-toggle' => ['label' => 'Dark Mode Toggle', 'description' => 'Dark mode switch'],
            'filter-tabs' => ['label' => 'Filter Tabs', 'description' => 'Tab-like filter controls'],
            'stat-item' => ['label' => 'Stat Item', 'description' => 'Statistics display card'],
            'stats' => ['label' => 'Stats', 'description' => 'Statistics grid display'],
            'empty-state' => ['label' => 'Empty State', 'description' => 'Empty state display'],
            'table' => ['label' => 'Table', 'description' => 'Data table display'],
            'datalist' => ['label' => 'Data List', 'description' => 'Key-value pair list'],
        ],
        'form' => [
            'input' => ['label' => 'Input', 'description' => 'Text input fields'],
            'textarea' => ['label' => 'Textarea', 'description' => 'Multi-line text input'],
            'select' => ['label' => 'Select', 'description' => 'Dropdown select'],
            'combobox' => ['label' => 'Combobox', 'description' => 'Searchable select dropdown'],
            'checkbox' => ['label' => 'Checkbox', 'description' => 'Checkbox input'],
            'switch' => ['label' => 'Switch', 'description' => 'Toggle switch'],
            'form' => ['label' => 'Form', 'description' => 'Form wrapper component'],
            'input-group' => ['label' => 'Input Group', 'description' => 'Grouped input with addons'],
            'email-input' => ['label' => 'Email Input', 'description' => 'Email input with validation'],
            'password-input' => ['label' => 'Password Input', 'description' => 'Password input with toggle'],
            'phone-input' => ['label' => 'Phone Input', 'description' => 'Phone number with country'],
            'number-input' => ['label' => 'Number Input', 'description' => 'Numeric input'],
            'money-input' => ['label' => 'Money Input', 'description' => 'Currency input'],
            'quantity-input' => ['label' => 'Quantity Input', 'description' => 'Quantity spinner'],
            'url-input' => ['label' => 'URL Input', 'description' => 'URL input with validation'],
            'otp-input' => ['label' => 'OTP Input', 'description' => 'One-time password input'],
            'date-picker' => ['label' => 'Date Picker', 'description' => 'Date selection'],
            'color-picker' => ['label' => 'Color Picker', 'description' => 'Color selection'],
            'file-upload' => ['label' => 'File Upload', 'description' => 'File upload with drag-drop'],
            'slider' => ['label' => 'Slider', 'description' => 'Range slider'],
            'range-slider' => ['label' => 'Range Slider', 'description' => 'Dual-value range slider'],
            'tags-input' => ['label' => 'Tags Input', 'description' => 'Multiple tag input'],
            'icon-picker' => ['label' => 'Icon Picker', 'description' => 'Icon selection'],
            'rating' => ['label' => 'Rating', 'description' => 'Star rating input'],
        ],
        'table' => [
            'table' => ['label' => 'Table', 'description' => 'Basic table'],
            'data-table' => ['label' => 'Data Table', 'description' => 'Feature-rich data table'],
            'selectable-table' => ['label' => 'Selectable Table', 'description' => 'Table with row selection'],
            'mobile-list' => ['label' => 'Mobile List', 'description' => 'Mobile-optimized list'],
            'responsive-list' => ['label' => 'Responsive List', 'description' => 'Responsive table/list'],
            'datalist' => ['label' => 'Data List', 'description' => 'Key-value pair list'],
        ],
        'feedback' => [
            'loading-spinner' => ['label' => 'Loading Spinner', 'description' => 'Loading indicator'],
            'progress' => ['label' => 'Progress', 'description' => 'Progress bar'],
            'skeleton' => ['label' => 'Skeleton', 'description' => 'Loading skeleton'],
            'toast' => ['label' => 'Toast', 'description' => 'Toast notifications'],
            'notification-list' => ['label' => 'Notification List', 'description' => 'Notification container'],
            'confirm-dialog' => ['label' => 'Confirm Dialog', 'description' => 'Confirmation modal dialog'],
            'pagination' => ['label' => 'Pagination', 'description' => 'Pagination controls'],
        ],
        'layout' => [
            'base-layout' => ['label' => 'Base Layout', 'description' => 'Main app layout'],
            'auth-layout' => ['label' => 'Auth Layout', 'description' => 'Authentication layout'],
            'page-layout' => ['label' => 'Page Layout', 'description' => 'Page wrapper'],
            'page-hero' => ['label' => 'Page Hero', 'description' => 'Hero section'],
        ],
        'type' => [
            'text-type' => ['label' => 'Text Type', 'description' => 'Text display formatting'],
            'number-type' => ['label' => 'Number Type', 'description' => 'Number display formatting'],
            'date-type' => ['label' => 'Date Type', 'description' => 'Date display formatting'],
            'badge-type' => ['label' => 'Badge Type', 'description' => 'Badge display formatting'],
            'boolean' => ['label' => 'Boolean', 'description' => 'Boolean display'],
        ],
    ];

    #[Route('', name: 'index')]
    public function index(): Response
    {
        return $this->render('@Ui/ui_library/index.html.twig', [
            'components' => $this->components,
        ]);
    }

    #[Route('/component/{category}/{component}', name: 'component')]
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
