<?php

namespace App\Http\Controllers;

use App\CentralLogics\Helpers;
use App\Models\Category;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('chapters')->orderByDesc('updated_at')->get();
        return view('admin.category.list', compact('categories'));
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
        return view('admin.category.import');
    }

    public function import(Request $request)
    {
        try {
            $request->validate(['file' => 'required|mimes:xlsx,xls']);

            $spreadsheet = IOFactory::load($request->file('file'));
            $categoriesSheet = $spreadsheet->getSheetByName('Categories') ?? $spreadsheet->getActiveSheet();

            $importCount = $this->importCategories($categoriesSheet);

            return back()->with('success', "Successfully imported {$importCount} categories.");

        } catch (\Exception $e) {
            return back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    private function importCategories($sheet)
    {
        $images = Helpers::extractImages($sheet, 'category-image');
        $importCount = 0;

        foreach ($sheet->getRowIterator(2) as $row) {
            $rowIndex = $row->getRowIndex();
            $name = trim((string) $sheet->getCell('A' . $rowIndex)->getValue());

            if (empty($name)) {
                continue;
            }

            // Get description - set to null if empty
            $descriptionCell = $sheet->getCell('B' . $rowIndex);
            $description = Helpers::parseRichContent($descriptionCell) ?: null;

            // Get image - set to null if empty or not found
            $image = $images['C' . $rowIndex] ?? null;

            // Get status - default to 1 if empty
            $statusCell = $sheet->getCell('D' . $rowIndex)->getValue();
            $status = ($statusCell === null) ? 1 : (intval($statusCell) === 1 ? 1 : 0);

            Category::updateOrCreate(
                ['name' => $name],
                [
                    'description' => $description,
                    'image' => $image,
                    'status' => $status,
                ]
            );

            $importCount++;
        }

        return $importCount;
    }
}
