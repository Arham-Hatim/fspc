<?php

namespace App\Http\Controllers;

use App\CentralLogics\Helpers;
use App\Models\Chapter;
use App\Models\Mcq;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;

class McqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mcqs = Mcq::orderByDesc('updated_at')->get();
        return view('admin.mcq.list', compact('mcqs'));
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
        return view('admin.mcq.import');
    }

    public function import(Request $request)
    {
        try {
            $request->validate(['file' => 'required|mimes:xlsx,xls']);

            $spreadsheet = IOFactory::load($request->file('file'));
            $chaptersSheet = $spreadsheet->getSheetByName('Mcqs') ?? $spreadsheet->getActiveSheet();

            $importCount = $this->importMcqs($chaptersSheet);

            return back()->with('success', "Successfully imported {$importCount} MCQS.");

        } catch (\Exception $e) {
            return back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    private function importMcqs($sheet)
    {
        $images = Helpers::extractImages($sheet, 'mcq-image');
        $importCount = 0;

        foreach ($sheet->getRowIterator(2) as $row) {
            $rowIndex = $row->getRowIndex();

            $chapterName = trim((string) $sheet->getCell('A' . $rowIndex)->getValue());
            $question = trim((string) $sheet->getCell('B' . $rowIndex)->getValue());
            $derivedQuestion = trim((string) $sheet->getCell('C' . $rowIndex)->getValue());

            if (empty($chapterName) || (empty($question) && empty($derivedQuestion))) {
                continue;
            }

            // Get coorect option reasoning - set to null if empty
            $questionCell = $sheet->getCell('B' . $rowIndex);
            $questionText = Helpers::parseRichContent($questionCell) ?: null;

            // Get coorect option reasoning - set to null if empty
            $correctOptionReasoningCell = $sheet->getCell('D' . $rowIndex)->getValue();
            $correctOptionReasoning = !empty(trim((string) $correctOptionReasoningCell)) ? $correctOptionReasoningCell : null;

            // Get summary - set to null if empty
            $referenceTextCell = $sheet->getCell('E' . $rowIndex);
            $reference = Helpers::parseRichContent($referenceTextCell) ?: null;

            // Get status - default to 1 if empty
            $levelCell = $sheet->getCell('F' . $rowIndex)->getValue();
            $levelCell = $levelCell ? Str::lower(trim((string) $levelCell)) : null;
            $allowedLevels = ['easy', 'medium', 'hard'];
            $level = Helpers::getClosestLevel($levelCell, $allowedLevels) ?? 'easy';

            // Get image - set to null if empty or not found
            $image = $images['G' . $rowIndex] ?? null;

            // Get video - set to null if empty or not found
            $videoCell = $sheet->getCell('H' . $rowIndex)->getValue();
            $video = Helpers::extractYouTubeId($videoCell);

            $chapter = Chapter::whereRaw('LOWER(TRIM(title)) = ?', [Str::lower(trim($chapterName))])->first();

            if ($chapter) {
                // First try to find by question_text
                $mcq = Mcq::where('chapter_id', $chapter->id)
                    ->where('question_text', $questionText)
                    ->first();

                // If not found, fallback to derived_question
                if (!$mcq && $derivedQuestion) {
                    $mcq = Mcq::where('chapter_id', $chapter->id)
                        ->where('derived_question', $derivedQuestion)
                        ->first();
                }

                // If still not found, create a new instance
                if (!$mcq) {
                    $mcq = new Mcq([
                        'chapter_id' => $chapter->id,
                        'question_text' => $questionText,
                        'derived_question' => $derivedQuestion,
                    ]);
                }

                // Fill/Update common fields
                $mcq->fill([
                    'question_image' => $image,
                    'video_url' => $video,
                    'correct_option_reasoning' => $correctOptionReasoning,
                    'reference_text' => $reference,
                    'level' => $level,
                ]);

                $mcq->save();

                $importCount++;
            }


        }

        return $importCount;
    }
}
