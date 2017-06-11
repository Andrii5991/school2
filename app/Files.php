<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Files extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'url',
        'filename',
        'filemime',
        'filesize',
    ];

    /**
     * @param $data
     * @return mixed|null
     */
    public function set($data = null)
    {
        if (!isset($data)) {
            return null;
        }

        $filename = $data->getClientOriginalName();
        $this->filename = $filename;
        $this->filemime = $data->getClientMimeType();
        $this->filesize = $data->getSize();

        $data->storeAs('files', $filename, 'public');

        $this->url = Storage::url($filename);

        $this->save();

        return $this->id;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get($id = null)
    {
        if (is_null($id)) {
//            return response()->download(public_path("storage/files/{$this->filename}"));
            return Storage::disk('public')->url("files/{$this->filename}");
        }

        $file = $this->find($id);
//            return response()->download(public_path("storage/files/{$file->filename}"));
        return Storage::disk('public')->url("files/{$file->filename}");
    }

    /**
     * @return bool|null
     */
    public function del()
    {
        Storage::disk('public')->delete('files/' . $this->filename);

        return $this->delete();
    }
}
