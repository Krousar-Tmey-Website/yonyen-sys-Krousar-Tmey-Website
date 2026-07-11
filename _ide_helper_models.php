<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property int $year
 * @property string|null $file_path
 * @property string|null $file_url
 * @property string|null $description
 * @property int $sort_order
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string|null $download_url
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport whereFileUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport whereYear($value)
 */
	class AnnualReport extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string|null $recipient
 * @property string $organization
 * @property string|null $description
 * @property string|null $image
 * @property int $sort_order
 * @property bool $is_active
 * @property string|null $website_url
 * @property string|null $article_url
 * @property string|null $video_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string|null $image_url
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award ordered()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereArticleUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereOrganization($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereRecipient($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereVideoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereWebsiteUrl($value)
 */
	class Award extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $CategoryID
 * @property string $CategoryName
 * @property string|null $Description
 * @property int $CategoryStatus
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\News> $news
 * @property-read int|null $news_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereCategoryID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereCategoryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereCategoryStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $InquiryID
 * @property string $Name
 * @property string $Email
 * @property string $Subject
 * @property string $Message
 * @property \Illuminate\Support\Carbon $ReceivedDate
 * @property string $Status
 * @property string $TargetEntity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $Phone
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInquiry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInquiry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInquiry query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInquiry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInquiry whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInquiry whereInquiryID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInquiry whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInquiry whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInquiry wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInquiry whereReceivedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInquiry whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInquiry whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInquiry whereTargetEntity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInquiry whereUpdatedAt($value)
 */
	class ContactInquiry extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string $icon
 * @property string|null $image
 * @property string|null $description
 * @property int $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string|null $image_url
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue ordered()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue whereUpdatedAt($value)
 */
	class CoreValue extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $title
 * @property string|null $image
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereUpdatedAt($value)
 */
	class Gallery extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $year
 * @property string $left_text
 * @property string|null $right_text
 * @property int $sort_order
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HistoryEvent active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HistoryEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HistoryEvent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HistoryEvent query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HistoryEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HistoryEvent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HistoryEvent whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HistoryEvent whereLeftText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HistoryEvent whereRightText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HistoryEvent whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HistoryEvent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HistoryEvent whereYear($value)
 */
	class HistoryEvent extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $key
 * @property string|null $value
 * @property string|null $image
 * @property string|null $link
 * @property string|null $label
 * @property string $group
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HomeSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HomeSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HomeSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HomeSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HomeSetting whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HomeSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HomeSetting whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HomeSetting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HomeSetting whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HomeSetting whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HomeSetting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HomeSetting whereValue($value)
 */
	class HomeSetting extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $section_id
 * @property string $path
 * @property string|null $alt
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PageSection $section
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image whereAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image whereUpdatedAt($value)
 */
	class Image extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string|null $location
 * @property \Illuminate\Support\Carbon|null $posted_date
 * @property string|null $type
 * @property string $icon
 * @property string|null $image
 * @property string $status
 * @property bool $is_active
 * @property int $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity ordered()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity wherePostedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity whereUpdatedAt($value)
 */
	class JobOpportunity extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $section_id
 * @property string $text
 * @property string $url
 * @property string $type
 * @property string $target
 * @property int $order
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PageSection $section
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Link newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Link newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Link query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Link whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Link whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Link whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Link whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Link whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Link whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Link whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Link whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Link whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Link whereUrl($value)
 */
	class Link extends \Eloquent {}
}

namespace App\Models{
/**
 * Class News
 *
 * @method static \Illuminate\Database\Eloquent\Builder latest(string $column = 'created_at')
 * @method static \Illuminate\Contracts\Pagination\LengthAwarePaginator paginate(int $perPage = 15)
 * @method static \Illuminate\Database\Eloquent\Builder published()
 * @method bool delete()
 * @method static News find(int $id)
 * @method static News create(array $attributes = [])
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $excerpt
 * @property string|null $content
 * @property string|null $image
 * @property string $category
 * @property bool $is_published
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property string|null $links
 * @property string|null $tags
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category|null $categoryRelation
 * @property-read string $category_name
 * @property-read string $image_url
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereExcerpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereLinks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereUpdatedAt($value)
 */
	class News extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $subscribed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsletterSubscriber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsletterSubscriber newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsletterSubscriber query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsletterSubscriber whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsletterSubscriber whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsletterSubscriber whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsletterSubscriber whereSubscribedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsletterSubscriber whereUpdatedAt($value)
 */
	class NewsletterSubscriber extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $country
 * @property string $city
 * @property string $flag
 * @property string|null $badge
 * @property string $address
 * @property string|null $phone
 * @property string|null $email
 * @property string $accent_color
 * @property string $badge_color
 * @property int $sort_order
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Office active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Office newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Office newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Office query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Office whereAccentColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Office whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Office whereBadge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Office whereBadgeColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Office whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Office whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Office whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Office whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Office whereFlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Office whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Office whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Office wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Office whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Office whereUpdatedAt($value)
 */
	class Office extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $section_name
 * @property string|null $title
 * @property string|null $description
 * @property int $order
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Image> $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Link> $links
 * @property-read int|null $links_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageSection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageSection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageSection query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageSection whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageSection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageSection whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageSection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageSection whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageSection whereSectionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageSection whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageSection whereUpdatedAt($value)
 */
	class PageSection extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string|null $picture
 * @property string|null $country
 * @property string|null $logo
 * @property int $sort_order
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $PartnerID
 * @property string|null $PartnerName
 * @property string|null $PartnerType
 * @property string|null $ContactPerson
 * @property string|null $ContactEmail
 * @property string|null $ContactPhone
 * @property string|null $PartnershipStartDate
 * @property string|null $PartnershipEndDate
 * @property string|null $Description
 * @property string|null $PartnerLogo
 * @property string|null $Email
 * @property string|null $Phone
 * @property string|null $WebsiteURL
 * @property-read string|null $logo_url
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereContactEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereContactPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereContactPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner wherePartnerID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner wherePartnerLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner wherePartnerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner wherePartnerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner wherePartnershipEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner wherePartnershipStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereWebsiteURL($value)
 */
	class Partner extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Partner> $partners
 * @property-read int|null $partners_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PartnerCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PartnerCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PartnerCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PartnerCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PartnerCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PartnerCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PartnerCategory whereUpdatedAt($value)
 */
	class PartnerCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $description
 * @property string|null $full_description
 * @property string|null $image
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $ProgramID
 * @property string|null $ProgramName
 * @property string|null $StartDate
 * @property string|null $EndDate
 * @property numeric|null $Budget
 * @property string|null $Province
 * @property string|null $Status
 * @property string|null $testimony_name
 * @property string|null $testimony_story
 * @property string|null $testimony_image
 * @property string|null $facebook_url
 * @property string|null $linkedin_url
 * @property string|null $instagram_url
 * @property string|null $telegram_url
 * @property string|null $youtube_url
 * @property-read string $image_url
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Project> $projects
 * @property-read int|null $projects_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereBudget($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereFacebookUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereFullDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereInstagramUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereLinkedinUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereProgramID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereProgramName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereTelegramUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereTestimonyImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereTestimonyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereTestimonyStory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereYoutubeUrl($value)
 */
	class Program extends \Eloquent {}
}

namespace App\Models{
/**
 * @property-read string $image_url
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProgramPageItem> $items
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPage active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPage query()
 */
	class ProgramPage extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string|null $short_content
 * @property string|null $detail_content
 * @property string|null $image
 * @property string|null $image_2
 * @property string|null $image_3
 * @property bool $is_active
 * @property int $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string|null $image2_url
 * @property-read string|null $image3_url
 * @property-read string $image_url
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem whereDetailContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem whereImage2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem whereImage3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem whereShortContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem whereUpdatedAt($value)
 */
	class ProgramPageItem extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $image
 * @property string|null $banner_image
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $program_id
 * @property string|null $objective
 * @property string|null $content
 * @property string|null $activities
 * @property string|null $testimony_name
 * @property string|null $testimony_story
 * @property string|null $testimony_image
 * @property string|null $make_difference_text
 * @property string|null $grant_label
 * @property numeric|null $grant_amount
 * @property string|null $grant_recipient
 * @property string|null $area_of_work
 * @property string|null $duration
 * @property string|null $location
 * @property string|null $beneficiaries
 * @property-read mixed $image_url
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProjectGrant> $grants
 * @property-read int|null $grants_count
 * @property-read \App\Models\Program|null $program
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereActivities($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereAreaOfWork($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereBannerImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereBeneficiaries($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereGrantAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereGrantLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereGrantRecipient($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereMakeDifferenceText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereObjective($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereProgramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereTestimonyImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereTestimonyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereTestimonyStory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereUpdatedAt($value)
 */
	class Project extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $project_id
 * @property string|null $title
 * @property numeric|null $amount
 * @property string|null $label
 * @property string|null $recipient
 * @property int $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Project $project
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectGrant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectGrant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectGrant query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectGrant whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectGrant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectGrant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectGrant whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectGrant whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectGrant whereRecipient($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectGrant whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectGrant whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectGrant whereUpdatedAt($value)
 */
	class ProjectGrant extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $type
 * @property string $title
 * @property string|null $excerpt
 * @property string|null $link
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SiteNotification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SiteNotification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SiteNotification ordered()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SiteNotification query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SiteNotification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SiteNotification whereExcerpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SiteNotification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SiteNotification whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SiteNotification whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SiteNotification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SiteNotification whereUpdatedAt($value)
 */
	class SiteNotification extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string|null $subtitle
 * @property string|null $badge_text
 * @property string|null $image
 * @property string|null $cta_primary_text
 * @property string|null $cta_primary_url
 * @property string|null $cta_secondary_text
 * @property string|null $cta_secondary_url
 * @property int $sort_order
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $image_url
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereBadgeText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereCtaPrimaryText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereCtaPrimaryUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereCtaSecondaryText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereCtaSecondaryUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereUpdatedAt($value)
 */
	class Slide extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $name
 * @property string|null $role
 * @property string|null $content
 * @property string|null $image
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereUpdatedAt($value)
 */
	class Testimonial extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int $is_admin
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $AdminID
 * @property string|null $Role
 * @property int $Status
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAdminID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $full_name
 * @property string $email
 * @property string $phone
 * @property \Illuminate\Support\Carbon|null $date_of_birth
 * @property string|null $gender
 * @property string $country
 * @property string|null $address
 * @property string|null $availability
 * @property string $skills
 * @property string $motivation
 * @property string|null $interested_program
 * @property string|null $previous_experience
 * @property string|null $resume
 * @property string|null $emergency_contact
 * @property bool $agreed_to_terms
 * @property string|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Volunteer approved()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Volunteer interviewScheduled()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Volunteer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Volunteer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Volunteer pending()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Volunteer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Volunteer rejected()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Volunteer underReview()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Volunteer whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Volunteer whereAgreedToTerms($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Volunteer whereAvailability($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Volunteer whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Volunteer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Volunteer whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Volunteer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Volunteer whereEmergencyContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Volunteer whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Volunteer whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Volunteer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Volunteer whereInterestedProgram($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Volunteer whereMotivation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Volunteer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Volunteer wherePreviousExperience($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Volunteer whereResume($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Volunteer whereSkills($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Volunteer whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Volunteer whereUpdatedAt($value)
 */
	class Volunteer extends \Eloquent {}
}

