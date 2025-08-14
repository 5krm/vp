<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DataTables;

class PageController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::guard('admin')->user();
    }

    public function index(Request $request) {
        if (is_null($this->user) || !$this->user->can('page.view')) {
            abort(403, 'Access Denied: You do not have permission to view pages.');
        }

        $headerTitle = 'Page List';

        if ($request->ajax()) {
            $query = Page::query();

            return DataTables::of($query)
                        ->editColumn('status', function($page) {
                            return $page->status === 0 
                                ? '<span class="badge badge-success">Active</span>' 
                                : '<span class="badge badge-secondary">Inactive</span>';
                        })
                        ->addColumn('actions', function($page) {
                            return view('backend.admin.pages.partials.actions', compact('page'))->render();
                        })
                        ->rawColumns(['status', 'actions'])
                        ->make(true);
        }

        return view('backend.admin.pages.index', compact('headerTitle'));
    }

    public function add() {
        if (is_null($this->user) || !$this->user->can('page.create')) {
            return back()->with('error', 'Access Denied: You do not have permission to create new page.');
        }

        $data['headerTitle'] = 'Add New Page';

        return view('backend.admin.pages.add', $data);
    }

    public function insert(Request $request) {
        if (is_null($this->user) || !$this->user->can('page.create')) {
            abort(403, 'Access Denied: You do not have permission to create new page.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'page_content' => 'required',
        ]);

        $page = new Page;
        $page->title = $request->title;
        $page->slug = Str::slug($request->title);
        $page->page_content = $request->page_content;
        $page->save();

        return redirect('admin/pages')->with("success", "Page successfully added");
    }

    public function edit($id) {
        if (is_null($this->user) || !$this->user->can('page.edit')) {
            return back()->with('error', 'Access Denied: You do not have permission to edit page.');
        }

        $data['page'] = Page::find($id);

        if(!empty($data['page'])) {
            $data['headerTitle'] = 'Edit Page';

            return view('backend.admin.pages.edit', $data);
        }else {
            abort(404);
        }
    }

    public function update(Request $request) {
        if (is_null($this->user) || !$this->user->can('page.edit')) {
            return back()->with('error', 'Access Denied: You do not have permission to edit page.');
        }

        $page = Page::find($request->page_id);

        $request->validate([
            'title' => 'required|string|max:255',
            'page_content' => 'required',
        ]);

        $page->title = $request->title;
        $page->slug = Str::slug($request->title);
        $page->page_content = $request->page_content;
        $page->status = $request->status;
        $page->save();

        return redirect('admin/pages')->with("success", "Page successfully updated");
    }

    public function delete($id)
    {
        if (is_null($this->user) || !$this->user->can('page.delete')) {
            return back()->with('error', 'Access Denied: You do not have permission to delete page.');
        }

        $page = Page::find($id);

        if (empty($page)) {
            abort(404);  
        }

        $page->delete();

        return redirect()->back()->with(['success' => 'Page successfully deleted']);
    }
}
