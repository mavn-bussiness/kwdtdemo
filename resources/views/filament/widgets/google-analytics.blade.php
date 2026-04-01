<x-filament-widgets::widget>
    <x-filament::section>
        @php
            $embedUrl = $this->getEmbedUrl();
        @endphp

        @if($embedUrl)
            <div class="flex items-center justify-center w-full h-[600px] overflow-hidden rounded-xl border border-gray-200 dark:border-gray-700">
                <iframe
                    src="{{ $embedUrl }}"
                    frameborder="0"
                    style="border:0; width: 100%; height: 100%;"
                    allowfullscreen
                    loading="lazy"
                ></iframe>
            </div>
        @else
            <div class="flex flex-col items-center justify-center p-8 text-center bg-gray-50 dark:bg-gray-800 rounded-xl border border-dashed border-gray-300 dark:border-gray-600">
                <div class="p-3 bg-white dark:bg-gray-900 rounded-full shadow-sm mb-4">
                    <x-heroicon-o-chart-bar class="w-8 h-8 text-gray-400" />
                </div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Google Analytics Report Not Configured
                </h3>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 max-w-sm">
                    Please set the <code>GOOGLE_ANALYTICS_EMBED_URL</code> in your <code>.env</code> file to display the GA4 report here.
                </p>
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
