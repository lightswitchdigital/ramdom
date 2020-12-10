<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Advice
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read mixed $image_url
 * @property-read \App\Models\Image|null $image
 * @method static \Illuminate\Database\Eloquent\Builder|Advice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Advice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Advice query()
 * @method static \Illuminate\Database\Eloquent\Builder|Advice whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advice whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advice whereUpdatedAt($value)
 */
	class Advice extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BalanceOperation
 *
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property float $amount
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceOperation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceOperation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceOperation query()
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceOperation typeAdd()
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceOperation whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceOperation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceOperation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceOperation whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceOperation whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceOperation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceOperation whereUserId($value)
 */
	class BalanceOperation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Comment
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $text
 * @property int $anonymous
 * @property int $active
 * @property int $commentable_id
 * @property string $commentable_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $commentable
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereAnonymous($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCommentableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCommentableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUserId($value)
 */
	class Comment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FAQ
 *
 * @property int $id
 * @property string $question
 * @property string $answer
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ query()
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ whereQuestion($value)
 */
	class FAQ extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Image
 *
 * @property int $id
 * @property string $file
 * @property int $imageable_id
 * @property string $imageable_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $imageable
 * @method static \Illuminate\Database\Eloquent\Builder|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image query()
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereImageableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereImageableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereUpdatedAt($value)
 */
	class Image extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $user_id
 * @property int $purchased_project_id
 * @property int $developer_id
 * @property string $order_name
 * @property string $order_email
 * @property string $order_phone
 * @property string $order_city
 * @property string $order_address
 * @property string $order_postal_code
 * @property string|null $order_passport_serial
 * @property string|null $order_passport_number
 * @property string|null $order_passport_issue
 * @property string|null $order_passport_issue_date
 * @property string|null $order_company_name
 * @property string|null $order_company_address
 * @property string|null $order_company_inn
 * @property string|null $order_company_kpp
 * @property string|null $order_company_payment_account
 * @property string|null $order_company_correspondent_account
 * @property float $price
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $developer
 * @property-read \App\Models\Projects\Purchase\PurchasedProject $project
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeveloperId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderCompanyAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderCompanyCorrespondentAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderCompanyInn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderCompanyKpp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderCompanyPaymentAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderPassportIssue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderPassportIssueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderPassportNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderPassportSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderPostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePurchasedProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Models\Plans{
/**
 * App\Models\Plans\Plan
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property float $price
 * @property string $interval
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Plans\PlanSubscription[] $subscriptions
 * @property-read int|null $subscriptions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Plan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Plan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Plan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereUpdatedAt($value)
 */
	class Plan extends \Eloquent {}
}

namespace App\Models\Plans{
/**
 * App\Models\Plans\PlanSubscription
 *
 * @property int $id
 * @property int $plan_id
 * @property int $user_id
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $starts_at
 * @property \Illuminate\Support\Carbon|null $ends_at
 * @property \Illuminate\Support\Carbon|null $canceled_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Plans\Plan $plan
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSubscription findEndedPeriod()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSubscription findEndingPeriod($dayRange = 3)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSubscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSubscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSubscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSubscription whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSubscription whereCanceledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSubscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSubscription whereEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSubscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSubscription wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSubscription whereStartsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSubscription whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSubscription whereUserId($value)
 */
	class PlanSubscription extends \Eloquent {}
}

namespace App\Models\Projects{
/**
 * App\Models\Projects\Attribute
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property array $variants
 * @property int $sort
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereVariants($value)
 */
	class Attribute extends \Eloquent {}
}

namespace App\Models\Projects{
/**
 * App\Models\Projects\Project
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property float $price
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $favorites
 * @property-read int|null $favorites_count
 * @property-read mixed $add_to_favorites_link
 * @property-read mixed $is_in_favorites
 * @property-read mixed $json_images
 * @property-read mixed $json_values
 * @property-read mixed $remove_from_favorites_link
 * @property-read mixed $route
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Projects\Value[] $values
 * @property-read int|null $values_count
 * @method static \Illuminate\Database\Eloquent\Builder|Project active()
 * @method static \Illuminate\Database\Eloquent\Builder|Project favoredByUser(\App\Models\User $user)
 * @method static \Illuminate\Database\Eloquent\Builder|Project forUser(\App\Models\User $user)
 * @method static \Illuminate\Database\Eloquent\Builder|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUpdatedAt($value)
 */
	class Project extends \Eloquent {}
}

namespace App\Models\Projects\Purchase{
/**
 * App\Models\Projects\Purchase\PurchaseAttribute
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property array $variants
 * @property int $sort
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseAttribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseAttribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseAttribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseAttribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseAttribute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseAttribute whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseAttribute whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseAttribute whereVariants($value)
 */
	class PurchaseAttribute extends \Eloquent {}
}

namespace App\Models\Projects\Purchase{
/**
 * App\Models\Projects\Purchase\PurchaseValue
 *
 * @property int $id
 * @property int $purchased_project_id
 * @property int $attribute_id
 * @property string $value
 * @property-read \App\Models\Projects\Purchase\PurchaseAttribute $attribute
 * @property-read \App\Models\Projects\Project $project
 * @property-read \App\Models\Projects\Purchase\PurchasedProject $purchased_project
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseValue whereAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseValue wherePurchasedProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseValue whereValue($value)
 */
	class PurchaseValue extends \Eloquent {}
}

namespace App\Models\Projects\Purchase{
/**
 * App\Models\Projects\Purchase\PurchasedProject
 *
 * @property int $id
 * @property int $user_id
 * @property int $project_id
 * @property string $data
 * @property float $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Projects\Project $project
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Projects\Purchase\PurchaseValue[] $values
 * @property-read int|null $values_count
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedProject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedProject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedProject query()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedProject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedProject whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedProject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedProject wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedProject whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedProject whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchasedProject whereUserId($value)
 */
	class PurchasedProject extends \Eloquent {}
}

namespace App\Models\Projects{
/**
 * App\Models\Projects\SavedProject
 *
 * @property int $id
 * @property int $user_id
 * @property int $project_id
 * @property string $data
 * @property array $values_data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Projects\Project $project
 * @method static \Illuminate\Database\Eloquent\Builder|SavedProject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SavedProject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SavedProject query()
 * @method static \Illuminate\Database\Eloquent\Builder|SavedProject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SavedProject whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SavedProject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SavedProject whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SavedProject whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SavedProject whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SavedProject whereValuesData($value)
 */
	class SavedProject extends \Eloquent {}
}

namespace App\Models\Projects{
/**
 * App\Models\Projects\Value
 *
 * @property int $id
 * @property int $project_id
 * @property int $attribute_id
 * @property string $value
 * @property-read \App\Models\Projects\Attribute $attribute
 * @method static \Illuminate\Database\Eloquent\Builder|Value newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Value newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Value query()
 * @method static \Illuminate\Database\Eloquent\Builder|Value whereAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Value whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Value whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Value whereValue($value)
 */
	class Value extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Region
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @method static \Illuminate\Database\Eloquent\Builder|Region newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Region newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Region query()
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereSlug($value)
 */
	class Region extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property string|null $middle_name
 * @property string $email
 * @property string $phone
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $role
 * @property string|null $address
 * @property string $type
 * @property string|null $passport_serial
 * @property string|null $passport_code
 * @property string|null $passport_issue
 * @property \Illuminate\Support\Carbon|null $passport_issue_date
 * @property string|null $company_name
 * @property string|null $company_address
 * @property string|null $company_inn
 * @property string|null $company_account
 * @property string $status
 * @property float $balance
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BalanceOperation[] $balanceOperations
 * @property-read int|null $balance_operations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Projects\Project[] $favorites
 * @property-read int|null $favorites_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Projects\Purchase\PurchasedProject[] $purchasedProjects
 * @property-read int|null $purchased_projects_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Projects\SavedProject[] $savedProjects
 * @property-read int|null $saved_projects_count
 * @property-read \App\Models\Plans\PlanSubscription|null $subscription
 * @method static \Illuminate\Database\Eloquent\Builder|User active()
 * @method static \Illuminate\Database\Eloquent\Builder|User developers()
 * @method static \Illuminate\Database\Eloquent\Builder|User hasFavorites()
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCompanyAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCompanyAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCompanyInn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassportCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassportIssue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassportIssueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassportSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

