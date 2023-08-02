<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class JsonParsing extends Model
{
    use HasFactory;

    /**
     * convert json from request to array
     * @param Request $request
     * @return array
     */
    public function parse(Request $request) : array
    {
        $input = json_encode($request->getContent(), JSON_UNESCAPED_UNICODE);
        $json = json_decode($input, true);
        $json = trim($json, '{');
        $json = trim($json, '}');
        $json = preg_split("/[,]/", $json);
        $result = [];
        $result1 = [];
        foreach ($json as $value) {
            $result[] = explode(':', $value);
        }
        foreach ($result as $value) {
            $str = trim(str_replace('"', '', $value[0]));
            $result1[$str] = trim($value[1]);
        }
        return $result1;
    }
}
