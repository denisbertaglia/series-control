<?php

namespace App\Http\Requests\Season;

use App\Http\Requests\Series\SeriesRules;
use Illuminate\Foundation\Http\FormRequest;

class SeasonUpdateRequest extends FormRequest
{
    use SeriesRules;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = $this->getSeriesRules();
        return [
            'seasonsQts' => $rules['seasonsQts'],
            'episodesSeasonsQts' => $rules['episodesSeasonsQts'],
        ];
    }
}
