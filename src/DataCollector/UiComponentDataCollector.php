<?php

namespace Cisse\Bundle\Ui\DataCollector;

use Symfony\Bundle\FrameworkBundle\DataCollector\AbstractDataCollector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\LateDataCollectorInterface;
use Twig\Profiler\Profile;

final class UiComponentDataCollector extends AbstractDataCollector implements LateDataCollectorInterface
{
    private const UI_NAMESPACE_PREFIX = '@ui/';

    public function __construct(
        private readonly Profile $profile,
    ) {
    }

    public function collect(Request $request, Response $response, ?\Throwable $exception = null): void
    {
        // Data is collected in lateCollect() after all templates have rendered
    }

    public function lateCollect(): void
    {
        $components = [];
        $hierarchy = [];
        $totalCount = 0;
        $totalDuration = 0.0;

        $this->processProfile($this->profile, $components, $hierarchy, $totalCount, $totalDuration);

        // Sort by render count descending
        arsort($components);

        $this->data = [
            'components' => $components,
            'hierarchy' => $hierarchy,
            'total_count' => $totalCount,
            'total_duration' => $totalDuration,
            'unique_count' => count($components),
        ];
    }

    private function processProfile(
        Profile $profile,
        array &$components,
        array &$hierarchy,
        int &$totalCount,
        float &$totalDuration,
    ): void {
        foreach ($profile as $p) {
            if ($p->isTemplate() && $this->isUiComponent($p->getName())) {
                $componentName = $this->extractComponentName($p->getName());

                // Track component counts
                $components[$componentName] = ($components[$componentName] ?? 0) + 1;
                $totalCount++;
                $totalDuration += $p->getDuration();

                // Build hierarchy entry
                $hierarchyEntry = [
                    'name' => $componentName,
                    'template' => $p->getName(),
                    'duration' => $p->getDuration(),
                    'memory' => $p->getMemoryUsage(),
                    'children' => [],
                ];

                // Process children
                $childHierarchy = [];
                $this->processProfile($p, $components, $childHierarchy, $totalCount, $totalDuration);
                $hierarchyEntry['children'] = $childHierarchy;

                $hierarchy[] = $hierarchyEntry;
            } else {
                // Continue traversing non-UI templates to find nested UI components
                $this->processProfile($p, $components, $hierarchy, $totalCount, $totalDuration);
            }
        }
    }

    private function isUiComponent(string $templateName): bool
    {
        return str_starts_with($templateName, self::UI_NAMESPACE_PREFIX);
    }

    private function extractComponentName(string $templateName): string
    {
        // Convert @ui/card/header.html.twig -> card:header
        $name = substr($templateName, strlen(self::UI_NAMESPACE_PREFIX));
        $name = str_replace('.html.twig', '', $name);
        $name = str_replace('/', ':', $name);

        return $name;
    }

    /**
     * @return array<string, int>
     */
    public function getComponents(): array
    {
        return $this->data['components'] ?? [];
    }

    /**
     * @return array<int, array{name: string, template: string, duration: float, memory: int, children: array}>
     */
    public function getHierarchy(): array
    {
        return $this->data['hierarchy'] ?? [];
    }

    public function getTotalCount(): int
    {
        return $this->data['total_count'] ?? 0;
    }

    public function getUniqueCount(): int
    {
        return $this->data['unique_count'] ?? 0;
    }

    public function getTotalDuration(): float
    {
        return $this->data['total_duration'] ?? 0.0;
    }

    public function reset(): void
    {
        parent::reset();
        $this->data = [];
    }

    public static function getTemplate(): ?string
    {
        return '@ui/data_collector/ui_components.html.twig';
    }

    public function getName(): string
    {
        return 'ui_components';
    }
}
