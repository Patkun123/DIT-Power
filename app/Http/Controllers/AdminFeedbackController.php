<?php

namespace App\Http\Controllers;

use App\Models\Feedbacks;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminFeedbackController extends Controller
{
    /**
     * Display a listing of all user feedbacks.
     */
    public function index(Request $request)
    {
        $query = Feedbacks::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('email', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        // Filter by rating
        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Sort functionality
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        $allowedSortFields = ['created_at', 'rating', 'email'];
        if (in_array($sortBy, $allowedSortFields)) {
            $query->orderBy($sortBy, $sortOrder);
        }

        $feedbacks = $query->paginate(15)->withQueryString();

        // Get statistics
        $stats = $this->getFeedbackStats();

        return view('auth.admin.view.feedbacks', compact('feedbacks', 'stats'));
    }

    /**
     * Display the specified feedback.
     */
    public function show(Feedbacks $feedback)
    {
        return view('auth.admin.view.feedback-detail', compact('feedback'));
    }

    /**
     * Remove the specified feedback from storage.
     */
    public function destroy(Feedbacks $feedback)
    {
        $feedback->delete();

        return redirect()->route('admin.feedbacks.index')
            ->with('success', 'Feedback deleted successfully.');
    }

    /**
     * Get feedback statistics.
     */
    private function getFeedbackStats()
    {
        $totalFeedbacks = Feedbacks::count();

        // Rating distribution
        $ratingStats = Feedbacks::selectRaw('rating, COUNT(*) as count')
            ->groupBy('rating')
            ->orderBy('rating')
            ->get()
            ->pluck('count', 'rating')
            ->toArray();

        // Fill missing ratings with 0
        for ($i = 1; $i <= 5; $i++) {
            if (!isset($ratingStats[$i])) {
                $ratingStats[$i] = 0;
            }
        }

        // Average rating
        $averageRating = Feedbacks::avg('rating') ?? 0;

        // Recent feedbacks (last 7 days)
        $recentFeedbacks = Feedbacks::where('created_at', '>=', Carbon::now()->subDays(7))->count();

        // This month's feedbacks
        $monthlyFeedbacks = Feedbacks::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        return [
            'total' => $totalFeedbacks,
            'average_rating' => round($averageRating, 2),
            'rating_distribution' => $ratingStats,
            'recent' => $recentFeedbacks,
            'monthly' => $monthlyFeedbacks,
        ];
    }

    /**
     * Export feedbacks to CSV.
     */
    public function export(Request $request)
    {
        $query = Feedbacks::query();

        // Apply same filters as index
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('email', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $feedbacks = $query->orderBy('created_at', 'desc')->get();

        $filename = 'feedbacks_' . Carbon::now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($feedbacks) {
            $file = fopen('php://output', 'w');

            // CSV headers
            fputcsv($file, ['ID', 'Email', 'Rating', 'Message', 'Created At']);

            // CSV data
            foreach ($feedbacks as $feedback) {
                fputcsv($file, [
                    $feedback->id,
                    $feedback->email,
                    $feedback->rating,
                    $feedback->message,
                    $feedback->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}

