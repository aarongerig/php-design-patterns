<?php
declare(strict_types=1);

namespace TablePrinter;

final class Formatter
{
    private $headers;
    private $rows;
    private $transposedRows;

    public function __construct($headers, array $rows = [])
    {
        $this->headers = $headers;
        $this->rows = $rows;
        $this->transposedRows = $rows ? $this->transposeRows($rows) : [];
    }

    public function setRows($rows): void
    {
        $this->rows = $rows;
        $this->transposedRows = $this->transposeRows($rows);
    }

    public function getDivider($char = '+'): string
    {
        $sections = array_map(function($width) {
            return str_repeat('-', $width);
        }, $this->getColumnWidths());

        return $char . implode($char, $sections) . $char . "\n";
    }

    public function getPrintMask(): string
    {
        $columnWidths = $this->getColumnWidths();

        $maskPieces = array_map(function($width) {
            return "%-{$width}s";
        }, $columnWidths);

        return '|' . implode('|', $maskPieces) . '|';
    }

    public function getColumnWidths(): array
    {
        $rows = $this->rows;
        array_unshift($rows, $this->headers);

        $columns = $this->transposeRows($rows);

        return array_map(function($column) {
            return max(array_map('\strlen', $column)) + 3;
        }, $columns);
    }

    private function transposeRows($rows): array
    {
        array_unshift($rows, null);

        return array_map(...$rows);
    }
}