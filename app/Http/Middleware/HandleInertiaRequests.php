<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Middleware;
use Spatie\Permission\Models\Role;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
                'role' => $request->user() ? $request->user()->getRoleNames()[0] : null,
                'permissions' => $request->user() ? $request->user()->getPermissionsViaRoles() : null,
            ],
            'flash' => [
                'message' => fn () => $request->session()->get('message')
            ],
            'visitor' => [
                'online' => DB::table('sessions')->count(),
                // Menggunakan Visitor::count() jauh lebih efisien daripada Visitor::all()->count()
                'total' => Visitor::count(),
                // Langsung memanggil count() pada query builder lebih efisien
                'today' => Visitor::whereDate('visited_at', date('Y-m-d'))->count()
            ],
        ];
    }
}
