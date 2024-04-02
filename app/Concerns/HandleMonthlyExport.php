<?php

namespace App\Concerns;

use App\Models\Pillars\Pillar;
use Illuminate\Support\Collection;

trait HandleMonthlyExport
{
    public function doExportMonthly(Collection $payloads, $reporter, string $month)
    {
        $pillar = $reporter->user->pillar->id;

        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $section = $phpWord->addSection();

        $section->addText('Nama ' . '              : ' . $reporter->name, array('bold' => true), array('align' => 'left'));
        $section->addText($this->determineMembershipNumberLabel($pillar) .  '                  : ' . $reporter->membership_number, array('bold' => true), array('align' => 'left'));
        $section->addText('Wilayah Kerja ' . ': ' . 'KECAMATAN ' . $reporter->duty_address['district'], array('bold' => true), array('align' => 'left'));
        $section->addText('Bulan ' . '              : ' . strtoupper($month), array('bold' => true), array('align' => 'left'));

        $section->addText('A. KEGIATAN', array('bold' => true), array('align' => 'left'));
        $tableStyle = array(
            'borderSize'  => 6,
            'cellMargin'  => 50,
        );
        $phpWord->addTableStyle('myTable', $tableStyle);
        $table = $section->addTable('myTable');
        $table->addRow();
        $table->addCell(1750)->addText('No.', array('bold' => true), array('align' => 'center'));
        $table->addCell(1750)->addText('Wakktu (Hari/Tanggal)', array('bold' => true), array('align' => 'center'));
        $table->addCell(1750)->addText('Tempat', array('bold' => true), array('align' => 'center'));
        $table->addCell(1750)->addText('Aktifitas yang dilakukan', array('bold' => true), array('align' => 'center'));
        $table->addCell(1750)->addText('Kendala', array('bold' => true), array('align' => 'center'));

        foreach ($payloads as $key => $report) {
            $table->addRow();
            $table->addCell(1750)->addText($key + 1, array('bold' => false), array('align' => 'center'));
            $table->addCell(1750)->addText($report->daily_date, array('bold' => false),array('align' => 'center'));
            $table->addCell(1750)->addText($report->venue, array('bold' => false), array('align' => 'left'));
            $table->addCell(1750)->addText($report->activity, array('bold' => false), array('align' => 'left'));
            $table->addCell(1750)->addText($report->constraint, array('bold' => false), array('align' => 'center'));
        }

        // Dokumentasi Lapangan
        $section->addPageBreak();
        $section->addText('B. DOKUMENTASI LAPANGAN', array('bold' => true), array('align' => 'left'));

        foreach ($payloads as $report) {
            $section->addImage('./storage/' . $report->attachment, array('height' => 150, 'align' => 'left'));
            $section->addText($report->description, array('align' => 'left'));
        }

        // Saving the document as OOXML file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

        $fileName = 'Laporan Bulanan ' . $reporter->name . ' ' . $month . '.docx';
        $objWriter->save(storage_path($fileName));

        return storage_path($fileName);
    }

    private function determinePillar($pillar): string
    {
        return match ($pillar) {
            Pillar::PILLAR_TKSK => 'TKSK',
            Pillar::PILLAR_PSM => 'PSM',
            default => 'TKSK',
        };
    }

    private function determineMembershipNumberLabel($pillar): string
    {
        return match ($pillar) {
            Pillar::PILLAR_TKSK => 'Niat',
            Pillar::PILLAR_PSM => 'Ipsn',
            default => 'Niat',
        };
    }
}
