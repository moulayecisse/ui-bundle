<?php

namespace Cisse\Bundle\Ui\Story;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\NestedAttribute;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

/**
 * Base class for component stories.
 * Extend this class and use attributes to define component documentation.
 */
#[AutoconfigureTag('ui.component_story')]
abstract class AbstractComponentStory
{
    private ?AsComponentStory $metadata = null;
    /** @var PropDefinition[] */
    private ?array $props = null;
    /** @var SlotDefinition[] */
    private ?array $slots = null;
    /** @var NestedAttributeDefinition[] */
    private ?array $nestedAttributes = null;
    /** @var StoryExample[] */
    private ?array $stories = null;

    public function getMetadata(): AsComponentStory
    {
        if ($this->metadata === null) {
            $reflection = new \ReflectionClass($this);
            $attributes = $reflection->getAttributes(AsComponentStory::class);

            if (empty($attributes)) {
                throw new \LogicException(sprintf(
                    'Class %s must have the #[AsComponentStory] attribute.',
                    static::class
                ));
            }

            $this->metadata = $attributes[0]->newInstance();
        }

        return $this->metadata;
    }

    public function getName(): string
    {
        return $this->getMetadata()->name;
    }

    public function getCategory(): string
    {
        return $this->getMetadata()->category;
    }

    public function getLabel(): string
    {
        return $this->getMetadata()->label;
    }

    public function getDescription(): string
    {
        return $this->getMetadata()->description;
    }

    /**
     * @return PropDefinition[]
     */
    public function getProps(): array
    {
        if ($this->props === null) {
            $this->props = [];
            $reflection = new \ReflectionClass($this);

            foreach ($reflection->getProperties() as $property) {
                $attributes = $property->getAttributes(Prop::class);
                if (!empty($attributes)) {
                    /** @var Prop $prop */
                    $prop = $attributes[0]->newInstance();
                    $property->setAccessible(true);

                    $this->props[] = new PropDefinition(
                        name: $property->getName(),
                        type: $prop->type,
                        default: $prop->default,
                        description: $property->getValue($this),
                    );
                }
            }
        }

        return $this->props;
    }

    /**
     * @return SlotDefinition[]
     */
    public function getSlots(): array
    {
        if ($this->slots === null) {
            $this->slots = [];
            $reflection = new \ReflectionClass($this);

            foreach ($reflection->getProperties() as $property) {
                $attributes = $property->getAttributes(Slot::class);
                if (!empty($attributes)) {
                    $property->setAccessible(true);

                    $this->slots[] = new SlotDefinition(
                        name: $property->getName(),
                        description: $property->getValue($this),
                    );
                }
            }
        }

        return $this->slots;
    }

    /**
     * @return NestedAttributeDefinition[]
     */
    public function getNestedAttributes(): array
    {
        if ($this->nestedAttributes === null) {
            $this->nestedAttributes = [];
            $reflection = new \ReflectionClass($this);

            foreach ($reflection->getProperties() as $property) {
                $attributes = $property->getAttributes(NestedAttribute::class);
                if (!empty($attributes)) {
                    $property->setAccessible(true);

                    $this->nestedAttributes[] = new NestedAttributeDefinition(
                        name: $property->getName(),
                        description: $property->getValue($this),
                    );
                }
            }
        }

        return $this->nestedAttributes;
    }

    /**
     * @return StoryExample[]
     */
    public function getStories(): array
    {
        if ($this->stories === null) {
            $this->stories = [];
            $reflection = new \ReflectionClass($this);

            foreach ($reflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
                $attributes = $method->getAttributes(Story::class);
                if (!empty($attributes)) {
                    /** @var Story $storyAttr */
                    $storyAttr = $attributes[0]->newInstance();

                    /** @var StoryExample $story */
                    $story = $method->invoke($this);

                    $this->stories[] = $story
                        ->withTitle($storyAttr->title)
                        ->order($storyAttr->order);
                }
            }

            // Sort by order
            usort($this->stories, fn(StoryExample $a, StoryExample $b) => $a->order <=> $b->order);
        }

        return $this->stories;
    }

    /**
     * Get all data as array for Twig templates.
     */
    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'category' => $this->getCategory(),
            'label' => $this->getLabel(),
            'description' => $this->getDescription(),
            'props' => array_map(fn(PropDefinition $p) => $p->toArray(), $this->getProps()),
            'slots' => array_map(fn(SlotDefinition $s) => $s->toArray(), $this->getSlots()),
            'nestedAttributes' => array_map(fn(NestedAttributeDefinition $n) => $n->toArray(), $this->getNestedAttributes()),
            'stories' => array_map(fn(StoryExample $s) => $s->toArray(), $this->getStories()),
        ];
    }
}
