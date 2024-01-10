<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SectionTitle;
use App\Models\Slider;
use App\Models\WhyChooseUs;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class FrontendController extends Controller
{
    public function index(): View
    {
        $sliders = Slider::where('status', 1)->get();
        $sectionTitles = $this->getSectionTitles();
        $WhyChooseUs = WhyChooseUs::where('status', 1)->get();
        return view('index', compact('sliders', 'sectionTitles', 'WhyChooseUs'));
    }

    public function getSectionTitles(): Collection
    {
        $keys = [
            'why_choose_top_title',
            'why_choose_main_title',
            'why_choose_sub_title'
        ];

        return SectionTitle::whereIn('key', $keys)->pluck('value', 'key');
    }
}
