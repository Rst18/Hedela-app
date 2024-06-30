<?php

namespace App\Http\Middleware;

use App\Models\Menu;
use App\Models\User;
use Inertia\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                'unreadNotification'=>$request->user() ? $request->user()->unreadNotifications()->count(): $request->user(),
            ],
            'menu'=>[
                'pages'=>$request->user() ? 

                Menu::get_user_menu()
                
                : $request->user()
            ]
        ];
    }
}
