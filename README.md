# 📦 StockSync — Smart Inventory Management System

## **1. Project Overview**

Ang **StockSync** ay isang modernong Inventory Management System na idinisenyo para sa mabilis, secure, at scalable na pagma-manage ng stocks. Gumagamit ito ng **Strict UUID Architecture** para sa mataas na security at **Role-Based Access Control** para sa separation ng duties ng Admin at Staff.

Ang system ay nagtatampok ng **Real-time Analytics**, **Barcode Generation**, **PDF Reporting**, at **Audit Trails** para sa accountability.

## **2. Technical Stack**

Ang system ay binuo gamit ang mga sumusunod na teknolohiya base sa requirements:

-   **Framework:** Laravel 12 (PHP 8.2)
-   **Database:** MySQL (XAMPP)
-   **Frontend:** Bootstrap 5 (Sass/SCSS) + Vite
-   **Scripting:** JavaScript (ES6), jQuery
-   **Charts:** Chart.js (Data Visualization)
-   **PDF & Barcodes:** `barryvdh/laravel-dompdf` & `picqer/php-barcode-generator`
-   **Authentication:** Laravel Breeze (Customized)
-   **Security:** Google reCAPTCHA v2, Email Verification

## **3. System Architecture**

### **A. Database Design (Strict UUID)**

Lahat ng Primary Keys at Foreign Keys sa database ay gumagamit ng **UUID (Universally Unique Identifier)** sa halip na auto-increment integers.

-   **Tables:** `users`, `products`, `categories`, `restock_requests`, `activity_logs`.
-   **Security Benefit:** Hindi mahuhulaan ang ID ng records (e.g., `/products/999` vs `/products/123e4567-e89b...`).

### **B. Role-Based Access Control (RBAC)** [cite: 26-28]

May dalawang user roles na protektado ng Middleware:

1.  **Admin:** Full Access (CRUD Products/Categories, Manage Users, Reports, Analytics).
2.  **Staff:** Restricted Access (View Inventory, Stock In/Out, Request Restock, Print Labels).

## **4. Features & Functionalities**

### **🔐 Authentication & Security**

-   **Modern Split-Screen UI:** Pastel Green Theme na may animated typing text at dynamic illustrations.
-   **Security Layers:**
    -   **reCAPTCHA v2:** Sa Login, Register, at Forgot Password forms.
    -   **Email Verification:** Required bago maka-access sa dashboard.
    -   **Toast Notifications:** Real-time alerts para sa success at errors (walang static flash messages).
    -   **Password Visibility:** Toggle Eye Icon para sa UX.

### **📊 Admin Dashboard (Analytics)**

-   **Interactive Charts:**
    -   **Bar Chart:** Inventory distribution per category (Drill-down capability).
    -   **Doughnut Chart:** Real-time Stock Health (Healthy vs. Low Stock).
-   **Live Stats Cards:** Total Products, Categories, Staff, at Low Stock Alerts.
-   **Design:** Cards with "Lift Effect" shadow animation.

### **📦 Product Management**

-   **Full CRUD:** Create, Read, Update, Delete products.
-   **Image Handling:** Upload at storage sa `public/storage/products`.
-   **DataTables Integration:** Searchable, Sortable, at Paginated na listahan.
-   **Low Stock Indicators:** Automatic na nagkukulay pula ang stock count kapag \<= 10.

### **🏷️ Category Management**

-   Create, Edit, Delete categories gamit ang **Bootstrap Modals** (walang page reload).

### **🔄 Stock Control (Staff Features)**

-   **Quick Adjust:** `+` (Stock In) at `-` (Stock Out) buttons na may logs ng rason (e.g., "Sold", "Damaged").
-   **Restock Requests:** Ang staff ay pwedeng mag-request ng stocks sa Admin.
    -   _Flow:_ Staff Request -\> Admin Review -\> Approve (Auto-add stock) / Reject.
-   **Barcode Printing:** Generate ng PDF stickers na may Barcode, Name, at Price. (Layout: 3 Columns, Legal Size).

### **👥 User Management**

-   Ang Admin ay pwedeng mag-**Add**, **Edit**, at **Delete** ng Staff accounts.
-   Auto-generated avatar based sa initials kung walang inupload na picture.

### **📝 Audit Trail & Reports**

-   **Activity Logs:** Lahat ng galaw (Sino nag-add, nag-bura, nag-edit) ay naka-record sa database at makikita sa Profile ng user.
-   **PDF Export:** Downloadable inventory report na may total asset value computation.

## **5. UI/UX Design System**

-   **Color Palette (Pastel Green):**
    -   Primary: `#B0DB9C` (Buttons, Icons)
    -   Background: `#ECFAE5` (Left Panels, Highlights)
    -   Accent: `#DDF6D2`
-   **Layout:**
    -   **Fixed Header & Footer:** Naka-pako sa taas at baba ng screen habang nagso-scroll ang content.
    -   **Responsive:** Mobile-friendly gamit ang Bootstrap 5 grid.
    -   **Glassmorphism:** Sa landing page (`/`) para sa futuristic look.

## **6. Installation Guide (How to Run)**

Kung ililipat sa ibang computer o ide-deploy, sundin ito:

**Step 1: Prerequisites**

-   Install XAMPP (Start Apache & MySQL).
-   Install Composer & Node.js.

**Step 2: Clone & Install Dependencies**

```bash
git clone [repository_url]
cd inventory_system
composer install
npm install
```

**Step 3: Environment Setup**

1.  Kopyahin ang `.env.example` at gawing `.env`.
2.  I-set ang database credentials (`DB_DATABASE=inventory_system`).
3.  I-set ang Mail credentials (Gmail SMTP) para sa verification.
4.  I-set ang `RECAPTCHA_SITE_KEY` at `SECRET_KEY`.

**Step 4: Key Generation & Migration**

```bash
php artisan key:generate
php artisan migrate:fresh --seed
```

_(Ang `--seed` ay gagawa ng default Admin: `admin@example.com` / `password`)_.

**Step 5: Link Storage**
Mahalaga ito para lumabas ang images.

```bash
php artisan storage:link

**Step 6: Run Application**
Kailangan bukas ang dalawang terminal:
  * Terminal 1 (Backend): `php artisan serve`
  * Terminal 2 (Frontend): `npm run dev`
```
