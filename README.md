# Symfony UI Bundle

A Symfony UI bundle containing reusable anonymous Twig components styled with TailwindCSS.

## Installation

Install the bundle using Composer:

```bash
composer require symfony/ui-bundle
```

If you're using Symfony Flex, the bundle will be automatically configured. Otherwise, add it to your `config/bundles.php`:

```php
<?php

return [
    // ...
    Cisse\Bundle\UiBundle\UiBundleBundle::class => ['all' => true],
];
```

## Requirements

- PHP 8.1+
- Symfony 6.1+ or 7.0+
- Twig 3.0+

## Recommended Dependencies

For the best experience, also install:

```bash
# For TailwindCSS integration
composer require symfonycasts/tailwind-bundle

# For advanced class merging
composer require gehrisandro/tailwind-merge-php
```

## Available Components

### Form Components
- `<twig:Ui:input>` - Smart input with automatic type detection
- `<twig:Ui:input:text>`, `<twig:Ui:input:textarea>`, `<twig:Ui:input:checkbox>`, `<twig:Ui:input:date>`
- `<twig:Ui:label>` - Form labels
- `<twig:Ui:select>` - Select dropdowns
- `<twig:Ui:form>` - Form containers
- `<twig:Ui:input-group>`, `<twig:Ui:input-wrapper>`

### UI Components
- `<twig:Ui:button>` - Styled buttons with variants
- `<twig:Ui:card>` - Card layouts with header/content/footer
- `<twig:Ui:modal>` - Modal dialogs
- `<twig:Ui:slide-over>` - Slide-out panels
- `<twig:Ui:divider>` - Visual separators
- `<twig:Ui:tooltip>` - Tooltips

### Navigation
- `<twig:Ui:menu>`, `<twig:Ui:menu:item>`, `<twig:Ui:menu:sub>`
- `<twig:Ui:pagination>`

### Tables
- `<twig:Ui:table>`, `<twig:Ui:data-table>`
- `<twig:Ui:thead>`, `<twig:Ui:tbody>`, `<twig:Ui:tfoot>`
- `<twig:Ui:tr>`, `<twig:Ui:th>`, `<twig:Ui:td>`

### Data Display
- `<twig:Ui:datalist>` - Definition lists
- `<twig:Ui:accordion>` - Collapsible content
- `<twig:Ui:search>` - Search interfaces
- `<twig:Ui:boolean>` - Boolean value display

### Specialized
- `<twig:Ui:IdentificationChart>` - Chart displays
- `<twig:Ui:IdentificationStats>` - Statistics

## Usage Examples

### Button Variants

```twig
{# Primary button #}
<twig:Ui:button primary>Save</twig:Ui:button>

{# Secondary button #}
<twig:Ui:button secondary>Cancel</twig:Ui:button>

{# Error/danger button #}
<twig:Ui:button error>Delete</twig:Ui:button>

{# Link button #}
<twig:Ui:button href="/profile">View Profile</twig:Ui:button>

{# Custom styling #}
<twig:Ui:button primary class="w-full">Full Width Button</twig:Ui:button>
```

### Card Component

```twig
<twig:Ui:card divide>
    <twig:block name="title">User Profile</twig:block>
    <twig:block name="description">Manage your account settings</twig:block>
    
    <twig:block name="content">
        <p>Your profile information...</p>
    </twig:block>
    
    <twig:block name="actions">
        <twig:Ui:button primary>Edit Profile</twig:Ui:button>
    </twig:block>
    
    <twig:block name="footer">
        <p class="text-sm text-gray-500">Last updated: {{ 'now'|date }}</p>
    </twig:block>
</twig:Ui:card>
```

### Form Integration

```twig
{# With Symfony Forms #}
<twig:Ui:form>
    <twig:Ui:label>{{ form_label(form.email) }}</twig:Ui:label>
    <twig:Ui:input form="{{ form.email }}" />
    
    <twig:Ui:label>{{ form_label(form.message) }}</twig:Ui:label>
    <twig:Ui:input:textarea form="{{ form.message }}" />
    
    <twig:Ui:button type="submit" primary>Submit</twig:Ui:button>
</twig:Ui:form>

{# Standalone inputs #}
<twig:Ui:input type="email" name="email" placeholder="Enter your email" required />
<twig:Ui:select name="country">
    <twig:Ui:option value="us">United States</twig:Ui:option>
    <twig:Ui:option value="ca">Canada</twig:Ui:option>
</twig:Ui:select>
```

### Table with Data

```twig
<twig:Ui:table>
    <twig:Ui:thead>
        <twig:Ui:tr>
            <twig:Ui:th>Name</twig:Ui:th>
            <twig:Ui:th>Email</twig:Ui:th>
            <twig:Ui:th>Actions</twig:Ui:th>
        </twig:Ui:tr>
    </twig:Ui:thead>
    <twig:Ui:tbody>
        {% for user in users %}
            <twig:Ui:tr>
                <twig:Ui:td>{{ user.name }}</twig:Ui:td>
                <twig:Ui:td>{{ user.email }}</twig:Ui:td>
                <twig:Ui:td>
                    <twig:Ui:button href="/users/{{ user.id }}/edit" secondary>
                        Edit
                    </twig:Ui:button>
                </twig:Ui:td>
            </twig:Ui:tr>
        {% endfor %}
    </twig:Ui:tbody>
</twig:Ui:table>
```

## Configuration

The bundle can be configured in `config/packages/ux_components.yaml`:

```yaml
ux_components:
    enabled: true  # Default: true
```

## TailwindCSS Integration

All components use TailwindCSS classes and include a `tailwind_merge` filter for intelligent class merging. The filter:

1. Uses `gehrisandro/tailwind-merge-php` if available for advanced merging
2. Falls back to simple deduplication otherwise

Example:
```twig
{# Classes are automatically merged, with later classes taking precedence #}
<twig:Ui:button class="bg-red-500" primary>
    {# Results in proper primary styling, not red #}
</twig:Ui:button>
```

## Customization

### Component Props
All components accept standard HTML attributes plus component-specific props:

```twig
<twig:Ui:button 
    type="submit"
    primary
    class="mt-4"
    data-turbo="false"
    id="submit-btn">
    Submit Form
</twig:Ui:button>
```

### Extending Components
You can extend or override components by creating templates in your application:

```
templates/
└── components/
    └── ux/
        └── button.html.twig  # Your custom button override
```

## Development

To contribute or modify the bundle:

1. Clone the repository
2. Install dependencies: `composer install`
3. Run tests: `composer test`
4. Follow Symfony coding standards

## License

This bundle is released under the MIT License. See the [LICENSE](LICENSE) file for details.

## Links

- [Symfony UX Documentation](https://symfony.com/doc/current/frontend.html)
- [TailwindCSS Documentation](https://tailwindcss.com)
- [Twig Documentation](https://twig.symfony.com)
