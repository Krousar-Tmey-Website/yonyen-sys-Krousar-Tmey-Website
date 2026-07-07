<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    /**
     * Display partner list
     */
    public function index()
    {
        $partners = Partner::orderBy('category')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->groupBy('category');


        return view('admin.partners.index', compact('partners'));
    }



    /**
     * Store new partner
     */
    public function store(Request $request)
    {
        $data = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'category' => [
                'required',
                'in:authorities,organizations,companies,towns'
            ],

            'country' => [
                'nullable',
                'string',
                'max:100'
            ],

            'sort_order' => [
                'nullable',
                'integer'
            ],

            'logo' => [
                'nullable',
                'image',
                'mimes:png,jpg,jpeg,webp',
                'max:2048'
            ],

        ]);



        // Upload logo
        if ($request->hasFile('logo')) {

            $data['logo'] = $request->file('logo')
                ->store('partners', 'public');
        }



        $data['sort_order'] = $data['sort_order'] ?? 0;


        $data['is_active'] = true;

        Partner::create($data);



        return redirect()
            ->route('admin.partners.index')
            ->with('success', 'Partner added successfully.');
    }

    /**
     * Show edit form
     */
    public function edit(Partner $partner)
    {

        $partners = Partner::orderBy('category')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->groupBy('category');


        return view('admin.partners.index', [

            'partners' => $partners,

            'editPartner' => $partner

        ]);
    }





    /**
     * Update partner
     */
    public function update(Request $request, Partner $partner)
    {

        $data = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255'
            ],


            'category' => [
                'required',
                'in:authorities,organizations,companies,towns'
            ],


            'country' => [
                'nullable',
                'string',
                'max:100'
            ],


            'sort_order' => [
                'nullable',
                'integer'
            ],


            'is_active' => [
                'nullable',
                'boolean'
            ],


            'logo' => [
                'nullable',
                'image',
                'mimes:png,jpg,jpeg,webp',
                'max:2048'
            ],

        ]);




        // Update logo
        if ($request->hasFile('logo')) {


            // Delete old logo
            if ($partner->logo) {

                Storage::disk('public')
                    ->delete($partner->logo);
            }



            $data['logo'] = $request->file('logo')
                ->store('partners', 'public');
        }





        $data['is_active'] = $request->boolean('is_active');

        $data['sort_order'] = $data['sort_order'] ?? 0;




        $partner->update($data);




        return redirect()
            ->route('admin.partners.index')
            ->with('success', 'Partner updated successfully.');
    }





    /**
     * Delete partner
     */
    public function destroy(Partner $partner)
    {


        // Delete logo file
        if ($partner->logo) {


            Storage::disk('public')
                ->delete($partner->logo);
        }



        $partner->delete();



        return redirect()
            ->route('admin.partners.index')
            ->with('success', 'Partner removed successfully.');
    }
}
