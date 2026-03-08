<x-layouts.app title="What We Do" metaDescription="KWDT thematic areas and programs.">

	<div class="page-hero page-hero--short">
		<div class="page-hero-content">
			<span class="section-label">What We Do</span>
			<h1 class="page-title">Our Thematic Areas</h1>
		</div>
	</div>

	<section class="section">
		<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
			@foreach($areas as $area)
				<div class="card">
					<h3>{{ $area->name }}</h3>
					<p>{{ $area->description }}</p>
					<a href="#" class="link">Learn more</a>
				</div>
			@endforeach
		</div>
	</section>

</x-layouts.app>
