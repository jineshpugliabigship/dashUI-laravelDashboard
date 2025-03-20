<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MasterCourierRatesImportRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'csv_upload' => 'required|file|mimes:csv,xlsx,xls|max:2048',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
