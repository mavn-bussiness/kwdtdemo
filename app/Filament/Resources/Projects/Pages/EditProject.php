<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $content = $this->record->content;

        return array_merge($data, [
            'title' => $content->title,
            'slug' => $content->slug,
            'publish_status' => $content->status,
            'excerpt' => $content->excerpt,
            'body' => $content->body,
            'featured_image' => $content->featured_image,
            'published_at' => $content->published_at,
            'categories' => $content->categories->pluck('id')->toArray(),
        ]);
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->content->update([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'status' => $data['publish_status'] ?? 'draft',
            'excerpt' => $data['excerpt'] ?? null,
            'body' => $data['body'],
            'featured_image' => $data['featured_image'] ?? null,
            'published_at' => $data['published_at'] ?? null,
        ]);

        $record->content->categories()->sync($data['categories'] ?? []);

        $record->update(
            Arr::only($data, ['status', 'start_date', 'end_date', 'location', 'funder', 'beneficiaries_count', 'budget_usd'])
        );

        return $record;
    }
}
