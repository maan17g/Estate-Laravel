+-----------------------------------------------------------------------+
| 🏠                                                                    |
|                                                                       |
| **REAL ESTATE PLATFORM**                                              |
|                                                                       |
| Complete Production-Level Architecture Guide                          |
|                                                                       |
| **Laravel 11 • MySQL • Both Sales & Rentals**                         |
|                                                                       |
| Three-Level Auth • Full Security Stack • 35+ Database Tables          |
+-----------------------------------------------------------------------+

+----------------------+--------------------------+--------------------------+
| **Stack**            | **Auth Levels**          | **Purpose**              |
|                      |                          |                          |
| Laravel 11 + MySQL   | Admin • Agent • Customer | Sales & Rentals Platform |
+----------------------+--------------------------+--------------------------+

> **SECTION 1 --- COMPLETE FOLDER STRUCTURE**

**1.1 Where Your HTML, CSS & JS Files Go in Laravel**

**Your existing static files map to specific Laravel folders. This is the complete structure your project must follow:**

**Your Existing Files → Laravel Destination**

  ------------------------ ----------------------------------------- ----------------------
  **Your Original File**   **Laravel Destination**                   **Notes**

  index.html               resources/views/pages/home.blade.php      Main homepage

  login.html               resources/views/auth/login.blade.php      Auth form

  register.html            resources/views/auth/register.blade.php   Auth form

  contact.html             resources/views/pages/contact.blade.php   Contact page

  privacy.html             resources/views/pages/privacy.blade.php   Static page

  about.html               resources/views/pages/about.blade.php     Static page

  css/styles.css           public/css/styles.css                     Copy directly

  js/scripts.js            public/js/scripts.js                      Copy directly

  images/                  public/images/                            Copy directly
  ------------------------ ----------------------------------------- ----------------------

**Full Laravel 11 Project Folder Tree**

+-----------------------------------------------------------------------+
| laravel-realestate/                                                   |
|                                                                       |
| ├── app/                                                              |
|                                                                       |
| │ ├── Models/ ← 40+ Eloquent models (one per table)                   |
|                                                                       |
| │ ├── Http/                                                           |
|                                                                       |
| │ │ ├── Controllers/                                                  |
|                                                                       |
| │ │ │ ├── Auth/ ← Login, register, password reset                     |
|                                                                       |
| │ │ │ ├── Admin/ ← Super admin controllers                            |
|                                                                       |
| │ │ │ ├── Agent/ ← Agent controllers                                  |
|                                                                       |
| │ │ │ ├── Customer/ ← Customer controllers                            |
|                                                                       |
| │ │ │ └── Public/ ← Public pages (home, contact, etc.)                |
|                                                                       |
| │ │ ├── Middleware/ ← RoleMiddleware, VerifiedMiddleware              |
|                                                                       |
| │ │ └── Requests/ ← Form validation classes                           |
|                                                                       |
| │ ├── Notifications/ ← Email and SMS alert classes                    |
|                                                                       |
| │ ├── Jobs/ ← Background queue jobs                                   |
|                                                                       |
| │ ├── Services/ ← Business logic layer                                |
|                                                                       |
| │ └── Observers/ ← Model event listeners                              |
|                                                                       |
| │                                                                     |
|                                                                       |
| ├── resources/                                                        |
|                                                                       |
| │ ├── views/                                                          |
|                                                                       |
| │ │ ├── layouts/                                                      |
|                                                                       |
| │ │ │ ├── app.blade.php ← Public layout (header + footer)             |
|                                                                       |
| │ │ │ ├── admin.blade.php ← Super Admin layout                        |
|                                                                       |
| │ │ │ ├── agent.blade.php ← Agent layout                              |
|                                                                       |
| │ │ │ └── customer.blade.php← Customer layout                         |
|                                                                       |
| │ │ ├── components/ ← Reusable Blade components                       |
|                                                                       |
| │ │ │ ├── property-card.blade.php                                     |
|                                                                       |
| │ │ │ ├── search-bar.blade.php                                        |
|                                                                       |
| │ │ │ ├── breadcrumb.blade.php                                        |
|                                                                       |
| │ │ │ └── alert.blade.php                                             |
|                                                                       |
| │ │ ├── pages/ ← Public static & dynamic pages                        |
|                                                                       |
| │ │ │ ├── home.blade.php                                              |
|                                                                       |
| │ │ │ ├── contact.blade.php                                           |
|                                                                       |
| │ │ │ ├── about.blade.php                                             |
|                                                                       |
| │ │ │ ├── privacy.blade.php                                           |
|                                                                       |
| │ │ │ └── terms.blade.php                                             |
|                                                                       |
| │ │ ├── auth/                                                         |
|                                                                       |
| │ │ │ ├── login.blade.php                                             |
|                                                                       |
| │ │ │ ├── register.blade.php                                          |
|                                                                       |
| │ │ │ ├── forgot-password.blade.php                                   |
|                                                                       |
| │ │ │ ├── reset-password.blade.php                                    |
|                                                                       |
| │ │ │ └── verify-email.blade.php                                      |
|                                                                       |
| │ │ ├── properties/                                                   |
|                                                                       |
| │ │ │ ├── index.blade.php ← All listings with filter                  |
|                                                                       |
| │ │ │ ├── show.blade.php ← Single property detail                     |
|                                                                       |
| │ │ │ ├── search.blade.php ← Search results page                      |
|                                                                       |
| │ │ │ └── compare.blade.php ← Property comparison                     |
|                                                                       |
| │ │ ├── admin/ ← Super Admin dashboard views                          |
|                                                                       |
| │ │ ├── agent/ ← Agent dashboard views                                |
|                                                                       |
| │ │ ├── customer/ ← Customer portal views                             |
|                                                                       |
| │ │ └── emails/ ← Email notification templates                        |
|                                                                       |
| │ ├── css/app.css ← Main CSS entry (Vite)                             |
|                                                                       |
| │ └── js/app.js ← Main JS entry (Vite)                                |
|                                                                       |
| │                                                                     |
|                                                                       |
| ├── public/                                                           |
|                                                                       |
| │ ├── css/ ← Your original CSS goes here                              |
|                                                                       |
| │ ├── js/ ← Your original JS goes here                                |
|                                                                       |
| │ ├── images/ ← Your original images go here                          |
|                                                                       |
| │ └── storage → (symlink) ← php artisan storage:link                  |
|                                                                       |
| │                                                                     |
|                                                                       |
| ├── database/                                                         |
|                                                                       |
| │ ├── migrations/ ← 35+ migration files                               |
|                                                                       |
| │ └── seeders/ ← Demo data generators                                 |
|                                                                       |
| │                                                                     |
|                                                                       |
| ├── routes/                                                           |
|                                                                       |
| │ ├── web.php ← All web routes                                        |
|                                                                       |
| │ └── api.php ← API routes (optional)                                 |
|                                                                       |
| │                                                                     |
|                                                                       |
| └── config/ ← All configuration files                                 |
+-----------------------------------------------------------------------+

> **SECTION 2 --- HTML TO BLADE CONVERSION STEPS**

**2.1 Step-by-Step Conversion Process**

Follow these exact steps in order for every HTML page you have:

+-----------------------------------------------------------------------+
| **STEP 1 --- Copy CSS, JS, and Images to public/**                    |
|                                                                       |
| → Copy your css/ folder → paste into laravel/public/css/              |
|                                                                       |
| → Copy your js/ folder → paste into laravel/public/js/                |
|                                                                       |
| → Copy your images/ → paste into laravel/public/images/               |
|                                                                       |
| → Run command: php artisan storage:link                               |
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
| **STEP 2 --- Rename All HTML Files to .blade.php**                    |
|                                                                       |
| → index.html becomes home.blade.php                                   |
|                                                                       |
| → login.html becomes login.blade.php                                  |
|                                                                       |
| → register.html becomes register.blade.php                            |
|                                                                       |
| → contact.html becomes contact.blade.php                              |
|                                                                       |
| → about.html becomes about.blade.php                                  |
|                                                                       |
| → privacy.html becomes privacy.blade.php                              |
|                                                                       |
| → Place each file in the correct subfolder shown in Section 1         |
+-----------------------------------------------------------------------+

+-------------------------------------------------------------------------------------------+
| **STEP 3 --- Create the Master Layout File (app.blade.php)**                              |
|                                                                                           |
| → Open any of your HTML files and identify the repeating header and footer                |
|                                                                                           |
| → Cut out everything from \<html\> to \</header\> → put it in app.blade.php top section   |
|                                                                                           |
| → Cut out everything from \<footer\> to \</html\> → put it at the bottom of app.blade.php |
|                                                                                           |
| → In the middle, place exactly this Blade directive: \@yield(\'content\')                 |
|                                                                                           |
| → This master layout replaces the repeating code across all your pages                    |
+-------------------------------------------------------------------------------------------+

+-------------------------------------------------------------------------------------+
| **STEP 4 --- Update Each Page to Use the Master Layout**                            |
|                                                                                     |
| → At the very top of each page, add: \@extends(\'layouts.app\')                     |
|                                                                                     |
| → Remove the \<html\>, \<head\>, \<header\>, and \<footer\> sections from each page |
|                                                                                     |
| → Wrap the remaining body content with: \@section(\'content\') \... \@endsection    |
|                                                                                     |
| → The page now inherits the header and footer from app.blade.php automatically      |
+-------------------------------------------------------------------------------------+

+-----------------------------------------------------------------------------+
| **STEP 5 --- Fix All Asset Links in Your Files**                            |
|                                                                             |
| → Old: \<link rel=\'stylesheet\' href=\'css/styles.css\'\>                  |
|                                                                             |
| → New: \<link rel=\'stylesheet\' href=\"{{ asset(\'css/styles.css\') }}\"\> |
|                                                                             |
| → Old: \<script src=\'js/scripts.js\'\>                                     |
|                                                                             |
| → New: \<script src=\"{{ asset(\'js/scripts.js\') }}\"\>                    |
|                                                                             |
| → Old: \<img src=\'images/logo.png\'\>                                      |
|                                                                             |
| → New: \<img src=\"{{ asset(\'images/logo.png\') }}\"\>                     |
|                                                                             |
| → Do this for EVERY single asset link across ALL your pages                 |
+-----------------------------------------------------------------------------+

+--------------------------------------------------------------------------+
| **STEP 6 --- Fix All Form Tags**                                         |
|                                                                          |
| → Add method=\'POST\' to every form                                      |
|                                                                          |
| → Add action pointing to the correct route                               |
|                                                                          |
| → Add this inside every form: {{ csrf_field() }} (REQUIRED for security) |
|                                                                          |
| → Change input type=\'submit\' or buttons accordingly                    |
|                                                                          |
| → Login form action → route(\'login\')                                   |
|                                                                          |
| → Register form action → route(\'register\')                             |
|                                                                          |
| → Contact form action → route(\'contact.submit\')                        |
+--------------------------------------------------------------------------+

+------------------------------------------------------------------------+
| **STEP 7 --- Fix All Internal Links (href)**                           |
|                                                                        |
| → Old: \<a href=\'login.html\'\>                                       |
|                                                                        |
| → New: \<a href=\"{{ route(\'login\') }}\"\>                           |
|                                                                        |
| → Old: \<a href=\'register.html\'\>                                    |
|                                                                        |
| → New: \<a href=\"{{ route(\'register\') }}\"\>                        |
|                                                                        |
| → Old: \<a href=\'index.html\'\>                                       |
|                                                                        |
| → New: \<a href=\"{{ route(\'home\') }}\"\>                            |
|                                                                        |
| → Every href must use the Blade route() helper --- never hardcode URLs |
+------------------------------------------------------------------------+

**2.2 Layout Breakdown --- What Goes Where**

Your master layout file (app.blade.php) must contain these four parts in order:

  -------------------------- ----------------------------------------------- ------------------------------------
  **Part**                   **What Goes Here**                              **Source From Your Files**

  1\. DOCTYPE & Head         HTML tag, charset, viewport, title, CSS links   Top section of any HTML file

  2\. Navigation Bar         Your full navbar/header HTML                    Repeating header in all pages

  3\. \@yield(\'content\')   Dynamic content slot --- each page fills this   Nothing --- this is new Blade code

  4\. Footer + Scripts       Footer HTML, all JS script tags                 Bottom of any HTML file
  -------------------------- ----------------------------------------------- ------------------------------------

> **SECTION 3 --- COMPLETE MySQL DATABASE SCHEMA (35+ TABLES)**

**Every table below must have its own Laravel Migration file inside database/migrations/. The order matters --- create parent tables before child tables that reference them.**

**3.1 User & Authentication Tables**

**Table: users**

  -------------------- ----------------- ------------------ ------------------------------
  **Column**           **Type**          **Constraint**     **Purpose**

  id                   BIGINT UNSIGNED   PRIMARY KEY        Auto increment

  name                 VARCHAR(255)      NOT NULL           Full name

  email                VARCHAR(255)      UNIQUE, NOT NULL   Login email

  phone                VARCHAR(20)       NULLABLE           Contact number

  password             VARCHAR(255)      NOT NULL           Bcrypt hashed

  role                 ENUM              NOT NULL           super_admin, agent, customer

  status               ENUM              DEFAULT active     active, inactive, suspended

  profile_photo        VARCHAR(255)      NULLABLE           Path to photo

  email_verified_at    TIMESTAMP         NULLABLE           Null = not verified

  two_factor_secret    TEXT              NULLABLE           Encrypted 2FA key

  two_factor_enabled   BOOLEAN           DEFAULT false      2FA toggle

  last_login_at        TIMESTAMP         NULLABLE           Last login time

  last_login_ip        VARCHAR(45)       NULLABLE           IPv4 or IPv6

  remember_token       VARCHAR(100)      NULLABLE           Laravel standard

  created_at           TIMESTAMP         NOT NULL           Auto timestamp

  updated_at           TIMESTAMP         NOT NULL           Auto timestamp

  deleted_at           TIMESTAMP         NULLABLE           Soft delete
  -------------------- ----------------- ------------------ ------------------------------

**Table: activity_logs (Audit Trail --- Every Action Recorded)**

  ------------------ ----------------- ---------------- ----------------------------
  **Column**         **Type**          **Constraint**   **Purpose**

  id                 BIGINT UNSIGNED   PRIMARY KEY      Auto increment

  user_id            BIGINT UNSIGNED   FK → users.id    Who performed the action

  action             VARCHAR(100)      NOT NULL         e.g. created_property

  model_type         VARCHAR(100)      NOT NULL         e.g. App\\Models\\Property

  model_id           BIGINT UNSIGNED   NULLABLE         ID of affected record

  old_values         JSON              NULLABLE         Before state

  new_values         JSON              NULLABLE         After state

  ip_address         VARCHAR(45)       NULLABLE         Request IP

  user_agent         TEXT              NULLABLE         Browser info

  created_at         TIMESTAMP         NOT NULL         When action happened
  ------------------ ----------------- ---------------- ----------------------------

**Table: password_reset_tokens**

  ------------------ ---------------- ---------------- --------------------
  **Column**         **Type**         **Constraint**   **Purpose**

  email              VARCHAR(255)     PRIMARY KEY      User email

  token              VARCHAR(255)     NOT NULL         Hashed reset token

  created_at         TIMESTAMP        NULLABLE         Token expiry basis
  ------------------ ---------------- ---------------- --------------------

**3.2 Agency & Agent Tables**

**Table: agencies**

  ------------------------- ----------------- ---------------- ---------------------
  **Column**                **Type**          **Constraint**   **Purpose**

  id                        BIGINT UNSIGNED   PRIMARY KEY      

  name                      VARCHAR(255)      NOT NULL         Agency name

  slug                      VARCHAR(255)      UNIQUE           URL identifier

  description               TEXT              NULLABLE         About agency

  phone                     VARCHAR(20)       NULLABLE         

  email                     VARCHAR(255)      NULLABLE         

  website                   VARCHAR(255)      NULLABLE         

  logo_path                 VARCHAR(255)      NULLABLE         Logo image

  cover_image_path          VARCHAR(255)      NULLABLE         Banner image

  address                   TEXT              NULLABLE         

  city                      VARCHAR(100)      NULLABLE         

  registration_number       VARCHAR(100)      NULLABLE         Govt registration

  license_number            VARCHAR(100)      NULLABLE         Real estate license

  verified                  BOOLEAN           DEFAULT false    Admin approved

  status                    ENUM              DEFAULT active   active, inactive

  created_at / updated_at   TIMESTAMP                          Standard timestamps

  deleted_at                TIMESTAMP         NULLABLE         Soft delete
  ------------------------- ----------------- ---------------- ---------------------

**Table: agents**

  ------------------------- ----------------- ----------------- -------------------------------
  **Column**                **Type**          **Constraint**    **Purpose**

  id                        BIGINT UNSIGNED   PRIMARY KEY       

  user_id                   BIGINT UNSIGNED   FK → users.id     Linked user account

  agency_id                 BIGINT UNSIGNED   FK NULLABLE       Agency they belong to

  license_number            VARCHAR(100)      NULLABLE          Agent license

  specialization            ENUM              NULLABLE          residential, commercial, both

  bio                       TEXT              NULLABLE          Agent description

  photo_path                VARCHAR(255)      NULLABLE          

  rating                    DECIMAL(3,2)      DEFAULT 0         Avg of all reviews

  total_sales               INT               DEFAULT 0         Count of sales

  total_rentals             INT               DEFAULT 0         Count of rentals

  verification_status       ENUM              DEFAULT pending   pending, verified, rejected

  created_at / updated_at   TIMESTAMP                           
  ------------------------- ----------------- ----------------- -------------------------------

**Table: agent_reviews**

  ------------------ ----------------- ---------------- -----------------------
  **Column**         **Type**          **Constraint**   **Purpose**

  id                 BIGINT UNSIGNED   PRIMARY KEY      

  agent_id           BIGINT UNSIGNED   FK → agents.id   

  reviewer_id        BIGINT UNSIGNED   FK → users.id    Customer who reviewed

  rating             TINYINT           1-5              Star rating

  comment            TEXT              NULLABLE         Review text

  created_at         TIMESTAMP                          
  ------------------ ----------------- ---------------- -----------------------

**3.3 Property Core Tables**

**Table: properties (Central Table --- Most Important)**

  ------------------------- ----------------- ------------------------ ------------------------------
  **Column**                **Type**          **Constraint**           **Purpose**

  id                        BIGINT UNSIGNED   PRIMARY KEY              

  title                     VARCHAR(255)      NOT NULL                 Listing title

  slug                      VARCHAR(255)      UNIQUE                   URL-friendly title

  description               LONGTEXT          NULLABLE                 Full description

  agent_id                  BIGINT UNSIGNED   FK → agents.id           Listing agent

  property_type_id          BIGINT UNSIGNED   FK → property_types      Apartment, Villa, etc.

  transaction_type          ENUM              NOT NULL                 sale, rent

  status_id                 BIGINT UNSIGNED   FK → property_statuses   Available, Sold, etc.

  sale_price                DECIMAL(15,2)     NULLABLE                 Price if for sale

  rental_price              DECIMAL(12,2)     NULLABLE                 Price if for rent

  rental_period             ENUM              NULLABLE                 monthly, yearly

  bedrooms                  TINYINT           NULLABLE                 Number of bedrooms

  bathrooms                 TINYINT           NULLABLE                 Number of bathrooms

  area_sqft                 DECIMAL(10,2)     NULLABLE                 Total area

  year_built                YEAR              NULLABLE                 Construction year

  furnishing_type           ENUM              NULLABLE                 furnished, unfurnished, semi

  parking_spaces            TINYINT           DEFAULT 0                

  floor_number              TINYINT           NULLABLE                 Apartment floor

  total_floors              TINYINT           NULLABLE                 

  video_url                 VARCHAR(500)      NULLABLE                 YouTube or video link

  virtual_tour_url          VARCHAR(500)      NULLABLE                 Matterport 3D link

  featured                  BOOLEAN           DEFAULT false            Show in featured section

  featured_until            DATE              NULLABLE                 Expiry of featuring

  views_count               INT               DEFAULT 0                Public view counter

  seo_title                 VARCHAR(255)      NULLABLE                 Meta title

  seo_description           TEXT              NULLABLE                 Meta description

  seo_keywords              TEXT              NULLABLE                 Meta keywords

  published                 BOOLEAN           DEFAULT false            Admin must approve

  published_at              TIMESTAMP         NULLABLE                 

  created_at / updated_at   TIMESTAMP                                  

  deleted_at                TIMESTAMP         NULLABLE                 Soft delete
  ------------------------- ----------------- ------------------------ ------------------------------

**Table: property_types**

  ------------------ ----------------- ---------------- --------------------------------------------------------------
  **Column**         **Type**          **Constraint**   **Purpose**

  id                 BIGINT UNSIGNED   PRIMARY KEY      

  name               VARCHAR(100)      NOT NULL         Apartment, Villa, House, Plot, Office, Shop, Warehouse, Farm

  icon               VARCHAR(100)      NULLABLE         FontAwesome icon class

  description        TEXT              NULLABLE         
  ------------------ ----------------- ---------------- --------------------------------------------------------------

**Table: property_statuses**

  ------------------ ----------------- ---------------- --------------------------------------------
  **Column**         **Type**          **Constraint**   **Purpose**

  id                 BIGINT UNSIGNED   PRIMARY KEY      

  name               VARCHAR(50)       NOT NULL         Available, Sold, Rented, Pending, Inactive

  color_code         VARCHAR(7)        NULLABLE         Hex color for badge
  ------------------ ----------------- ---------------- --------------------------------------------

**Table: property_images**

  ------------------ ----------------- -------------------- --------------------
  **Column**         **Type**          **Constraint**       **Purpose**

  id                 BIGINT UNSIGNED   PRIMARY KEY          

  property_id        BIGINT UNSIGNED   FK → properties.id   

  image_path         VARCHAR(500)      NOT NULL             Storage path

  alt_text           VARCHAR(255)      NULLABLE             Image description

  is_primary         BOOLEAN           DEFAULT false        Main listing image

  sort_order         TINYINT           DEFAULT 0            Display order

  uploaded_at        TIMESTAMP                              
  ------------------ ----------------- -------------------- --------------------

**Table: property_documents (Brochures, Legal Papers, Title Deeds)**

  ------------------ ----------------- -------------------- ------------------------------
  **Column**         **Type**          **Constraint**       **Purpose**

  id                 BIGINT UNSIGNED   PRIMARY KEY          

  property_id        BIGINT UNSIGNED   FK → properties.id   

  title              VARCHAR(255)      NOT NULL             Document name

  file_path          VARCHAR(500)      NOT NULL             Storage path

  file_type          VARCHAR(10)       NOT NULL             pdf, doc, docx

  is_public          BOOLEAN           DEFAULT false        Visible to all or agent only

  uploaded_by        BIGINT UNSIGNED   FK → users.id        

  uploaded_at        TIMESTAMP                              
  ------------------ ----------------- -------------------- ------------------------------

**Table: features + Table: property_features (Many-to-Many)**

  ------------------------------------- ----------------- -------------------- ------------------------------------------------------------------------------
  **features table**                                                           

  id                                    BIGINT UNSIGNED   PRIMARY KEY          

  name                                  VARCHAR(100)      NOT NULL             Pool, Gym, Garden, AC, Elevator, Security, Basement, Balcony, Parking, Solar

  icon                                  VARCHAR(100)      NULLABLE             Icon class

  **property_features table (pivot)**                                          

  id                                    BIGINT UNSIGNED   PRIMARY KEY          

  property_id                           BIGINT UNSIGNED   FK → properties.id   

  feature_id                            BIGINT UNSIGNED   FK → features.id     
  ------------------------------------- ----------------- -------------------- ------------------------------------------------------------------------------

**Table: property_locations**

  ------------------ ----------------- -------------------- --------------------
  **Column**         **Type**          **Constraint**       **Purpose**

  id                 BIGINT UNSIGNED   PRIMARY KEY          

  property_id        BIGINT UNSIGNED   FK → properties.id   

  country            VARCHAR(100)      NOT NULL             

  city               VARCHAR(100)      NOT NULL             

  area               VARCHAR(100)      NULLABLE             Neighbourhood

  postal_code        VARCHAR(20)       NULLABLE             

  address_line_1     VARCHAR(255)      NOT NULL             

  address_line_2     VARCHAR(255)      NULLABLE             

  latitude           DECIMAL(10,8)     NULLABLE             For map pin

  longitude          DECIMAL(11,8)     NULLABLE             For map pin

  google_maps_link   TEXT              NULLABLE             Embed URL
  ------------------ ----------------- -------------------- --------------------

**3.4 Rental-Specific Tables**

**Table: rental_terms**

  -------------------- ----------------- -------------------- -----------------------
  **Column**           **Type**          **Constraint**       **Purpose**

  id                   BIGINT UNSIGNED   PRIMARY KEY          

  property_id          BIGINT UNSIGNED   FK → properties.id   

  min_lease_months     TINYINT           NULLABLE             Minimum rental period

  max_lease_months     TINYINT           NULLABLE             Maximum rental period

  deposit_amount       DECIMAL(12,2)     NULLABLE             

  deposit_type         ENUM              NULLABLE             fixed, percentage

  pet_friendly         BOOLEAN           DEFAULT false        

  smoking_allowed      BOOLEAN           DEFAULT false        

  utilities_included   BOOLEAN           DEFAULT false        

  cancellation_terms   TEXT              NULLABLE             Written rules
  -------------------- ----------------- -------------------- -----------------------

**Table: tenants (Active/Past Tenants)**

  ------------------------- ----------------- -------------------- -----------------------------
  **Column**                **Type**          **Constraint**       **Purpose**

  id                        BIGINT UNSIGNED   PRIMARY KEY          

  property_id               BIGINT UNSIGNED   FK → properties.id   

  user_id                   BIGINT UNSIGNED   FK → users.id        The customer tenant

  lease_start_date          DATE              NOT NULL             

  lease_end_date            DATE              NOT NULL             

  deposit_paid_amount       DECIMAL(12,2)     NULLABLE             

  rent_paid_until           DATE              NULLABLE             Last paid month end

  status                    ENUM              DEFAULT active       active, expired, terminated

  reference_check_status    ENUM              DEFAULT pending      pending, passed, failed

  created_at / updated_at   TIMESTAMP                              
  ------------------------- ----------------- -------------------- -----------------------------

**Table: rental_payment_schedule**

  ------------------ ----------------- ----------------- ------------------------
  **Column**         **Type**          **Constraint**    **Purpose**

  id                 BIGINT UNSIGNED   PRIMARY KEY       

  tenant_id          BIGINT UNSIGNED   FK → tenants.id   

  due_date           DATE              NOT NULL          When rent is due

  amount             DECIMAL(12,2)     NOT NULL          

  status             ENUM              DEFAULT pending   pending, paid, overdue

  payment_date       DATE              NULLABLE          When actually paid

  payment_method     VARCHAR(50)       NULLABLE          

  notes              TEXT              NULLABLE          
  ------------------ ----------------- ----------------- ------------------------

**3.5 Sales-Specific Tables**

**Table: offers (Buyers Make Offers on Sale Properties)**

  ------------------------- ----------------- -------------------- ----------------------------------------
  **Column**                **Type**          **Constraint**       **Purpose**

  id                        BIGINT UNSIGNED   PRIMARY KEY          

  property_id               BIGINT UNSIGNED   FK → properties.id   

  buyer_id                  BIGINT UNSIGNED   FK → users.id        Customer making offer

  offer_price               DECIMAL(15,2)     NOT NULL             

  offer_date                DATE              NOT NULL             

  status                    ENUM              DEFAULT pending      pending, accepted, rejected, withdrawn

  expiry_date               DATE              NULLABLE             Offer valid until

  message                   TEXT              NULLABLE             Buyer\'s note

  created_at / updated_at   TIMESTAMP                              
  ------------------------- ----------------- -------------------- ----------------------------------------

**3.6 Inquiry & Appointment Tables**

**Table: inquiries**

  ------------------------- ----------------- -------------------- ------------------------------------------------------------
  **Column**                **Type**          **Constraint**       **Purpose**

  id                        BIGINT UNSIGNED   PRIMARY KEY          

  property_id               BIGINT UNSIGNED   FK → properties.id   

  inquirer_id               BIGINT UNSIGNED   FK → users.id        

  agent_id                  BIGINT UNSIGNED   FK → agents.id       

  inquiry_type              ENUM              NOT NULL             schedule_viewing, price_inquiry, document_request, general

  message                   TEXT              NOT NULL             

  status                    ENUM              DEFAULT new          new, responded, resolved, spam

  priority                  ENUM              DEFAULT normal       low, normal, high

  responded_at              TIMESTAMP         NULLABLE             

  responded_by              BIGINT UNSIGNED   FK NULLABLE          Agent who replied

  created_at / updated_at   TIMESTAMP                              
  ------------------------- ----------------- -------------------- ------------------------------------------------------------

**Table: appointments (Property Viewings)**

  ------------------------- ----------------- -------------------- -----------------------------------------------------
  **Column**                **Type**          **Constraint**       **Purpose**

  id                        BIGINT UNSIGNED   PRIMARY KEY          

  property_id               BIGINT UNSIGNED   FK → properties.id   

  customer_id               BIGINT UNSIGNED   FK → users.id        

  agent_id                  BIGINT UNSIGNED   FK → agents.id       

  appointment_date          DATE              NOT NULL             

  appointment_time          TIME              NOT NULL             

  status                    ENUM              DEFAULT scheduled    scheduled, confirmed, completed, cancelled, no_show

  pre_notes                 TEXT              NULLABLE             Customer notes before

  post_notes                TEXT              NULLABLE             Agent feedback after

  created_at / updated_at   TIMESTAMP                              
  ------------------------- ----------------- -------------------- -----------------------------------------------------

**Table: favorites**

  ------------------ ----------------- -------------------- --------------------
  **Column**         **Type**          **Constraint**       **Purpose**

  id                 BIGINT UNSIGNED   PRIMARY KEY          

  customer_id        BIGINT UNSIGNED   FK → users.id        

  property_id        BIGINT UNSIGNED   FK → properties.id   

  added_at           TIMESTAMP                              When they saved it
  ------------------ ----------------- -------------------- --------------------

**3.7 Payment & Financial Tables**

**Table: transactions**

  ------------------------ ----------------- ----------------- -------------------------------------------------------------------
  **Column**               **Type**          **Constraint**    **Purpose**

  id                       BIGINT UNSIGNED   PRIMARY KEY       

  user_id                  BIGINT UNSIGNED   FK → users.id     

  property_id              BIGINT UNSIGNED   FK NULLABLE       

  transaction_type         ENUM              NOT NULL          listing_fee, premium_feature, deposit, commission, rental_payment

  amount                   DECIMAL(15,2)     NOT NULL          

  currency                 VARCHAR(3)        DEFAULT PKR       

  payment_method           VARCHAR(50)       NULLABLE          JazzCash, EasyPaisa, Bank

  gateway_transaction_id   VARCHAR(255)      NULLABLE          From payment gateway

  status                   ENUM              DEFAULT pending   pending, completed, failed, refunded

  notes                    TEXT              NULLABLE          

  created_at               TIMESTAMP                           
  ------------------------ ----------------- ----------------- -------------------------------------------------------------------

**Table: invoices**

  ------------------------- ----------------- ---------------- ---------------------------------------
  **Column**                **Type**          **Constraint**   **Purpose**

  id                        BIGINT UNSIGNED   PRIMARY KEY      

  user_id                   BIGINT UNSIGNED   FK → users.id    

  invoice_number            VARCHAR(50)       UNIQUE           Auto-generated e.g. INV-2025-0001

  total_amount              DECIMAL(15,2)     NOT NULL         

  status                    ENUM              DEFAULT draft    draft, sent, paid, overdue, cancelled

  due_date                  DATE              NULLABLE         

  paid_at                   TIMESTAMP         NULLABLE         

  created_at / updated_at   TIMESTAMP                          
  ------------------------- ----------------- ---------------- ---------------------------------------

**3.8 Content & CMS Tables**

**Table: pages (Dynamic Pages like Privacy, Terms, About)**

  ------------------------- ----------------- ---------------- ------------------------
  **Column**                **Type**          **Constraint**   **Purpose**

  id                        BIGINT UNSIGNED   PRIMARY KEY      

  title                     VARCHAR(255)      NOT NULL         

  slug                      VARCHAR(255)      UNIQUE           URL path

  content                   LONGTEXT          NOT NULL         HTML/Rich text content

  meta_title                VARCHAR(255)      NULLABLE         

  meta_description          TEXT              NULLABLE         

  published                 BOOLEAN           DEFAULT true     

  created_at / updated_at   TIMESTAMP                          
  ------------------------- ----------------- ---------------- ------------------------

**Table: blog_posts**

  ------------------------- ----------------- ------------------------- --------------------
  **Column**                **Type**          **Constraint**            **Purpose**

  id                        BIGINT UNSIGNED   PRIMARY KEY               

  author_id                 BIGINT UNSIGNED   FK → users.id             

  category_id               BIGINT UNSIGNED   FK → blog_categories.id   

  title                     VARCHAR(255)      NOT NULL                  

  slug                      VARCHAR(255)      UNIQUE                    

  content                   LONGTEXT          NOT NULL                  

  excerpt                   TEXT              NULLABLE                  Short preview text

  featured_image_path       VARCHAR(500)      NULLABLE                  

  published                 BOOLEAN           DEFAULT false             

  published_at              TIMESTAMP         NULLABLE                  

  view_count                INT               DEFAULT 0                 

  created_at / updated_at   TIMESTAMP                                   
  ------------------------- ----------------- ------------------------- --------------------

**Table: testimonials**

  ------------------ ----------------- ---------------- --------------------
  **Column**         **Type**          **Constraint**   **Purpose**

  id                 BIGINT UNSIGNED   PRIMARY KEY      

  customer_id        BIGINT UNSIGNED   FK NULLABLE      

  name               VARCHAR(255)      NOT NULL         Display name

  rating             TINYINT           1-5              

  comment            TEXT              NOT NULL         

  photo_path         VARCHAR(255)      NULLABLE         

  published          BOOLEAN           DEFAULT false    Admin must approve

  created_at         TIMESTAMP                          
  ------------------ ----------------- ---------------- --------------------

**Table: faqs**

  ------------------ ----------------- ---------------- ----------------------------------
  **Column**         **Type**          **Constraint**   **Purpose**

  id                 BIGINT UNSIGNED   PRIMARY KEY      

  question           TEXT              NOT NULL         

  answer             LONGTEXT          NOT NULL         

  category           VARCHAR(100)      NULLABLE         General, Buying, Renting, Agents

  sort_order         TINYINT           DEFAULT 0        

  published          BOOLEAN           DEFAULT true     
  ------------------ ----------------- ---------------- ----------------------------------

**Table: banners (Homepage Sliders & Promotions)**

  --------------------- ----------------- ---------------- ---------------------
  **Column**            **Type**          **Constraint**   **Purpose**

  id                    BIGINT UNSIGNED   PRIMARY KEY      

  title                 VARCHAR(255)      NOT NULL         

  description           TEXT              NULLABLE         

  image_path            VARCHAR(500)      NOT NULL         

  cta_text              VARCHAR(100)      NULLABLE         Button text

  cta_url               VARCHAR(500)      NULLABLE         Button link

  sort_order            TINYINT           DEFAULT 0        

  is_active             BOOLEAN           DEFAULT true     

  starts_at / ends_at   TIMESTAMP         NULLABLE         Campaign scheduling
  --------------------- ----------------- ---------------- ---------------------

**Table: settings (Global Site Configuration)**

  ------------------ ----------------- ----------------- --------------------------------------
  **Column**         **Type**          **Constraint**    **Purpose**

  id                 BIGINT UNSIGNED   PRIMARY KEY       

  key                VARCHAR(100)      UNIQUE            e.g. site_name, contact_email

  value              LONGTEXT          NULLABLE          The setting value

  type               VARCHAR(20)       DEFAULT string    string, int, boolean, json

  group              VARCHAR(50)       DEFAULT general   general, email, payment, seo, social

  description        TEXT              NULLABLE          

  updated_at         TIMESTAMP                           
  ------------------ ----------------- ----------------- --------------------------------------

**3.9 Notification Tables**

**Table: notifications**

  ------------------ ----------------- ---------------- -------------------------------------
  **Column**         **Type**          **Constraint**   **Purpose**

  id                 UUID              PRIMARY KEY      Laravel uses UUID for notifications

  type               VARCHAR(255)      NOT NULL         Notification class name

  notifiable_type    VARCHAR(255)      NOT NULL         Model type (User)

  notifiable_id      BIGINT UNSIGNED   NOT NULL         User ID

  data               JSON              NOT NULL         Notification content

  read_at            TIMESTAMP         NULLABLE         Null = unread

  created_at         TIMESTAMP                          
  ------------------ ----------------- ---------------- -------------------------------------

**Table: email_logs**

  ------------------ ----------------- ---------------- -----------------------
  **Column**         **Type**          **Constraint**   **Purpose**

  id                 BIGINT UNSIGNED   PRIMARY KEY      

  to_email           VARCHAR(255)      NOT NULL         

  subject            VARCHAR(255)      NOT NULL         

  body               LONGTEXT          NOT NULL         

  status             ENUM              NOT NULL         sent, failed, bounced

  error_message      TEXT              NULLABLE         

  sent_at            TIMESTAMP                          
  ------------------ ----------------- ---------------- -----------------------

> **SECTION 4 --- THREE-LEVEL DASHBOARD ARCHITECTURE**

**4.1 Dashboard Overview Comparison**

  ----------------- ------------------------------------ ------------------------------ ------------------------
  **Feature**       **Super Admin /admin**               **Agent /agent**               **Customer /customer**

  Access URL        /admin/dashboard                     /agent/dashboard               /customer/dashboard

  Middleware        auth + role:super_admin + verified   auth + role:agent + verified   auth + role:customer

  2FA               Mandatory                            Optional                       Optional

  Session Timeout   30 minutes                           60 minutes                     120 minutes

  IP Restriction    Configurable whitelist               None                           None

  DB Access         All tables full R/W                  Own records only               Own records only
  ----------------- ------------------------------------ ------------------------------ ------------------------

**4.2 Super Admin Dashboard --- Full Feature List**

+----------------------------------------------------------------------------------------+
| **Super Admin can do ALL of the following:**                                           |
|                                                                                        |
| → View real-time system stats: total users, total properties, total inquiries, revenue |
|                                                                                        |
| → Create / Edit / Suspend / Delete any user account                                    |
|                                                                                        |
| → Approve or reject new agent registrations                                            |
|                                                                                        |
| → Approve or reject new property listings before they go public                        |
|                                                                                        |
| → Manage all property listings (edit, feature, archive, delete)                        |
|                                                                                        |
| → Manage all agencies (verify, suspend, delete)                                        |
|                                                                                        |
| → Set platform pricing (listing fees, premium feature costs)                           |
|                                                                                        |
| → View all transactions and generate financial reports                                 |
|                                                                                        |
| → View full audit/activity log of every action ever taken                              |
|                                                                                        |
| → Send announcements or emails to all users or specific groups                         |
|                                                                                        |
| → Manage blog posts, FAQs, testimonials, banners, and pages                            |
|                                                                                        |
| → Configure all site settings (name, logo, email, payment keys)                        |
|                                                                                        |
| → View and respond to contact form submissions                                         |
|                                                                                        |
| → Manage system roles and permissions                                                  |
|                                                                                        |
| → Export data (users, properties, transactions) as CSV or PDF                          |
+----------------------------------------------------------------------------------------+

**4.3 Agent Dashboard --- Full Feature List**

+---------------------------------------------------------------------------------------------+
| **Agent can do ALL of the following:**                                                      |
|                                                                                             |
| → View personal stats: total listings, total inquiries, appointments today, conversion rate |
|                                                                                             |
| → Create new property listings (submitted for admin approval)                               |
|                                                                                             |
| → Edit, update, or delete their own property listings                                       |
|                                                                                             |
| → Upload multiple images, videos, and documents per property                                |
|                                                                                             |
| → View all inquiries sent to their properties with contact details                          |
|                                                                                             |
| → Reply to inquiries directly from the dashboard                                            |
|                                                                                             |
| → View and manage all scheduled property viewing appointments                               |
|                                                                                             |
| → Mark appointments as completed, cancelled, or no-show                                     |
|                                                                                             |
| → View all offers made on their sale properties, accept or reject                           |
|                                                                                             |
| → Manage active tenants for their rental properties                                         |
|                                                                                             |
| → Track rental payment schedule for each tenant                                             |
|                                                                                             |
| → View their performance analytics (monthly/yearly graphs)                                  |
|                                                                                             |
| → Manage their own profile, photo, bio, and contact details                                 |
|                                                                                             |
| → View invoices and listing fee history                                                     |
|                                                                                             |
| → Request account verification/license upload                                               |
+---------------------------------------------------------------------------------------------+

**4.4 Customer Dashboard --- Full Feature List**

+----------------------------------------------------------------------------+
| **Customer can do ALL of the following:**                                  |
|                                                                            |
| → Browse all published property listings with full search and filter       |
|                                                                            |
| → View detailed property pages with images, documents, map, and agent info |
|                                                                            |
| → Save properties to their personal favorites/wishlist                     |
|                                                                            |
| → Send inquiries to agents about specific properties                       |
|                                                                            |
| → Schedule property viewing appointments                                   |
|                                                                            |
| → Make offers on properties listed for sale                                |
|                                                                            |
| → Track status of all their inquiries (new/responded/resolved)             |
|                                                                            |
| → View all upcoming and past appointments                                  |
|                                                                            |
| → View their active rental agreement details (if tenant)                   |
|                                                                            |
| → View their rental payment schedule and history                           |
|                                                                            |
| → Write reviews for agents they have worked with                           |
|                                                                            |
| → Manage their profile, photo, and contact details                         |
|                                                                            |
| → Change password and manage security settings                             |
|                                                                            |
| → Enable/disable 2FA for their account                                     |
|                                                                            |
| → Download invoices and receipts                                           |
+----------------------------------------------------------------------------+

> **SECTION 5 --- COMPLETE ROUTES ARCHITECTURE**

**All routes go inside routes/web.php. They must be organized in these groups:**

**5.1 Public Routes (No Login Required)**

  ------------ -------------------- --------------------------- ----------------------
  **Method**   **URL**              **Controller@Method**       **Purpose**

  GET          /                    HomeController@index        Homepage

  GET          /properties          PropertyController@index    All listings

  GET          /properties/{slug}   PropertyController@show     Single property

  GET          /properties/search   PropertyController@search   Search results

  GET          /agents              AgentController@index       All agents

  GET          /agents/{id}         AgentController@show        Agent profile

  GET          /contact             ContactController@index     Contact page

  POST         /contact             ContactController@submit    Submit form

  GET          /about               PageController@about        About page

  GET          /privacy             PageController@privacy      Privacy page

  GET          /terms               PageController@terms        Terms page

  GET          /blog                BlogController@index        Blog listing

  GET          /blog/{slug}         BlogController@show         Single blog post
  ------------ -------------------- --------------------------- ----------------------

**5.2 Auth Routes (Guest Only --- Redirect if Logged In)**

  ------------ ------------------------- ------------------------------ --------------------
  **Method**   **URL**                   **Controller@Method**          **Purpose**

  GET          /login                    AuthController@loginForm       Login page

  POST         /login                    AuthController@login           Process login

  GET          /register                 AuthController@registerForm    Register page

  POST         /register                 AuthController@register        Process register

  GET          /forgot-password          PasswordController@form        Forgot password

  POST         /forgot-password          PasswordController@send        Send reset link

  GET          /reset-password/{token}   PasswordController@resetForm   Reset form

  POST         /reset-password           PasswordController@reset       Process reset

  POST         /logout                   AuthController@logout          Logout
  ------------ ------------------------- ------------------------------ --------------------

**5.3 Admin Routes (Prefix: /admin --- Role: super_admin)**

  ------------ -------------------------------- ------------------------------------ -------------------
  **Method**   **URL**                          **Controller@Method**                **Purpose**

  GET          /admin/dashboard                 Admin\\DashboardController@index     Main dashboard

  GET          /admin/users                     Admin\\UserController@index          All users

  GET/POST     /admin/users/create              Admin\\UserController@create         Add user

  GET/PUT      /admin/users/{id}/edit           Admin\\UserController@edit           Edit user

  DELETE       /admin/users/{id}                Admin\\UserController@destroy        Delete user

  GET          /admin/properties                Admin\\PropertyController@index      All listings

  POST         /admin/properties/{id}/approve   Admin\\PropertyController@approve    Approve listing

  GET          /admin/agents                    Admin\\AgentController@index         All agents

  POST         /admin/agents/{id}/verify        Admin\\AgentController@verify        Verify agent

  GET          /admin/transactions              Admin\\TransactionController@index   All payments

  GET          /admin/reports                   Admin\\ReportController@index        Reports

  GET          /admin/activity-logs             Admin\\LogController@index           Audit trail

  GET/POST     /admin/settings                  Admin\\SettingController@index       Site settings

  GET          /admin/inquiries                 Admin\\InquiryController@index       All inquiries

  GET          /admin/blog                      Admin\\BlogController@index          Manage blog
  ------------ -------------------------------- ------------------------------------ -------------------

**5.4 Agent Routes (Prefix: /agent --- Role: agent)**

  ------------ ----------------------------- ------------------------------------- -------------------
  **Method**   **URL**                       **Controller@Method**                 **Purpose**

  GET          /agent/dashboard              Agent\\DashboardController@index      Dashboard

  GET          /agent/properties             Agent\\PropertyController@index       My listings

  GET/POST     /agent/properties/create      Agent\\PropertyController@create      Add listing

  GET/PUT      /agent/properties/{id}/edit   Agent\\PropertyController@edit        Edit listing

  DELETE       /agent/properties/{id}        Agent\\PropertyController@destroy     Remove listing

  GET          /agent/inquiries              Agent\\InquiryController@index        My inquiries

  POST         /agent/inquiries/{id}/reply   Agent\\InquiryController@reply        Reply

  GET          /agent/appointments           Agent\\AppointmentController@index    Appointments

  PUT          /agent/appointments/{id}      Agent\\AppointmentController@update   Update status

  GET          /agent/offers                 Agent\\OfferController@index          Received offers

  POST         /agent/offers/{id}/accept     Agent\\OfferController@accept         Accept offer

  GET          /agent/tenants                Agent\\TenantController@index         My tenants

  GET          /agent/profile                Agent\\ProfileController@edit         Edit profile
  ------------ ----------------------------- ------------------------------------- -------------------

**5.5 Customer Routes (Prefix: /customer --- Role: customer)**

  ------------ -------------------------- --------------------------------------- -------------------
  **Method**   **URL**                    **Controller@Method**                   **Purpose**

  GET          /customer/dashboard        Customer\\DashboardController@index     Dashboard

  GET          /customer/favorites        Customer\\FavoriteController@index      Saved properties

  POST         /customer/favorites/{id}   Customer\\FavoriteController@toggle     Save/Unsave

  GET          /customer/inquiries        Customer\\InquiryController@index       My inquiries

  POST         /customer/inquiries        Customer\\InquiryController@store       Send inquiry

  GET          /customer/appointments     Customer\\AppointmentController@index   My viewings

  POST         /customer/appointments     Customer\\AppointmentController@store   Book viewing

  GET          /customer/offers           Customer\\OfferController@index         My offers

  POST         /customer/offers           Customer\\OfferController@store         Make offer

  GET          /customer/rental           Customer\\TenantController@index        My rental

  GET          /customer/profile          Customer\\ProfileController@edit        Edit profile
  ------------ -------------------------- --------------------------------------- -------------------

> **SECTION 6 --- COMPLETE SECURITY STACK**

**6.1 Authentication Security**

  ------------------------ -------------------------------------------------------------------------------------------------------------------------------------------------------
  **Security Feature**     **What You Must Do**

  Email Verification       User model must implement MustVerifyEmail interface. All protected routes must include verified middleware. Email sent automatically on registration.

  Two-Factor Auth (2FA)    Install package: pragmarx/google2fa-laravel. Store encrypted 2FA secret in users table. Show QR code on profile settings. Mandatory for Super Admin.

  Password Hashing         Laravel uses Bcrypt by default. Never store plain passwords. Use Hash::make() always. Set minimum password length to 8 in validation.

  Rate Limiting on Login   Limit login attempts to 5 per minute per IP. After 5 fails, lock for 15 minutes. Configure using Laravel\'s RateLimiter in AppServiceProvider.

  Secure Session Config    Set session lifetime to 30 mins for admin. Use database driver for sessions (not files). Enable session encryption in config/session.php.

  Remember Me Token        Use HttpOnly and Secure cookies. Regenerate session ID on login. Invalidate all sessions on password change.
  ------------------------ -------------------------------------------------------------------------------------------------------------------------------------------------------

**6.2 Request & Data Security**

  ---------------------- -----------------------------------------------------------------------------------------------------------------------------------------------------
  **Security Feature**   **What You Must Do**

  CSRF Protection        Every form must include \@csrf directive. Laravel validates CSRF token on every POST, PUT, PATCH, DELETE request automatically.

  XSS Prevention         Always use {{ }} double braces in Blade --- never {!! !!} unless you trust the content 100%. Sanitize all user input before saving.

  SQL Injection          Always use Eloquent ORM or Query Builder with parameter binding. Never concatenate raw user input into SQL queries.

  File Upload Security   Validate MIME type AND file extension both. Store uploads outside public folder (storage/app/private). Generate random filenames using Str::uuid().

  Input Validation       Create a Form Request class for every form. Validate all fields strictly. Never trust frontend validation alone.

  Mass Assignment        Define fillable array on every Model. Never use guarded = \[\]. List every allowed column explicitly.
  ---------------------- -----------------------------------------------------------------------------------------------------------------------------------------------------

**6.3 Server & Infrastructure Security**

  ----------------------- ----------------------------------------------------------------------------------------------------------------------------------------------------------
  **Security Feature**    **What You Must Do**

  Environment Variables   All secrets go in .env file only. Never commit .env to Git. Add .env to .gitignore. Use strong random APP_KEY (32 characters).

  HTTPS / SSL             Install SSL certificate (Let\'s Encrypt is free). Force HTTPS using middleware. Set SECURE cookies. Configure HSTS headers.

  SFTP File Transfer      Never use plain FTP. Use SFTP with SSH key authentication only. Disable password authentication on SSH. Use port other than 22.

  Database Security       Create a separate MySQL user with only necessary permissions. Never use root user for the app. Use strong password. Restrict to localhost only.

  HTTP Security Headers   Add these headers: X-Frame-Options: DENY, X-Content-Type-Options: nosniff, X-XSS-Protection: 1, Referrer-Policy: strict-origin, Content-Security-Policy.

  Debug Mode              Set APP_DEBUG=false in production. Errors must log to file not screen. Use APP_ENV=production in .env on live server.

  Backup Strategy         Daily automated database backup. Store backups offsite (separate server or cloud). Test restore procedure monthly. Use package: spatie/laravel-backup.
  ----------------------- ----------------------------------------------------------------------------------------------------------------------------------------------------------

> **SECTION 7 --- REQUIRED PACKAGES & ARTISAN COMMANDS**

**7.1 Composer Packages to Install**

  ------------------------ --------------------------------------------- ------------------------------------------
  **Package**              **Command**                                   **Purpose**

  Laravel Breeze           composer require laravel/breeze               Auth scaffolding (login, register, etc.)

  Spatie Permissions       composer require spatie/laravel-permission    Role & permission system

  Google 2FA               composer require pragmarx/google2fa-laravel   Two-factor authentication

  QR Code (for 2FA)        composer require bacon/bacon-qr-code          Generate 2FA QR codes

  Intervention Image       composer require intervention/image           Resize & watermark property images

  Laravel Sluggable        composer require spatie/laravel-sluggable     Auto-generate URL slugs

  Laravel Backup           composer require spatie/laravel-backup        Automated database backups

  Laravel ActivityLog      composer require spatie/laravel-activitylog   Audit trail logging

  Laravel Excel            composer require maatwebsite/excel            Export data to Excel/CSV

  Laravel DomPDF           composer require barryvdh/laravel-dompdf      Generate PDF invoices/reports

  Laravel Telescope        composer require laravel/telescope \--dev     Debug tool (dev only)

  Laravel Horizon          composer require laravel/horizon              Queue job monitoring
  ------------------------ --------------------------------------------- ------------------------------------------

**7.2 NPM Packages for Frontend**

  ------------------------ ----------------------------------------------
  **Package**              **Purpose**

  Alpine.js                Lightweight JS for dropdowns, modals, tabs

  Swiper.js                Property image slider / carousel

  Select2 or Tom Select    Advanced dropdown for filters

  Flatpickr                Date and time picker for appointments

  Leaflet.js               Open source maps for property locations

  Chart.js                 Admin dashboard analytics graphs

  Dropzone.js              Drag and drop image upload for properties

  Toastr.js                Success and error notification popups

  DataTables.js            Sortable, paginated tables in admin panel
  ------------------------ ----------------------------------------------

**7.3 Critical Artisan Commands in Order**

+------------------------------------------------------------------------------------------+
| \# 1. Create new Laravel 11 project                                                      |
|                                                                                          |
| composer create-project laravel/laravel real-estate                                      |
|                                                                                          |
| \# 2. Install Breeze for auth scaffolding                                                |
|                                                                                          |
| composer require laravel/breeze                                                          |
|                                                                                          |
| php artisan breeze:install blade                                                         |
|                                                                                          |
| npm install && npm run build                                                             |
|                                                                                          |
| \# 3. Install Spatie Permission                                                          |
|                                                                                          |
| composer require spatie/laravel-permission                                               |
|                                                                                          |
| php artisan vendor:publish \--provider=\'Spatie\\Permission\\PermissionServiceProvider\' |
|                                                                                          |
| \# 4. Configure .env with your database credentials                                      |
|                                                                                          |
| DB_CONNECTION=mysql                                                                      |
|                                                                                          |
| DB_HOST=127.0.0.1                                                                        |
|                                                                                          |
| DB_PORT=3306                                                                             |
|                                                                                          |
| DB_DATABASE=realestate_db                                                                |
|                                                                                          |
| DB_USERNAME=your_user                                                                    |
|                                                                                          |
| DB_PASSWORD=your_password                                                                |
|                                                                                          |
| \# 5. Run ALL migrations                                                                 |
|                                                                                          |
| php artisan migrate                                                                      |
|                                                                                          |
| \# 6. Seed the database with initial data                                                |
|                                                                                          |
| php artisan db:seed                                                                      |
|                                                                                          |
| \# 7. Create symbolic link for file storage                                              |
|                                                                                          |
| php artisan storage:link                                                                 |
|                                                                                          |
| \# 8. Generate application key                                                           |
|                                                                                          |
| php artisan key:generate                                                                 |
|                                                                                          |
| \# 9. Clear all caches (run after any config change)                                     |
|                                                                                          |
| php artisan config:clear                                                                 |
|                                                                                          |
| php artisan cache:clear                                                                  |
|                                                                                          |
| php artisan view:clear                                                                   |
|                                                                                          |
| php artisan route:clear                                                                  |
|                                                                                          |
| \# 10. For production --- optimize everything                                            |
|                                                                                          |
| php artisan config:cache                                                                 |
|                                                                                          |
| php artisan route:cache                                                                  |
|                                                                                          |
| php artisan view:cache                                                                   |
|                                                                                          |
| npm run build                                                                            |
+------------------------------------------------------------------------------------------+

> **SECTION 8 --- MIGRATION FILE ORDER (CRITICAL)**

**Create migrations in this exact order. Parent tables must exist before child tables that reference them with foreign keys.**

  -------- ----------------------------------------- -------------------------------------------------------------
  **\#**   **Migration File Name**                   **Creates Table(s)**

  1        create_users_table                        users

  2        create_password_reset_tokens_table        password_reset_tokens

  3        create_sessions_table                     sessions

  4        create_roles_table (Spatie auto)          roles, permissions, model_has_roles, etc.

  5        create_activity_log_table (Spatie auto)   activity_log

  6        create_agencies_table                     agencies

  7        create_agents_table                       agents (FK → users, agencies)

  8        create_agent_reviews_table                agent_reviews (FK → agents, users)

  9        create_property_types_table               property_types

  10       create_property_statuses_table            property_statuses

  11       create_properties_table                   properties (FK → agents, property_types, property_statuses)

  12       create_property_locations_table           property_locations (FK → properties)

  13       create_property_images_table              property_images (FK → properties)

  14       create_property_documents_table           property_documents (FK → properties, users)

  15       create_features_table                     features

  16       create_property_features_table            property_features (FK → properties, features)

  17       create_property_floor_plans_table         property_floor_plans (FK → properties)

  18       create_rental_terms_table                 rental_terms (FK → properties)

  19       create_tenants_table                      tenants (FK → properties, users)

  20       create_rental_payment_schedule_table      rental_payment_schedule (FK → tenants)

  21       create_offers_table                       offers (FK → properties, users)

  22       create_inquiries_table                    inquiries (FK → properties, users, agents)

  23       create_appointments_table                 appointments (FK → properties, users, agents)

  24       create_favorites_table                    favorites (FK → users, properties)

  25       create_transactions_table                 transactions (FK → users, properties)

  26       create_invoices_table                     invoices (FK → users)

  27       create_blog_categories_table              blog_categories

  28       create_blog_posts_table                   blog_posts (FK → users, blog_categories)

  29       create_testimonials_table                 testimonials (FK → users)

  30       create_faqs_table                         faqs

  31       create_banners_table                      banners

  32       create_pages_table                        pages

  33       create_settings_table                     settings

  34       create_notifications_table                notifications

  35       create_email_logs_table                   email_logs
  -------- ----------------------------------------- -------------------------------------------------------------

> **SECTION 9 --- PRODUCTION DEPLOYMENT CHECKLIST**

**9.1 Server Requirements**

  ---------------------- -----------------------------------------------------------------------
  **Requirement**        **Minimum Specification**

  PHP Version            PHP 8.2 or higher (Laravel 11 requirement)

  Web Server             Nginx (recommended) or Apache

  Database               MySQL 8.0 or higher

  RAM                    Minimum 2GB (4GB recommended for production)

  Storage                Minimum 20GB SSD for property images

  PHP Extensions         BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML

  SSL Certificate        Required --- use Let\'s Encrypt (free)

  Cron Job               Required for scheduled tasks (backups, emails)

  Queue Worker           Required for background jobs (emails, notifications)
  ---------------------- -----------------------------------------------------------------------

**9.2 Pre-Deployment Checklist**

+-----------------------------------------------------------------------------+
| **Do ALL of these before going live:**                                      |
|                                                                             |
| □ Set APP_ENV=production in .env                                            |
|                                                                             |
| □ Set APP_DEBUG=false in .env                                               |
|                                                                             |
| □ Set APP_URL to your actual domain with https://                           |
|                                                                             |
| □ Configure real mail settings (SMTP or Mailgun)                            |
|                                                                             |
| □ Configure storage for large image uploads (S3 or local with enough space) |
|                                                                             |
| □ Run php artisan config:cache                                              |
|                                                                             |
| □ Run php artisan route:cache                                               |
|                                                                             |
| □ Run php artisan view:cache                                                |
|                                                                             |
| □ Run npm run build for production assets                                   |
|                                                                             |
| □ Set up cron job: \* \* \* \* \* php /path/to/artisan schedule:run         |
|                                                                             |
| □ Start queue worker: php artisan queue:work                                |
|                                                                             |
| □ Test all three login flows (admin, agent, customer)                       |
|                                                                             |
| □ Test email verification flow                                              |
|                                                                             |
| □ Test password reset flow                                                  |
|                                                                             |
| □ Test property listing creation and approval                               |
|                                                                             |
| □ Test file uploads (images and documents)                                  |
|                                                                             |
| □ Verify all routes require correct roles                                   |
|                                                                             |
| □ Run first backup and verify it works                                      |
|                                                                             |
| □ Test site over HTTPS only                                                 |
+-----------------------------------------------------------------------------+

+-----------------------------------+-----------------------------------+
| **TOTAL TABLES**                  | **TOTAL ROUTES**                  |
|                                   |                                   |
| **35+**                           | **60+**                           |
|                                   |                                   |
| MySQL Tables                      | Web Routes Across 3 Roles         |
+-----------------------------------+-----------------------------------+
