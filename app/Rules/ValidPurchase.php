<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\PurchaseDetail;

class ValidPurchase implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $purchase_id;
    public function __construct($purchase_id)
    {
        $this->purchase_id = $purchase_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $detail = PurchaseDetail::where('purchase_id',$this->purchase_id)->where('product_id',$value)->count();
        return $detail==0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El producto ya fue registrado a la compra';
    }
}
