<?php

namespace App\Filament\Resources\Events\Pages;

use App\Filament\Resources\Events\EventResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class EditEvent extends EditRecord
{
    protected static string $resource = EventResource::class;

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
            'title'          => $content->title,
            'slug'           => $content->slug,
            'publish_status' => $content->status,
            'excerpt'        => $content->excerpt,
            'body'           => $content->body,
            'featured_image' => $content->featured_image,
            'published_at'   => $content->published_at,
            'categories'     => $content->categories->pluck('id')->toArray(),
        ]);
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->content->update([
            'title'          => $data['title'],
            'slug'           => $data['slug'],
            'status'         => $data['publish_status'] ?? 'draft',
            'excerpt'        => $data['excerpt'] ?? null,
            'body'           => $data['body'] ?? null,
            'featured_image' => $data['featured_image'] ?? null,
            'published_at'   => $data['published_at'] ?? null,
        ]);

        $record->content->categories()->sync($data['categories'] ?? []);

        $record->update(
            Arr::only($data, ['event_date', 'end_date', 'venue', 'district', 'registration_url', 'capacity'])
        );

        return $record;
    }
}
