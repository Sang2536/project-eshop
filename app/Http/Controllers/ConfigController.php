<?php

namespace App\Http\Controllers;

use App\Helpers\SettingHelper;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    protected $settingHelper;

    public function __construct(SettingHelper $settingHelper)
    {
        $this->settingHelper = $settingHelper;
    }

    public function index()
    {
        $check = $this->settingHelper->checkUserPermissions();
        $config = $this->settingHelper->getConfig();

        return view('configs/index')->with(['config' => $config]);
    }

    public function update(Request $request, $id)
    {
        $check = $this->settingHelper->checkUserPermissions();

        try {
            $input = $request->only(['name', 'status', 'logo', 'logo_icon', 'description', 'bg_color', 'bg_image', 'font_family']);

            $config = $this->settingHelper->updateConfig($id, $input);
        } catch (\Throwable $th) {
            abort(403, 'File ' . $th->getFile() . ' in line ' . $th->getLine() . '. Error ' . $th->getMessage());
        }
    }
}
