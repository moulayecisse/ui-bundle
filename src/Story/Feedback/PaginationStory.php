<?php

namespace Cisse\Bundle\Ui\Story\Feedback;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'pagination',
    category: 'feedback',
    label: 'Pagination',
    description: 'Navigation component for paginated data'
)]
class PaginationStory extends AbstractComponentStory
{
    #[Prop(type: 'Pagination', default: '-')]
    public string $pagination = 'Pagination model object with page info';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Story('Pagination Preview', order: 0)]
    public function preview(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="bg-white dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between border-t border-gray-200 dark:border-gray-800 px-4 py-3 sm:px-6">
                <div class="flex flex-1 justify-between sm:hidden">
                    <a href="#" class="relative inline-flex items-center rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-black px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-950">Précédent</a>
                    <a href="#" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-black px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-950">Suivant</a>
                </div>
                <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700 dark:text-gray-300">
                            Affichage de
                            <span class="font-medium">1</span>
                            à
                            <span class="font-medium">10</span>
                            sur
                            <span class="font-medium">97</span>
                            élements
                        </p>
                    </div>
                    <div>
                        <nav class="isolate inline-flex -space-x-px rounded-md shadow-xs">
                            <a href="#" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-gray-300 dark:ring-gray-700 ring-inset hover:bg-gray-50 dark:hover:bg-gray-950">
                                <svg class="size-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-primary ring-1 ring-primary z-10">1</a>
                            <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 dark:text-gray-100 ring-1 ring-gray-300 dark:ring-gray-700 ring-inset hover:bg-gray-50 dark:hover:bg-gray-950">2</a>
                            <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 dark:text-gray-100 ring-1 ring-gray-300 dark:ring-gray-700 ring-inset hover:bg-gray-50 dark:hover:bg-gray-950">3</a>
                            <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 dark:text-gray-300 ring-1 ring-gray-300 dark:ring-gray-700 ring-inset">...</span>
                            <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 dark:text-gray-100 ring-1 ring-gray-300 dark:ring-gray-700 ring-inset hover:bg-gray-50 dark:hover:bg-gray-950">10</a>
                            <a href="#" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-gray-300 dark:ring-gray-700 ring-inset hover:bg-gray-50 dark:hover:bg-gray-950">
                                <svg class="size-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        TWIG);
    }

    #[Story('Controller Usage Example', order: 1)]
    public function usage(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="bg-gray-100 dark:bg-gray-800 rounded-lg p-4">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Example controller code for creating a Pagination object:
            </p>
            <pre class="mt-3 text-xs bg-gray-900 text-gray-100 p-4 rounded-lg overflow-x-auto">use Cisse\Bundle\Ui\Model\Pagination;

        public function index(Request $request): Response
        {
            $page = $request->query->getInt('page', 1);
            $limit = 10;

            $queryBuilder = $this->userRepository->createQueryBuilder('u');
            $pagination = Pagination::create($queryBuilder, $page, $limit);

            return $this->render('user/index.html.twig', [
                'users' => $pagination->getItems(),
                'pagination' => $pagination,
            ]);
        }</pre>
        </div>
        TWIG);
    }

    #[Story('Features', order: 2)]
    public function features(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="bg-gray-50 dark:bg-gray-800/50 rounded-lg p-4">
            <h4 class="font-semibold text-gray-900 dark:text-white mb-3">Features</h4>
            <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-2">
                <li class="flex items-start gap-2">
                    <twig:ux:icon name="heroicons:check-circle-20-solid" class="size-5 text-emerald-500 shrink-0 mt-0.5" />
                    <span><strong>Mobile-friendly:</strong> Shows simple Previous/Next buttons on mobile</span>
                </li>
                <li class="flex items-start gap-2">
                    <twig:ux:icon name="heroicons:check-circle-20-solid" class="size-5 text-emerald-500 shrink-0 mt-0.5" />
                    <span><strong>Smart truncation:</strong> Shows ellipsis for large page ranges</span>
                </li>
                <li class="flex items-start gap-2">
                    <twig:ux:icon name="heroicons:check-circle-20-solid" class="size-5 text-emerald-500 shrink-0 mt-0.5" />
                    <span><strong>Range display:</strong> Shows "X to Y of Z" item counts</span>
                </li>
                <li class="flex items-start gap-2">
                    <twig:ux:icon name="heroicons:check-circle-20-solid" class="size-5 text-emerald-500 shrink-0 mt-0.5" />
                    <span><strong>Active page highlight:</strong> Current page is visually highlighted</span>
                </li>
            </ul>
        </div>
        TWIG);
    }
}
