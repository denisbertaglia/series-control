<?php

namespace App\Http\Requests\Series;

use Illuminate\Foundation\Http\FormRequest;

class SeriesStoreRequest extends FormRequest
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
    public function rules(): array
    {
        return $this->getSeriesRules();
    }
}
