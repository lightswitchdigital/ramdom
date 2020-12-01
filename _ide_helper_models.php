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

namespace App\Models\Orders{

    use App\Models\Projects\Project;
    use App\Models\User;
    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Support\Carbon;

    /**
 * App\Models\Orders\Order
 *
 * @property int $id
 * @property int $user_id
 * @property int $project_id
 * @property string $order_name
 * @property string $order_email
 * @property string $order_phone
 * @property float $price
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Project $project
 * @property-read User $user
 * @property-read Collection|ProjectValue[] $values
 * @property-read int|null $values_count
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order query()
 * @method static Builder|Order whereCreatedAt($value)
 * @method static Builder|Order whereId($value)
 * @method static Builder|Order whereOrderEmail($value)
 * @method static Builder|Order whereOrderName($value)
 * @method static Builder|Order whereOrderPhone($value)
 * @method static Builder|Order wherePrice($value)
 * @method static Builder|Order whereProjectId($value)
 * @method static Builder|Order whereStatus($value)
 * @method static Builder|Order whereUpdatedAt($value)
 * @method static Builder|Order whereUserId($value)
 */
	class Order extends Eloquent {}
}

namespace App\Models\Orders{

    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;

    /**
 * App\Models\Orders\ProjectAttribute
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property array $variants
 * @property int $sort
 * @property int $required
 * @property float $price
 * @method static Builder|ProjectAttribute newModelQuery()
 * @method static Builder|ProjectAttribute newQuery()
 * @method static Builder|ProjectAttribute query()
 * @method static Builder|ProjectAttribute whereId($value)
 * @method static Builder|ProjectAttribute whereName($value)
 * @method static Builder|ProjectAttribute wherePrice($value)
 * @method static Builder|ProjectAttribute whereRequired($value)
 * @method static Builder|ProjectAttribute whereSort($value)
 * @method static Builder|ProjectAttribute whereType($value)
 * @method static Builder|ProjectAttribute whereVariants($value)
 */
	class ProjectAttribute extends Eloquent {}
}

namespace App\Models\Orders{

    use App\Models\Projects\Project;
    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;

    /**
 * App\Models\Orders\ProjectData
 *
 * @property int $id
 * @property int $order_id
 * @property int $project_id
 * @property string $data
 * @property float $total_price
 * @property-read Order $order
 * @property-read Project $project
 * @method static Builder|ProjectData newModelQuery()
 * @method static Builder|ProjectData newQuery()
 * @method static Builder|ProjectData query()
 * @method static Builder|ProjectData whereData($value)
 * @method static Builder|ProjectData whereId($value)
 * @method static Builder|ProjectData whereOrderId($value)
 * @method static Builder|ProjectData whereProjectId($value)
 * @method static Builder|ProjectData whereTotalPrice($value)
 */
	class ProjectData extends Eloquent {}
}

namespace App\Models\Orders{

    use App\Models\Projects\Project;
    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;

    /**
 * App\Models\Orders\ProjectValue
 *
 * @property int $id
 * @property int $order_id
 * @property int $project_id
 * @property int $attribute_id
 * @property string $value
 * @property-read ProjectAttribute $attribute
 * @property-read Order $order
 * @property-read Project $project
 * @method static Builder|ProjectValue newModelQuery()
 * @method static Builder|ProjectValue newQuery()
 * @method static Builder|ProjectValue query()
 * @method static Builder|ProjectValue whereAttributeId($value)
 * @method static Builder|ProjectValue whereId($value)
 * @method static Builder|ProjectValue whereOrderId($value)
 * @method static Builder|ProjectValue whereProjectId($value)
 * @method static Builder|ProjectValue whereValue($value)
 */
	class ProjectValue extends Eloquent {}
}

namespace App\Models{

    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Support\Carbon;

    /**
 * App\Models\Payment
 *
 * @property int $id
 * @property int $user_id
 * @property float $amount
 * @property string $gateway
 * @property string $status
 * @property Carbon|null $expires_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @method static Builder|Payment created()
 * @method static Builder|Payment findExpired()
 * @method static Builder|Payment newModelQuery()
 * @method static Builder|Payment newQuery()
 * @method static Builder|Payment query()
 * @method static Builder|Payment whereAmount($value)
 * @method static Builder|Payment whereCreatedAt($value)
 * @method static Builder|Payment whereExpiresAt($value)
 * @method static Builder|Payment whereGateway($value)
 * @method static Builder|Payment whereId($value)
 * @method static Builder|Payment whereStatus($value)
 * @method static Builder|Payment whereUpdatedAt($value)
 * @method static Builder|Payment whereUserId($value)
 */
	class Payment extends Eloquent {}
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
 * @property int $required
 * @method static Builder|Attribute newModelQuery()
 * @method static Builder|Attribute newQuery()
 * @method static Builder|Attribute query()
 * @method static Builder|Attribute whereId($value)
 * @method static Builder|Attribute whereName($value)
 * @method static Builder|Attribute whereRequired($value)
 * @method static Builder|Attribute whereSort($value)
 * @method static Builder|Attribute whereType($value)
 * @method static Builder|Attribute whereVariants($value)
 */
	class Attribute extends Eloquent {}
}

namespace App\Models\Projects{

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
 * @property-read Collection|User[] $favorites
 * @property-read int|null $favorites_count
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
 * @property-read Collection|Project[] $favorites
 * @property-read int|null $favorites_count
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read PlanSubscription|null $subscription
 * @method static Builder|User active()
 * @method static Builder|User hasFavorites()
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereAddress($value)
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

