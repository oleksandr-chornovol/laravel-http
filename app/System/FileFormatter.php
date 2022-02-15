<?php

namespace App\System;

class FileFormatter {
    public function generateFile($data, $fileType): string
    {
        return match ($fileType) {
            'xml' => $this->formatToXML($data),
            'xlsx' => $this->formatToXLSX($data),
            default => $this->formatToCSV($data),
        };
    }

    private function formatToCSV(array $data): string
    {
        // generating file logic

        return '';
    }

    private function formatToXML(array $data): string
    {
        // generating file logic

        return '';
    }

    private function formatToXLSX(array $data): string
    {
        // generating file logic

        return '';
    }
}
