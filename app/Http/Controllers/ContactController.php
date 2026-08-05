<?php

namespace App\Http\Controllers;

use App\Mail\ContactInquiryMail;
use App\Models\ContactInquiry;
use App\Models\HomeSetting;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class ContactController extends Controller
{
    public function show()
    {
        $offices = Office::active()->get();

        $settings = HomeSetting::allKeyed();

        $contactBannerImage = $settings['contact_banner_image'] ?? '';
        $contactBannerOverlayColor = HomeSetting::colorValue($settings['contact_banner_overlay_color'] ?? null, '#1d4e7a');
        $contactBannerBadge = $settings['contact_banner_badge'] ?? 'Support Our Work';
        $contactBannerTitle = $settings['contact_banner_title'] ?? 'Make a Difference Today';
        $contactBannerSubtitle = $settings['contact_banner_subtitle'] ?? 'Every contribution goes directly to supporting children across Cambodia. 100% of funds reach the children.';

        $contactBannerBtn1Text = $settings['contact_banner_btn1_text'] ?? 'Donate Now';
        $contactBannerBtn1Url = $settings['contact_banner_btn1_url'] ?? '/donate';
        $contactBannerBtn2Text = $settings['contact_banner_btn2_text'] ?? 'Get Involved';
        $contactBannerBtn2Url = $settings['contact_banner_btn2_url'] ?? '/get-involved';

        if (app()->getLocale() === 'fr') {
            if (!empty($settings['contact_banner_badge_fr'])) {
                $contactBannerBadge = $settings['contact_banner_badge_fr'];
            }
            if (!empty($settings['contact_banner_title_fr'])) {
                $contactBannerTitle = $settings['contact_banner_title_fr'];
            }
            if (!empty($settings['contact_banner_subtitle_fr'])) {
                $contactBannerSubtitle = $settings['contact_banner_subtitle_fr'];
            }
            if (!empty($settings['contact_banner_btn1_text_fr'])) {
                $contactBannerBtn1Text = $settings['contact_banner_btn1_text_fr'];
            }
            if (!empty($settings['contact_banner_btn2_text_fr'])) {
                $contactBannerBtn2Text = $settings['contact_banner_btn2_text_fr'];
            }
        }

        return view('contact', compact(
            'offices',
            'contactBannerImage',
            'contactBannerOverlayColor',
            'contactBannerBadge',
            'contactBannerTitle',
            'contactBannerSubtitle',
            'contactBannerBtn1Text',
            'contactBannerBtn1Url',
            'contactBannerBtn2Text',
            'contactBannerBtn2Url'
        ));
    }

    public function store(Request $request)
    {
        $officeCountries = Office::active()->pluck('country')->all();

        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name'  => ['required', 'string', 'max:100'],
            'email'      => ['required', 'email', 'max:255'],
            'organisation' => ['nullable', 'string', 'max:255'],
            'subject'    => ['required', 'string', 'max:200'],
            'message'    => ['required', 'string'],
            'consent'    => ['accepted'],
            'office'     => ['nullable', 'string', Rule::in($officeCountries)],
        ]);

        // Default to the first active office (lowest sort order) when no card was selected.
        $targetOffice = Office::active()->where('country', $data['office'] ?? null)->first()
            ?? Office::active()->first();

        ContactInquiry::create([
            'Name'         => $data['first_name'] . ' ' . $data['last_name'],
            'Email'        => $data['email'],
            'Subject'      => $data['subject'],
            'Message'      => $data['message'],
            'TargetEntity' => $targetOffice->country ?? 'Website',
        ]);

        if ($targetOffice && !empty($targetOffice->email)) {
            $mailData = [
                'name'          => $data['first_name'] . ' ' . $data['last_name'],
                'email'         => $data['email'],
                'organisation'  => $data['organisation'] ?? null,
                'subject'       => $data['subject'],
                'message'       => $data['message'],
                'office_country' => $targetOffice->country,
            ];

            try {
                Mail::to($targetOffice->email)->send(new ContactInquiryMail($mailData));
            } catch (\Throwable $e) {
                // The enquiry is already saved above, so a mail outage never loses the
                // submission — it just won't reach the office inbox until this is retried.
                Log::error('Failed to send contact inquiry email', [
                    'office' => $targetOffice->country,
                    'error'  => $e->getMessage(),
                ]);
            }
        }

        return back()->with('success', 'Thank you for reaching out! Your message has been sent successfully, and we will be in touch soon.');
    }
}
