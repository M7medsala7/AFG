<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class attribute extends Model
{
    public $table="attribute";
    public function getpackattribute()
    {
        return $this->belongsToMany('App\attribute','package_attribute','packages_id','attribute_id')
        ->withPivot('Valueyear')
        ->withPivot('Value')
        ->withTimestamps();
    }
    
}
