<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use App\Models\HomeSetting;
use Illuminate\Http\Request;

class ContactPageController extends Controller
{
    public function index(Request $request)
    {
        // ── Banner data ─────────────────────────────────────────
        $bannerSettings = HomeSetting::whereIn('key', [
            'contact_banner_image',
            'contact_banner_overlay_color',
            'contact_banner_badge',
            'contact_banner_title',
            'contact_banner_subtitle',
            'contact_banner_btn1_text',
            'contact_banner_btn1_url',
            'contact_banner_btn2_text',
            'contact_banner_btn2_url',
        ])->pluck('value', 'key');

        // ── Inquiries data ─────────────────────────────────────
        $query = ContactInquiry::query();

        if ($name = $request->input('name')) {
            $query->where('Name', 'like', "%{$name}%");
        }

        if ($status = $request->input('status')) {
            $query->where('Status', $status);
        }

        if ($entity = $request->input('entity')) {
            $query->where('TargetEntity', $entity);
        }

        $inquiries = $query->latest('ReceivedDate')->paginate(8);

        return view('admin.contact-page.index', [
            'bannerSettings' => $bannerSettings,
            'inquiries'      => $inquiries,
        ]);
    }
}
