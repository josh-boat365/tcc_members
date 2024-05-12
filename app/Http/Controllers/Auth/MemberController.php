<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMemberRequest;
use App\Models\Member;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\Image;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::latest()->paginate(5);

        return view('dashboard', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateMemberRequest $request)
    {
        // dd($request->all());

        try{
            $validated = $request->validated();

            // dd($validated);

            $memberCode = 'tcc' . $this->generateMemberCode();

            if ($request->hasFile('image')) {
                // Get the uploaded image file
                $image = $request->file('image');

                // Generate a unique filename
                $filename = $validated['first_name'] . '_' . $memberCode . '.' . $image->getClientOriginalExtension();

                // Compress and resize the image
                $compressedImage = Image::make($image)
                ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                    ->encode('jpg', 80); // Change 80 to adjust image quality (0-100)

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
                'contact_1' => $validated['contact_1'],
                'contact_2' => $validated['contact_2'],
                'location' => $validated['location'],
                'department' => $validated['department'],
                'image' => $imagePath,
            ]);

            return redirect()->back()->with('status', 'Member Saved');
        }catch(Exception $e){
            return redirect()->back()->with('status', 'An Error Occurred!'.$e->getMessage());
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        //
    }

    public function generateMemberCode()
    {
        do {
            $uid = random_int(100, 999);
        } while (Member::where('code', '=', $uid)->first());

        return $uid;
    }
}
