<?php

namespace App\Imports;

use App\Models\Respondent;
use App\Models\EmploymentData;
use App\Models\TracerBatch;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class TracerStudyImport implements ToCollection, WithHeadingRow, WithValidation, WithBatchInserts, WithChunkReading
{
    private $batchId;
    private $processedRows = 0;

    public function __construct($batchId)
    {
        $this->batchId = $batchId;
    }

    public function headingRow(): int
    {
        return 1; // Use row 1 as headers (assuming row 1 has the actual headers)
    }

    public function collection(Collection $rows)
    {
        \Log::info('Processing Excel rows', [
            'total_rows' => $rows->count(),
            'first_row_keys' => $rows->first() ? array_keys($rows->first()->toArray()) : [],
            'sample_row' => $rows->first() ? $rows->first()->toArray() : []
        ]);

        if ($rows->count() === 0) {
            \Log::warning('No rows found in Excel file');
            return;
        }

        foreach ($rows as $index => $row) {
            try {
                \Log::info("Processing row {$index}", [
                    'row_data' => $row->toArray(),
                    'full_name_value' => $row['1_full_name'] ?? 'NOT_FOUND'
                ]);
                // Map the actual Excel column headers to the expected ones
                $fullName = $this->cleanString($row['1_full_name'] ?? '');
                $presentAddress = $this->cleanString($row['2_present_address'] ?? '');
                $provincialAddress = $this->cleanString($row['3_provincial_address'] ?? '');
                $email = $this->cleanString($row['4_e_mail_address'] ?? '');
                $contactNumber = $this->cleanString($row['5_telephone_or_contact_number'] ?? '');
                $civilStatus = $this->normalizeCivilStatus($row['6_civil_status_mark_one_only'] ?? '');
                $gender = $this->normalizeGender($row['7_gender'] ?? '');
                $birthday = $this->parseDate($row['8_birthday'] ?? null);
                $course = $this->normalizeCourse($row['9_what_was_the_course_you_graduated_in'] ?? '');
                $graduationYear = $this->normalizeGraduationYear($row['10_in_which_batchyear_did_you_graduate'] ?? '');

                // Custom email validation
                if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    \Log::warning("Invalid email format: {$email} in row {$index}");
                    // Try to fix common email issues
                    $email = str_replace(' ', '', $email); // Remove spaces
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        \Log::warning("Still invalid after cleaning: {$email} in row {$index}");
                    }
                }

                // Skip if essential data is missing
                if (empty($fullName) || empty($email)) {
                    \Log::info("Skipping row {$index}: missing name or email", [
                        'full_name' => $fullName,
                        'email' => $email
                    ]);
                    continue;
                }

                // Create respondent
                $respondent = Respondent::create([
                    'batch_id' => $this->batchId,
                    'full_name' => $fullName,
                    'present_address' => $presentAddress,
                    'provincial_address' => $provincialAddress,
                    'email_address' => $email,
                    'contact_number' => $contactNumber,
                    'civil_status' => $civilStatus,
                    'gender' => $gender,
                    'birthday' => $birthday,
                    'course_graduated' => $course,
                    'graduation_year' => (int) $graduationYear,
                ]);

                // Create employment data
                EmploymentData::create([
                    'respondent_id' => $respondent->id,
                    'is_presently_employed' => $this->parseBoolean($row['11_are_you_presently_employed'] ?? ''),
                    'present_occupation' => $this->cleanString($row['12_present_occupation_ex_programmer_systems_analyst_software_engineer_etc_specify_whether_or_not_it_related'] ?? ''),
                    'company_name' => $this->cleanString($row['13_name_of_company_or_organization'] ?? ''),
                    'company_address_contact' => $this->cleanString($row['14_company_address_contact_information'] ?? ''),
                    'place_of_work' => $this->normalizePlaceOfWork($row['15_place_of_work'] ?? ''),
                    'position_designation' => $this->cleanString($row['16_positiondesignation'] ?? ''),
                    'professional_skills' => $this->cleanString($row['17_professional_skills_please_specify'] ?? ''),
                    'is_first_job' => $this->parseBoolean($row['18_is_this_your_first_job_after_college'] ?? ''),
                    'is_course_related' => $this->parseBoolean($row['19_is_your_first_job_related_to_the_course_you_took_up_in_college'] ?? ''),
                ]);

                $this->processedRows++;

            } catch (\Exception $e) {
                // Log error but continue processing
                \Log::error('Error processing row: ' . $e->getMessage(), [
                    'row_data' => $row->toArray(),
                    'error' => $e->getMessage()
                ]);
                continue;
            }
        }

        // Update batch with total records
        TracerBatch::find($this->batchId)->update([
            'total_records' => $this->processedRows,
            'upload_date' => now(),
        ]);
    }

    public function rules(): array
    {
        return [
            '1_full_name' => 'required|string|max:255',
            '4_e_mail_address' => 'required|string|max:255',
            '6_civil_status_mark_one_only' => 'required|string|max:255',
            '7_gender' => 'required|string|max:255',
            '9_what_was_the_course_you_graduated_in' => 'required|string|max:255',
            '10_in_which_batchyear_did_you_graduate' => 'required', // Accept any type (string, number, etc.)
        ];
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }

    private function normalizeGraduationYear($value)
    {
        if (empty($value)) {
            return (int) date('Y');
        }

        if (is_numeric($value)) {
            $numericValue = (float) $value;

            if ($numericValue >= 1900 && $numericValue <= ((int) date('Y') + 1)) {
                return (int) round($numericValue);
            }

            if ($numericValue > 9999) {
                try {
                    return (int) ExcelDate::excelToDateTimeObject($numericValue)->format('Y');
                } catch (\Exception $e) {
                    // Fall through to a direct cast when the serial conversion fails.
                }
            }

            return (int) round($numericValue);
        }

        $value = $this->cleanString($value);

        if (preg_match('/^\d{4}$/', $value)) {
            return (int) $value;
        }

        // Handle Excel serial dates (numbers like 44669)
        if (is_numeric($value)) {
            // Convert Excel serial date to year
            try {
                $date = \DateTime::createFromFormat('U', ($value - 25569) * 86400);
                if ($date) {
                    return (int)$date->format('Y');
                }
            } catch (\Exception $e) {
                // If conversion fails, try to cast directly
                return (int)$value;
            }
        }
        
        // Handle string values
        $value = $this->cleanString($value);
        
        // Handle year ranges like "2019-2020" or "2023-2024"
        if (preg_match('/(\d{4})\s*[-–]\s*(\d{4})/', $value, $matches)) {
            // Return the end year (more recent)
            return (int)$matches[2];
        }
        
        // Handle single years
        if (preg_match('/(\d{4})/', $value, $matches)) {
            return (int)$matches[1];
        }
        
        // Default to current year if can't parse
        return (int)date('Y');
    }

    private function cleanString($value)
    {
        return trim(preg_replace('/\s+/', ' ', strip_tags($value)));
    }

    private function normalizeCivilStatus($value)
    {
        $value = strtolower($this->cleanString($value));
        return match($value) {
            'single' => 'single',
            'married' => 'married',
            'separated' => 'separated',
            'widowed' => 'widowed',
            'divorced' => 'separated', // Handle divorced as separated
            default => 'single', // Default to single if unknown
        };
    }

    private function normalizeGender($value)
    {
        $value = strtolower($this->cleanString($value));
        return match($value) {
            'female' => 'female',
            'male' => 'male',
            'prefer not to say', 'prefer_not_to_say' => 'prefer_not_to_say',
            'other' => 'other',
            default => 'prefer_not_to_say', // Default to prefer not to say if unknown
        };
    }

    private function normalizeCourse($value)
    {
        $value = strtoupper($this->cleanString($value));
        return match($value) {
            'ASSOCIATE IN COMPUTER TECHNOLOGY', 'ACT', 'ASSOCIATE IN COMPUTER TECHNOLOGY (ACT)' => 'ASSOCIATE IN COMPUTER TECHNOLOGY',
            'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'BSCS', 'BS COMPUTER SCIENCE', 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE (BSCS)' => 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE',
            'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 'BSIT', 'BS INFORMATION TECHNOLOGY', 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY (BSIT)' => 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY',
            default => 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', // Default to BSIT if unknown
        };
    }

    private function normalizePlaceOfWork($value)
    {
        $value = strtolower($this->cleanString($value));
        return match($value) {
            'local', 'philippines' => 'local',
            'abroad', 'international', 'overseas' => 'abroad',
            default => 'local',
        };
    }

    private function parseBoolean($value)
    {
        if (is_null($value)) return null;
        
        $value = strtolower($this->cleanString($value));
        return match($value) {
            'yes', 'y', 'true', '1', 'on' => true,
            'no', 'n', 'false', '0', 'off' => false,
            default => null,
        };
    }

    private function parseDate($value)
    {
        if (empty($value)) return null;
        
        // Handle Excel serial dates (numbers like 37379)
        if (is_numeric($value)) {
            try {
                // Excel serial dates start from 1900-01-01
                $excelEpoch = new \DateTime('1900-01-01');
                $daysOffset = (int)$value - 1; // Excel starts counting from 1, not 0
                $dateInterval = new \DateInterval("P{$daysOffset}D");
                $excelEpoch->add($dateInterval);
                return $excelEpoch->format('Y-m-d');
            } catch (\Exception $e) {
                \Log::warning("Failed to parse Excel date: {$value}");
                return null;
            }
        }
        
        // Handle string dates
        $value = $this->cleanString($value);
        
        try {
            // Try different date formats
            $formats = ['Y-m-d', 'm/d/Y', 'd/m/Y', 'F d, Y', 'M d, Y', 'Y/m/d'];
            
            foreach ($formats as $format) {
                $date = \DateTime::createFromFormat($format, $value);
                if ($date) {
                    return $date->format('Y-m-d');
                }
            }
            
            // Try strtotime as fallback
            $timestamp = strtotime($value);
            if ($timestamp !== false) {
                return date('Y-m-d', $timestamp);
            }
        } catch (\Exception $e) {
            // Return null if all parsing fails
        }
        
        // If all parsing fails, return a default date or null
        return null;
    }

    public function getProcessedRowsCount()
    {
        return $this->processedRows;
    }
}
