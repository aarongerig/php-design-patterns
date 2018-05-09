<?php
declare(strict_types=1);

require __DIR__ . '/TablePrinter/Formatter.php';

final class TablePrinter
{
    private $headers;
    private $rows = [];
    private $mask;
    private $formatter;

    public function __construct($headers, $formatter = null)
    {
        $this->headers = $headers;
        $this->formatter = $formatter ?: new \TablePrinter\Formatter($headers);
    }

    public function addRow(/* variadic */): void
    {
        $this->rows[] = func_get_args();
    }

    public function output(): void
    {
        $this->formatter->setRows($this->rows);

        ob_start();
        $this->printDivider();
        $this->printRow($this->headers);
        $this->printDivider();

        foreach ($this->rows as $row) {
            $this->printRow($row);
        }

        $this->printDivider();

        echo ob_get_clean();
    }

    public function printDivider(): void
    {
        echo $this->formatter->getDivider();
    }

    private function printRow($row): void
    {
        array_unshift($row, $this->getMask());

        echo sprintf(...$row) . "\n";
    }

    private function getMask(): string
    {
        return $this->mask ?: $this->mask = $this->formatter->getPrintMask();
    }
}