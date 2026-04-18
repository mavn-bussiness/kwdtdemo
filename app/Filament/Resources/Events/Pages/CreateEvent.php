<?php

namespace App\Filament\Resources\Events\Pages;

use App\Filament\Resources\Events\EventResource;
use App\Models\Content;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $content = Content::create([
            'title'          => $data['title'],
            'slug'           => $data['slug'],
            'type'           => 'event',
            'status'         => $data['publish_status'] ?? 'draft',
            'excerpt'        => $data['excerpt'] ?? null,
            'body'           => $data['body'] ?? null,
            'featured_image' => $data['featured_image'] ?? null,
            'author_id'      => auth()->id(),
            'published_at'   => $data['published_at'] ?? null,
        ]);

        if (! empty($data['categories'])) {
            $content->categories()->sync($data['categories']);
        }

        return $this->getModel()::create(array_merge(
            Arr::only($data, ['event_date', 'end_date', 'venue', 'district', 'registration_url', 'capacity']),
            ['content_id' => $content->id]
        ));
    }
}
