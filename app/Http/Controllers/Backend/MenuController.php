<?php

namespace App\Http\Controllers\Backend;

use App\Models\Config;
use App\Models\Category;
use App\Models\Page;
use Harimayco\Menu\Models\MenuItems;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Harimayco\Menu\Facades\Menu;
use App\Http\Requests;
use Harimayco\Menu\Models\Menus;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MenuController extends Controller{

    public function index(Request $request){
        Log::info('menuController - index');
    
        // Fetch all menu items with menu = 1
        $menuItems = DB::table('admin_menu_items')->where('menu', 1)->get(['label']);
    
        // Log menu item labels
        $menuLabels = $menuItems->pluck('label')->toArray();
        Log::info('Menu Item Labels:', ['labels' => $menuLabels]);
    
        $menu = null;
        $menu_data = null;
    
        if ($request->menu) {
            $menu = Menus::find($request->menu);
    
            if ($menu !== null) {
                $menu_data = json_decode($menu->value);
    
                // Log menu data
                \Log::info('Menu Data:', ['menu_data' => $menu_data]);
            } else {
                // Handle the case where the menu is not found
                // For example, redirect to the home page:
                return redirect('/');
            }
        }
    
        $menu_list = Menus::get();
        $pages = Page::where('published', '=', 1)->get();
    
        // Provide a default value for $menu
        $menu = $menu ?: new \stdClass;
    
        return view('backend.menu-manager.index', compact('menu', 'menu_data', 'menu_list', 'pages'));
    }

    public function create(Request $request){
        $this->validate($request, [
            'menu_name' => ' required'
        ]);

        //Fetching Menu JSON
        $menu_list = \App\Models\Config::where('key', '=', 'menu_list')->first();
        $add_data = "";
        $menu_name = str_replace(array('\'', '"'), '', $request->menu_name);
        $menus = json_decode($menu_list->value);

        //======Checking if menu exist, adding if doesn't exist======//
        if (!$menus) {
            $new_menu_data = json_encode(['menu_name' => $menu_name]);
            $new_menu = new Config();
            $new_menu->key = str_slug($menu_name);
            $new_menu->value = $new_menu_data;
            $new_menu->save();
            $add_data = ["id" => $new_menu->id, "name" => str_slug($menu_name)];
        } else {
            foreach ($menus as $item) {
                if (str_slug($menu_name) == str_slug($item->name)) {
                    return back()->withFlashDanger(__('alerts.backend.menu-manager.exist'));
                } else {
                    $new_menu_data = json_encode(['menu_name' => $menu_name]);
                    $new_menu = new Config();
                    $new_menu->key = str_slug($menu_name);
                    $new_menu->value = $new_menu_data;
                    $new_menu->save();
                    $add_data = ["id" => $new_menu->id, "name" => str_slug($menu_name)];
                }
            }
        }

        //======Updating Menu JSON======//
        $menus[] = $add_data;
        $menu_list->value = json_encode($menus);
        $menu_list->save();

        return redirect(route('admin.menu-manager') . '?menu=' . $new_menu->id)->with('')->withFlashSuccess(__('alerts.backend.menu-manager.created'));
    }

    public function update(Request $request){
        $this->validate($request, [
            'menu_name' => ' required'
        ]);
        $menu = Config::findOrFail($request->menu_id);
        if ($menu) {
            $menu_data = json_decode($menu->value);
            if (str_slug($menu_data->menu_name) != str_slug($request->menu_name)) {
                $menu_data->menu_name = str_slug($request->menu_name);
                $menu->value = json_encode($menu_data);
                $menu->save();
                return redirect(route('admin.menu-manager') . '?menu=' . $menu->id)->with('')->withFlashSuccess(__('alerts.backend.menu-manager.updated'));
            } else {
                return redirect(route('admin.menu-manager') . '?menu=' . $menu->id)->with('')->withFlashSuccess(__('alerts.backend.menu-manager.exist'));
            }
        }
    }

    public function delete(Request $request){
        $menu = Config::findOrFail($request->id);
        $menu_list = Config::where('key', '=', 'menu_list')->first();
        $menu_items = json_decode($menu_list->value);
        $menu_new = array();
        foreach ($menu_items as $item) {
            if ((int)$request->id != (int)$item->id) {
                $menu_new[] = $item;
            }
        }
        if (empty($menu_new)) {
            $menu_list->value = '{""}';
        } else {
            $menu_list->value = json_encode($menu_new);
        }
        $menu_list->save();
        $menu->delete();
        return redirect(route('admin.menu-manager'))->withFlashSuccess(__('alerts.backend.menu-manager.deleted'));

    }

    public function saveCustomMenu(Request $request){
        Log::info('saveCustomMenu function');
    
        foreach ($request->data as $item) {
            try {
                Log::info('Item Data: ' . json_encode($item));
    
                $menuitem = new MenuItems();
                $menuitem->label = $item['labelmenu'];
                Log::info('Menu Item Label: ' . $menuitem->label);
    
                $menuitem->menu = 1;
    
                // Generate a slug from the label
                $slug = Str::slug($item['labelmenu']);
                $menuitem->link = $item['link'] . '/' . $slug;
                Log::info('Formed Link: ' . $menuitem->link);
    
                $menuitem->sort = MenuItems::getNextSortRoot($menuitem->menu);
                $menuitem->save();
    
                // Log success message
                Log::info('Menu Item Added Successfully!');
    
            } catch (\Exception $e) {
                // Log any exceptions that might occur
                Log::error('Exception: ' . $e->getMessage());
            }
        }
    }

    public function createnewmenu(){
        $menu = new Menus();
        $menu->name = str_slug(request()->input("menuname"));
        $menu->save();
        return json_encode(array("resp" => $menu->id));
    }

    public function deleteitemmenu(){
        $menuitem = MenuItems::find(request()->input("id"));
        $menuitem->delete();
    }

    public function deletemenug(){
        $menus = new MenuItems();
        $getall = $menus->getall(request()->input("id"));
        if (count($getall) == 0) {
            $menudelete = Menus::find(request()->input("id"));
            $menudelete->delete();

            return json_encode(array("resp" => "you delete this item"));
        } else {
            return json_encode(array("resp" => "You have to delete all items first", "error" => 1));

        }
    }

    public function updateItem(){
        Log::info('updateItem function');
        $arraydata = request()->input("arraydata");
    
        if (is_array($arraydata)) {
            foreach ($arraydata as $value) {
                $menuitem = MenuItems::find($value['id']);
                if ($menuitem) { 
                    $menuitem->label = $value['label'];
                    $menuitem->link = $value['link'];
                    $menuitem->class = isset($value['class']) ? $value['class'] : null;
                    $menuitem->save();
                }
            }
        } else {
            $menuitem = MenuItems::find(request()->input("id"));
            if ($menuitem) { 
                $menuitem->label = request()->input("label");
                $menuitem->link = request()->input("url");
                $menuitem->class = request()->input("class");
                $menuitem->save();
            }
        }
    }

    public function addcustommenu(){
        $menuitem = new MenuItems();
        $menuitem->label = request()->input("labelmenu");
        $menuitem->link = request()->input("linkmenu");
        $menuitem->menu = request()->input("idmenu"); 
     // $menuitem->type = __('strings.backend.menu_manager.link');
        $menuitem->sort = MenuItems::getNextSortRoot(request()->input("idmenu"));
        $menuitem->save();

    }

    public function generatemenucontrol(Request $request){
        $main = NULL;
        $menu = Menus::find(request()->input("idmenu"));
        $menu_bag_data = MenuItems::where('menu', '=', $menu)->get();
        $menu->name = str_slug(request()->input("menuname"));
        $menu->save();
        $value = 0;
        if (request('meta')[0]['nav_menu'] == 'true') {
            $value = $menu->id;
        } else {
            $value = 0;
        }
        $config = \App\Models\Config::where('key', '=', 'nav_menu')->first();
        $config->value = $value;
        $config->save();

        if (is_array(request()->input("arraydata"))) {
            foreach (request()->input("arraydata") as $value) {
                $menuitem = MenuItems::find($value["id"]);
                $menuitem->parent = $value["parent"];
                $menuitem->sort = $value["sort"];
                $menuitem->depth = $value["depth"];
                $menuitem->save();
            }
        }
        $menus = \Harimayco\Menu\Models\Menus::all();
        foreach ($menus as $menu) {
            if ($menu != NULL) {
                $menuItems = \Harimayco\Menu\Models\MenuItems::where('menu', '=', $menu->id)->get();
                if ($menuItems != null) {
                    $allMenu = [];
                    foreach ($menuItems as $item) {
                        $allMenu[str_slug($item['label'])] = $item['label'];
                    }
                    $main[str_slug($menu->name)] = $allMenu;
                    $file = fopen(public_path('../resources/lang/en/custom-menu.php'), 'w');
                    if ($file !== false) {
                        ftruncate($file, 0);
                    }
                    fwrite($file, '<?php return ' . var_export($main, true) . ';');
                    Artisan::call('menu:import');
                }
            }
        }
        return json_encode(array("resp" => 1));
    }

    public function updateLocation(Request $request){
        $menu_list = \App\Models\Config::where('key', '=', 'menu_list')->first();
        $menu_bag = json_decode($menu_list->value);
        foreach ($menu_bag as $menu) {
            if ($menu->location == 'top_menu') {
                $menu->id = ($request->location_top_menu == "") ? 0 : $request->location_top_menu;
            } else if ($menu->location == 'footer_menu') {
                $menu->id = ($request->location_top_menu == "") ? 0 : $request->location_footer_menu;
            }
        }
        json_encode($menu_bag);
        $menu_list->value = json_encode($menu_bag);
        $menu_list->save();
        return back();
    }
}