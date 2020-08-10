<?php

use App\Support\ValuesStore\Setting;
use Carbon\Carbon;
use Illuminate\Support\Collection;

if (! function_exists('array_reset_index')) {
    /**
     * Reset numeric index of an array recursively.
     *
     * @param array $array
     * @return array|\Illuminate\Support\Collection
     *
     * @see https://stackoverflow.com/a/12399408/5736257
     */
    function array_reset_index($array): array
    {
        $array = $array instanceof Collection
            ? $array->toArray()
            : $array;

        foreach ($array as $key => $val) {
            if (is_array($val)) {
                $array[$key] = array_reset_index($val);
            }
        }

        if (isset($key) && is_numeric($key)) {
            return array_values($array);
        }

        return $array;
    }
}
if (! function_exists('settings')) {
    function settings($key = null, $default = null)
    {
        if ($key === null) {
            return app(Setting::class);
        }

        return app(Setting::class)->get($key, $default);
    }
}

if (! function_exists('formatDate')) {
    function formatDate($date): string
    {
        if (! $date instanceof Carbon) {
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $date);
        }

        return $date->format(settings('date_format', 'Y-m-d H:i:s'));
    }
}

if (! function_exists('intended')) {
    function intended($request, string $defaultUrl)
    {
        if (! empty($request->redirect_url)) {
            return redirect($request->redirect_url);
        }

        return redirect()->to($defaultUrl);
    }
}

function formatNumber($value)
{
    return number_format($value);
}
