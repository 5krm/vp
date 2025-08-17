# Laravel Cloud Setup Guide

## المشكلة الحالية
التطبيق يعمل محلياً بشكل صحيح لكن هناك مشكلة في الاتصال بقاعدة بيانات Laravel Cloud.

## الحل المؤقت
تم تكوين التطبيق للعمل مع قاعدة بيانات SQLite محلية حتى يتم حل مشكلة Laravel Cloud.

## خطوات حل مشكلة Laravel Cloud

### 1. الحصول على بيانات قاعدة البيانات الصحيحة
- قم بتسجيل الدخول إلى [Laravel Cloud Dashboard](https://cloud.laravel.com)
- اذهب إلى مشروعك
- انتقل إلى قسم Database
- احصل على بيانات الاتصال الصحيحة:
  - Host
  - Database Name
  - Username
  - Password

### 2. تحديث ملف .env.cloud
قم بتحديث الملف `.env.cloud` ببيانات قاعدة البيانات الصحيحة:

```env
DB_CONNECTION=mysql
DB_HOST=your-actual-laravel-cloud-db-host
DB_PORT=3306
DB_DATABASE=your-actual-database-name
DB_USERNAME=your-actual-username
DB_PASSWORD=your-actual-password
```

### 3. النشر على Laravel Cloud

#### الطريقة الأولى: استخدام Git
```bash
# إضافة التغييرات
git add .

# إنشاء commit
git commit -m "Fix database configuration for Laravel Cloud"

# رفع التغييرات
git push origin main
```

#### الطريقة الثانية: استخدام Laravel Cloud CLI
```bash
# نسخ إعدادات الإنتاج
cp .env.cloud .env

# تشغيل الـ migrations على Laravel Cloud
php artisan migrate --force

# تشغيل الـ seeders
php artisan db:seed --class=AdminSeeder
php artisan db:seed --class=RolePermissionSeeder
```

## بيانات تسجيل الدخول الافتراضية
- **البريد الإلكتروني:** akrmsalah79@gmail.com
- **كلمة المرور:** 12345678

## ملاحظات مهمة

1. **الأمان:** تأكد من تغيير كلمة مرور المدير الافتراضية بعد أول تسجيل دخول
2. **البيئة:** تأكد من تعيين `APP_ENV=production` و `APP_DEBUG=false` في بيئة الإنتاج
3. **المفاتيح:** لا تشارك بيانات قاعدة البيانات أو مفاتيح التطبيق مع أي شخص

## استكشاف الأخطاء

### خطأ الاتصال بقاعدة البيانات
- تحقق من صحة بيانات الاتصال
- تأكد من أن قاعدة البيانات متاحة ومفعلة في Laravel Cloud
- جرب الاتصال من terminal محلي للتأكد من الاتصال

### خطأ في تسجيل الدخول
- تأكد من تشغيل الـ seeders بشكل صحيح
- تحقق من وجود المستخدم في قاعدة البيانات
- تأكد من أن حالة المستخدم مفعلة (status = 1)

## الدعم
إذا استمرت المشكلة، تواصل مع فريق دعم Laravel Cloud أو راجع [الوثائق الرسمية](https://docs.laravel.com/cloud).