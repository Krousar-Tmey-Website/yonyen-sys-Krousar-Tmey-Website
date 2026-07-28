<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Moves the long-form category descriptions that used to live in a hardcoded
     * $staticDescriptions array inside involved.blade.php into the `description`
     * column, now that PartnershipCategory exposes it through the admin CRUD +
     * CKEditor — so the public page keeps showing the same text once the Blade
     * template stops special-casing these names.
     */
    protected array $descriptions = [
        'Organizations from associative sector' =>
            '<p><strong>Associations/ local NGOs</strong></p>
            <p>Can be of any size, from the small local association benefiting from a local fort, to the professional NGO (basic organizations that have structured and professionalized).</p>
            <p><strong>Platforms/ thematic networks (locals)</strong></p>
            <p>The thematic platforms or networks are clusters of local and / or international NGOs working on specific fields and / or international and UN agencies. They are places of reflection, exchange of practices and experiences and pooling of the stakes in targeted fields, in order to define strategies and actions to raise awareness and advocate with stakeholders.</p>
            <p><strong>NGOs or local branches of international organizations</strong></p>
            <p>A partnership with these international organizations and bilateral and multilateral agencies (eg United Nations Agencies or European Union) can be developed from Cambodia or Europe.</p>',

        'Local education structures' =>
            '<p><strong>Research institutes</strong></p>
            <p>Les ONG et les chercheurs, du fait de cultures professionnelles tr&egrave;s diff&eacute;rentes, n&rsquo;ont a priori ni les m&ecirc;mes int&eacute;r&ecirc;ts, ni les m&ecirc;mes connaissances de la r&eacute;alit&eacute; terrain ou de la d&eacute;marche scientifique. Cependant, il y a, du c&ocirc;t&eacute; de la recherche comme celui des ONG, une volont&eacute; et des int&eacute;r&ecirc;ts &agrave; coop&eacute;rer pour am&eacute;liorer de part et d&rsquo;autre l&rsquo;efficacit&eacute;, l&rsquo;ancrage terrain, la connaissance et le plaidoyer.</p>
            <p><strong>Universities / Training institutes</strong></p>
            <p>Due to very different professional cultures, NGOs and researchers have neither the same interests nor the same knowledge of the field reality or the scientific approach at first glance. However, there is both willingness and interest on the part of researchers and NGOs to work together to improve effectiveness, anchoring, knowledge and advocacy.</p>',

        'Public services' =>
            '<p><strong>Centralized or decentralized state services</strong></p>
            <p>Local services related to Krousar Thmey fields of intervention (inclusive education and child welfare) can be relevant partners in experimenting and disseminating good practice at the local level. Collaboration with the decision-making level (Ministry of Education / Ministry of Social Affairs, for example) should allow scaling up at a provincial or even national level.</p>
            <p><strong>Local authorities</strong></p>
            <p>Municipalities, districts or provinces have often defined policies of international solidarity cooperation with substantial financing. They also undertake a project selection procedure.</p>',

        'Companies and foundations from private sector' =>
            '<p><strong>Companies</strong></p>
            <p>Beside the financial aspect of a partnership with the economic sector, it can also allow empowering the employees of Krousar Thmey. In addition, it can also involve volunteering by the company&rsquo;s employees, such as Khmer or English classes.</p>
            <p><strong>Foundations</strong></p>
            <p>The requirement level of some foundations has reached an almost equivalent level of international donors. They are increasingly interested in committing not only financially but also technically to projects with long-term impact.</p>',
    ];

    public function up(): void
    {
        foreach ($this->descriptions as $name => $description) {
            DB::table('partnership_categories')->where('name', $name)->update(['description' => $description]);
        }
    }

    public function down(): void
    {
        foreach (array_keys($this->descriptions) as $name) {
            DB::table('partnership_categories')->where('name', $name)->update(['description' => null]);
        }
    }
};
