<?php

namespace Cspray\AnnotatedContainerDoctrineDemo\Model;

enum TodoStatus : string {
    case ToDo = 'todo';
    case InProgress = 'in_progress';
    case Done = 'done';
    case Cancelled = 'cancelled';
}
