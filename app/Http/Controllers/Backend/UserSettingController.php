<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UserSettingStoreRequest;
use App\Http\Requests\Backend\UserSettingUpdateRequest;
use App\Models\Backend\UserSetting;
use Illuminate\Http\Request;

class UserSettingController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userSettings = UserSetting::all();

        return view('userSetting.index', compact('userSettings'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('userSetting.create');
    }

    /**
     * @param \App\Http\Requests\Backend\UserSettingStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserSettingStoreRequest $request)
    {
        $userSetting = UserSetting::create($request->validated());

        $request->session()->flash('userSetting.id', $userSetting->id);

        return redirect()->route('userSetting.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Backend\UserSetting $userSetting
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, UserSetting $userSetting)
    {
        return view('userSetting.show', compact('userSetting'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Backend\UserSetting $userSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, UserSetting $userSetting)
    {
        return view('userSetting.edit', compact('userSetting'));
    }

    /**
     * @param \App\Http\Requests\Backend\UserSettingUpdateRequest $request
     * @param \App\Models\Backend\UserSetting $userSetting
     * @return \Illuminate\Http\Response
     */
    public function update(UserSettingUpdateRequest $request, UserSetting $userSetting)
    {
        $userSetting->update($request->validated());

        $request->session()->flash('userSetting.id', $userSetting->id);

        return redirect()->route('userSetting.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Backend\UserSetting $userSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, UserSetting $userSetting)
    {
        $userSetting->delete();

        return redirect()->route('userSetting.index');
    }
}
