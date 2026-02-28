<?php

namespace App\Http\Controllers;

use App\Http\Requests\LanguageRequest;
abstract class Controller
{
    /**
     * The current language from request query parameter.
     *
     * @var string
     */
    protected string $lang;

    /**
     * Create a new controller instance.
     *
     * @param  LanguageRequest  $request
     */
    public function __construct(LanguageRequest $request)
    {
        $this->lang = $request->query('lang', env('DEFAULT_LANGUAGE'));
    }
}
