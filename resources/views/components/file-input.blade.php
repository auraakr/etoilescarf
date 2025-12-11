<div class="flex items-center justify-center w-full {{ $class }}">
    <label 
        for="{{ $id }}" 
        id="{{ $id }}_dropzone"
        class="flex flex-col items-center justify-center w-full h-64 bg-slate-50 border-2 border-dashed border-strong rounded cursor-pointer hover:bg-slate-100 transition-colors"
    >
        <div id="{{ $id }}_content" class="flex flex-col items-center justify-center text-body pt-5 pb-6 pointer-events-none">
            <svg class="w-8 h-8 mb-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h3a3 3 0 0 0 0-6h-.025a5.56 5.56 0 0 0 .025-.5A5.5 5.5 0 0 0 7.207 9.021C7.137 9.017 7.071 9 7 9a4 4 0 1 0 0 8h2.167M12 19v-9m0 0-2 2m2-2 2 2"/>
            </svg>
            <p class="mb-2 text-sm">
                <span class="font-semibold">{{ $label }}</span> or drag and drop
            </p>
            <p class="text-xs">{{ $hint }}</p>
            <p id="{{ $id }}_filename" class="text-xs text-brand mt-2 hidden"></p>
        </div>
        
        {{-- Preview Image --}}
        <div id="{{ $id }}_preview" class="hidden w-full h-full p-4 pointer-events-none">
            <img src="" alt="Preview" class="w-full h-full object-contain">
        </div>
        
        <input 
            id="{{ $id }}" 
            name="{{ $name }}" 
            type="file" 
            class="hidden"
            @if($accept) accept="{{ $accept }}" @endif
            @if($required) required @endif
            @if($multiple) multiple @endif
            {{ $attributes }}
        />
    </label>
</div>

<script>
(function() {
    const input = document.getElementById('{{ $id }}');
    const dropzone = document.getElementById('{{ $id }}_dropzone');
    const content = document.getElementById('{{ $id }}_content');
    const preview = document.getElementById('{{ $id }}_preview');
    const filename = document.getElementById('{{ $id }}_filename');
    
    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropzone.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    // Highlight drop area when item is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        dropzone.addEventListener(eventName, highlight, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        dropzone.addEventListener(eventName, unhighlight, false);
    });
    
    function highlight(e) {
        dropzone.classList.add('border-brand', 'bg-brand/10');
    }
    
    function unhighlight(e) {
        dropzone.classList.remove('border-brand', 'bg-brand/10');
    }
    
    // Handle dropped files
    dropzone.addEventListener('drop', handleDrop, false);
    
    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        
        // Assign files to input
        input.files = files;
        
        // Trigger change event
        handleFiles(files);
    }
    
    // Handle file selection via click
    input.addEventListener('change', function(e) {
        handleFiles(this.files);
    });
    
    function handleFiles(files) {
        if (files.length > 0) {
            const file = files[0];
            
            // Show filename
            if (files.length === 1) {
                filename.textContent = '📁 ' + file.name;
            } else {
                filename.textContent = '📁 ' + files.length + ' files selected';
            }
            filename.classList.remove('hidden');
            
            // Show preview if it's an image
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.querySelector('img').src = e.target.result;
                    content.classList.add('hidden');
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        } else {
            filename.classList.add('hidden');
            content.classList.remove('hidden');
            preview.classList.add('hidden');
        }
    }
})();
</script>