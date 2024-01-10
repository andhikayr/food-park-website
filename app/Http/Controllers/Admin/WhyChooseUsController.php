<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WhyChooseUsRequest;
use App\Models\SectionTitle;
use App\Models\WhyChooseUs;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class WhyChooseUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $keys = ['why_choose_top_title', 'why_choose_main_title', 'why_choose_sub_title'];
        $titles = SectionTitle::whereIn('key', $keys)->pluck('value', 'key');
        $WhyChooseUs = WhyChooseUs::latest()->get();
        return view('admin.why-choose-us.index', compact('titles', 'WhyChooseUs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('admin.why-choose-us.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WhyChooseUsRequest $request) : RedirectResponse
    {
        WhyChooseUs::create([
            'icon' => $request->icon,
            'title' => $request->title,
            'short_description' => $request->short_description
        ]);

        Alert::success('Sukses', 'Data berhasil ditambahkan');
        return to_route('admin.why-choose-us.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
        $WhyChooseUs = WhyChooseUs::findOrFail($id);
        return view('admin.why-choose-us.edit', compact('WhyChooseUs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WhyChooseUsRequest $request, string $id)
    {
        $WhyChooseUs = WhyChooseUs::findOrFail($id);
        $WhyChooseUs->update([
            'icon' => $request->icon,
            'title' => $request->title,
            'short_description' => $request->short_description
        ]);

        Alert::success('Sukses', 'Data berhasil diubah');
        return to_route('admin.why-choose-us.index');
    }

    public function updateTitle(Request $request) : RedirectResponse {
        $request->validate([
            'why_choose_top_title' => 'max:255',
            'why_choose_main_title' => 'max:255',
            'why_choose_sub_title' => 'max:255'
        ]);

        SectionTitle::updateOrCreate(
            ['key' => 'why_choose_top_title'],
            ['value' => $request->why_choose_top_title]
        );

        SectionTitle::updateOrCreate(
            ['key' => 'why_choose_main_title'],
            ['value' => $request->why_choose_main_title]
        );

        SectionTitle::updateOrCreate(
            ['key' => 'why_choose_sub_title'],
            ['value' => $request->why_choose_sub_title]
        );

        Alert::success('Sukses', 'Judul "Mengapa Memilih Kita" sudah berhasil disimpan');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $WhyChooseUs = WhyChooseUs::findOrFail($id);
            $WhyChooseUs->delete();

            Alert::success('Sukses', 'Data telah berhasil dihapus');
            return response(['status' => 'success', 'message' => 'Data telah berhasil dihapus']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
