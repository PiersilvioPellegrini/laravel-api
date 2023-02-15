<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  use HasFactory;

  protected  $fillable = ["name", "img_cover", "description", "link_project", "creation_date","type_id"];

  public function types()
  {
    return $this->hasMany(Type::class);
  }

  public function technologies(){
    return $this->belongsToMany(Technology::class);
  }
}
