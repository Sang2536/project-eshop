<?php
namespace App\Helpers;

use App\Models\Config ;
use Illuminate\Support\Facades\Gate;

class SettingHelper
{
    public function checkUserPermissions() {
        //  Authentication
        if(!auth()->check()) {
            return redirect()->route('login.layout');
        }

        //  Authorization
        if (Gate::allows('administrator')) {
            abort(403, 'Action is not allowed!');
        }

        return true;
    }

    public function getConfig($id = null) : Object {
        $permissions = $this->checkUserPermissions();

        $config = Config::findOrFail(1);

        return $config;
    }

    public function updateConfig($id, $input) : Object {
        $permissions = $this->checkUserPermissions();

        $background = [
            'bg_color' => $input['bg_color'],
            'bg_image' => $input['bg_image'],
        ];
        $font = [
            'font_family' => $input['font_family'],
        ];

        $config = $this->getConfig($id);
        $config->name = $input['name'];
        $config->name = $input['logo'];
        $config->name = $input['logo_icon'];
        $config->status = $input['status'];
        $config->description = $input['description'];
        $config->background = $background;
        $config->font = $font;
        $config->save();

        return $config;
    }
}
