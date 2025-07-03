<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NeedyPerson;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class NeedyPersonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('needy_person.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'cnic_front' => 'required|image|mimes:jpg,jpeg,png',
            'cnic_back' => 'required|image|mimes:jpg,jpeg,png',
            'ngo' => 'required|string|max:255',
        ]);

        $cnicFrontPath = $request->file('cnic_front')->store('cnic_images', 'public');
        $cnicBackPath = $request->file('cnic_back')->store('cnic_images', 'public');

        NeedyPerson::create([
            'user_id' => Auth::id(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'cnic_front' => $cnicFrontPath,
            'cnic_back' => $cnicBackPath,
            'ngo' => $request->ngo,


        ]);

        Alert::success('Success', 'Needy person registered successfully!');
        return redirect()->back()->with('success', 'Needy person registered successfully!');
    }

    public function index(Request $request)
    {
        $pending_search = $request->input('pending_search');
        $approved_search = $request->input('approved_search');
        $pendingQuery = NeedyPerson::where('status', 'pending');
        $approvedQuery = NeedyPerson::where('status', 'approved');
        if ($pending_search) {
            $pendingQuery->where(function($q) use ($pending_search) {
                $q->where('first_name', 'like', "%$pending_search%")
                  ->orWhere('last_name', 'like', "%$pending_search%")
                  ->orWhere('phone', 'like', "%$pending_search%")
                  ->orWhere('address', 'like', "%$pending_search%")
                  ->orWhere('ngo', 'like', "%$pending_search%")
                  ->orWhere('id', $pending_search);
                  
            });
        }
        if ($approved_search) {
            $approvedQuery->where(function($q) use ($approved_search) {
                $q->where('first_name', 'like', "%$approved_search%")
                  ->orWhere('last_name', 'like', "%$approved_search%")
                  ->orWhere('phone', 'like', "%$approved_search%")
                  ->orWhere('address', 'like', "%$approved_search%")
                  ->orWhere('ngo', 'like', "%$approved_search%")
                  ->orWhere('id', $approved_search);
            });
        }
        $pendingPersons = $pendingQuery->paginate(10, ['*'], 'pending_page');
        $approvedPersons = $approvedQuery->paginate(10, ['*'], 'approved_page');

        // Get authenticated admin data
        $admin = \Illuminate\Support\Facades\Auth::guard('admin')->user();

        return view('admin.needy_persons', compact('pendingPersons', 'approvedPersons', 'admin'));
    }

    public function approve($id)
    {
        $person = NeedyPerson::findOrFail($id);
        $person->status = 'approved';
        $person->save();
        return redirect()->back()->with('success', 'Needy person approved successfully!');
    }

    public function reject($id)
    {
        $person = NeedyPerson::findOrFail($id);
        $person->status = 'rejected';
        $person->save();
        return redirect()->back()->with('success', 'Needy person rejected successfully!');
    }

    public function edit($id)
    {
        $needyPerson = NeedyPerson::findOrFail($id);
        return view('admin.edit_needy_person', compact('needyPerson'));
    }

    public function destroy($id)
    {
        $needyPerson = NeedyPerson::findOrFail($id);
        $needyPerson->delete();
        return redirect()->back()->with('success', 'Needy person deleted successfully!');
    }

    public function update(Request $request, $id)
    {
        $needyPerson = NeedyPerson::findOrFail($id);
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'ngo' => 'required|string|max:255',
            'status' => 'required|string',
            'cnic_front' => 'nullable|image|mimes:jpg,jpeg,png',
            'cnic_back' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);
        if ($request->hasFile('cnic_front')) {
            $data['cnic_front'] = $request->file('cnic_front')->store('cnic_images', 'public');
        } else {
            unset($data['cnic_front']);
        }
        if ($request->hasFile('cnic_back')) {
            $data['cnic_back'] = $request->file('cnic_back')->store('cnic_images', 'public');
        } else {
            unset($data['cnic_back']);
        }
        $needyPerson->update($data);

        Alert::success('Success', 'Needy person updated successfully!');
        return redirect()->route('admin.needypersons')->with('success', 'Needy person updated successfully!');
    }

    // AJAX: Return only the pending table rows for live search
    public function ajaxPendingTable(Request $request)
    {
        $search = $request->input('pending_search');
        $pendingQuery = NeedyPerson::where('status', 'pending');
        if ($search) {
            $pendingQuery->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%$search%")
                  ->orWhere('last_name', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%")
                  ->orWhere('address', 'like', "%$search%")
                  ->orWhere('ngo', 'like', "%$search%")
                  ->orWhere('id', $search);
            });
        }
        $pendingPersons = $pendingQuery->paginate(10, ['*'], 'pending_page');
        return view('admin.partials.pending_persons_table', compact('pendingPersons'))->render();
    }

    // AJAX: Return only the approved table rows for live search
    public function ajaxApprovedTable(Request $request)
    {
        $search = $request->input('approved_search');
        $approvedQuery = NeedyPerson::where('status', 'approved');
        if ($search) {
            $approvedQuery->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%$search%")
                  ->orWhere('last_name', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%")
                  ->orWhere('address', 'like', "%$search%")
                  ->orWhere('ngo', 'like', "%$search%")
                  ->orWhere('id', $search);
            });
        }
        $approvedPersons = $approvedQuery->paginate(10, ['*'], 'approved_page');
        return view('admin.partials.approved_persons_table', compact('approvedPersons'))->render();
    }
}
