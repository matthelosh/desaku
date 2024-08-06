<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Middleware;

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
                'role' => $request->user() ? $request->user()->roles()->first() : null,
                'permissions' => $request->user() ? $request->user()->getPermissionsViaRoles() : null,
            ],
            'flash' => [
                'message' => fn () => $request->session()->get('message')
            ],
            'visitor' => [
                'online' => DB::table('sessions')->count(),
                'total' => Visitor::all()->count(),
                'today' => Visitor::whereDate('visited_at', '=', date('Y-m-d'))->get()->count()
            ]
        ];
    }
}
