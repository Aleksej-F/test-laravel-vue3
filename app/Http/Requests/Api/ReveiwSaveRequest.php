<?php
declare(strict_types=1);

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;


class ReveiwSaveRequest extends BaseApiRequest
{
 
    public function rules(): array
    {
        $isMethodPost = $this->isMethod('post');
        return [
            'to_whom_id' => [Rule::requiredIf($isMethodPost), 'int'],
            'rating' => [Rule::requiredIf($isMethodPost), 'int', 'max:5'],
            'comment' => [Rule::requiredIf($isMethodPost), 'string', 'max:1000'],
        ];
    }
}
