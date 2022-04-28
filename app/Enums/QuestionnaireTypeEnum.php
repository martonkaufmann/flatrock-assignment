<?php

namespace App\Enums;

enum QuestionnaireTypeEnum: int
{
    case SINGLE_CHOICE = 1;
    case MULTI_CHOICE = 2;
    case BINARY_CHOICE = 3;
}
