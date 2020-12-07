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

    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Support\Carbon;

    /**
 * App\Models\Advice
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read mixed $image_url
 * @property-read Image|null $image
 * @method static Builder|Advice newModelQuery()
 * @method static Builder|Advice newQuery()
 * @method static Builder|Advice query()
 * @method static Builder|Advice whereContent($value)
 * @method static Builder|Advice whereCreatedAt($value)
 * @method static Builder|Advice whereId($value)
 * @method static Builder|Advice whereTitle($value)
 * @method static Builder|Advice whereUpdatedAt($value)
 */
	class Advice extends Eloquent {}
}

namespace App\Models{

    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Support\Carbon;

    /**
 * App\Models\BalanceOperation
 *
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property float $amount
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @method static Builder|BalanceOperation newModelQuery()
 * @method static Builder|BalanceOperation newQuery()
 * @method static Builder|BalanceOperation query()
 * @method static Builder|BalanceOperation typeAdd()
 * @method static Builder|BalanceOperation whereAmount($value)
 * @method static Builder|BalanceOperation whereCreatedAt($value)
 * @method static Builder|BalanceOperation whereId($value)
 * @method static Builder|BalanceOperation whereStatus($value)
 * @method static Builder|BalanceOperation whereType($value)
 * @method static Builder|BalanceOperation whereUpdatedAt($value)
 * @method static Builder|BalanceOperation whereUserId($value)
 */
	class BalanceOperation extends Eloquent {}
}

namespace App\Models{

    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Carbon;

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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Model|Eloquent $commentable
 * @method static Builder|Comment newModelQuery()
 * @method static Builder|Comment newQuery()
 * @method static Builder|Comment query()
 * @method static Builder|Comment whereActive($value)
 * @method static Builder|Comment whereAnonymous($value)
 * @method static Builder|Comment whereCommentableId($value)
 * @method static Builder|Comment whereCommentableType($value)
 * @method static Builder|Comment whereCreatedAt($value)
 * @method static Builder|Comment whereId($value)
 * @method static Builder|Comment whereText($value)
 * @method static Builder|Comment whereUpdatedAt($value)
 * @method static Builder|Comment whereUserId($value)
 */
	class Comment extends Eloquent {}
}

namespace App\Models{

    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;

    /**
 * App\Models\FAQ
 *
 * @property int $id
 * @property string $question
 * @property string $answer
 * @method static Builder|FAQ newModelQuery()
 * @method static Builder|FAQ newQuery()
 * @method static Builder|FAQ query()
 * @method static Builder|FAQ whereAnswer($value)
 * @method static Builder|FAQ whereId($value)
 * @method static Builder|FAQ whereQuestion($value)
 */
	class FAQ extends Eloquent {}
}

namespace App\Models{

    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Carbon;

    /**
 * App\Models\Image
 *
 * @property int $id
 * @property string $file
 * @property int $imageable_id
 * @property string $imageable_type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Model|Eloquent $imageable
 * @method static Builder|Image newModelQuery()
 * @method static Builder|Image newQuery()
 * @method static Builder|Image query()
 * @method static Builder|Image whereCreatedAt($value)
 * @method static Builder|Image whereFile($value)
 * @method static Builder|Image whereId($value)
 * @method static Builder|Image whereImageableId($value)
 * @method static Builder|Image whereImageableType($value)
 * @method static Builder|Image whereUpdatedAt($value)
 */
	class Image extends Eloquent {}
}

namespace App\Models{

    use App\Models\Projects\Purchase\PurchasedProject;
    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Support\Carbon;

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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $developer
 * @property-read PurchasedProject $project
 * @property-read User $user
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order query()
 * @method static Builder|Order whereCreatedAt($value)
 * @method static Builder|Order whereDeveloperId($value)
 * @method static Builder|Order whereId($value)
 * @method static Builder|Order whereOrderAddress($value)
 * @method static Builder|Order whereOrderCity($value)
 * @method static Builder|Order whereOrderCompanyAddress($value)
 * @method static Builder|Order whereOrderCompanyCorrespondentAccount($value)
 * @method static Builder|Order whereOrderCompanyInn($value)
 * @method static Builder|Order whereOrderCompanyKpp($value)
 * @method static Builder|Order whereOrderCompanyName($value)
 * @method static Builder|Order whereOrderCompanyPaymentAccount($value)
 * @method static Builder|Order whereOrderEmail($value)
 * @method static Builder|Order whereOrderName($value)
 * @method static Builder|Order whereOrderPassportIssue($value)
 * @method static Builder|Order whereOrderPassportIssueDate($value)
 * @method static Builder|Order whereOrderPassportNumber($value)
 * @method static Builder|Order whereOrderPassportSerial($value)
 * @method static Builder|Order whereOrderPhone($value)
 * @method static Builder|Order whereOrderPostalCode($value)
 * @method static Builder|Order wherePrice($value)
 * @method static Builder|Order wherePurchasedProjectId($value)
 * @method static Builder|Order whereStatus($value)
 * @method static Builder|Order whereUpdatedAt($value)
 * @method static Builder|Order whereUserId($value)
 */
	class Order extends Eloquent {}
}

namespace App\Models\Plans{

    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Support\Carbon;

    /**
 * App\Models\Plans\Plan
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property float $price
 * @property string $interval
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read Collection|PlanSubscription[] $subscriptions
 * @property-read int|null $subscriptions_count
 * @method static Builder|Plan newModelQuery()
 * @method static Builder|Plan newQuery()
 * @method static Builder|Plan query()
 * @method static Builder|Plan whereCreatedAt($value)
 * @method static Builder|Plan whereDeletedAt($value)
 * @method static Builder|Plan whereId($value)
 * @method static Builder|Plan whereInterval($value)
 * @method static Builder|Plan whereName($value)
 * @method static Builder|Plan wherePrice($value)
 * @method static Builder|Plan whereSlug($value)
 * @method static Builder|Plan whereUpdatedAt($value)
 */
	class Plan extends Eloquent {}
}

namespace App\Models\Plans{

    use App\Models\User;
    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Support\Carbon;

    /**
 * App\Models\Plans\PlanSubscription
 *
 * @property int $id
 * @property int $plan_id
 * @property int $user_id
 * @property int $active
 * @property Carbon|null $starts_at
 * @property Carbon|null $ends_at
 * @property Carbon|null $canceled_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Plan $plan
 * @property-read User $user
 * @method static Builder|PlanSubscription findEndedPeriod()
 * @method static Builder|PlanSubscription findEndingPeriod($dayRange = 3)
 * @method static Builder|PlanSubscription newModelQuery()
 * @method static Builder|PlanSubscription newQuery()
 * @method static Builder|PlanSubscription query()
 * @method static Builder|PlanSubscription whereActive($value)
 * @method static Builder|PlanSubscription whereCanceledAt($value)
 * @method static Builder|PlanSubscription whereCreatedAt($value)
 * @method static Builder|PlanSubscription whereEndsAt($value)
 * @method static Builder|PlanSubscription whereId($value)
 * @method static Builder|PlanSubscription wherePlanId($value)
 * @method static Builder|PlanSubscription whereStartsAt($value)
 * @method static Builder|PlanSubscription whereUpdatedAt($value)
 * @method static Builder|PlanSubscription whereUserId($value)
 */
	class PlanSubscription extends Eloquent {}
}

namespace App\Models\Projects{

    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;

    /**
 * App\Models\Projects\Attribute
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property array $variants
 * @property int $sort
 * @method static Builder|Attribute newModelQuery()
 * @method static Builder|Attribute newQuery()
 * @method static Builder|Attribute query()
 * @method static Builder|Attribute whereId($value)
 * @method static Builder|Attribute whereName($value)
 * @method static Builder|Attribute whereSort($value)
 * @method static Builder|Attribute whereType($value)
 * @method static Builder|Attribute whereVariants($value)
 */
	class Attribute extends Eloquent {}
}

namespace App\Models\Projects{

    use App\Models\Comment;
    use App\Models\Image;
    use App\Models\User;
    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Support\Carbon;

    /**
 * App\Models\Projects\Project
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property float $price
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read Collection|User[] $favorites
 * @property-read int|null $favorites_count
 * @property-read mixed $add_to_favorites_link
 * @property-read mixed $is_in_favorites
 * @property-read mixed $json_images
 * @property-read mixed $json_values
 * @property-read mixed $remove_from_favorites_link
 * @property-read mixed $route
 * @property-read Collection|Image[] $images
 * @property-read int|null $images_count
 * @property-read User $user
 * @property-read Collection|Value[] $values
 * @property-read int|null $values_count
 * @method static Builder|Project active()
 * @method static Builder|Project favoredByUser(User $user)
 * @method static Builder|Project forUser(User $user)
 * @method static Builder|Project newModelQuery()
 * @method static Builder|Project newQuery()
 * @method static Builder|Project query()
 * @method static Builder|Project whereCreatedAt($value)
 * @method static Builder|Project whereDescription($value)
 * @method static Builder|Project whereId($value)
 * @method static Builder|Project wherePrice($value)
 * @method static Builder|Project whereSlug($value)
 * @method static Builder|Project whereStatus($value)
 * @method static Builder|Project whereTitle($value)
 * @method static Builder|Project whereUpdatedAt($value)
 */
	class Project extends Eloquent {}
}

namespace App\Models\Projects\Purchase{

    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;

    /**
 * App\Models\Projects\Purchase\PurchaseAttribute
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property array $variants
 * @property int $sort
 * @method static Builder|PurchaseAttribute newModelQuery()
 * @method static Builder|PurchaseAttribute newQuery()
 * @method static Builder|PurchaseAttribute query()
 * @method static Builder|PurchaseAttribute whereId($value)
 * @method static Builder|PurchaseAttribute whereName($value)
 * @method static Builder|PurchaseAttribute whereSort($value)
 * @method static Builder|PurchaseAttribute whereType($value)
 * @method static Builder|PurchaseAttribute whereVariants($value)
 */
	class PurchaseAttribute extends Eloquent {}
}

namespace App\Models\Projects\Purchase{

    use App\Models\Projects\Project;
    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;

    /**
 * App\Models\Projects\Purchase\PurchaseValue
 *
 * @property int $id
 * @property int $purchased_project_id
 * @property int $attribute_id
 * @property string $value
 * @property-read PurchaseAttribute $attribute
 * @property-read Project $project
 * @property-read PurchasedProject $purchased_project
 * @method static Builder|PurchaseValue newModelQuery()
 * @method static Builder|PurchaseValue newQuery()
 * @method static Builder|PurchaseValue query()
 * @method static Builder|PurchaseValue whereAttributeId($value)
 * @method static Builder|PurchaseValue whereId($value)
 * @method static Builder|PurchaseValue wherePurchasedProjectId($value)
 * @method static Builder|PurchaseValue whereValue($value)
 */
	class PurchaseValue extends Eloquent {}
}

namespace App\Models\Projects\Purchase{

    use App\Models\Projects\Project;
    use App\Models\User;
    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Support\Carbon;

    /**
 * App\Models\Projects\Purchase\PurchasedProject
 *
 * @property int $id
 * @property int $user_id
 * @property int $project_id
 * @property string $data
 * @property float $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Project $project
 * @property-read User $user
 * @property-read Collection|PurchaseValue[] $values
 * @property-read int|null $values_count
 * @method static Builder|PurchasedProject newModelQuery()
 * @method static Builder|PurchasedProject newQuery()
 * @method static Builder|PurchasedProject query()
 * @method static Builder|PurchasedProject whereCreatedAt($value)
 * @method static Builder|PurchasedProject whereData($value)
 * @method static Builder|PurchasedProject whereId($value)
 * @method static Builder|PurchasedProject wherePrice($value)
 * @method static Builder|PurchasedProject whereProjectId($value)
 * @method static Builder|PurchasedProject whereUpdatedAt($value)
 * @method static Builder|PurchasedProject whereUserId($value)
 */
	class PurchasedProject extends Eloquent {}
}

namespace App\Models\Projects{

    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;

    /**
 * App\Models\Projects\Value
 *
 * @property int $id
 * @property int $project_id
 * @property int $attribute_id
 * @property string $value
 * @property-read Attribute $attribute
 * @method static Builder|Value newModelQuery()
 * @method static Builder|Value newQuery()
 * @method static Builder|Value query()
 * @method static Builder|Value whereAttributeId($value)
 * @method static Builder|Value whereId($value)
 * @method static Builder|Value whereProjectId($value)
 * @method static Builder|Value whereValue($value)
 */
	class Value extends Eloquent {}
}

namespace App\Models{

    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;

    /**
 * App\Models\Region
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @method static Builder|Region newModelQuery()
 * @method static Builder|Region newQuery()
 * @method static Builder|Region query()
 * @method static Builder|Region whereId($value)
 * @method static Builder|Region whereName($value)
 * @method static Builder|Region whereSlug($value)
 */
	class Region extends Eloquent {}
}

namespace App\Models{

    use App\Models\Projects\Project;
    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Support\Carbon;

    /**
 * App\Models\SavedProject
 *
 * @property int $id
 * @property int $user_id
 * @property int $project_id
 * @property string $data
 * @property array $values_data
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Project $project
 * @property-read User $user
 * @method static Builder|SavedProject newModelQuery()
 * @method static Builder|SavedProject newQuery()
 * @method static Builder|SavedProject query()
 * @method static Builder|SavedProject whereCreatedAt($value)
 * @method static Builder|SavedProject whereData($value)
 * @method static Builder|SavedProject whereId($value)
 * @method static Builder|SavedProject whereProjectId($value)
 * @method static Builder|SavedProject whereUpdatedAt($value)
 * @method static Builder|SavedProject whereUserId($value)
 * @method static Builder|SavedProject whereValuesData($value)
 */
	class SavedProject extends Eloquent {}
}

namespace App\Models{

    use App\Models\Plans\PlanSubscription;
    use App\Models\Projects\Project;
    use App\Models\Projects\Purchase\PurchasedProject;
    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Notifications\DatabaseNotification;
    use Illuminate\Notifications\DatabaseNotificationCollection;
    use Illuminate\Support\Carbon;

    /**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property string|null $middle_name
 * @property string $email
 * @property string $phone
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $role
 * @property string|null $address
 * @property string $type
 * @property string|null $passport_serial
 * @property string|null $passport_code
 * @property string|null $passport_issue
 * @property Carbon|null $passport_issue_date
 * @property string|null $company_name
 * @property string|null $company_address
 * @property string|null $company_inn
 * @property string|null $company_account
 * @property string $status
 * @property float $balance
 * @property-read Collection|BalanceOperation[] $balanceOperations
 * @property-read int|null $balance_operations_count
 * @property-read Collection|Project[] $favorites
 * @property-read int|null $favorites_count
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|PurchasedProject[] $purchasedProjects
 * @property-read int|null $purchased_projects_count
 * @property-read Collection|SavedProject[] $savedProject
 * @property-read int|null $saved_project_count
 * @property-read PlanSubscription|null $subscription
 * @method static Builder|User active()
 * @method static Builder|User developers()
 * @method static Builder|User hasFavorites()
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereAddress($value)
 * @method static Builder|User whereBalance($value)
 * @method static Builder|User whereCompanyAccount($value)
 * @method static Builder|User whereCompanyAddress($value)
 * @method static Builder|User whereCompanyInn($value)
 * @method static Builder|User whereCompanyName($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereLastName($value)
 * @method static Builder|User whereMiddleName($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassportCode($value)
 * @method static Builder|User wherePassportIssue($value)
 * @method static Builder|User wherePassportIssueDate($value)
 * @method static Builder|User wherePassportSerial($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePhone($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereRole($value)
 * @method static Builder|User whereStatus($value)
 * @method static Builder|User whereType($value)
 * @method static Builder|User whereUpdatedAt($value)
 */
	class User extends Eloquent {}
}

