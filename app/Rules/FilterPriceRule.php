<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class FilterPriceRule implements Rule
{
    private $request;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        //
        $this->request=$request;
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
        //
        if($this->request->has('price_min') && $this->request->has('price_max')){
                 if(floatval($this->request->get('price_min'))>floatval($this->request->get('price_max'))){
                     return false;
                 }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Price max mast me greatest than price min';
    }
}
