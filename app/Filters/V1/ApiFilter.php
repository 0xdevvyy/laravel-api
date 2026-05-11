<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;


class ApiFilter{
    protected $allowedParams = [];

    protected $columMap = [];

    protected $operatorMap = [];

    public function transorm(Request $request){
        $eloQuery = [];

        foreach ($this->allowedParams as $parms => $operators){
            $query = $request->query($parms);
            
            if(!isset($query)){
                continue;
            }

            $column = $this->columMap[$parms] ?? $parms;

            foreach($operators as $operator ){
                if(isset($query[$operator])){
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]]; 
                }
            }
        }

        return $eloQuery;
    }
}