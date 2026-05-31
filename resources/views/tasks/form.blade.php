
        <!-- Main Content Area -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-start">
                <!-- Left: Form Canvas -->
                <div
                    class="lg:col-span-8 bg-surface-container-lowest rounded-[32px] p-8 md:p-12 shadow-lg shadow-primary/5 border border-outline/5 relative overflow-hidden">
                    <!-- Subtle Corner Accent -->
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-bl-full translate-x-12 -translate-y-12">
                    </div>
                    @if($errors->any())
                        <div class="bg-error/10 border border-error rounded-lg p-4 mb-6">
                            <h4 class="font-label-md text-error mb-2">Please fix the following errors:</h4>
                            <ul class="list-disc list-inside text-on-error">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach 
                            </ul>
                        </div>  
                        
                    @endif
                    <form method="POST" action="{{$action}}" class="space-y-10 relative z-10"enctype="multipart/form-data">
                        @csrf
                        @method($method??'POST')
                        
                        <!-- Task Title Section -->
                        <div class="space-y-2">
                            <label class="font-label-md text-primary uppercase tracking-[0.1em]">Task Heading</label>
                            <input name="title"
                                class="w-full bg-on-background/[0.04] border-0 border-b-2 border-on-surface-variant/20 py-4 text-headline-md font-headline-md placeholder:text-on-surface-variant/30 focus:border-primary transition-all duration-300"
                                placeholder="What needs to be done?" type="text"
                                value="{{ old('title', $task->title) }}" />
                        </div>
                        <!-- Rich Text Description -->
                        <div class="space-y-4">
                            <label class="font-label-md text-primary uppercase tracking-[0.1em]">Description</label>
                            <div
                                class="bg-on-background/[0.04] border-b-2 border-on-surface-variant/20 rounded-xl overflow-hidden group focus-within:border-primary">
                               
                                <textarea 
                                    class="w-full bg-transparent border-0 p-4 font-body-md text-on-surface-variant placeholder:text-on-surface-variant/30 focus:ring-0"
                                    name="description"
                                    placeholder="Describe the creative process or technical requirements..." rows="6">{{ old('description', $task->description) }}</textarea>
                            </div>
                        </div>
                        <!-- Attachments Row -->
                        <div class="flex flex-wrap gap-4">
                            <label for="attachment"
                                class="group cursor-pointer flex flex-col items-center justify-center border-2 border-dashed border-outline/20 rounded-2xl p-6 w-32 hover:border-primary/40 hover:bg-primary/5 transition-all">
                                <span class="material-symbols-outlined text-outline group-hover:text-primary mb-2">add_circle</span>
                                <span class="font-label-sm text-outline group-hover:text-primary">Attach</span>
                                <input id="attachment" name="attachment" type="file"
                                    accept="image/*,.pdf,.doc,.docx,.xls,.xlsx,.txt,.zip"
                                    class="sr-only" />
                            </label>
                            @php
                               
                                $attachmentName = $task->attachment ? basename($task->attachment) : null;
                               
                            @endphp
                            <div id="attachmentPreview"
                                class="relative group w-32 h-32 rounded-2xl overflow-hidden border border-outline/10 shadow-sm bg-surface-container-high">
                                @if($task->attachment && preg_match('/\.(jpe?g|png|gif|webp)$/i', $task->attachment))
                                    <img alt="Attachment preview" class="w-full h-full object-cover"
                                    src="{{ Storage::url($task->attachment) }}" />
                                @else
                                    <div
                                        class="w-full h-full flex flex-col items-center justify-center text-on-surface-variant px-3 text-center">
                                        <span class="material-symbols-outlined text-[32px] mb-1">insert_drive_file</span>
                                        <span class="text-[12px]">{{ $attachmentName ?? 'No attachment' }}</span>
                                    </div>
                                @endif
                                @if($task->attachment)
                                    <a href="{{ Storage::url($task->attachment) }}" target="_blank"
                                        class="absolute inset-x-0 bottom-0 bg-surface-container-high/90 text-[11px] text-on-surface py-1 text-center truncate">
                                        {{ $attachmentName }}
                                    </a>
                                @endif
                                <button id="clearAttachment"
                                    class="absolute top-1 right-1 bg-error text-on-error w-6 h-6 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity"
                                    type="button">
                                    <span class="material-symbols-outlined text-[14px]">close</span>
                                </button>
                            </div>
                        </div>
                        @error('attachment')
                            <p class="text-error text-sm mt-2">{{ $message }}</p>
                        @enderror
                    
                </div>
                <!-- Right: Meta Sidebar -->
                <div class="lg:col-span-4 lg:self-start lg:sticky lg:top-10 space-y-gutter">
                    <!-- Context Card -->
                    <div
                        class="bg-surface-container-low rounded-[24px] p-6 border border-outline/5 creative-border-accent border-l-primary">
                        <h3 class="font-label-md text-primary uppercase tracking-[0.1em] mb-6">Task Properties</h3>
                        <div class="space-y-6">
                            <!-- Project Select -->
                            <div class="space-y-2">
                                <label class="font-label-sm text-on-surface-variant flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[18px]">folder</span> Category
                                </label>
                                <select
                                    class="w-full bg-surface-container border-0 border-b-2 border-outline/20 rounded-lg font-label-md text-on-surface py-3 focus:border-primary transition-all"
                                    name="categories_id">
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}" @selected(old('categories_id', $task->categories_id) == $item->id)>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Due Date -->
                            <div class="space-y-2">
                                <label class="font-label-sm text-on-surface-variant flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[18px]">calendar_today</span> Due Date
                                </label>
                                <input name="due_date"
                                    class="w-full bg-surface-container border-0 border-b-2 border-outline/20 rounded-lg font-label-md text-on-surface py-3 focus:border-primary transition-all"
                                    type="date"
                                    value="{{ old('due_date', optional($task->due_date)->format('Y-m-d')) }}"  />
                            </div>
                            <!-- Priority Grid -->
                            <div class="space-y-2">
                                <label class="font-label-sm text-on-surface-variant flex items-center gap-2 mb-3">
                                    <span class="material-symbols-outlined text-[18px]">flag</span> Priority
                                </label>
                                <div class="grid grid-cols-3 gap-2">
                                    <label class="cursor-pointer">
                                        <input type="radio" name="priority" value="low" class="sr-only peer" @checked(old('priority', $task->priority) === 'low')>
                                        <div class="flex flex-col items-center justify-center p-3 rounded-xl border border-outline/10 hover:bg-surface-variant/50 transition-all peer-checked:border-2 peer-checked:border-primary/40 peer-checked:bg-surface-variant/20">
                                            <div class="w-2 h-2 rounded-full bg-primary mb-2"></div>
                                            <span class="font-label-sm peer-checked:font-bold">Low</span>
                                        </div>
                                    </label>

                                    <label class="cursor-pointer">
                                        <input type="radio" name="priority" value="med" class="sr-only peer" @checked(old('priority', $task->priority) === 'med')>
                                        <div class="flex flex-col items-center justify-center p-3 rounded-xl border border-outline/10 hover:bg-surface-variant/50 transition-all peer-checked:border-2 peer-checked:border-tertiary peer-checked:ring-2 peer-checked:ring-tertiary/20 peer-checked:bg-surface-variant/20">
                                            <div class="w-2 h-2 rounded-full bg-tertiary mb-2"></div>
                                            <span class="font-label-sm peer-checked:font-bold">Med</span>
                                        </div>
                                    </label>

                                    <label class="cursor-pointer">
                                        <input type="radio" name="priority" value="high" class="sr-only peer" @checked(old('priority', $task->priority) === 'high')>
                                        <div class="flex flex-col items-center justify-center p-3 rounded-xl border border-outline/10 hover:bg-surface-variant/50 transition-all peer-checked:border-2 peer-checked:border-secondary/40 peer-checked:bg-surface-variant/20">
                                            <div class="w-2 h-2 rounded-full bg-secondary mb-2"></div>
                                            <span class="font-label-sm peer-checked:font-bold">High</span>
                                        </div>
                                    </label>
                                </div>
                                                            
                            </div>
                        </div>
                    </div>
                    <!-- Assignees Card -->
                    <div
                        class="bg-surface-container-low rounded-[24px] p-6 border border-outline/5 creative-border-accent border-l-secondary">
                        <h3 class="font-label-md text-secondary uppercase tracking-[0.1em] mb-4">Collaborators</h3>
                        <div class="flex -space-x-3 mb-4">
                            <img alt="Member"
                                class="w-10 h-10 rounded-full border-2 border-surface shadow-sm object-cover"
                                data-alt="Close-up portrait of a woman with curly hair and glasses, smiling. Bright, clean lighting against a soft pastel background."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDwjbFJvpbGT0TOZVrneu6zJB82nCpaen4hNqdr-RlT1Pw4H5kq1gL8b84dvhjoBNuGVdxCj-hclhJCsrasz0_Z1XZAFJJ6uQCMSQpqRiQJrmH5kH85AtOs9h50BDxU3CTIzZq2fMof-k6rxo9f395Nwonb2daoBzTHyDWxLYm0pvUH4aRru2iVLcWi5fIVzeJzumZQ_xA3b2cZl7X2Gv7_dPk2u7d-QbXPyqMDi-L77f1dxLdhg7q7MvLevaOIuZ4eMap1IGPgzloF" />
                            <img alt="Member"
                                class="w-10 h-10 rounded-full border-2 border-surface shadow-sm object-cover"
                                data-alt="Portrait of a creative man with a beard and a stylish cap. Professional studio lighting with subtle teal and navy shadows."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBoORVAwLpt_g_L94R8HxZMpabhmtts74ZvDFEoHOeX_yNP_lo084IR5YxfjSy9qtUbfAuuxGPkcSh7lBgjrl6AyEzdgkQTWjYJ9y6kgQnzjEkmuYCr3FLQZyWcbp47hsAawRCIpHb8LdxAeunUhhKmbBPxPlS1G-dgCtxt16Pkx8rFEEK5dgEMDkhUUD0uov07Cd3_jYnJ_e1n_s0_grwpcH99nJsKBcKtQiVZJNj2VjVaPZ1Sb69HsnplU-BXHYlPAdrUK8BkxXYc" />
                            <button type="submit"
                                class="w-10 h-10 rounded-full border-2 border-surface shadow-sm bg-secondary-fixed flex items-center justify-center text-on-secondary-fixed hover:scale-105 transition-transform">
                                <span class="material-symbols-outlined">add</span>
                                
    
                            </button>
                        </div>
                        <p class="font-body-md text-on-surface-variant">2 team members notified</p>
                    </div>
                    <!-- Actions -->
                    <div class="pt-4 flex flex-col gap-3">
                        <button type="submit"
                            class="w-full bg-primary text-on-primary py-4 rounded-2xl font-display font-bold text-body-lg shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all duration-300 flex items-center justify-center gap-3">
                            <span class="material-symbols-outlined">check_circle</span> Create Task
                        </button>
                        <a href="{{route('tasks.index')}}"
                            class="w-full bg-transparent text-error py-4 rounded-2xl font-label-md hover:bg-error/5 transition-all">
                            Discard Task
                        </a>
                    </div>
                </div>
                </form>
            </div>
       
    
  
    @push('script')
        <script>
        const attachmentInput = document.getElementById('attachment');
        const attachmentPreview = document.getElementById('attachmentPreview');
        const clearAttachment = document.getElementById('clearAttachment');
        const initialAttachmentHtml = attachmentPreview ? attachmentPreview.innerHTML : '';

        const renderAttachmentPreview = (file) => {
            const isImage = file.type.startsWith('image/');
            const previewHtml = isImage
                ? `<img alt="Attachment preview" class="w-full h-full object-cover" src="${URL.createObjectURL(file)}" />`
                : `<div class="w-full h-full flex flex-col items-center justify-center text-on-surface-variant px-3 text-center"><span class="material-symbols-outlined text-[32px] mb-1">insert_drive_file</span><span class="text-[12px]">${file.name}</span></div>`;
            attachmentPreview.innerHTML = previewHtml;
        };

        if (attachmentInput) {
            attachmentInput.addEventListener('change', (event) => {
                const file = event.target.files[0];
                if (!file) {
                    attachmentPreview.innerHTML = initialAttachmentHtml;
                    return;
                }
                renderAttachmentPreview(file);
            });
        }

        if (clearAttachment) {
            clearAttachment.addEventListener('click', () => {
                if (attachmentInput) {
                    attachmentInput.value = '';
                }
                attachmentPreview.innerHTML = initialAttachmentHtml;
            });
        }

        // Micro-interaction for priority buttons
        const priorityBtns = document.querySelectorAll('.grid-cols-3 button');
        priorityBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                priorityBtns.forEach(b => {
                    b.classList.remove('border-2', 'border-tertiary-container',
                        'bg-tertiary-container/10', 'font-bold');
                    b.classList.add('border', 'border-outline/10');
                });
                btn.classList.remove('border', 'border-outline/10');
                btn.classList.add('border-2', 'border-tertiary-container', 'bg-tertiary-container/10',
                    'font-bold');
            });
        });

        // Atmospheric parallax on scroll
        window.addEventListener('scroll', () => {
            const blobs = document.querySelectorAll('.blur-3xl');
            const scrolled = window.pageYOffset;
            if (blobs[0]) blobs[0].style.transform = `translateY(${scrolled * 0.1}px)`;
            if (blobs[1]) blobs[1].style.transform = `translateY(${scrolled * -0.05}px)`;
        });
    </script>
    @endpush
    
