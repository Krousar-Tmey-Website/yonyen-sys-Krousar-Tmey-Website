<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Snapshot of the working News content (articles, images paths,
     * videos, tags) so every environment/teammate has the same data
     * instead of recreating 49 articles by hand. Note: this seeds the
     * database rows only — the actual uploaded image/video files in
     * storage/app/public are not tracked by git and must be synced
     * separately (shared disk, S3, or copying the folder manually).
     */
    public function run(): void
    {
        $articles = array (
  0 => 
  array (
    'title' => 'Edito October',
    'slug' => 'edito-october',
    'excerpt' => 'Chers Amis, Comme vous le découvrirez dans les sections suivantes, nous avons eu le grand honneur d\'être reçus par Sa Majesté le Roi Norodom Sihamoni et Sa Majesté la Reine Mère, Norodom Monineath, fin mai.',
    'content' => '<p>Chers Amis,</p><p>Comme vous le découvrirez dans les sections suivantes, nous avons eu le grand honneur d\'être reçus par Sa Majesté le Roi Norodom Sihamoni et Sa Majesté la Reine Mère, Norodom Monineath, fin mai. Depuis l\'inauguration de la première école pour enfants sourds et aveugles, notre organisation n\'a cessé de grandir pour offrir une éducation adaptée à des centaines d\'enfants à travers tout le Cambodge.</p><p>Nous tenons à remercier chaleureusement chacun d\'entre vous pour votre soutien continu, qui rend possible ce travail essentiel auprès des enfants les plus vulnérables du pays.</p>',
    'image' => NULL,
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2025-10-06 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/child-welfare',
        'label' => 'Child welfare',
      ),
    ),
  ),
  1 => 
  array (
    'title' => 'An Evening of Hope: CIA First International School Raises Funds and Awareness for Krousar Thmey',
    'slug' => 'evening-of-hope-cia-first-international-school',
    'excerpt' => 'On May 9, 2025, Krousar Thmey had the heartfelt honor of being chosen as the beneficiary of CIA First International School\'s charity concert: "Concert for a Cause". This inspiring event was more than a celebration of music — it was a celebration of inclusion.',
    'content' => '<p></p><p>On May 9, 2025, Krousar Thmey had the heartfelt honor of being chosen as the beneficiary of CIA First International School\'s for their charity concert: “Concert for a Cause”. This inspiring event was more than a celebration of music—it was a celebration of inclusion, community and shared hope for the future.</p><p></p><p>The evening opened with a powerful moment: children from our Takhmao Protection Center graced the stage with a traditional blessing flower dance. Their poised and graceful performance not only captivated the audience but also symbolized the growing confidence and integration of our children into the broader community. Seeing them shine was a moment of immense pride for all of us at Krousar Thmey.</p><p></p><p></p><p></p><p><img src="https://www.krousar-thmey.org/wp-content/uploads/2025/06/IMG_8584-scaled.jpg"></p><p></p><p></p><p>Over 300 students, families and educators filled the venue with energy and enthusiasm. Each musical act received warm applause with one of the most memorable performances coming from CIA\'s primary class students, whose vibrant performances lit up the stage and brought smiles to every face.</p><p></p><p></p><p><img src="https://www.krousar-thmey.org/wp-content/uploads/2025/06/IMG_8685-1-980x653.jpg"></p><p></p><p></p><p>Adding depth to the evening, our long-standing partners from the National Institute for Special Education (NISE) hosted an engaging exhibition on deafness and blindness. Attendees of all ages explored Braille and sign language, gaining valuable insights into inclusive communication and the importance of accessibility in education.</p><p></p><p></p><p><img src="https://www.krousar-thmey.org/wp-content/uploads/2025/06/IMG_8643-980x653.jpg"></p><p></p><p><img src="https://www.krousar-thmey.org/wp-content/uploads/2025/06/IMG_8652-768x512.png"></p><p></p><p></p><p>The highlight of the fundraising efforts was a dynamic concert organized by the CIA music department, which raised $2700 in cash donations that will directly support our mission to provide quality care, education and empowerment to vulnerable and marginalized children in Cambodia.</p><p></p><p>We extend our deepest thanks to CIA First International School, its dedicated staff and its talented students for their generosity and commitment to social change. We are also deeply grateful to our event sponsors—<strong>Prudential, Pachem Dental Clinic and CIMB Bank</strong>—for believing in the potential of every child.</p><p></p><p>Together, we are building a brighter, more inclusive future for Cambodia\'s children—one note, one song, one step and one smile at a time.</p>',
    'image' => 'news/77svJ6beh2zJiVIGmcJtigk7Agl8mujmHCoVH9WW.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2025-06-25 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/child-welfare',
        'label' => 'Child welfare',
      ),
      2 => 
      array (
        'url' => '/topics/cultural-and-artistic-development',
        'label' => 'Cultural and artistic development',
      ),
      3 => 
      array (
        'url' => '/topics/education-for-deaf-and-blind-children',
        'label' => 'Education for deaf and blind children',
      ),
    ),
  ),
  2 => 
  array (
    'title' => 'Success story of Income Generation Activity of Krousar Thmey',
    'slug' => 'success-story-of-income-generation-activity-of-krousar-thmey',
    'excerpt' => 'In 2021, Mrs. Huot Khatna received $779.50 in small business support from the Krousar Thmey Organization. This grant was utilized to purchase a fishing boat, fishing gear, and poultry (chickens and ducks) along with necessary farming supplies. This initiative is a...',
    'content' => '<p>In 2021, Mrs. Huot Khatna received $779.50 in small business support from the Krousar Thmey Organization. This grant was utilized to purchase a fishing boat, fishing gear, and poultry (chickens and ducks) along with necessary farming supplies. This initiative is a core strategy of Krousar Thmey\'s small business program, aimed at improving family livelihoods and ensuring that children can continue their education independently, even after the organization\'s direct support concludes.</p><p></p><p><img src="/storage/news/gallery/lZgk7fAitdOjAkQhKkYoAMmX3OSjUSlMHDFhsZHh.png" alt="Success story of Income Generation Activity of Krousar Thmey"></p><h3></h3><h3>From Challenges to Stability</h3><p>The decision to invest in these specific activities followed thorough consultations and feasibility studies conducted by the Krousar Thmey team. Although the family initially faced challenges and unfavorable conditions with fishing and poultry farming, they persisted. Eventually, Mrs. Khatna\'s family established a stable daily income:</p><p></p><ul><li><strong>Fishing:</strong> They catch between 3 to 6 kg of fish daily from the river behind their house. Half of the catch is sold for 6,000 Riels per kg, while the remainder is kept for daily meals or processed into Prahok (fish paste) for sale.</li></ul><p></p><ul><li><strong>Poultry Farming:</strong> Their chicken farm yields a significant return, with prices ranging from 7,000 to 15,000 Riels per kg, depending on the size of the birds.</li><li><strong>Handicrafts:</strong> Additionally, Mrs. Khatna generates income by weaving water hyacinth hammocks. Sold to villagers and tourists for 15,000 Riels each, she typically completes one hammock every 2 to 3 days, depending on her health.</li></ul><p></p><p><img src="/storage/news/gallery/USqr4E7WuJn0vZLHcXHoRfhkqLMc2tlzEPgtror7.jpg" alt="Success story of Income Generation Activity of Krousar Thmey — weaving hammocks"></p><h3></h3><h3>Impact on Education and Family</h3><p>The success of this small business has ensured a sustainable future for their two grandchildren, who have been in their care since infancy following their parents\' divorce:</p><ul><li>Poeun Rima (15): Currently in Grade 9.</li><li>Poeun Rady (13): Currently in Grade 7 at Dan Run Lower Secondary School.</li></ul><p></p><p>Since 2020, both children have also been supported by the Child Welfare Program, receiving a monthly allowance of $15 each. Beyond financial aid, they receive educational counseling, career orientation for vocational training or university, and soft skills training to help them achieve their future professional dreams.</p><p></p>',
    'image' => 'news/hKoyNTg4ZCO4aCKUExAXVHGwJetVnrpaUVQrPYrP.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2026-07-15 11:36:07',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/academic-and-career-counselling',
        'label' => 'Academic and Career Counselling',
      ),
      1 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      2 => 
      array (
        'url' => '/topics/child-welfare',
        'label' => 'Child Welfare',
      ),
    ),
  ),
  3 => 
  array (
    'title' => 'Bringing Health and Hope to an Isolated Community',
    'slug' => 'bringing-health-and-hope-to-an-isolated-community',
    'excerpt' => 'A Powerful Initiative. In a community where access to basic healthcare is a distant dream and where survival often means collecting garbage, the village of Tuol Pongro in Poipet province, on the border with Thailand, is an example of resilience in the face of adversity.',
    'content' => '<h3>A Powerful Initiative</h3><p>In a community where access to basic healthcare is a distant dream and where survival often means collecting garbage, the village of Tuol Pongro in Poipet province, on the border with Thailand, is an example of resilience in the face of adversity. Aware of the urgent need for intervention, Krousar Thmey, with the loyal support of the <em>Amicale des Étudiants en Pharmacie et des Pharmaciens Khmers</em> (AEPK), launched an unprecedented health and hygiene awareness campaign, offering hope and care to a long-neglected region. The initiative was made possible through collaboration with the Banteay Meanchey provincial health department and local authorities. The campaign aimed to provide immediate medical aid and educational resources to over 500 beneficiaries, including monks, children, schoolchildren, teachers, the elderly, and families in difficulty in the region.</p><blockquote>The program prioritized early detection of non-communicable diseases such as diabetes and hypertension, which are often neglected in poor communities. Participants received medical consultations, medication and advice on how to manage these pathologies. To ensure safety, two ambulances were stationed on site to deal with requests for emergency assistance in serious cases. The event also included interactive health education workshops focusing on practical topics such as dental care, sleep and food hygiene. Although concise, these sessions captivated participants, who actively participated by asking questions and sharing personal stories. Their enthusiasm demonstrated their deep desire to improve their health and well-being.</blockquote><p><img src="/storage/news/gallery/WVhYPWQkp0nTWRCs3HhmnjnoLrqd4qrOdo6I409D.png" alt="Medical check-up at the Tuol Pongro health and hygiene awareness campaign"></p><p>Krousar Thmey also provided essential goods such as basic food items (rice, oil, canned goods, etc.) and school supplies. Hygiene kits and over 1,000 educational posters were distributed to help families adopt healthier practices. Many participants showed a keen interest in these materials, requesting additional copies to share with their neighbors and relatives.</p><p>Going a step further, this event not only addressed immediate health concerns but also gave the entire community the knowledge and tools to improve their well-being over the long term. It also allowed some to confide: <em>“This is the first time we\'ve had something like this. It\'s not just about receiving, but knowing that someone cares about us,”</em> said one participant, whose gratitude reflected both the help he had received and the feeling of being seen, listened to and, ultimately, existing in the eyes of others, despite his difficulties.</p><p>The success of this initiative has demonstrated its profound impact on disadvantaged populations. Your support and that of our partners is helping to transform lives, bringing health, hope, and dignity to communities like Tuol Pongro.</p>',
    'image' => 'news/nnYFDvmAWtFWgcrb1NohBjqidn3wu9NMnHC2eUwK.png',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2025-03-05 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/child-welfare',
        'label' => 'Child welfare',
      ),
      2 => 
      array (
        'url' => '/topics/france',
        'label' => 'France',
      ),
      3 => 
      array (
        'url' => '/topics/health-and-hygiene',
        'label' => 'Health and hygiene',
      ),
      4 => 
      array (
        'url' => '/topics/non-classifiee',
        'label' => 'Non classifié(e)',
      ),
    ),
  ),
  4 => 
  array (
    'title' => 'Tola\'s Journey from Hardship to Success',
    'slug' => 'tolas-journey-from-hardship-to-success',
    'excerpt' => 'KER Tola’s story is exemplary. The first beneficiary of Krousar Thmey’s child protection program to pursue a healthcare career, she is studying for a nursing diploma at the Kampong Cham Regional Health Center. Driven by the dream of becoming a midwife in 2027, she works diligently and has been awarded a 100% government scholarship in recognition of her dedication.

Her early life in Siem Reap was marked by hardship. At the age of 12, after her parents separated, she and her sisters found themselves on their own. In 2014, Krousar Thmey offered them stability and hope. Two years later, she returned to the family home in Kampong Cham, where she flourished in a protective environment.

Graduating from high school in 2022, she pursued her passion for healthcare by volunteering at the Tbong Khmum Health Department. There she acquired invaluable skills, from administering serum to supplying oxygen to patients.

With Krousar Thmey’s support, Tola has become independent, learning to manage her responsibilities and express herself with confidence.

“Education is powerful. Even if you fail, dare to move forward,” she confides.

Tola’s story illustrates the power of education and resilience. Thanks to her commitment and the support of Krousar Thmey, she has rewritten her future, proving that with perseverance and solidarity, anything is possible.',
    'content' => '<p>KER Tola\'s story is exemplary. The first beneficiary of Krousar Thmey\'s child protection program to pursue a healthcare career, she is studying for a nursing diploma at the Kampong Cham Regional Health Center. Driven by the dream of becoming a midwife in 2027, she works diligently and has been awarded a 100% government scholarship in recognition of her dedication.</p><blockquote>Her early life in Siem Reap was marked by hardship. At the age of 12, after her parents separated, she and her sisters found themselves on their own. In 2014, Krousar Thmey offered them stability and hope. Two years later, she returned to the family home in Kampong Cham, where she flourished in a protective environment.</blockquote><p>Graduating from high school in 2022, she pursued her passion for healthcare by volunteering at the Tbong Khmum Health Department. There she acquired invaluable skills, from administering serum to supplying oxygen to patients.</p><p>With Krousar Thmey\'s support, Tola has become independent, learning to manage her responsibilities and express herself with confidence.</p><p><em>“Education is powerful. Even if I fail, dare to move forward,”</em> she confides.</p><p>Tola\'s story illustrates the power of education and resilience. Thanks to her commitment and the support of Krousar Thmey, she has rewritten her future, proving that with perseverance and solidarity, anything is possible.</p>',
    'image' => 'news/qT0ari8WaLMU5KQXINk9rU2wlaXVugX4HppeFCZ4.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2025-03-03 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/academic-and-career-counselling',
        'label' => 'Academic and career counselling',
      ),
      2 => 
      array (
        'url' => '/topics/child-welfare',
        'label' => 'Child welfare',
      ),
    ),
  ),
  5 => 
  array (
    'title' => 'Transforming Education for the Deaf',
    'slug' => 'transforming-education-for-the-deaf',
    'excerpt' => 'The Signs Discovery Application. Imagine a tool that not only bridges the gap between sign language and written language, but also enables deaf people and their families to communicate more effectively. The Signs Discovery application, presented by Patrick LABELLE, is a major step forward.',
    'content' => '<p>The Signs Discovery Application</p><p>Imagine a tool that not only bridges the gap between sign language and written language, but also enables deaf people and their families to communicate more effectively. The Signs Discovery application, presented by Patrick LABELLE, is revolutionizing the teaching of sign language in inclusive education and specialized schools.</p><p>By making sign language more visible and easier to learn, the application helps deaf children, their families, and their teachers build stronger, more effective communication at home and at school.</p><blockquote>This innovative platform is not limited to serving as a learning tool for people with partial or total deafness. It extends its services to families, educators and even potential employers, to help the deaf community better integrate into society. Designed to accelerate the learning of simple and complex signs, the application is designed to support users in their use of sign language. Teachers can create personalized lessons and assessments, categorized by theme and adapted to their students\' abilities. This approach guarantees a seamless learning experience where students can learn, practice and review at their own pace.</blockquote><p>The platform\'s tracking system automatically records the student\'s progress. If a student\'s performance falls short of expectations, they are encouraged to challenge themselves in a supportive, pressure-free environment. One of the most remarkable features of the application is its word/phrase-sign translator and reverse translator (sign-word). These tools simplify complex concepts, bridge communication gaps, and improve understanding between the deaf and hearing communities.</p><p>Currently, the Signs Discovery application includes an impressive 6,777 signs, validated by the National Institute for Special Education and Krousar Thmey. Over 500 deaf students and 100 specialist teachers are expected to benefit from this transformative resource. With its ability to empower individuals, enhance learning, and promote inclusion, the Signs Discovery app is not just a tool; it\'s a portal to a more inclusive and interconnected society.</p>',
    'image' => 'news/guHDQVe4Sjkh43x3caH47woSZGTRvZyZnL7r8Gts.png',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2025-02-28 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/education-for-deaf-and-blind-children',
        'label' => 'Education for deaf and blind children',
      ),
      2 => 
      array (
        'url' => '/topics/france',
        'label' => 'France',
      ),
    ),
  ),
  6 => 
  array (
    'title' => 'February 2025 Editorial',
    'slug' => 'february-2025-editorial',
    'excerpt' => 'Dear Friends, As you will discover in the pages prepared by Ly, our communications manager, we are delighted to share the involvement of new local partners, as well as Cambodians from France, with AEPK\'s mission. Their support enables our teams to continue and expand our work.

As many of the stories told over the 34 years of our existence testify, we’re particularly proud of our young people’s successes, just like the story of Tola.
 
All these actions are possible thanks to your support. We sincerely thank you.
 
 
Benoît DUCHÂTEAU-ARMINJON
President-Founder',
    'content' => '<p>Dear Friends,</p><p>As you will discover in the pages prepared by Ly, our communications manager, we are delighted to share the involvement of new local partners, as well as Cambodians from France, with AEPK\'s mission. Their support enables our teams to continue and expand our work with vulnerable children across Cambodia.</p><blockquote>As many of the stories told over the 34 years of our existence testify, we\'re particularly proud of our young people\'s successes, just like the story of Tola.</blockquote><p>All these actions are possible thanks to your support. We sincerely thank you.</p><p><em>Benoît DUCHÂTEAU-ARMINJON</em></p><p><em>President-Founder</em></p>',
    'image' => 'news/ba3qLTMk9Omcjzhm0a4ZX39QLob1c98HpuFIB387.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2025-02-28 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/france',
        'label' => 'France',
      ),
      2 => 
      array (
        'url' => '/topics/non-classifiee',
        'label' => 'Non classifié(e)',
      ),
    ),
  ),
  7 => 
  array (
    'title' => '2024, A Year of Impact',
    'slug' => '2024-a-year-of-impact',
    'excerpt' => 'A Wealth of Developments and Collaborations for Krousar Thmey. 2024 was a significant year for Krousar Thmey, in terms of visibility and action, thanks to the development of new partnerships and the enhancement of our image. We were fortunate to work closely with one another.',
    'content' => '<h3>A Wealth of Developments and Collaborations for Krousar Thmey</h3><p>2024 was a significant year for Krousar Thmey, in terms of visibility and action, thanks to the development of new partnerships and the enhancement of our image. We were fortunate to work closely with one of Cambodia\'s leading sports organizations: <strong><em>Susu Running Team</em></strong>. Thanks to their recognized commitment to various social causes, we were able to combine our respective expertise to organize a charity race and raise funds to support Krousar Thmey\'s actions.</p><blockquote>The event, held in Phnom Penh on December 15, 2024, brought together 2,000 runners and several local partners and stakeholders. More than 40 Krousar Thmey staff members, accompanied by children from our protection centers, took part in the event, underlining our shared dedication to the cause. At our stand, we were able to interact with participants and present our specialized educational programs for the deaf and blind. In collaboration with the <strong><em>National Institute for Special Education</em></strong> (NISE), we offered workshops to runners demonstrating our efforts to provide accessible education for students with disabilities.</blockquote><div class="grid grid-cols-1 md:grid-cols-3 gap-4 my-6">
    <div class="overflow-hidden rounded-lg"><img src="/storage/news/gallery/NBRmHwjKSoWZdmRsLuffzSMMybKT2JogTYs1Lbjo.png" alt="Susu Running charity race registration booth" class="w-full h-full object-cover"></div>
    <div class="overflow-hidden rounded-lg"><img src="/storage/news/gallery/VVFP0js8T6gU6mlvDZT1hhwIWWxH7kABDylGqyAH.png" alt="Stride to Inspire start and finish line" class="w-full h-full object-cover"></div>
    <div class="overflow-hidden rounded-lg"><img src="/storage/news/gallery/9XHNVUS8qJVpZl7hnXhrDh2N8j8X0ZEhHGFU7VLl.png" alt="Krousar Thmey staff and runners at the charity race" class="w-full h-full object-cover"></div>
</div><p>The event raised $16,161 for Krousar Thmey, an important contribution to our work. This remarkable event also put Krousar Thmey in the spotlight thanks to effective communication on the race\'s equipment and infrastructure: communication panels, start and finish line ribbons, a photobooth, and messages delivered by the event\'s host.</p><p>This race marks the start of a partnership between the Krousar Thmey and Susu Running teams. We will be working together for a year on sports training for our social workers in the northern region of Cambodia. This partnership illustrates Susu Running\'s commitment to the health and well-being of disadvantaged communities, which resonates particularly with our mission.</p><blockquote>Krousar Thmey\'s reach continued to expand thanks to the initiatives and support of local partners such as Musica Felice, which raised $5,000, and the “À l\'Art-rencontre de l\'Autre” performance at the Lycée Descartes, which attracted over 400 students and raised $2,502 in donations. In addition, a social networking campaign highlighted Cambodians\' growing awareness of Krousar Thmey\'s issues and their increasing willingness to support us.</blockquote><p>All in all, 2024 was a year of extraordinary achievements for Krousar Thmey. These impactful partnerships and events not only raised funds but also broadened our outreach established meaningful connections, and intensified our mission. We are deeply grateful to everyone who has supported us, and we look forward to continuing our collective efforts to create lasting change for the children and communities we support.</p>',
    'image' => 'news/rqhDN8BnTqCMhyyhv1qDoHeS04YcnZwwn3cSoskn.png',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2025-02-28 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/academic-and-career-counselling',
        'label' => 'Academic and career counselling',
      ),
      1 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      2 => 
      array (
        'url' => '/topics/child-welfare',
        'label' => 'Child welfare',
      ),
      3 => 
      array (
        'url' => '/topics/cultural-and-artistic-development',
        'label' => 'Cultural and artistic development',
      ),
      4 => 
      array (
        'url' => '/topics/education-for-deaf-and-blind-children',
        'label' => 'Education for deaf and blind children',
      ),
      5 => 
      array (
        'url' => '/topics/france',
        'label' => 'France',
      ),
      6 => 
      array (
        'url' => '/topics/non-classifiee',
        'label' => 'Non classifié(e)',
      ),
    ),
  ),
  8 => 
  array (
    'title' => 'Psychological Support for Children and Adolescents',
    'slug' => 'psychological-support-for-children-and-adolescents',
    'excerpt' => 'This year, 2024, Krousar Thmey is collaborating with its partner Transcultural Psychosocial Organization (TPO) to launch a new training program for its teams. This week-long workshop, designed for all Krousar Thmey employees, provided essential skills and knowledge to better support children.',
    'content' => '<p>This year, 2024, Krousar Thmey is collaborating with its partner Transcultural Psychosocial Organization (TPO) to launch a new training program for its teams. This week-long workshop, designed for all Krousar Thmey employees, provided essential skills and knowledge to meet unique challenges. Indeed, Krousar Thmey\'s teams are in daily contact with traumatized teenagers and children in the Protection Centers and need to be trained to provide them with the best possible support.</p><p></p><p>The workshop focused on understanding the emotional trauma faced by young people. The Krousar Thmey teams were given keys to creating a supportive environment that fosters children\'s healthy development and encourages their resilience. The training also emphasized the importance of self-care for staff members, recognizing the emotional demands of daily work with vulnerable children and young people. Activities such as meditation, physical exercises, and group dynamics were integrated to help participants recharge their batteries and maintain a good work-life balance. One of the key learnings was the development of new practical skills. Krousar Thmey teams learned how to create and effectively manage adolescent groups, recognize the stages of psychological and physical development, and implement appropriate strategies to manage mental health issues. The training also emphasized the need to put in place internal policies that support staff well-being and encourage personal wellness practices.</p><p></p><p>These sessions, held twice a year in Kampot province, have fostered a sense of calm, enabling participants to engage fully in learning and leisure activities. Since the training began, over 70 staff members have benefited from this comprehensive program, contributing to positive changes in both staff well-being and adolescent behavior, with two counseling rooms set up. Krousar Thmey\'s ongoing partnership with TPO is key to supporting Cambodia\'s vulnerable young people by providing those who care for them with the tools and support they need to succeed.</p>',
    'image' => 'news/TZAaQUXnzWEapCBfS4raLxHvNhqhrCu72dWEEB46.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2024-12-10 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/education-for-deaf-and-blind-children',
        'label' => 'Education for deaf and blind children',
      ),
      2 => 
      array (
        'url' => '/topics/health-and-hygiene',
        'label' => 'Health and hygiene',
      ),
      3 => 
      array (
        'url' => '/topics/academic-and-career-counselling',
        'label' => 'Academic and career counselling',
      ),
      4 => 
      array (
        'url' => '/topics/child-welfare',
        'label' => 'Child welfare',
      ),
    ),
  ),
  9 => 
  array (
    'title' => 'Breaking Down Barriers',
    'slug' => 'breaking-down-barriers',
    'excerpt' => 'From a rural Cambodian village to the world stage of the United Nations, Sophalleng\'s remarkable journey is a testament to the resilience, determination, and transformative power of education. Blinded at the age of four by measles, Sophalleng had a difficult start.',
    'content' => '<p>From a rural Cambodian village to the world stage of the United Nations, Sophalleng\'s remarkable journey is a testament to the resilience, determination, and transformative power of education. Blinded at the age of four by measles, Sophalleng had a difficult start. Tragically, he lost his mother when he was 10, leaving his future uncertain. However, at the age of 13, he regained hope by joining the Krousar Thmey Special School for Blind Children in Siem Reap. It was here that he distinguished himself by his determination and willingness to learn. Not only did he excel in his studies, but he also became a mentor to his peers, tutoring other students and volunteering to guide and teach other visually impaired children.</p><p>In 2021, still supported by Krousar Thmey, Sophalleng graduated in Business Administration from the University of Southeast Asia (USEA) in Siem Reap, marking an important milestone in his educational journey. The following year, he joined Krousar Thmey\'s head office in Phnom Penh as a project manager, managing projects for disabled children and taking part in national and international conferences.</p><p>In October 2024, he reached a historic milestone by becoming the first blind Cambodian to work for the UN Food and Agriculture Organization (FAO). As a technical assistant specializing in monitoring, evaluation, accountability, and learning, Sophalleng\'s responsibilities are manifold: coordinating schedules, reviewing and analyzing projects with his counterparts, and integrating data into advanced monitoring and evaluation tools. Beyond these responsibilities, he is now the UN focal point for people with disabilities in Cambodia. He makes their voices heard and holds the position of vice-chairman of the working group on education and disabilities, where he promotes digital accessibility.</p><p>Sophalleng\'s success is not just a personal achievement, but a beacon of hope for the visually impaired community. His life illustrates that with access to education, unwavering perseverance, and the right support systems, barriers can be broken down and anything becomes possible.</p><p>Today, Sophalleng is a role model, demonstrating that despite adversity, extraordinary success is possible. His journey inspires countless others, proving that no dream is too big with the support of Krousar Thmey.</p>',
    'image' => 'news/Y0OcudihKGWp1SiYTdf3zLMdKLt2fPdy5E1DXJYa.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2024-12-10 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/child-welfare',
        'label' => 'Child welfare',
      ),
      2 => 
      array (
        'url' => '/topics/education-for-deaf-and-blind-children',
        'label' => 'Education for deaf and blind children',
      ),
      3 => 
      array (
        'url' => '/topics/france',
        'label' => 'France',
      ),
      4 => 
      array (
        'url' => '/topics/academic-and-career-counselling',
        'label' => 'Academic and career counselling',
      ),
    ),
  ),
  10 => 
  array (
    'title' => 'The New Book Written by the Founder of Krousar Thmey',
    'slug' => 'the-new-book-written-by-the-founder-of-krousar-thmey',
    'excerpt' => 'The New Book by the Founder of Krousar Thmey "Pour l\'Enfance Cambodgienne, Agir et Transmettre" - A Remarkable Journey. Discover the inspiring story of Krousar Thmey, a humanitarian organization that has been a beacon of hope for Cambodia\'s most vulnerable children.',
    'content' => '<h3>The New Book by the Founder of Krousar Thmey “Pour l\'Enfance Cambodgienne, Agir et Transmettre” — A Remarkable Journey</h3><p>Discover the inspiring story of Krousar Thmey, a humanitarian organization that has been a beacon of hope for Cambodia\'s most vulnerable children. From 1991 to 2024, this new book traces the history of Krousar Thmey, documenting its transformative work from the creation of Cambodia\'s first schools for blind and deaf children to the historic transfer of these institutions to the Ministry of Education in 2019.</p><p>Co-authored by Benoît DUCHÂTEAU-ARMINJON, founder and president of Krousar Thmey, and Auray AUN, president of Krousar Thmey France, this book details the organization\'s tireless efforts in Cambodia to give all children the means to become responsible, self-sufficient adults.</p><p>This is not just a book, but above all a vibrant testimony to the resilience of the Krousar Thmey teams and the impact of education in transforming the lives of many Cambodian children.</p><p>Order your book today!</p><p>To receive your book, simply send an SMS to +33 6 30 15 80 00 or visit the Krousar Thmey website <a href="https://www.krousar-thmey.org/en/donate-now/" target="_blank" rel="noopener noreferrer">https://www.krousar-thmey.org/en/donate-now/</a>, to make your payment of 21 euros (postage included in France). All profits from sales are donated to Krousar Thmey.</p><p></p>',
    'image' => 'news/1bEpp05edxfoXRgiVvCS8HxnRCrovjRzQOFwBx5c.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2024-12-10 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/education-for-deaf-and-blind-children',
        'label' => 'Education for deaf and blind children',
      ),
      2 => 
      array (
        'url' => '/topics/france',
        'label' => 'France',
      ),
    ),
  ),
  11 => 
  array (
    'title' => 'December 2024 Editorial',
    'slug' => 'december-2024-editorial',
    'excerpt' => 'Dear Friends, "Pour l\'enfance cambodgienne, agir et transmettre". This is the title we have chosen for the new book which traces the history of Krousar Thmey, from 1991 to July 2024, the last school audit. It takes up much of my first book, "A Humanitarian in Cambodia."',
    'content' => '<blockquote>Dear Friends,</blockquote><blockquote>“Pour l\'enfance cambodgienne, agir et transmettre”. This is the title we have chosen for the new book which traces the history of Krousar Thmey, from 1991 to July 2024, the last school audit. It takes up much of my first book, “A Humanitarian in Cambodia”, but is completed by the story of all the steps that had to be worked out to get the idea of transferring the schools accepted by the Cambodian government and carried out in July 2019. You\'ll understand what made it possible to change the way disabled people are viewed, to get Cambodians to take ownership of the schools, and to set up structures within the Ministry of Education\'s administration. Written in collaboration with Auray AUN, former Director of Krousar Thmey Cambodia and current President of Krousar Thmey France, this book aims to share our experience, particularly the ideal of all good development NGOs, but one that too few put into practice: that of transmission.</blockquote><p>The book was published in November by Magellan &amp; Cie, and is available in many bookshops. If you\'d like a signed version by one of us, please let us know, and we\'ll send it to you for 21 euros (postage included for France). Please leave me a message at +33 0630158000.</p><p>Having been in Cambodia for the past few days, I\'ve been able to see the good work done by our teams around Darong CHOUR despite the context of a country that COVID has left its mark on. Tourism has not yet fully recovered, many investment projects have come to a standstill, many Cambodians are still in a very precarious situation, the dry season and lack of water have severely impacted harvests, etc. In short, although there has been a marked improvement since 2000, there is still a long way to go.</p><p>Your help is therefore always welcome to support children living on the streets or from poor families, and young people with disabilities, to give them a real chance of a future, like the young people I sometimes come across during my visits and who call out to me with emotion.</p><p>Thank you for continuing to be at our side, and I wish you all a Merry Christmas with your families.</p><p><em>Benoît DUCHÂTEAU-ARMINJON</em></p><p><em>President and Founder</em></p>',
    'image' => 'news/XDMcXoJZnwVAKSUY9fWZpILcO1iP4dVvXcZapKVb.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2024-12-10 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/cultural-and-artistic-development',
        'label' => 'Cultural and artistic development',
      ),
      2 => 
      array (
        'url' => '/topics/education-for-deaf-and-blind-children',
        'label' => 'Education for deaf and blind children',
      ),
      3 => 
      array (
        'url' => '/topics/france',
        'label' => 'France',
      ),
      4 => 
      array (
        'url' => '/topics/health-and-hygiene',
        'label' => 'Health and hygiene',
      ),
      5 => 
      array (
        'url' => '/topics/academic-and-career-counselling',
        'label' => 'Academic and career counselling',
      ),
      6 => 
      array (
        'url' => '/topics/child-welfare',
        'label' => 'Child welfare',
      ),
    ),
  ),
  12 => 
  array (
    'title' => 'Inclusion and Diversity',
    'slug' => 'inclusion-and-diversity',
    'excerpt' => 'Internationally recognized for the impact of its programs, Krousar Thmey recently took another major step forward in its commitment to supporting people with visual impairments. The organization was honored to participate in the ICEVI (International Council for Education of People with Visual Impairment).',
    'content' => '<p>Internationally recognized for the impact of its programs, Krousar Thmey recently took another major step forward in its commitment to supporting people with visual impairments. The organization was honored to participate in the <strong>ICEVI</strong> (International Council for Education of People with Visual Impairment) <strong>2024 World Conference and General Assembly</strong>, held from November 14 to 17 in Ahmedabad, India. Themed <strong><em>“Inclusion in Diversity: Equity and Accessibility for All”</em></strong>, this prestigious event brought together experts, educators, and advocates from around the world to advance the cause of accessibility and inclusion for people with visual impairments.</p><p>ICEVI\'s global conference is a key event, providing a platform for professionals to share research and best practice in inclusive education. With 400 delegates representing 61 countries, the conference not only highlighted the importance of inclusive education but also provided invaluable networking opportunities for those dedicated to making a difference in the lives of people with disabilities.</p><p>As a long-standing partner of ICEVI, the Krousar Thmey organization has been honored with the privilege of representing Cambodia and having voting rights at its General Assembly. This recognition reflects the growing influence of Krousar Thmey\'s work and underscores its vital role in advocating for the rights of people with disabilities, both in Cambodia and internationally.</p><blockquote>We are very proud to represent Cambodia at this important forum, said Darong CHOUR, Executive Director of Krousar Thmey. This opportunity reaffirms our commitment to advancing the rights of visually impaired people and is a testament to the impact of Krousar Thmey\'s work. Through its active participation, Krousar Thmey continues, with your support, to make a real difference to the lives of blind children in Cambodia.</blockquote><p></p>',
    'image' => 'news/F8nDUzXjucrh3hh0USMSc6JxnYE8oYVrub7ZuJH4.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2024-12-09 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/education-for-deaf-and-blind-children',
        'label' => 'Education for deaf and blind children',
      ),
    ),
  ),
  13 => 
  array (
    'title' => 'A Story of a Successful Mobile Vendor, Chenda',
    'slug' => 'a-story-of-a-successful-mobile-vendor-chenda',
    'excerpt' => '"My first day of grocery selling was incredibly difficult. I felt ashamed as buyers laughed at me for using a broken baby bucket to carry my items. I didn\'t know what a fair price for my goods should be, but within a week, I managed to figure it out. Soon, I was earning a steady income."',
    'content' => '<blockquote>My first day of grocery selling was incredibly difficult. I felt ashamed as buyers laughed at me for using a broken baby bucket to carry my items. I didn\'t know what a fair price for my goods should be, but within a week, I managed to figure it out. Soon, I was making good deals and saved up enough money—$15—to buy a proper bucket, and people stopped laughing. I used to think the world was small and closed to me, but I realized it was my own fear holding me back. Thanks to the $300 financial support from Krousar Thmey\'s Income Generation Activity, I was able to reunite with my family and face any challenges that came my way. I failed at several small businesses, but I never gave up. I watched others, learned, and kept trying until I built a successful business of my own, said Chenda, smiling as she shared her story.</blockquote><p>Chenda, a 33-year-old married mother of two, grew up with her aunt and four siblings in Wat Svay village, Sala Kamoeuk commune. Originally from Siem Reap, her parents separated when she was pregnant with her third child. She used to work as a kitchen helper at the Stung Siem Reap hotel, where she met her husband, an electrician. Due to the COVID-19 crisis, she moved to Puok district to live with her mother-in-law, about 20 kilometers from the city, after losing her job during the pandemic\'s second year. Her husband still works in Siem Reap and sends money home, but his income barely covers their needs, supporting his mother, Chenda, and their two children.</p><p>In 2023, Chenda met a social worker from Krousar Thmey during an outreach activity. They discussed the possible support she could receive, and Chenda shared her dream of opening a dessert stall. She spent a week learning to make desserts from her neighbors for free and then moved to Siem Reap with her children to begin selling. Despite guidance and regular visits from Krousar Thmey staff, her dessert business did not succeed as expected, earning only $2.5 to $3.5 daily. Many locals preferred to eat in busier areas, and the elderly didn\'t often buy desserts. Undeterred, Chenda pivoted to selling shaved ice syrup, meatballs, and papaya salad, which did better initially but only lasted two months, as sales depended heavily on the nearby school\'s schedule. She faced yet another setback.</p><p><img src="/storage/news/gallery/Gh0Xwhyx7XzEoaZjjKomvUvw61AMFJm6I3lsRQpt.png" alt=""></p><p></p><p></p><p><em>Chenda\'s resilience kept her going. Inspired by others selling vegetables and meat from motorbikes, she decided to try the same. After consulting with Krousar Thmey, she borrowed an additional 300,000 riels ($75) to add to her remaining 200,000 riels ($50) from Krousar Thmey\'s original support and started her business again. This time, she succeeded.</em></p><p></p><p><img src="/storage/news/gallery/RpjPsoMsFKrAZTPyj5AjGu82CHVHS4bg451djd4u.png" alt=""></p><p></p><p></p><p></p><blockquote>Every day, I wake up at 4 a.m. to buy items at the market and prepare everything by 6:30 a.m. I drive from one location to another, visiting my regular customers, and spend about five and a half hours before returning home. I sell around 70% of my items and reserve the rest for evening sales at my house. I earn between 150,000 and 170,000 riels ($37.5 – $42.5) daily, with a net income of 30,000 to 35,000 riels ($7.5 – $8.75). This income allows me to save for healthcare and future needs. Before, I couldn\'t afford snacks for my kids or buy more than 100 grams of pork. Now, I can buy 500 grams and better provide for my family. I\'ve been selling vegetables and meat on the move for nearly a year and a half since 2023, and I\'m proud of the income I generate. ‘Everyone can make their own path, and there\'s no success without effort,’ said Chenda.</blockquote><p>In the future, Chenda hopes to see her two children become teachers or nurses, like her sisters, Vichekar and Tola, who are studying nursing with Krousar Thmey\'s Academic and Career Counseling support at Kampong Cham Regional Training Centre for Health.</p>',
    'image' => 'news/ibbJ1P2A3eHQanEBsi5JzkcaRmVuIfKoxXAcnfa2.png',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2024-11-13 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/child-welfare',
        'label' => 'Child Welfare',
      ),
    ),
  ),
  14 => 
  array (
    'title' => 'Join Us for the Charity Run to Support Krousar Thmey on December 15, 2024!',
    'slug' => 'join-us-for-the-charity-run-to-support-krousar-thmey-on-december-15-2024',
    'excerpt' => 'This December, you have the chance to make a difference while staying active and healthy! We are thrilled to announce a special Charity Run on December 15, 2024, with 10k donations directly supporting the remarkable work of the Krousar Thmey Foundation.',
    'content' => '<p>This December, you have the chance to make a difference while staying active and healthy! We are thrilled to announce a special Charity Run on December 15, 2024, with 10k donations directly supporting the remarkable work of the Krousar Thmey Foundation.</p><p>Krousar Thmey is dedicated to providing education, cultural access, and social support to disadvantaged children in Cambodia, particularly those who are deaf, blind, or otherwise vulnerable. Your participation in this charity run can help Krousar Thmey continue to transform lives and offer brighter futures to these children. Every step you take will bring hope and opportunity to those who need it most.</p><p><strong>Join Us After the Siem Reap International Half Marathon!</strong></p><p>Are you already planning to run in the Siem Reap International Half Marathon on December 1, 2024? Why not extend your support for a wonderful cause? After you have completed the half marathon, you can join our charity event on December 15th and contribute to a life-changing mission for Cambodian children.</p><h3>Why Join the Charity Run?</h3><p><strong><u>Support Children in Need</u></strong></p><p>All proceeds will directly benefit Krousar Thmey, helping children access essential services and education.</p><p><strong><u>Be Part of a Community</u></strong></p><p>Whether you\'re a seasoned runner or a beginner, this is a fantastic opportunity to unite with fellow athletes and fitness enthusiasts for a meaningful cause.</p><p><strong><u>Extend Your Marathon Run</u></strong></p><p>If you\'re participating in the Siem Reap International Half Marathon this December, our charity run is a great way to continue your running journey this December while making a real difference in the lives of Cambodian children.</p><p><strong><u>Inspire Others</u></strong></p><p>By joining, you will help raise awareness about Krousar Thmey\'s mission and encourage others to support this important cause.</p><p><strong><u>Learn and Promote Inclusivity</u></strong></p><p>During the event, you\'ll have the unique opportunity to engage in sign language learning sessions led by members of the deaf community, as well as explore how Braille is written and used by individuals who are blind. This experience will give you a glimpse into the world of special education and how it fosters inclusivity, creating a sense of unity and understanding among us all.</p><h3>Event Details</h3><ul><li>Race Day: December 15, 2024</li><li>Venue: Aeon Mall 3, Phnom Penh</li><li>Distance: 10 km &amp; 5 km</li><li>Registration Link: <a href="https://cfp4.me/susu10k" target="_blank" rel="noopener noreferrer">https://cfp4.me/susu10k</a></li><li>Event Telegram: <a href="https://t.me/susu10k2024" target="_blank" rel="noopener noreferrer">https://t.me/susu10k2024</a></li></ul><h3>Who Can Join?</h3><p>Everyone! Whether you are an avid runner, a casual jogger, or just want to walk for a great cause, you\'re welcome to participate.</p><h3>How to Participate</h3><p>To participate in this charity run, simply visit the registration page <a href="https://vh.checkpointspot.asia/event/susu10k" target="_blank" rel="noopener noreferrer">https://vh.checkpointspot.asia/event/susu10k</a>. If you are unable to join in person, you can donate virtually, anytime and anywhere. Every bit of support counts and will help us make a difference.</p><p>We cannot wait to see you there! Together, let\'s run for a brighter future for Cambodia\'s children, especially with the Susu Running Team for their incredible leadership and passion. Let\'s make this a memorable event that brings hope and joy to the lives of many!</p><p><strong>Let\'s make every step count!</strong></p>',
    'image' => 'news/w7JpclrbgT5jt8xaAOBaSvpyOEPN4PqVVcfCVeQK.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2024-10-25 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
    ),
  ),
  15 => 
  array (
    'title' => 'A Charity Evening: "À l\'Art-Rencontre de l\'Autre"',
    'slug' => 'a-charity-evening-a-lart-rencontre-de-lautre',
    'excerpt' => 'Art is a powerful medium, capable of conveying a message to its audience while arousing their wonder. Continuing the work we have been doing since the 90s to combat violence against children and the stigmatization of deaf and blind people, Krousar Thmey has once again brought communities together through art.',
    'content' => '<p><em>Art is a powerful medium, capable of conveying a message to its audience while arousing their wonder.</em></p><p>Continuing the work we have been doing since the 90s to combat violence against children and the stigmatization of deaf and blind people, Krousar Thmey has once again called on the permanent troupe from our Serey Sophon school of arts and culture to deliver a message of peace, openness, and solidarity during an exceptional charity evening entitled “A l\'Art-rencontre de l\'Autre”.</p><p>The event was held on August 29 at the theater of our partner, the Association d\'Artistes Kok Thlok, in collaboration with the Institut Français du Cambodge and the Institut National pour l\'Education Spécialisée. Nearly 180 people attended!</p><p><img src="/storage/news/gallery/oOyem5zYpzO9GHhMihXW84RZrFF9S91G0uTFQZDZ.jpg"></p><p class="text-center text-sm italic">The public comes to see the show “A l\'Art-rencontre de l\'Autre” performed by the Krousar Thmey troupe.</p><p>At the heart of the project: an original traditional Mohaori play, written, staged and performed by the Krousar Thmey School of Arts and Culture. Inherited from the 9th century, the Mohaori form relies heavily on its orchestral ensemble and addresses all of Khmer society in sung texts, accessible thanks to the gestures of the actors. For two months, fifteen students from the troupe rehearsed every Sunday with their teachers, under the watchful eye of director and school director, Boren TOCH, to deliver a dazzling performance on the big day.</p><p></p><p><img src="/storage/news/gallery/bDmOden6wFIQTVrnmV66iwmKnip9XS0pM92Ol0LY.png"></p><p class="text-center text-sm italic">Actors portray a raven and a monkey in “A l\'Art-rencontre de l\'Autre”</p><p>During this resolutely inclusive evening, twelve deaf dancers and a duo of blind musicians also demonstrated their talents on stage. The event also provided an opportunity to raise public awareness through workshops in Braille and Cambodian sign language. Finally, objects relating to special education and traditional Khmer arts were also on display in the theater, alongside some photo panels from our “Krousar Thmey, 30 years of history in Cambodia” exhibition produced last year.</p><p></p><p><img src="/storage/news/gallery/etGVrmGaX6IbLlaeguynm7mLxWlixEuJLvkRtu1k.jpg"></p><p class="text-center text-sm italic">The public visits the photo exhibition of Krousar Thmey\'s program activities.</p><p>The event was covered by the local press (RFI Khmer, over 19,000 people reached), the French press (Le Petit Journal du Cambodge), and the international press (KHMERer). The troupe is now embarking on a tour, and over 400 students from the Lycée Français René Descartes will attend the play on September 26.</p>',
    'image' => 'news/1eGXB0JOAWfMygiyklBq8HoPJ1Wk94TQCMV0qitT.png',
    'category' => NULL,
    'videos' => 
    array (
      0 => 'https://www.facebook.com/watch/?ref=embed_video&v=436165132131183',
    ),
    'is_published' => true,
    'published_at' => '2024-10-21 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/child-welfare',
        'label' => 'Child Welfare',
      ),
      2 => 
      array (
        'url' => '/topics/cultural-and-artistic-development',
        'label' => 'Cultural and Artistic Development',
      ),
      3 => 
      array (
        'url' => '/topics/education-for-deaf-and-blind-children',
        'label' => 'Education for Deaf and Blind Children',
      ),
    ),
  ),
  16 => 
  array (
    'title' => 'News from Krousar Thmey France',
    'slug' => 'news-from-krousar-thmey-france',
    'excerpt' => 'Dear friends, The summer period has been restful and rejuvenating for all our volunteers, who are still involved in the actions we carry out in France to promote and finance the work we do with vulnerable populations in Cambodia. The initiative taken by Charlotte ST...',
    'content' => '<p>Dear friends,</p><p>The summer period has been restful and rejuvenating for all our volunteers, who are still involved in the actions we carry out in France to promote and finance the work we do with vulnerable populations in Cambodia.</p><p>The initiative taken by Charlotte ST MART, General Secretary of Krousar Thmey France, at the end of May, in collaboration with Yuvachun, the association of young Khmers in France, at the Cité Universitaire de Paris, enabled us to forge relationships with new players in the Cambodian diaspora. At the “Krousar Thmey à la Maison du Cambodge” event, where our association had a stand displaying photos, books, and greeting cards handmade by Cambodian artists, we were able to showcase the NGO’s activities and latest news, and chat with visitors. We also had the opportunity to meet the new Cambodian ambassador, who should facilitate visa procedures for our international solidarity volunteers on future missions.</p><blockquote class="not-italic border-l-4 border-[#2d6fa3] bg-blue-50 pl-4 py-2 text-gray-700">In the future, we’d like to organize further events of this type to expand our network of volunteers and donors, particularly among the Cambodian diaspora.</blockquote><p><img src="/storage/news/gallery/dx7vGj8S9gDv1iyVEIgpAQPSx1FSQdQm6JP7vLNZ.jpg"></p><p></p><p>A warm thank you for your loyalty, generosity, and trust.</p><p>Auray AUN</p><p>President, Krousar Thmey France</p>',
    'image' => 'news/CwkRjZDSiNfOINvaeJ6AKRlEhHmRH84FPxBWLl55.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2024-10-17 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
    ),
  ),
  17 => 
  array (
    'title' => '"Do You Speak English?" Yes, With Krousar Thmey!',
    'slug' => 'do-you-speak-english-yes-with-krousar-thmey',
    'excerpt' => 'Launched nearly a year ago in an extremely poor community in Takhmao, Krousar Thmey\'s supplementary English classes have proved a great success with children, families, and local authorities alike. Every day from Monday to Friday, around thirty children and teenagers attend.',
    'content' => '<p>Launched nearly a year ago in an extremely poor community in Takhmao, Krousar Thmey’s supplementary English classes have proved a great success with children, families, and local authorities alike. Every day from Monday to Friday, around thirty children and teenagers gather in a small community hall and take an hour of English, taught by Sreyheng, 21, a former beneficiary of the Takhmao protection center, currently studying for a degree in English at Phnom Penh’s Royal University.</p><blockquote class="not-italic border-l-4 border-[#2d6fa3] bg-blue-50 pl-4 py-2 text-gray-700">“A year ago, many of the children couldn’t speak or write English,” explains Sreyheng. “I taught them to spell simple words first, then more and more complicated ones. I’m very proud of their progress and happy to be able to help them with their future.” Viteka, 15, a student in Year 10, has been taking these courses since day one and says: “Here, I can concentrate and learn English seriously. It’s very important for me, because when I grow up, I’d like to study hard and become a lawyer.” Indeed, mastering English opens professional doors and enables you to communicate with people from all walks of life. “My youngest son, aged eight, has been taking classes here for several months,” says a father. “I had been able to pay for private lessons for his older brother, but it became financially complicated… Now, thanks to this initiative, I regularly find my two sons speaking English together at home.”</blockquote><p><img src="/storage/news/gallery/7dtYkfPGwSTOfN2msJGeMowaFi9BFXpJ7Rh3aD1p.jpg" alt="Children and volunteers celebrating outside the community hall in Takhmao"></p><blockquote class="not-italic border-l-4 border-[#2d6fa3] bg-blue-50 pl-4 py-2 text-gray-700">For DONG Chantha, a local leader and member of the Children’s and Women’s Committee, these courses also have a positive influence on community life. “Before, the children had nothing to do and often hung around unsupervised after school, in the street or even on the road. Now I see them hurrying to class and I find them calmer and more polite than before.” Greyheng confides: “As well as English lessons, I try to pass on values such as respect and a sense of effort. These lessons will also help them in their future lives.”</blockquote><p>Following this model, Krousar Thmey opened English classes in a poor community in Poipet last July.</p>',
    'image' => 'news/Fqq62GOj2jcxtiMgwf2zvi9YRj1uTf548aEYmr1E.jpg',
    'category' => NULL,
    'videos' => 
    array (
      0 => 'https://www.youtube.com/watch?v=KOUvv8dnt1M',
    ),
    'is_published' => true,
    'published_at' => '2024-10-17 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/child-welfare',
        'label' => 'Child welfare',
      ),
    ),
  ),
  18 => 
  array (
    'title' => 'One Last Audit for a New Chapter',
    'slug' => 'one-last-audit-for-a-new-chapter',
    'excerpt' => 'Education for Deaf and Blind Children. Thirty years ago, Krousar Thmey launched Cambodia\'s first special education program for deaf and blind children. Since then, much progress has been made, and thousands of people with visual or hearing disabilities have been able to access quality education.',
    'content' => '<h3 class="uppercase text-lg font-bold text-[#1a3c6e] mb-2">Education for Deaf and Blind Children</h3><p>Thirty years ago, Krousar Thmey launched Cambodia’s first special education program for deaf and blind children. Since then, much progress has been made, and thousands of people with visual or hearing disabilities have been able to integrate into society, thanks to the schools founded by the NGO. Their transfer to the Cambodian government in 2019 was both a source of pride and a crucial step in ensuring that all this work would continue over the long term. To ensure that the process runs smoothly, annual evaluation missions are carried out from 2021 to 2024; the last one took place last June and marks the start of a new chapter.</p><p>The results of this audit highlight the positive management of the specialized schools by the Cambodian Ministry of Education and provide final recommendations to strengthen their future operations. The focus of this meeting is on the training of special education teachers and sign language interpreters, but also on improving courses by integrating student feedback, structuring lessons, and organizing regular technical meetings with staff.</p><p><img src="/storage/news/gallery/Ligu3ythL8V0VBPI0n6pbyxNRNCwqxCuL6Ao2Hkq.jpg" alt="Krousar Thmey and INES at the last audit in June 2024"></p><p class="text-center text-sm italic">Krousar Thmey and INES at the last audit in June 2024</p><p>In addition, the resources allocated by the Cambodian government remain a crucial factor in meeting the need for adapted textbooks, teaching materials accessible to the most disadvantaged pupils, and the development of support and learning platforms and software.</p><blockquote class="not-italic border-l-4 border-[#2d6fa3] bg-blue-50 pl-4 py-2 text-gray-700">A final report, summarizing all the recommendations made over the past four years, was submitted to the Ministry of Education, Youth and Sport in August 2024. From then on, the Ministry will be in charge of resolving each point by incorporating them into its next Strategic Educational Plan. In addition to ensuring the sustainability of the education system for children with disabilities, this also marks a great success for Krousar Thmey, which is thus realizing its primary philosophy: “Projects by Cambodians for Cambodians”.</blockquote><p></p>',
    'image' => 'news/fQcgVsFGym8V4fm9o3diUzLvZTBpUXz0HZzxk4vb.png',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2024-10-17 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
    ),
  ),
  19 => 
  array (
    'title' => 'Meet Sreyleab, Han and Minea: At the Dawn of Their New Lives',
    'slug' => 'meet-sreyleab-han-and-minea-at-the-dawn-of-their-new-lives',
    'excerpt' => 'Welcomed into one of Krousar Thmey\'s facilities from an early age, Sreyleab, Han and Minea are now preparing to fly on their own wings: all three are among the young graduates with jobs in 2023 that we featured in our last Family Letter. Trained at the Sala Baï Hotel School.',
    'content' => '<p><strong><em>Welcomed into one of Krousar Thmey\'s facilities from an early age, Sreyleab, Han and Minea are now preparing to fly on their own wings:</em></strong><em> all three are among the young graduates </em><strong><em>with jobs in 2023</em></strong><em> that we featured in our last Family Letter. Trained at the Sala Baï Hotel School in Siem Reap and the Don Bosco Hotel School in Sihanoukville, Sreyleab and Minea are now working as cooks, while Han has realized his dream of specializing as a baker. Hired in Sihanoukville, </em><strong><em>they were supported by the University and Career Guidance program during their first year in the world of work.</em></strong><em> They met the Krousar Thmey teams in February to recap their journey.</em></p><p>It\'s now been several years since the three young adults left the protection center and family homes where they grew up. They have each learned a great deal since leaving. Sreyleab, anxious at the thought of having to provide her own accommodation and food, was quickly reassured by <strong>the study arrangements offered by Sala Baï</strong>: “The school provides accommodation and takes care of the students’ meals,” she explains. Generally speaking, I’m a lot less anxious about the future. If I have any doubts or problems, I just ask around and find a solution! I haven’t had to worry about anything since I graduated. Thanks to Sala Baï’s network, I easily found a job in a hotel by the sea in Sihanoukville. I’ve also met some great people at school, and thanks to them I’ve been able to take part <strong>in exchange trips to Singapore and Thailand</strong>.</p><p><img src="/storage/news/gallery/mYcH0cU5ZlvkK5M9jJNPHeHcHq1aPycy9ffV2U80.jpg" alt="Minea and Sreyleab meet the guidance counselors at Krousar Thmey in February 2024"></p><p class="text-center text-sm italic">Minea and Sreyleab meet the guidance counselors at Krousar Thmey in February 2024.</p><p>For his part, Han wanted to <strong>be on his own as soon as he started training at Don Bosco</strong>. Rather than reside within the establishment, he chose to use Krousar Thmey’s financial aid of $30 a month to share accommodation with friends. <strong><em>“I had to set a very tight budget, but I got by,”</em></strong> says Han with pride. <strong><em>“Now I’m earning a good living, and this experience is helping me to save money. Living on my own has also made me more responsible, and I’ve learned to manage my time and sleep. When you’re working, you have to get up on time and you can’t afford to be late.”</em></strong> Student, cook, and now teacher at Don Bosco, Minea has also evolved remarkably over the past three years. “I now know how to find the resources deep inside me to manage my emotions and not let myself be overwhelmed by the moment. To be patient.” In addition to his job as a cook, Minea teaches first years and mentors around 50 Don Bosco students. “My story is similar to theirs. I understand some of their difficulties, and I have compassion for them. When they have impulsive reactions, <strong><em>I tell them again: Think of your future first</em></strong>”</p><p>Today, Sreyleab, Han, and Minea <strong>no longer need Krousar Thmey’s support</strong>; they’ve moved on with their lives. Members of the network of former beneficiaries they too want to help the NGO. They have also acquired a taste for independence: <strong>all three plan to open their own establishment one day</strong>.</p>',
    'image' => 'news/GuNf8V0QffVsQWdSZamIEyo1HMAtMBSPlcXIu3bm.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2024-03-14 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/child-welfare',
        'label' => 'Child welfare',
      ),
      2 => 
      array (
        'url' => '/topics/non-classifiee',
        'label' => 'Non classifié(e)',
      ),
    ),
  ),
  20 => 
  array (
    'title' => 'March 2024 Editorial',
    'slug' => 'march-2024-editorial',
    'excerpt' => 'Dear friends, Krousar Thmey was invited by the United Nations in Geneva... What an honor! Almost to the day, 33 years ago, I started with a handful of Cambodians in the Site II camp of what would later become the Krousar Thmey organization. With no name, no money, no plan beyond helping children in need.',
    'content' => '<p><em>Dear friends,</em></p><p><em>Krousar Thmey was invited by the United Nations in Geneva… What an honor!</em></p><p><em>Almost to the day, 33 years ago, I started with a handful of Cambodians in the Site II camp of what would later become the Krousar Thmey organization. With no name, no money, no formal structure, but with a vision and a fierce determination to provide real answers to the needs of Cambodian children. We have since trained and empowered Cambodian teams and helped thousands of children. Child protection, education and, as a remedy for the horrors experienced, cultural reappropriation have always been at the heart of our actions. Seeing us act alone amused many humanitarian professionals at first, but our determination, energy and successes won us sympathy and support. This support, from donors who heard about our concrete achievements in the field and our low operating costs, contributed to our successful development.</em></p><p><em>The second part of ‘Un Humanitaire au Cambodge’, a book I wrote in 2011, will be published shortly. It tells the rest of Krousar Thmey’s story, including the transfer of the specialized schools to the Cambodian government. I’m writing it four-handed with Auray Aun, former director of Krousar Thmey Cambodia, current president of Krousar Thmey France and key figure in this transfer. This book looks back over 33 years of struggle, joy and sadness, but so much pride.</em></p><p><em>From the bottom of our hearts, thank you all for being so loyal to us.</em></p><p><em>Benoît DUCHÂTEAU-ARMINJON,</em></p><p><em>President and Founder, Krousar Thmey</em></p>',
    'image' => 'news/RqFV2h8y6KeBy1FrkW4OJuWQmUyAvNeq9SnB1MVP.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2024-03-14 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/child-welfare',
        'label' => 'Child welfare',
      ),
      1 => 
      array (
        'url' => '/topics/non-classifiee',
        'label' => 'Non classifié(e)',
      ),
    ),
  ),
  21 => 
  array (
    'title' => 'Memory and Transmission of Khmer Classical Dance',
    'slug' => 'memory-and-transmission-of-khmer-classical-dance',
    'excerpt' => '« If culture dies out, the nation dissolves; if culture thrives, the nation prospers » goes the saying. Over the years, the practice and influence of traditional Khmer arts have reflected the country\'s periods of progress and crisis. Heritage of an ancient tradition, classical dance remains a living art form today.',
    'content' => '<p><strong>« If culture dies out, the nation dissolves; if culture thrives, the nation prospers » goes a Cambodian saying.</strong> Over the years, the practice and influence of traditional Khmer arts have reflected the country’s periods of progress and crisis. Heritage of an ancient and sumptuous civilization, <strong>the dance of the Royal Ballet, or classical Khmer dance, symbolizes Cambodia’s identity</strong>, but also shows the <strong>fragility of its transmission</strong>, as on so many occasions it almost disappeared.</p><p>Boren TOCH and Xavier de LAUZANNE <strong>are two passers-on of this memory</strong>. The first is <strong>director of the School of Art and Culture created in 1996 by Krousar Thmey</strong> in Serey Sophon, Cambodia, and works hard every day to teach and promote Khmer culture to a wide audience. The second, a <strong>French director</strong>, is releasing a new documentary dedicated to Cambodian classical dance, <strong><em>La beauté du geste</em></strong>, <strong>in French cinemas from March 13</strong>. Both answered our questions.</p><p><img src="/storage/news/gallery/uR29LzCF2mlYJT16PwE7Ch4Gh3MrNFCfmV3M81LD.webp" alt=""></p><p></p><p></p><h3 class="underline text-[#1a3c6e]">Dance is part of the DNA of Khmer culture</h3><p>For more than a thousand years, the Royal Ballet of Cambodia has contributed to <strong>the prestige of the Cambodian crown</strong>, and is considered sacred. « This dance is unique, says Boren TOCH. One of its most famous forms, known as Apsara, comes directly from ancient engravings and bas-reliefs in the temples of Angkor. Immortalized in stone, the Apsara dancers were considered to be angels messengers of the gods, and are inspired by Hindu legends dating back thousands of years. In my opinion, Apsara dance is now emblematic of the country, because <strong>it reproduces the postures and costumes of the Angkorian era</strong>, adding the qualities of the modern Cambodian woman ».</p><p>The Royal Ballet of Cambodia intrigues as much as it fascinates foreign audiences. « In 1906, the troupe performed outside Cambodia for the first time, on the occasion of <strong>King Sisowath 1st’s visit to France and the Marseille Colonial Exhibition</strong>, explains Xavier de LAUZANNE. <strong>The sculptor Auguste Rodin</strong> attended a performance and immediately fell under the spell of this art form, completely new to him. He then produced <strong>a major series of watercolors</strong> and helped bring international recognition to the Royal Cambodian Ballet. » As the starting point for the film, <strong>this encounter is above all a meeting of two cultures</strong>. « Khmer dance gestures are very different and don’t have the same meaning as Western gestures. I also wanted <strong>to demystify these codes</strong> and make them more accessible to the uninitiated. »</p><p><img src="/storage/news/gallery/cLksoiSaq7wBBX8Ud1cDMNPR1mAfM3NgIwftXSDK.jpg" alt=""></p><p></p><p></p><p class="text-center text-sm italic">Aquarelle de Rodin (1906)</p><h3 class="underline text-[#1a3c6e]">Passing on the memory to new generations</h3><p>Originally, Royal Ballet dance was transmitted orally within the palace circle. « The first archives <strong>date back to 1898</strong>. <strong>It’s one of the very first films in the history of cinema</strong>, made in Cambodia by an operator from the Lumière brothers, explains Xavier de LAUZANNE. There’s an inherent fragility in this oral tradition. At the end of the 1920s, Frenchman George Groslier feared that the decline in the budget allocated by the colonial Empire to finance ballet, in the context of soaring modernity, would doom this heritage, so <strong>he photographed the dancers’ positions on almost 300 glass plates</strong>. »</p><p>The filmmaker is following in the footsteps of his French predecessors <strong>to document this art form and leave material traces in history</strong>: « Prince Sisowath Tesso wanted to preserve the work of Princess Buppha Devi, a great dancer and later director of the Royal Ballet. <strong>With my camera, I had the privilege of following her as she organized her last ballet.</strong> »</p><p><img src="/storage/news/gallery/vfOh6PIDdPuiwNVlxVGBu3kgiKmkUXtLjtSdXhwg.jpg" alt=""></p><p></p><p></p><p class="text-center text-sm italic">Mouvements de la danse du Ballet Royal saisis par Groslier (1927)</p><p>In the 2nd half of the 20th century, the Royal Ballet’s training opened up to the rest of the population. « <strong>This year, our school welcomes 100 students in classical dance classes</strong>, reports Boren TOCH. In total, 300 students take dance classes, but the majority turn to Khmer folk dances, which are very common in public celebrations. » Khmer classical dance requires very regular and rigorous practice from an early age. « It takes more than 10 years to train a professional dancer, continues Boren TOCH. <strong>It also requires a particular emotional attachment to the art.</strong> »</p><p>Xavier de LAUZANNE, who witnessed the Royal Ballet’s rehearsals and training sessions, agrees: « <strong>I was struck by the dancers’ total dedication to their art</strong>, and by the great respect shown for their elders. » Asked about the future, Boren TOCH smiles: « I’m confident when I see <strong>the enthusiasm of the new generations</strong> for the traditional arts; they will ensure the transmission. »</p><p>« In making this film, I became aware of the importance of our collective responsibility for the survival of traditional arts, » emphasizes Xavier de LAUZANNE. Listed as a UNESCO intangible cultural heritage since 2008, the Royal Ballet now has a dedicated place in the memory of humanity.</p><h3 class="underline text-[#1a3c6e]">Building and reconstructing identity</h3><p>Part of a wider filmography on the theme of identity and reconstruction, <strong><em>La beauté du geste</em> questions the role of traditional culture in times of crisis</strong>. « Art can help people heal after a trauma, says Boren TOCH. It’s a great means of expression, but also <strong>a strong unifying factor</strong>. Because of the war, many Cambodians were exiled on the road or took refuge in camps in Thailand. Uprooted, some had forgotten the origin of Apsara dance and thought it came from Thai culture. »</p><p><img src="/storage/news/gallery/hd5Ib7QvzrvbCtpqnAEDsDtbztlzHsxLgSd4fti8.jpg" alt=""></p><p></p><p></p><p class="text-center text-sm italic">Cours de danse classique à l’école d’art et de culture de Krousar Thmey (2023)</p><p>And yet, culture is as strong as the people who bring it to life. « Browsing through the archives, I discovered videos of Mme Van Savay, <strong>1st star of the Royal Ballet, from 1985</strong>, recounts Xavier de LAUZANNE. At that time, her life, like that of millions of Cambodians, had been turned upside down and, far from the gilded scenes of the palace, she was teaching the movements of the Royal Ballet in a makeshift camp. <strong>The passion of these artists, who decided to stay in their country and pass on their knowledge</strong>, helped preserve a heritage that was then under serious threat. » Indeed, according to estimates, only 10% of Cambodian artists have survived wars and persecution.</p><p>« Art is also a way of reminding society of its values when it forgets them, adds Boren TOCH. For years, Krousar Thmey has staged dance and shadow theater performances to fight against human trafficking. In fact, that’s how I discovered the NGO and its art school, in the early 2000s. »</p><p>« There’s something universal about this story: how an ancestral art serve as a foundation for collective rebuilding after a major crisis? asks the French director. Echoing this, in the land of Angkor, Boren TOCH concludes, « <strong>Reclaiming Khmer history and traditional arts means rebuilding a common identity and national pride.</strong> »</p><div x-data="{ open: false }" class="not-prose bg-gray-50 rounded-2xl border border-gray-100 overflow-hidden my-8">
    <button @click="open = !open" type="button" class="w-full flex items-center justify-between p-5 text-left hover:bg-gray-100/50 transition-colors focus:outline-none">
        <span class="text-[#1a3c6e] font-bold text-sm">En savoir plus sur Krousar Thmey</span>
        <svg class="w-5 h-5 text-[#1a3c6e] flex-shrink-0 transform transition-transform duration-300" :class="open ? \'rotate-180\' : \'\'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    <div x-show="open" class="px-5 pb-5 pt-1 border-t border-gray-200/50" x-transition="" style="display: none;">
        <p class="text-gray-700 text-sm leading-relaxed">Créée en 1991 dans les camps de réfugiés de Site II en Thaïlande, Krousar Thmey (« nouvelle famille » en khmer) est historiquement la première fondation cambodgienne à venir en aide aux enfants défavorisés. Sa mission est de permettre l’intégration des enfants défavorisés dans la société cambodgienne, par une éducation et un soutien adaptés à leurs besoins, tout en respectant leurs traditions et leurs croyances. En 2022, les activités de Krousar Thmey ont bénéficié à plus de 3 700 personnes, dont 2 500 enfants. L’ONG mène 3 programmes et 2 projets transversaux dans 15 provinces du Cambodge : Protection de l’enfance, Éducation spécialisée et inclusive pour enfant sourd ou aveugle, Développement culturel et artistique, Orientation universitaire et professionnelle et Hygiène et santé.</p>
    </div>
</div><p></p>',
    'image' => 'news/Ju4KyhTiBUou7eYCmQ7WIacOKXLJGCbG6stLgszk.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2024-03-13 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/child-welfare',
        'label' => 'Child welfare',
      ),
      2 => 
      array (
        'url' => '/topics/cultural-and-artistic-development',
        'label' => 'Cultural and artistic development',
      ),
      3 => 
      array (
        'url' => '/topics/france',
        'label' => 'France',
      ),
    ),
  ),
  22 => 
  array (
    'title' => 'Meet Phano, a New Student at the Serey Sophon School of Art and Culture',
    'slug' => 'meet-phano-a-new-student-at-the-serey-sophon-school-of-art-and-culture',
    'excerpt' => 'CHHOUR Phano, 13, is currently in the fifth grade at a secondary school, about 50 km from Serey Sophon, located in the Northwest of Cambodia. For the past year, he has been taking free drawing and dance classes, thanks to a partnership between the Serey Sophon School and local community organizations.',
    'content' => '<p><em>CHHOUR Phano, 13, is currently in the fifth grade at a secondary school, about 50 km from Serey Sophon, located in the Northwest of Cambodia. For the past year, he has been taking free drawing and dance classes, </em><strong><em>thanks to a partnership between the Serey Sophon School of Art and Culture and the Cambodian NGO Sangkheum Kumar Kampuchea (SKK)</em></strong><em>. In this regularly flooded and isolated area, no artistic activities were previously offered.</em></p><p><em>Yet from an early age, Phano showed a keen interest in art. His father, his uncle, and including </em><strong><em>his grandfather</em></strong><em> were his inspirations and role models. “My grandfather loved to draw,” explains the young boy, “and I often think of him when I pick up my pencil. I like to draw rice paddies, houses… Afterwards, I showed my drawings to my sister, and she liked them.” Proud of his culture, Phano in turn wishes to pass it on to newer generations. “Later on, I want to follow in my grandfather’s footsteps and become a cartoonist. I’d like to inspire young people to learn one or more artistic disciplines, because </em><strong><em>art can make society a better place and make Cambodia known throughout the world</em></strong><em>”</em></p><p><img src="/storage/news/gallery/SLFyAqBMSMfQDnEgXM4H1f21fM4EVSmoGhnLzEf4.jpg" alt=""></p><p></p><p></p><p class="text-center text-sm italic">Entrance to Phano’s rural school</p><p><em>On a personal level, Phano also recognizes </em><strong><em>the positive effects of dance and drawing on his life</em></strong><em>. “I feel happier, more attentive and also more open to others. Before, I didn’t have many friends, but that’s changed! When you learn an art, you have to know how to communicate, so I’ve learned to listen better and express myself.”</em></p><p><em>An diligent student, Phano prepares for his next classes in his spare time. “At first, I wasn’t very good at dancing, but I practiced, I rehearsed the choreographies and, </em><strong><em>last October, I was able to take part in the celebrations</em></strong><em> organized by my community on the occasion of the Feast of the Dead (or Bonn Pchum Ben in Khmer).” </em><strong><em>Satisfied and grateful</em></strong><em> to have access to the teachings of the art school’s teachers, Phano concludes: “Private lessons are very expensive and not very accessible. I’d like this partnership to continue so that other children can benefit from it and blossom as I did.”</em></p>',
    'image' => 'news/VoSVT0ZcDrnc9fsgPZ2Bwd3HlXVe3WlAgvYYau3K.png',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2024-01-16 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/cultural-and-artistic-development',
        'label' => 'Cultural and artistic development',
      ),
      2 => 
      array (
        'url' => '/topics/child-welfare',
        'label' => 'Child welfare',
      ),
    ),
  ),
  23 => 
  array (
    'title' => 'Focus on Professional & Academic Success in 2023',
    'slug' => 'focus-on-professional-academic-success-in-2023',
    'excerpt' => 'Whether in the shade of a fir tree or a mango tree, the end of the year is becoming increasingly clear to everyone. It seems like the perfect time to sum up the year of 2023, particularly regarding the many professional and academic successes achieved by Krousar Thmey\'s students.',
    'content' => '<p>Whether in the shade of a fir tree or a mango tree, the end of the year is becoming increasingly clear to everyone. It seems like the perfect time to sum up the year of 2023, particularly regarding the many professional and academic successes achieved by Krousar Thmey’s young beneficiaries. Many of these lively, hard-working students have completed their training, landed their first job, or gone on to complete their secondary education. The fruit of hard work, their success leads them on the road to self choice, regardless of their origin or profile, and they can benefit their entire community. <strong>Spotlight on the exciting news from the University and Career Guidance project.</strong></p><h3 class="underline text-[#1a3c6e]">Starting a New Life</h3><p>Krousar Thmey supports and guides each young person according to his or her <strong>abilities</strong> and <strong>aspirations</strong>. For some, <strong>the vocational route enables them to develop practical skills and quickly enter the job market</strong>. This year, six young people supported by the Foundation completed their training with our partners’ structures and then landed a job in their chosen field: three of them completed the curriculum offered by the Sala Baï hotel school in Siem Reap, another graduated from Don Bosco in Sihanoukville, yet another completed his training as a mechanic while the last one just completed a beautician training course at the Phnom Penh branch of Caritas. <strong>They now work as cooks, bakers, waiters, mechanics, or in a beauty salon.</strong> “I’m very proud of them”, says CHE Phirun, head of the University and Vocational Guidance project. “They worked hard, showed they were passionate, and seized the opportunity offered to them. They are about to start a new life.”</p><p><img src="/storage/news/gallery/beptzMBtWeoBWZeNCmdetUOekRr79Kay4U5DPVeU.jpg" alt=""></p><p></p><p class="text-center text-sm italic">Sreyleab, Thy, and Sreynang at their graduation ceremony in Sala Baï, in July, with CHE Phirun.</p><p>For others, <strong>continuing their studies can also open up new horizons</strong>. This is the case of young Sophea, who, after graduating with a Bachelor’s degree in management, won <strong>a scholarship to study for a Master’s degree at the Beijing University of Science and Technology in China</strong>, where he has been studying since September.</p><h3 class="underline text-[#1a3c6e]">Creating a Virtuous Cycle</h3><p>Sreyheng, 20, chose to continue her studies at Phnom Penh’s Royal University to become a teacher and then an educator. “It’s important for me to pass on the knowledge I’ve acquired and encourage young people to follow through on their commitment.” Alongside her studies, Sreyheng also <strong>gives English lessons to the poorest children in a Takhmao community</strong>. Set up in September by Krousar Thmey’s Child Protection program, in collaboration with the local authorities, these free courses aim to raise the level of the most disadvantaged pupils. “I want to see them succeed,” reports Sreyheng, “it’s essential that they learn English, it will serve them for the rest of their lives”</p><p><img src="/storage/news/gallery/Zrrr98gFvDNXUi9XvYZqdtlh9aHfvXhFdDTQCMU0.png" alt=""></p><p></p><p></p><p class="text-center text-sm italic">Sreyheng teaches English to children from a disadvantaged community</p><h3 class="underline text-[#1a3c6e]">Including the Rest of the Community</h3><p>There’s good news in the field of special education, too. Nine blind or visually impaired students have graduated from university, including Makara, who spent three months at Krousar Thmey’s Phnom Penh offices last spring. He now holds a degree in social work from the Royal University of Phnom Penh. Three deaf students have also graduated in computer science, one of the most accessible paths for people with hearing disabilities.</p><p>On the institutional front, <strong>the 4th National Forum on Inclusive Employment</strong> was held on November 3 in Phnom Penh. The event provided a forum for meetings between experts and practitioners in the field of inclusive employment in Cambodia, as well as between candidates and potential employers. The event was also marked by a major announcement from the <strong>Cambodian government</strong>: the creation of a grant to finance vocational training for people with disabilities, pledging the sustainability of the Foundation’s actions over the past 30 years.</p>',
    'image' => 'news/bWCnzvumSmY0oCJXu2pED8hiamkG0O8GAAb3IvIJ.png',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2023-12-18 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/non-classifiee',
        'label' => 'Non classifié(e)',
      ),
      2 => 
      array (
        'url' => '/topics/academic-and-career-counselling',
        'label' => 'Academic and Career Counselling',
      ),
    ),
  ),
  24 => 
  array (
    'title' => 'A New Director at the Teuk Thla Center',
    'slug' => 'a-new-director-at-the-teuk-thla-center',
    'excerpt' => 'Phanna and Phanith at the Teuk Thla temporary protection center in Phnom Penh. SOK Phanna, or "Dad" as the children call him, greets us one morning in November at the Teuk Thla temporary protection center in Phnom Penh. As he has done every day for the past 30 years.',
    'content' => '<p class="text-center text-sm italic">Phanna and Phanith at the Teuk Thla temporary protection center in Phnom Penh.</p><p>SOK Phanna, or “Dad” as the children call him, greets us one morning in November at the Teuk Thla temporary protection center in Phnom Penh. As he has done every day for the past 30 years, he is preparing to dedicate his day to the capital’s underprivileged children.</p><p><strong>“I joined Krousar Thmey in 1993,”</strong> he recalls. “At the time, Bénito was looking for educators to work with street children at the Psar Depot center in Phnom Penh. I had already worked for ten years in paediatric care in the Site II refugee camp in Thailand, and I knew I wanted to work with children. <strong>Myself lost my father at the age of eight and grew up in a Pagoda.</strong> Their stories touched me and I wanted to contribute to a positive change in society. In 1997, the situation necessitated the opening of a new reception center in the capital, Chamkar Mon, followed by several family homes across the country. I recruited the new teams and supervised these structures until 2013. After that, I dedicated myself to my role as <strong>Director of the Chamkar Mon center, which will move to Teuk Thla in 2022.</strong>”</p><p>Born in 1954, <strong>Phanna is now preparing for retirement</strong>. Next January, he will hand over to Phanith, the current team leader of the social workers at the Teuk Thla center and <strong>a former Krousar Thmey beneficiary</strong>. Quite a symbol.</p><p></p><p><img src="/storage/news/gallery/DbovYWic3RkJCR5zHcQPvZaU3QTI0B8VZVwQrSQa.jpg" alt=""></p><p></p><p></p><p class="text-center text-sm italic">SOK Phanna, late 90s, accompanied disadvantaged children from Poipet to a protection center in Sihanoukville.</p><p>“I have no regrets,” says Phanna. “I’m happy and proud to have worked for Krousar Thmey for 30 years.” As for Phanith, he points out: “I think he’ll make a good manager, because he’s a quick learner and knows how to take the initiative. If I had to give him one piece of advice, it would be to follow these three values: respect, honesty, and compassion. In all circumstances.”</p><p>For his part, Phanith recalls: “<strong>For me, Krousar Thmey is like a second home, and working for the Foundation is also a way of giving back what I’ve been given.</strong> I’m delighted and honored by this appointment; it’s already a form of accomplishment, and I can’t wait to get started.”</p>',
    'image' => 'news/FWHzrw2cVe6uENyS2wwALpPB5eLE1sOVVpEKg8gj.png',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2023-12-10 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/child-welfare',
        'label' => 'Child welfare',
      ),
      2 => 
      array (
        'url' => '/topics/cultural-and-artistic-development',
        'label' => 'Cultural and artistic development',
      ),
    ),
  ),
  25 => 
  array (
    'title' => 'Towards a New European Medical Team',
    'slug' => 'towards-a-new-european-medical-team',
    'excerpt' => 'The health of the children in our care is a priority for Krousar Thmey. For more than 20 years, a team of Swiss doctors from Krousar Thmey Switzerland has travelled to Cambodia once or twice a year to monitor the health of the young beneficiaries, in addition to their local medical staff.',
    'content' => '<p>The health of the children in our care is a priority for Krousar Thmey. For more than 20 years, a team of Swiss doctors from Krousar Thmey Switzerland has travelled to Cambodia once or twice a year to monitor the health of the young beneficiaries, in addition to their regular visits to local doctors. However, to ensure the sustainability of its actions, Krousar Thmey is also turning to other committed and supportive organisations.</p><p>In this context, the Foundation signed a new partnership with the French NGO Help Kampuchea last May.</p><p></p><p>Help Kampuchea was set up in 2012 to provide high-quality medical care to disadvantaged people in Cambodia. Their first mission with Krousar Thmey took place from 17 to 26 July. Led by six volunteers, including a doctor, physiotherapists, an etiopath and a nurse, they examined 118 children in long-term and temporary protection centres, as well as in family houses.</p><p></p><p><img src="/storage/news/gallery/KXe6oqZfecZaSt3wB4dhFjc1NjSNkhcP8mVVOcJd.jpg"></p><p class="text-center text-sm italic">The Help Kampuchea team making a medical check-up at the Takhmao protection centre, with Krousar Thmey’s health adviser, Sothy KEO.</p><div class="not-prose flex justify-center my-6">
    <iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2FHelpKampuchea%2Fposts%2F589883323313116&amp;show_text=true&amp;width=500" width="500" height="734" style="border:none;overflow:hidden;max-width:100%;" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
</div><p><em>The young health professionals also seized the opportunity to be dazzled by Cambodia and its wonders.</em></p><p>At the same time, 63 members of Krousar Thmey staff and parents of children from outside cases received first aid training. </p><p></p><p>The sessions were both theoretical and practical, and provided a reminder of the correct actions to take in case of an accident, such as cardiac massage, clearing the airway and placing the patient in the lateral safety position. The teams were also able to practise treating wounds and reacting to convulsions.</p><p></p><p><img src="/storage/news/gallery/Ede2jTMorWa7MMibXxLYdcDykxx0Awn0MOA3otQd.jpg"></p><p class="text-center text-sm italic">During the practical exercises, Help Kampuchea used medical dummies to make the explanations more concrete, here at the Poipet temporary protection centre.</p><p></p><p>Krousar Thmey is delighted with this new partnership and warmly thanks the Help Kampuchea team for its professionalism and friendly approach. The next mission is already scheduled for the summer of 2024.</p><p></p><div x-data="{ open: false }" class="not-prose bg-gray-50 rounded-2xl border border-gray-100 overflow-hidden my-8">
    <button @click="open = !open" type="button" class="w-full flex items-center justify-between p-5 text-left hover:bg-gray-100/50 transition-colors focus:outline-none">
        <span class="text-[#1a3c6e] font-bold text-sm">About Krousar Thmey</span>
        <svg class="w-5 h-5 text-[#1a3c6e] flex-shrink-0 transform transition-transform duration-300" :class="open ? \'rotate-180\' : \'\'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    <div x-show="open" style="display:none;" class="px-5 pb-5 pt-1 border-t border-gray-200/50 space-y-3" x-transition="">
        <p class="text-gray-700 text-sm leading-relaxed">Krousar Thmey is the first Cambodian organisation to help disadvantaged children, founded in 1991 in the Site II refugee camp in Thailand.</p>
        <p class="text-gray-700 text-sm leading-relaxed">Krousar Thmey offers a portfolio of cross-cutting programs and projects supporting 2,574 children in their development in 2022: Child Welfare, specialized and inclusive Education for Deaf or Blind Children, Cultural and Artistic Development, Academic and Career Counseling, as well as Health and Hygiene. In 2022, more than 3,700 people have benefited from the Foundation’s activities.</p>
        <p class="text-gray-700 text-sm leading-relaxed">In the spirit of sustainable action, Krousar Thmey ensures that its support <strong>does not lead to any privilege, dependence or disparity in the community</strong>.</p>
        <p class="text-gray-700 text-sm leading-relaxed">Krousar Thmey’s main principle is the development of projects <strong>led by Cambodians for Cambodians</strong>. Only two European volunteers provide the organization with support in communication, donor relations, and grant contract management.</p>
        <p class="text-gray-700 text-sm leading-relaxed">Apolitical and secular, the action of Krousar Thmey has been acknowledged internationally for its impact, capacity for innovation and sustainability.</p>
    </div>
</div><p></p>',
    'image' => 'news/toeq2787DsDTUSd0UgmCGC5nTZKeo76t4PU3qpme.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2023-10-25 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/child-welfare',
        'label' => 'Child welfare',
      ),
      2 => 
      array (
        'url' => '/topics/france',
        'label' => 'France',
      ),
      3 => 
      array (
        'url' => '/topics/health-and-hygiene',
        'label' => 'Health and hygiene',
      ),
    ),
  ),
  26 => 
  array (
    'title' => 'Krousar Thmey Steps Up Training for All Its Staff',
    'slug' => 'krousar-thmey-steps-up-training-for-all-its-staff',
    'excerpt' => 'Krousar Thmey is fully aware of the value of human resources and pays great attention to the skills of its teams. The training of the men and women who contribute to the daily life of the NGO in the field has therefore been a constant focus of efforts for many years.',
    'content' => '<p><strong>Krousar Thmey is fully aware of the value of human resources and pays great attention to the skills of its teams.</strong> The training of the men and women who contribute to the daily life of the NGO in the field has therefore been a constant focus of efforts for many years</p><p>Last May, for the first time, the caregivers and cooks in the protection centres, as well as the mothers in the family homes, were trained together by our regular trainer, Patrick Labelle. At the heart of this initiative is the desire to build the capacity of all those involved at Krousar Thmey, including those without qualifications or any particular technical expertise.</p><p><img src="/storage/news/gallery/zi3pDUbvTlYF6YbEPfIfTpj1qpeXBkoUZTNCNlBJ.jpg" alt="These training sessions were organised in Siem Reap and led by Krousar Thmey\'s Director, Darong CHOUR, and one of its regular speakers, Patrick LABELLE"></p><p class="text-center text-sm italic">These training sessions were organised in Siem Reap and led by Krousar Thmey’s Director, Darong CHOUR, and one of its regular speakers, Patrick LABELLE.</p><p>Indeed, caring for children in vulnerable situations does not stop with social workers. While social workers are involved both upstream and downstream of an admission, it is the carers, cooks and mothers who are responsible for the day-to-day upbringing of the youngsters within the facilities. So, in addition to the practical care they already provide, it was important to develop their psychosocial skills.</p><p>In concrete terms, these training sessions aim to improve the quality of care for children by providing keys to pedagogy and sharing the right reflexes to have when supervising children, to stimulate them, encourage them to think and exercise their critical thinking skills. At the end of these sessions, the staff were invited to define an action plan, including new methods of organisation and education with the children. The first assessment will be made in a year’s time.</p><div x-data="{ open: false }" class="not-prose bg-gray-50 rounded-2xl border border-gray-100 overflow-hidden my-8">
    <button @click="open = !open" type="button" class="w-full flex items-center justify-between p-5 text-left hover:bg-gray-100/50 transition-colors focus:outline-none">
        <span class="text-[#1a3c6e] font-bold text-sm">About Krousar Thmey</span>
        <svg class="w-5 h-5 text-[#1a3c6e] flex-shrink-0 transform transition-transform duration-300" :class="open ? \'rotate-180\' : \'\'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    <div x-show="open" style="display:none;" class="px-5 pb-5 pt-1 border-t border-gray-200/50 space-y-3" x-transition="">
        <p class="text-gray-700 text-sm leading-relaxed">Krousar Thmey is the first Cambodian organisation to help disadvantaged children, founded in 1991 in the Site II refugee camp in Thailand.</p>
        <p class="text-gray-700 text-sm leading-relaxed">Krousar Thmey offers a portfolio of cross-cutting programs and projects supporting 2,574 children in their development in 2022: Child Welfare, specialized and inclusive Education for Deaf or Blind Children, Cultural and Artistic Development, Academic and Career Counseling, as well as Health and Hygiene. In 2022, more than 3,700 people have benefited from the Foundation’s activities.</p>
        <p class="text-gray-700 text-sm leading-relaxed">In the spirit of sustainable action, Krousar Thmey ensures that its support <strong>does not lead to any privilege, dependence or disparity in the community</strong>.</p>
        <p class="text-gray-700 text-sm leading-relaxed">Krousar Thmey’s main principle is the development of projects <strong>led by Cambodians for Cambodians</strong>. Only two European volunteers provide the organization with support in communication, donor relations, and grant contract management.</p>
        <p class="text-gray-700 text-sm leading-relaxed">Apolitical and secular, the action of Krousar Thmey has been acknowledged internationally for its impact, capacity for innovation and sustainability.</p>
    </div>
</div><p></p>',
    'image' => 'news/vbHoJ25auxFiQxRgs2PTTND9Yfqmvw9SsWVdkoM5.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2023-10-25 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/child-welfare',
        'label' => 'Child welfare',
      ),
    ),
  ),
  27 => 
  array (
    'title' => 'New Touring Exhibition on Krousar Thmey\'s History',
    'slug' => 'new-touring-exhibition-on-krousar-thmeys-history',
    'excerpt' => 'Here, the exhibition "Krousar Thmey, 30 years of history in Cambodia", on display in the gardens of the French Institute in Cambodia. For over 30 years, Krousar Thmey has witnessed and contributed to the development of Cambodia, a country devastated by war from 1970.',
    'content' => '<p class="text-center text-sm italic">Here, the exhibition “Krousar Thmey, 30 years of history in Cambodia”, on display in the gardens of the French Institute in Cambodia.</p><p><strong>For over 30 years, Krousar Thmey has witnessed and contributed to the development of Cambodia</strong>, a country devastated by war from 1970 to 1991. We are currently telling this very special story through the touring exhibition “Krousar Thmey, 30 years of history in Cambodia”, inaugurated on 15th June at the Institut Français du Cambodge in the presence of H.E. Dr Hang Chuon Naron, <strong>Cambodia’s Minister of Education, Youth and Sport</strong>, H.E. Mr Jacques Pellet, <strong>French Ambassador to Cambodia</strong> and <strong>our founder, Mr Benoît Duchâteau-Arminjon</strong>, known as Benito.</p><div class="not-prose flex justify-center my-6">
    <iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fkrousarthmeyfoundation%2Fposts%2F636984608459997&amp;show_text=true&amp;width=500" width="500" height="734" style="border:none;overflow:hidden;max-width:100%;" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
</div><p>Over 250 archive photos and texts in 3 languages (French, Khmer, English) retrace the history of the NGO, from its <strong>creation in the Site II refugee camp in Thailand in 1991</strong>, to the development of a special education system for deaf and blind children from scratch, via the promotion of <strong>traditional Khmer arts</strong>, which were almost decimated by the Khmer Rouge.</p><div class="not-prose relative w-full overflow-hidden rounded-lg" style="padding-top: 56.25%;"><iframe src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Fwatch%2F%3Fv%3D230604813193117&amp;show_text=false" class="absolute inset-0 w-full h-full" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe></div><p>The exhibition is also a great opportunity to <strong>raise public awareness</strong> of visual and hearing disabilities. Workshops introducing children to <strong>Braille and Khmer sign language</strong> are being organised with the help of the National Institute for Special Education (NISE). A number of <strong>objects</strong>, both past and recent, dedicated to education for the deaf and blind are also on display <strong>to illustrate practices and how they have evolved</strong>.</p><p><img src="/storage/news/gallery/Ig1nenLFWxxtFjqYJw0koe2MrvVhB9Qhah0gucer.jpg" alt="Among other things, visitors can discover the first Braille typewriters introduced in Cambodia"></p><p class="text-center text-sm italic">Among other things, visitors can discover the first Braille typewriters introduced in Cambodia, known as Perkins machines, magnifying glasses and old relief maps.</p><p><strong>The exhibition is currently touring the capital to reach a wide audience.</strong> After the French Institute and the NGO Taramana, several schools will be hosting the exhibition from September, including the Ecole Française Internationale and the Lycée Français René Descartes.</p><div x-data="{ open: false }" class="not-prose bg-gray-50 rounded-2xl border border-gray-100 overflow-hidden my-8">
    <button @click="open = !open" type="button" class="w-full flex items-center justify-between p-5 text-left hover:bg-gray-100/50 transition-colors focus:outline-none">
        <span class="text-[#1a3c6e] font-bold text-sm">About Krousar Thmey</span>
        <svg class="w-5 h-5 text-[#1a3c6e] flex-shrink-0 transform transition-transform duration-300" :class="open ? \'rotate-180\' : \'\'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    <div x-show="open" style="display:none;" class="px-5 pb-5 pt-1 border-t border-gray-200/50 space-y-3" x-transition="">
        <p class="text-gray-700 text-sm leading-relaxed">Krousar Thmey is the first Cambodian organisation to help disadvantaged children, founded in 1991 in the Site II refugee camp in Thailand.</p>
        <p class="text-gray-700 text-sm leading-relaxed">Krousar Thmey offers a portfolio of cross-cutting programs and projects supporting 2,574 children in their development in 2022: Child Welfare, specialized and inclusive Education for Deaf or Blind Children, Cultural and Artistic Development, Academic and Career Counseling, as well as Health and Hygiene. In 2022, more than 3,700 people have benefited from the Foundation’s activities.</p>
        <p class="text-gray-700 text-sm leading-relaxed">In the spirit of sustainable action, Krousar Thmey ensures that its support <strong>does not lead to any privilege, dependence or disparity in the community</strong>.</p>
        <p class="text-gray-700 text-sm leading-relaxed">Krousar Thmey’s main principle is the development of projects <strong>led by Cambodians for Cambodians</strong>. Only two European volunteers provide the organization with support in communication, donor relations, and grant contract management.</p>
        <p class="text-gray-700 text-sm leading-relaxed">Apolitical and secular, the action of Krousar Thmey has been acknowledged internationally for its impact, capacity for innovation and sustainability.</p>
    </div>
</div><p></p>',
    'image' => 'news/bSgCzLk9VMMVoHadm2FYyq9PcVgHsIQWP8rLbIFg.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2023-10-24 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/academic-and-career-counselling',
        'label' => 'Academic and career counselling',
      ),
      1 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      2 => 
      array (
        'url' => '/topics/child-welfare',
        'label' => 'Child welfare',
      ),
      3 => 
      array (
        'url' => '/topics/cultural-and-artistic-development',
        'label' => 'Cultural and artistic development',
      ),
      4 => 
      array (
        'url' => '/topics/education-for-deaf-and-blind-children',
        'label' => 'Education for deaf and blind children',
      ),
      5 => 
      array (
        'url' => '/topics/france',
        'label' => 'France',
      ),
      6 => 
      array (
        'url' => '/topics/health-and-hygiene',
        'label' => 'Health and hygiene',
      ),
      7 => 
      array (
        'url' => NULL,
        'label' => 'Switzerland',
      ),
    ),
  ),
  28 => 
  array (
    'title' => 'Official Ceremony of Transfer of the Five Special Schools to the Cambodian Government',
    'slug' => 'official-ceremony-of-transfer-of-the-five-special-schools-to-the-cambodian-government',
    'excerpt' => 'During the Ceremony of transfer of Krousar Thmey\'s five special schools to the Ministry of Education, Youth and Sports (MoEYS), Benoît Duchâteau-Arminjon symbolically handed in the keys of our schools to the Cambodian Prime Minister S.E.',
    'content' => '<p>During the Ceremony of transfer of Krousar Thmey’s five special schools to the Ministry of Education, Youth and Sports (MoEYS), Benoît Duchâteau-Arminjon symbolically handed in the keys of our schools to the Cambodian Government, with the Cambodian Prime Minister S.E. Hun Sen.</p><p>25 years after the creation of the Education for deaf or blind children Program, Krousar Thmey is proud to have transferred the special schools while keeping its involvement with the Ministry of Education in the future, especially by:</p><ul><li><strong>an audit</strong> twice a year for three years;</li><li><strong>the coordination</strong> of specific projects, notably related to inclusive education;</li><li><strong>the development of appropriate resources</strong>, in partnership with relevant ministerial entities;</li><li><strong>its support to the government</strong> for the implementation of inclusive and special education policies and activities;</li><li><strong>its role as technical advisor to the Ministry</strong> for the teaching practices, status of staff and adapted care of students with disabilities.</li></ul><div class="not-prose my-8">
    <h3 class="text-lg font-bold text-[#1a3c6e] mb-1">Krousar Thmey history</h3>
    <p class="text-sm text-gray-500 mb-4">Find out how it all started for Krousar Thmey, from its beginning until nowadays.</p>
    <div class="relative w-full overflow-hidden rounded-lg" style="padding-top: 56.25%;">
        <iframe src="https://www.youtube.com/embed/OMXpGQwWDos" class="absolute inset-0 w-full h-full" frameborder="0" allowfullscreen="" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
    </div>
</div><p></p>',
    'image' => 'news/fUthvUgnI9AWRaOXbsm9oQw8jgRdTF6ZLsXCO2MK.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2019-10-24 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/child-welfare',
        'label' => 'Child welfare',
      ),
      2 => 
      array (
        'url' => '/topics/education-for-deaf-and-blind-children',
        'label' => 'Education for deaf and blind children',
      ),
    ),
  ),
  29 => 
  array (
    'title' => 'Krousar Thmey\'s Founder, Honoree of the 2019 Hero Award',
    'slug' => 'krousar-thmeys-founder-honoree-of-the-2019-award',
    'excerpt' => 'Benoît Duchâteau-Arminjon, founder of Krousar Thmey, received for the second time an award from World of Children honoring his action and that of the Foundation for the benefit of underprivileged children in Cambodia.',
    'content' => '<p>Benoît Duchâteau-Arminjon, founder of Krousar Thmey, received for the second time an award from World of Children honoring his action and that of the Foundation for the benefit of underprivileged children in Cambodia. <strong>Visit the page dedicated to Krousar Thmey</strong></p><p>To help Krousar Thmey increase its impact, World of Children has launched an online fundraising matching campaign: every dollar donated will be duplicated by the organization, to the benefit of Krousar Thmey. Thus, a $10 donation will be worth $20, and $100 will become $200!</p><p><strong>Donate now on the campaign page</strong></p><p class="text-sm text-gray-500">(donations not eligible for tax deductions in Europe)</p><p></p>',
    'image' => 'news/D1wAMkR09eesQeFwQOvqNRYjWN8lmVlOEI65v1IW.webp',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2019-03-27 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/child-welfare',
        'label' => 'Child welfare',
      ),
      2 => 
      array (
        'url' => '/topics/cultural-and-artistic-development',
        'label' => 'Cultural and artistic development',
      ),
      3 => 
      array (
        'url' => '/topics/education-for-deaf-and-blind-children',
        'label' => 'Education for deaf and blind children',
      ),
    ),
  ),
  30 => 
  array (
    'title' => 'Hearing Screening for Children in Sen Sok District',
    'slug' => 'hearing-screening-for-children-in-sen-sok-district',
    'excerpt' => '2500 children in the public schools of Sen Sok district will benefit from a hearing screening organized in collaboration with the School Health department of the Cambodian Ministry of Education, in order to identify children with possible hearing impairments.',
    'content' => '<p>2500 children in the public schools of Sen Sok district will benefit from a hearing screening organized in collaboration with the School Health department of the Cambodian Ministry of Education, in order to identify children with possible hearing impairments. Depending on their needs, Krousar Thmey will offer them adapted support, through the provision of a hearing aid or support in a special school.</p>',
    'image' => 'news/kVA4fEyzPuFYl24MqF9swo3ziGuEdEp3FRjQuLI7.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2018-11-28 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/child-welfare',
        'label' => 'Child welfare',
      ),
      2 => 
      array (
        'url' => '/topics/education-for-deaf-and-blind-children',
        'label' => 'Education for deaf and blind children',
      ),
    ),
  ),
  31 => 
  array (
    'title' => 'Good Team Spirit Training for Deaf People at Workplace',
    'slug' => 'good-team-spirit-training-for-deaf-people-at-workplace',
    'excerpt' => 'Today, Academic Career and Counselling team of Krousar Thmey organized a half day training workshop on theme of "Good Team Spirit" to 28 deaf students from grade 7 to grade 9 which is conducted by the Ministry of Hearing Impaired from Singapore comprising of deaf and hearing trainers.',
    'content' => '<p>Today, Academic Career and Counselling team of Krousar Thmey organized a half day training workshop on theme of “<strong>Good Team Spirit</strong>” to 28 deaf students from grade 7 to grade 9 which is conducted by the Ministry of Hearing Impaired from Singapore comprising of deaf and hearing trainers. At the beginning we play two games about teamwork. The first game was about the string and the ball, it is aiming at letting them work together as a team and not rushing but trying to understand each other. The next game is similar to previous one. We explained to them what was being asked in order to make them understand the goal working as a team so that they can do it together. However, before they understood the concept, some teams were rushing, and some teams did not discuss and plan – they just got excited and started doing the tasks straightaway as they could do. The third part is very essential for the deaf people to understand the working ethic in the future what the deaf community show respect the same for the deaf and the same for the hearing. Therefore, we do this activity to help deaf people to understand how to be strong and how to do really well at workplace regardless of they are deaf or hearing. It is intended to help them improve and build a strong partnership or relationship as a mixed team hard of hearing, deaf or hearing people particularly the working culture between the hearing and the deaf. Thanks the Ministry of hearing impaired team from Singapore for providing this useful training to our students.</p>',
    'image' => 'news/0Mihky0irZse9WbChdhnZnAxqrjvHl0VPALpTP2n.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2018-11-16 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/child-welfare',
        'label' => 'Child welfare',
      ),
      2 => 
      array (
        'url' => '/topics/academic-and-career-counselling',
        'label' => 'Academic and career counselling',
      ),
    ),
  ),
  32 => 
  array (
    'title' => 'The 2018 Awareness Campaign in Video',
    'slug' => 'the-2018-awareness-campaign-in-video',
    'excerpt' => 'Discover the video of our awareness campaign promoting the right to education for all, including children with disability, which took place in Stung Treng and Preah Vihear provinces.',
    'content' => '<p>Discover the video of our awareness campaign promoting the right to education for all, including children with disability, which took place in Stung Treng and Preah Vihear provinces.</p>',
    'image' => 'news/mjmBR1dULAPM4Cex8RoJexzCfN15TM0RbpX4vBtW.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2018-11-02 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/education-for-deaf-and-blind-children',
        'label' => 'Education for deaf and blind children',
      ),
    ),
  ),
  33 => 
  array (
    'title' => 'Awareness Concert on Education for Deaf or Blind Children 2018',
    'slug' => 'awareness-concert-on-education-for-deaf-or-blind-children-2018',
    'excerpt' => 'Awareness Concert on Education for Deaf or Blind Children will be held in two provinces, Stung Treng and Preah Vihear. Brothers, sisters, uncles, aunts, grandma, grandpa and everyone please come to enjoy the show altogether! Krousar Thmey Awareness Campaign.',
    'content' => '<p>Awareness Concert on Education for Deaf or Blind Children will be held in two provinces, Stung Treng and Preah Vihear. Brothers, sisters, uncles, aunts, grandma, grandpa and everyone please come to enjoy the show altogether!</p><p><img src="/storage/news/gallery/mrCO34b7BK5etVHK2hC5ZggPxWl458oe3TiGfFH6.jpg" alt="Krousar Thmey Awareness Campaign"></p><p class="text-center text-sm italic">Krousar Thmey Awareness Campaign</p><p></p>',
    'image' => 'news/TVETZ5xTbHZtWKMisMj2gz9ggeH32I4VwvP8LhWy.webp',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2018-08-08 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/education-for-deaf-and-blind-children',
        'label' => 'Education for deaf and blind children',
      ),
    ),
  ),
  34 => 
  array (
    'title' => 'Vincent de Wilde : Photographies',
    'slug' => 'vincent-de-wilde-photographies',
    'excerpt' => 'Discover Artist Photographer Vincent De Wilde, who offers to sell his beautiful artworks in black and white, which depict beauty, humanity and humor that make Cambodia today. 15% of sales profits are returned to Krousar Thmey. A big thank you for his generosity!',
    'content' => '<p>Discover Artist Photographer Vincent De Wilde, who offers to sell his beautiful artworks in black and white, which depict beauty, humanity and humor that make Cambodia today. 15 % of sales profits are returned to Krousar Thmey. A big thank you for his generosity!</p><p>Visit the website <a href="https://vincentdewilde.photodeck.com/" target="_blank" rel="noopener noreferrer">vincentdewilde.photodeck.com/</a></p><p></p>',
    'image' => 'news/Bgg76dvNxFVIgN9H1N3mGITYKtalx7qximxaAYrp.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2018-06-21 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/france',
        'label' => 'France',
      ),
      2 => 
      array (
        'url' => NULL,
        'label' => 'Switzerland',
      ),
    ),
  ),
  35 => 
  array (
    'title' => 'Medical Check-Up for Phnom Penh Students',
    'slug' => 'medical-check-up-for-phnom-penh-students',
    'excerpt' => 'Wednesday, a team of 15 doctors from SEN SOK Cambodia-China Friendship Referral Hospital provided a free-of-charge medical consultation to all the children at Phnom Penh Thmey school. Many thanks to our partners for their dedication to the children!',
    'content' => '<p>Wednesday, a team of 15 doctors from SEN SOK Cambodia-China Friendship Referral Hospital provided a free-of-charge medical consultation to all the children at Phnom Penh Thmey school. Many thanks to our partners for their dedication to the children!</p>',
    'image' => 'news/KUn1Pxx3O5G9xAHYiK06FYTKe2K6NMvLNZNrvJov.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2018-05-31 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/education-for-deaf-and-blind-children',
        'label' => 'Education for deaf and blind children',
      ),
      2 => 
      array (
        'url' => '/topics/health-and-hygiene',
        'label' => 'Health and hygiene',
      ),
    ),
  ),
  36 => 
  array (
    'title' => 'Exchange with the Lycée René Descartes of Phnom Penh',
    'slug' => 'exchange-with-the-lycee-rene-descartes-of-phnom-penh',
    'excerpt' => 'The students from the French Highschool came to visit our students at Phnom Penh Thmey school to know more about children with disability and discover how they can learn just like them. This exchange program is organized as part of Krousar Thmey\'s awareness-raising activities.',
    'content' => '<p>The students from the French Highschool came to visit our students at Phom Penh Thmey school to know more about children with disability and discover how they can learn just like them. This exchange program is organized as part of Krousar Thmey’s awareness-raising activities. But it is also about open up new horizons to our students. Therefore, it will be their turn next week to visit the French school, where the students have imagined tailored activities and games just for them… to be continued !</p>',
    'image' => 'news/TO1QpgoehgVOhTpCbH3Y8g90WjEnbZsTK5VCY4kd.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2018-05-31 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/education-for-deaf-and-blind-children',
        'label' => 'Education for deaf and blind children',
      ),
    ),
  ),
  37 => 
  array (
    'title' => 'Positive Change About Young University Learner Borey Sun',
    'slug' => 'positive-change-about-young-university-learner-borey-sun',
    'excerpt' => 'Before learning about Krousar Thmey program, I did not know how Khmer alphabet look like owing to my blindness – how do I communicate with sighted people outside apart from home. Big change of my life started when I came to special education of Krousar Thmey.',
    'content' => '<p>Before learning about Krousar Thmey program, I did not know how Khmer alphabet look like owing to my blindness – how do I communicate with sighted people outside apart from home. Big change of my life started when I came to special education of Krousar Thmey where I met different students with disability, deaf or blind – then I realized that I was not alone.</p><p><a href="https://www.facebook.com/krousarthmeyfoundation/photos/a.284772454955678.50774.284720751627515/1361504733949106/?type=3&amp;theater" target="_blank" rel="noopener noreferrer">Read More</a></p><p></p>',
    'image' => 'news/kUHQOSCF6NzAspxnTByyjLZS7ujFAspz8xct0hke.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2018-03-26 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/education-for-deaf-and-blind-children',
        'label' => 'Education for deaf and blind children',
      ),
    ),
  ),
  38 => 
  array (
    'title' => 'Make A Difference for Valentine Day!',
    'slug' => 'make-a-difference-for-valentine-day',
    'excerpt' => 'Thanks Mekong Scenery and Art Club of Cambodian Mekong University teamwork for organizing the crucial charity event on the valentine day aiming at collecting donation to support Krousar Thmey children. This event was presided over by H.E Em Chan Makara and vice rector.',
    'content' => '<p>Thanks Mekong Scenery and Art Club of Cambodian Mekong University teamwork for organizing the crucial charity event on the valentine day aiming at collecting donation to support Krousar Thmey children. This event was presided over by H.E Em Chan Makara and vice rector of the university. On behalf of our children, we would like to thank you very much the organizer crew and its sponsor as well as all students and teachers for their kind heart contribution to this event. <a href="https://www.facebook.com/krousarthmeyfoundation/photos/pcb.1331039843662262/1331037330329180/?type=3&amp;theater" target="_blank" rel="noopener noreferrer">See more on facebook</a></p><p></p>',
    'image' => 'news/uDRpZZE42pYbJTMXmWxMvOC3JnUjcLq72zEy75C1.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2018-02-15 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/education-for-deaf-and-blind-children',
        'label' => 'Education for deaf and blind children',
      ),
    ),
  ),
  39 => 
  array (
    'title' => '"The Children of Krousar Thmey" Documentary at the Meta House in Phnom Penh',
    'slug' => 'the-children-of-krousar-thmey-documentary-at-the-meta-house-in-phnom-penh',
    'excerpt' => 'A new documentary, "The Children of Krousar Thmey," premiered at the Meta House in Phnom Penh, offering an intimate look at daily life inside our centers and schools for children with disabilities.',
    'content' => '<p>Thanks Mekong Scenery and Art Club of Cambodian Mekong University teamwork for organizing the crucial charity event on the valentine day aiming at collecting donation to support Krousar Thmey children. This event was presided over by H.E Em Chan Makara and vice rector of the university. On behalf of our children, we would like to thank you very much the organizer crew and its sponsor as well as all students and teachers for their kind heart contribution to this event. <a href="https://www.facebook.com/krousarthmeyfoundation/photos/pcb.1331039843662262/1331037330329180/?type=3&amp;theater" target="_blank" rel="noopener noreferrer">See more on facebook</a></p><p></p>',
    'image' => 'news/h0fpCldcmLIRUdy40JI0vTAy1essTi2e7vN8fe2O.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2018-02-14 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/child-welfare',
        'label' => 'Child welfare',
      ),
    ),
  ),
  40 => 
  array (
    'title' => 'Krousar Thmey Staff Retreat 2018!',
    'slug' => 'krousar-thmey-staff-retreat-2018',
    'excerpt' => 'Krousar Thmey\'s staff all gathered in Kampot for a 2 days staff retreat, mixing work sessions to define the 2018 strategy and fun activities to reinforce our team spirit. See more pictures on our Facebook page.',
    'content' => '<p>Krousar Thmey’s staff all gathered in Kampot for a 2 days staff retreat, mixing work sessions to define the 2018 strategy and fun activities to reinforce our team spirit.</p><p>See more pictures <a href="https://www.facebook.com/krousarthmeyfoundation/posts/1321188554647391" target="_blank" rel="noopener noreferrer">on our Facebook page</a></p><p></p>',
    'image' => 'news/5QCJDbYlLtU0W2rhiQS5LBJsY0t50Vc1BE9CruEV.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2018-02-06 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
    ),
  ),
  41 => 
  array (
    'title' => 'Help Us Get a New Braille Machine!',
    'slug' => 'help-us-get-a-new-braille-machine',
    'excerpt' => 'Our Braille workshop that prints and distributes all documents for Krousar Thmey\'s students from Kindergarten to University needs a new Braille machine! Thanks to the initiative of one of our long-time partner, M. Mark Siliman, you can help us raise enough money.',
    'content' => '<p>Our Braille workshop that prints and distributes all documents for Krousar Thmey\'s students from Kindergarten to University needs a new Braille machine!</p><p>Thanks to the initiative of one of our long-time partners, M. Mark Siliman, you can help us raise enough money to replace this essential piece of equipment.</p>',
    'image' => 'news/lfJ8oLYG84loaAhX4obW1mdoKyyvRX64wf3KUv6J.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2018-01-25 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/education-for-deaf-and-blind-children',
        'label' => 'Education for deaf and blind children',
      ),
    ),
  ),
  42 => 
  array (
    'title' => 'First Place at the ISF Tournament!',
    'slug' => 'first-place-at-the-isf-tournament',
    'excerpt' => 'Congratulation to our deaf students team from Battambang school, who won the ISF football tournament for children with hearing impairment last Saturday. To know more, read the Phnom Penh Post article.',
    'content' => '<p>Congratulation to our deaf students team from Battambang school, who won the ISF football tournament for children with hearing impairment last Saturday.</p><p>To know more, read the <a href="http://www.phnompenhpost.com/sport/battambang-girls-romp-home-isf-comp-hearing-impaired" target="_blank" rel="noopener noreferrer">Phnom Penh post article</a></p><p></p>',
    'image' => 'news/S3q0e6ghfAYTd6i8DmgPjIQ2pLdywSQVupHUyYF1.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2018-01-02 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/education-for-deaf-and-blind-children',
        'label' => 'Education for deaf and blind children',
      ),
    ),
  ),
  43 => 
  array (
    'title' => 'Upcoming: Krousar Thmey\'s TV spot !',
    'slug' => 'upcoming-krousar-thmeys-tv-spot',
    'excerpt' => 'You followed with interest the shooting of our TV spot, it is coming soon! The launching date will be on 2nd October. Many thanks to all the participants, especially our amateur actors, but real talents!',
    'content' => '<p>You followed with interest the shooting of our TV spot, it is coming soon! The launching date will be on 2nd October. Many thanks to all the participants, especially our amateur actors, but real talents !</p><p><a href="https://www.facebook.com/krousarthmeyfoundation/posts/1205238716242376" target="_blank" rel="noopener noreferrer" class="not-prose inline-block bg-[#2d6fa3] text-white px-5 py-2.5 rounded-lg font-medium no-underline hover:bg-[#1a4a7a] transition-colors">See more on our Facebook page</a></p><p></p>',
    'image' => 'news/F2TzEmafgGNw6PDCcNg5ynvuZWTOzGJWg4MpYnrF.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2017-09-18 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/academic-and-career-counselling',
        'label' => 'Academic and career counselling',
      ),
      1 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      2 => 
      array (
        'url' => '/topics/education-for-deaf-and-blind-children',
        'label' => 'Education for deaf and blind children',
      ),
    ),
  ),
  44 => 
  array (
    'title' => 'Circus Practice',
    'slug' => 'circus-practice',
    'excerpt' => 'This week, our hearing impaired students in Battambang were training all together at the circus before performing the show during the awareness campaign on education for deaf or blind children in Kratie and Preveng provinces the first 2 weeks of October!',
    'content' => '<p>This week, our hearing impaired students in Battambang were training all together at the circus before performing the show during the awareness campaign on education for deaf or blind children in Kratie and Preveng provinces the first 2 weeks of October!</p><p><a href="https://www.facebook.com/krousarthmeyfoundation/posts/1205230699576511" target="_blank" rel="noopener noreferrer" class="not-prose inline-block bg-[#2d6fa3] text-white px-5 py-2.5 rounded-lg font-medium no-underline hover:bg-[#1a4a7a] transition-colors">See more on our Facebook page</a></p><p></p>',
    'image' => 'news/WrYR7G05fRMx6NdTF85enBlb4qtw9CzOYIjhQxc2.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2017-09-18 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/education-for-deaf-and-blind-children',
        'label' => 'Education for deaf and blind children',
      ),
    ),
  ),
  45 => 
  array (
    'title' => 'Mark the Date!',
    'slug' => 'mark-the-date',
    'excerpt' => 'On July 27th, Britcham Cambodia will be hosting a charity auction organized by the Cambodian artist and art teacher Chhan Dina, in collaboration with artists and friends, with the support of Cambodian Living Arts. The proceeds from this auction will support our arts.',
    'content' => '<p>On July 27th, Britcham Cambodia will be hosting a charity auction organized by the Cambodian artist and art teacher Chhan Dina, in collaboration with artists and friends, with the support of Cambodian Living Arts.</p><p>The proceeds from this auction will support our arts and cultural programs for children across Cambodia.</p>',
    'image' => 'news/Vg393rbHdmHuSBQ70HPu1TxiSD5PMqHJk5opNKB0.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2017-07-27 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/education-for-deaf-and-blind-children',
        'label' => 'Education for deaf and blind children',
      ),
    ),
  ),
  46 => 
  array (
    'title' => 'Visit at Passerelles Numériques',
    'slug' => 'visit-at-passerelles-numeriques',
    'excerpt' => 'This week, the Academic & Career Counselling team organized a full day visit for 11 students from the Child Welfare Program in Battambang, Siem Reap and Takhmao to Saint Paul Institute and PNC - Passerelles Numériques Cambodia. This visit aimed at allowing students.',
    'content' => '<p>This week, the Academic &amp; Career Counselling team organized a full day visit for 11 students from the Child Welfare Program in Battambang, Siem Reap and Takhmao to Saint Paul Institute and PNC - Passerelles Numériques Cambodia.</p><p>This visit aimed at allowing students to discover new vocational training and career pathways available to them after graduation.</p>',
    'image' => 'news/kqrVhPNlubyjIYFlYelMnMtkwFufOhd6sgXrGYtq.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2017-07-27 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/academic-and-career-counselling',
        'label' => 'Academic and career counselling',
      ),
      1 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
    ),
  ),
  47 => 
  array (
    'title' => 'Exchange Program with French High School René Descartes',
    'slug' => 'exchange-program-with-french-high-school-rene-descartes',
    'excerpt' => 'On Monday, our visually and hearing impaired students went to Lycée Français René-Descartes de Phnom Penh - Cambodge, introducing to their students sign language and cécifoot game. The goal of this meeting was for the students to communicate, play, learn and share.',
    'content' => '<p>On Monday, our visually and hearing impaired students went to Lycée Français René-Descartes de Phnom Penh - Cambodge, introducing to their students sign language and cécifoot game.</p><p>The goal of this meeting was for the students to communicate, play, learn and share, building friendships across schools and abilities.</p>',
    'image' => 'news/uc3hTv3jLsaS2JXvIZNf0Lo1RjdSLISPH6YpGodx.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2017-07-27 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/topics/cambodia',
        'label' => 'Cambodia',
      ),
      1 => 
      array (
        'url' => '/topics/education-for-deaf-and-blind-children',
        'label' => 'Education for deaf and blind children',
      ),
    ),
  ),
  48 => 
  array (
    'title' => 'Medical Check-Up',
    'slug' => 'medical-check-up',
    'excerpt' => 'Le 31 mai dernier, une équipe de 13 médecins de l\'hôpital public de Phnom Penh se sont rendus à l\'école pour enfants sourds ou aveugles de Phnom Penh Thmey pour effectuer un contrôle médical complet des élèves déficients visuels ou auditifs de l\'école, et aux enfants.',
    'content' => '<p>Le 31 mai dernier, une équipe de 13 médecins de l\'hôpital public de Phnom Penh se sont rendus à l\'école pour enfants sourds ou aveugles de Phnom Penh Thmey pour effectuer un contrôle médical complet des élèves déficients visuels ou auditifs de l\'école.</p><p>Ce suivi médical régulier permet de détecter rapidement tout problème de santé et d\'assurer le bien-être des enfants tout au long de l\'année scolaire.</p>',
    'image' => 'news/QzaQN5FpVDqp6QzmudSN0OlSCD0FsWlDHqQcGnYI.jpg',
    'category' => NULL,
    'videos' => 
    array (
    ),
    'is_published' => true,
    'published_at' => '2017-06-28 00:00:00',
    'links' => 
    array (
    ),
    'tag_links' => 
    array (
      0 => 
      array (
        'url' => '/news?tag=Academic+and+Career+Counselling',
        'label' => 'Academic and Career Counselling',
      ),
      1 => 
      array (
        'url' => '/news?tag=Cambodia',
        'label' => 'Cambodia',
      ),
      2 => 
      array (
        'url' => '/news?tag=Education+for+Deaf+and+Blind+Children',
        'label' => 'Education for Deaf and Blind Children',
      ),
    ),
  ),
);

        foreach ($articles as $article) {
            if (empty($article['category'])) {
                $article['category'] = 'general';
            }
            News::updateOrCreate(['slug' => $article['slug']], $article);
        }
    }
}
