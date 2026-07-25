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
 * @property int|null $user_id
 * @property string $action
 * @property string|null $subject_type
 * @property string|null $subject_id
 * @property string|null $description
 * @property array<array-key, mixed>|null $properties
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|null $subject
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivityLog action(?string $action)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivityLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivityLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivityLog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivityLog whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivityLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivityLog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivityLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivityLog whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivityLog whereProperties($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivityLog whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivityLog whereSubjectType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivityLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivityLog whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivityLog whereUserId($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperActivityLog {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string|null $title_fr
 * @property int $year
 * @property string|null $file_path
 * @property string|null $original_filename
 * @property string|null $file_url
 * @property string|null $description
 * @property string|null $description_fr
 * @property int $sort_order
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string|null $download_url
 * @property-read bool $has_pdf_file
 * @property-read string|null $localized_description
 * @property-read string|null $localized_title
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport whereDescriptionFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport whereFileUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport whereOriginalFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport whereTitleFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AnnualReport whereYear($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperAnnualReport {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $title
 * @property string|null $title_fr
 * @property string|null $year
 * @property string|null $recipient
 * @property string|null $organization
 * @property string|null $description
 * @property string|null $description_fr
 * @property string|null $image
 * @property string|null $badge_image
 * @property string $icon
 * @property int $sort_order
 * @property bool $is_active
 * @property string|null $website_url
 * @property string|null $article_url
 * @property string|null $video_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string|null $image_url
 * @property-read string|null $localized_description
 * @property-read string|null $localized_title
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award ordered()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereArticleUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereBadgeImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereDescriptionFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereOrganization($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereRecipient($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereTitleFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereVideoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereWebsiteUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Award whereYear($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperAward {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string|null $title_fr
 * @property string|null $slug
 * @property string|null $description
 * @property string|null $description_fr
 * @property numeric|null $price
 * @property int $stock
 * @property string|null $cover_image
 * @property bool $is_available
 * @property int $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string|null $cover_image_url
 * @property-read string $formatted_price
 * @property-read string|null $localized_description
 * @property-read string $localized_title
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book available()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereCoverImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereDescriptionFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereIsAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereTitleFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereUpdatedAt($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperBook {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string|null $slug
 * @property string|null $title_fr
 * @property string|null $description
 * @property string|null $description_fr
 * @property numeric $goal_amount
 * @property numeric $collected_amount
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property bool $is_active
 * @property int $sort_order
 * @property string|null $image
 * @property string|null $video
 * @property string|null $youtube_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read int|null $days_remaining
 * @property-read string $days_remaining_label
 * @property-read string $formatted_collected
 * @property-read string $formatted_goal
 * @property-read bool $has_pdf
 * @property-read bool $has_uploaded_video
 * @property-read bool $has_video
 * @property-read bool $has_youtube
 * @property-read string|null $image_url
 * @property-read bool $is_ongoing
 * @property-read string|null $pdf_filename
 * @property-read string|null $pdf_url
 * @property-read float $progress_percentage
 * @property-read string $status
 * @property-read string $status_color
 * @property-read string $status_label
 * @property-read string|null $video_mime
 * @property-read string|null $video_url
 * @property-read string|null $youtube_embed_url
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign expired()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign ordered()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign upcoming()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereCollectedAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereDescriptionFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereGoalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereTitleFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereYoutubeUrl($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperCampaign {}
}

namespace App\Models{
/**
 * @property int $CategoryID
 * @property string $CategoryName
 * @property string|null $Description
 * @property int $CategoryStatus
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereCategoryID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereCategoryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereCategoryStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereUpdatedAt($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperCategory {}
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
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperContactInquiry {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string|null $title_fr
 * @property string|null $headline
 * @property string|null $headline_fr
 * @property string $icon
 * @property string|null $description
 * @property string|null $description_fr
 * @property string|null $supporting_description
 * @property string|null $supporting_description_fr
 * @property int $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $image
 * @property-read string|null $image_url
 * @property-read string|null $localized_description
 * @property-read string|null $localized_headline
 * @property-read string|null $localized_supporting_description
 * @property-read string $localized_title
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue ordered()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue whereDescriptionFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue whereHeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue whereHeadlineFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue whereSupportingDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue whereSupportingDescriptionFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue whereTitleFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CoreValue whereUpdatedAt($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperCoreValue {}
}

namespace App\Models{
/**
 * @property string $DonationID
 * @property string $DonorID
 * @property numeric $DonationAmount
 * @property string|null $DonationType
 * @property \Illuminate\Support\Carbon $DonationDate
 * @property string $PaymentMethod
 * @property bool $IsRecurring
 * @property bool $TaxReceiptIssued
 * @property string $FiscalResidency
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property numeric|null $Amount
 * @property string|null $Currency
 * @property string|null $TransactionID
 * @property string|null $Status
 * @property string|null $Notes
 * @property-read \App\Models\Donor $donor
 * @property-read float $effective_amount
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donation whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donation whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donation whereDonationAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donation whereDonationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donation whereDonationID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donation whereDonationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donation whereDonorID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donation whereFiscalResidency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donation whereIsRecurring($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donation whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donation wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donation whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donation whereTaxReceiptIssued($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donation whereTransactionID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donation whereUpdatedAt($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperDonation {}
}

namespace App\Models{
/**
 * @property string $DonorID
 * @property string $FirstName
 * @property string $LastName
 * @property string|null $Email
 * @property string|null $Address
 * @property string|null $Phone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $FullName
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Donation> $donations
 * @property-read int|null $donations_count
 * @property-read string $full_name
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donor query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donor whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donor whereDonorID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donor whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donor whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donor whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donor whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donor wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donor whereUpdatedAt($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperDonor {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $title
 * @property string|null $title_fr
 * @property string|null $image
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string|null $localized_title
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereTitleFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereUpdatedAt($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperGallery {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $year
 * @property string|null $left_text
 * @property string|null $left_text_fr
 * @property string|null $right_text
 * @property string|null $right_text_fr
 * @property int $sort_order
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $image
 * @property-read string|null $image_url
 * @property-read string|null $localized_left_text
 * @property-read string|null $localized_right_text
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HistoryEvent active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HistoryEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HistoryEvent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HistoryEvent query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HistoryEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HistoryEvent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HistoryEvent whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HistoryEvent whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HistoryEvent whereLeftText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HistoryEvent whereLeftTextFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HistoryEvent whereRightText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HistoryEvent whereRightTextFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HistoryEvent whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HistoryEvent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HistoryEvent whereYear($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperHistoryEvent {}
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
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperHomeSetting {}
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
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperImage {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $value
 * @property string $label
 * @property string|null $label_fr
 * @property string|null $description
 * @property string|null $description_fr
 * @property string|null $image
 * @property int $sort_order
 * @property bool $is_active
 * @property bool $is_featured
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string|null $localized_description
 * @property-read string|null $localized_label
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ImpactStatistic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ImpactStatistic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ImpactStatistic query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ImpactStatistic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ImpactStatistic whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ImpactStatistic whereDescriptionFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ImpactStatistic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ImpactStatistic whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ImpactStatistic whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ImpactStatistic whereIsFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ImpactStatistic whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ImpactStatistic whereLabelFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ImpactStatistic whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ImpactStatistic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ImpactStatistic whereValue($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperImpactStatistic {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string|null $title_fr
 * @property string|null $description
 * @property string|null $description_fr
 * @property string|null $location
 * @property \Illuminate\Support\Carbon|null $posted_date
 * @property string|null $type
 * @property string $status
 * @property bool $is_active
 * @property int $sort_order
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string|null $localized_description
 * @property-read string $localized_title
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity ordered()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity whereDescriptionFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity wherePostedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity whereTitleFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpportunity whereUpdatedAt($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperJobOpportunity {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $section_id
 * @property string $text
 * @property string|null $text_fr
 * @property string $url
 * @property string $type
 * @property string $target
 * @property int $order
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string|null $localized_text
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Link whereTextFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Link whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Link whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Link whereUrl($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperLink {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $province_key
 * @property string $province_label
 * @property string $location_name
 * @property string|null $location_name_fr
 * @property string $project_type
 * @property int $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string|null $localized_location_name
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MapProject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MapProject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MapProject ordered()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MapProject query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MapProject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MapProject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MapProject whereLocationName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MapProject whereLocationNameFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MapProject whereProjectType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MapProject whereProvinceKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MapProject whereProvinceLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MapProject whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MapProject whereUpdatedAt($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperMapProject {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string $type
 * @property string|null $file_path
 * @property string|null $external_url
 * @property string|null $description
 * @property string|null $alt_text
 * @property bool $is_active
 * @property int $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $image_url
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MediaGallery active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MediaGallery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MediaGallery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MediaGallery ordered()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MediaGallery query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MediaGallery whereAltText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MediaGallery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MediaGallery whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MediaGallery whereExternalUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MediaGallery whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MediaGallery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MediaGallery whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MediaGallery whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MediaGallery whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MediaGallery whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MediaGallery whereUpdatedAt($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperMediaGallery {}
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
 * @property string|null $title
 * @property string|null $title_fr
 * @property string|null $slug
 * @property string|null $excerpt
 * @property string|null $excerpt_fr
 * @property string|null $content
 * @property string|null $content_fr
 * @property string|null $image
 * @property string|null $gallery
 * @property array $videos
 * @property string $category
 * @property bool $is_published
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property array<array-key, mixed>|null $links
 * @property array $tag_links
 * @property string|null $tags
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $category_name
 * @property-read string $image_url
 * @property-read string|null $localized_content
 * @property-read string|null $localized_excerpt
 * @property-read string $localized_title
 * @property-read array $video_urls
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereContentFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereExcerpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereExcerptFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereGallery($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereLinks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereTagLinks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereTitleFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|News whereVideos($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperNews {}
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
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperNewsletterSubscriber {}
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
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperOffice {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $section_name
 * @property string|null $title
 * @property string|null $title_fr
 * @property string|null $description
 * @property string|null $description_fr
 * @property int $order
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string|null $localized_description
 * @property-read string|null $localized_title
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageSection whereDescriptionFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageSection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageSection whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageSection whereSectionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageSection whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageSection whereTitleFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageSection whereUpdatedAt($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperPageSection {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $category
 * @property string|null $subcategory
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
 * @property string|null $description
 * @property string|null $description_fr
 * @property string|null $PartnerLogo
 * @property string|null $Email
 * @property string|null $Phone
 * @property string|null $WebsiteURL
 * @property-read string|null $localized_description
 * @property-read string|null $logo_url
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereContactEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereContactPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereContactPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereDescriptionFr($value)
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereSubcategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Partner whereWebsiteURL($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperPartner {}
}

namespace App\Models{
/**
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Partner> $partners
 * @property-read int|null $partners_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PartnerCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PartnerCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PartnerCategory query()
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperPartnerCategory {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $content
 * @property int $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PartnerPrinciple newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PartnerPrinciple newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PartnerPrinciple query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PartnerPrinciple whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PartnerPrinciple whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PartnerPrinciple whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PartnerPrinciple whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PartnerPrinciple whereUpdatedAt($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperPartnerPrinciple {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PartnershipCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PartnershipCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PartnershipCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PartnershipCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PartnershipCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PartnershipCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PartnershipCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PartnershipCategory whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PartnershipCategory whereUpdatedAt($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperPartnershipCategory {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $name_fr
 * @property string|null $bank_type
 * @property string|null $account_name
 * @property string|null $account_no
 * @property string|null $currency
 * @property string|null $brand_color
 * @property string|null $qr_code
 * @property int $sort_order
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string|null $qr_code_url
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod ordered()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereAccountName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereAccountNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereBankType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereBrandColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereNameFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereQrCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereUpdatedAt($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperPaymentMethod {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string|null $title_fr
 * @property string|null $subtitle
 * @property string|null $subtitle_fr
 * @property string|null $badge_text
 * @property string|null $badge_text_fr
 * @property string|null $image
 * @property string|null $cta_primary_text
 * @property string|null $cta_primary_text_fr
 * @property string|null $cta_primary_url
 * @property string|null $cta_secondary_text
 * @property string|null $cta_secondary_text_fr
 * @property string|null $cta_secondary_url
 * @property int $sort_order
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $image_url
 * @property-read string|null $localized_badge_text
 * @property-read string|null $localized_cta_primary_text
 * @property-read string|null $localized_cta_secondary_text
 * @property-read string|null $localized_subtitle
 * @property-read string|null $localized_title
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationSlide active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationSlide newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationSlide newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationSlide query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationSlide whereBadgeText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationSlide whereBadgeTextFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationSlide whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationSlide whereCtaPrimaryText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationSlide whereCtaPrimaryTextFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationSlide whereCtaPrimaryUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationSlide whereCtaSecondaryText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationSlide whereCtaSecondaryTextFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationSlide whereCtaSecondaryUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationSlide whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationSlide whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationSlide whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationSlide whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationSlide whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationSlide whereSubtitleFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationSlide whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationSlide whereTitleFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentationSlide whereUpdatedAt($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperPresentationSlide {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $title
 * @property string|null $title_fr
 * @property string|null $image
 * @property int $sort_order
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $image_url
 * @property-read string|null $localized_title
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PrincipleSlide newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PrincipleSlide newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PrincipleSlide query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PrincipleSlide whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PrincipleSlide whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PrincipleSlide whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PrincipleSlide whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PrincipleSlide whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PrincipleSlide whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PrincipleSlide whereTitleFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PrincipleSlide whereUpdatedAt($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperPrincipleSlide {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $title
 * @property string|null $title_fr
 * @property string $slug
 * @property string|null $description
 * @property string|null $description_fr
 * @property string|null $full_description
 * @property string|null $full_description_fr
 * @property string|null $image
 * @property string|null $icon_image
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
 * @property string|null $Status_fr
 * @property string|null $testimony_name
 * @property string|null $testimony_name_fr
 * @property string|null $testimony_story
 * @property string|null $testimony_story_fr
 * @property string|null $testimony_image
 * @property string|null $facebook_url
 * @property string|null $linkedin_url
 * @property string|null $instagram_url
 * @property string|null $telegram_url
 * @property string|null $youtube_url
 * @property string|null $color
 * @property-read string|null $icon_image_url
 * @property-read string $image_url
 * @property-read string|null $localized_description
 * @property-read string|null $localized_full_description
 * @property-read string|null $localized_status
 * @property-read string|null $localized_testimony_name
 * @property-read string|null $localized_testimony_story
 * @property-read string $localized_title
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Project> $projects
 * @property-read int|null $projects_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereBudget($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereDescriptionFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereFacebookUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereFullDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereFullDescriptionFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereIconImage($value)
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereStatusFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereTelegramUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereTestimonyImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereTestimonyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereTestimonyNameFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereTestimonyStory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereTestimonyStoryFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereTitleFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Program whereYoutubeUrl($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperProgram {}
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
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperProgramPage {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $title
 * @property string|null $title_fr
 * @property string|null $objective
 * @property string|null $objective_fr
 * @property string|null $short_content
 * @property string|null $short_content_fr
 * @property string|null $detail_content
 * @property string|null $detail_content_fr
 * @property string|null $activities
 * @property string|null $activities_fr
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
 * @property-read string|null $localized_activities
 * @property-read string|null $localized_detail_content
 * @property-read string|null $localized_objective
 * @property-read string|null $localized_short_content
 * @property-read string|null $localized_title
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem whereActivities($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem whereActivitiesFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem whereDetailContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem whereDetailContentFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem whereImage2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem whereImage3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem whereObjective($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem whereObjectiveFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem whereShortContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem whereShortContentFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem whereTitleFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramPageItem whereUpdatedAt($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperProgramPageItem {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $title
 * @property string|null $title_fr
 * @property string|null $description
 * @property string|null $description_fr
 * @property string|null $image
 * @property string|null $banner_image
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $program_id
 * @property string|null $objective
 * @property string|null $objective_fr
 * @property string|null $content
 * @property string|null $content_fr
 * @property string|null $activities
 * @property string|null $activities_fr
 * @property string|null $testimony_name
 * @property string|null $testimony_name_fr
 * @property string|null $testimony_story
 * @property string|null $testimony_story_fr
 * @property string|null $testimony_image
 * @property string|null $make_difference_text
 * @property string|null $make_difference_text_fr
 * @property string|null $make_difference_title
 * @property string|null $make_difference_title_fr
 * @property string|null $donate_button_text
 * @property string|null $donate_button_text_fr
 * @property string|null $contact_button_text
 * @property string|null $contact_button_text_fr
 * @property string|null $grant_label
 * @property numeric|null $grant_amount
 * @property string|null $grant_recipient
 * @property string|null $area_of_work
 * @property string|null $area_of_work_fr
 * @property string|null $duration
 * @property string|null $duration_fr
 * @property string|null $location
 * @property string|null $location_fr
 * @property string|null $beneficiaries
 * @property string|null $beneficiaries_fr
 * @property-read string $effective_area_of_work
 * @property-read string $effective_beneficiaries
 * @property-read string $effective_contact_button_text
 * @property-read string $effective_donate_button_text
 * @property-read string $effective_duration
 * @property-read string $effective_location
 * @property-read string $effective_make_difference_text
 * @property-read string $effective_make_difference_title
 * @property-read mixed $image_url
 * @property-read string|null $localized_activities
 * @property-read string|null $localized_content
 * @property-read string|null $localized_description
 * @property-read string|null $localized_objective
 * @property-read string|null $localized_testimony_name
 * @property-read string|null $localized_testimony_story
 * @property-read string|null $localized_title
 * @property-read bool $uses_specific_page_details
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProjectGrant> $grants
 * @property-read int|null $grants_count
 * @property-read \App\Models\Program|null $program
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereActivities($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereActivitiesFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereAreaOfWork($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereAreaOfWorkFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereBannerImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereBeneficiaries($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereBeneficiariesFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereContactButtonText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereContactButtonTextFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereContentFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereDescriptionFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereDonateButtonText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereDonateButtonTextFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereDurationFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereGrantAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereGrantLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereGrantRecipient($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereLocationFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereMakeDifferenceText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereMakeDifferenceTextFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereMakeDifferenceTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereMakeDifferenceTitleFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereObjective($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereObjectiveFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereProgramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereTestimonyImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereTestimonyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereTestimonyNameFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereTestimonyStory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereTestimonyStoryFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereTitleFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereUpdatedAt($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperProject {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $project_id
 * @property string|null $title
 * @property string|null $title_fr
 * @property numeric|null $amount
 * @property string|null $label
 * @property string|null $label_fr
 * @property string|null $recipient
 * @property int $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string|null $localized_label
 * @property-read string|null $localized_title
 * @property-read \App\Models\Project $project
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectGrant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectGrant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectGrant query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectGrant whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectGrant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectGrant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectGrant whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectGrant whereLabelFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectGrant whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectGrant whereRecipient($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectGrant whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectGrant whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectGrant whereTitleFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectGrant whereUpdatedAt($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperProjectGrant {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $title
 * @property string|null $title_fr
 * @property string $slug
 * @property string|null $description
 * @property string|null $description_fr
 * @property string|null $image
 * @property string|null $header_text
 * @property string|null $header_text_fr
 * @property string|null $detail_image
 * @property string|null $detail_description
 * @property string|null $detail_description_fr
 * @property array<array-key, mixed>|null $items
 * @property int $sort_order
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string|null $detail_image_url
 * @property-read string|null $image_url
 * @property-read array $items_for_display
 * @property-read string|null $localized_description
 * @property-read string|null $localized_detail_description
 * @property-read string|null $localized_header_text
 * @property-read string $localized_title
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResourcePage active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResourcePage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResourcePage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResourcePage query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResourcePage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResourcePage whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResourcePage whereDescriptionFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResourcePage whereDetailDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResourcePage whereDetailDescriptionFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResourcePage whereDetailImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResourcePage whereHeaderText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResourcePage whereHeaderTextFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResourcePage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResourcePage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResourcePage whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResourcePage whereItems($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResourcePage whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResourcePage whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResourcePage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResourcePage whereTitleFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ResourcePage whereUpdatedAt($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperResourcePage {}
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
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperSiteNotification {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string|null $title_fr
 * @property string|null $subtitle
 * @property string|null $subtitle_fr
 * @property string|null $badge_text
 * @property string|null $badge_text_fr
 * @property string|null $image
 * @property string|null $cta_primary_text
 * @property string|null $cta_primary_text_fr
 * @property string|null $cta_primary_url
 * @property string|null $cta_secondary_text
 * @property string|null $cta_secondary_text_fr
 * @property string|null $cta_secondary_url
 * @property int $sort_order
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $image_url
 * @property-read string|null $localized_badge_text
 * @property-read string|null $localized_cta_primary_text
 * @property-read string|null $localized_cta_secondary_text
 * @property-read string|null $localized_subtitle
 * @property-read string|null $localized_title
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereBadgeText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereBadgeTextFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereCtaPrimaryText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereCtaPrimaryTextFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereCtaPrimaryUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereCtaSecondaryText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereCtaSecondaryTextFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereCtaSecondaryUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereSubtitleFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereTitleFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slide whereUpdatedAt($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperSlide {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $name_fr
 * @property string|null $logo
 * @property string|null $url
 * @property bool $is_active
 * @property int $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $localized_name
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor whereNameFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor whereUrl($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperSponsor {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $name
 * @property string|null $role
 * @property string|null $role_fr
 * @property string|null $content
 * @property string|null $content_fr
 * @property string|null $image
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string|null $localized_content
 * @property-read string|null $localized_role
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereContentFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereRoleFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereUpdatedAt($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperTestimonial {}
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
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperUser {}
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
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperVolunteer {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $country_name
 * @property string|null $country_name_fr
 * @property string|null $description
 * @property string|null $description_fr
 * @property string|null $image
 * @property string|null $learn_more_url
 * @property string $button_text
 * @property string|null $button_text_fr
 * @property int $display_order
 * @property bool $is_featured
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $image_url
 * @property-read string|null $localized_button_text
 * @property-read string|null $localized_country_name
 * @property-read string|null $localized_description
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorldwidePartner active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorldwidePartner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorldwidePartner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorldwidePartner query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorldwidePartner whereButtonText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorldwidePartner whereButtonTextFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorldwidePartner whereCountryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorldwidePartner whereCountryNameFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorldwidePartner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorldwidePartner whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorldwidePartner whereDescriptionFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorldwidePartner whereDisplayOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorldwidePartner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorldwidePartner whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorldwidePartner whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorldwidePartner whereIsFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorldwidePartner whereLearnMoreUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorldwidePartner whereUpdatedAt($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
	#[\AllowDynamicProperties]
	class IdeHelperWorldwidePartner {}
}

