@extends('auth.users.partials.app.head')

@section('title', 'Tools')

@section('content')
<div class="bg-gray-50 dark:bg-gray-900 min-h-screen flex flex-col items-center py-10">
    <h1 class="text-4xl font-bold dark:text-gray-50 text-gray-900 mb-2">Terms and Policies</h1>
    <div class="w-50 h-1 bg-primary-500 rounded mb-8"></div>

    <div class="grid grid-cols-1 md:grid-cols-3 mb-5 gap-8 max-w-6xl w-full px-4">
        @if(!empty($pdfs) && count($pdfs) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 col-span-3">
                @foreach($pdfs as $pdf)
                <div
                    class="bg-white dark:bg-gray-800 rounded-lg shadow cursor-pointer hover:shadow-xl transition transform hover:-translate-y-1"
                    onclick="openPdfModal('{{ asset('pdfs/' . $pdf->file) }}')"
                >
                    <div class="p-6 text-center">
                        <svg class="mx-auto mb-4 w-12 h-12 text-gray-500 dark:text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z"/>
                        </svg>

                        <h2 class="font-semibold text-gray-800 dark:text-gray-200">{{ $pdf->title }}</h2>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20 text-gray-500 dark:text-gray-300 col-span-3">
                <svg class="mx-auto mb-4 w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v6M12 19v.01M6 19v.01M18 19v.01M3 7h18"/>
                </svg>
                <p class="text-lg">No PDF files available.</p>
            </div>
        @endif
    </div>
</div>

<!-- Modal -->
<div id="pdfModal" class="fixed inset-0 bg-black bg-opacity-80 hidden z-50 flex justify-center items-center">
    <div class="relative w-full h-full max-w-6xl max-h-full">
        <button onclick="closePdfModal()" class="absolute top-4 right-10 text-white text-2xl font-bold z-50">&times;</button>
        <iframe id="pdfFrame" class="w-full h-full" frameborder="0"></iframe>
    </div>
</div>
@push('scripts')
<script>
function openPdfModal(url) {
    document.getElementById('pdfFrame').src = url + '#toolbar=0';
    document.getElementById('pdfModal').classList.remove('hidden');
}

function closePdfModal() {
    document.getElementById('pdfFrame').src = '';
    document.getElementById('pdfModal').classList.add('hidden');
}
</script>
@endpush
@endsection
