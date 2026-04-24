<?php

$modelsPath = __DIR__ . '/app/Models';
if (!is_dir($modelsPath)) {
    mkdir($modelsPath, 0777, true);
}

$stub = <<<EOT
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class {{class}} extends Model
{
    use HasFactory;
    
    // Secure against mass assignment natively
    protected \$guarded = ['id'];

{{relationships}}
}
EOT;

$authStub = <<<EOT
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected \$guarded = ['id'];

    protected \$hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_login_at' => 'datetime',
            'two_factor_enabled' => 'boolean',
        ];
    }

    public function agent() { return \$this->hasOne(Agent::class); }
    public function favorites() { return \$this->belongsToMany(Property::class, 'favorites', 'customer_id', 'property_id')->withTimestamps(); }
    public function appointments() { return \$this->hasMany(Appointment::class, 'customer_id'); }
    public function inquiries() { return \$this->hasMany(Inquiry::class, 'inquirer_id'); }
    public function offers() { return \$this->hasMany(Offer::class, 'buyer_id'); }
    public function transactions() { return \$this->hasMany(Transaction::class); }
}
EOT;

$models = [
    'Agency' => "    public function agents() { return \$this->hasMany(Agent::class); }",
    'Agent' => "    public function user() { return \$this->belongsTo(User::class); }\n    public function agency() { return \$this->belongsTo(Agency::class); }\n    public function properties() { return \$this->hasMany(Property::class); }\n    public function reviews() { return \$this->hasMany(AgentReview::class); }",
    'AgentReview' => "    public function agent() { return \$this->belongsTo(Agent::class); }\n    public function reviewer() { return \$this->belongsTo(User::class, 'reviewer_id'); }",
    'PropertyType' => "    public function properties() { return \$this->hasMany(Property::class); }",
    'PropertyStatus' => "    public function properties() { return \$this->hasMany(Property::class, 'status_id'); }",
    'Property' => <<<REL
    public function agent() { return \$this->belongsTo(Agent::class); }
    public function type() { return \$this->belongsTo(PropertyType::class, 'property_type_id'); }
    public function status() { return \$this->belongsTo(PropertyStatus::class, 'status_id'); }
    public function location() { return \$this->hasOne(PropertyLocation::class); }
    public function images() { return \$this->hasMany(PropertyImage::class)->orderBy('sort_order'); }
    public function documents() { return \$this->hasMany(PropertyDocument::class); }
    public function features() { return \$this->belongsToMany(Feature::class, 'property_features'); }
    public function floorPlans() { return \$this->hasMany(PropertyFloorPlan::class); }
    public function offers() { return \$this->hasMany(Offer::class); }
    public function inquiries() { return \$this->hasMany(Inquiry::class); }
    public function appointments() { return \$this->hasMany(Appointment::class); }
REL,
    'PropertyLocation' => "    public function property() { return \$this->belongsTo(Property::class); }",
    'PropertyImage' => "    public function property() { return \$this->belongsTo(Property::class); }",
    'PropertyDocument' => "    public function property() { return \$this->belongsTo(Property::class); }\n    public function uploader() { return \$this->belongsTo(User::class, 'uploaded_by'); }",
    'Feature' => "    public function properties() { return \$this->belongsToMany(Property::class, 'property_features'); }",
    'PropertyFeature' => "",
    'PropertyFloorPlan' => "    public function property() { return \$this->belongsTo(Property::class); }",
    'RentalTerm' => "    public function property() { return \$this->belongsTo(Property::class); }",
    'Tenant' => "    public function property() { return \$this->belongsTo(Property::class); }\n    public function user() { return \$this->belongsTo(User::class); }\n    public function paymentSchedules() { return \$this->hasMany(RentalPaymentSchedule::class); }",
    'RentalPaymentSchedule' => "    public function tenant() { return \$this->belongsTo(Tenant::class); }",
    'Offer' => "    public function property() { return \$this->belongsTo(Property::class); }\n    public function buyer() { return \$this->belongsTo(User::class, 'buyer_id'); }",
    'Inquiry' => "    public function property() { return \$this->belongsTo(Property::class); }\n    public function inquirer() { return \$this->belongsTo(User::class, 'inquirer_id'); }\n    public function agent() { return \$this->belongsTo(Agent::class); }\n    public function responder() { return \$this->belongsTo(User::class, 'responded_by'); }",
    'Appointment' => "    public function property() { return \$this->belongsTo(Property::class); }\n    public function customer() { return \$this->belongsTo(User::class, 'customer_id'); }\n    public function agent() { return \$this->belongsTo(Agent::class); }",
    'Favorite' => "",
    'Transaction' => "    public function user() { return \$this->belongsTo(User::class); }\n    public function property() { return \$this->belongsTo(Property::class); }",
    'Invoice' => "    public function user() { return \$this->belongsTo(User::class); }",
    'BlogCategory' => "    public function posts() { return \$this->hasMany(BlogPost::class, 'category_id'); }",
    'BlogPost' => "    public function author() { return \$this->belongsTo(User::class, 'author_id'); }\n    public function category() { return \$this->belongsTo(BlogCategory::class, 'category_id'); }",
    'Testimonial' => "    public function customer() { return \$this->belongsTo(User::class, 'customer_id'); }",
    'Faq' => "",
    'Banner' => "",
    'Page' => "",
    'Setting' => "",
    'EmailLog' => "",
];

echo "========== GENERATING 30+ ELOQUENT MODELS ==========\n\n";

// Write Custom Auth User
file_put_contents($modelsPath . '/User.php', $authStub);
echo " -> Generated User Model (with HasRoles & Auth Stack)\n";

// Write Models
foreach ($models as $class => $relationships) {
    $content = str_replace('{{class}}', $class, $stub);
    $content = str_replace('{{relationships}}', $relationships, $content);
    
    file_put_contents($modelsPath . '/' . $class . '.php', $content);
    echo " -> Generated Model: $class\n";
}

echo "\n========== MODELS COMPLETED ==========\n";
