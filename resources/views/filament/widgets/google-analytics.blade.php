<x-filament-widgets::widget>
    <x-filament::section>
        @php $embedUrl = $this->getEmbedUrl(); $measurementId = $this->getMeasurementId(); @endphp

        {{-- Header --}}
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-2.5">
                <div class="p-1.5 rounded-lg" style="background:#F5820A">
                    <x-heroicon-m-chart-bar-square class="w-4 h-4 text-white" />
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-gray-900 dark:text-gray-100 leading-tight">
                        Google Analytics — Website Traffic
                    </h2>
                    @if($measurementId)
                        <p class="text-xs text-gray-400 leading-tight">{{ $measurementId }}</p>
                    @endif
                </div>
                <span class="text-xs px-2 py-0.5 rounded-full font-semibold"
                      style="background:#FFF3E3;color:#D06800">GA4</span>
            </div>
            <span class="text-xs text-gray-400">Last 30 days</span>
        </div>

        @if($embedUrl)
            {{-- Live GA4 embed --}}
            <div class="rounded-xl overflow-hidden border h-[520px]"
                 style="border-color:#F0DFC0">
                <iframe src="{{ $embedUrl }}"
                        frameborder="0"
                        style="border:0;width:100%;height:100%;"
                        allowfullscreen
                        loading="lazy"
                        title="Google Analytics Report"></iframe>
            </div>
        @else
            {{-- Placeholder — not yet configured --}}
            <div class="flex flex-col items-center justify-center py-14 text-center rounded-xl border-2 border-dashed"
                 style="background:#FFFAF4;border-color:#F0DFC0">

                <div class="p-4 rounded-full mb-4" style="background:#FFF3E3">
                    <x-heroicon-o-chart-bar class="w-8 h-8" style="color:#F5820A" />
                </div>

                <h3 class="text-sm font-semibold mb-1" style="color:#3D2100">
                    GA4 Report Not Yet Configured
                </h3>
                <p class="text-xs max-w-sm mb-5" style="color:#8C5D00">
                    Add your Google Analytics embed URL to display live traffic data directly in this dashboard.
                </p>

                <div class="text-left rounded-lg px-4 py-3 text-xs font-mono w-full max-w-md"
                     style="background:#3D2100;color:#FF9E30">
                    <span style="color:#8C5D00"># .env</span><br>
                    GOOGLE_ANALYTICS_EMBED_URL=<span style="color:#F0DFC0">https://analytics.google.com/...</span><br>
                    GOOGLE_ANALYTICS_MEASUREMENT_ID=<span style="color:#F0DFC0">G-XXXXXXXXXX</span>
                </div>

                <p class="text-xs mt-4" style="color:#B08E60">
                    After updating .env, run
                    <code class="px-1.5 py-0.5 rounded text-xs" style="background:#F0DFC0;color:#5C3600">php artisan config:cache</code>
                </p>
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
