<div>
    <script>
        document.addEventListener('livewire:init', () => {
            // Fix file upload issues
            Livewire.on('upload', (name, file) => {
                console.log('File upload initiated:', name, file);
            });
        });
    </script>
    
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="card-surface dark:card-surface-dark rounded-xl p-6 mb-6">
            <h1 class="text-5xl font-black text-[#040405] dark:text-[#c0c0c0] tracking-tight mb-2" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.1);">Upload Tracer Study Data</h1>
            <p class="text-[#731820] dark:text-[#c0c0c0] text-lg">Upload Excel files from Google Forms to process graduate tracer study data.</p>
        </div>

        <!-- Upload Form -->
        <div class="card-surface dark:card-surface-dark rounded-xl p-6 mb-6">
            <form wire:submit.prevent="handleUpload" enctype="multipart/form-data">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Batch Name -->
                    <div>
                        <flux:label for="batchName">Batch Name *</flux:label>
                        <flux:input 
                            id="batchName"
                            wire:model="batchName" 
                            type="text" 
                            placeholder="e.g., 2026 Q1 Graduate Tracer"
                            required 
                        />
                        @error('batchName')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File Upload -->
                    <div>
                        <flux:label for="file">Excel File *</flux:label>
                        <input 
                            id="file"
                            wire:model.defer="file" 
                            type="file" 
                            accept=".xlsx,.xls,.csv"
                            class="w-full px-3 py-2 border border-[#731820]/20 bg-[#b97940]/15 dark:bg-[#040405] text-[#040405] dark:text-[#c0c0c0] rounded-lg focus:ring-2 focus:ring-[#731820] focus:border-[#731820] cursor-pointer"
                            required 
                        />
                        @error('file')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-[#731820] text-xs mt-1">Supported formats: .xlsx, .xls, .csv (Max 10MB)</p>
                        @if($file)
                            <p class="text-[#b97940] text-xs mt-1">File selected: {{ $file->getClientOriginalName() }} ({{ number_format($file->getSize() / 1024 / 1024, 2) }} MB)</p>
                        @endif
                    </div>
                </div>

                <!-- Description -->
                <div class="mt-6">
                    <flux:label for="description">Description (Optional)</flux:label>
                    <flux:textarea 
                        id="description"
                        wire:model="description" 
                        rows="3" 
                        placeholder="Add notes about this batch upload..."
                    />
                </div>

                <!-- Upload Button -->
                <div class="mt-6">
                    <flux:button 
                        type="submit" 
                        variant="primary"
                        wire:loading.attr="disabled"
                        :disabled="$isUploading"
                    >
                        <span wire:loading.remove>Upload Excel File</span>
                        <span wire:loading>Processing...</span>
                    </flux:button>
                </div>

                <!-- Progress Bar -->
                @if($isUploading)
                    <div class="mt-6">
                        <div class="flex justify-between text-sm text-[#731820] dark:text-[#c0c0c0] mb-2">
                            <span>Processing file...</span>
                            <span>{{ $uploadProgress }}%</span>
                        </div>
                        <div class="w-full bg-white dark:bg-[#040405] rounded-full h-2">
                            <div class="bg-[#961a1f] h-2 rounded-full transition-all duration-300" style="width: {{ $uploadProgress }}%"></div>
                        </div>
                    </div>
                @endif

                <!-- Upload Message -->
                @if($uploadMessage)
                    <div class="mt-6 p-4 rounded-lg @if(str_contains($uploadMessage, 'Success')) bg-[#b97940]/12 border border-[#b97940] text-[#040405] @elseif(str_contains($uploadMessage, 'Warning')) bg-[#731820]/10 border border-[#731820] text-[#731820] @else bg-[#961a1f]/10 border border-[#961a1f] text-[#961a1f] @endif">
                        {{ $uploadMessage }}
                    </div>
                @endif
            </form>
        </div>

        <!-- Expected Excel Format -->
        <div class="card-surface dark:card-surface-dark rounded-xl p-6 mb-6">
            <h3 class="text-lg font-semibold text-[#040405] dark:text-[#c0c0c0] mb-4">Expected Excel Format</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-[#731820] dark:text-[#c0c0c0]">
                <div>
                    <p class="font-medium mb-2">Required Columns:</p>
                    <ul class="space-y-1">
                        <li>• 1. Full Name</li>
                        <li>• 2. Present Address</li>
                        <li>• 3. Provincial Address</li>
                        <li>• 4. E-mail Address</li>
                        <li>• 5. Telephone or Contact #</li>
                        <li>• 6. Civil Status</li>
                        <li>• 7. Gender</li>
                        <li>• 8. Birthday</li>
                        <li>• 9. What was the course you graduated in?</li>
                        <li>• 10. In which batchyear did you graduate?</li>
                    </ul>
                </div>
                <div>
                    <p class="font-medium mb-2">Employment Columns:</p>
                    <ul class="space-y-1">
                        <li>• 11. Are you presently employed?</li>
                        <li>• 12. Present occupation...</li>
                        <li>• 13. Name of company or organization</li>
                        <li>• 14. Company address/Contact information</li>
                        <li>• 15. Place of work</li>
                        <li>• 16. Position/Designation</li>
                        <li>• 17. Professional skills (Please specify)</li>
                        <li>• 18. Is this your first job after college?</li>
                        <li>• 19. Is your first job related to the course...</li>
                    </ul>
                </div>
            </div>
            <div class="mt-4 p-3 bg-[#731820]/10 dark:bg-[#731820] rounded">
                <p class="text-xs text-[#731820] dark:text-[#c0c0c0]">
                    <strong>Accepted Data:</strong> Graduate tracer study responses with complete personal information (name, email, contact details, course, employment status). System normalizes column headers automatically.
                </p>
            </div>
        </div>

        <!-- Recent Uploads -->
        @if($recentBatches->count() > 0)
            <div class="card-surface dark:card-surface-dark rounded-xl p-6">
                <h3 class="text-lg font-semibold text-[#040405] dark:text-[#c0c0c0] mb-4">Recent Uploads</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-[#731820]/20">
                                <th class="text-left py-2 text-[#731820] dark:text-[#c0c0c0]">Batch Name</th>
                                <th class="text-left py-2 text-[#731820] dark:text-[#c0c0c0]">Records</th>
                                <th class="text-left py-2 text-[#731820] dark:text-[#c0c0c0]">Employment Rate</th>
                                <th class="text-left py-2 text-[#731820] dark:text-[#c0c0c0]">Uploaded By</th>
                                <th class="text-left py-2 text-[#731820] dark:text-[#c0c0c0]">Date</th>
                                <th class="text-left py-2 text-[#731820] dark:text-[#c0c0c0]">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentBatches as $batch)
                                <tr class="border-b border-[#731820]/20 hover:bg-[#b97940]/10">
                                    <td class="py-3">
                                        <div>
                                            <p class="font-medium text-[#040405] dark:text-[#c0c0c0]">{{ $batch->batch_name }}</p>
                                            @if($batch->description)
                                                <p class="text-[#731820] dark:text-[#c0c0c0] text-xs">{{ Str::limit($batch->description, 50) }}</p>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="py-3 text-[#040405] dark:text-[#c0c0c0]">{{ $batch->total_records }}</td>
                                    <td class="py-3">
                                        <span class="px-2 py-1 bg-[#b97940]/20 text-[#040405] rounded-full text-xs">
                                            {{ $batch->employment_rate }}%
                                        </span>
                                    </td>
                                    <td class="py-3 text-[#040405] dark:text-[#c0c0c0]">{{ $batch->admin->name }}</td>
                                    <td class="py-3 text-[#040405] dark:text-[#c0c0c0]">{{ $batch->created_at->format('M d, Y') }}</td>
                                    <td class="py-3">
                                        <button 
                                            wire:click="deleteBatch({{ $batch->id }})"
                                            wire:confirm="Are you sure you want to delete this batch and all its data?"
                                            class="text-[#961a1f] hover:text-[#731820] text-sm"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>
