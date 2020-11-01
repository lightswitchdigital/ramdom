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

namespace App\Models\Projects{

    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;

    /**
 * App\Models\Projects\Attribute
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property int $required
 * @property array $variants
 * @property int $sort
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
 * @property int $user_id
 * @property string $title
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
 * @method static Builder|Project whereStatus($value)
 * @method static Builder|Project whereTitle($value)
 * @method static Builder|Project whereUpdatedAt($value)
 * @method static Builder|Project whereUserId($value)
 */
	class Project extends Eloquent {}
}

namespace App\Models\Projects{

    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;

    /**
 * App\Models\Projects\Value
 *
 * @property int $project_id
 * @property int $attribute_id
 * @property string $value
 * @method static Builder|Value newModelQuery()
 * @method static Builder|Value newQuery()
 * @method static Builder|Value query()
 * @method static Builder|Value whereAttributeId($value)
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

    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
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
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
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

