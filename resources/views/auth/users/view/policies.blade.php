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
                    class="group overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm cursor-pointer transition hover:-translate-y-1 hover:shadow-xl dark:border-gray-700 dark:bg-gray-800"
                    onclick="openPdfModal('{{ asset('pdfs/' . $pdf->file) }}')"
                >
                    <div class="relative flex aspect-[4/3] items-center justify-center overflow-hidden bg-gradient-to-br from-slate-100 via-white to-slate-200 dark:from-slate-700 dark:via-slate-800 dark:to-slate-900">
                        <iframe
                            src="{{ asset('pdfs/' . $pdf->file) }}#page=1&toolbar=0&navpanes=0&scrollbar=0&view=FitH"
                            class="h-full w-full border-0 bg-white"
                            title="{{ $pdf->title }} preview"
                            loading="lazy"
                        ></iframe>
                        <div class="pointer-events-none absolute inset-x-0 bottom-0 flex items-center justify-between bg-slate-900/80 px-3 py-2 text-[10px] font-medium text-white dark:bg-slate-950/80">
                            <span>First page preview</span>
                            <a
                                href="{{ asset('pdfs/' . $pdf->file) }}"
                                target="_blank"
                                rel="noopener"
                                onclick="event.stopPropagation()"
                                class="rounded bg-white/15 px-2 py-0.5 transition hover:bg-white/25"
                            >Open</a>
                        </div>
                    </div>
                    <div class="p-4">
                        <h2 class="font-semibold leading-5 text-gray-800 dark:text-gray-200">{{ $pdf->title }}</h2>
                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Click to view full document</p>
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
