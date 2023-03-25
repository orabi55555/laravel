<?php

namespace App\Rules;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ThreePostsForUser implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = User::find($value);
        if($user->posts->count() > 3){
          $fail("Sorry, User \"{$user["name"]}\" Exceed the max posts number");
        }
    

    }
  public function message()
  {
    return 'error';
  }
    
 
}
