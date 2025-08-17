<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Form request for validating installation data
 * Handles validation for database settings, admin user, and application configuration
 */
class InstallRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Allow installation only if app is not already installed
        return !file_exists(storage_path('app/installed.lock'));
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            // Application Settings
            'app_name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9\s\-_]+$/'],
            'app_url' => ['required', 'url', 'max:255'],
            'app_timezone' => ['required', 'string', 'max:50'],
            
            // Database Settings
            'db_connection' => ['required', Rule::in(['sqlite', 'mysql', 'pgsql', 'supabase'])],
            'db_host' => ['required_unless:db_connection,sqlite,supabase', 'string', 'max:255'],
            'db_port' => ['required_unless:db_connection,sqlite,supabase', 'integer', 'min:1', 'max:65535'],
            'db_database' => ['required', 'string', 'max:255'],
            'db_username' => ['required_unless:db_connection,sqlite,supabase', 'string', 'max:255'],
            'db_password' => ['nullable', 'string', 'max:255'],
            
            // Supabase Settings
            'supabase_url' => ['required_if:db_connection,supabase', 'url', 'max:255'],
            'supabase_anon_key' => ['required_if:db_connection,supabase', 'string', 'max:500'],
            'supabase_service_key' => ['required_if:db_connection,supabase', 'string', 'max:500'],
            'supabase_db_password' => ['required_if:db_connection,supabase', 'string', 'max:255'],
            
            // Admin User Settings
            'admin_name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'admin_email' => ['required', 'email', 'max:255'],
            'admin_password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
            'admin_password_confirmation' => ['required', 'string'],
            
            // Email Settings (optional)
            'mail_mailer' => ['nullable', Rule::in(['smtp', 'sendmail', 'mailgun', 'ses', 'postmark', 'log'])],
            'mail_host' => ['nullable', 'string', 'max:255'],
            'mail_port' => ['nullable', 'integer', 'min:1', 'max:65535'],
            'mail_username' => ['nullable', 'string', 'max:255'],
            'mail_password' => ['nullable', 'string', 'max:255'],
            'mail_encryption' => ['nullable', Rule::in(['tls', 'ssl'])],
            'mail_from_address' => ['nullable', 'email', 'max:255'],
            'mail_from_name' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'app_name.required' => 'اسم التطبيق مطلوب.',
            'app_name.regex' => 'اسم التطبيق يجب أن يحتوي على أحرف وأرقام ومسافات فقط.',
            'app_url.required' => 'رابط التطبيق مطلوب.',
            'app_url.url' => 'رابط التطبيق يجب أن يكون رابط صحيح.',
            'app_timezone.required' => 'المنطقة الزمنية مطلوبة.',
            
            'db_connection.required' => 'نوع قاعدة البيانات مطلوب.',
            'db_connection.in' => 'نوع قاعدة البيانات غير مدعوم.',
            'db_host.required_unless' => 'عنوان خادم قاعدة البيانات مطلوب.',
            'db_port.required_unless' => 'منفذ قاعدة البيانات مطلوب.',
            'db_port.integer' => 'منفذ قاعدة البيانات يجب أن يكون رقم.',
            'db_database.required' => 'اسم قاعدة البيانات مطلوب.',
            'db_username.required_unless' => 'اسم مستخدم قاعدة البيانات مطلوب.',
            
            'admin_name.required' => 'اسم المدير مطلوب.',
            'admin_name.regex' => 'اسم المدير يجب أن يحتوي على أحرف ومسافات فقط.',
            'admin_email.required' => 'بريد المدير الإلكتروني مطلوب.',
            'admin_email.email' => 'بريد المدير الإلكتروني يجب أن يكون صحيح.',
            'admin_password.required' => 'كلمة مرور المدير مطلوبة.',
            'admin_password.min' => 'كلمة مرور المدير يجب أن تكون 8 أحرف على الأقل.',
            'admin_password.confirmed' => 'تأكيد كلمة المرور غير متطابق.',
            'admin_password_confirmation.required' => 'تأكيد كلمة المرور مطلوب.',
            
            'mail_mailer.in' => 'نوع البريد الإلكتروني غير مدعوم.',
            'mail_port.integer' => 'منفذ البريد الإلكتروني يجب أن يكون رقم.',
            'mail_encryption.in' => 'نوع تشفير البريد الإلكتروني غير مدعوم.',
            'mail_from_address.email' => 'عنوان البريد المرسل يجب أن يكون صحيح.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'app_name' => 'اسم التطبيق',
            'app_url' => 'رابط التطبيق',
            'app_timezone' => 'المنطقة الزمنية',
            'db_connection' => 'نوع قاعدة البيانات',
            'db_host' => 'عنوان خادم قاعدة البيانات',
            'db_port' => 'منفذ قاعدة البيانات',
            'db_database' => 'اسم قاعدة البيانات',
            'db_username' => 'اسم مستخدم قاعدة البيانات',
            'db_password' => 'كلمة مرور قاعدة البيانات',
            'admin_name' => 'اسم المدير',
            'admin_email' => 'بريد المدير الإلكتروني',
            'admin_password' => 'كلمة مرور المدير',
            'admin_password_confirmation' => 'تأكيد كلمة المرور',
            'mail_mailer' => 'نوع البريد الإلكتروني',
            'mail_host' => 'خادم البريد الإلكتروني',
            'mail_port' => 'منفذ البريد الإلكتروني',
            'mail_username' => 'اسم مستخدم البريد الإلكتروني',
            'mail_password' => 'كلمة مرور البريد الإلكتروني',
            'mail_encryption' => 'تشفير البريد الإلكتروني',
            'mail_from_address' => 'عنوان البريد المرسل',
            'mail_from_name' => 'اسم المرسل',
        ];
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        // Log validation errors for security monitoring
        \Log::warning('Installation validation failed', [
            'errors' => $validator->errors()->toArray(),
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        parent::failedValidation($validator);
    }
}