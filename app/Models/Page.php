<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;
use App\Models\Page;


class Page extends Model{
    use SoftDeletes;
    protected $appends = ['page_image'];
    protected $guarded = [];
    protected $dateFormat = 'Y-m-d\TH:i';
    protected $table = 'pages';

    /**
     * Perform any actions required after the model boots.
     * @return void
     */
    protected static function booted(){
        static::deleting(function ($page) { // before delete() method call this
            if ($page->isForceDeleting()) {
                if (File::exists(public_path('/storage/uploads/' . $page->image))) {
                    File::delete(public_path('/storage/uploads/' . $page->image));
                }
            }
        });
    }

    public function getPageImageAttribute(){
        if ($this->image != null) {
            return url('storage/uploads/' . $this->image);
        }
        return NULL;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
