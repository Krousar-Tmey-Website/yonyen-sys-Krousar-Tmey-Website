@extends('layouts.app')

@section('title', 'Our Partners — Krousar Thmey')
@section('description', 'Krousar Thmey partners with organizations worldwide to support children in Cambodia. View all our partners and supporters.')

@section('content')

{{-- Bootstrap 5 + Bootstrap Icons, scoped to this page only --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<style>
    /* Contain Bootstrap's Reboot: it ships unlayered CSS, which always
       beats this project's Tailwind utilities (declared inside @layer),
       regardless of specificity. Restore the shared header/nav/footer
       outside this page's content wrapper to their original look. */
    a:not(.kt-partners a) {
        color: inherit !important;
        text-decoration: none !important;
    }

    .kt-partners { color: #333; font-size: 1rem; }
    .kt-partners h1, .kt-partners h2, .kt-partners h3 { color: #11568c; font-weight: 700; }
    .kt-partners .eyebrow {
        color: #11568c;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 1.1rem;
        letter-spacing: .02em;
        margin-bottom: 1rem;
    }
    .kt-partners .btn-kt-primary {
        background-color: #11568c;
        border-color: #11568c;
        color: #fff;
        font-weight: 600;
    }
    .kt-partners .btn-kt-primary:hover { background-color: #0d4370; border-color: #0d4370; color: #fff; }
    .kt-partners .btn-kt-outline {
        background-color: transparent;
        border: 1px solid #11568c;
        color: #11568c;
        font-weight: 600;
    }
    .kt-partners .btn-kt-outline:hover { background-color: #11568c; color: #fff; }
    .kt-partners .share-icon {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: .375rem;
        color: #fff;
        font-size: 1rem;
    }
    .kt-partners .partner-photo { object-fit: cover; width: 100%; height: 220px; }
    .kt-partners .cta-box { background-color: #f5f5f5; }
    .kt-partners .partner-logo-box { min-height: 130px; display: flex; align-items: center; justify-content: center; }
    .kt-partners .partner-logo-box img { max-height: 110px; max-width: 100%; object-fit: contain; }
    .kt-partners .list-plain { list-style: none; padding-left: 0; margin-bottom: 0; }
    .kt-partners .list-plain li { padding: .3rem 0; color: #555; }
    /* Tailwind also ships a utility literally named .collapse (visibility:collapse,
       for table rows). It collides with Bootstrap's .collapse (display toggle) and
       makes collapsed-but-shown content invisible. Force visibility back on. */
    .kt-partners .collapse.show { visibility: visible; }
    .kt-partners .accordion-button:not(.collapsed) { color: #11568c; background-color: #f5f5f5; box-shadow: none; }
    .kt-partners .accordion-button { font-weight: 700; color: #333; background-color: #f5f5f5; }
    .kt-partners .accordion-button:focus { box-shadow: none; border-color: rgba(0,0,0,.125); }
    .kt-partners .accordion-item { border-radius: 0; border-left: 0; border-right: 0; }
</style>

<div class="kt-partners bg-white">

    {{-- ========================================================
         PAGE HEADER
         ======================================================== --}}
    <div class="text-center pt-5 pb-4">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4" style="letter-spacing: .03em;">PARTNERS</h1>
            <div class="d-flex justify-content-center gap-2">
                <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.krousar-thmey.org/partners/" target="_blank" rel="noopener" class="share-icon" style="background-color:#1877f2;">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?url=https://www.krousar-thmey.org/partners/" target="_blank" rel="noopener" class="share-icon" style="background-color:#1da1f2;">
                    <i class="bi bi-twitter"></i>
                </a>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url=https://www.krousar-thmey.org/partners/" target="_blank" rel="noopener" class="share-icon" style="background-color:#0a66c2;">
                    <i class="bi bi-linkedin"></i>
                </a>
                <a href="#" class="share-icon" style="background-color:#11568c;">
                    <i class="bi bi-share-fill"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- ========================================================
         PARTNERSHIPS AROUND THE WORLD
         ======================================================== --}}
    <section class="py-5">
        <div class="container" style="max-width: 900px;">
            <h2 class="eyebrow">Partnerships Around The World</h2>
            <p>Since its creation, Krousar Thmey has set up long-term partnerships with Cambodian and international organizations.</p>
            <p>Donors can financially support a program or project of their choice.</p>
            <p>Technical partners allow us to benefit from specific expertise that Krousar Thmey does not have. Krousar Thmey always ensures that the projects implemented include a transfer of skills to the staff of the Foundation.</p>
            <p>Organizations, universities, institutions&hellip; many partners help Krousar Thmey&rsquo;s Academic and Career Counseling Project support young people in finding their path.</p>
            <a href="#financial-partners" class="btn btn-kt-outline px-4 py-2 mt-3">See all partners</a>
        </div>
    </section>

    {{-- ========================================================
         PARTNERSHIPS WITH THE CAMBODIAN AUTHORITIES
         ======================================================== --}}
    <section class="py-5">
        <div class="container" style="max-width: 900px;">
            <h2 class="eyebrow">Partnerships With The Cambodian Authorities</h2>
            <p>Krousar Thmey constantly seeks to develop and maintain lasting relations with the Cambodian authorities. In addition to greater recognition, it brings us legitimacy, notoriety to the Cambodian population as well as financial contributions.</p>
            <p>&laquo;&nbsp;Memorandums of understanding&nbsp;&raquo; are regularly renewed between Krousar Thmey and governing authorities:</p>
            <ul>
                <li>the Ministry of Education, Youth and Sport regarding the Education for Deaf or Blind Children Program</li>
                <li>the Ministry of Social Affairs regarding the Child Welfare Program</li>
                <li>the Ministry of Culture and Fine Arts regarding the Cultural and Artistic Development Program</li>
            </ul>
            <p>Whether for an inauguration or to show their support, H.M. the King, the Prime Minister and his wife, as well as members of the royal family, regularly visit Krousar Thmey&rsquo;s structures.</p>

            
            <div class="row align-items-center mt-4 g-4">
                <div class="col-auto mx-auto mx-sm-0">
                    <img src="{{ asset('images/partners/university.png') }}" alt="" width="110" height="110">
                </div>
                <div class="col">
                    <p class="mb-3">
                        From 2020 onwards, Krousar Thmey will work collaboratively with the Ministry of Education, Youth and Sport on the Education for Deaf or Blind Children Program.
                    </p>
                    <a href="{{ route('programs.show', 'special-education') }}" class="btn btn-kt-primary px-4 py-2">Know more</a>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================================================
         THANKS BANNER / GET INVOLVED
         ======================================================== --}}
    <section class="py-5">
        <div class="container" style="max-width: 1100px;">
            <h2 class="text-center h3 mb-4">Many thanks to all our partners for their support!</h2>
            <div class="row g-0">
                <div class="col-12 col-md-4">
                    <img src="{{ asset('images/partners/partner_image1.webp') }}" alt="" class="partner-photo">
                </div>
                <div class="col-12 col-md-4 cta-box d-flex flex-column align-items-center justify-content-center text-center p-4">
                    <p class="fw-bold mb-2" style="color:#11568c;">Do you wish to get involved with Krousar Thmey?</p>
                    <a href="{{ route('involved') }}" class="fw-semibold" style="color:#11568c;">Learn more</a>
                </div>
                <div class="col-12 col-md-4">
                    <img src="{{ asset('images/partners/partner_image2.webp') }}" alt="" class="partner-photo">
                </div>
            </div>
        </div>
    </section>

    {{-- ========================================================
         TECHNICAL PARTNERS
         ======================================================== --}}
    <section class="py-5">
        <div class="container" style="max-width: 900px;">
            <h2 class="eyebrow mb-5">Technical Partners</h2>
            <div class="row row-cols-2 row-cols-sm-3 g-4 mb-5">
                <div class="col">
                    <div class="partner-logo-box">
                        <img src="{{ asset('images/partners/partner1.webp') }}" alt="Enfants Sourds du Cambodge">
                    </div>
                </div>
                <div class="col">
                    <div class="partner-logo-box">
                        <img src="{{ asset('images/partners/partner2.webp') }}" alt="Friends International">
                    </div>
                </div>
                <div class="col">
                    <div class="partner-logo-box">
                        <img src="{{ asset('images/partners/partner3.webp') }}" alt="Deaf Development Programme">
                    </div>
                </div>
                <div class="col">
                    <div class="partner-logo-box">
                        <img src="{{ asset('images/partners/partner4.webp') }}" alt="Cambodian Living Arts">
                    </div>
                </div>
                <div class="col">
                    <div class="partner-logo-box">
                        <img src="{{ asset('images/partners/partner5.webp') }}" alt="Sipar">
                    </div>
                </div>
                <div class="col">
                    <div class="partner-logo-box">
                        <img src="{{ asset('images/partners/partner6.webp') }}" alt="Save the Children">
                    </div>
                </div>
            </div>
            <p class="text-muted small">
                Krousar Thmey develops partnerships with other local organizations to give access to the children supported by the Foundation to other activities.
            </p>
        </div>
    </section>

    {{-- ========================================================
         FINANCIAL PARTNERS
         ======================================================== --}}
    <section id="financial-partners" class="py-5">
        <div class="container" style="max-width: 900px;">
            <h2 class="eyebrow mb-4">Financial Partners</h2>

            {{-- Cambodian Public Authorities: always visible, no accordion --}}
            <div class="mb-2">
                <h3 class="h4 fw-bold text-dark mb-3">Cambodian Public Authorities</h3>
                <div class="row pb-4 border-bottom">
                    <div class="col-md-6">
                        <ul class="list-plain">
                            <li>His Majesty the King NORODOM Sihamoni</li>
                            <li>Prime Minister Samdech Moha Borvor Thipadei HUN Manet</li>
                            <li>Samdech Dr. Bun Rany HUN Sen</li>
                            <li>Ministry of Social Affairs</li>
                            <li>Ministry of Culture and Fine Arts</li>
                            <li>Ministry of Information</li>
                            <li>His Excellency the ambassador for Cambodia at UNESCO</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-plain">
                            <li>Her Majesty the Queen Mother NORODOM Monineath Sihanouk</li>
                            <li>Samdech Akka Moha Sena Padei Techo Hun Sen, President of the Senate</li>
                            <li>The Royal Government of Cambodia</li>
                            <li>Ministry of Education, Youth and Sport</li>
                            <li>Ministry of Defense</li>
                            <li>Ministry of Interior</li>
                            <li>His Excellency the ambassador for Cambodia to France</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Remaining groups: Bootstrap 5 native accordion (no Alpine, no loops) --}}
            <div class="accordion" id="financialPartnersAccordion">

                {{-- Organizations, Foundations and Institutions --}}
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOrganizations" aria-expanded="false" aria-controls="collapseOrganizations">
                            Organizations, Foundations and Institutions
                        </button>
                    </h2>
                    <div id="collapseOrganizations" class="accordion-collapse collapse" data-bs-parent="#financialPartnersAccordion">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-plain">
                                        <li>DUBRULLE Family</li>
                                        <li>Fondation Amanjaya</li>
                                        <li>Fondation Masalina</li>
                                        <li>Foundation Philantropique Famille Sandoz</li>
                                        <li>GREEN LEAVES EDUCATION Foundation</li>
                                        <li>Individual donor: Suzanne ROY, Grants Barbe.</li>
                                        <li>LA VOIX DE L&rsquo;ENFANT Association</li>
                                        <li>MAY-OUI Foundation</li>
                                        <li>Musica Felice</li>
                                        <li>PEOPLE&rsquo;S ACTION FOR INCLUSIVE DEVELOPMENT (PAfID)</li>
                                        <li>ROTARY CLUB OF PERTH</li>
                                        <li>STIFTUNG HIRTEN KINDER Foundation</li>
                                        <li>UNICEF</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-plain">
                                        <li>ENFANCE ESPOIR Foundation</li>
                                        <li>Fondation Andr&eacute; &amp; Cyprien</li>
                                        <li>Fonds M&eacute;c&eacute;nat SIG</li>
                                        <li>Gertrude Hirzel Foundation</li>
                                        <li>Individual donor: Peter Tschofen</li>
                                        <li>INTERNATIONAL COUNCIL FOR EDUCATION OF PEOPLE WITH VISUAL IMPAIRMENT (ICEVI)</li>
                                        <li>LES AMIS DES ENFANTS DU MONDE Association</li>
                                        <li>Miwako Fujiwara &ndash; Musica Felice Foundation</li>
                                        <li>OVERBROOK SCHOOL FOR THE BLIND (ONNET)</li>
                                        <li>Raksa Koma Organization</li>
                                        <li>ROTARY CLUB OF PHNOM PENH</li>
                                        <li>TALIKA</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Companies --}}
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCompanies" aria-expanded="false" aria-controls="collapseCompanies">
                            Companies
                        </button>
                    </h2>
                    <div id="collapseCompanies" class="accordion-collapse collapse" data-bs-parent="#financialPartnersAccordion">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-plain">
                                        <li>ABA BANK</li>
                                        <li>ANGKOR ARTWORK (Eric STOCKER)</li>
                                        <li>BRED BANK CAMBODIA</li>
                                        <li>BODIA NATURE</li>
                                        <li>CMDK</li>
                                        <li>KHMER CERAMICS &amp; FINE ARTS CENTER</li>
                                        <li>PROMOTION FOR DISABILITY PROJECT</li>
                                        <li>RADIO HAPPINESS VOICE FOR THE BLIND</li>
                                        <li>SEIN LIM</li>
                                        <li>SMART Cambodia</li>
                                        <li>SOFITEL Phnom Penh Phokeethra</li>
                                        <li>TEMPLATION ANGKOR BOUTIQUE</li>
                                        <li>TOP STREET RESTAURANT</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-plain">
                                        <li>AMANJAYA HOTEL</li>
                                        <li>BAJAJ INTRACITY</li>
                                        <li>BLIND MASSAGE CENTER</li>
                                        <li>CAMH Co. LTD</li>
                                        <li>D+Z URBAN HOTEL</li>
                                        <li>LONG RA Car mechanic</li>
                                        <li>PUNLEU THMEY Restaurant</li>
                                        <li>SAN FRANSISCO COMPANY</li>
                                        <li>SENG POV Car mechanic</li>
                                        <li>SOCIAL COFFEE</li>
                                        <li>SOFT SKILL PROFESSIONAL TRAINING SERVICE</li>
                                        <li>THALIAS (Malis Restaurant, Khema, Arunreas Hotel)</li>
                                        <li>VOICE OF THE BLIND Radio station</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Towns and Municipalities --}}
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTowns" aria-expanded="false" aria-controls="collapseTowns">
                            Towns and Municipalities
                        </button>
                    </h2>
                    <div id="collapseTowns" class="accordion-collapse collapse" data-bs-parent="#financialPartnersAccordion">
                        <div class="accordion-body">
                            <ul class="list-plain">
                                <li>City of Geneva</li>
                                <li>City of Meyrin</li>
                                <li>Town of Hermance</li>
                                <li>Towns of Collonge-Bellerive, Hermance and Vandoeuvres</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
