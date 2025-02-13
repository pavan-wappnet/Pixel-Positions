<x-layout>
    <h1>Create Job</h1>

    <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <x-form-field>
            <x-form-label for="title">Title</x-form-label>
            <x-form-input name="title" id="title" type="text" required />
            <x-form-error name="title" />
        </x-form-field>

        <x-form-field>
            <x-form-label for="salary">Salary</x-form-label>
            <x-form-input name="salary" id="salary" type="text" required />
            <x-form-error name="salary" />
        </x-form-field>

        <x-form-field>
            <x-form-label for="tags">Tags (comma-separated)</x-form-label>
            <x-form-input name="tags" id="tags" type="text" />
            <x-form-error name="tags" />
        </x-form-field>

        <x-form-field>
            <x-form-label for="location">Location</x-form-label>
            <x-form-input name="location" id="location" type="text" required />
            <x-form-error name="location" />
        </x-form-field>

        <x-form-field>
            <x-form-label for="schedule">Schedule</x-form-label>
            <x-form-input name="schedule" id="schedule" type="text" value="Full Time" />
            <x-form-error name="schedule" />
        </x-form-field>

        <x-form-field>
            <x-form-label for="url">Job URL (optional)</x-form-label>
            <x-form-input name="url" id="url" type="url" />
            <x-form-error name="url" />
        </x-form-field>

        <x-form-field>
            <x-form-label for="employer_name">Employer Name</x-form-label>
            <div class="mt-2">
                <x-form-input name="employer_name" id="employer_name" type="text" required />
                <x-form-error name="employer_name" />
            </div>
        </x-form-field>

        <x-form-field>
            <x-form-label for="employer_logo">Employer Logo</x-form-label>
            <div class="mt-2">
                <x-form-input name="employer_logo" id="employer_logo" type="file" accept="image/*" required />
                <x-form-error name="employer_logo" />
            </div>
        </x-form-field>

        <x-form-button>Submit</x-form-button>
    </form>
</x-layout>
