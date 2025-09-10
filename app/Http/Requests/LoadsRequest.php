<?php
// app/Http/Requests/LoadsRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoadsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'loads' => 'required|array',
            'loads.*.id' => 'required|integer',
            'loads.*.quantity' => 'required|numeric',
            'loads.*.moisture' => 'required|numeric',
        ];
    }

    public function validatedAttributes(): array
    {
        return $this->validated()['loads'] ?? [];
    }
}
