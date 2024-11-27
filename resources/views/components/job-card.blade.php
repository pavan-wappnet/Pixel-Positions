@props(['job'])

<x-panel class="flex flex-col">
    <div class="self-start text-sm">{{ $job->employer->name }}</div>
    <div class="py-8 font-bold">
        <h3 class="text-xl font-bold transition-colors duration-300 group-hover:text-blue-800">{{ $job->title }}</h3>
        <p class="mt-4 text-sm">{{ $job->salary }}</p>
    </div>

    <div class="flex items-center justify-between mt-auto">
        <div>
            @foreach ($job->tags as $tag)
                <x-tag :$tag size="small" />
            @endforeach
        </div>

        <x-employer-logo :width="42" />
    </div>
</x-panel>