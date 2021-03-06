<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Models\Media;

class MediaRepository extends EloquentRepository
{
    public function model()
    {
        return \App\Models\Media::class;
    }

    public function findImage($id)
    {
        $data = Media::find($id);
        if ($data == null) {
            return false;
        } else {
            return $data;
        }
    }

    public function storeFileUpload($request)
    {
        $fileName = uniqid() . '.' . $request->image->extension();
        $path = $request->image->storeAs('images', $fileName);
        $img = [
            'name' => $fileName,
            'slug' => str_slug($fileName),
            'link_url' => $path,
        ];
        $image = $this->model->create($img);

        return $image;
    }

    public function updateFileUpload($media_id, $request)
    {
        $tmp = $request->all();
        $fileName = uniqid() . '.' . $tmp['image']->extension();
        $path = $tmp['image']->storeAs('images', $fileName);
        $img = [
            'name' => $fileName,
            'slug' => str_slug($fileName),
            'link_url' => $path,
        ];
        $image = $this->update($media_id, $img);

        return $image;
    }

    public function listAllImage()
    {
        return Media::all();
    }
}
