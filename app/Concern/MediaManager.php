<?php

namespace App\Concern;

use Illuminate\Support\Facades\Storage;
use App\Models\Media;

class MediaManager
{
    protected $disk;

    public function __construct($disk = 'public')
    {
        $this->disk = $disk;
    }

    public function upload($file, $name = null, $model = null, $disk = null, $uploadPath = null): Media
    {
        $selectedDisk = $disk ?: $this->disk;

        // Définir un nom unique si aucun n'est fourni
        $fileName = $name ?: $file->getClientOriginalName();
        $path = $file->storeAs($uploadPath ?: 'media', $fileName, $selectedDisk);

        // Créer une entrée en base de données
        $media = new Media([
            'name' => $fileName,
            'file_name' => $path,
            'mime_type' => $file->getClientMimeType(),
            'disk' => $selectedDisk,
            'file_properties' => json_encode([
                'size' => $file->getSize(),
                'original_name' => $file->getClientOriginalName(),
            ]),
            'model_type' => $model ? get_class($model) : null,
            'model_id' => $model ? $model->id : null,
        ]);

        // Si un modèle est fourni, associer le média à ce modèle
        if ($model) {
            $model->media()->save($media);
        } else {
            $media->save();
        }

        return $media;
    }

    public function delete(Media $media): bool
    {
        // Supprimer le fichier du disque
        if (Storage::disk($media->disk)->exists($media->file_name)) {
            Storage::disk($media->disk)->delete($media->file_name);
        }

        // Supprimer l'entrée de la base de données
        return $media->delete();
    }

    public function getUrl(Media $media, string $postSlug = null): string
    {
        if ($media->disk === 'private') {
            // Assurez-vous que le postSlug est fourni
            if (!$postSlug) {
                throw new \Exception("Le postSlug est requis pour générer l'URL d'une image privée.");
            }
            return route('image.private', ['postSlug' => $postSlug, 'filename' => $media->file_name]);
        }

        return Storage::disk($media->disk)->url($media->file_name);
    }
}