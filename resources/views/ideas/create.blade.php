@extends('layouts.app')

@section('title', 'Post Your Idea')

@section('content')
<div class="max-w-4xl mx-auto px-6 lg:px-8 py-12">
    <div class="glass-effect rounded-2xl p-10">
        <h1 class="section-title mb-8">Post Your Idea</h1>

        <form method="POST" action="{{ route('ideas.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-8">
                <label class="block text-gray-900 font-bold mb-3 text-lg">Project Title *</label>
                <input type="text" name="title" value="{{ old('title') }}" required class="input-modern w-full @error('title') border-red-500 @enderror">
                @error('title')<p class="text-red-500 text-sm mt-2">{{ $message }}</p>@enderror
            </div>

            <div class="mb-8">
                <label class="block text-gray-900 font-bold mb-3 text-lg">Project Summary *</label>
                <textarea name="summary" rows="6" required class="input-modern w-full @error('summary') border-red-500 @enderror">{{ old('summary') }}</textarea>
                @error('summary')<p class="text-red-500 text-sm mt-2">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label class="block text-gray-900 font-bold mb-3">Development Stage *</label>
                    <select name="stage" required class="input-modern w-full @error('stage') border-red-500 @enderror">
                        <option value="">Select Stage</option>
                        <option value="Ideation" {{ old('stage') == 'Ideation' ? 'selected' : '' }}>Ideation</option>
                        <option value="Proof of Concept" {{ old('stage') == 'Proof of Concept' ? 'selected' : '' }}>Proof of Concept</option>
                        <option value="Prototype" {{ old('stage') == 'Prototype' ? 'selected' : '' }}>Prototype</option>
                        <option value="Patent Filed" {{ old('stage') == 'Patent Filed' ? 'selected' : '' }}>Patent Filed</option>
                        <option value="Commercial Stage" {{ old('stage') == 'Commercial Stage' ? 'selected' : '' }}>Commercial Stage</option>
                    </select>
                    @error('stage')<p class="text-red-500 text-sm mt-2">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-gray-900 font-bold mb-3">Domain</label>
                    <input type="text" name="domain" value="{{ old('domain') }}" placeholder="e.g., Healthcare, AI, IoT" class="input-modern w-full">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label class="block text-gray-900 font-bold mb-3">Technology Type</label>
                    <input type="text" name="technology_type" value="{{ old('technology_type') }}" placeholder="e.g., Software, Hardware" class="input-modern w-full">
                </div>

                <div>
                    <label class="block text-gray-900 font-bold mb-3">Co-Applicants Needed *</label>
                    <input type="number" name="co_applicants_needed" value="{{ old('co_applicants_needed', 1) }}" min="1" required class="input-modern w-full">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label class="block text-gray-900 font-bold mb-3">Funding Requirement (₹)</label>
                    <input type="number" name="funding_requirement" value="{{ old('funding_requirement') }}" min="0" step="0.01" class="input-modern w-full">
                </div>

                <div>
                    <label class="block text-gray-900 font-bold mb-3">Filing Date</label>
                    <input type="date" name="filing_date" value="{{ old('filing_date') }}" class="input-modern w-full">
                </div>
            </div>

            <div class="mb-8">
                <label class="block text-gray-900 font-bold mb-3">Supporting Document (Optional)</label>
                <input type="file" name="document" accept=".pdf,.doc,.docx" class="input-modern w-full">
                <p class="text-sm text-gray-500 mt-2">📄 PDF, DOC, DOCX (Max 10MB)</p>
            </div>

            <div class="glass-effect border-l-4 border-yellow-500 rounded-lg p-6 mb-8">
                <div class="flex items-start">
                    <span class="text-2xl mr-3">ℹ️</span>
                    <p class="text-gray-700">Your idea will be reviewed by our team before being published on the platform.</p>
                </div>
            </div>

            <button type="submit" class="btn-primary w-full text-lg py-4">Submit Idea for Review →</button>
        </form>
    </div>
</div>
@endsection
