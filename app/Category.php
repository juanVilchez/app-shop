<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Category;

class Category extends Model
{

    use SoftDeletes;

	public static $messages = [
        'name.required' => 'Ingrese una categoría',
        'name.min' => 'El nombre de la categoría debe tener al menos 3 caracteres',
        'description.max' => 'Máximo 250 caracteres para el campo descripción',
    ];
    public static $rules = [
        'name' => 'required|min:3',
        'description' => 'max:200',
    ];
	protected $fillable = ['name','description'];

    // $category->$products
    public function products()
    {
    	return $this->hasmany(Product::class);
    }

    public function getFeaturedImageUrlAttribute()
    {
        $featureProduct = $this->products()->first();
        return $featureProduct->featured_image_url;
    }
}
