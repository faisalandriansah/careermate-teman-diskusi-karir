<?php

namespace App\Services;

use Smalot\PdfParser\Parser;
use Exception;

class PDFExtractorService
{
    public function extract(string $filePath): string
    {
        try {
            $parser = new Parser();
            $pdf = $parser->parseFile($filePath);
            $text = $pdf->getText();

            return trim($text);
        } catch (Exception $e) {
            throw new Exception('Gagal mengekstrak teks dari file PDF: ' . $e->getMessage());
        }
    }
}
