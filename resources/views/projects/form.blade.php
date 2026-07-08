@php $project = $project ?? null; @endphp
<x-layouts.front title="{{ $project ? 'Edit Project' : 'Create Project' }}">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
           <p>{{ $error}}</p>
        @endforeach
    @endif
    <form method="POST" action="{{ $action }}" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @if(isset($method) && $method !== 'POST')
            @method($method)
        @endif

        <div class="space-y-2">
            <label class="font-label-md text-primary uppercase tracking-[0.1em]">Title</label>
            <input name="title" type="text" class="w-full bg-on-background/[0.04] border-0 border-b-2 border-on-surface-variant/20 py-4 text-headline-md font-headline-md placeholder:text-on-surface-variant/30 focus:border-primary transition-all"
                   placeholder="Project title" value="{{ old('title', $project->title ?? '') }}" required />
        </div>

        <div class="space-y-2">
            <label class="font-label-md text-primary uppercase tracking-[0.1em]">Summary</label>
            <textarea name="summary" rows="4" class="w-full bg-on-background/[0.04] border-0 border-b-2 border-on-surface-variant/20 py-4 text-body-md placeholder:text-on-surface-variant/30 focus:border-primary transition-all"
                      placeholder="Short description">{{ old('summary', $project->summary ?? '') }}</textarea>
        </div>

        <button type="submit" class="px-6 py-3 bg-primary text-on-primary rounded-md hover:bg-primary/80 transition">
            {{ $project ? 'Update Project' : 'Create Project' }}
        </button>
    </form>
</x-layouts.front>
