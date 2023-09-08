<?php

namespace App\Models\Kernel;

use Illuminate\Http\Request;

trait HasFiltersTrait
{
    public function scopeFiltros($query, Request $request)
    {
        if( $filters = self::getFiltersRequest() )
        {
            foreach($filters as $key => $method)
            {
                $inputs = explode('|', $key);

                if( count($inputs) > 1 )
                {
                    foreach($inputs as $input)
                    {
                        if( $request->has($input) )
                        {
                            $key = $input;
                            break;
                        }
                    }
                }

                if( $request->has($key) )
                    call_user_func_array([$query, $method], $request->only($inputs));
            }
        }

        return $query;
    }

    public static function getFiltersRequest()
    {
        if(! self::getReflection()->hasProperty('filters_request') )
            return array();

        return self::getReflection()->getProperty('filters_request')->getValue();
    }
}
