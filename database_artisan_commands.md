# أوامر PHP Artisan المتعلقة بقواعد البيانات

هذا الملف يحتوي على جميع أوامر Laravel Artisan المتعلقة بإدارة قواعد البيانات مع شرح مفصل لكل أمر.

## 1. أوامر الـ Migrations (الهجرة)

### إنشاء Migration جديد
```bash
php artisan make:migration create_table_name
```
**الشرح:** ينشئ ملف migration جديد لإنشاء جدول جديد في قاعدة البيانات.

```bash
php artisan make:migration add_column_to_table --table=table_name
```
**الشرح:** ينشئ migration لإضافة عمود جديد إلى جدول موجود.

```bash
php artisan make:migration drop_table_name --create=table_name
```
**الشرح:** ينشئ migration لحذف جدول من قاعدة البيانات.

### تشغيل الـ Migrations
```bash
php artisan migrate
```
**الشرح:** يشغل جميع migrations الجديدة التي لم يتم تشغيلها بعد.

```bash
php artisan migrate --force
```
**الشرح:** يشغل migrations في بيئة الإنتاج بدون تأكيد.

```bash
php artisan migrate --step
```
**الشرح:** يشغل migration واحد فقط في كل مرة.

```bash
php artisan migrate --pretend
```
**الشرح:** يعرض SQL queries التي ستنفذ بدون تنفيذها فعلياً.

### التراجع عن الـ Migrations
```bash
php artisan migrate:rollback
```
**الشرح:** يتراجع عن آخر batch من migrations.

```bash
php artisan migrate:rollback --step=5
```
**الشرح:** يتراجع عن عدد محدد من migrations.

```bash
php artisan migrate:reset
```
**الشرح:** يتراجع عن جميع migrations.

### إعادة تشغيل الـ Migrations
```bash
php artisan migrate:refresh
```
**الشرح:** يتراجع عن جميع migrations ثم يشغلها مرة أخرى.

```bash
php artisan migrate:refresh --seed
```
**الShرح:** يعيد تشغيل migrations ويشغل seeders أيضاً.

```bash
php artisan migrate:fresh
```
**الشرح:** يحذف جميع الجداول ويعيد تشغيل migrations من البداية.

```bash
php artisan migrate:fresh --seed
```
**الشرح:** يحذف جميع الجداول ويعيد تشغيل migrations مع seeders.

### معلومات الـ Migrations
```bash
php artisan migrate:status
```
**الشرح:** يعرض حالة جميع migrations (تم تشغيلها أم لا).

```bash
php artisan migrate:install
```
**الشرح:** ينشئ جدول migrations في قاعدة البيانات.

## 2. أوامر الـ Seeders (البذور)

### إنشاء Seeder جديد
```bash
php artisan make:seeder UserSeeder
```
**الشرح:** ينشئ ملف seeder جديد لملء الجداول ببيانات تجريبية.

### تشغيل الـ Seeders
```bash
php artisan db:seed
```
**الشرح:** يشغل جميع seeders المحددة في DatabaseSeeder.

```bash
php artisan db:seed --class=UserSeeder
```
**الشرح:** يشغل seeder محدد فقط.

```bash
php artisan db:seed --force
```
**الشرح:** يشغل seeders في بيئة الإنتاج بدون تأكيد.

## 3. أوامر الـ Models (النماذج)

### إنشاء Model جديد
```bash
php artisan make:model User
```
**الشرح:** ينشئ model جديد.

```bash
php artisan make:model User -m
```
**الشرح:** ينشئ model مع migration.

```bash
php artisan make:model User -f
```
**الشرح:** ينشئ model مع factory.

```bash
php artisan make:model User -s
```
**الشرح:** ينشئ model مع seeder.

```bash
php artisan make:model User -mfs
```
**الشرح:** ينشئ model مع migration وfactory وseeder.

## 4. أوامر الـ Factories (المصانع)

### إنشاء Factory جديد
```bash
php artisan make:factory UserFactory
```
**الشرح:** ينشئ factory لإنشاء بيانات تجريبية للنماذج.

```bash
php artisan make:factory UserFactory --model=User
```
**الشرح:** ينشئ factory مرتبط بنموذج محدد.

## 5. أوامر قاعدة البيانات العامة

### الاتصال بقاعدة البيانات
```bash
php artisan db
```
**الشرح:** يفتح اتصال مباشر مع قاعدة البيانات.

### مراقبة قاعدة البيانات
```bash
php artisan db:monitor
```
**الشرح:** يراقب اتصالات قاعدة البيانات.

### إنشاء جداول الجلسات
```bash
php artisan session:table
```
**الشرح:** ينشئ migration لجدول sessions.

### إنشاء جداول الطوابير
```bash
php artisan queue:table
```
**الشرح:** ينشئ migration لجداول queue.

```bash
php artisan queue:failed-table
```
**الشرح:** ينشئ migration لجدول failed jobs.

### إنشاء جداول التخزين المؤقت
```bash
php artisan cache:table
```
**الشرح:** ينشئ migration لجدول cache.

## 6. أوامر Laravel Sanctum

### إنشاء جداول Sanctum
```bash
php artisan sanctum:install
```
**الشرح:** ينشر migrations الخاصة بـ Sanctum للمصادقة.

## 7. أوامر Spatie Permission (من المشروع الحالي)

### نشر جداول الصلاحيات
```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```
**الشرح:** ينشر migrations الخاصة بحزمة Spatie Permission.

## 8. أوامر مفيدة إضافية

### تنظيف التخزين المؤقت
```bash
php artisan config:clear
```
**الشرح:** ينظف تخزين إعدادات التطبيق المؤقت.

```bash
php artisan cache:clear
```
**الشرح:** ينظف جميع أنواع التخزين المؤقت.

```bash
php artisan route:clear
```
**الشرح:** ينظف تخزين المسارات المؤقت.

```bash
php artisan view:clear
```
**الشرح:** ينظف تخزين العروض المؤقت.

### إنشاء رابط تخزين
```bash
php artisan storage:link
```
**الشرح:** ينشئ رابط رمزي من public/storage إلى storage/app/public.

## أمثلة من المشروع الحالي

بناءً على المشروع الحالي، إليك الأوامر المستخدمة:

```bash
# تشغيل migrations
php artisan migrate --force

# تشغيل seeders
php artisan db:seed --class=AdminSeeder
php artisan db:seed --class=RolePermissionSeeder

# أو تشغيل جميع seeders
php artisan db:seed
```

## ملاحظات مهمة

1. **البيئة:** استخدم `--force` في بيئة الإنتاج لتجنب رسائل التأكيد
2. **النسخ الاحتياطية:** قم بعمل نسخة احتياطية قبل تشغيل `migrate:fresh` أو `migrate:reset`
3. **الترتيب:** تأكد من ترتيب migrations بشكل صحيح لتجنب مشاكل المفاتيح الخارجية
4. **البيانات:** استخدم seeders لملء الجداول ببيانات أولية مطلوبة
5. **الاختبار:** اختبر migrations في بيئة التطوير قبل تطبيقها في الإنتاج

## الملفات ذات الصلة في المشروع

- `database/migrations/` - ملفات الـ migrations
- `database/seeders/` - ملفات الـ seeders
- `app/Models/` - ملفات الـ models
- `database/factories/` - ملفات الـ factories
- `config/database.php` - إعدادات قاعدة البيانات
- `.env` - متغيرات البيئة لقاعدة البيانات