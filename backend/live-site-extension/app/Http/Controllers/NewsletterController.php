<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsletterSubscriber;

class NewsletterController extends Controller
{
     public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers,email',
        ]);

        NewsletterSubscriber::create([
            'email' => $request->email,
        ]);

        return back()->with('success', 'Thank you for subscribing!');
    }

      public function index()
    {
        $subscribers = NewsletterSubscriber::orderBy('created_at', 'desc')->get();
        return view('admin.newsletter.index', compact('subscribers'));
    }

    /**
     * Remove the specified subscriber from storage.
     */
    public function destroy($id)
    {
        $subscriber = NewsletterSubscriber::findOrFail($id);
        $subscriber->delete();

        return back()->with('success', 'Subscriber removed successfully.');
    }

    /**
     * Export subscribers to CSV.
     */
    public function export()
    {
        $subscribers = NewsletterSubscriber::all();
        
        $filename = 'newsletter_subscribers_' . date('Y-m-d') . '.csv';
        $handle = fopen('php://output', 'w');
        
        // Add CSV headers
        fputcsv($handle, ['ID', 'Email', 'Subscribed Date']);
        
        // Add data
        foreach ($subscribers as $subscriber) {
            fputcsv($handle, [
                $subscriber->id,
                $subscriber->email,
                $subscriber->created_at->format('Y-m-d H:i:s')
            ]);
        }
        
        fclose($handle);
        
        return response()->stream(
            function() use ($handle) {
                // The content is already output
            },
            200,
            [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]
        );
    }

    /**
     * Bulk delete subscribers.
     */
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        
        if (empty($ids)) {
            return back()->with('error', 'No subscribers selected.');
        }
        
        NewsletterSubscriber::whereIn('id', $ids)->delete();
        
        return back()->with('success', 'Selected subscribers removed successfully.');
    }
}
