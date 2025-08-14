<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EmailConfiguration;
use App\Models\EmailTemplate;
use App\Models\GlobalEmailTemplate;
use DataTables;

class EmailSettingController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::guard('admin')->user();
    }

    public function editEmailConfiguration() {
        $data['headerTitle'] = 'Email Configuration';
        $data['emailConfiguration'] = EmailConfiguration::first();

        return view('backend.admin.email_templates.email_configuration', $data);
    }

    public function updateEmailConfiguration(Request $request) {
        if (is_null($this->user) || !$this->user->can('email-configuration.edit')) {
            return back()->with('error', 'Access Denied: You do not have permission to edit email configuration.');
        }

        $emailConfiguration = EmailConfiguration::first();
        if (!$emailConfiguration) {
            $emailConfiguration = new EmailConfiguration();
        }

        $request->validate([
            'email_send_method' => 'required|string',
            'mail_host' => 'required|string',
            'mail_port' => 'required|string',
            'mail_username' => 'required|string',
            'mail_password' => 'required|string',
            'mail_from_address' => 'required|string',
            'mail_from_name' => 'required|string',
        ]);

        $emailConfiguration->email_send_method = $request->email_send_method;
        $emailConfiguration->mail_host = $request->mail_host;
        $emailConfiguration->mail_port = $request->mail_port;
        $emailConfiguration->mail_encryption_method = $request->mail_encryption_method;
        $emailConfiguration->mail_username = $request->mail_username;
        $emailConfiguration->mail_password = $request->mail_password;
        $emailConfiguration->mail_from_address = $request->mail_from_address;
        $emailConfiguration->mail_from_name = $request->mail_from_name;
        $emailConfiguration->save();

        return redirect()->back()->with("success", "Email configuration successfully updated");
    }

    public function index(Request $request) {
        $headerTitle = 'Email Template List';

        if ($request->ajax()) {
            $query = EmailTemplate::query();

            return DataTables::of($query)
                        ->addColumn('actions', function($emailTemplate) {
                            return view('backend.admin.email_templates.partials.actions', compact('emailTemplate'))->render();
                        })
                        ->rawColumns(['actions'])
                        ->make(true);
        }

        return view('backend.admin.email_templates.index', compact('headerTitle'));
    }

    public function edit($id) {
        if (is_null($this->user) || !$this->user->can('email-templates.edit')) {
            return back()->with('error', 'Access Denied: You do not have permission to edit email template.');
        }

        $data['emailTemplate'] = EmailTemplate::find($id);

        if(!empty($data['emailTemplate'])) {
            $data['headerTitle'] = 'Edit Email Template';

            return view('backend.admin.email_templates.edit', $data);
        }else {
            abort(404);
        }
    }

    public function update(Request $request) {
        if (is_null($this->user) || !$this->user->can('email-templates.edit')) {
            return back()->with('error', 'Access Denied: You do not have permission to edit email template.');
        }

        $emailTemplate = EmailTemplate::find($request->email_template_id);

        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'subject' => 'required',
            'content' => 'required',
        ]);

        $emailTemplate->name = $request->name;
        $emailTemplate->slug = $request->slug;
        $emailTemplate->subject = $request->subject;
        $emailTemplate->content = $request->content;
        $emailTemplate->save();

        return redirect('admin/email/templates')->with("success", "Email Template successfully updated");
    }

    public function editEmailGlobalTemplate() {
        $data['headerTitle'] = 'Edit Email Global Template';
        $data['emailGlobalTemplate'] = GlobalEmailTemplate::first();

        return view('backend.admin.email_templates.email_global_template', $data);
    }

    public function updateEmailGlobalTemplate(Request $request) {
        if (is_null($this->user) || !$this->user->can('email-global-templates.edit')) {
            return back()->with('error', 'Access Denied: You do not have permission to edit email global template.');
        }

        $emailGlobalTemplate = GlobalEmailTemplate::first();
        if (!$emailGlobalTemplate) {
            $emailGlobalTemplate = new GlobalEmailTemplate();
        }

        $request->validate([
            'email_header' => $request->has('email_header') ? 'required|image|mimes:jpeg,png,jpg,gif,svg' : 'nullable',
            'email_footer' => 'required|string',
        ]);
        
        $image = $request->file('email_header');
        if(!empty($image)) {
            if ($emailGlobalTemplate->email_header && file_exists(public_path($emailGlobalTemplate->email_header))) {
                unlink(public_path($emailGlobalTemplate->email_header));
            }
            $imageName = $image->getClientOriginalName();
            $timestamp = now()->timestamp; 
            $directory = 'assets/uploads/email_templates/';
            $imageUrl = $directory . $timestamp . '_' . $imageName; // Add timestamp to the filename
            $image->move(public_path($directory), $timestamp . '_' . $imageName);
            $emailGlobalTemplate->email_header = $imageUrl;
        }

        $emailGlobalTemplate->email_footer = $request->email_footer;
        $emailGlobalTemplate->save();

        return redirect()->back()->with("success", "Email global template successfully updated");
    }
}
