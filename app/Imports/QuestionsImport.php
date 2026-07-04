<?php

namespace App\Imports;

use App\Models\ExamSession;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionsImport implements ToCollection, WithHeadingRow
{
    protected array $rowImages;

    public function __construct(array $rowImages = [])
    {
        $this->rowImages = $rowImages;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            $actualExcelRow = $index + 2; // +2 krn header row + index mulai 0

            $session = ExamSession::firstOrCreate(
                ['name' => trim($row['materi'])],
                ['duration' => $row['durasi'] ?? 30]
            );

            $optionsData = [];
            if (!empty($row['pilihan_a'])) $optionsData[] = $row['pilihan_a'];
            if (!empty($row['pilihan_b'])) $optionsData[] = $row['pilihan_b'];
            if (!empty($row['pilihan_c'])) $optionsData[] = $row['pilihan_c'];
            if (!empty($row['pilihan_d'])) $optionsData[] = $row['pilihan_d'];
            if (!empty($row['pilihan_e'])) $optionsData[] = $row['pilihan_e'];

            $letterToKey = ['A' => 0, 'B' => 1, 'C' => 2, 'D' => 3, 'E' => 4];
            $correctLetter = strtoupper(trim($row['jawaban_benar']));
            $correctIndex = $letterToKey[$correctLetter] ?? 0;

            $question = Question::create([
                'exam_session_id' => $session->id,
                'text'            => $row['pertanyaan'],
                'correct'         => $correctIndex,
                'gambar'          => $this->rowImages[$actualExcelRow] ?? null,
            ]);

            foreach ($optionsData as $optionText) {
                Option::create([
                    'question_id' => $question->id,
                    'text' => $optionText,
                ]);
            }
        }
    }
}