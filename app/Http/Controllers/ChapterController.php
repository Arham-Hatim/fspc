<?php

namespace App\Http\Controllers;

use App\CentralLogics\Helpers;
use App\Models\Category;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chapters = Chapter::with('category:id,name')
            ->withCount('mcqs')
            ->orderByDesc('updated_at')
            ->get()
            ->groupBy(function ($chapter) {
                return $chapter->category?->name ?? 'N/A';
            })->flatten();
            
        return view('admin.chapter.list', compact('chapters'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function importForm()
    {
        return view('admin.chapter.import');
    }

    public function import(Request $request)
    {
        try {
            $request->validate(['file' => 'required|mimes:xlsx,xls']);

            $spreadsheet = IOFactory::load($request->file('file'));
            $chaptersSheet = $spreadsheet->getSheetByName('Chapters') ?? $spreadsheet->getActiveSheet();

            $importCount = $this->importChapters($chaptersSheet);

            return back()->with('success', "Successfully imported {$importCount} chapters.");

        } catch (\Exception $e) {
            return back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    private function importChapters($sheet)
    {
        $importCount = 0;

        foreach ($sheet->getRowIterator(2) as $row) {
            $rowIndex = $row->getRowIndex();

            $categoryName = trim((string) $sheet->getCell('A' . $rowIndex)->getValue());
            $title = trim((string) $sheet->getCell('B' . $rowIndex)->getValue());

            if (empty($categoryName) || empty($title)) {
                continue;
            }

            // Get description - set to null if empty
            $descriptionCell = $sheet->getCell('C' . $rowIndex)->getValue();
            $description = !empty(trim((string) $descriptionCell)) ? $descriptionCell : null;

            // Get summary - set to null if empty
            $summaryCell = $sheet->getCell('D' . $rowIndex);
            $summary = Helpers::parseRichContent($summaryCell) ?: null;

            // Get status - default to 1 if empty
            $statusCell = $sheet->getCell('E' . $rowIndex)->getValue();
            $status = ($statusCell === null) ? 1 : (intval($statusCell) === 1 ? 1 : 0);

            $category = Category::whereRaw('LOWER(TRIM(name)) = ?', [Str::lower(trim($categoryName))])->first();

            if ($category) {
                Chapter::updateOrCreate(
                    [
                        'category_id' => $category->id,
                        'title' => $title,
                    ],
                    [
                        'description' => $description,
                        'summary' => $summary,
                        'status' => $status,
                    ]
                );

                $importCount++;
            }

        }

        return $importCount;
    }

}
