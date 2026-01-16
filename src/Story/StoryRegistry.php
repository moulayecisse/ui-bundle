<?php

namespace Cisse\Bundle\Ui\Story;

use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

/**
 * Registry that collects all component stories.
 */
final class StoryRegistry
{
    /** @var array<string, array<string, AbstractComponentStory>> */
    private array $storiesByCategory = [];

    /** @var array<string, AbstractComponentStory> */
    private array $storiesByKey = [];

    private bool $initialized = false;

    /**
     * @param iterable<AbstractComponentStory> $stories
     */
    public function __construct(
        #[AutowireIterator('ui.component_story')]
        private readonly iterable $stories,
    ) {}

    private function initialize(): void
    {
        if ($this->initialized) {
            return;
        }

        foreach ($this->stories as $story) {
            $category = $story->getCategory();
            $name = $story->getName();
            $key = $category . '/' . $name;

            $this->storiesByCategory[$category][$name] = $story;
            $this->storiesByKey[$key] = $story;
        }

        // Sort categories and stories within each category
        ksort($this->storiesByCategory);
        foreach ($this->storiesByCategory as $category => &$stories) {
            ksort($stories);
        }

        $this->initialized = true;
    }

    /**
     * Get all stories organized by category.
     *
     * @return array<string, array<string, AbstractComponentStory>>
     */
    public function getAll(): array
    {
        $this->initialize();
        return $this->storiesByCategory;
    }

    /**
     * Get all categories.
     *
     * @return string[]
     */
    public function getCategories(): array
    {
        $this->initialize();
        return array_keys($this->storiesByCategory);
    }

    /**
     * Get stories for a specific category.
     *
     * @return array<string, AbstractComponentStory>
     */
    public function getByCategory(string $category): array
    {
        $this->initialize();
        return $this->storiesByCategory[$category] ?? [];
    }

    /**
     * Get a specific story by category and name.
     */
    public function get(string $category, string $name): ?AbstractComponentStory
    {
        $this->initialize();
        return $this->storiesByCategory[$category][$name] ?? null;
    }

    /**
     * Check if a story exists.
     */
    public function has(string $category, string $name): bool
    {
        $this->initialize();
        return isset($this->storiesByCategory[$category][$name]);
    }

    /**
     * Get component list for navigation (compatible with controller format).
     *
     * @return array<string, array<string, array{label: string, description: string}>>
     */
    public function getComponentList(): array
    {
        $this->initialize();
        $list = [];

        foreach ($this->storiesByCategory as $category => $stories) {
            $list[$category] = [];
            foreach ($stories as $name => $story) {
                $list[$category][$name] = [
                    'label' => $story->getLabel(),
                    'description' => $story->getDescription(),
                ];
            }
        }

        return $list;
    }
}
