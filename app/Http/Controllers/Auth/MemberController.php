<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\Member;
use App\Services\PdfWrapper;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
// use App\Jobs\GenerateMembersPdf;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\CreateMemberRequest;
use App\Http\Requests\UpdateMemberRequest;


class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $members = Member::latest()->paginate(25);

        return view('dashboard', compact('members'));
    }

    public function search(Request $request)
    {

        $search = $request->input('search-members');
        $members = Member::searchMembers($search)->latest()->paginate(25);

        return view('partials.member_table', compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateMemberRequest $request)
    {
        // dd($request->all());

        try {
            $validated = $request->validated();

            // dd($validated);

            $memberCode = 'tcc' . $this->generateMemberCode();

            if ($request->hasFile('image')) {

                $imageManger = new ImageManager(new Driver());
                // Get the uploaded image file
                $imageFile = $request->file('image');

                // Generate a unique filename
                $filename = $validated['first_name'] . '_' . $memberCode . '.' . $imageFile->getClientOriginalExtension();

                $image = $imageManger->read($imageFile);

                // Compress and resize the image
                $compressedImage = $image->resize(400, 400)->toJpeg(60); // Change 80 to adjust image quality (0-100)

                // Save the compressed image to the public disk in the storage folder
                Storage::disk('public')->put('images/members/' . $filename, $compressedImage->__toString());

                // Optionally, store the image path in the database
                $imagePath = 'images/members/' . $filename;
                // Your database logic to store $imagePath...
            } else {
                $imagePath = null; // If no image provided, set it to null
            }


            Member::create([
                'code' => $memberCode,
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'gender' => $validated['gender'],
                'contact_1' => $validated['contact_1'],
                'contact_2' => $validated['contact_2'],
                'location' => $validated['location'],
                'department' => $validated['department'],
                'group' => $validated['group'],
                'image' => $imagePath,
                'year_joined' => $this->extractYear($validated['year_joined']),
            ]);

            return redirect()->back()->with('success', 'Member Add Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An Error Occurred!' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request, $id)
    {
        try {
            $validated = $request->validated();

            // Retrieve the member from the database
            $member = Member::findOrFail($id);

            // Check if a new image has been uploaded
            if ($request->hasFile('image')) {
                $imageManger = new ImageManager(new Driver());
                $imageFile = $request->file('image');
                $filename = $validated['first_name'] . '_' . $member->code . '.' . $imageFile->getClientOriginalExtension();
                $image = $imageManger->read($imageFile);
                $compressedImage = $image->resize(400, 400)->toJpeg(80); // Adjust the quality as needed

                // Save the compressed image
                $newImagePath = 'images/members/' . $filename;
                Storage::disk('public')->put($newImagePath, $compressedImage->__toString());

                // Delete the old image if it exists
                if ($member->image && Storage::disk('public')->exists($member->image)) {
                    Storage::disk('public')->delete($member->image);
                }

                // Update the member with the new image path
                $member->update(['image' => $newImagePath]);
            }

            // Update other member details
            $member->update([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'gender' => $validated['gender'],
                'contact_1' => $validated['contact_1'],
                'contact_2' => $validated['contact_2'],
                'location' => $validated['location'],
                'department' => $validated['department'],
                'group' => $validated['group'],
                'year_joined' => $this->extractYear($validated['year_joined']),
            ]);

            return redirect()->back()->with('success', 'Member Updated Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An Error Occurred! ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    // public function exportPDF()
    // {
    //     $members = Member::all();

    //     // Generate PDF using a Blade view
    //     $pdf = PDF::loadView('pdf.members', compact('members'))->setPaper('a4', 'portrait');

    //     return $pdf->download();

    //     // Redirect back
    //     // return redirect()->back()->with('success', 'PDF generation in progress. You will be notified once it\'s ready.');
    // }

    public function exportPDF()
    {
        $members = Member::all();
        $pdf = new PdfWrapper();

        try {
            $pdf->loadView('pdf.members', [
                'members' => $members,
            ])->save(public_path('images/sample2.pdf'));

            return redirect()->back()->with('success', 'PDF generated successfully.');
        } catch (\Exception $e) {
           return redirect()->back()->with('error', 'Error generating PDF: ' . $e->getMessage());

        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function downloadPDF()
    {
        $filePath = 'members.pdf';

        if (Storage::exists($filePath)) {
            return response()->download(storage_path('app/' . $filePath))->deleteFileAfterSend(true);
        } else {
            return redirect()->back()->with('error', 'PDF not yet generated.');
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $member = Member::findOrFail($id);

            // Delete the image file from storage if it exists
            if ($member->image) {
                Storage::disk('public')->delete($member->image);
            }

            // Delete the member from the database
            $member->delete();

            return redirect()->back()->with('success', 'Member Deleted Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An Error Occurred! ' . $e->getMessage());
        }
    }


    public function generateMemberCode()
    {
        do {
            $uid = random_int(100, 999);
        } while (Member::where('code', '=', $uid)->first());

        return $uid;
    }

    protected function extractYear($date)
    {
        // Use Carbon to parse the date and get the year part
        return \Carbon\Carbon::parse($date)->format('Y');
    }
}
