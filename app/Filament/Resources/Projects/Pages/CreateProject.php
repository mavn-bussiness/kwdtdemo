<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectResource;
use App\Models\Content;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $content = Content::create([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'type' => 'project',
            'status' => $data['publish_status'] ?? 'draft',
            'excerpt' => $data['excerpt'] ?? null,
            'body' => $data['body'],
            'featured_image' => $data['featured_image'] ?? null,
            'author_id' => auth()->id(),
            'published_at' => $data['published_at'] ?? null,
        ]);

        if (! empty($data['categories'])) {
            $content->categories()->sync($data['categories']);
        }

        return $this->getModel()::create(array_merge(
            Arr::only($data, ['status', 'start_date', 'end_date', 'location', 'funder', 'beneficiaries_count', 'budget_usd']),
            ['content_id' => $content->id]
        ));
    }
}
