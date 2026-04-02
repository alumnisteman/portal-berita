<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkSyncController extends Controller
{
    /**
     * Sync bookmarks from LocalStorage to the database.
     */
    public function sync(Request $request)
    {
        $request->validate([
            'bookmarks' => 'required|array',
            'bookmarks.*.id' => 'required|integer|exists:beritas,id',
        ]);

        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $userId = Auth::id();
        $syncedCount = 0;

        foreach ($request->bookmarks as $item) {
            // Use updateOrCreate to avoid duplicates
            Bookmark::updateOrCreate(
                ['user_id' => $userId, 'berita_id' => $item['id']],
                ['updated_at' => now()]
            );
            $syncedCount++;
        }

        return response()->json([
            'message' => 'Bookmarks synced successfully',
            'count' => $syncedCount
        ]);
    }
}
