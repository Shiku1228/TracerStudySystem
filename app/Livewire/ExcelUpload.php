<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\TracerBatch;
use App\Imports\TracerStudyImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class ExcelUpload extends Component
{
    use WithFileUploads;

    public $file;
    public $batchName;
    public $description;
    public $isUploading = false;
    public $uploadProgress = 0;
    public $uploadMessage = '';
    public $recentBatches;

    protected $rules = [
        'file' => 'required|file|mimes:xlsx,xls,csv|max:10240', // Max 10MB
        'batchName' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
    ];

    protected $messages = [
        'file.required' => 'Please select an Excel file to upload.',
        'file.mimes' => 'The file must be an Excel file (.xlsx, .xls, .csv).',
        'file.max' => 'The file size must not exceed 10MB.',
        'batchName.required' => 'Please provide a batch name for this upload.',
    ];

    protected $validationAttributes = [
        'file' => 'Excel file',
        'batchName' => 'batch name',
        'description' => 'description',
    ];

    public function mount()
    {
        $this->loadRecentBatches();
    }

    public function loadRecentBatches()
    {
        $this->recentBatches = TracerBatch::with('admin')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
    }

    public function updatedFile()
    {
        $this->validateOnly('file');
        $this->uploadMessage = '';
        
        \Log::info('File updated', [
            'file_exists' => $this->file ? 'Yes' : 'No',
            'file_name' => $this->file ? $this->file->getClientOriginalName() : 'N/A',
            'file_size' => $this->file ? $this->file->getSize() : 'N/A'
        ]);
    }

    public function handleUpload()
    {
        \Log::info('handleUpload called', [
            'file' => $this->file ? 'exists' : 'null',
            'batchName' => $this->batchName,
            'description' => $this->description
        ]);

        // Simple validation first
        if (!$this->batchName) {
            $this->uploadMessage = "❌ Please provide a batch name.";
            return;
        }

        if (!$this->file) {
            $this->uploadMessage = "❌ Please select a file to upload.";
            return;
        }

        // Call the original upload method
        $this->upload();
    }

    public function upload()
    {
        \Log::info('Upload method called', [
            'file' => $this->file ? 'exists' : 'null',
            'batchName' => $this->batchName,
            'description' => $this->description
        ]);

        // Validate without file first
        $this->validate([
            'batchName' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        \Log::info('Basic validation passed');

        // Validate file separately
        if (!$this->file) {
            $this->uploadMessage = "❌ Please select a file to upload.";
            return;
        }

        $this->validateOnly('file');
        \Log::info('File validation passed');

        $this->isUploading = true;
        $this->uploadProgress = 0;
        $this->uploadMessage = '';

        try {
            // Create batch record
            $batch = TracerBatch::create([
                'batch_name' => $this->batchName,
                'file_path' => '',
                'uploaded_by_admin_id' => auth()->id(),
                'total_records' => 0,
                'description' => $this->description,
            ]);

            // Store the file
            $filePath = $this->file->store('tracer-study-uploads', 'public');
            $batch->update(['file_path' => $filePath]);

            $this->uploadProgress = 25;

            // Process the Excel file
            $import = new TracerStudyImport($batch->id);
            
            Excel::import($import, $this->file->getRealPath());
            
            $this->uploadProgress = 75;

            $processedRows = $import->getProcessedRowsCount();

            $this->uploadProgress = 100;

            if ($processedRows > 0) {
                $this->uploadMessage = "✅ Successfully imported {$processedRows} respondents from the Excel file!";
                $this->reset(['file', 'batchName', 'description']);
                $this->loadRecentBatches();
            } else {
                $this->uploadMessage = "⚠️ No valid data found in the Excel file. Please check the format and try again.";
                // Delete the empty batch
                $batch->delete();
                Storage::disk('public')->delete($filePath);
            }

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errorMessages = [];
            
            foreach ($failures as $failure) {
                $row = $failure->row();
                $attribute = $failure->attribute();
                $errors = implode(', ', $failure->errors());
                $errorMessages[] = "Row {$row}: {$attribute} - {$errors}";
            }
            
            $this->uploadMessage = "❌ Validation errors: " . implode('; ', array_slice($errorMessages, 0, 3));
            
            // Clean up on error
            if (isset($batch)) {
                $batch->delete();
                if (isset($filePath)) {
                    Storage::disk('public')->delete($filePath);
                }
            }

        } catch (\Exception $e) {
            \Log::error('Upload error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            $this->uploadMessage = "❌ Error uploading file: " . $e->getMessage();
            
            // Clean up on error
            if (isset($batch)) {
                $batch->delete();
                if (isset($filePath)) {
                    Storage::disk('public')->delete($filePath);
                }
            }
        }

        $this->isUploading = false;
    }

    public function deleteBatch($batchId)
    {
        $batch = TracerBatch::findOrFail($batchId);
        
        // Delete file from storage
        if ($batch->file_path) {
            Storage::disk('public')->delete($batch->file_path);
        }
        
        // Delete batch (cascade will delete respondents and employment data)
        $batch->delete();
        
        $this->uploadMessage = "🗑️ Batch '{$batch->batch_name}' has been deleted.";
        $this->loadRecentBatches();
    }

    public function getEmploymentRate($batch)
    {
        return $batch->employment_rate . '%';
    }

    public function render()
    {
        return view('livewire.excel-upload');
    }
}
