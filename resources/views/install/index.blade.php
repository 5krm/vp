<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>تثبيت التطبيق - VPN Management System</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            direction: rtl;
        }
        
        .install-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        
        .install-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .install-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .install-header h1 {
            margin: 0;
            font-weight: 700;
            font-size: 2rem;
        }
        
        .install-header p {
            margin: 0.5rem 0 0 0;
            opacity: 0.9;
        }
        
        .install-body {
            padding: 2rem;
        }
        
        .step-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }
        
        .step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .step.active {
            background: #667eea;
            color: white;
        }
        
        .step.completed {
            background: #28a745;
            color: white;
        }
        
        .form-section {
            margin-bottom: 2rem;
            padding: 1.5rem;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            background: #f8f9fa;
        }
        
        .form-section h4 {
            color: #495057;
            margin-bottom: 1rem;
            font-weight: 600;
        }
        
        .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .btn-install {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 1rem 2rem;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .btn-install:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
            color: white;
        }
        
        .btn-install:disabled {
            opacity: 0.6;
            transform: none;
        }
        
        .alert {
            border-radius: 10px;
            border: none;
        }
        
        .loading-spinner {
            display: none;
        }
        
        .db-test-result {
            margin-top: 1rem;
            padding: 0.75rem;
            border-radius: 8px;
            display: none;
        }
        
        .requirements-check {
            margin-bottom: 2rem;
        }
        
        .requirement-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px solid #e9ecef;
        }
        
        .requirement-item:last-child {
            border-bottom: none;
        }
        
        .status-icon {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.8rem;
        }
        
        .status-success {
            background: #28a745;
        }
        
        .status-error {
            background: #dc3545;
        }
    </style>
</head>
<body>
    <div class="install-container">
        <div class="install-card">
            <div class="install-header">
                <h1><i class="fas fa-cog"></i> تثبيت نظام إدارة VPN</h1>
                <p>مرحباً بك! دعنا نقوم بإعداد التطبيق خطوة بخطوة</p>
            </div>
            
            <div class="install-body">
                <!-- Step Indicator -->
                <div class="step-indicator">
                    <div class="step active" id="step-1">1</div>
                    <div class="step" id="step-2">2</div>
                    <div class="step" id="step-3">3</div>
                    <div class="step" id="step-4">4</div>
                </div>
                
                <!-- Alert Messages -->
                <div id="alert-container"></div>
                
                <!-- Installation Form -->
                <form id="install-form">
                    @csrf
                    
                    <!-- Application Settings -->
                    <div class="form-section">
                        <h4><i class="fas fa-globe"></i> إعدادات التطبيق</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="app_name" class="form-label">اسم التطبيق</label>
                                <input type="text" class="form-control" id="app_name" name="app_name" value="VPN Management System" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="app_url" class="form-label">رابط التطبيق</label>
                                <input type="url" class="form-control" id="app_url" name="app_url" value="{{ request()->getSchemeAndHttpHost() }}" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="timezone" class="form-label">المنطقة الزمنية</label>
                                <select class="form-control" id="timezone" name="timezone" required>
                                    <option value="Asia/Riyadh">الرياض (GMT+3)</option>
                                    <option value="Asia/Dubai">دبي (GMT+4)</option>
                                    <option value="Asia/Kuwait">الكويت (GMT+3)</option>
                                    <option value="Asia/Qatar">قطر (GMT+3)</option>
                                    <option value="Asia/Bahrain">البحرين (GMT+3)</option>
                                    <option value="Asia/Baghdad">بغداد (GMT+3)</option>
                                    <option value="Africa/Cairo">القاهرة (GMT+2)</option>
                                    <option value="Asia/Dhaka" selected>دكا (GMT+6)</option>
                                    <option value="UTC">UTC (GMT+0)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Database Settings -->
                    <div class="form-section">
                        <h4><i class="fas fa-database"></i> إعدادات قاعدة البيانات</h4>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="db_connection" class="form-label">نوع قاعدة البيانات</label>
                                <select class="form-control" id="db_connection" name="db_connection" required>
                                    <option value="sqlite">SQLite (سهل ومناسب للبداية)</option>
                                    <option value="mysql">MySQL</option>
                                    <option value="pgsql">PostgreSQL</option>
                                    <option value="supabase">Supabase (PostgreSQL في السحابة)</option>
                                </select>
                            </div>
                            
                            <div id="mysql-fields" style="display: none;">
                                <div class="col-md-6 mb-3">
                                    <label for="db_host" class="form-label">عنوان الخادم</label>
                                    <input type="text" class="form-control" id="db_host" name="db_host" value="127.0.0.1">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="db_port" class="form-label">المنفذ</label>
                                    <input type="number" class="form-control" id="db_port" name="db_port" value="3306">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="db_username" class="form-label">اسم المستخدم</label>
                                    <input type="text" class="form-control" id="db_username" name="db_username">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="db_password" class="form-label">كلمة المرور</label>
                                    <input type="password" class="form-control" id="db_password" name="db_password">
                                </div>
                            </div>
                            
                            <div id="supabase-fields" style="display: none;">
                                <div class="col-12 mb-3">
                                    <label for="supabase_url" class="form-label">Supabase URL</label>
                                    <input type="url" class="form-control" id="supabase_url" name="supabase_url" placeholder="https://your-project.supabase.co">
                                    <small class="form-text text-muted">يمكنك العثور على هذا في لوحة تحكم Supabase > Settings > API</small>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="supabase_anon_key" class="form-label">Supabase Anon Key</label>
                                    <input type="text" class="form-control" id="supabase_anon_key" name="supabase_anon_key" placeholder="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...">
                                    <small class="form-text text-muted">المفتاح العام للوصول إلى Supabase</small>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="supabase_service_key" class="form-label">Supabase Service Role Key</label>
                                    <input type="password" class="form-control" id="supabase_service_key" name="supabase_service_key" placeholder="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...">
                                    <small class="form-text text-muted">المفتاح الخاص للعمليات الإدارية (احتفظ به سرياً)</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="supabase_db_password" class="form-label">كلمة مرور قاعدة البيانات</label>
                                    <input type="password" class="form-control" id="supabase_db_password" name="supabase_db_password" placeholder="كلمة مرور قاعدة البيانات">
                                    <small class="form-text text-muted">كلمة المرور التي حددتها عند إنشاء المشروع</small>
                                </div>
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label for="db_database" class="form-label">اسم قاعدة البيانات</label>
                                <input type="text" class="form-control" id="db_database" name="db_database" value="vpn_management" required>
                                <small class="form-text text-muted">للـ SQLite: سيتم إنشاء ملف قاعدة البيانات تلقائياً | للـ Supabase: استخدم "postgres"</small>
                            </div>
                            
                            <div class="col-12">
                                <button type="button" class="btn btn-outline-primary" id="test-db-btn">
                                    <i class="fas fa-check"></i> اختبار الاتصال
                                </button>
                                <div class="db-test-result" id="db-test-result"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Admin User Settings -->
                    <div class="form-section">
                        <h4><i class="fas fa-user-shield"></i> حساب المدير</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="admin_name" class="form-label">اسم المدير</label>
                                <input type="text" class="form-control" id="admin_name" name="admin_name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="admin_email" class="form-label">البريد الإلكتروني</label>
                                <input type="email" class="form-control" id="admin_email" name="admin_email" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="admin_password" class="form-label">كلمة المرور</label>
                                <input type="password" class="form-control" id="admin_password" name="admin_password" required minlength="8">
                                <small class="form-text text-muted">يجب أن تكون 8 أحرف على الأقل</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="admin_password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                                <input type="password" class="form-control" id="admin_password_confirmation" name="admin_password_confirmation" required>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Install Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-install" id="install-btn">
                            <span class="btn-text">
                                <i class="fas fa-rocket"></i> بدء التثبيت
                            </span>
                            <span class="loading-spinner">
                                <i class="fas fa-spinner fa-spin"></i> جاري التثبيت...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Handle database connection type change
            $('#db_connection').change(function() {
                const connection = $(this).val();
                
                // Hide all database-specific fields first
                $('#mysql-fields, #supabase-fields').hide();
                $('#db_host, #db_port, #db_username, #db_password').attr('required', false);
                $('#supabase_url, #supabase_anon_key, #supabase_service_key, #supabase_db_password').attr('required', false);
                
                if (connection === 'mysql' || connection === 'pgsql') {
                    $('#mysql-fields').show();
                    $('#db_host, #db_port, #db_username').attr('required', true);
                    $('#db_database').val('vpn_management');
                    if (connection === 'pgsql') {
                        $('#db_port').val('5432');
                    } else {
                        $('#db_port').val('3306');
                    }
                } else if (connection === 'supabase') {
                    $('#supabase-fields').show();
                    $('#supabase_url, #supabase_anon_key, #supabase_service_key, #supabase_db_password').attr('required', true);
                    $('#db_database').val('postgres');
                } else {
                    $('#db_database').val('database/database.sqlite');
                }
            });
            
            // Test database connection
            $('#test-db-btn').click(function() {
                const btn = $(this);
                const result = $('#db-test-result');
                
                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> جاري الاختبار...');
                
                // Simulate database test (you can implement actual AJAX call)
                setTimeout(function() {
                    result.removeClass('alert-danger alert-success')
                          .addClass('alert alert-success')
                          .html('<i class="fas fa-check"></i> تم الاتصال بنجاح!')
                          .show();
                    
                    btn.prop('disabled', false).html('<i class="fas fa-check"></i> اختبار الاتصال');
                    updateStep(2);
                }, 2000);
            });
            
            // Handle form submission
            $('#install-form').submit(function(e) {
                e.preventDefault();
                
                const btn = $('#install-btn');
                const btnText = btn.find('.btn-text');
                const spinner = btn.find('.loading-spinner');
                
                // Show loading state
                btn.prop('disabled', true);
                btnText.hide();
                spinner.show();
                updateStep(3);
                
                // Submit form data
                $.ajax({
                    url: '{{ route("install.process") }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            updateStep(4);
                            showAlert('success', response.message);
                            
                            setTimeout(function() {
                                window.location.href = response.redirect;
                            }, 3000);
                        } else {
                            showAlert('danger', response.message);
                            resetButton();
                        }
                    },
                    error: function(xhr) {
                        const response = xhr.responseJSON;
                        const message = response && response.message ? response.message : 'حدث خطأ غير متوقع';
                        showAlert('danger', message);
                        resetButton();
                    }
                });
            });
            
            function updateStep(step) {
                $('.step').removeClass('active completed');
                for (let i = 1; i < step; i++) {
                    $(`#step-${i}`).addClass('completed');
                }
                $(`#step-${step}`).addClass('active');
            }
            
            function showAlert(type, message) {
                const alertHtml = `
                    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `;
                $('#alert-container').html(alertHtml);
            }
            
            function resetButton() {
                const btn = $('#install-btn');
                const btnText = btn.find('.btn-text');
                const spinner = btn.find('.loading-spinner');
                
                btn.prop('disabled', false);
                btnText.show();
                spinner.hide();
            }
            
            // Initialize first step
            updateStep(1);
        });
    </script>
</body>
</html>