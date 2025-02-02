<?php

namespace App\Http\Controllers;

use Butler\Graphql\Concerns\HandlesGraphqlRequests;
use GraphQL\Type\Schema;
use GraphQL\Language\AST\DocumentNode;
use Illuminate\Support\Facades\Auth;

class GraphqlController extends Controller
{
    use HandlesGraphqlRequests;

    public function beforeExecutionHook(Schema $schema, DocumentNode $query, string $operationName = null, $variables = null): void
    {
        // check authentication to sanctum
        if (!Auth::guard('sanctum')->check()) {
            abort(401, 'Unauthorized');
        }
    }
}
