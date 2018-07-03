<?php

namespace Softce\Banner\Http\Controllers;

use Mage2\Ecommerce\Http\Controllers\Admin\AdminController;
use Softce\Banner\Http\Requests\BannerRequest;
use Softce\Banner\Module\Banner;
use File;
use DB;

class BannerController extends AdminController
{

    private $path_banner = '';

    public function __construct()
    {
        $this->middleware(['admin.auth']);
        $this->path_banner = 'uploads/banner';
    }

    /**
     * Show list banner
     */
    public function index()
    {
        return view('banner::admin-banner')
            ->with('models', Banner::all())
            ->with('path_banner', $this->path_banner);
    }

    /**
     * Create new banner
     * @param BannerRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BannerRequest $request)
    {
        $new_banner = $request->file('new_banner');

        if($new_banner) {
            foreach($new_banner as $banner) {
                $name_file = $banner->getClientOriginalName();
                $banner->move(public_path($this->path_banner), $name_file);
                Banner::create([
                    'path' => $name_file
                ]);
            }

            return redirect()->route('admin.banner.index')->with('notificationText', 'Банер(ы) успешно добавлен(ы)');
        }

        return redirect()->route('admin.banner.index')->with('errorText', 'Для создания банер(а/ов) нужно изображение');
    }

    /**
     * Update banner
     * @param BannerRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BannerRequest $request, $id)
    {
        $banner = Banner::find($id);
        $data = $request->except(['_token', 'banner']);
        if($banner){
            $new_banner = $request->file('banner');

            if($new_banner){
                File::delete(public_path($this->path_banner.'/'.$banner->path));

                $name_file = $new_banner->getClientOriginalName();
                $new_banner->move(public_path($this->path_banner), $name_file);
                $data['path'] = $name_file;
            }

            $banner->update($data);

            return redirect()->route('admin.banner.index')->with('notificationText', 'Банер успешно обновлен');
        }
        return redirect()->route('admin.banner.index')->with('errorText', 'Ошибка обновления банера. Повторите запрос позже!!!');
    }

    /**
     * Delete banner
     * @param $id_banner
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id_banner)
    {
        $banner = Banner::find($id_banner);
        if($banner){
            File::delete(public_path($this->path_banner.'/'.$banner->path));
            $banner->delete();
            return redirect()->route('admin.banner.index')->with('notificationText', 'Банер успешно удален');
        }
        return redirect()->route('admin.banner.index')->with('errorText', 'Ошибка удаления банера. Повторите запрос позже!!!');
    }

}