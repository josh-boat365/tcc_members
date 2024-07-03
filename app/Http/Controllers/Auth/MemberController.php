<?php



namespace App\Http\Controllers\Auth;

use Exception;
use Carbon\Carbon;
use App\Models\Member;

use App\Services\PdfWrapper;
use Illuminate\Http\Request;
// use App\Jobs\GenerateMembersPdf;
use App\Exports\MembersExport;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Http\Requests\CreateMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $members = Member::latest()->paginate(25);
        // $members = Member::orderBy('last_name','asc')->latest()->paginate(25);

        $total = Member::all()->count();
        $male = Member::where('gender', 'Male')->count();
        $female = Member::where('gender', 'Female')->count();
        $david = Member::where('group', 'David')->count();
        $joshua = Member::where('group', 'Joshua')->count();
        $abraham = Member::where('group', 'Abraham')->count();
        $moses = Member::where('group', 'Moses')->count();

        $data = [$total, $male, $female, $david, $joshua, $abraham, $moses];


        return view('dashboard', compact('members', 'data'));
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

            $memberCode = 'TCC' . $this->generateMemberCode();

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
                $imageManager = new ImageManager(new Driver());
                $imageFile = $request->file('image');
                $filename = $validated['first_name'] . '_' . $member->code . '.' . $imageFile->getClientOriginalExtension();
                $image = $imageManager->read($imageFile);
                $compressedImage = $image->resize(400, 400)->toJpeg(60); // Adjust the quality as needed

                // Save the compressed image to the public path
                $newImagePath = 'images/members/' . $filename;
                Storage::disk('public')->put($newImagePath, $compressedImage->__toString());


                // Delete the old image if it exists
                if ($member->image && File::exists(public_path($member->image))) {
                    File::delete(public_path($member->image));
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
            ])->save(public_path('pdfs/sample1.pdf'));

            return redirect()->back()->with('success', 'PDF generated successfully.');
        } catch (\Exception $e) {
           return redirect()->back()->with('error', 'Error generating PDF: ' . $e->getMessage());

        }
    }

    // public function exportPDF()
    // {
    //     $members = Member::all();
    //     $pdf = new PdfWrapper();

    //     // Define the temporary directory path
    //     $tempDir = sys_get_temp_dir() . '/puppeteer_temp';

    //     // Ensure the temporary directory exists
    //     if (!file_exists($tempDir)) {
    //         mkdir($tempDir, 0777, true);
    //     }

    //     // Set the TMPDIR environment variable
    //     putenv('TMPDIR=' . $tempDir);

    //     try {
    //         $pdf->loadView('pdf.members', [
    //             'members' => $members,
    //         ])->save(public_path('pdfs/sample1.pdf'));

    //         return redirect()->back()->with('success', 'PDF generated successfully.');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Error generating PDF: ' . $e->getMessage());
    //     }
    // }

    public function exportExcel()
    {
        return Excel::download(new MembersExport, 'tcc_members.xlsx');
    }



    public function downloadExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header values
        $headers = ['Image', 'Full Name', 'Member ID', 'Gender', 'Contact', 'Location', 'Department', 'Group', 'Year Joined'];
        foreach ($headers as $index => $header) {
            $sheet->setCellValueByColumnAndRow($index + 1, 1, strtoupper($header));
            $sheet->getStyleByColumnAndRow($index + 1, 1)->getFont()->setBold(true);
        }

        // Retrieve members data
        $members = Member::orderBy('first_name')->get();

        foreach ($members as $rowIndex => $member) {
            $row = $rowIndex + 2; // Data starts from the second row

            // Add image
            if ($member->image && Storage::disk('public')->exists($member->image)) {
                $drawing = new Drawing();
                $drawing->setName('Image');
                $drawing->setDescription('Image');
                $drawing->setPath(public_path('storage/' . $member->image));
                $drawing->setHeight(100); // Adjust height to fit the cell
                $drawing->setWidth(100); // Adjust width to fit the cell
                $drawing->setCoordinates('A' . $row); // 'A' column for image
                $drawing->setWorksheet($sheet);
            }

            // Add member details
            $sheet->setCellValue('B' . $row, $member->first_name . ' ' . $member->last_name);
            $sheet->setCellValue('C' . $row, $member->code);
            $sheet->setCellValue('D' . $row, $member->gender);
            $sheet->setCellValue('E' . $row, $member->contact_1 . ($member->contact_2 ? '/' . $member->contact_2 : ''));
            $sheet->setCellValue('F' . $row, $member->location);
            $sheet->setCellValue('G' . $row, $member->department);
            $sheet->setCellValue('H' . $row, $member->group);
            $sheet->setCellValue('I' . $row, $member->year_joined);

            // Adjust row height to fit the image
            $sheet->getRowDimension($row)->setRowHeight(100);
        }

        // Adjust column widths for better readability
        $sheet->getColumnDimension('A')->setWidth(15); // Adjust the width as needed
        for ($col = ord('B'); $col <= ord('I'); $col++) {
            $sheet->getColumnDimension(chr($col))->setAutoSize(true);
        }

        // Set header styles
        $sheet->getStyle('A1:I1')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('A1:I1')->getAlignment()->setHorizontal('center');

        // Write the file and download
        $writer = new Xlsx($spreadsheet);
        $date = Carbon::now()->toDateTimeString();
        $fileName = 'tcc-members-'.$date.'.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);

        return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
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
        return DB::transaction(function () {
            do {
                $uid = random_int(100000, 999999); // Using a 6-digit number to reduce collisions
            } while (Member::where('code', '=', $uid)->exists());

            return $uid;
        });
    }

    protected function extractYear($date)
    {
        // Use Carbon to parse the date and get the year part
        return \Carbon\Carbon::parse($date)->format('Y');
    }
}
