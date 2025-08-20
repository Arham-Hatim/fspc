<?php
namespace App\CentralLogics;

use Illuminate\Support\Carbon;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class Helpers
{
    public static function upload(string $dir, string $format, $image = null, $oldImage = null)
    {
        if ($image !== null && $image->isValid()) {

            if (!empty($oldImage)) {
                $fileName = basename($oldImage);
                $oldPath = public_path('storage/' . $dir . '/' . $fileName);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $imageName = \Carbon\Carbon::now()->toDateString() . '-' . uniqid() . '.' . $format;
            $path = public_path('storage/' . $dir);
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }

            $manager = new ImageManager(new Driver());
            $img = $manager->read($image->getPathname());
            $img->scale(width: 1200);
            $jpegImage = $img->toJpeg(quality: 70);

            file_put_contents($path . '/' . $imageName, $jpegImage->toString());

            return $imageName;
        }

        return null;
    }

    // for excel sheet upload and filter
    public static function extractImages($sheet)
    {
        $images = [];

        foreach ($sheet->getDrawingCollection() as $drawing) {
            if ($drawing instanceof \PhpOffice\PhpSpreadsheet\Worksheet\Drawing) {
                $coordinates = $drawing->getCoordinates();
                $extension = $drawing->getExtension() ?: 'png';
                $filename = \Carbon\Carbon::now()->toDateString() . '-' . uniqid() . '.' . $extension;

                // Extract file from the XLSX zip:// path
                $contents = file_get_contents($drawing->getPath());

                if ($contents === false) {
                    continue;
                }

                $tempPath = tempnam(sys_get_temp_dir(), 'excel_img') . '.' . $extension;
                file_put_contents($tempPath, $contents);

                $uploadedFile = new \Illuminate\Http\UploadedFile(
                    $tempPath,
                    $filename,
                    mime_content_type($tempPath),
                    null,
                    true
                );

                $imageName = Helpers::upload('category-image', $extension, $uploadedFile, null);

                if ($imageName) {
                    $images[$coordinates] = $imageName;
                }

                @unlink($tempPath);
            }
        }

        return $images;
    }

    public static function parseRichContent($cell)
    {
        $value = $cell->getValue();

        // 1. Handle empty cells
        if ($value === null || trim($value) === '') {
            return null;
        }

        // 2. If it's RichText, process it (Excel formatting)
        if ($value instanceof \PhpOffice\PhpSpreadsheet\RichText\RichText) {
            $result = self::richTextToHtml($value);
            $result = self::cleanHtmlEntities($result);

            // TEMPORARY FIX: Remove problematic <u> tags
            $result = preg_replace('/<u>(.*?)<\/u><u>(.*?)<\/u>/', '$1$2', $result);
            $result = preg_replace('/<u>(.*?)<\/u><u>(.*?)$/', '$1$2', $result);

            return $result;
        }

        // 3. If it's string with HTML tags, sanitize them
        if (is_string($value) && self::containsHtml($value)) {
            $result = self::sanitizeHtml($value);
            $result = self::cleanHtmlEntities($result);
            return $result;
        }

        // 4. Plain text processing
        $result = self::processPlainText($value);
        $result = self::cleanHtmlEntities($result);
        return $result;
    }

    private static function containsHtml($value)
    {
        if (!is_string($value)) {
            return false;
        }

        // Detect HTML tags including <br>, <b>, <u>, etc.
        return preg_match('/<[a-z][^>]*>/i', $value);
    }

    private static function sanitizeHtml($html)
    {
        // Allow only specific safe tags
        $allowedTags = '<b><strong><i><em><u><br><br/><p><ul><ol><li><h1><h2><h3><h4><h5><h6>';

        // Strip unwanted tags but keep content
        $cleanHtml = strip_tags($html, $allowedTags);

        // Convert <br> tags to consistent format
        $cleanHtml = str_replace(['<br />', '<br/>'], '<br>', $cleanHtml);

        // Fix unclosed tags (like <u> without </u>)
        $cleanHtml = self::fixUnclosedTags($cleanHtml);

        // Additional cleanup for specific issues
        $cleanHtml = self::cleanHtmlEntities($cleanHtml);

        return $cleanHtml;
    }

    private static function fixUnclosedTags($html)
    {
        // Simple tag balancing for common issues
        $tags = ['b', 'strong', 'i', 'em', 'u'];

        foreach ($tags as $tag) {
            $openCount = substr_count($html, "<{$tag}>");
            $closeCount = substr_count($html, "</{$tag}>");

            if ($openCount > $closeCount) {
                // Remove extra opening tags instead of adding closing tags
                $html = preg_replace('/<' . $tag . '>[^<]*$/', '', $html);
            } elseif ($closeCount > $openCount) {
                // Remove extra closing tags
                $html = preg_replace('/<\/' . $tag . '>[^<]*$/', '', $html);
            }
        }

        return $html;
    }

    private static function richTextToHtml($richText)
    {
        // First, reconstruct the complete text with proper spacing
        $completeText = '';
        foreach ($richText->getRichTextElements() as $element) {
            $completeText .= $element->getText();
        }

        $html = '';
        $currentPosition = 0;

        foreach ($richText->getRichTextElements() as $element) {
            $text = $element->getText();
            $font = $element->getFont();

            $startPos = $currentPosition;
            $endPos = $currentPosition + strlen($text);
            $currentPosition = $endPos;

            // Preserve any whitespace before this element
            if ($startPos > 0) {
                $previousChar = substr($completeText, $startPos - 1, 1);
                if (ctype_space($previousChar)) {
                    $html .= $previousChar;
                }
            }

            // Apply formatting to non-whitespace text
            if (trim($text) !== '') {
                $formattedText = $text;
                if ($font) {
                    if ($font->getBold()) {
                        $formattedText = "<b>{$formattedText}</b>";
                    }
                    if ($font->getItalic()) {
                        $formattedText = "<i>{$formattedText}</i>";
                    }
                }
                $html .= $formattedText;
            } else {
                $html .= $text; // Preserve whitespace as-is
            }

            // Preserve any whitespace after this element
            if ($endPos < strlen($completeText)) {
                $nextChar = substr($completeText, $endPos, 1);
                if (ctype_space($nextChar)) {
                    $html .= $nextChar;
                    $currentPosition++; // Move position forward
                }
            }
        }

        // Now process the final HTML for bullet points and tables
        return self::processPlainText($html);
    }

    private static function processPlainText($value)
    {
        $lines = preg_split("/\r\n|\n|\r/", $value);
        $html = [];
        $ulOpen = false;
        $tableOpen = false;

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '') {
                continue;
            }

            // Fix HTML entities in each line
            $line = html_entity_decode($line);

            // Detect bullet points (lines starting with * with OR without space)
            if (preg_match('/^\*(\s*)(.+)/', $line, $matches)) {
                // Close table if open
                if ($tableOpen) {
                    $html[] = '</table>';
                    $tableOpen = false;
                }

                if (!$ulOpen) {
                    $html[] = '<ul>';
                    $ulOpen = true;
                }
                $html[] = '<li>' . e(trim($matches[2])) . '</li>';
            }
            // TABLE DETECTION: Check if line starts with "table:" (with or without space after colon)
            elseif (preg_match('/^table:\s*(.+)/i', $line, $matches)) {
                // Get the table data after "table:" prefix
                $tableData = trim($matches[1]);

                // Close UL if open
                if ($ulOpen) {
                    $html[] = '</ul>';
                    $ulOpen = false;
                }

                if (!$tableOpen) {
                    $html[] = '<table border="1" style="border-collapse: collapse; width: 100%;">';
                    $tableOpen = true;
                }

                $cells = array_map('trim', explode(',', $tableData));
                $html[] = '<tr>';
                foreach ($cells as $cell) {
                    $html[] = '<td style="padding: 0;">' . e($cell) . '</td>';
                }
                $html[] = '</tr>';
            }
            // Regular text
            else {
                // Close UL if open
                if ($ulOpen) {
                    $html[] = '</ul>';
                    $ulOpen = false;
                }
                // Close table if open
                if ($tableOpen) {
                    $html[] = '</table>';
                    $tableOpen = false;
                }

                $html[] = '<p>' . e($line) . '</p>';
            }
        }

        // Close any open tags
        if ($ulOpen) {
            $html[] = '</ul>';
        }
        if ($tableOpen) {
            $html[] = '</table>';
        }

        $result = implode('', $html);
        return $result ?: null;
    }

    private static function cleanHtmlEntities($html)
    {
        // Replace encoded HTML entities
        $html = str_replace('&lt;', '<', $html);
        $html = str_replace('&gt;', '>', $html);
        $html = str_replace('&amp;', '&', $html);

        // Fix the specific underline issue - remove unclosed <u> tags
        $html = preg_replace('/<u>(.*?)<\/u>(.*?)<u>/', '$1$2', $html);
        $html = preg_replace('/<u>(.*?)$/', '$1', $html); // Remove unclosed <u> at end

        return $html;
    }
}
