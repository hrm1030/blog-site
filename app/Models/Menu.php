<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['name', 'title','pid', 'url', 'description', 'order_num'];

    public function childs() {
        return $this->hasMany('App\Models\Menu','pid','id') ;
    }

    public static function get_children ($pmenu) {
        $children = Menu::where('pid', $pmenu->id)->orderBy('order_num', 'asc')->get();
        // die(print_r($children[0]->name));
        $new_pmenu = array(
            "id"=>$pmenu->id,
            "name"=> $pmenu->name,
            "title"=> $pmenu->title,
            "pid"=> $pmenu->pid,
            "order_num"=> $pmenu->order_num,
            "description" => $pmenu->description,
            "children"=> $children
        );
        // die(print_r($new_pmenu['name']));
        return $new_pmenu;
    }
}
