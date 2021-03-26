<?php

namespace App\Enums;
use http\Env\Request;


class ReviewEnums{
    public static $QUESTIONS =[
                                ['type'=>"rating",'question'=>"How did you like our Service?"],
                                ['type'=>"rating", 'question'=>"How did you like our Driver?"],
                                ['type'=>"rating", 'question'=>"How did you like our Experience?"], 
                                ['type'=>"text", 'question'=>"Do you have any Suggestions?"]
                            ];
}