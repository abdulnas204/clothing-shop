<?php

use App\Models\Visitor;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

/**
 * Alias for auth() helper
 *
 * @codeCoverageIgnore
 */
function user()
{
    return auth()->user();
}

function active_if_route_is(string $route, ?string $request = null, ?string $get_param = null): ?string
{
    if ($request) {
        return request($request) == $get_param ? 'active' : null;
    }
    return request()->is($route) ? 'active' : null;
}

function get_file_name(string $title, string $ext): string
{
    return Str::slug($title) . '-' . string_random(7) . '.' . $ext;
}

function string_random(?int $length = 16): string
{
    return Str::random($length);
}

function string_limit(string $value, ?int $limit = 100, ?string $end = '...'): string
{
    return Str::limit($value, $limit, $end);
}

function get_current_category(string $url): ?string
{
    if (Str::contains($url, 'category1')) {
        return 'category1';
    }

    if (Str::contains($url, 'category2')) {
        return 'category2';
    }

    return null;
}

function no_connection_error(Exception $exception, string $file): void
{
    logger()->error("{$exception->getMessage()} in file $file.php");
    session()->flash('error', trans('messages.query_error'));
}

// It returns visitor_id even if cookie is not set
function visitor_id()
{
    if (request()->cookie('cs_rotsiv')) {
        return request()->cookie('cs_rotsiv');
    }
    $visitor_id = Visitor::whereIp(request()->ip())->value('id');
    Cookie::queue('cs_rotsiv', $visitor_id, 218400);

    return $visitor_id;
}

function forget_all_cache(): void
{
    array_map(function ($name) {
        cache()->forget($name);
    }, config('cache.cache_names'));
}

function nice_money_format(string $sum): string
{
    return number_format($sum, 0, ',', ' ');
}
