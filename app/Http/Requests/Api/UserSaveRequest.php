<?php
declare(strict_types=1);

namespace App\Http\Requests\Api;

use App\Enums\RoleEnum;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;


class UserSaveRequest extends BaseApiRequest
{
    public function rules(): array
    {
        $isMethodPut = $this->isMethod('put');

        return [
            'name' => ['string', 'max:50', 'nullable'],
            'email' => [Rule::requiredIf($isMethodPut), 'email', 'max:50'],
            'phone' => ['string', 'max:12', 'nullable'],
            'role' => [Rule::requiredIf($isMethodPut), 'integer'],
            'description' => ['string', 'min:1', 'nullable'],
            'address' => ['string', 'max:50', 'nullable'],
            'img' => [ 'string', 'max:50', 'nullable'],
            'otherAnimals' => [Rule::requiredIf($isMethodPut), 'integer','max:1']
        ];
    }
}
