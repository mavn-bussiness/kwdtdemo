<?php

namespace App\Filament\Resources\Reports\Pages;

use App\Filament\Resources\Reports\ReportResource;
use App\Models\Content;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class CreateReport extends CreateRecord
{
    protected static string $resource = ReportResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $content = Content::create([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'type' => 'report',
            'status' => $data['publish_status'] ?? 'draft',
            'body' => null,
            'featured_image' => null,
            'author_id' => auth()->id(),
            'published_at' => $data['published_at'] ?? null,
        ]);

        if (! empty($data['categories'])) {
            $content->categories()->sync($data['categories']);
        }

        return $this->getModel()::create(array_merge(
            Arr::only($data, ['report_year', 'file_path', 'file_name', 'file_type', 'file_size_kb']),
            ['content_id' => $content->id]
        ));
    }
}
